<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : DisciplineModel.php
 * Path        : administrator/src/Model/DisciplineModel.php
 * Purpose     : Handles data operations for a single discipline.
 *               Supports loading, saving and validating discipline data.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-05
 * Modified    : 2026-11-05
 * Version     : 0.1.2
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\FormModel;

class DisciplineModel extends FormModel
{
    public function getForm($data = [], $loadData = true)
    {
        return $this->loadForm(
            'com_disciplinecoach.discipline',
            'discipline',
            [
                'control' => 'jform',
                'load_data' => $loadData
            ]
        );
    }

    protected function loadFormData()
    {
        return [];
    }
}
