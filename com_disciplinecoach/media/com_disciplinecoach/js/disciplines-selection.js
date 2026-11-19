/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : disciplines-selection.js
 * Path        : media/com_disciplinecoach/js/disciplines-selection.js
 * Purpose     : Updates the visual selection state of discipline cards
 *               when a frontend checkbox is changed.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-14
 * Modified    : 2026-11-16
 * Version     : 0.1.4
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

'use strict';

document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll(
        '[data-discipline-checkbox]'
    );

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', () => {
            const card = checkbox.closest(
                '[data-discipline-card]'
            );

            if (!card) {
                return;
            }

            card.classList.toggle(
                'dc-is-selected',
                checkbox.checked
            );

            card.classList.toggle(
                'dc-is-unselected',
                !checkbox.checked
            );
        });
    });
});
