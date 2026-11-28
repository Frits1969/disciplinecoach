# DisciplineCoach

DisciplineCoach is a multilingual Joomla 6 component for managing disciplines, memberships, moderators and discipline-based communities.

The component is designed as a flexible foundation for organisations, communities, sports clubs, training platforms, educational environments and collaborative knowledge domains.

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

### Version 0.1.5

The component currently provides discipline management, membership administration and moderator management in the Joomla administrator interface, alongside discipline selection in the Joomla frontend.

### Administrator Features

- Discipline administration (create, edit, delete, publish, unpublish, bulk operations)
- Multilingual discipline names and aliases
- Discipline image support via Joomla Media Manager
- Membership / Trainer administration (`view=memberships`)
- Create and edit trainer-discipline memberships
- Moderator management (assign, modify and revoke moderator privileges per discipline)
- Visual moderator status indicators (✓ / ✕) in overview tables
- Duplicate membership prevention
- Clickable overview table rows with visual hover effects
- Bulk deletion of memberships
- Multilingual administrator interface (Dutch and English)
- Central administrator dashboard

### Frontend Features

- Frontend menu item support
- Discipline selection page
- Discipline card view
- Discipline images
- Visual selection indication
- User discipline preference storage
- Automatic loading of previously selected preferences
- Dutch language support
- English language support
- Responsive card layout

### Supported Languages

- Dutch (nl-NL)
- English (en-GB)

### Current Capabilities

The component can now:

- Install successfully in Joomla 6
- Upgrade successfully between releases
- Display a working administrator dashboard
- Manage disciplines
- Store discipline images
- Manage multilingual discipline content
- Display disciplines in the frontend
- Allow authenticated users to choose disciplines
- Store selected disciplines
- Restore previously selected disciplines
- Operate in Dutch and English

## Dashboard Modules

The current dashboard contains the following modules:

- Disciplines
- Coaches
- Requests
- Configuration

These modules form the primary navigation structure of the application.

## Database

Current tables include:

- #__dc_disciplines
- #__dc_disciplines_lang
- #__dc_discipline_memberships (including moderator status)

## Release Roadmap

### Version 0.1.5 ✅ Completed

- Membership administration in the Joomla backend
- Trainer-discipline linking and editing
- Moderator management (assign, change and revoke moderator status)
- Visual moderator status indicators in overview tables
- Clickable row UX pattern in list overviews
- Joomla 6 installer modernization and resilience

### Version 0.1.6

Planned:

- Discipline Requests workflow
- Request new disciplines from frontend
- Administrator review and approval process
- Audit information and status tracking

## Future Development

### Coaches

- Coach management
- Coach profiles
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

### Disciplines

- AI-generated discipline imagery
- Advanced filtering
- Pagination
- Extended metadata

## Requirements

- Joomla 6.x
- PHP 8.2+

## Repository Structure

disciplinecoach
├── docs
├── CHANGELOG.md
├── LICENSE
├── README.md
├── ROADMAP.md
└── com_disciplinecoach

## License

GNU General Public License v2 or later.
