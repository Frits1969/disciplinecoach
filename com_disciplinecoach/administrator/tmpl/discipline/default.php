<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : default.php
 * Path        : administrator/tmpl/discipline/default.php
 * Purpose     : Displays the multilingual Discipline administrator form.
 *               Allows titles and aliases to be entered for every
 *               available content language.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-03
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

$itemId = (int) ($this->item->id ?? 0);
?>

<div class="container-fluid">
    <h1>
        <?php
        echo $itemId === 0
            ? Text::_('COM_DISCIPLINECOACH_NEW_DISCIPLINE')
            : Text::_('COM_DISCIPLINECOACH_EDIT_DISCIPLINE');
        ?>
    </h1>

    <form id="discipline-form" action="index.php?option=com_disciplinecoach&task=discipline.save" method="post">
        <input type="hidden" name="id" value="<?php echo $itemId; ?>">

        <input type="hidden" id="active-language" name="active_language" value="<?php
                echo htmlspecialchars(
                    $this->activeLanguage,
                    ENT_QUOTES,
                    'UTF-8'
                );
            ?>">

        <div class="card mb-4">
            <div class="card-header">
                <?php
                echo Text::_(
                    'COM_DISCIPLINECOACH_TRANSLATIONS'
                );
                ?>
            </div>

            <div class="card-body">
                <div class="nav nav-tabs mb-4" id="discipline-language-tabs" role="tablist">
                    <?php foreach ($this->languages as $languageCode => $language) : ?>
                    <?php
                        $isActive = (
                            $languageCode === $this->activeLanguage
                        );

                        $languageTitle = $language->title_native
                            ?? $language->title
                            ?? $languageCode;
                        ?>

                    <button type="button" class="nav-link<?php
                                echo $isActive ? ' active' : '';
                            ?>" data-language="<?php
                                echo htmlspecialchars(
                                    $languageCode,
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                            ?>" role="tab" aria-selected="<?php
                                echo $isActive ? 'true' : 'false';
                            ?>">
                        <?php
                            echo htmlspecialchars(
                                $languageTitle,
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>
                    </button>
                    <?php endforeach; ?>
                </div>

                <?php foreach ($this->languages as $languageCode => $language) : ?>
                <?php
                    $isActive = (
                        $languageCode === $this->activeLanguage
                    );

                    $translation = $this->translations[$languageCode]
                        ?? null;

                    $translationId = (int) (
                        $translation->id ?? 0
                    );

                    $title = (string) (
                        $translation->title ?? ''
                    );

                    $alias = (string) (
                        $translation->alias ?? ''
                    );
                    ?>

                <div class="discipline-language-panel" data-language-panel="<?php
                            echo htmlspecialchars(
                                $languageCode,
                                ENT_QUOTES,
                                'UTF-8'
                            );
                        ?>" <?php echo $isActive ? '' : 'hidden'; ?>>
                    <input type="hidden" name="translations[<?php
                                echo htmlspecialchars(
                                    $languageCode,
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                            ?>][id]" value="<?php echo $translationId; ?>">

                    <div class="mb-3">
                        <label class="form-label" for="discipline-title-<?php
                                    echo htmlspecialchars(
                                        $languageCode,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                ?>">
                            <?php
                                echo Text::_(
                                    'COM_DISCIPLINECOACH_FIELD_TITLE'
                                );
                                ?>
                        </label>

                        <input type="text" class="form-control" id="discipline-title-<?php
                                    echo htmlspecialchars(
                                        $languageCode,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                ?>" name="translations[<?php
                                    echo htmlspecialchars(
                                        $languageCode,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                ?>][title]" value="<?php
                                    echo htmlspecialchars(
                                        $title,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="discipline-alias-<?php
                                    echo htmlspecialchars(
                                        $languageCode,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                ?>">
                            <?php
                                echo Text::_(
                                    'COM_DISCIPLINECOACH_FIELD_ALIAS'
                                );
                                ?>
                        </label>

                        <input type="text" class="form-control" id="discipline-alias-<?php
                                    echo htmlspecialchars(
                                        $languageCode,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                ?>" name="translations[<?php
                                    echo htmlspecialchars(
                                        $languageCode,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                ?>][alias]" value="<?php
                                    echo htmlspecialchars(
                                        $alias,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                ?>" required>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mb-3">
            <?php echo $this->form->renderField('image'); ?>
        </div>

        <div class="mb-3">
            <?php echo $this->form->renderField('published'); ?>
        </div>

        <button type="submit" class="btn btn-success">
            <?php
            echo Text::_(
                'COM_DISCIPLINECOACH_SAVE_AND_CLOSE'
            );
            ?>
        </button>

        <a href="index.php?option=com_disciplinecoach&view=disciplines" class="btn btn-secondary">
            <?php echo Text::_('JCANCEL'); ?>
        </a>

        <input type="hidden" name="task" value="discipline.save">

        <?php echo HTMLHelper::_('form.token'); ?>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll(
        '#discipline-language-tabs [data-language]'
    );

    const panels = document.querySelectorAll(
        '[data-language-panel]'
    );

    const activeLanguageField = document.getElementById(
        'active-language'
    );

    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            const languageCode = tab.dataset.language;

            tabs.forEach(function(currentTab) {
                const isActive = (
                    currentTab.dataset.language === languageCode
                );

                currentTab.classList.toggle(
                    'active',
                    isActive
                );

                currentTab.setAttribute(
                    'aria-selected',
                    isActive ? 'true' : 'false'
                );
            });

            panels.forEach(function(panel) {
                panel.hidden = (
                    panel.dataset.languagePanel !== languageCode
                );
            });

            activeLanguageField.value = languageCode;
        });
    });
});
</script>
