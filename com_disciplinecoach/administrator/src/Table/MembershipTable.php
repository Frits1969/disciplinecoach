<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : MembershipTable.php
 * Path        : administrator/src/Table/MembershipTable.php
 * Purpose     : Database table class for discipline memberships.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-22
 * Version     : 0.1.5
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\Database\ParameterType;

/**
 * Membership Table.
 */
class MembershipTable extends Table
{
    /**
     * Constructor.
     *
     * @param   DatabaseDriver  $db  Database driver object.
     */
    public function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__dc_discipline_memberships', 'id', $db);
    }

    /**
     * Overloaded check function to validate data and uniqueness.
     *
     * @return  boolean  True if valid.
     */
    public function check(): bool
    {
        if (empty($this->user_id)) {
            $this->setError(Text::_('COM_DISCIPLINECOACH_ERROR_USER_REQUIRED'));
            return false;
        }

        if (empty($this->discipline_id)) {
            $this->setError(Text::_('COM_DISCIPLINECOACH_ERROR_DISCIPLINE_REQUIRED'));
            return false;
        }

        if (empty($this->created)) {
            $this->created = Factory::getDate()->toSql();
        }

        $db    = $this->getDatabase();
        $query = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__dc_discipline_memberships'))
            ->where($db->quoteName('user_id') . ' = :userId')
            ->where($db->quoteName('discipline_id') . ' = :disciplineId')
            ->bind(':userId', $this->user_id, ParameterType::INTEGER)
            ->bind(':disciplineId', $this->discipline_id, ParameterType::INTEGER);

        if (!empty($this->id)) {
            $query->where($db->quoteName('id') . ' != :id')
                ->bind(':id', $this->id, ParameterType::INTEGER);
        }

        if ((int) $db->setQuery($query)->loadResult() > 0) {
            $this->setError(Text::_('COM_DISCIPLINECOACH_ERROR_MEMBERSHIP_DUPLICATE'));
            return false;
        }

        return parent::check();
    }
}
