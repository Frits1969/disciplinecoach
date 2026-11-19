<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : default.php
 * Path        : site/tmpl/disciplines/default.php
 * Purpose     : Displays the frontend discipline selection page.
 *               Registered users can select multiple disciplines.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-11
 * Modified    : 2026-11-16
 * Version     : 0.1.4
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
use Joomla\CMS\Uri\Uri;

$webAssetManager = Factory::getApplication()
    ->getDocument()
    ->getWebAssetManager();

Factory::getApplication()
    ->getDocument()
    ->addStyleSheet(
        Uri::root(true)
        . '/media/com_disciplinecoach/css/disciplines-site.css'
    );

Factory::getApplication()
    ->getDocument()
    ->addScript(
        Uri::root(true)
        . '/media/com_disciplinecoach/js/disciplines-selection.js',
        [],
        ['defer' => true]
    );

$selectedItems   = [];
$unselectedItems = [];

foreach ($this->items as $item) {
    if ((int) $item->selected === 1) {
        $selectedItems[] = $item;
    } else {
        $unselectedItems[] = $item;
    }
}

$items = array_merge(
    $selectedItems,
    $unselectedItems
);

/**
 * Builds a usable image URL from a Joomla Media Manager value.
 *
 * Supported stored values include:
 * - disciplines/badminton.jpg
 * - images/disciplines/badminton.jpg
 * - images/disciplines/badminton.jpg#joomlaImage://...
 *
 * @param string $storedImage Stored database value.
 *
 * @return string
 */
$getImageUrl = static function (string $storedImage): string {
    $imagePath = trim($storedImage);

    if ($imagePath === '') {
        return '';
    }

    $imagePath = explode('#', $imagePath, 2)[0];
    $imagePath = str_replace('\\', '/', $imagePath);
    $imagePath = ltrim($imagePath, '/');

    if ($imagePath === '') {
        return '';
    }

    if (str_starts_with($imagePath, 'images/')) {
        return Uri::root(true) . '/' . $imagePath;
    }

    return Uri::root(true) . '/images/' . $imagePath;
};
?>

<div class="dc-selection-page">
    <header class="dc-selection-header">
        <h1 class="dc-selection-title">
            <?php echo Text::_('COM_DISCIPLINECOACH_SELECT_DISCIPLINES'); ?>
        </h1>

        <p class="dc-selection-introduction">
            <?php
            echo Text::_(
                'COM_DISCIPLINECOACH_SELECT_DISCIPLINES_INTRODUCTION'
            );
            ?>
        </p>
    </header>

    <?php if (empty($items)) : ?>
    <div class="alert alert-info">
        <?php
            echo Text::_(
                'COM_DISCIPLINECOACH_NO_DISCIPLINES_AVAILABLE'
            );
            ?>
    </div>

    <?php elseif (!$this->isLoggedIn) : ?>
    <div class="alert alert-info dc-login-message">
        <p>
            <?php
                echo Text::_(
                    'COM_DISCIPLINECOACH_LOGIN_TO_SELECT_DISCIPLINES'
                );
                ?>
        </p>

        <div class="dc-login-actions">
            <a class="btn btn-primary" href="<?php
                        echo htmlspecialchars(
                            $this->loginUrl,
                            ENT_QUOTES,
                            'UTF-8'
                        );
                    ?>">
                <?php echo Text::_('JLOGIN'); ?>
            </a>

            <a class="btn btn-secondary" href="<?php
                        echo htmlspecialchars(
                            $this->registrationUrl,
                            ENT_QUOTES,
                            'UTF-8'
                        );
                    ?>">
                <?php
                    echo Text::_(
                        'COM_DISCIPLINECOACH_CREATE_ACCOUNT'
                    );
                    ?>
            </a>
        </div>
    </div>

    <div class="dc-discipline-grid">
        <?php foreach ($items as $item) : ?>
        <?php
                $imageUrl = $getImageUrl(
                    (string) ($item->image ?? '')
                );
                ?>

        <article class="dc-discipline-card dc-is-disabled">
            <div class="dc-discipline-image-wrapper">
                <?php if ($imageUrl !== '') : ?>
                <img class="dc-discipline-image" src="<?php
                                    echo htmlspecialchars(
                                        $imageUrl,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                ?>" alt="" loading="lazy">
                <?php else : ?>
                <div class="dc-discipline-image-placeholder" aria-hidden="true"></div>
                <?php endif; ?>
            </div>

            <div class="dc-discipline-card-footer">
                <span class="dc-discipline-name">
                    <?php
                            echo htmlspecialchars(
                                (string) $item->title,
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>
                </span>
            </div>
        </article>
        <?php endforeach; ?>
    </div>

    <?php else : ?>
    <form id="dc-discipline-selection-form" action="<?php
                echo Route::_(
                    'index.php?option=com_disciplinecoach'
                    . '&task=memberships.save'
                );
            ?>" method="post">
        <div class="dc-discipline-grid" id="dc-discipline-grid">
            <?php foreach ($items as $item) : ?>
            <?php
                    $disciplineId = (int) $item->id;
                    $isSelected   = (int) $item->selected === 1;
                    $imageUrl     = $getImageUrl(
                        (string) ($item->image ?? '')
                    );

                    $cardClass = 'dc-discipline-card';
                    $cardClass .= $isSelected
                        ? ' dc-is-selected'
                        : ' dc-is-unselected';
                    ?>

            <label class="<?php echo $cardClass; ?>" data-discipline-card for="discipline-<?php echo $disciplineId; ?>">
                <span class="dc-discipline-image-wrapper">
                    <?php if ($imageUrl !== '') : ?>
                    <img class="dc-discipline-image" src="<?php
                                        echo htmlspecialchars(
                                            $imageUrl,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );
                                    ?>" alt="" loading="lazy">
                    <?php else : ?>
                    <span class="dc-discipline-image-placeholder" aria-hidden="true"></span>
                    <?php endif; ?>
                </span>

                <span class="dc-discipline-card-footer">
                    <input type="checkbox" class="dc-discipline-checkbox" id="discipline-<?php
                                    echo $disciplineId;
                                ?>" name="disciplines[<?php
                                    echo $disciplineId;
                                ?>]" value="1" data-discipline-checkbox <?php echo $isSelected ? 'checked' : ''; ?>>

                    <span class="dc-discipline-name">
                        <?php
                                echo htmlspecialchars(
                                    (string) $item->title,
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                                ?>
                    </span>
                </span>
            </label>
            <?php endforeach; ?>
        </div>

        <div class="dc-selection-actions">
            <button type="submit" class="btn btn-primary">
                <?php
                    echo Text::_(
                        'COM_DISCIPLINECOACH_SAVE_SELECTION'
                    );
                    ?>
            </button>
        </div>

        <input type="hidden" name="task" value="memberships.save">

        <?php echo HTMLHelper::_('form.token'); ?>
    </form>
    <?php endif; ?>
</div>