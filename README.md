# DisciplineCoach

DisciplineCoach is a multilingual Joomla 6 component for managing disciplines, memberships, moderator assignments, and discipline-based communities.

The component is designed as a flexible foundation for organisations, communities, training platforms, educational environments, and collaborative knowledge domains.

## Key Concepts

- Disciplines
- Coaches
- Memberships
- Moderators
- Community Management

## Goals

- Discipline management
- Membership management
- Moderator assignments
- Role-based access
- Multilingual support
- Flexible terminology configuration

## Design Principles

- Generic and reusable
- Multilingual by design
- Joomla user integration
- Role-based access control
- Extensible architecture
- Configurable terminology

## Current Status

### Version 0.1.1

The Joomla 6 component foundation is operational.

Implemented:

- Joomla 6 component installer
- Service Provider
- Component bootstrap
- MVC infrastructure
- Display Controller
- Dashboard View
- Dashboard Template
- Administrator menu integration
- Dashboard CSS
- Dashboard tile navigation
- Custom dashboard icons

The component can now:

- Install successfully in Joomla 6
- Appear in the Joomla administrator menu
- Load through the Joomla MVC framework
- Display a working administrator dashboard
- Display custom dashboard icons
- Display navigation tiles for the main modules

## Dashboard Modules

The current dashboard contains the following modules:

- Disciplines
- Coaches
- Requests
- Configuration

These modules form the primary navigation structure of the application.

## Planned Features

### Disciplines

- Discipline administration
- Discipline images
- Discipline database table
- Discipline search and filtering

### Coaches

- Coach management
- Moderator assignments
- Discipline memberships
- Search, filtering and sorting

### Requests

- Discipline requests
- Approval workflow
- Request administration

### Configuration

- Terminology configuration
- Language settings
- System settings

## Requirements

- Joomla 6.x
- PHP 8.2+

## Repository Structure

```text
disciplinecoach
│
├── docs
│   ├── architecture.md
│   ├── database.md
│   ├── decisions.md
│   └── glossary.md
│
├── CHANGELOG.md
├── LICENSE
├── README.md
├── ROADMAP.md
│
└── com_disciplinecoach
```

## License

GNU General Public License v2 or later.
