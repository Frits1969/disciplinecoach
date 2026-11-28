# Design Decisions

This document records the currently accepted architectural, functional and technical decisions for DisciplineCoach.

Version: 0.1.5
Date: 2026-11-22

---

# Project Philosophy

## Generic by Design

DisciplineCoach is not limited to sports.

A discipline may represent:

- A sport
- A musical instrument
- A subject
- An area of expertise
- A hobby
- A profession
- A community
- A knowledge domain

Examples:

- Badminton
- Football
- Hockey
- Piano
- Leadership
- Languages
- First Aid
- Project Management

The software is designed to remain reusable across different domains.

Status:

Accepted

---

## Joomla First

DisciplineCoach follows Joomla standards whenever possible.

The component reuses Joomla functionality instead of replacing it.

Examples:

- Authentication
- Registration
- Password management
- User profiles
- ACL
- Language management
- Media management
- MVC architecture

Status:

Accepted

---

## Documentation Driven Development

Architecture and documentation are maintained alongside development.

All major architectural decisions are documented before or during implementation.

Status:

Accepted

---

# User Management

## Joomla Owns User Accounts

User administration remains the responsibility of Joomla.

DisciplineCoach does not maintain its own user table.

Joomla is responsible for:

- Login
- Logout
- Registration
- Password resets
- User profiles
- User groups
- Access levels

DisciplineCoach extends Joomla users through discipline-related information.

Status:

Accepted

---

## Multiple Disciplines Per User

A user may belong to multiple disciplines.

Examples:

- Badminton
- Football
- Leadership

at the same time.

Status:

Accepted

Implemented in version 0.1.4

---

## Multiple Users Per Discipline

A discipline may contain multiple members.

Examples:

Badminton may contain:

- User A
- User B
- User C

Status:

Accepted

Implemented in version 0.1.4

---

# Discipline Model

## Discipline As Core Entity

The discipline is the central entity within DisciplineCoach.

All future functionality is connected to a discipline.

Examples:

- Memberships
- Moderators
- Requests
- Content
- Communities

Status:

Accepted

---

## Shared and Translated Data Separation

Discipline information is split into:

### Shared Data

Stored once:

- Image
- Publication state
- Audit information

### Translated Data

Stored per language:

- Title
- Alias

Status:

Accepted

Implemented in version 0.1.3

---

## Discipline Images

Each discipline may contain one image.

The image is shared by all translations.

Images are selected through Joomla Media Manager.

Status:

Accepted

Implemented in version 0.1.2

---

## Discipline Publication State

The publication state belongs to the discipline itself and not to individual translations.

Publishing or unpublishing a discipline affects all translations.

Status:

Accepted

Implemented in version 0.1.3

---

# Multilingual Architecture

## Interface Versus Content

Interface translations and content translations are separate concepts.

### Interface

Stored in Joomla language files.

Examples:

- Buttons
- Labels
- Messages
- Headings

### Content

Stored in the database.

Examples:

- Discipline titles
- Discipline aliases

Status:

Accepted

Implemented in version 0.1.3

---

## Joomla Content Languages

Published Joomla content languages determine required translations.

DisciplineCoach does not maintain a separate language configuration.

Status:

Accepted

Implemented in version 0.1.3

---

## One Translation Per Language

A discipline may only contain one translation for the same language.

Example:

Allowed:

Not allowed:

both within en-GB.

Status:

Accepted

Implemented in version 0.1.3

---

## Alias Uniqueness

A discipline alias must be unique within a language.

Examples:

Allowed:

Not allowed:

inside en-GB.

Status:

Accepted

Implemented in version 0.1.3

---

# Membership Architecture

## Membership Table

Memberships are stored separately from disciplines.

Implemented table:

Purpose:

Connect

Status:

Accepted

Implemented in version 0.1.4

---

## Membership Uniqueness

The combination

must be unique.

A user can select a discipline once.

Duplicate memberships are not allowed.

Status:

Accepted

Implemented in version 0.1.4

---

## Persistent Memberships

Discipline selections are permanently stored.

Selections survive:

- Logout
- Login
- Browser restarts
- Session expiration

Status:

Accepted

Implemented in version 0.1.4

---

## Moderator As Membership Attribute

A moderator is not a distinct user account or standalone table entity. Moderator responsibilities extend a discipline membership.

Implemented via:

Values:

- `0` = Standard discipline member
- `1` = Discipline moderator

Status:
Accepted
Implemented in version 0.1.5

