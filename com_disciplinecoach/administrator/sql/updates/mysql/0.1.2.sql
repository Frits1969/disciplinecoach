--
-- ========================================================================
-- DisciplineCoach
-- Joomla 6 Component
-- ========================================================================
--
-- File        : 0.1.2.sql
-- Path        : sql/updates/mysql/0.1.2.sql
-- Purpose     : Database schema update to version 0.1.2.
--               Creates the #__dc_disciplines table.
--
-- Author      : Frits van Leeuwen
-- Created     : 2026-11-03
-- Version     : 0.1.2
--
-- Copyright   : Copyright (C) 2026 Frits van Leeuwen
-- License     : GNU General Public License version 2 or later
--
-- ========================================================================
--

CREATE TABLE IF NOT EXISTS `#__dc_disciplines`
(
    `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,

    `title`        VARCHAR(100) NOT NULL,
    `alias`        VARCHAR(100) NOT NULL,

    `image`        VARCHAR(255) DEFAULT NULL,

    `published`    TINYINT(1) NOT NULL DEFAULT 1,

    `created`      DATETIME NOT NULL,
    `created_by`   INT UNSIGNED NOT NULL,

    `modified`     DATETIME DEFAULT NULL,
    `modified_by`  INT UNSIGNED DEFAULT NULL,

    PRIMARY KEY (`id`),

    UNIQUE KEY `idx_alias` (`alias`),

    KEY `idx_title` (`title`),
    KEY `idx_published` (`published`)

)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
DEFAULT COLLATE=utf8mb4_unicode_ci;

