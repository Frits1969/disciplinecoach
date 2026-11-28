# Architecture

## Purpose

DisciplineCoach is a multilingual Joomla 6 component designed to manage disciplines, memberships, moderators and discipline-related communities.

The component is intentionally independent of any specific subject area. It can be used for sports, education, hobbies, professional knowledge domains, communities and collaborative environments.

## Design Principles

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

## Joomla Architecture

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

## Component Structure

The component is divided into an administrator application and a site application.

The administrator application contains the management interface.

The site application contains frontend functionality for discipline selection and user-specific discipline preferences.

Project documentation remains outside the Joomla installation package.

## Core Concepts

### Discipline

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

### User

Users are managed by Joomla.

DisciplineCoach extends Joomla users by linking users to disciplines and assigning responsibilities within those disciplines.

DisciplineCoach does not replace Joomla authentication, registration, password management or account activation.

### Membership

A membership defines the relationship between a Joomla user and a discipline.

A user may have multiple memberships.

A discipline may have multiple members.

Version 0.1.4 implements the first membership foundation through user discipline selections.

Future versions will extend memberships with administration, reporting and moderator assignments.

### Coach

A coach is a Joomla user who is active within one or more disciplines.

Coach management will be introduced in later versions.

### Moderator

A moderator is a Joomla user with additional responsibilities within a discipline.

Moderator permissions are discipline-specific.

Moderators are assigned by an administrator.

Moderator management was implemented in version 0.1.5 through the membership administration interface via the `is_moderator` attribute.

### Content

Content belongs to a discipline.

Future examples may include:

- Exercises
- Training plans
- Documents
- Images
- Articles
- Knowledge resources

## User Roles

- Registered User
- Discipline Member
- Coach
- Moderator
- Super Administrator

The Super Administrator currently manages disciplines and system configuration.

Additional management functionality will be introduced in future releases.

## Relationships

### User Membership Relationship

A user can belong to multiple disciplines.

A discipline can contain multiple users.

### Moderator Relationship

Moderator permissions are always discipline-specific.

### Translation Relationship

One discipline can have multiple translations.

There can be no more than one translation for the same language.

## Discipline Architecture

Shared discipline information and translated discipline content are stored separately.

Shared discipline data is stored in:

Translated discipline data is stored in:

The tables are linked through:

This structure prevents duplicated data and supports an unlimited number of Joomla content languages.

## Membership Architecture

Version 0.1.4 introduced user discipline selections.

Users can:

- Select disciplines
- Deselect disciplines
- Save their preferences
- Restore previously saved selections

Membership data is stored separately from the discipline definition.

This architecture supports future expansion with:

- Member administration
- Moderator assignments
- Membership statuses
- Membership auditing

## Multilingual Architecture

DisciplineCoach separates interface translations from content translations.

### Interface Translations

Interface texts are stored in Joomla language files.

Languages currently supported:

- Dutch (nl-NL)
- English (en-GB)

Language files contain:

- Headings
- Labels
- Buttons
- Validation messages
- Status texts
- System messages

### Content Translations

Discipline content is stored in the database.

Current translated fields:

- Title
- Alias

Each discipline contains one translation record per Joomla content language.

Example:

The administrator language and content language remain separate concepts.

## Frontend Architecture

The frontend currently focuses on discipline selection.

### Discipline Cards

Disciplines are presented as visual cards consisting of:

- Discipline image
- Discipline title

### Selected State

Selected disciplines display:

- Full colour image
- Highlighted border
- Selected styling

### Unselected State

Unselected disciplines display:

- Greyed image
- Neutral border

### Persistence

User selections are stored in the database and automatically restored when the user revisits the page.

## Security and Reliability

DisciplineCoach uses:

- Joomla input filtering
- Joomla form tokens
- Joomla MVC
- Joomla database query builder
- Database transactions
- Foreign key constraints
- Unique indexes
- Required field validation
- Joomla user authentication

Only authenticated users can save personal discipline selections.

Users can only modify their own selections.

## Terminology

The component internally uses the term "Discipline".

Future versions may allow administrators to configure alternative labels such as:

- Sport
- Activity
- Subject
- Domain
- Instrument
- Area of Expertise

Terminology changes affect only the user interface and not the database structure.

## Future Expansion

The architecture is designed to support:

- Multiple disciplines per user
- Membership administration
- Moderator assignment per discipline
- Multiple moderators per discipline
- Discipline requests
- Approval workflows
- Notifications
- Frontend management
- Configurable terminology
- Language fallback behaviour
- Community features
- Microsoft 365 integrations

## Current Status

### Version 0.1.5

Implemented:

- Joomla 6 administrator component foundation
- Administrator dashboard
- Multilingual administrator interface
- Discipline administration
- Discipline image management
- Publication management
- Multilingual discipline titles and aliases
- Language-aware administration
- Frontend menu item support
- Frontend discipline presentation
- Discipline card interface
- Discipline selection
- Persistent user discipline selections
- Restoration of previous selections
- Dutch and English language support
- Administrator membership management (`view=memberships` & `view=membership`)
- Native Joomla Table implementation (`MembershipTable`)
- Moderator assignment flag per membership (`is_moderator`)
- Clickable list rows with hover highlighting and checkbox event isolation
- Database-backed memberships
- Joomla form token validation
- Transactional discipline saving
- Resilient Joomla 6 installation script

Not yet implemented:

- Coach administration / public profiles
- Advanced moderator filtering and discipline overview per moderator
- Discipline requests
- Terminology configuration
- Language fallback management
- General component configuration