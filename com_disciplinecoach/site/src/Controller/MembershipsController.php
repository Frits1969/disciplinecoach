<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : MembershipsController.php
 * Path        : site/src/Controller/MembershipsController.php
 * Purpose     : Saves the discipline selections of the current Joomla user.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-12
 * Modified    : 2026-11-16
 * Version     : 0.1.4
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Session\Session;
use Joomla\Database\DatabaseInterface;
use Joomla\Database\ParameterType;
use RuntimeException;
use Throwable;

/**
 * Controller for personal discipline memberships.
 */
class MembershipsController extends BaseController
{
    /**
     * Saves the complete discipline selection of the current user.
     *
     * @return void
     */
    public function save(): void
    {
        $application = Factory::getApplication();

        if (!Session::checkToken('post')) {
            throw new RuntimeException(
                Text::_('JINVALID_TOKEN_NOTICE')
            );
        }

        $identity = $application->getIdentity();
        $userId   = (int) ($identity->id ?? 0);

        if ($userId <= 0) {
            $this->setRedirect(
                'index.php?option=com_users&view=login',
                Text::_('COM_DISCIPLINECOACH_LOGIN_REQUIRED'),
                'warning'
            );

            return;
        }

        $submittedDisciplines = $application
            ->getInput()
            ->post
            ->get('disciplines', [], 'array');

        $selectedIds = $this->getSelectedIds(
            $submittedDisciplines
        );

        /** @var DatabaseInterface $database */
        $database = Factory::getContainer()->get(
            DatabaseInterface::class
        );

        $transactionStarted = false;

        try {
            $validIds = $this->getValidDisciplineIds(
                $database,
                $selectedIds
            );

            if ($validIds !== $selectedIds) {
                throw new RuntimeException(
                    Text::_(
                        'COM_DISCIPLINECOACH_INVALID_DISCIPLINE_SELECTION'
                    )
                );
            }

            $database->transactionStart();
            $transactionStarted = true;

            $this->deleteExistingMemberships(
                $database,
                $userId
            );

            $this->insertMemberships(
                $database,
                $userId,
                $validIds
            );

            $database->transactionCommit();
            $transactionStarted = false;

            $this->setRedirect(
                $this->getSelectionUrl(),
                Text::_('COM_DISCIPLINECOACH_SELECTION_SAVED'),
                'message'
            );
        } catch (Throwable $exception) {
            if ($transactionStarted) {
                try {
                    $database->transactionRollback();
                } catch (Throwable $rollbackException) {
                    Log::add(
                        $rollbackException->getMessage(),
                        Log::ERROR,
                        'com_disciplinecoach'
                    );
                }
            }

            Log::add(
                $exception->getMessage(),
                Log::ERROR,
                'com_disciplinecoach'
            );

            $this->setRedirect(
                $this->getSelectionUrl(),
                Text::_('COM_DISCIPLINECOACH_SELECTION_SAVE_FAILED'),
                'error'
            );
        }
    }

    /**
     * Returns the discipline IDs marked as selected.
     *
     * @param array $submittedDisciplines Submitted form values.
     *
     * @return array
     */
    private function getSelectedIds(
        array $submittedDisciplines
    ): array {
        $selectedIds = [];

        foreach ($submittedDisciplines as $disciplineId => $selected) {
            $disciplineId = (int) $disciplineId;
            $selected     = (int) $selected;

            if ($disciplineId > 0 && $selected === 1) {
                $selectedIds[] = $disciplineId;
            }
        }

        $selectedIds = array_values(
            array_unique($selectedIds)
        );

        sort($selectedIds, SORT_NUMERIC);

        return $selectedIds;
    }

    /**
     * Returns the submitted IDs that belong to published disciplines.
     *
     * @param DatabaseInterface $database      Database connection.
     * @param array             $disciplineIds Submitted discipline IDs.
     *
     * @return array
     */
    private function getValidDisciplineIds(
        DatabaseInterface $database,
        array $disciplineIds
    ): array {
        if ($disciplineIds === []) {
            return [];
        }

        $published = 1;
        $query     = $database->createQuery();
        $parameters = $query->bindArray(
            $disciplineIds,
            ParameterType::INTEGER
        );

        $query
            ->select($database->quoteName('id'))
            ->from($database->quoteName('#__dc_disciplines'))
            ->where(
                $database->quoteName('published')
                . ' = :published'
            )
            ->where(
                $database->quoteName('id')
                . ' IN ('
                . implode(', ', $parameters)
                . ')'
            )
            ->order($database->quoteName('id') . ' ASC')
            ->bind(
                ':published',
                $published,
                ParameterType::INTEGER
            );

        $database->setQuery($query);

        $validIds = array_map(
            'intval',
            $database->loadColumn()
        );

        sort($validIds, SORT_NUMERIC);

        return $validIds;
    }

    /**
     * Removes all existing memberships of the current user.
     *
     * @param DatabaseInterface $database Database connection.
     * @param int               $userId   Joomla user ID.
     *
     * @return void
     */
    private function deleteExistingMemberships(
        DatabaseInterface $database,
        int $userId
    ): void {
        $query = $database->createQuery()
            ->delete(
                $database->quoteName(
                    '#__dc_discipline_memberships'
                )
            )
            ->where(
                $database->quoteName('user_id')
                . ' = :user_id'
            )
            ->bind(
                ':user_id',
                $userId,
                ParameterType::INTEGER
            );

        $database->setQuery($query);
        $database->execute();
    }

    /**
     * Inserts the selected disciplines for the current user.
     *
     * @param DatabaseInterface $database      Database connection.
     * @param int               $userId        Joomla user ID.
     * @param array             $disciplineIds Selected discipline IDs.
     *
     * @return void
     */
    private function insertMemberships(
        DatabaseInterface $database,
        int $userId,
        array $disciplineIds
    ): void {
        if ($disciplineIds === []) {
            return;
        }

        $created = Factory::getDate()->toSql();

        foreach ($disciplineIds as $disciplineId) {
            $disciplineId = (int) $disciplineId;

            $query = $database->createQuery()
                ->insert(
                    $database->quoteName(
                        '#__dc_discipline_memberships'
                    )
                )
                ->columns(
                    $database->quoteName(
                        [
                            'user_id',
                            'discipline_id',
                            'created',
                        ]
                    )
                )
                ->values(
                    ':user_id, :discipline_id, :created'
                )
                ->bind(
                    ':user_id',
                    $userId,
                    ParameterType::INTEGER
                )
                ->bind(
                    ':discipline_id',
                    $disciplineId,
                    ParameterType::INTEGER
                )
                ->bind(
                    ':created',
                    $created,
                    ParameterType::STRING
                );

            $database->setQuery($query);
            $database->execute();
        }
    }

    /**
     * Returns the frontend discipline selection URL.
     *
     * @return string
     */
    private function getSelectionUrl(): string
    {
        $input  = Factory::getApplication()->getInput();
        $itemId = $input->getInt('Itemid', 0);

        $url = 'index.php?option=com_disciplinecoach'
            . '&view=disciplines';

        if ($itemId > 0) {
            $url .= '&Itemid=' . $itemId;
        }

        return $url;
    }
}
