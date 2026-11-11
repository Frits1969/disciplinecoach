<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : HtmlView.php
 * Path        : administrator/src/View/Disciplines/HtmlView.php
 * Purpose     : Displays the administrator overview of disciplines.
 *               Loads translated discipline titles and aliases through
 *               the DisciplinesModel.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-10
 * Modified    : 2026-11-10
 * Version     : 0.1.3
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\View\Disciplines;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Uri\Uri;

/**
 * Disciplines administrator overview.
 */
class HtmlView extends BaseHtmlView
{
    /**
     * Disciplines displayed in the overview.
     *
     * @var array
     */
    protected array $items = [];

    /**
     * Displays the disciplines overview.
     *
     * @param string|null $tpl Optional template name.
     *
     * @return void
     */
    public function display($tpl = null): void
    {
        $document = Factory::getApplication()->getDocument();

        $document->addStyleSheet(
            Uri::root(true)
            . '/media/com_disciplinecoach/css/disciplines.css'
        );

        $this->items = $this->get('Items');

        parent::display($tpl);
    }
}
