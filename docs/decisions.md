## Design Decisions

This document records important architectural and functional decisions for
DisciplineCoach.

### 2026-09-16

#### Terminology

Decision:

The project uses the term “Discipline” as its primary business concept.

Reason:

The system must remain generic and should not be limited to sports.

A discipline represents a field of expertise, knowledge, activity,
specialisation, interest, community or subject area.

Examples include:

- Badminton
- Football
- Hockey
- Music
- Guitar
- Piano
- First Aid
- Leadership
- Languages
- Volunteering
- Project Management

Status:

Accepted

#### Terminology Configuration

Decision:

The software uses the term “Discipline” internally.

Administrators may eventually configure an alternative label for display
throughout the interface.

Examples include:

- Discipline
- Sport
- Musical Instrument
- Subject
- Domain
- Specialisation
- Area of Expertise
- Activity

Reason:

Different communities may use different terminology while requiring the same
underlying functionality.

The configured label affects only the interface and does not modify the
internal data model.

Status:

Accepted

#### Documentation Language

Decision:

Project documentation is maintained in English.

Reason:

English is the common language for software development and GitHub projects.

Status:

Accepted

#### Joomla User Management

Decision:

User accounts are managed by Joomla.

Reason:

Joomla already provides:

- Authentication
- Authorisation
- Registration
- Account activation
- Password management
- User groups
- Access levels
- Multilingual support

DisciplineCoach extends Joomla users rather than replacing Joomla user
management.

Status:

Accepted

#### Membership Model

Decision:

A user may belong to multiple disciplines.

Reason:

Users may actively participate in several disciplines.

Examples include:

- Badminton
- Football
- Music
- First Aid
- Leadership
- Languages
- Project Management

Status:

Accepted

#### Moderator Assignment Model

Decision:

Moderator status is assigned per membership and not globally per user.

Reason:

A user may have different responsibilities within different disciplines.

Example:

- Moderator in Badminton
- Member in Volleyball
- Moderator in Hockey

Moderator privileges are therefore linked to the relationship between a user
and a discipline.

Status:

Accepted

#### Discipline Creation

Decision:

Disciplines may only be created by a Super Administrator.

Reason:

This prevents duplicate or inconsistent disciplines and maintains quality
control.

If a user cannot find a suitable discipline, the user may eventually submit a
request. The Super Administrator reviews the request and decides whether the
discipline should be added.

Status:

Accepted

#### Initial Version Scope

Decision:

The initial development scope focuses on:

- Joomla authentication
- Discipline management
- Membership management
- Coach management
- Moderator assignments

Reason:

A stable membership and discipline model must be established before
introducing extensive content functionality.

Status:

Accepted

#### Initial Multilingual Support

Decision:

The first supported interface languages are Dutch and English.

Reason:

The initial target audience consists of Dutch-speaking and English-speaking
users.

The discipline content architecture must not be restricted to only these two
languages.

Status:

Accepted

#### Design Philosophy

Decision:

Documentation and architectural design must be maintained alongside
implementation.

Reason:

A documented architecture reduces rework, records important decisions and
keeps development organised.

Status:

Accepted

### 2026-10-29

#### Joomla 6 Native Architecture

Decision:

DisciplineCoach follows Joomla 6 architecture and conventions wherever
possible.

Reason:

Joomla already provides proven solutions for:

- User management
- Authentication
- Authorisation
- ACL
- Multilingual support
- MVC
- Forms
- Media management
- Extension installation

Custom functionality should only be developed when Joomla does not already
provide the required functionality.

Status:

Accepted

#### Component Packaging

Decision:

Project documentation remains outside the Joomla component installation
package.

Reason:

Documentation is intended for developers and contributors and should not be
distributed as part of the Joomla installation package.

Status:

Accepted

#### Joomla MVC Foundation

Decision:

The component is implemented using the Joomla 6 MVC architecture.

Implemented foundation:

- Service provider
- Component class
- Display controller
- Models
- HTML views
- Administrator templates

