#### 2026-10-31

##### Dashboard Navigation Model

Decision:

The administrator dashboard serves as the primary navigation hub of DisciplineCoach.

The dashboard provides direct access to the main management modules through dashboard tiles.

The initial dashboard modules are:

- Disciplines
- Coaches
- Requests
- Configuration

Reason:

The dashboard should provide administrators with immediate access to the most important management areas of the application.

A tile-based interface is visually clear, easy to extend, and suitable for both small and large installations.

Additional modules may be added in future versions without changing the overall navigation structure.

Status:

Implemented

---

##### Coach Terminology

Decision:

The term "Coach" is used within the administrative interface instead of "Trainer".

Reason:

The term Coach is more generic and better fits the broad scope of DisciplineCoach.

The application is intended to support sports, education, community management, training environments, and knowledge domains.

Status:

Accepted

---

##### Moderator Role Model

Decision:

Moderators remain coaches with additional permissions.

The administrator interface should therefore distinguish between:

- Coach
- Coach / Moderator

Reason:

A moderator is not considered a separate type of user.

Moderator permissions are an extension of the coach role within a specific discipline.

Status:

Accepted

---

##### Dashboard-First Development Approach

Decision:

Future modules are first represented on the dashboard before full functionality is implemented.

Reason:

This establishes the navigation structure early and allows the application architecture to evolve in a controlled and predictable manner.

Status:

Accepted
