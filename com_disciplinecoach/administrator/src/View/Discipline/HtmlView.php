<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : HtmlView.php
 * Path        : administrator/src/View/Discipline/HtmlView.php
 * Purpose     : Displays the multilingual Discipline administrator form.
 *               Loads the discipline, available content languages and
 *               existing translations.
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

namespace Fvl\Component\DisciplineCoach\Administrator\View\Discipline;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\Database\DatabaseInterface;
use Joomla\Database\ParameterType;

/**
 * Discipline HTML View.
 */
class HtmlView extends BaseHtmlView
{
    /**
     * Main discipline record.
     *
     * @var object|null
     */
    protected $item = null;

    /**
     * Joomla form containing the shared fields.
     *
     * @var object|null
     */
    protected $form = null;

    /**
     * Published content languages.
     *
     * @var array
     */
    protected array $languages = [];

    /**
     * Existing translations, indexed by language code.
     *
     * @var array
     */
    protected array $translations = [];

    /**
     * Language that is active when the form opens.
     *
     * @var string
     */
    protected string $activeLanguage = '';

    /**
     * Displays the discipline form.
     *
     * @param string|null $tpl Optional template name.
     *
     * @return void
     */
    public function display($tpl = null): void
    {
        $application = Factory::getApplication();
        $input       = $application->getInput();
        $id          = $input->getInt('id', 0);

        $database = Factory::getContainer()->get(
            DatabaseInterface::class
        );

        // Gepubliceerde en geïnstalleerde inhoudstalen ophalen.
        $this->languages = LanguageHelper::getContentLanguages(
            [1],
            true,
            'lang_code',
            'title_native',
            'ASC'
        );

        // De standaardtaal van de frontsite bepalen.
        $defaultLanguage = (string) $application->get(
            'language',
            'en-GB'
        );

        // Hoofdrecord en vertalingen van een bestaande discipline ophalen.
        if ($id > 0) {
            $this->loadDiscipline($database, $id);
            $this->loadTranslations($database, $id);
        }

        // Een expliciet doorgegeven taal krijgt voorrang.
        $requestedLanguage = $input->getCmd('language', '');

        if (
            $requestedLanguage !== ''
            && isset($this->languages[$requestedLanguage])
        ) {
            $this->activeLanguage = $requestedLanguage;
        } elseif (
            $defaultLanguage !== ''
            && isset($this->languages[$defaultLanguage])
        ) {
            $this->activeLanguage = $defaultLanguage;
        } else {
            // Terugvallen op de eerste beschikbare inhoudstaal.
            $languageCodes = array_keys($this->languages);

            $this->activeLanguage = $languageCodes[0] ?? '';
        }

        // Het Joomla-formulier met de gedeelde velden ophalen.
        $model      = $this->getModel();
        $this->form = $model->getForm();

        if ($this->item !== null) {
            $this->form->bind((array) $this->item);
        }

        parent::display($tpl);
    }

    /**
     * Loads the shared discipline record.
     *
     * @param DatabaseInterface $database Database connection.
     * @param int               $id       Discipline ID.
     *
     * @return void
     */
    private function loadDiscipline(
        DatabaseInterface $database,
        int $id
    ): void {
        $query = $database->createQuery()
            ->select(
                $database->quoteName(
                    [
                        'id',
                        'image',
                        'published',
                        'created',
                        'created_by',
                        'modified',
                        'modified_by',
                    ]
                )
            )
            ->from($database->quoteName('#__dc_disciplines'))
            ->where($database->quoteName('id') . ' = :id')
            ->bind(':id', $id, ParameterType::INTEGER);

        $database->setQuery($query);

        $result = $database->loadObject();

        $this->item = $result ?: null;
    }

    /**
     * Loads all translations belonging to a discipline.
     *
     * @param DatabaseInterface $database   Database connection.
     * @param int               $disciplineId Discipline ID.
     *
     * @return void
     */
    private function loadTranslations(
        DatabaseInterface $database,
        int $disciplineId
    ): void {
        $query = $database->createQuery()
            ->select(
                $database->quoteName(
                    [
                        'id',
                        'discipline_id',
                        'language',
                        'title',
                        'alias',
                    ]
                )
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
            ->order($database->quoteName('language') . ' ASC')
            ->bind(
                ':discipline_id',
                $disciplineId,
                ParameterType::INTEGER
            );

        $database->setQuery($query);

        $records = $database->loadObjectList();

        foreach ($records as $record) {
            $this->translations[$record->language] = $record;
        }
    }
}
