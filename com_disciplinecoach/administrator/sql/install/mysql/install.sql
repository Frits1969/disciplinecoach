--
-- ========================================================================
-- DisciplineCoach
-- Joomla 6 Component
-- ========================================================================
--
-- File        : install.sql
-- Path        : administrator/sql/install/mysql/install.sql
-- Purpose     : Creates the database tables required for the initial
--               installation of the DisciplineCoach component.
--
-- Author      : Frits van Leeuwen
-- Created     : 2026-11-01
-- Modified    : 2026-11-11
-- Version     : 0.1.4
--
-- Copyright   : Copyright (C) 2026 Frits van Leeuwen
-- License     : GNU General Public License version 2 or later
--
-- ========================================================================
--

CREATE TABLE IF NOT EXISTS `#__dc_disciplines`
(
    `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `image`         VARCHAR(255) DEFAULT NULL,
    `published`     TINYINT(1) NOT NULL DEFAULT 1,
    `created`       DATETIME NOT NULL,
    `created_by`    INT UNSIGNED NOT NULL DEFAULT 0,
    `modified`      DATETIME DEFAULT NULL,
    `modified_by`   INT UNSIGNED DEFAULT NULL,

    PRIMARY KEY (`id`),

    KEY `idx_published`
        (`published`)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
DEFAULT COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `#__dc_disciplines_lang`
(
    `id`              INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `discipline_id`   INT UNSIGNED NOT NULL,
    `language`        VARCHAR(7) NOT NULL,
    `title`           VARCHAR(100) NOT NULL,
    `alias`           VARCHAR(100) NOT NULL,

    PRIMARY KEY (`id`),

    UNIQUE KEY `idx_discipline_language`
        (`discipline_id`, `language`),

    UNIQUE KEY `idx_alias_language`
        (`alias`, `language`),

    KEY `idx_discipline_id`
        (`discipline_id`),

    KEY `idx_language`
        (`language`),

    KEY `idx_title`
        (`title`),

    CONSTRAINT `fk_dc_disciplines_lang_discipline`
        FOREIGN KEY (`discipline_id`)
        REFERENCES `#__dc_disciplines` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
DEFAULT COLLATE=utf8mb4_unicode_ci;


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
