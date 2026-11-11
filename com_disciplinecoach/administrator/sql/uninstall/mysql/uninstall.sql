--
-- ========================================================================
-- DisciplineCoach
-- Joomla 6 Component
-- ========================================================================
--
-- File        : uninstall.sql
-- Path        : administrator/sql/uninstall/mysql/uninstall.sql
-- Purpose     : Removes all DisciplineCoach database tables during
--               component removal.
--
-- Author      : Frits van Leeuwen
-- Created     : 2026-11-01
-- Modified    : 2026-11-10
-- Version     : 0.1.3
--
-- Copyright   : Copyright (C) 2026 Frits van Leeuwen
-- License     : GNU General Public License version 2 or later
--
-- ========================================================================
--

DROP TABLE IF EXISTS `#__dc_disciplines_lang`;
DROP TABLE IF EXISTS `#__dc_disciplines`;
