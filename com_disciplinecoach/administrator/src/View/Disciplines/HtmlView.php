<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : HtmlView.php
 * Path        : administrator/src/View/Disciplines/HtmlView.php
 * Purpose     : Displays the Disciplines administrator overview.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-10-31
 * Modified    : 2026-11-08
 * Version     : 0.1.2
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

/**
 * Disciplines HTML View.
 */
class HtmlView extends BaseHtmlView
{
    /**
     * Disciplines retrieved from the database.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Displays the view.
     *
     * @param string|null $tpl Optional template name.
     *
     * @return void
     */
    public function display($tpl = null): void
    {
        $document = Factory::getApplication()->getDocument();

        $document->addStyleSheet(
            \Joomla\CMS\Uri\Uri::root()
            . 'media/com_disciplinecoach/css/disciplines.css'
        );
        $wa = $document->getWebAssetManager();

        $wa->registerAndUseScript(
            'com_disciplinecoach.disciplines',
            'media/com_disciplinecoach/js/disciplines.js'
        );

        $db = Factory::getDbo();

        $app = Factory::getApplication();

        $order = $app->input->getCmd(
            'order',
            'title'
        );

        $search = trim(
            $app->input->getString(
                'search',
                ''
            )
        );

        $status = $app->input->getString(
            'status',
            ''
        );

        $direction = strtoupper(
            $app->input->getCmd(
                'direction',
                'ASC'
            )
        );

        $allowed = [
            'title',
            'alias',
            'published'
        ];

        if (!in_array($order, $allowed))
        {
            $order = 'title';
        }

        if (!in_array($direction, ['ASC', 'DESC']))
        {
            $direction = 'ASC';
        }

        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__dc_disciplines'));

        if ($search !== '')
        {
            $searchTerm = '%' . $search . '%';

            $query->where(
                '(' .
                $db->quoteName('title')
                . ' LIKE '
                . $db->quote($searchTerm)
                . ' OR ' .
                $db->quoteName('alias')
                . ' LIKE '
                . $db->quote($searchTerm)
                . ')'
            );
        }

        if ($status !== '')
        {
            $query->where(
                $db->quoteName('published')
                . ' = '
                . (int) $status
            );
        }

        $query->order(
            $db->quoteName($order)
            . ' '
            . $direction
        );

        $db->setQuery($query);

        $this->items = $db->loadObjectList();

        parent::display($tpl);
    }
}
