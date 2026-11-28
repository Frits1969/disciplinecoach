<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : MembershipController.php
 * Path        : administrator/src/Controller/MembershipController.php
 * Purpose     : Membership edit controller.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-21
 * Modified    : 2026-11-21
 * Version     : 0.1.5
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;

class MembershipController extends FormController
{
    /**
     * Text prefix for messages.
     *
     * @var string
     */
    protected $text_prefix = 'COM_DISCIPLINECOACH';

    /**
     * View list redirect.
     *
     * @var string
     */
    protected $view_list = 'memberships';
}
