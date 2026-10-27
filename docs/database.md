# Database Design

## Current Status

The data model is currently under design.

## Planned Entities

### Disciplines

A discipline represents a field of knowledge, expertise, activity, or interest within the system.

Examples:

- Badminton
- Football
- Music
- First Aid
- Leadership

Properties may include:

- Name
- Description
- Logo
- Image
- Published state

### Users

Users are managed by Joomla.

DisciplineCoach extends Joomla users through memberships.

### Memberships

A membership connects a user to a discipline.

Properties may include:

- User
- Discipline
- Moderator Status

A user may belong to multiple disciplines.

A discipline may contain multiple users.

### Moderators

Moderator status is stored within the membership.

This allows a user to be:

- A moderator in Discipline A
- A normal member in Discipline B
- A moderator in Discipline C

Moderator privileges are therefore discipline-specific.

### Content

Future content entities may include:

- Exercises
- Training plans
- Documents
- Images
- Articles
- Knowledge assets

## Terminology Configuration

The component internally uses the term "Discipline".

The displayed terminology can be configured by the administrator.

Examples:

- Discipline
- Sport
- Musical Instrument
- Subject
- Domain
- Specialization

This configuration affects the user interface only and does not affect the database structure.

## Notes

The final database schema has not yet been defined.

Table names, indexes, relationships, and constraints remain subject to review.
