<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : MembershipsController.php
 * Path        : administrator/src/Controller/MembershipsController.php
 * Purpose     : Memberships list controller.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-22
 * Modified    : 2026-11-22
 * Version     : 0.1.5
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;

class MembershipsController extends AdminController
{
    /**
     * Text prefix for messages.
     *
     * @var string
     */
    protected $text_prefix = 'COM_DISCIPLINECOACH';

    /**
     * Proxy for getModel.
     *
     * @param   string  $name    The model name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  \Joomla\CMS\MVC\Model\BaseDatabaseModel
     */
    public function getModel($name = 'Membership', $prefix = 'Administrator', $config = ['ignore_request' => true])
    {
        return parent::getModel($name, $prefix, $config);
    }

    /**
     * Method to add a new record.
     *
     * @return  void
     */
    public function add(): void
    {
        $this->setRedirect(
            'index.php?option=com_disciplinecoach&view=membership&layout=edit'
        );
    }
}
