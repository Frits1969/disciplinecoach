<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : DisciplineController.php
 * Path        : administrator/src/Controller/DisciplineController.php
 * Purpose     : Handles requests related to creating, editing, saving
 *               and deleting individual disciplines.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-03
 * Modified    : 2026-11-05
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

class DisciplineController extends BaseController
{
    public function save(): void
    {
        $db = \Joomla\CMS\Factory::getDbo();

        $id = (int) ($_POST['id'] ?? 0);

        $title = trim($_POST['title'] ?? '');
        $alias = strtolower(trim($_POST['alias'] ?? ''));
        $image = trim(
            $_POST['jform']['image'] ?? ''
        );

        $image = explode('#', $image)[0];

        $published = isset($_POST['published']) ? 1 : 0;

        /*
        * Controle op dubbele titel of alias.
        * Bij edit het huidige record uitsluiten.
        */
        $query = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__dc_disciplines'))
            ->where(
                '(' .
                'LOWER(' . $db->quoteName('title') . ') = '
                . $db->quote(strtolower($title))
                . ' OR ' .
                'LOWER(' . $db->quoteName('alias') . ') = '
                . $db->quote($alias)
                . ')'
            );

        if ($id > 0)
        {
            $query->where(
                $db->quoteName('id')
                . ' <> '
                . $id
            );
        }

        $db->setQuery($query);

        if ((int) $db->loadResult() > 0)
        {
            $this->setRedirect(
                'index.php?option=com_disciplinecoach&view=discipline&id=' . $id,
                'Deze discipline bestaat al.',
                'warning'
            );

            return;
        }

        try
        {
            /*
            * Nieuw record.
            */
            if ($id === 0)
            {
                $query = $db->getQuery(true);

                $columns = [
                    'title',
                    'alias',
                    'image',
                    'published',
                    'created',
                    'created_by'
                ];

                $values = [
                    $db->quote($title),
                    $db->quote($alias),
                    $db->quote($image),
                    (int) $published,
                    $db->quote(date('Y-m-d H:i:s')),
                    0
                ];

                $query
                    ->insert($db->quoteName('#__dc_disciplines'))
                    ->columns($db->quoteName($columns))
                    ->values(implode(',', $values));

                $db->setQuery($query);
                $db->execute();
            }
            else
            {
                /*
                * Bestaand record bijwerken.
                */
                $fields = [
                    $db->quoteName('title') . ' = ' . $db->quote($title),
                    $db->quoteName('alias') . ' = ' . $db->quote($alias),
                    $db->quoteName('image') . ' = ' . $db->quote($image),
                    $db->quoteName('published') . ' = ' . (int) $published,
                    $db->quoteName('modified') . ' = ' . $db->quote(date('Y-m-d H:i:s')),
                    $db->quoteName('modified_by') . ' = 0'
                ];

                $query = $db->getQuery(true)
                    ->update($db->quoteName('#__dc_disciplines'))
                    ->set($fields)
                    ->where(
                        $db->quoteName('id')
                        . ' = '
                        . $id
                    );

                $db->setQuery($query);
                $db->execute();
            }

            $this->setRedirect(
                'index.php?option=com_disciplinecoach&view=disciplines',
                'Discipline succesvol opgeslagen.',
                'message'
            );
        }
        catch (\Exception $e)
        {
            $this->setRedirect(
                'index.php?option=com_disciplinecoach&view=discipline&id=' . $id,
                'Er is een fout opgetreden tijdens het opslaan.',
                'error'
            );
        }
    }

}
