<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : DisciplineController.php
 * Path        : administrator/src/Controller/DisciplineController.php
 * Purpose     : Saves a discipline and all available translations.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-03
 * Modified    : 2026-11-10
 * Version     : 0.1.3
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Session\Session;
use Joomla\Database\DatabaseInterface;
use Joomla\Database\ParameterType;
use RuntimeException;
use Throwable;

/**
 * Controller for creating and editing disciplines.
 */
class DisciplineController extends BaseController
{
    /**
     * Saves the discipline and all translations.
     *
     * @return void
     */
    public function save(): void
    {
        $application = Factory::getApplication();

        if (!Session::checkToken()) {
            throw new RuntimeException(
                Text::_('JINVALID_TOKEN_NOTICE')
            );
        }

        $input    = $application->getInput();
        $identity = $application->getIdentity();

        /** @var DatabaseInterface $database */
        $database = Factory::getContainer()->get(
            DatabaseInterface::class
        );

        $id = $input->post->getInt('id', 0);

        $activeLanguage = $input->post->getCmd(
            'active_language',
            ''
        );

        $translations = $input->post->get(
            'translations',
            [],
            'array'
        );

        $jform = $input->post->get(
            'jform',
            [],
            'array'
        );

        $image = trim(
            (string) ($jform['image'] ?? '')
        );

        $image = explode('#', $image)[0];

        $published = (int) (
            $jform['published'] ?? 1
        );

        $published = $published === 1 ? 1 : 0;

        try {
            $contentLanguages = LanguageHelper::getContentLanguages(
                [1],
                true,
                'lang_code',
                'title_native',
                'ASC'
            );

            if (empty($contentLanguages)) {
                throw new RuntimeException(
                    Text::_(
                        'COM_DISCIPLINECOACH_ERROR_NO_CONTENT_LANGUAGES'
                    )
                );
            }

            $cleanTranslations = [];

            foreach ($contentLanguages as $languageCode => $language) {
                $translation = $translations[$languageCode] ?? [];

                $title = trim(
                    (string) ($translation['title'] ?? '')
                );

                $alias = trim(
                    (string) ($translation['alias'] ?? '')
                );

                if ($title === '' || $alias === '') {
                    throw new RuntimeException(
                        Text::sprintf(
                            'COM_DISCIPLINECOACH_TRANSLATION_INCOMPLETE_LANGUAGE',
                            $language->title_native
                                ?? $language->title
                                ?? $languageCode
                        )
                    );
                }

                $cleanTranslations[$languageCode] = [
                    'title' => $title,
                    'alias' => $this->cleanAlias($alias),
                ];
            }

            $this->validateAliases(
                $database,
                $cleanTranslations,
                $id
            );

            $database->transactionStart();

            $now = Factory::getDate()->toSql();

            $userId = (int) ($identity->id ?? 0);

            if ($id === 0) {
                $id = $this->insertDiscipline(
                    $database,
                    $image,
                    $published,
                    $now,
                    $userId
                );
            } else {
                if (!$this->disciplineExists($database, $id)) {
                    throw new RuntimeException(
                        Text::_(
                            'COM_DISCIPLINECOACH_ERROR_DISCIPLINE_NOT_FOUND'
                        )
                    );
                }

                $this->updateDiscipline(
                    $database,
                    $id,
                    $image,
                    $published,
                    $now,
                    $userId
                );
            }

            foreach (
                $cleanTranslations as $languageCode => $translation
            ) {
                $this->saveTranslation(
                    $database,
                    $id,
                    $languageCode,
                    $translation['title'],
                    $translation['alias']
                );
            }

            $database->transactionCommit();

            $this->setRedirect(
                'index.php?option=com_disciplinecoach'
                . '&view=disciplines',
                Text::_(
                    'COM_DISCIPLINECOACH_MESSAGE_DISCIPLINE_SAVED'
                ),
                'message'
            );
        } catch (Throwable $exception) {
            try {
                $database->transactionRollback();
            } catch (Throwable $rollbackException) {
                // Er is nog geen transactie gestart of deze is al gesloten.
            }

            $application->enqueueMessage(
                $exception->getMessage(),
                'error'
            );

            $redirectUrl = 'index.php?option=com_disciplinecoach'
                . '&view=discipline';

            if ($id > 0) {
                $redirectUrl .= '&id=' . $id;
            }

            if ($activeLanguage !== '') {
                $redirectUrl .= '&language='
                    . rawurlencode($activeLanguage);
            }

            $this->setRedirect($redirectUrl);
        }
    }

    /**
     * Inserts the shared discipline record.
     *
     * @return int
     */
    private function insertDiscipline(
        DatabaseInterface $database,
        string $image,
        int $published,
        string $created,
        int $createdBy
    ): int {
        $query = $database->createQuery()
            ->insert(
                $database->quoteName('#__dc_disciplines')
            )
            ->columns(
                $database->quoteName(
                    [
                        'image',
                        'published',
                        'created',
                        'created_by',
                    ]
                )
            )
            ->values(
                implode(
                    ', ',
                    [
                        ':image',
                        ':published',
                        ':created',
                        ':created_by',
                    ]
                )
            )
            ->bind(':image', $image)
            ->bind(
                ':published',
                $published,
                ParameterType::INTEGER
            )
            ->bind(':created', $created)
            ->bind(
                ':created_by',
                $createdBy,
                ParameterType::INTEGER
            );

        $database->setQuery($query);
        $database->execute();

        return (int) $database->insertid();
    }