Reason:

Using Joomla MVC provides maintainability, consistency and future
extensibility.

Status:

Implemented

### 2026-10-31

#### Dashboard Navigation Model

Decision:

The administrator dashboard serves as the primary navigation hub of
DisciplineCoach.

The dashboard provides direct access to the main management modules through
dashboard tiles.

The initial dashboard modules are:

- Disciplines
- Coaches
- Requests
- Configuration

Reason:

The dashboard should provide immediate access to the most important
management areas.

A tile-based interface is clear, extensible and suitable for both small and
large installations.

Additional modules can be added later without changing the overall navigation
structure.

Status:

Implemented

#### Coach Terminology

Decision:

The term “Coach” is used within the administrator interface instead of
“Trainer”.

Reason:

The term Coach is more generic and better fits the broad scope of
DisciplineCoach.

The application is intended to support:

- Sports
- Education
- Community management
- Training environments
- Knowledge domains

Status:

Accepted

#### Moderator Role Model

Decision:

Moderators remain coaches or members with additional permissions.

The administrator interface should therefore be able to distinguish between:

- Coach
- Coach / Moderator

Reason:

A moderator is not considered a completely separate type of user.

Moderator permissions extend the user’s role within a specific discipline.

Status:

Accepted

#### Dashboard-First Development Approach

Decision:

Future modules are first represented on the dashboard before their full
functionality is implemented.

Reason:

This establishes the navigation structure early and allows the application
architecture to evolve in a controlled and predictable manner.

Status:

Accepted

### 2026-11-10

#### Interface and Content Translations

Decision:

Interface translations and discipline content translations are handled
separately.

Interface text is stored in Joomla language files.

Translated discipline content is stored in the database.

Reason:

Interface phrases such as buttons, labels and messages belong to the
component.

Discipline titles and aliases are content entered by a website administrator
and can differ for every website and content language.

Status:

Implemented in version 0.1.3

#### Joomla Content Languages

Decision:

DisciplineCoach uses published Joomla content languages to determine which
discipline translations must be available.

Reason:

This prevents the component from maintaining a separate language
configuration and keeps multilingual content aligned with the Joomla
website.

Installed administrator or site language packages alone do not define the
discipline translation set. Published content languages provide that set.

Status:

Implemented in version 0.1.3

#### Discipline Translation Storage

Decision:

Shared discipline data and translated discipline content are stored in
separate database tables.

Shared discipline data is stored in:

```text
#__dc_disciplines
```

Translated titles and aliases are stored in:

```text
#__dc_disciplines_lang
```

Reason:

Images and publication status apply to the discipline as a whole and should
not be duplicated for every language.

Titles and aliases differ per content language and therefore require separate
translation records.

The structure supports an unlimited number of Joomla content languages
without adding language-specific columns such as:

```text
title_nl
title_en
title_de
```

Status:

Implemented in version 0.1.3

#### Discipline Translation Relationship

Decision:

Translations are linked to their discipline through `discipline_id`.

Reason:

The main discipline ID already provides a stable relationship between shared
data and translated data.

A separate translation key or shared UUID is unnecessary when translations
are stored in a dedicated child table.

Status:

Implemented in version 0.1.3

#### One Translation Per Language

Decision:

A discipline can have no more than one translation for the same content
language.

Reason:

Two translations with the same discipline ID and language code would make it
unclear which value should be displayed.

The rule is enforced by a unique database index on:

```text
discipline_id
language
```

Status:

Implemented in version 0.1.3

#### Alias Uniqueness

Decision:

A discipline alias must be unique within its content language.

Reason:

The same alias must not identify two different disciplines within the same
language.

An alias may be used in a different language because language-specific routes
and content can use their own namespace.

The rule is enforced by a unique database index on:

```text
alias
language
```

Status:

Implemented in version 0.1.3

#### Shared Discipline Image

Decision:

A discipline image is stored once and is shared by all translations.

Reason:

The image represents the discipline, not a language-specific title.

