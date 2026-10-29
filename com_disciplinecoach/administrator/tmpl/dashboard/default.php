<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : default.php
 * Purpose     : Default administrator view template.
 *               Displays the DisciplineCoach dashboard and serves as
 *               the main entry point for component administration.
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

/**
 * Dashboard template for the DisciplineCoach component.
 *
 * @var  Joomla\CMS\MVC\View\HtmlView  $this
 */

defined('_JEXEC') or die;
?>
<div class="container-fluid">
    <h1 class="page-title">
        <span class="icon-list-2" aria-hidden="true"></span>
        DisciplineCoach
    </h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>Welkom bij het DisciplineCoach component.</p>
                    <p>Versie 0.1.0 — component is succesvol geladen.</p>
                </div>
            </div>
        </div>
    </div>
</div>
