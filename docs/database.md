# Database Design

## Current Status

The database structure for DisciplineCoach version 0.1.5 is implemented and operational.

The current schema contains three core entities:

- Disciplines
- Discipline translations
- User discipline memberships (including moderator flag)

Implemented tables:

- #__dc_disciplines
- #__dc_disciplines_lang
- #__dc_discipline_memberships

Joomla replaces #__ with the configured database prefix.

The current database supports:

- Multilingual disciplines
- Frontend discipline selection
- User discipline memberships
- Future moderator assignment expansion

## Design Principles

- Joomla manages users
- DisciplineCoach extends Joomla user functionality
- Users may belong to multiple disciplines
- Disciplines may contain multiple members
- Moderator permissions are discipline-specific
- Shared data is not duplicated per language
- Translated content is stored separately
- Joomla content languages define translations
- Relationships are protected by foreign keys
- Duplicate memberships are prevented
- Duplicate translations are prevented
- Related records are automatically removed through cascading deletion

## Naming Conventions

All DisciplineCoach tables use:

as component-specific prefixing.

## Auditing

### Disciplines

The discipline table contains:

- created
- created_by
- modified
- modified_by

### Memberships

The membership table currently contains:

- created

Additional audit fields may be added in future releases.

---

# Implemented Entities

## Disciplines

Shared discipline data is stored in:

### Fields

| Field | Type |
|---------|---------|
| id | INT UNSIGNED |
| image | VARCHAR(255) |
| published | TINYINT(1) |
| created | DATETIME |
| created_by | INT UNSIGNED |
| modified | DATETIME |
| modified_by | INT UNSIGNED |

### Purpose

Stores information that applies to every translation of a discipline.

Examples:

- Publication status
- Image
- Audit information

### Indexes

- Primary key on id
- Index on published

---

## Discipline Translations

Translated discipline data is stored in:

### Fields

| Field | Type |
|---------|---------|
| id | INT UNSIGNED |
| discipline_id | INT UNSIGNED |
| language | VARCHAR(7) |
| title | VARCHAR(100) |
| alias | VARCHAR(100) |

### Purpose

Stores language-specific discipline data.

### Example

### Indexes

- Primary key on id
- Unique index on discipline_id + language
- Unique index on alias + language
- Index on discipline_id
- Index on language
- Index on title

### Foreign Key

### Delete Behaviour

Deleting a discipline automatically removes all translations.

---

## Discipline Memberships

User discipline selections and administrator memberships are stored in:

### Fields

| Field | Type |
|---------|---------|
| id | INT UNSIGNED |
| user_id | INT |
| discipline_id | INT UNSIGNED |
| is_moderator | TINYINT(1) |
| created | DATETIME |

### Purpose

Stores the relationship between a Joomla user and a discipline, as well as whether the member holds moderator privileges for that discipline.

### Examples

The same user can belong to multiple disciplines.

The same discipline can contain multiple users.

### Indexes

- Primary key on id
- Unique index on user_id + discipline_id
- Index on user_id
- Index on discipline_id
- Index on created

### Unique Membership Rule

A user may only have one membership record per discipline.

Enforced through:

### User Relationship

### Discipline Relationship

### Delete Behaviour

If a Joomla user is deleted, all memberships are removed automatically.

If a discipline is deleted, all memberships are removed automatically.

---

# Entity Relationships

## Discipline Translation

Relationship:

---

## User Membership

Relationship:

implemented through:

---

# Installation

The database schema for clean installations is defined in:

Installation order:

1. #__dc_disciplines
2. #__dc_disciplines_lang
3. #__dc_discipline_memberships

---

# Uninstallation

The uninstall script is located in:

Recommended removal order:

1. #__dc_discipline_memberships
2. #__dc_disciplines_lang
3. #__dc_disciplines

---

# Database Updates

Incremental updates are stored in:

Examples:

Each release introduces only the schema changes required since the previous version.

---

# Database Evolution

## Moderator Implementation (Version 0.1.5)

Moderator privileges were finalized and implemented in version 0.1.5 as an attribute on `#__dc_discipline_memberships`:

This direct relationship links moderator privileges to the user's discipline membership without requiring an auxiliary table.

---

# Future Database Expansion

Planned entities include:

## Discipline Requests

Possible future fields:

- title
- requester_id
- status
- administrator_notes
- created
- modified

## Configuration

Possible future entities:

- terminology settings
- application settings
- language settings

---

# Current Status

Version 0.1.5 database implementation includes:

- Discipline management
- Multilingual discipline content
- User discipline memberships
- Moderator management via `is_moderator`
- Frontend discipline selection storage
- Membership uniqueness validation
- Cascading relationship cleanup
- Transaction-safe discipline management

The schema supports full moderator management implemented in version 0.1.5.