Duplicating the image path for every translation would create unnecessary
data duplication and could lead to inconsistent images between translations.

Status:

Implemented in version 0.1.3

#### Shared Publication State

Decision:

The publication state is stored once in the main discipline record.

Reason:

Publishing or unpublishing currently applies to the complete discipline and
all translations.

Language-specific publication states are not required for the current
release.

Status:

Implemented in version 0.1.3

#### Multilingual Discipline Form

Decision:

All published Joomla content languages are displayed as tabs in one
discipline form.

Reason:

Administrators must be able to enter every discipline title and alias without
opening a separate form for each language.

All language panels remain part of the same form. Entered values therefore
remain available when switching between languages.

Status:

Implemented in version 0.1.3

#### Simultaneous Translation Saving

Decision:

All available discipline translations are saved in one operation.

Reason:

A discipline should contain a complete set of translations for the available
content languages.

Saving all translations together provides a consistent workflow.

Status:

Implemented in version 0.1.3

#### Transactional Saving

Decision:

The main discipline record and all translations are saved within one database
transaction.

Reason:

A save operation must not leave a partial result, such as a main record
without all required translations.

If any part of the operation fails, all changes from that operation are rolled
back.

Status:

Implemented in version 0.1.3

#### Required Translations

Decision:

A title and alias are required for every available content language when a
discipline is saved.

Reason:

The current workflow is designed to create a complete set of discipline
translations in one operation.

This prevents incomplete disciplines from appearing without a title in an
available language.

Status:

Implemented in version 0.1.3

#### Active Language Selection

Decision:

For a new discipline, the default website content language is active when the
form opens.

When editing a discipline, the language used to open the record is active.

If neither language can be determined, the first available content language
is used.

Reason:

The form should never open with an empty “Select language” option.

Administrators should immediately see the most relevant language panel.

Status:

Implemented in version 0.1.3

#### Cascading Translation Deletion

Decision:

Deleting a discipline automatically removes all related translations.

Reason:

Translation records cannot exist meaningfully without their main discipline.

The relationship is protected by a foreign key using cascading deletion.

Status:

Implemented in version 0.1.3

#### Language-Aware Administrator Overview

Decision:

The administrator discipline overview displays one translated title and alias
for each discipline.

Reason:

The overview must remain readable and must not display a separate row for
every translation.

The selected display language is determined from the requested language,
administrator language, default website language or first available content
language.

Status:

Implemented in version 0.1.3

#### Administrator Row Interaction

Decision:

Discipline overview rows are clickable, while checkbox clicks remain separate
from row navigation.

Reason:

Clickable rows make editing faster.

Checkboxes must continue to support bulk actions without opening the
discipline form.

The pointer and hover styling provide a visual indication of the available
interaction.

Status:

Implemented in version 0.1.3

### Version 0.1.4 Design Decisions

#### Joomla Registration and Login

Decision:

DisciplineCoach uses Joomla registration, authentication and user accounts.
Only authenticated users can store or change personal discipline selections.

Reason:

Joomla already provides account registration, login, logout, password
management and user identity. DisciplineCoach only needs to store the
relationship between a Joomla user and one or more disciplines.

Status:

Planned for version 0.1.4

#### Multiple Discipline Selection

Decision:

A registered user can select one or more disciplines.

Reason:

A user may participate in several sports, subjects, activities or knowledge
domains. The selection process must therefore support multiple simultaneous
choices.

Status:

Planned for version 0.1.4

#### Persistent User Discipline Memberships

Decision:

Discipline selections are stored in the database and linked to the Joomla
user ID.

Reason:

Selections must remain available after logout, login and use from another
browser session. The selection must not depend only on a browser cookie or an
active Joomla session.

Status:

Planned for version 0.1.4

#### Membership Storage

Decision:

User discipline selections are stored in a dedicated membership table:

```text
#__dc_discipline_memberships
```

The table links a Joomla user ID to a discipline ID.

The combination of `user_id` and `discipline_id` must be unique.

