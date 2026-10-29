<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : DisplayController.php
 * Purpose     : Standaard controller voor de admin-kant van het component.
 *               Handelt het "display" task af en toont de standaard view.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-10-29
 * Modified    : 2026-10-29
 * Version     : 0.1.0
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

/**
 * Standaard Display Controller.
 * Joomla roept deze controller aan bij het openen van het component
 * zonder expliciete task (default task = 'display').
 */
class DisplayController extends BaseController
{
    /**
     * De standaard view die getoond wordt.
     */
    protected $default_view = 'dashboard';
}
