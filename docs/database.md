# Database Design

## Current Status

The database structure for DisciplineCoach version 0.1.4 is implemented and operational.

The current schema contains three core entities:

- Disciplines
- Discipline translations
- User discipline memberships

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

```text
#__dc_
```

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

```text
#__dc_disciplines
```

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

```text
#__dc_disciplines_lang
```

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

```text
Discipline 1

nl-NL → Voetbal
en-GB → Football
de-DE → Fußball
```

### Indexes

- Primary key on id
- Unique index on discipline_id + language
- Unique index on alias + language
- Index on discipline_id
- Index on language
- Index on title

### Foreign Key

```text
discipline_id
    ↓
#__dc_disciplines.id
```

### Delete Behaviour

```text
ON DELETE CASCADE
```

Deleting a discipline automatically removes all translations.

---

## Discipline Memberships

User discipline selections are stored in:

```text
#__dc_discipline_memberships
```

### Fields

| Field | Type |
|---------|---------|
| id | INT UNSIGNED |
| user_id | INT |
| discipline_id | INT UNSIGNED |
| created | DATETIME |

### Purpose

Stores the relationship between a Joomla user and a discipline.

### Examples

```text
User 42
    ↓
Badminton

User 42
    ↓
Football

User 42
    ↓
First Aid
```

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

```text
user_id + discipline_id
```

### User Relationship

```text
user_id
    ↓
#__users.id
```

### Discipline Relationship

```text
discipline_id
    ↓
#__dc_disciplines.id
```

### Delete Behaviour

```text
ON DELETE CASCADE
```

If a Joomla user is deleted, all memberships are removed automatically.

If a discipline is deleted, all memberships are removed automatically.

---

# Entity Relationships

## Discipline Translation

```text
#__dc_disciplines
    ↓
#__dc_disciplines_lang
```

Relationship:

```text
One discipline
    ↓
Many translations
```

---

## User Membership

```text
#__users
    ↓
#__dc_discipline_memberships
    ↓
#__dc_disciplines
```

Relationship:

```text
Many users
    ↔
Many disciplines
```

implemented through:

```text
#__dc_discipline_memberships
```

---

# Installation

The database schema for clean installations is defined in:

```text
administrator/sql/install/mysql/install.sql
```

Installation order:

1. #__dc_disciplines
2. #__dc_disciplines_lang
3. #__dc_discipline_memberships

---

# Uninstallation

The uninstall script is located in:

```text
administrator/sql/uninstall/mysql/uninstall.sql
```

Recommended removal order:

1. #__dc_discipline_memberships
2. #__dc_disciplines_lang
3. #__dc_disciplines

---

# Database Updates

Incremental updates are stored in:

```text
administrator/sql/updates/mysql
```

Examples:

```text
0.1.3.sql
0.1.4.sql
0.1.5.sql
```

Each release introduces only the schema changes required since the previous version.

---

# Future Database Expansion

Planned entities include:

## Moderators (Version 0.1.6)

Possible future fields:

- user_id
- discipline_id
- assigned_by
- assigned_on

or

- membership_id
- is_moderator

The final moderator design will be determined during version 0.1.6 development.

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

Version 0.1.4 database implementation includes:

- Discipline management
- Multilingual discipline content
- User discipline memberships
- Frontend discipline selection storage
- Membership uniqueness validation
- Cascading relationship cleanup
- Transaction-safe discipline management

The schema is ready for moderator assignment functionality planned for version 0.1.6.
