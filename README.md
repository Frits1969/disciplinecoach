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

### Version 0.1.4

The component currently provides discipline management in the Joomla administrator interface and discipline selection in the Joomla frontend.

### Administrator Features

- Discipline administration
- Create disciplines
- Edit disciplines
- Delete disciplines
- Publish disciplines
- Unpublish disciplines
- Bulk publish
- Bulk unpublish
- Bulk delete
- Search by title
- Search by alias
- Status filtering
- Sorting by title
- Sorting by alias
- Sorting by publication status
- Discipline image support
- Joomla Media Manager integration
- Multilingual discipline names
- Multilingual discipline aliases
- Language-aware administration

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
- #__dc_user_disciplines

## Release Roadmap

### Version 0.1.5

Planned:

- Further frontend improvements
- Membership administration foundation
- Improved administrator workflows
- Additional validation and usability improvements

### Version 0.1.6

Planned:

- Moderator administration
- Assign a moderator to a discipline
- Change moderator assignments
- Remove moderator assignments
- Moderator overview per discipline
- Discipline overview per moderator

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
