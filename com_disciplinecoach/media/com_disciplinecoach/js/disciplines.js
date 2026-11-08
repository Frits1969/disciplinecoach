/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : disciplines.js
 * Path        : media/com_disciplinecoach/js/disciplines.js
 * Purpose     : JavaScript functionality for the Disciplines overview.
 *               Handles table interactions such as selecting and
 *               deselecting disciplines.
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

document.addEventListener('DOMContentLoaded', () => {

    const checkAll = document.getElementById('checkAll');

    if (!checkAll) {
        return;
    }

    checkAll.addEventListener('change', () => {

        const checkboxes =
            document.querySelectorAll(
                'input[name="cid[]"]'
            );

        checkboxes.forEach(
            checkbox => {
                checkbox.checked = checkAll.checked;
            }
        );
    });

});
