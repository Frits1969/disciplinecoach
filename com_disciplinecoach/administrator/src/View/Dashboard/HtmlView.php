<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : HtmlView.php
 * Path        : administrator/src/View/Dashboard/HtmlView.php
 * Purpose     : Dashboard view for the admin side of the component.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-10-29
 * Modified    : 2026-10-31
 * Version     : 0.1.2
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\View\Dashboard;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

/**
 * Dashboard HTML View.
 */
class HtmlView extends BaseHtmlView
{
    /**
     * Displays the view.
     *
     * @param string|null $tpl Optional template name.
     */
    public function display($tpl = null): void
    {
        $document = Factory::getApplication()->getDocument();

        $document->addStyleSheet(
            '/media/com_disciplinecoach/css/dashboard.css'
        );

        parent::display($tpl);
    }
}
