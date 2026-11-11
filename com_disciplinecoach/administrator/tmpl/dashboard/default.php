<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : default.php
 * Path        : administrator/tmpl/disciplines/default.php
 * Purpose     : Administrator dashboard for DisciplineCoach.
 *               Provides navigation to the primary management modules.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-10-29
 * Modified    : 2026-11-09
 * Version     : 0.1.3
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
?>

<div class="container-fluid">

    <div class="dc-dashboard-header">
        <h1>
            <?php echo Text::_('COM_DISCIPLINECOACH_DASHBOARD'); ?>
        </h1>
        <p>
            <?php echo Text::_('COM_DISCIPLINECOACH_DASHBOARD_DESCRIPTION'); ?>
        </p>

    </div>

    <div class="row">

        <div class="col-md-6 col-xl-3 mb-4">
            <a href="index.php?option=com_disciplinecoach&view=disciplines" class="text-decoration-none">
                <div class="card dc-dashboard-tile h-100">
                    <div class="card-body text-center">

                        <div class="dc-dashboard-icon">
                            <img src="/media/com_disciplinecoach/images/disciplines.png" alt="Disciplines">
                        </div>

                        <h3 class="dc-dashboard-title">
                            <?php echo Text::_('COM_DISCIPLINECOACH_DISCIPLINES'); ?>
                        </h3>

                        <p class="dc-dashboard-description">
                            <?php echo Text::_('COM_DISCIPLINECOACH_DISCIPLINES_DESC'); ?>
                        </p>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card dc-dashboard-tile h-100">
                <div class="card-body text-center">

                    <div class="dc-dashboard-icon">
                        <img src="/media/com_disciplinecoach/images/coaches.png" alt="Coaches">
                    </div>

                    <h3 class="dc-dashboard-title">
                        <?php echo Text::_('COM_DISCIPLINECOACH_COACHES'); ?>
                    </h3>

                    <p class="dc-dashboard-description">
                        <?php echo Text::_('COM_DISCIPLINECOACH_COACHES_DESC'); ?>
                    </p>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card dc-dashboard-tile h-100">
                <div class="card-body text-center">

                    <div class="dc-dashboard-icon">
                        <img src="/media/com_disciplinecoach/images/requests.png" alt="Requests">
                    </div>

                    <h3 class="dc-dashboard-title">
                        <?php echo Text::_('COM_DISCIPLINECOACH_REQUESTS'); ?>
                    </h3>

                    <p class="dc-dashboard-description">
                        <?php echo Text::_('COM_DISCIPLINECOACH_REQUESTS_DESC'); ?>
                    </p>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card dc-dashboard-tile h-100">
                <div class="card-body text-center">

                    <div class="dc-dashboard-icon">
                        <img src="/media/com_disciplinecoach/images/configuration.png" alt="Configuration">
                    </div>

                    <h3 class="dc-dashboard-title">
                        <?php echo Text::_('COM_DISCIPLINECOACH_CONFIGURATION'); ?>
                    </h3>

                    <p class="dc-dashboard-description">
                        <?php echo Text::_('COM_DISCIPLINECOACH_CONFIGURATION_DESC'); ?>
                    </p>

                </div>
            </div>
        </div>

    </div>

</div>
