<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : HtmlView.php
 * Path        : administrator/src/View/Memberships/HtmlView.php
 * Purpose     : Memberships overview view.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-21
 * Modified    : 2026-11-25
 * Version     : 0.1.5
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\View\Memberships;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Uri\Uri;

class HtmlView extends BaseHtmlView
{
        protected function addToolbar(): void
    {
        $app = Factory::getApplication();

        ToolbarHelper::title(
            Text::_('COM_DISCIPLINECOACH_COMPONENT_TITLE'),
            'users'
        );

        ToolbarHelper::addNew('memberships.add');

        ToolbarHelper::deleteList(
            Text::_('COM_DISCIPLINECOACH_CONFIRM_DELETE'),
            'memberships.delete'
        );
    }

    protected $items;

    public function display($tpl = null): void
    {
        $document = Factory::getApplication()->getDocument();

        $document->addStyleSheet(
            Uri::root(true)
            . '/media/com_disciplinecoach/css/memberships.css'
        );

        $this->items = $this->get('Items');

        $this->addToolbar();

        parent::display($tpl);
    }

}