    /**
     * Updates the shared discipline record.
     *
     * @return void
     */
    private function updateDiscipline(
        DatabaseInterface $database,
        int $id,
        string $image,
        int $published,
        string $modified,
        int $modifiedBy
    ): void {
        $query = $database->createQuery()
            ->update(
                $database->quoteName('#__dc_disciplines')
            )
            ->set(
                [
                    $database->quoteName('image')
                        . ' = :image',

                    $database->quoteName('published')
                        . ' = :published',

                    $database->quoteName('modified')
                        . ' = :modified',

                    $database->quoteName('modified_by')
                        . ' = :modified_by',
                ]
            )
            ->where(
                $database->quoteName('id') . ' = :id'
            )
            ->bind(':image', $image)
            ->bind(
                ':published',
                $published,
                ParameterType::INTEGER
            )
            ->bind(':modified', $modified)
            ->bind(
                ':modified_by',
                $modifiedBy,
                ParameterType::INTEGER
            )
            ->bind(
                ':id',
                $id,
                ParameterType::INTEGER
            );

        $database->setQuery($query);
        $database->execute();
    }

    /**
     * Inserts or updates one translation.
     *
     * @return void
     */
    private function saveTranslation(
        DatabaseInterface $database,
        int $disciplineId,
        string $language,
        string $title,
        string $alias
    ): void {
        $translationId = $this->getTranslationId(
            $database,
            $disciplineId,
            $language
        );

        if ($translationId === 0) {
            $query = $database->createQuery()
                ->insert(
                    $database->quoteName(
                        '#__dc_disciplines_lang'
                    )
                )
                ->columns(
                    $database->quoteName(
                        [
                            'discipline_id',
                            'language',
                            'title',
                            'alias',
                        ]
                    )
                )
                ->values(
                    implode(
                        ', ',
                        [
                            ':discipline_id',
                            ':language',
                            ':title',
                            ':alias',
                        ]
                    )
                )
                ->bind(
                    ':discipline_id',
                    $disciplineId,
                    ParameterType::INTEGER
                )
                ->bind(':language', $language)
                ->bind(':title', $title)
                ->bind(':alias', $alias);
        } else {
            $query = $database->createQuery()
                ->update(
                    $database->quoteName(
                        '#__dc_disciplines_lang'
                    )
                )
                ->set(
                    [
                        $database->quoteName('title')
                            . ' = :title',

                        $database->quoteName('alias')
                            . ' = :alias',
                    ]
                )
                ->where(
                    $database->quoteName('id')
                    . ' = :translation_id'
                )
                ->bind(':title', $title)
                ->bind(':alias', $alias)
                ->bind(
                    ':translation_id',
                    $translationId,
                    ParameterType::INTEGER
                );
        }

        $database->setQuery($query);
        $database->execute();
    }

    /**
     * Retrieves the ID of an existing translation.
     *
     * @return int
     */
    private function getTranslationId(
        DatabaseInterface $database,
        int $disciplineId,
        string $language
    ): int {
        $query = $database->createQuery()
            ->select(
                $database->quoteName('id')
            )
            ->from(
                $database->quoteName(
                    '#__dc_disciplines_lang'
                )
            )
            ->where(
                $database->quoteName('discipline_id')
                . ' = :discipline_id'
            )
            ->where(
                $database->quoteName('language')
                . ' = :language'
            )
            ->bind(
                ':discipline_id',
                $disciplineId,
                ParameterType::INTEGER
            )
            ->bind(':language', $language);

        $database->setQuery($query);

        return (int) $database->loadResult();
    }

    /**
     * Checks whether the discipline exists.
     *
     * @return bool
     */
    private function disciplineExists(
        DatabaseInterface $database,
        int $id
    ): bool {
        $query = $database->createQuery()
            ->select('COUNT(*)')
            ->from(
                $database->quoteName('#__dc_disciplines')
            )
            ->where(
                $database->quoteName('id') . ' = :id'
            )
            ->bind(
                ':id',
                $id,
                ParameterType::INTEGER
            );

        $database->setQuery($query);

        return (int) $database->loadResult() > 0;
    }

    /**
     * Checks whether aliases are unique within their language.
     *
     * @return void
     */
    private function validateAliases(
        DatabaseInterface $database,
        array $translations,
        int $disciplineId
    ): void {
        foreach ($translations as $language => $translation) {
            $query = $database->createQuery()
                ->select('COUNT(*)')
                ->from(
                    $database->quoteName(
                        '#__dc_disciplines_lang'
                    )
                )
                ->where(
                    $database->quoteName('language')
                    . ' = :language'
                )
                ->where(
                    $database->quoteName('alias')
                    . ' = :alias'
                )
                ->bind(':language', $language)
                ->bind(':alias', $translation['alias']);

            if ($disciplineId > 0) {
                $query
                    ->where(
                        $database->quoteName('discipline_id')
                        . ' <> :discipline_id'
                    )
                    ->bind(
                        ':discipline_id',
                        $disciplineId,
                        ParameterType::INTEGER
                    );
            }

            $database->setQuery($query);

            if ((int) $database->loadResult() > 0) {
                throw new RuntimeException(
                    Text::sprintf(
                        'COM_DISCIPLINECOACH_ERROR_DUPLICATE_ALIAS_LANGUAGE',
                        $language
                    )
                );
            }
        }
    }

    /**
     * Cleans the alias entered by the administrator.
     *
     * @return string
     */
    private function cleanAlias(string $alias): string
    {
        $alias = mb_strtolower(trim($alias));

        $alias = preg_replace(
            '/[^\p{L}\p{N}]+/u',
            '-',
            $alias
        );

        return trim((string) $alias, '-');
    }
}