---

## Native Joomla Table and AdminModel for Memberships

The backend membership management interface follows standard Joomla 6 MVC architecture:

- `MembershipTable` (`administrator/src/Table/MembershipTable.php`) handles data persistence and uniqueness validation.
- `MembershipModel` extends `AdminModel` to leverage native Joomla save, apply, cancel, validation, and session state workflows.
- `MembershipsController` extends `AdminController` to handle list actions such as bulk deletion.

Status:
Accepted
Implemented in version 0.1.5

---

## Clickable Row Pattern with Checkbox Isolation

Overview tables (Disciplines and Memberships) make entire table rows clickable (`.dc-row-clickable`) to navigate to the item's edit view.

To allow users to select multiple items for bulk operations (e.g. deletion) without triggering row navigation, the checkbox cell isolates event propagation via `event.stopPropagation()`.

Status:
Accepted
Implemented in version 0.1.5

---

# Frontend Design

## Discipline Selection By Users

Users manage their own discipline memberships.

Administrators do not maintain user selections.

Status:

Accepted

Implemented in version 0.1.4

---

## Card Based User Interface

Disciplines are displayed as cards.

Each card contains:

- Image
- Title

The complete card serves as the selection control.

Status:

Accepted

Implemented in version 0.1.4

---

## Visual Selection State

Selected disciplines are displayed using:

- Full colour image
- Distinct border
- Selection highlighting

Unselected disciplines are displayed using:

- Desaturated image
- Neutral border

Status:

Accepted

Implemented in version 0.1.4

---

## Selection Persistence

Selections are restored automatically when a user revisits the page.

Status:

Accepted

Implemented in version 0.1.4

---

## Frontend Routing

Frontend pages are accessed using Joomla menu items.

Reason:

- Multilingual routing
- SEO friendly URLs
- Joomla compatibility

Status:

Accepted

Implemented in version 0.1.4

---

# Security

## Joomla Authentication Required

Only authenticated Joomla users may save discipline selections.

Status:

Accepted

Implemented in version 0.1.4

---

## Own Memberships Only

Users may only manage their own discipline selections.

Users cannot alter disciplines for another Joomla account.

Status:

Accepted

Implemented in version 0.1.4

---

## Published Disciplines Only

Only published disciplines can be selected.

Status:

Accepted

Implemented in version 0.1.4

---

## Form Token Validation

Frontend and administrator forms use Joomla token validation.

Status:

Accepted

Implemented in version 0.1.3

---

# Dashboard Strategy

The administrator dashboard remains the primary entry point.

Current modules:

- Disciplines
- Coaches
- Requests
- Configuration

Additional functionality will be added through existing dashboard modules.

Status:

Accepted

Implemented

---

# Moderator Strategy

## Moderator Assignment

Moderators are assigned by an administrator.

Moderator permissions are discipline specific.

Examples:

- Moderator of Badminton
- Member of Football
- Moderator of Hockey

Status:

Accepted

Implemented in version 0.1.5

---

## Moderator Is Not A Separate User Type

A moderator remains a normal discipline member.

Moderator responsibilities extend a membership.

Status:

Accepted

Implemented in version 0.1.5

---

## Multiple Moderators

A discipline may have multiple moderators.

Examples:

Badminton:

- Moderator A
- Moderator B

Status:

Accepted

Implemented in version 0.1.5

---

# Terminology

## Internal Terminology

The system internally uses:

Status:

Accepted

---

## Future Terminology Configuration

Future versions may allow administrators to replace labels.

Examples:

Database structures remain unchanged.

Status:

Accepted

Planned

---

# Future Expansion

The architecture must support:

- Membership administration
- Moderator management
- Discipline requests
- Approval workflows
- Notifications
- Reporting
- Community features
- Microsoft 365 integration

Status:

Accepted

---

# Current Release Status

## Version 0.1.5

Implemented:

- Joomla 6 administrator foundation
- Administrator dashboard
- Discipline administration
- Multilingual disciplines
- Image support
- Frontend discipline selection
- Discipline memberships
- Membership persistence
- Administrator membership management (`view=memberships` & `view=membership`)
- Moderator assignment flag per membership
- Native Joomla Table (`MembershipTable`) & AdminModel integration
- Clickable overview table rows with checkbox isolation
- Dutch and English translations
- Frontend card interface

Planned:

- Advanced moderator management & discipline overview per moderator
- Discipline requests
- Configuration management
- Community functionality