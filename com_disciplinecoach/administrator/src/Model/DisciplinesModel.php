<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : DisciplinesModel.php
 * Path        : administrator/src/Model/DisciplinesModel.php
 * Purpose     : Retrieves disciplines for the administrator overview.
 *               Titles and aliases are loaded from the translation table.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-10
 * Modified    : 2026-11-10
 * Version     : 0.1.3
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\DatabaseQuery;

/**
 * Model for the disciplines administrator overview.
 */
class DisciplinesModel extends ListModel
{
    /**
     * Creates the query for the disciplines overview.
     *
     * @return DatabaseQuery
     */
    protected function getListQuery(): DatabaseQuery
    {
        $database = $this->getDatabase();
        $query    = $database->createQuery();

        $language = $this->getDisplayLanguage();

        $query
            ->select(
                [
                    $database->quoteName('discipline.id'),
                    $database->quoteName('discipline.image'),
                    $database->quoteName('discipline.published'),
                    $database->quoteName('discipline.created'),
                    $database->quoteName('discipline.created_by'),
                    $database->quoteName('discipline.modified'),
                    $database->quoteName('discipline.modified_by'),
                    $database->quoteName('translation.language'),
                    $database->quoteName('translation.title'),
                    $database->quoteName('translation.alias'),
                ]
            )
            ->from(
                $database->quoteName(
                    '#__dc_disciplines',
                    'discipline'
                )
            )
            ->leftJoin(
                $database->quoteName(
                    '#__dc_disciplines_lang',
                    'translation'
                )
                . ' ON '
                . $database->quoteName(
                    'translation.discipline_id'
                )
                . ' = '
                . $database->quoteName('discipline.id')
                . ' AND '
                . $database->quoteName(
                    'translation.language'
                )
                . ' = '
                . $database->quote($language)
            );

        $search = trim(
            (string) Factory::getApplication()
                ->getInput()
                ->getString('search', '')
        );

        if ($search !== '') {
            $searchValue = '%'
                . $database->escape(
                    $search,
                    true
                )
                . '%';

            $query->where(
                '('
                . $database->quoteName('translation.title')
                . ' LIKE '
                . $database->quote($searchValue, false)
                . ' OR '
                . $database->quoteName('translation.alias')
                . ' LIKE '
                . $database->quote($searchValue, false)
                . ')'
            );
        }

        $status = Factory::getApplication()
            ->getInput()
            ->getString('status', '');

        if ($status === '0' || $status === '1') {
            $query->where(
                $database->quoteName('discipline.published')
                . ' = '
                . (int) $status
            );
        }

        $allowedOrderFields = [
            'title'     => 'translation.title',
            'alias'     => 'translation.alias',
            'published' => 'discipline.published',
            'id'        => 'discipline.id',
        ];

        $requestedOrder = Factory::getApplication()
            ->getInput()
            ->getCmd('order', 'title');

        $orderField = $allowedOrderFields[$requestedOrder]
            ?? 'translation.title';

        $direction = strtoupper(
            Factory::getApplication()
                ->getInput()
                ->getCmd('direction', 'ASC')
        );

        if (!in_array($direction, ['ASC', 'DESC'], true)) {
            $direction = 'ASC';
        }

        $query->order(
            $database->quoteName($orderField)
            . ' '
            . $direction
        );

        return $query;
    }

    /**
     * Determines which translation is displayed in the overview.
     *
     * @return string
     */
    private function getDisplayLanguage(): string
    {
        $application = Factory::getApplication();

        $requestedLanguage = $application
            ->getInput()
            ->getCmd('language', '');

        $contentLanguages = LanguageHelper::getContentLanguages(
            [1],
            true,
            'lang_code',
            'title_native',
            'ASC'
        );

        if (
            $requestedLanguage !== ''
            && isset($contentLanguages[$requestedLanguage])
        ) {
            return $requestedLanguage;
        }

        $administratorLanguage = $application
            ->getLanguage()
            ->getTag();

        if (isset($contentLanguages[$administratorLanguage])) {
            return $administratorLanguage;
        }

        $defaultSiteLanguage = (string) $application->get(
            'language',
            ''
        );

        if (
            $defaultSiteLanguage !== ''
            && isset($contentLanguages[$defaultSiteLanguage])
        ) {
            return $defaultSiteLanguage;
        }

        $languageCodes = array_keys($contentLanguages);

        return $languageCodes[0] ?? 'en-GB';
    }
}
