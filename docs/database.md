# Database Design

## Current Status

The data model is currently under design.

## Design Principles

- Joomla manages users.
- DisciplineCoach extends Joomla user functionality.
- Users may belong to multiple disciplines.
- Moderator permissions are discipline-specific.
- Users manage their own discipline memberships.
- Discipline creation is managed by a Super Administrator.
- All editable entities should support auditing.

## Auditing

All editable entities should contain the following audit fields:

- created
- created_by
- modified
- modified_by

These fields provide information about:

- When a record was created
- Who created the record
- When a record was last modified
- Who performed the last modification

This allows administrators to distinguish between actions performed by members, moderators, and administrators.

## Planned Entities

### Disciplines

A discipline represents a field of knowledge, expertise, activity, or interest within the system.

Examples include:

- Badminton
- Football
- Music
- First Aid
- Leadership
- Languages
- Project Management

Properties may include:

- Id
- Name
- Description
- Logo
- Image
- Published State

Audit fields:

- Created
- Created By
- Modified
- Modified By

### Users

Users are managed by Joomla.

DisciplineCoach does not replace Joomla user management.

User authentication, authorization, registration, password management, and account activation remain the responsibility of Joomla.

DisciplineCoach extends Joomla users through memberships.

### Memberships

A membership connects a user to a discipline.

Properties may include:

- Id
- User
- Discipline
- Is Moderator

A user may belong to multiple disciplines.

A discipline may contain multiple users.

Examples:

User:

- Badminton
- Hockey
- Volleyball

Moderator privileges are assigned through memberships.

A user may be:

- Moderator for Discipline A
- Member for Discipline B
- Moderator for Discipline C

Audit fields:

- Created
- Created By
- Modified
- Modified By

### Discipline Requests

Users may request new disciplines.

The Super Administrator reviews the request and decides whether the discipline should be added.

Properties may include:

- Id
- Requested Name
- Requested By
- Status
- Administrator Remarks

Status values may include:

- Pending
- Approved
- Rejected

Audit fields:

- Created
- Created By
- Modified
- Modified By

### Moderators

Moderator status is stored within the Membership entity.

A separate moderator table is therefore not required.

Moderator privileges are determined by the relationship between a user and a discipline.

### Content

Future content entities may include:

- Exercises
- Training Plans
- Documents
- Images
- Articles
- Knowledge Assets

Content management is not part of the initial version of DisciplineCoach.

Content-related entities will be designed in a future phase.

## Terminology Configuration

The component internally uses the term "Discipline".

The displayed terminology can be configured by the administrator.

Examples include:

- Discipline
- Sport
- Musical Instrument
- Subject
- Domain
- Specialization
- Area of Expertise
- Activity

This configuration affects the user interface only and does not affect the database structure.

## Notes

The final database schema has not yet been defined.

Table names, indexes, relationships, and constraints remain subject to review.

The initial version focuses on:

- Discipline management
- Membership management
- Moderator assignments
- Discipline requests

The initial version does not include:

- Exercises
- Training Plans
- Documents
- Images
- Knowledge Asset Management

These features will be considered in future versions.
