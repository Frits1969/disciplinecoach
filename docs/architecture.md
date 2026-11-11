## Architecture

### Purpose

DisciplineCoach is a multilingual Joomla 6 component designed to manage disciplines, memberships, coaches, moderators and discipline-related communities.

The component is intentionally independent of any specific subject area. It can be used for sports, education, hobbies, professional knowledge domains, communities and collaborative environments.

### Design Principles

- Generic and reusable
- Multilingual by design
- Joomla user integration
- Joomla content language integration
- Role-based access control
- Discipline-centered organisation
- Extensible architecture
- Configurable terminology
- Separation of shared and translated data
- Joomla-native development where possible

### Joomla Architecture

DisciplineCoach follows the native Joomla 6 component architecture.

The component uses:

- Joomla MVC
- Joomla service providers
- Joomla controllers
- Joomla models
- Joomla HTML views
- Joomla form definitions
- Joomla language files
- Joomla content languages
- Joomla Media Manager
- Joomla database query builder
- Joomla form token validation
- Joomla extension installation scripts

Custom functionality is added only where Joomla does not already provide the required behaviour.

### Component Structure

The component is divided into an administrator application and a site application.

```text
com_disciplinecoach
├── administrator
│   ├── forms
│   ├── language
│   ├── services
│   ├── sql
│   ├── src
│   │   ├── Controller
│   │   ├── Extension
│   │   ├── Model
│   │   └── View
│   └── tmpl
├── media
│   └── com_disciplinecoach
│       ├── css
│       └── images
├── site
└── com_disciplinecoach.xml
```

The administrator application contains the management interface.

The site application will contain public and registered-user functionality in later versions.

Project documentation remains outside the Joomla installation package.

### Core Concepts

#### Discipline

A discipline represents a field of interest, specialisation, expertise, knowledge domain, skill area, activity, community or subject area.

Examples include:

- Badminton
- Football
- Hockey
- Music
- Guitar
- Piano
- First Aid
- Leadership
- Project Management
- Languages
- Volunteering

A discipline is the central organising object of DisciplineCoach.

A discipline currently contains shared data and translated data.

Shared data includes:

- Image
- Publication status
- Creation information
- Modification information

Translated data currently includes:

- Title
- Alias

#### User

Users are managed by Joomla.

DisciplineCoach extends Joomla users by linking users to disciplines and assigning responsibilities within those disciplines.

DisciplineCoach does not replace Joomla authentication, registration, password management or account activation.

#### Membership

A membership defines the relationship between a Joomla user and a discipline.

A user may have multiple memberships. A discipline may have multiple members.

Membership functionality is planned for a later version.

#### Coach

A coach is a Joomla user who is active within one or more disciplines.

Coach functionality is planned for a later version.

#### Moderator

A moderator is a coach or member with additional responsibilities within a specific discipline.

Moderator privileges are discipline-specific.

#### Content

Content belongs to a discipline. Future examples may include exercises, training plans, documents, images, articles and knowledge resources.

Content management is not part of version 0.1.3.

### User Roles

- Registered User
- Member
- Coach
- Moderator
- Super Administrator

The Super Administrator can currently manage disciplines. Additional management functionality will be introduced in later versions.

### Relationships

The planned user relationship is:

```text
Joomla User
    ↓
Membership
    ↓
Discipline
```

Moderator privileges are linked to the membership:

```text
Membership
    ↓
Moderator privileges
```

The implemented discipline translation relationship is:

```text
Discipline
    ↓
Discipline translation
    ↓
Joomla content language
```

One discipline can have multiple translations, but no more than one translation for the same content language.

### Discipline Architecture

Version 0.1.3 separates shared discipline information from translated discipline content.

Shared discipline data is stored in:

```text
#__dc_disciplines
```

Translated discipline data is stored in:

```text
#__dc_disciplines_lang
```

The tables are linked through:

```text
#__dc_disciplines.id
    ↓
#__dc_disciplines_lang.discipline_id
```

