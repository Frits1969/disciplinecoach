<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : edit.php
 * Path        : administrator/tmpl/membership/edit.php
 * Purpose     : Membership edit form template.
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

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');
?>

<form
    action="<?php echo Route::_('index.php?option=com_disciplinecoach&layout=edit&id=' . (int) ($this->item->id ?? 0)); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate">

    <div class="row">

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header">

                    <h3 class="mb-0">
                        <?php echo Text::_('COM_DISCIPLINECOACH_MEMBERSHIP_DETAILS'); ?>
                    </h3>

                </div>

                <div class="card-body">

                    <?php echo $this->form->renderField('id'); ?>

                    <?php echo $this->form->renderField('user_id'); ?>

                    <?php echo $this->form->renderField('discipline_id'); ?>

                    <?php echo $this->form->renderField('is_moderator'); ?>

                </div>

            </div>

        </div>

    </div>

    <input type="hidden" name="task" value="">

    <?php echo HTMLHelper::_('form.token'); ?>

</form>
