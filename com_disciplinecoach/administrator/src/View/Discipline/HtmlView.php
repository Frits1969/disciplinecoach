<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : HtmlView.php
 * Path        : administrator/src/View/Discipline/HtmlView.php
 * Purpose     : Displays the Discipline administrator form view.
 *               Used for creating and editing disciplines.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-03
 * Modified    : 2026-11-04
 * Version     : 0.1.2
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\View\Discipline;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

/**
 * Discipline HTML View.
 */
class HtmlView extends BaseHtmlView
{
    /**
     * Current discipline record.
     *
     * @var object|null
     */
        protected $item = null;

        protected $form = null;

    /**
     * Displays the view.
     *
     * @param string|null $tpl Optional template name.
     *
     * @return void
     */
    public function display($tpl = null): void
    {
        $app = Factory::getApplication();

        $id = $app->input->getInt('id', 0);

        $this->item = null;

        if ($id > 0)
        {
            $db = Factory::getDbo();

            $query = $db->getQuery(true)
                ->select('*')
                ->from($db->quoteName('#__dc_disciplines'))
                ->where(
                    $db->quoteName('id') . ' = ' . (int) $id
                );

            $db->setQuery($query);

            $this->item = $db->loadObject();
        }

        $model = $this->getModel();

        $this->form = $model->getForm();

        if ($this->item)
        {
            $this->form->bind(
                (array) $this->item
            );
        }

        parent::display($tpl);
    }
}
