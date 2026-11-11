## Design Decisions

This document records important architectural and functional decisions for DisciplineCoach.

### 2026-09-16

#### Terminology

Decision: The project uses the term “Discipline” as its primary business concept.

Reason: The system must remain generic and should not be limited to sports.

Status: Accepted

#### Terminology Configuration

Decision: The software uses “Discipline” internally. Administrators may eventually configure an alternative label for display.

Reason: Different communities may use different terminology while requiring the same underlying functionality.

Status: Accepted

#### Documentation Language

Decision: Project documentation is maintained in English.

Reason: English is the common language for software development and GitHub projects.

Status: Accepted

#### Joomla User Management

Decision: User accounts are managed by Joomla.

Reason: Joomla already provides authentication, authorisation, registration, account activation, password management, user groups, access levels and multilingual support.

Status: Accepted

#### Membership Model

Decision: A user may belong to multiple disciplines.

Reason: Users may actively participate in several disciplines.

Status: Accepted

#### Moderator Assignment Model

Decision: Moderator status is assigned per membership and not globally per user.

Reason: A user may have different responsibilities within different disciplines.

Status: Accepted

#### Discipline Creation

Decision: Disciplines may only be created by a Super Administrator.

Reason: This prevents duplicate or inconsistent disciplines and maintains quality control.

Status: Accepted

#### Initial Version Scope

Decision: Initial development focuses on Joomla authentication, discipline management, memberships, coaches and moderator assignments.

Reason: A stable membership and discipline model must exist before extensive content functionality.

Status: Accepted

#### Initial Multilingual Support

Decision: The first supported interface languages are Dutch and English.

Reason: The initial target audience consists of Dutch-speaking and English-speaking users, while the content architecture must support additional languages.

Status: Accepted

#### Design Philosophy

Decision: Documentation and architectural design are maintained alongside implementation.

Reason: A documented architecture reduces rework and records important decisions.

Status: Accepted

### 2026-10-29

#### Joomla 6 Native Architecture

Decision: DisciplineCoach follows Joomla 6 architecture and conventions wherever possible.

Reason: Joomla already provides proven solutions for users, authentication, ACL, multilingual support, MVC, forms, media and extension installation.

Status: Accepted

#### Component Packaging

Decision: Project documentation remains outside the Joomla component installation package.

Reason: Documentation is intended for developers and contributors.

Status: Accepted

#### Joomla MVC Foundation

Decision: The component uses Joomla 6 MVC with a service provider, component class, controllers, models, HTML views and administrator templates.

Status: Implemented

### 2026-10-31

#### Dashboard Navigation Model

Decision: The administrator dashboard is the primary navigation hub.

Initial modules:

- Disciplines
- Coaches
- Requests
- Configuration

Reason: A tile-based dashboard is clear, extensible and suitable for future growth.

Status: Implemented

#### Coach Terminology

Decision: The term “Coach” is used instead of “Trainer”.

Reason: Coach is more generic and better fits sports, education, communities and knowledge domains.

Status: Accepted

#### Moderator Role Model

Decision: Moderators remain coaches or members with additional permissions.

Reason: Moderator permissions extend a role within a specific discipline.

Status: Accepted

#### Dashboard-First Development Approach

Decision: Future modules are first represented on the dashboard before full implementation.

Reason: This establishes navigation early and supports controlled development.

Status: Accepted

### 2026-11-10

#### Interface and Content Translations

Decision: Interface translations and discipline content translations are handled separately.

Interface text is stored in Joomla language files. Discipline titles and aliases are stored in the database.

Reason: Interface phrases belong to the component, while discipline content is entered by the website administrator and differs per website and language.

Status: Implemented in version 0.1.3

#### Joomla Content Languages

Decision: Published Joomla content languages determine which discipline translations are required.

Reason: This keeps multilingual content aligned with the Joomla website and avoids a separate language configuration.

Status: Implemented in version 0.1.3

#### Discipline Translation Storage

Decision: Shared discipline data and translated content are stored in separate tables.

```text
#__dc_disciplines
#__dc_disciplines_lang
```

Reason: Images and publication status apply to the complete discipline, while titles and aliases differ per language. This also avoids language-specific columns such as `title_nl` and `title_en`.

Status: Implemented in version 0.1.3

#### Discipline Translation Relationship

Decision: Translations are linked through `discipline_id`.

Reason: The main discipline ID already provides a stable parent-child relationship, so a separate translation key is unnecessary.

Status: Implemented in version 0.1.3

#### One Translation Per Language

Decision: A discipline can have no more than one translation for the same language.

Reason: Duplicate language records would make display selection ambiguous.

Status: Implemented in version 0.1.3

#### Alias Uniqueness

Decision: A discipline alias must be unique within its content language.

Reason: The same alias must not identify two disciplines within one language.

Status: Implemented in version 0.1.3

#### Shared Discipline Image

Decision: The image is stored once and shared by all translations.

Reason: The image represents the discipline rather than a language-specific title.

Status: Implemented in version 0.1.3

#### Shared Publication State

Decision: Publication state is stored once in the main record.

Reason: Publishing currently applies to the complete discipline and all translations.

Status: Implemented in version 0.1.3

#### Multilingual Discipline Form

Decision: All published content languages are shown as tabs in one form.

Reason: Administrators can enter every translation without opening separate forms. All panels remain in the same form, preserving entered values while switching.

Status: Implemented in version 0.1.3

#### Simultaneous Translation Saving

Decision: All available translations are saved in one operation.

Reason: This provides a consistent workflow and creates a complete translation set.

Status: Implemented in version 0.1.3

#### Transactional Saving

Decision: The main discipline and all translations are saved inside one database transaction.

Reason: A failed translation must not leave partial records.

Status: Implemented in version 0.1.3

#### Required Translations

Decision: A title and alias are required for every available content language.

Reason: The current workflow creates a complete set of translations in one operation.

Status: Implemented in version 0.1.3

#### Active Language Selection

Decision: New disciplines open in the default site content language. Existing disciplines open in the language used to access the record. If unavailable, the first content language is used.

Reason: The form should never open with an empty language selection.

Status: Implemented in version 0.1.3

#### Cascading Translation Deletion

Decision: Deleting a discipline automatically deletes all translations.

Reason: Translation records cannot exist meaningfully without the parent discipline.

Status: Implemented in version 0.1.3

#### Language-Aware Administrator Overview

Decision: The overview displays one translated title and alias for each discipline.

Reason: The overview should remain readable and not show one row per translation.

Status: Implemented in version 0.1.3

#### Administrator Row Interaction

Decision: Overview rows are clickable, while checkbox clicks remain separate from row navigation.

Reason: Clickable rows speed up editing, while checkboxes must continue to support bulk actions.

Status: Implemented in version 0.1.3
