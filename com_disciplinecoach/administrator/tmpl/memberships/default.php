<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : default.php
 * Path        : administrator/tmpl/memberships/default.php
 * Purpose     : Memberships overview template.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-21
 * Modified    : 2026-11-24
 * Version     : 0.1.5
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

$app = Factory::getApplication();

$currentOrder = $app->input->getCmd('order', 'trainer_name');
$currentDir   = strtoupper($app->input->getCmd('dir', 'ASC'));

function dcSortDir(string $column, string $currentOrder, string $currentDir): string
{
    if ($column === $currentOrder)
    {
        return $currentDir === 'ASC' ? 'DESC' : 'ASC';
    }

    return 'ASC';
}

function dcSortIcon(string $column, string $currentOrder, string $currentDir): string
{
    if ($column !== $currentOrder)
    {
        return '';
    }

    return $currentDir === 'ASC'
        ? ' ▲'
        : ' ▼';
}
?>

<form action="<?php echo Route::_('index.php?option=com_disciplinecoach&view=memberships'); ?>" method="post"
    name="adminForm" id="adminForm">

    <div class="container-fluid">
        <div class="dc-memberships-header">

            <h1>
                <?php echo $app->getMenu()->getActive()?->title
            ?? Text::_('COM_DISCIPLINECOACH_TRAINERS'); ?>
            </h1>

            <p>
                <?php echo Text::_('COM_DISCIPLINECOACH_TRAINERS_DESC'); ?>
            </p>

        </div>
        <div class="row mb-3">

            <div class="col-md-4">

                <input type="text" name="filter_search" class="form-control"
                    placeholder="<?php echo Text::_('COM_DISCIPLINECOACH_SEARCH_MEMBERSHIPS'); ?>" value="<?php echo htmlspecialchars(
                        (string) $app->input->getString(
                            'filter_search',
                            ''
                        ),
                        ENT_QUOTES,
                        'UTF-8'
                    ); ?>">
            </div>

            <div class="col-md-2">
                <?php
                    $currentModerator = (string) $app->input->getString(
                        'filter_moderator',
                        ''
                    );
                ?>

                <select name="filter_moderator" class="form-select">
                    <option value="" <?php echo $currentModerator === '' ? 'selected' : ''; ?>>
                        <?php echo Text::_('COM_DISCIPLINECOACH_ALL_MODERATORS'); ?>
                    </option>

                    <option value="1" <?php echo $currentModerator === '1' ? 'selected' : ''; ?>>
                        <?php echo Text::_('COM_DISCIPLINECOACH_MODERATOR'); ?>
                    </option>

                    <option value="0" <?php echo $currentModerator === '0' ? 'selected' : ''; ?>>
                        <?php echo Text::_('COM_DISCIPLINECOACH_NO_MODERATOR'); ?>
                    </option>
                </select>

            </div>

            <div class="col-md-2">

                <button type="submit" class="btn btn-primary">
                    <?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>
                </button>

            </div>

        </div>

        <table class="table table-striped table-hover dc-membership-table">

            <thead>

                <tr>

                    <th width="1%" class="text-center">
                        <input type="checkbox" name="checkall-toggle" value="" class="form-check-input"
                            title="<?php echo Text::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)">
                    </th>

                    <th width="5%">
                        ID
                    </th>

                    <th>
                        <a
                            href="index.php?option=com_disciplinecoach&view=memberships&order=trainer_name&direction=ASC">
                            <?php echo Text::_('COM_DISCIPLINECOACH_TRAINER'); ?> ▲
                        </a>

                        <a
                            href="index.php?option=com_disciplinecoach&view=memberships&order=trainer_name&direction=DESC">
                            ▼
                        </a>
                    </th>

                    <th>
                        <a
                            href="index.php?option=com_disciplinecoach&view=memberships&order=discipline_title&direction=ASC">
                            <?php echo Text::_('COM_DISCIPLINECOACH_DISCIPLINE'); ?> ▲
                        </a>

                        <a
                            href="index.php?option=com_disciplinecoach&view=memberships&order=discipline_title&direction=DESC">
                            ▼
                        </a>
                    </th>

                    <th>
                        <a
                            href="index.php?option=com_disciplinecoach&view=memberships&order=is_moderator&direction=ASC">
                            <?php echo Text::_('COM_DISCIPLINECOACH_MODERATOR'); ?> ▲
                        </a>

                        <a
                            href="index.php?option=com_disciplinecoach&view=memberships&order=is_moderator&direction=DESC">
                            ▼
                        </a>
                    </th>

                    <th>
                        <a href="index.php?option=com_disciplinecoach&view=memberships&order=created&direction=ASC">
                            <?php echo Text::_('COM_DISCIPLINECOACH_SINCE'); ?> ▲
                        </a>

                        <a href="index.php?option=com_disciplinecoach&view=memberships&order=created&direction=DESC">
                            ▼
                        </a>
                    </th>

                </tr>

            </thead>

            <tbody>

                <?php if (!empty($this->items)) : ?>

                <?php foreach ($this->items as $i => $item) : ?>

                <tr class="dc-row-clickable"
                    onclick="window.location='index.php?option=com_disciplinecoach&view=membership&layout=edit&id=<?php echo (int) $item->id; ?>';">

                    <td class="text-center" onclick="event.stopPropagation();">

                        <?php echo HTMLHelper::_(
                                    'grid.id',
                                    $i,
                                    $item->id
                                ); ?>

                    </td>

                    <td>
                        <?php echo (int) $item->id; ?>
                    </td>

                    <td>

                        <?php echo htmlspecialchars(
                                    $item->trainer_name,
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>

                    </td>

                    <td>

                        <?php echo htmlspecialchars(
                                    $item->discipline_title,
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>

                    </td>

                    <?php if ($item->is_moderator) : ?>

                    <td class="text-center">

                        <span class="dc-moderator-yes">
                            ✓
                        </span>

                    </td>

                    <?php else : ?>

                    <td class="text-center">

                        <span class="dc-moderator-no">
                            ✕
                        </span>

                    </td>

                    <?php endif; ?>

                    <td class="dc-membership-date">

                        <?php echo htmlspecialchars(
                                    $item->created,
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>

                    </td>

                </tr>

                <?php endforeach; ?>

                <?php else : ?>

                <tr>

                    <td colspan="6" class="text-center">

                        <?php echo Text::_(
                                'COM_DISCIPLINECOACH_NO_MEMBERSHIPS_FOUND'
                            ); ?>

                    </td>

                </tr>

                <?php endif; ?>

            </tbody>

        </table>

        <input type="hidden" name="task" value="">

        <input type="hidden" name="boxchecked" value="0">

        <?php echo HTMLHelper::_('form.token'); ?>

    </div>

</form>
