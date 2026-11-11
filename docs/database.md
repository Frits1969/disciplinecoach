## Database Design

### Current Status

The Discipline database structure was implemented in version 0.1.3.

The current schema separates shared discipline data from translated discipline content.

Implemented tables:

```text
#__dc_disciplines
#__dc_disciplines_lang
```

Joomla replaces `#__` with the database prefix configured for the website.

Future tables for memberships, coaches, discipline requests and configuration have not yet been implemented.

### Design Principles

- Joomla manages users.
- DisciplineCoach extends Joomla user functionality.
- Users may belong to multiple disciplines.
- Moderator permissions are discipline-specific.
- Shared data is not duplicated for each language.
- Translated content is stored separately from shared content.
- Joomla content language codes identify translations.
- Editable entities support auditing where appropriate.
- Relationships are protected by database constraints.
- Duplicate translations are prevented by unique indexes.
- Related translations are removed automatically.

### Naming Conventions

All DisciplineCoach tables use the Joomla database prefix placeholder `#__` and the component prefix `dc_`.

### Auditing

The discipline table contains:

- `created`
- `created_by`
- `modified`
- `modified_by`

Translation records currently do not contain separate audit fields because translations are saved as part of the discipline operation.

### Implemented Entities

#### Disciplines

Shared discipline data is stored in:

```text
#__dc_disciplines
```

Fields:

- `id`
- `image`
- `published`
- `created`
- `created_by`
- `modified`
- `modified_by`

##### `id`

`INT UNSIGNED`, primary key, auto increment and required.

##### `image`

`VARCHAR(255)`, optional and shared by all translations.

##### `published`

`TINYINT(1)`, required, default `1`.

```text
0 = Unpublished
1 = Published
```

##### `created`

`DATETIME`, required.

##### `created_by`

`INT UNSIGNED`, required, default `0`.

##### `modified`

`DATETIME`, optional.

##### `modified_by`

`INT UNSIGNED`, optional.

##### Discipline Indexes

- Primary key on `id`
- Index on `published`

#### Discipline Translations

Translated discipline data is stored in:

```text
#__dc_disciplines_lang
```

Fields:

- `id`
- `discipline_id`
- `language`
- `title`
- `alias`

Each record contains the translated values for one discipline in one Joomla content language.

##### `id`

`INT UNSIGNED`, primary key, auto increment and required.

##### `discipline_id`

`INT UNSIGNED`, required and a foreign key to `#__dc_disciplines.id`.

##### `language`

`VARCHAR(7)`, required. Examples: `nl-NL`, `en-GB`, `de-DE`.

##### `title`

`VARCHAR(100)`, required. Contains the translated discipline name.

##### `alias`

`VARCHAR(100)`, required. Contains the language-specific alias.

##### Translation Indexes

- Primary key on `id`
- Unique index on `discipline_id` and `language`
- Unique index on `alias` and `language`
- Index on `discipline_id`
- Index on `language`
- Index on `title`

The unique discipline and language index prevents duplicate translations for the same language. The unique alias and language index prevents duplicate aliases within one language.

### Discipline Relationship

```text
#__dc_disciplines.id
    ↓
#__dc_disciplines_lang.discipline_id
```

This is a one-to-many relationship. One discipline has one shared record and one or more translation records. One translation belongs to exactly one discipline and one content language.

### Foreign Key

The translation table contains a foreign key from `#__dc_disciplines_lang.discipline_id` to `#__dc_disciplines.id` using:

```text
ON DELETE CASCADE
ON UPDATE CASCADE
```

### Example Data

Main discipline record:

```text
id:          1
image:       images/disciplines/football.png
published:   1
created:     2026-11-10 10:00:00
created_by:  42
modified:    NULL
modified_by: NULL
```

Translation records:

```text
id:            1
discipline_id: 1
language:      nl-NL
title:         Voetbal
alias:         voetbal
```

```text
id:            2
discipline_id: 1
language:      en-GB
title:         Football
alias:         football
```

### Installation

The complete database structure for a clean installation is defined in:

```text
administrator/sql/install/mysql/install.sql
```

The main table is created before the translation table because the translation table contains a foreign key to the main table.

### Uninstallation

The removal script is defined in:

```text
administrator/sql/uninstall/mysql/uninstall.sql
```

Tables are removed in this order:

1. `#__dc_disciplines_lang`
2. `#__dc_disciplines`

### Database Updates

Incremental update scripts are stored in:

```text
administrator/sql/updates/mysql
```

Future schema changes will use version-specific files such as `0.1.4.sql` and `0.1.5.sql`.

### Save Process

Saving a multilingual discipline uses one database transaction:

1. Validate all required translations.
2. Validate aliases within their languages.
3. Start the transaction.
4. Insert or update the shared discipline record.
5. Determine the discipline ID.
6. Insert or update each translation.
7. Commit the transaction.

If any operation fails, the transaction is rolled back and no partial records remain.

### Planned Entities

#### Users

Users remain managed by Joomla. No separate DisciplineCoach user table is currently planned.

#### Memberships

A membership will connect a Joomla user to a discipline. Possible fields include `id`, `user_id`, `discipline_id`, `is_moderator`, publication and audit fields.

#### Coaches

Coach functionality is planned for version 0.1.5. The final schema will be decided during that phase.

#### Moderators

Moderator status is expected to be stored within a membership or discipline assignment.

#### Discipline Requests

A future request table may contain request name, requester, status, administrator remarks and audit fields.

#### Content

Future content entities may include exercises, training plans, documents, images, articles and knowledge assets.

### Terminology Configuration

The component internally uses “Discipline”. Future terminology settings may change the displayed label without changing the database structure.

### Notes

The current discipline schema is implemented with:

```text
#__dc_disciplines
#__dc_disciplines_lang
```

Future entities will be documented when their schemas are designed and implemented.
