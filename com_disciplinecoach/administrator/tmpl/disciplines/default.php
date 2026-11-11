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
 * Modified    : 2026-11-10
 * Version     : 0.1.3
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
?>

<form id="adminForm" action="index.php?option=com_disciplinecoach" method="post">
    <div class="container-fluid">

        <div class="dc-disciplines-header">

            <h1><?php echo Text::_('COM_DISCIPLINECOACH_DISCIPLINES'); ?></h1>

            <p>
                <?php echo Text::_('COM_DISCIPLINECOACH_DISCIPLINES_DESC'); ?>
            </p>

        </div>

        <div class="dc-toolbar mb-3">

            <a href="index.php?option=com_disciplinecoach&view=discipline" class="btn btn-success">
                <?php echo Text::_('COM_DISCIPLINECOACH_NEW_DISCIPLINE'); ?>
            </a>

            <div class="btn-group">

                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <?php echo Text::_('COM_DISCIPLINECOACH_ACTIONS'); ?>
                </button>

                <ul class="dropdown-menu">

                    <li>
                        <a class="dropdown-item" href="#" onclick="
        document.querySelector('[name=task]').value='disciplines.publish';
        document.getElementById('adminForm').submit();
        return false;
    ">
                            <?php echo Text::_('COM_DISCIPLINECOACH_PUBLISH_SELECTED'); ?>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#" onclick="
        document.querySelector('[name=task]').value='disciplines.unpublish';
        document.getElementById('adminForm').submit();
        return false;
    ">
                            <?php echo Text::_('COM_DISCIPLINECOACH_UNPUBLISH_SELECTED'); ?>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#" onclick="
                            document.querySelector('[name=task]').value='disciplines.delete';
                            document.getElementById('adminForm').submit();
                            return false;
                        ">
                            <?php echo Text::_('COM_DISCIPLINECOACH_DELETE_SELECTED'); ?>
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
                        placeholder="<?php echo Text::_('COM_DISCIPLINECOACH_SEARCH_DISCIPLINES'); ?>">

                    <button type="submit" class="btn btn-primary">
                        <?php echo Text::_('COM_DISCIPLINECOACH_SEARCH'); ?>
                    </button>

                </div>

            </div>

            <div class="col-md-3">

                <select class="form-select" name="status" onchange="this.form.submit();">

                    <option value="">
                        <?php echo Text::_('COM_DISCIPLINECOACH_ALL_STATUSES'); ?>
                    </option>

                    <option value="1" <?php echo (($_GET['status'] ?? '') === '1') ? 'selected' : ''; ?>>
                        <?php echo Text::_('JPUBLISHED'); ?>
                    </option>

                    <option value="0" <?php echo (($_GET['status'] ?? '') === '0') ? 'selected' : ''; ?>>
                        <?php echo Text::_('JUNPUBLISHED'); ?>
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
                                <input type="checkbox" id="checkAll" class="dc-discipline-checkbox"
                                    onclick="event.stopPropagation();">
                            </th>

                            <th width="90">
                                <?php echo Text::_('COM_DISCIPLINECOACH_IMAGE'); ?>
                            </th>

                            <th>
                                <a
                                    href="index.php?option=com_disciplinecoach&view=disciplines&order=title&direction=ASC">
                                    <?php echo Text::_('COM_DISCIPLINECOACH_DISCIPLINE'); ?> ▲
                                </a>

                                <a
                                    href="index.php?option=com_disciplinecoach&view=disciplines&order=title&direction=DESC">
                                    ▼
                                </a>
                            </th>

                            <th>
                                <a
                                    href="index.php?option=com_disciplinecoach&view=disciplines&order=alias&direction=ASC">
                                    <?php echo Text::_('COM_DISCIPLINECOACH_ALIAS'); ?> ▲
                                </a>

                                <a
                                    href="index.php?option=com_disciplinecoach&view=disciplines&order=alias&direction=DESC">
                                    ▼
                                </a>
                            </th>


                            <th>
                                <a
                                    href="index.php?option=com_disciplinecoach&view=disciplines&order=published&direction=DESC">
                                    <?php echo Text::_('COM_DISCIPLINECOACH_PUBLISHED'); ?> ▲
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
                                <?php echo Text::_('COM_DISCIPLINECOACH_NO_DISCIPLINES_FOUND'); ?>
                            </td>

                        </tr>

                        <?php else : ?>

                        <?php foreach ($this->items as $item) : ?>

                        <tr class="dc-row-clickable"
                            onclick="window.location='index.php?option=com_disciplinecoach&view=discipline&id=<?php echo (int) $item->id; ?>&language=<?php echo rawurlencode((string) ($item->language ?? ''));  ?>';">

                            <td>
                                <input type="checkbox" class="dc-discipline-checkbox" name="cid[]"
                                    value="<?php echo (int) $item->id; ?>" onclick="event.stopPropagation();">
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
                                    <?php echo Text::_('JPUBLISHED'); ?>
                                </span>
                                <?php else : ?>
                                <span class="dc-status-unpublished">
                                    <?php echo Text::_('JUNPUBLISHED'); ?>
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

        <?php echo HTMLHelper::_('form.token'); ?>
</form>

</div>
