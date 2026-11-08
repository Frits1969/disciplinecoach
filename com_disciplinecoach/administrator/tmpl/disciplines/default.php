<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : default.php
 * Path        : administrator/tmpl/disciplines/default.php
 * Purpose     : Displays the Disciplines administrator overview.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-10-31
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

<form id="adminForm" action="index.php?option=com_disciplinecoach" method="post">
    <div class="container-fluid">

        <div class="dc-disciplines-header">

            <h1>Disciplines</h1>

            <p>
                Manage disciplines and discipline images.
            </p>

        </div>

        <div class="dc-toolbar mb-3">

            <a href="index.php?option=com_disciplinecoach&view=discipline" class="btn btn-success">
                New Discipline
            </a>

            <div class="btn-group">

                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Actions
                </button>

                <ul class="dropdown-menu">

                    <li>
                        <a class="dropdown-item" href="#" onclick="
        document.querySelector('[name=task]').value='disciplines.publish';
        document.getElementById('adminForm').submit();
        return false;
    ">
                            Publish Selected
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#" onclick="
        document.querySelector('[name=task]').value='disciplines.unpublish';
        document.getElementById('adminForm').submit();
        return false;
    ">
                            Unpublish Selected
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#" onclick="
                            document.querySelector('[name=task]').value='disciplines.delete';
                            document.getElementById('adminForm').submit();
                            return false;
                        ">
                            Delete Selected
                        </a>
                    </li>

                </ul>

            </div>

        </div>

        <div class="row mb-3">

            <div class="col-md-6">

                <div class="input-group">

                    <input type="text" class="form-control" name="search"
                        value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>"
                        placeholder="Search disciplines...">

                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>

                </div>

            </div>

            <div class="col-md-3">

                <select class="form-select" name="status" onchange="this.form.submit();">

                    <option value="">
                        All Statuses
                    </option>

                    <option value="1" <?php echo (($_GET['status'] ?? '') === '1') ? 'selected' : ''; ?>>
                        Published
                    </option>

                    <option value="0" <?php echo (($_GET['status'] ?? '') === '0') ? 'selected' : ''; ?>>
                        Unpublished
                    </option>

                </select>

            </div>

        </div>

        <div class="card">

            <div class="card-body">

                <table class="table table-striped">

                    <thead>

                        <tr>

                            <th width="40">
                                <input type="checkbox" id="checkAll" onclick="event.stopPropagation();">
                            </th>

                            <th width="90">
                                Image
                            </th>

                            <th>
                                <a
                                    href="index.php?option=com_disciplinecoach&view=disciplines&order=title&direction=ASC">
                                    Discipline ▲
                                </a>

                                <a
                                    href="index.php?option=com_disciplinecoach&view=disciplines&order=title&direction=DESC">
                                    ▼
                                </a>
                            </th>

                            <th>
                                <a
                                    href="index.php?option=com_disciplinecoach&view=disciplines&order=alias&direction=ASC">
                                    Alias ▲
                                </a>

                                <a
                                    href="index.php?option=com_disciplinecoach&view=disciplines&order=alias&direction=DESC">
                                    ▼
                                </a>
                            </th>


                            <th>
                                <a
                                    href="index.php?option=com_disciplinecoach&view=disciplines&order=published&direction=DESC">
                                    Published ▲
                                </a>

                                <a
                                    href="index.php?option=com_disciplinecoach&view=disciplines&order=published&direction=ASC">
                                    ▼
                                </a>
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (empty($this->items)) : ?>

                        <tr>

                            <td colspan="6">
                                No disciplines found.
                            </td>

                        </tr>

                        <?php else : ?>

                        <?php foreach ($this->items as $item) : ?>

                        <tr class="dc-row-clickable"
                            onclick="window.location='index.php?option=com_disciplinecoach&view=discipline&id=<?php echo (int) $item->id; ?>';">

                            <td>
                                <input type="checkbox" name="cid[]" value="<?php echo (int) $item->id; ?>"
                                    onclick="event.stopPropagation();">
                            </td>

                            <td>
                                <?php if (!empty($item->image)) : ?>

                                <?php $imageUrl = \Joomla\CMS\Uri\Uri::root() . ltrim($item->image, '/'); ?>

                                <img src="<?php echo htmlspecialchars($imageUrl); ?>"
                                    alt="<?php echo htmlspecialchars($item->title); ?>" style="
                                        width:64px;
                                        height:64px;
                                        object-fit:contain;
                                        border-radius:4px;
                                ">
                                <?php else : ?>

                                -

                                <?php endif; ?>
                            </td>

                            <td>

                                <?php echo htmlspecialchars($item->title); ?>

                            </td>

                            <td>

                                <?php echo htmlspecialchars($item->alias); ?>

                            </td>

                            <td>

                                <?php if ((int) $item->published === 1) : ?>

                                <span class="dc-status-published">
                                    Published
                                </span>

                                <?php else : ?>

                                <span class="dc-status-unpublished">
                                    Unpublished
                                </span>

                                <?php endif; ?>

                            </td>

                        </tr>

                        <?php endforeach; ?>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>
        <input type="hidden" name="task" value="">
        <input type="hidden" name="view" value="disciplines">
</form>

</div>
