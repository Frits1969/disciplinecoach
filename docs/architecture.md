# Architecture

## Purpose

DisciplineCoach is a multilingual Joomla component designed to manage disciplines, memberships, moderators, and discipline-related content.

The component is intentionally designed to be independent of any specific subject area and can be used for sports, education, hobbies, professional knowledge domains, communities, and collaborative environments.

## Design Principles

- Generic and reusable
- Multilingual by design
- Joomla user integration
- Role-based access control
- Discipline-centered organization
- Extensible architecture
- Configurable terminology

## Core Concepts

### Discipline

A discipline represents a field of interest, specialization, expertise, knowledge domain, skill area, activity, community, or subject area.

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

A discipline is the central organizing object of the system.

### User

Users are managed by Joomla.

DisciplineCoach extends Joomla users by linking them to disciplines and assigning additional responsibilities.

### Membership

A membership defines the relationship between a user and a discipline.

A user may have multiple memberships.

### Moderator

A moderator is a user with additional responsibilities within a specific discipline.

Moderator privileges are assigned through memberships and are discipline-specific.

A user may be a moderator for one discipline and a regular member of another.

### Content

Content belongs to a discipline.

Examples may include:

- Exercises
- Training plans
- Documents
- Images
- Articles
- Knowledge resources

## User Roles

### Registered User

Standard Joomla user.

### Member

A user linked to one or more disciplines.

### Moderator

A member with moderation privileges within one or more disciplines.

### Super Administrator

A Joomla Super Administrator with full system access.

## Relationships

User
↓
Membership
↓
Discipline

Discipline
↓
Content

Membership
↓
Moderator Privileges

## Discipline Management

Users may select one or more disciplines.

Users can change their discipline assignments.

If a user becomes a member of a discipline, moderator privileges do not automatically follow.

Moderator privileges must be explicitly assigned for each discipline.

If a discipline does not exist:

- The user submits a request.
- A Super Administrator reviews the request.
- The discipline is added to the system.
- The discipline becomes available for all users.

## Terminology

The component internally uses the term "Discipline".

Administrators may define an alternative label that is displayed throughout the user interface.

Examples include:

- Discipline
- Sport
- Musical Instrument
- Subject
- Domain
- Specialization
- Area of Expertise

The selected label affects only the user interface and does not change the internal data model.

## Multilingual Support

The component is designed for multilingual environments.

Initial languages:

- Dutch
- English

Both system labels and discipline-related content should support multilingual usage.

## Future Expansion

The architecture should support:

- Multiple disciplines per user
- Multiple moderators per discipline
- Content workflows
- Approval processes
- Notifications
- Frontend discipline management
- Community features

## Current Status

Design phase.
