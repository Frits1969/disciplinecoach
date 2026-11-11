## Glossary

### Discipline

A discipline represents a domain, specialisation, field of interest, area of expertise, activity, community or subject area.

Examples include Badminton, Football, Music, First Aid, Leadership, Languages and Project Management.

A discipline is the central organising concept within DisciplineCoach and contains shared data plus translated content.

### Discipline ID

The unique numerical identifier stored in `#__dc_disciplines.id`.

Translations refer to it through `#__dc_disciplines_lang.discipline_id`.

### Shared Discipline Data

Data that applies to the discipline in every language.

Current shared fields:

- Image
- Publication status
- Creation information
- Modification information

Stored once in:

```text
#__dc_disciplines
```

### Discipline Translation

The language-specific values of a discipline.

Currently translated fields:

- Discipline title
- Alias

Stored in:

```text
#__dc_disciplines_lang
```

Each translation belongs to one discipline, uses one Joomla content language and has a title and alias.

### Translation Table

A database table containing language-specific discipline values.

The DisciplineCoach translation table is `#__dc_disciplines_lang` and is linked to the main discipline through `discipline_id`.

### Translation ID

The unique numerical identifier of a translation record. It identifies the translation, not the shared discipline.

### Language Code

A code identifying a Joomla content language, such as `nl-NL`, `en-GB` or `de-DE`.

### Content Language

A Joomla language used to identify translated website content.

DisciplineCoach uses published Joomla content languages to determine which discipline translations are required.

A content language is separate from the administrator interface language.

### Interface Language

The language used to display Joomla and component interface text, including buttons, labels, headings, statuses, validation messages and system messages.

Interface translations are stored in Joomla `.ini` files.

### Default Site Language

The primary language configured for the public Joomla website.

For a new discipline, DisciplineCoach uses this language as the initial active language when it is available as a published content language.

### Active Language

The content language whose form panel is currently visible.

Switching the active language changes the visible panel without discarding values in other panels.

### Language Tab

A button in the multilingual discipline form that activates the fields for one content language.

Each tab provides access to that language’s title and alias fields.

### Title

The language-specific name of a discipline.

```text
nl-NL: Voetbal
en-GB: Football
de-DE: Fußball
```

### Alias

A language-specific, URL-friendly value associated with a discipline title.

```text
nl-NL: voetbal
en-GB: football
de-DE: fussball
```

An alias must be unique within its content language.

### Publication State

A shared value indicating whether a discipline is published.

```text
0 = Unpublished
1 = Published
```

### Discipline Image

An image associated with the complete discipline and shared by all translations.

Images are selected through Joomla Media Manager.

### User

A registered Joomla user. DisciplineCoach extends Joomla users but does not replace Joomla user management.

### Membership

The relationship between a Joomla user and a discipline.

A user may have multiple memberships and a discipline may have multiple members.

Membership functionality is planned for a later version.

### Coach

A Joomla user active within one or more disciplines.

Coach functionality is planned for a later version.

### Moderator

A user with additional responsibilities within a specific discipline.

Moderator privileges are discipline-specific.

### Super Administrator

A Joomla Super Administrator with full administrative privileges.

The Super Administrator can currently manage disciplines.

### Discipline Request

A future request submitted when a required discipline is not available.

A Super Administrator will review the request and decide whether the discipline should be created.

### Content

Information belonging to a discipline, such as exercises, training plans, documents, images, articles or knowledge resources.

Content management is not part of version 0.1.3.

### Terminology

The words presented to users to describe concepts in the component.

DisciplineCoach internally uses “Discipline”, while future configuration may display an alternative such as Sport, Subject or Domain.

### Database Transaction

A group of database operations that succeeds or fails as one operation.

DisciplineCoach uses a transaction when saving a discipline and its translations.

### Foreign Key

A database constraint connecting a record in one table to a related record in another table.

The translation table connects `discipline_id` to the main discipline ID.

### Cascading Deletion

Database behaviour that automatically removes child records when the parent record is deleted.

Deleting a discipline automatically removes its translations.

### Form Token

A Joomla security value added to a form and checked when an administrator submits create, edit, publish, unpublish or delete actions.

### Administrator Dashboard

The central navigation page of the DisciplineCoach administrator interface.

Current tiles:

- Disciplines
- Coaches
- Requests
- Configuration

Only the Disciplines module is fully operational in version 0.1.3.
