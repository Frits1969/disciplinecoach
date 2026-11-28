<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : HtmlView.php
 * Path        : administrator/src/View/Membership/HtmlView.php
 * Purpose     : Membership edit view.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-21
 * Modified    : 2026-11-27
 * Version     : 0.1.5
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\View\Membership;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;

class HtmlView extends BaseHtmlView
{
    /**
     * Add toolbar.
     *
     * @return void
     */
    protected function addToolbar(): void
    {
        ToolbarHelper::title(
            Text::_('COM_DISCIPLINECOACH_COMPONENT_TITLE'),
            'users'
        );

        ToolbarHelper::apply('membership.apply');

        ToolbarHelper::save('membership.save');

        ToolbarHelper::save2new('membership.save2new');

        ToolbarHelper::cancel(
            'membership.cancel',
            'JTOOLBAR_CLOSE'
        );
    }

    /**
     * Form object.
     *
     * @var \Joomla\CMS\Form\Form
     */
    protected $form;

    /**
     * Item object.
     *
     * @var object
     */
    protected $item;

    /**
     * Display the view.
     *
     * @param string|null $tpl
     *
     * @return void
     */
    public function display($tpl = null): void
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        $this->addToolbar();

        parent::display($tpl);
    }
}
