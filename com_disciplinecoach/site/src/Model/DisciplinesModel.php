<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : DisciplinesModel.php
 * Path        : site/src/Model/DisciplinesModel.php
 * Purpose     : Loads published disciplines for the frontend selection
 *               page and marks the current user's selected disciplines.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-11
 * Modified    : 2026-11-12
 * Version     : 0.1.4
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\DatabaseQuery;
use Joomla\Database\ParameterType;

/**
 * Model for the frontend discipline selection page.
 */
class DisciplinesModel extends ListModel
{
    /**
     * Prepares the model state.
     *
     * All published disciplines are displayed on one selection page.
     *
     * @param string $ordering  Default ordering.
     * @param string $direction Default ordering direction.
     *
     * @return void
     */
    protected function populateState(
        $ordering = 'selected',
        $direction = 'DESC'
    ): void {
        parent::populateState($ordering, $direction);

        $this->setState('list.limit', 0);
        $this->setState('list.start', 0);
    }

    /**
     * Creates the query for the frontend discipline selection page.
     *
     * Selected disciplines are displayed first.
     * Both selected and unselected disciplines are sorted alphabetically.
     *
     * @return DatabaseQuery
     */
    protected function getListQuery(): DatabaseQuery
    {
        $application = Factory::getApplication();
        $identity    = $application->getIdentity();
        $database    = $this->getDatabase();

        $userId   = (int) ($identity->id ?? 0);
        $language = $application->getLanguage()->getTag();
        $published = 1;

        $query = $database->createQuery();

        $query
            ->select(
                [
                    $database->quoteName('discipline.id'),
                    $database->quoteName('discipline.image'),
                    $database->quoteName('discipline.published'),
                    $database->quoteName('translation.language'),
                    $database->quoteName('translation.title'),
                    $database->quoteName('translation.alias'),
                    $database->quoteName(
                        'membership.id',
                        'membership_id'
                    ),
                    'CASE'
                    . ' WHEN '
                    . $database->quoteName('membership.id')
                    . ' IS NULL'
                    . ' THEN 0'
                    . ' ELSE 1'
                    . ' END AS '
                    . $database->quoteName('selected'),
                ]
            )
            ->from(
                $database->quoteName(
                    '#__dc_disciplines',
                    'discipline'
                )
            )
            ->innerJoin(
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
                . ' = :language'
            )
            ->leftJoin(
                $database->quoteName(
                    '#__dc_discipline_memberships',
                    'membership'
                )
                . ' ON '
                . $database->quoteName(
                    'membership.discipline_id'
                )
                . ' = '
                . $database->quoteName('discipline.id')
                . ' AND '
                . $database->quoteName('membership.user_id')
                . ' = :user_id'
            )
            ->where(
                $database->quoteName('discipline.published')
                . ' = :published'
            )
            ->order(
                $database->quoteName('selected') . ' DESC'
            )
            ->order(
                $database->quoteName('translation.title') . ' ASC'
            )
            ->bind(
                ':language',
                $language,
                ParameterType::STRING
            )
            ->bind(
                ':user_id',
                $userId,
                ParameterType::INTEGER
            )
            ->bind(
                ':published',
                $published,
                ParameterType::INTEGER
            );

        return $query;
    }
}
