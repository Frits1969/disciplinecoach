<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : default.php
 * Path        : administrator/tmpl/discipline/default.php
 * Purpose     : Displays the Discipline administrator form.
 *               Allows administrators to create and edit disciplines.
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

defined('_JEXEC') or die;
?>

<div class="container-fluid">

    <h1>New Discipline</h1>

    <form action="index.php?option=com_disciplinecoach&task=discipline.save" method="post">
        <input type="hidden" name="id" value="<?php echo (int) ($this->item->id ?? 0); ?>">

        <div class="mb-3">
            <label class="form-label">
                Name
            </label>

            <input type="text" class="form-control" name="title"
                value="<?php echo htmlspecialchars($this->item->title ?? ''); ?>">

        </div>

        <div class="mb-3">
            <label class="form-label">
                Alias
            </label>

            <input type="text" class="form-control" name="alias"
                value="<?php echo htmlspecialchars($this->item->alias ?? ''); ?>">
        </div>

        <div class="form-check mb-3">

            <input class="form-check-input" type="checkbox" name="published"
                <?php echo (($this->item->published ?? 1) == 1) ? 'checked' : ''; ?>>

            <label class="form-check-label">
                Published
            </label>

        </div>

        <div class="mb-3">

            <?php echo $this->form->renderField('image'); ?>

        </div>

        <button type="submit" class="btn btn-success">
            Save
        </button>
        <input type="hidden" name="task" value="discipline.save">

        <a href="index.php?option=com_disciplinecoach&view=disciplines" class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>
