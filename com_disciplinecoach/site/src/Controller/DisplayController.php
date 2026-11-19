<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : DisplayController.php
 * Path        : site/src/Controller/DisplayController.php
 * Purpose     : Handles frontend display requests for DisciplineCoach.
 *               Uses the disciplines view as the default frontend view.
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

namespace Fvl\Component\DisciplineCoach\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

/**
 * Frontend display controller.
 */
class DisplayController extends BaseController
{
    /**
     * Default frontend view.
     *
     * @var string
     */
    protected $default_view = 'disciplines';

    /**
     * Displays the requested frontend view.
     *
     * @param bool  $cachable  Whether the view can be cached.
     * @param array $urlparams Safe URL parameters used while caching.
     *
     * @return static
     */
    public function display(
        $cachable = false,
        $urlparams = []
    ): static {
        $safeUrlParams = [
            'id'       => 'INT',
            'language' => 'CMD',
            'limit'    => 'UINT',
            'start'    => 'UINT',
        ];

        return parent::display(
            $cachable,
            array_merge($safeUrlParams, $urlparams)
        );
    }
}
