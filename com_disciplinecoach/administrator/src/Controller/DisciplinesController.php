<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : DisciplinesController.php
 * Path        : administrator/src/Controller/DisciplinesController.php
 * Purpose     : Controller for the Disciplines administration view.
 *               Handles requests related to discipline management.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-10-31
 * Modified    : 2026-10-31
 * Version     : 0.1.2
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

/**
 * Disciplines Controller.
 */
class DisciplinesController extends BaseController
{
    /**
     * Default view.
     *
     * @var string
     */
    protected $default_view = 'disciplines';

    public function delete(): void
    {
        $ids = $_POST['cid'] ?? [];

        if (empty($ids))
        {
            $this->setRedirect(
                'index.php?option=com_disciplinecoach&view=disciplines',
                'Geen discipline geselecteerd.',
                'warning'
            );

            return;
        }

        $db = \Joomla\CMS\Factory::getDbo();

        $ids = array_map('intval', $ids);

        $query = $db->getQuery(true)
            ->delete($db->quoteName('#__dc_disciplines'))
            ->where(
                $db->quoteName('id')
                . ' IN ('
                . implode(',', $ids)
                . ')'
            );

        $db->setQuery($query);
        $db->execute();

        $this->setRedirect(
            'index.php?option=com_disciplinecoach&view=disciplines',
            count($ids) . ' discipline(s) verwijderd.',
            'message'
        );
    }

    public function publish(): void
    {
        $ids = $_POST['cid'] ?? [];

        if (empty($ids))
        {
            $this->setRedirect(
                'index.php?option=com_disciplinecoach&view=disciplines',
                'Geen discipline geselecteerd.',
                'warning'
            );

            return;
        }

        $db = \Joomla\CMS\Factory::getDbo();

        $ids = array_map('intval', $ids);

        $query = $db->getQuery(true)
            ->update($db->quoteName('#__dc_disciplines'))
            ->set(
                $db->quoteName('published') . ' = 1'
            )
            ->where(
                $db->quoteName('id')
                . ' IN ('
                . implode(',', $ids)
                . ')'
            );

        $db->setQuery($query);
        $db->execute();

        $this->setRedirect(
            'index.php?option=com_disciplinecoach&view=disciplines',
            count($ids) . ' discipline(s) gepubliceerd.',
            'message'
        );
    }

    public function unpublish(): void
    {
        $ids = $_POST['cid'] ?? [];

        if (empty($ids))
        {
            $this->setRedirect(
                'index.php?option=com_disciplinecoach&view=disciplines',
                'Geen discipline geselecteerd.',
                'warning'
            );

            return;
        }

        $db = \Joomla\CMS\Factory::getDbo();

        $ids = array_map('intval', $ids);

        $query = $db->getQuery(true)
            ->update($db->quoteName('#__dc_disciplines'))
            ->set(
                $db->quoteName('published') . ' = 0'
            )
            ->where(
                $db->quoteName('id')
                . ' IN ('
                . implode(',', $ids)
                . ')'
            );

        $db->setQuery($query);
        $db->execute();

        $this->setRedirect(
            'index.php?option=com_disciplinecoach&view=disciplines',
            count($ids) . ' discipline(s) gedepubliceerd.',
            'message'
        );
    }
}
