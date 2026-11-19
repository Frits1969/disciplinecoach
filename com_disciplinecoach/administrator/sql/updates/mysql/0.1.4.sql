--
-- ========================================================================
-- DisciplineCoach
-- Joomla 6 Component
-- ========================================================================
--
-- File        : 0.1.4.sql
-- Path        : administrator/sql/updates/mysql/0.1.4.sql
-- Purpose     : Adds persistent discipline memberships for Joomla users.
--
-- Author      : Frits van Leeuwen
-- Created     : 2026-11-10
-- Modified    : 2026-11-10
-- Version     : 0.1.4
--
-- Copyright   : Copyright (C) 2026 Frits van Leeuwen
-- License     : GNU General Public License version 2 or later
--
-- ========================================================================
--

CREATE TABLE IF NOT EXISTS `#__dc_discipline_memberships`
(
    `id`              INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`         INT NOT NULL,
    `discipline_id`   INT UNSIGNED NOT NULL,
    `created`         DATETIME NOT NULL,

    PRIMARY KEY (`id`),

    UNIQUE KEY `idx_user_discipline`
        (`user_id`, `discipline_id`),

    KEY `idx_user_id`
        (`user_id`),

    KEY `idx_discipline_id`
        (`discipline_id`),

    KEY `idx_created`
        (`created`),

    CONSTRAINT `fk_dc_memberships_user`
        FOREIGN KEY (`user_id`)
        REFERENCES `#__users` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT `fk_dc_memberships_discipline`
        FOREIGN KEY (`discipline_id`)
        REFERENCES `#__dc_disciplines` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
DEFAULT COLLATE=utf8mb4_unicode_ci;
