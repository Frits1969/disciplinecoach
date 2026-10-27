# Design Decisions

This document records important architectural and functional decisions for DisciplineCoach.

---

## 2026-09-16

### Terminology

Decision:

The project uses the term "Discipline" as its primary business concept.

Reason:

The system must remain generic and should not be limited to sports.

A discipline represents a field of expertise, knowledge, activity, specialization, interest, or community.

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

---

### Terminology Configuration

Decision:

The software uses the term "Discipline" internally.

Administrators may configure an alternative label for display throughout the user interface.

Examples include:

- Discipline
- Sport
- Musical Instrument
- Subject
- Domain
- Specialization
- Area of Expertise
- Activity

Reason:

Different communities may use different terminology while requiring the same underlying functionality.

The configured label affects only the user interface and does not modify the internal data model.

Status:

Accepted

---

### Documentation Language

Decision:

Project documentation is maintained in English.

Reason:

English is the common language for software development and GitHub projects.

Status:

Accepted

---

### Joomla User Management

Decision:

User accounts are managed by Joomla.

Reason:

Joomla already provides authentication, authorization, registration, account activation, password management, and multilingual support.

DisciplineCoach should extend Joomla users instead of replacing Joomla user management.

Status:

Accepted

---

### Membership Model

Decision:

A user may belong to multiple disciplines.

Reason:

Users may actively participate in multiple disciplines.

Examples:

- Badminton
- Football
- Music
- First Aid
- Leadership

Status:

Accepted

---

### Moderator Assignment Model

Decision:

Moderator status is assigned per membership and not per user.

Reason:

A user may have different responsibilities within different disciplines.

Examples:

User:
- Moderator in Badminton
- Member in Volleyball
- Moderator in Hockey

Therefore, moderator privileges must be linked to the relationship between a user and a discipline.

Status:

Accepted

---

### Discipline Creation

Decision:

Disciplines may only be created by a Super Administrator.

Reason:

This prevents duplicate or inconsistent disciplines and maintains quality control.

If a user cannot find a suitable discipline, the user may submit a request.

The Super Administrator reviews the request and decides whether the discipline should be added.

Status:

Accepted

---

### Initial Multilingual Support

Decision:

The first supported languages are Dutch and English.

Reason:

The initial target audience consists of Dutch-speaking and English-speaking users.

Status:

Accepted

---

### Design Philosophy

Decision:

Documentation and architectural design must be completed before implementing functionality.

Reason:

A stable architecture reduces rework and keeps development organized.

Status:

Accepted
