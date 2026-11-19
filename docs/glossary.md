# Glossary

## Discipline

A discipline represents a domain, specialisation, field of interest, area of expertise, activity, community or subject area.

Examples include:

- Badminton
- Football
- Music
- First Aid
- Leadership
- Languages
- Project Management

A discipline is the central organising concept within DisciplineCoach.

A discipline contains shared data and translated data.

---

## Discipline ID

The unique identifier of a discipline.

Stored in:

```text
#__dc_disciplines.id
```

Every discipline translation and membership ultimately refers to a discipline ID.

---

## Shared Discipline Data

Data that applies to all translations of a discipline.

Current shared fields:

- Image
- Publication state
- Creation information
- Modification information

Stored in:

```text
#__dc_disciplines
```

---

## Discipline Translation

Language-specific values belonging to a discipline.

Current translated fields:

- Title
- Alias

Stored in:

```text
#__dc_disciplines_lang
```

Each translation belongs to exactly one discipline and one Joomla content language.

---

## Translation Table

A database table containing language-dependent information.

Current DisciplineCoach translation table:

```text
#__dc_disciplines_lang
```

---

## Translation ID

The unique identifier of a translation record.

Stored in:

```text
#__dc_disciplines_lang.id
```

A translation ID identifies a translation record, not a discipline.

---

## Language Code

A Joomla content language code.

Examples:

```text
nl-NL
en-GB
de-DE
```

---

## Content Language

A Joomla language used for multilingual website content.

DisciplineCoach uses published Joomla content languages to determine required discipline translations.

A content language is different from the administrator interface language.

---

## Interface Language

The language used by Joomla and DisciplineCoach to display the user interface.

Examples:

- Buttons
- Labels
- Messages
- Headings

Interface translations are stored in language files.

---

## Default Site Language

The primary language configured for the Joomla frontend.

DisciplineCoach uses this language whenever a default language must be determined.

---

## Active Language

The currently selected content language.

The active language determines which translated discipline information is displayed or edited.

---

## Language Tab

A tab shown in the multilingual discipline editor.

Each tab displays the discipline fields for one content language.

---

## Title

The translated name of a discipline.

Examples:

```text
nl-NL: Voetbal
en-GB: Football
de-DE: Fußball
```

---

## Alias

A language-specific URL-safe version of a title.

Examples:

```text
nl-NL: voetbal
en-GB: football
de-DE: fussball
```

Aliases must be unique within the same language.

---

## Publication State

Indicates whether a discipline is available for use.

Values:

```text
0 = Unpublished
1 = Published
```

---

## Discipline Image

An image associated with a discipline.

The image is shared by all language translations.

Images are selected through Joomla Media Manager.

---

## User

A Joomla user.

DisciplineCoach uses Joomla user accounts and does not replace Joomla user management.

Joomla remains responsible for:

- Login
- Logout
- Registration
- Password management
- User profiles

---

## Membership

The relationship between a Joomla user and a discipline.

A membership indicates that a user has selected or joined a discipline.

A user may belong to multiple disciplines.

A discipline may contain multiple users.

Memberships are stored in:

```text
#__dc_discipline_memberships
```

---

## Discipline Membership

A single record connecting one Joomla user to one discipline.

Examples:

```text
User → Football
User → Badminton
User → Leadership
```

A user may have multiple discipline memberships.

---

## Membership Table

The database table used to store discipline selections.

Current table:

```text
#__dc_discipline_memberships
```

The combination of:

```text
user_id + discipline_id
```

must be unique.

---

## Discipline Selection

The process by which an authenticated user selects one or more disciplines in the frontend.

Selections are stored permanently and automatically restored.

---

## Discipline Card

A visual representation of a discipline.

A discipline card currently contains:

- Discipline image
- Discipline title

The entire card acts as a selection control.

---

## Selected Discipline

A discipline currently chosen by a user.

Selected disciplines use a highlighted visual appearance.

---

## Unselected Discipline

A discipline not currently chosen by a user.

Unselected disciplines use a neutral visual appearance.

---

## Coach

A Joomla user who actively participates within one or more disciplines.

Coach administration is planned for future versions.

---

## Moderator

A Joomla user with additional responsibilities within a specific discipline.

Moderator privileges are discipline-specific.

A moderator remains a normal discipline member with additional permissions.

Moderator management is planned for version 0.1.6.

---

## Super Administrator

A Joomla Super Administrator.

A Super Administrator can currently:

- Manage disciplines
- Manage translations
- Manage memberships through administration functions as they become available

---

## Discipline Request

A future request submitted by a user when a required discipline does not exist.

A Super Administrator will review the request and decide whether the discipline should be created.

---

## Content

Information belonging to a discipline.

Future examples:

- Exercises
- Documents
- Articles
- Training plans
- Certifications
- Knowledge resources

---

## Terminology

The words displayed to users that describe component concepts.

The component currently uses:

- Discipline
- Membership
- Coach
- Moderator

Future versions may allow administrators to replace these labels.

Examples:

```text
Discipline → Sport
Discipline → Subject
Discipline → Domain

Coach → Trainer
Coach → Instructor
Coach → Teacher
```

---

## Database Transaction

A database operation that either succeeds completely or fails completely.

DisciplineCoach uses transactions when saving multilingual discipline information.

---

## Foreign Key

A database constraint connecting records in different tables.

Examples:

```text
#__dc_disciplines_lang.discipline_id
    ↓
#__dc_disciplines.id
```

and

```text
#__dc_discipline_memberships.discipline_id
    ↓
#__dc_disciplines.id
```

---

## Cascading Deletion

Database behaviour that automatically removes dependent records.

Examples:

Deleting a discipline automatically removes:

- Discipline translations
- Discipline memberships

---

## Form Token

A Joomla security token used to verify form submissions.

Form tokens help prevent CSRF attacks.

---

## Administrator Dashboard

The central navigation page of DisciplineCoach.

Current dashboard modules:

- Disciplines
- Coaches
- Requests
- Configuration

The dashboard serves as the primary navigation hub for administrators.

---

## Frontend

The public Joomla site.

Version 0.1.4 introduces frontend discipline selection for authenticated users.

---

## Backend

The Joomla administrator environment.

The backend contains administrative functionality for managing disciplines and future component administration.
