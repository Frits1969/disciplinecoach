<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : MembershipsModel.php
 * Path        : administrator/src/Model/MembershipsModel.php
 * Purpose     : Memberships overview model.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-21
 * Modified    : 2026-11-24
 * Version     : 0.1.5
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;

class MembershipsModel extends ListModel
{
    /**
     * Build the list query.
     *
     * @return \Joomla\Database\DatabaseQuery
     */
    protected function getListQuery()
    {
        $db = Factory::getContainer()->get('DatabaseDriver');

        $query = $db->getQuery(true);

        $app = Factory::getApplication();

        $language = $app->getLanguage()->getTag();

        $search = trim(
            (string) $app->input->getString(
                'filter_search',
                ''
            )
        );

        $moderator = $app->input->getString(
            'filter_moderator',
            ''
        );

        $order = $app->input->getCmd(
            'order',
            'trainer_name'
        );

        $direction = strtoupper(
            $app->input->getCmd(
                'direction',
                'ASC'
            )
        );

        if (!in_array($direction, ['ASC', 'DESC']))
        {
            $direction = 'ASC';
        }

        $query
            ->select([
                'm.id',
                'm.user_id',
                'm.discipline_id',
                'm.is_moderator',
                'm.created',
                'u.name AS trainer_name',
                'dl.title AS discipline_title'
            ])
            ->from(
                $db->quoteName(
                    '#__dc_discipline_memberships',
                    'm'
                )
            )
            ->join(
                'INNER',
                $db->quoteName('#__users', 'u')
                . ' ON u.id = m.user_id'
            )
            ->join(
                'INNER',
                $db->quoteName(
                    '#__dc_disciplines_lang',
                    'dl'
                )
                . ' ON dl.discipline_id = m.discipline_id'
                . ' AND dl.language = '
                . $db->quote($language)
            );

            if ($search !== '')
            {
                $search = '%' . $db->escape(
                    $search,
                    true
                ) . '%';

                $query->where(
                    '('
                    . 'u.name LIKE '
                    . $db->quote($search, false)
                    . ' OR '
                    . 'dl.title LIKE '
                    . $db->quote($search, false)
                    . ')'
                );
            }

            if ($moderator !== '')
            {
                $query->where(
                    'm.is_moderator = '
                    . (int) $moderator
                );
            }

        switch ($order)
        {
            case 'discipline_title':
                $orderBy = 'dl.title';
                break;

            case 'is_moderator':
                $orderBy = 'm.is_moderator';
                break;

            case 'created':
                $orderBy = 'm.created';
                break;

            case 'trainer_name':
            default:
                $orderBy = 'u.name';
                break;
        }

        $query->order(
            $db->escape(
                $orderBy . ' ' . $direction
            )
        );

        return $query;
    }
}
