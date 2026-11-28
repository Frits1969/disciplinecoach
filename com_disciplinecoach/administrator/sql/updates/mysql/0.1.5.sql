--
-- ========================================================================
-- DisciplineCoach
-- Joomla 6 Component
-- ========================================================================
--
-- File        : 0.1.5.sql
-- Path        : administrator/sql/updates/mysql/0.1.5.sql
-- Purpose     : Adds moderator support to memberships.
--
-- Author      : Frits van Leeuwen
-- Created     : 2026-11-22
-- Version     : 0.1.5
--
-- ========================================================================
--

ALTER TABLE `#__dc_discipline_memberships`
ADD COLUMN `is_moderator`
TINYINT(1) NOT NULL DEFAULT 0
AFTER `discipline_id`;