Reason:

A dedicated many-to-many relationship allows one user to select multiple
disciplines and one discipline to be selected by multiple users. The unique
combination prevents duplicate selections.

Status:

Planned for version 0.1.4

#### Discipline Selection Card

Decision:

The frontend selection page displays published disciplines as complete image
cards that act as toggle controls.

Visible checkboxes and textual state labels such as “Select” or “Selected” are
not displayed.

Reason:

A complete clickable card provides a clean and modern selection interface
while still supporting multiple selections.

Status:

Planned for version 0.1.4

#### Selected Card Appearance

Decision:

A selected discipline card uses:

- A full-colour image
- A distinct coloured border
- A subtle selected background
- A visible selection mark

Reason:

The selected state must be immediately recognisable and must not rely only on
colour.

Status:

Planned for version 0.1.4

#### Unselected Card Appearance

Decision:

An unselected discipline card uses:

- A partially desaturated image
- Reduced image opacity
- A neutral border
- No selection mark

The discipline title remains fully readable.

Reason:

The muted image distinguishes unselected disciplines without making the title
or the available choice difficult to understand.

Status:

Planned for version 0.1.4

#### Accessible Toggle Behaviour

Decision:

The complete discipline card must be operable with a mouse and keyboard.
The control exposes its selected state programmatically and has a visible
keyboard focus indicator.

Reason:

Removing the visible checkbox must not remove the meaning or accessibility of
the selection control.

Status:

Planned for version 0.1.4

#### Discipline Selection Sorting

Decision:

Selected disciplines are displayed first and sorted alphabetically by their
translated title.

Unselected disciplines follow and are also sorted alphabetically by their
translated title.

Reason:

The user’s current choices remain easy to find while the complete list stays
predictable and organised.

Status:

Planned for version 0.1.4

#### Stable Card Position During Editing

Decision:

Cards do not move immediately when the user changes a selection.

The selected-first alphabetical order is applied after the user saves the
complete selection and the page is reloaded.

Reason:

Moving cards after every click could disrupt the user while several nearby
choices are being changed.

Status:

Planned for version 0.1.4

#### Active Content Language

Decision:

The active Joomla content language determines the discipline title displayed
on the frontend and the alphabetical sort order.

Reason:

DisciplineCoach already stores translated discipline titles per Joomla content
language. The frontend must use the same multilingual architecture as the
administrator interface.

Status:

Planned for version 0.1.4

#### Personal Discipline Profile

Decision:

DisciplineCoach provides a personal profile page that displays only the
current user’s selected disciplines.

Each selected discipline is displayed as a card containing:

- The discipline image
- The translated discipline title below the image

The selected disciplines are sorted alphabetically.

Reason:

Discipline-specific profile information belongs within DisciplineCoach, while
Joomla remains responsible for registration, authentication, passwords and
general account information.

Status:

Planned for version 0.1.4

#### Changing a Discipline Selection

Decision:

The personal DisciplineCoach profile provides an action for changing the
user’s discipline selection.

The selection page loads the user’s existing choices, allows disciplines to
be added or removed and saves the complete updated selection in one operation.

Reason:

A user’s interests and activities can change. Existing choices must therefore
remain editable.

Status:

Planned for version 0.1.4

#### Profile Display Without Selection Controls

Decision:

The personal profile displays selected discipline cards without toggle
controls or selection marks.

Selection controls are shown only on the discipline selection page.

Reason:

The profile is primarily a clear summary of the user’s choices. Editing takes
place in a dedicated selection view.

Status:

Planned for version 0.1.4

#### Selection Security

Decision:

Only logged-in users can save or modify personal discipline selections.
A user can modify only their own selection.

Submitted discipline IDs are validated, only existing published disciplines
can be selected and Joomla form token validation is required.

Reason:

Frontend form data cannot be trusted automatically. The component must
protect user-specific membership data and reject invalid or unpublished
discipline selections.

Status:

Planned for version 0.1.4