This structure prevents shared information such as the image and publication status from being duplicated for every language. It also allows an unlimited number of Joomla content languages without adding a separate database column for every language.

### Multilingual Architecture

DisciplineCoach separates interface translations from content translations.

#### Interface Translations

Administrator interface texts are stored in Joomla language files. The initial administrator interface languages are Dutch and English.

Language files contain translations for dashboard texts, navigation, headings, buttons, form labels, status texts, validation messages and system messages.

#### Content Translations

Discipline titles and aliases are content and are therefore stored in the database.

DisciplineCoach uses published Joomla content languages to determine which translations are required.

Each discipline has one translation record per available content language.

```text
Discipline ID 1
├── nl-NL: Voetbal
├── en-GB: Football
└── de-DE: Fußball
```

The language used by the Joomla administrator interface and the language of the content are separate concepts.

### Multilingual Form Architecture

The discipline form displays all available Joomla content languages as tabs.

For a new discipline:

- The default website content language is active.
- No empty language selection is displayed.
- Every available language has its own title and alias fields.

For an existing discipline:

- The language passed from the overview is active.
- Existing translations are loaded from the translation table.
- Switching tabs displays the values entered for that language.

All language panels remain inside the same HTML form. Switching between languages only changes which panel is visible.

When the administrator selects Save and Close:

1. The shared discipline record is inserted or updated.
2. The resulting discipline ID is determined.
3. Every available translation is validated.
4. Existing translations are updated.
5. Missing translations are inserted.
6. The complete operation is committed as one database transaction.

If any part of the save operation fails, the transaction is rolled back.

### Discipline Overview Architecture

The administrator discipline overview combines the two discipline tables.

Shared fields are loaded from `#__dc_disciplines`. The displayed title and alias are loaded from `#__dc_disciplines_lang`.

The overview supports searching and sorting translated titles and aliases, filtering by publication status, publishing and unpublishing disciplines, bulk actions and opening a discipline in the displayed language.

### Discipline Image Architecture

The discipline image applies to the discipline as a whole and is stored once in the main discipline table.

Joomla Media Manager is used to select and upload discipline images.

Component media is stored below:

```text
media/com_disciplinecoach
```

### Deletion Behaviour

Deleting a discipline removes the main discipline record. Associated translations are deleted automatically through the database foreign key with cascading deletion.

### Security and Reliability

The discipline management process uses:

- Joomla input handling
- Joomla form tokens
- Joomla database query builder
- Prepared bindings where appropriate
- Required-field validation
- Alias validation per language
- Database transactions
- Foreign key constraints
- Unique database indexes

### Discipline Management

Administrators can currently create, edit, delete, publish, unpublish, search, filter and sort disciplines, select an image, enter a title and alias for every available content language and save all translations simultaneously.

### Terminology

The component internally uses the term “Discipline”. Administrators may eventually configure an alternative display label, such as Sport, Musical Instrument, Subject, Domain, Specialisation, Area of Expertise or Activity.

Terminology configuration is planned for a later version.

### Future Expansion

The architecture is intended to support multiple disciplines per user, multiple coaches and moderators per discipline, descriptions, memberships, requests, workflows, notifications, frontend management, configurable terminology and language fallback behaviour.

### Current Status

Version 0.1.3 completed the multilingual Discipline administration module.

Implemented:

- Joomla 6 administrator component foundation
- Administrator dashboard
- Multilingual administrator interface
- Discipline administration
- Discipline image management
- Publication management
- Separate storage of shared and translated discipline data
- Multilingual discipline titles and aliases
- Language tabs
- Simultaneous saving of all translations
- Language-aware overview, searching and sorting
- Joomla form token validation
- Transactional discipline saving

Not yet implemented:

- Frontend discipline presentation
- Discipline descriptions
- Memberships
- Coach management
- Moderator assignments
- Discipline requests
- Configurable terminology
- Language fallback management
- General component configuration
