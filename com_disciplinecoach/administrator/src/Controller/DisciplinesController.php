<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : DisciplinesController.php
 * Path        : administrator/src/Controller/DisciplinesController.php
 * Purpose     : Handles overview actions for disciplines.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-10-31
 * Modified    : 2026-11-10
 * Version     : 0.1.3
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Session\Session;
use Joomla\Database\DatabaseInterface;
use RuntimeException;
use Throwable;

/**
 * Controller for the disciplines overview.
 */
class DisciplinesController extends BaseController
{
    /**
     * Default view.
     *
     * @var string
     */
    protected $default_view = 'disciplines';

    /**
     * Deletes the selected disciplines.
     *
     * @return void
     */
    public function delete(): void
    {
        $this->checkToken();

        $ids = $this->getSelectedIds();

        if (empty($ids)) {
            $this->redirectWithMessage(
                Text::_('COM_DISCIPLINECOACH_NO_DISCIPLINE_SELECTED'),
                'warning'
            );

            return;
        }

        try {
            $database = Factory::getContainer()->get(
                DatabaseInterface::class
            );

            $query = $database->createQuery()
                ->delete(
                    $database->quoteName('#__dc_disciplines')
                )
                ->where(
                    $database->quoteName('id')
                    . ' IN ('
                    . implode(',', $ids)
                    . ')'
                );

            $database->setQuery($query);
            $database->execute();

            $this->redirectWithMessage(
                Text::plural(
                    'COM_DISCIPLINECOACH_DISCIPLINES_DELETED',
                    count($ids)
                ),
                'message'
            );
        } catch (Throwable $exception) {
            $this->redirectWithMessage(
                Text::_('COM_DISCIPLINECOACH_ERROR_DELETE_FAILED'),
                'error'
            );
        }
    }

    /**
     * Publishes the selected disciplines.
     *
     * @return void
     */
    public function publish(): void
    {
        $this->changePublishedState(1);
    }

    /**
     * Unpublishes the selected disciplines.
     *
     * @return void
     */
    public function unpublish(): void
    {
        $this->changePublishedState(0);
    }

    /**
     * Changes the publication state of selected disciplines.
     *
     * @param int $published New publication state.
     *
     * @return void
     */
    private function changePublishedState(int $published): void
    {
        $this->checkToken();

        $ids = $this->getSelectedIds();

        if (empty($ids)) {
            $this->redirectWithMessage(
                Text::_('COM_DISCIPLINECOACH_NO_DISCIPLINE_SELECTED'),
                'warning'
            );

            return;
        }

        try {
            $database = Factory::getContainer()->get(
                DatabaseInterface::class
            );

            $query = $database->createQuery()
                ->update(
                    $database->quoteName('#__dc_disciplines')
                )
                ->set(
                    $database->quoteName('published')
                    . ' = '
                    . $published
                )
                ->where(
                    $database->quoteName('id')
                    . ' IN ('
                    . implode(',', $ids)
                    . ')'
                );

            $database->setQuery($query);
            $database->execute();

            $messageKey = $published === 1
                ? 'COM_DISCIPLINECOACH_DISCIPLINES_PUBLISHED'
                : 'COM_DISCIPLINECOACH_DISCIPLINES_UNPUBLISHED';

            $this->redirectWithMessage(
                Text::plural(
                    $messageKey,
                    count($ids)
                ),
                'message'
            );
        } catch (Throwable $exception) {
            $this->redirectWithMessage(
                Text::_('COM_DISCIPLINECOACH_ERROR_STATE_CHANGE_FAILED'),
                'error'
            );
        }
    }

    /**
     * Returns the selected discipline IDs.
     *
     * @return array
     */
    private function getSelectedIds(): array
    {
        $input = Factory::getApplication()->getInput();

        $ids = $input->post->get(
            'cid',
            [],
            'array'
        );

        $ids = array_map(
            'intval',
            $ids
        );

        $ids = array_filter(
            $ids,
            static function (int $id): bool {
                return $id > 0;
            }
        );

        return array_values(
            array_unique($ids)
        );
    }

    /**
     * Checks the Joomla form token.
     *
     * @return void
     */
    private function checkToken(): void
    {
        if (!Session::checkToken()) {
            throw new RuntimeException(
                Text::_('JINVALID_TOKEN_NOTICE')
            );
        }
    }

    /**
     * Redirects to the disciplines overview.
     *
     * @param string $message     Message for the administrator.
     * @param string $messageType Joomla message type.
     *
     * @return void
     */
    private function redirectWithMessage(
        string $message,
        string $messageType
    ): void {
        $this->setRedirect(
            'index.php?option=com_disciplinecoach'
            . '&view=disciplines',
            $message,
            $messageType
        );
    }
}
