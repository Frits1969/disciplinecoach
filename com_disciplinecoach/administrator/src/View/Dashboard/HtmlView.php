<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : HtmlView.php
 * Purpose     : Dashboard view for the admin side of the component.
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

namespace Fvl\Component\DisciplineCoach\Administrator\View\Dashboard;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

/**
 * Dashboard HTML View.
 */
class HtmlView extends BaseHtmlView
{
    /**
     * Displays the view.
     *
     * @param   string|null  $tpl  Optional template name.
     */
    public function display($tpl = null): void
    {
        parent::display($tpl);
    }
}
