<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : default.php
 * Purpose     : Administrator dashboard for DisciplineCoach.
 *               Provides navigation to the primary management modules.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-10-29
 * Modified    : 2026-10-30
 * Version     : 0.1.1
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

defined('_JEXEC') or die;
?>

<div class="container-fluid">

    <div class="dc-dashboard-header">
        <h1>DisciplineCoach</h1>
        <p>
            Beheer disciplines, trainers, aanvragen en configuratie vanuit één centrale omgeving.
        </p>
    </div>

    <div class="row">

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card dc-dashboard-tile h-100">
                <div class="card-body text-center">

                    <div class="dc-dashboard-icon">
                        <img src="/media/com_disciplinecoach/images/disciplines.png" alt="Disciplines">
                    </div>

                    <h3 class="dc-dashboard-title">
                        Disciplines
                    </h3>

                    <p class="dc-dashboard-description">
                        Beheer disciplines en discipline-afbeeldingen.
                    </p>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card dc-dashboard-tile h-100">
                <div class="card-body text-center">

                    <div class="dc-dashboard-icon">
                        <img src="/media/com_disciplinecoach/images/coaches.png" alt="Coaches">
                    </div>

                    <h3 class="dc-dashboard-title">
                        Coaches
                    </h3>

                    <p class="dc-dashboard-description">
                        Beheer trainers, moderators en discipline-koppelingen.
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
                        Requests
                    </h3>

                    <p class="dc-dashboard-description">
                        Verwerk aanvragen voor nieuwe disciplines.
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
                        Configuration
                    </h3>

                    <p class="dc-dashboard-description">
                        Terminologie, talen en systeeminstellingen.
                    </p>

                </div>
            </div>
        </div>

    </div>

</div>
