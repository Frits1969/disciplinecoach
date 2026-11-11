# Changelog

All notable changes to this project will be documented in this file.

The format is based on Keep a Changelog.

### [0.1.3] - 2026-11-10

#### Added
- Dutch administrator language files
- English administrator language files
- Translatable dashboard texts
- Translatable discipline overview
- Translatable discipline form
- Translatable buttons, labels, statuses and system messages
- Multilingual discipline names
- Multilingual discipline aliases
- Language tabs in the discipline form
- Simultaneous saving of all available discipline translations
- Automatic selection of the active content language
- Separate discipline translation table
- Content language-aware discipline overview
- Joomla form token validation

#### Changed
- Moved discipline titles and aliases from the main discipline table to the translation table
- Updated the discipline create and edit workflow for multilingual content
- Updated discipline search and sorting for translated titles and aliases
- Updated database installation and removal scripts
- Updated administrator controllers, models, views and templates
- Updated discipline overview styling
- Increased the size of discipline selection checkboxes
- Improved row hover and mouse pointer behaviour

#### Database
- Added `#__dc_disciplines_lang`
- Linked translations to `#__dc_disciplines` through `discipline_id`
- Added one translation record per available content language
- Added cascading deletion of discipline translations
- Added unique language and alias indexes

#### Result

The Discipline administration module now supports multilingual discipline
names and aliases. Administrators can switch between all available content
languages, enter every translation in one form and save all translations
simultaneously.

## [0.1.2] - 2026-11-08

### Added

- Discipline database table
- Discipline create functionality
- Discipline edit functionality
- Discipline delete functionality
- Bulk delete functionality
- Publish functionality
- Unpublish functionality
- Bulk publish functionality
- Bulk unpublish functionality
- Search by title
- Search by alias
- Status filtering
- Sorting by title
- Sorting by alias
- Sorting by publication status
- Joomla Media Manager image integration
- Discipline image storage
- Discipline image thumbnails
- Clickable discipline rows
- Select all / deselect all support

### Improved

- Discipline administration workflow
- Discipline overview usability
- Discipline image handling
- Form integration
- CSS styling and user experience

### Result

The Discipline module is now fully functional and can be used to manage disciplines, images and publication states within Joomla 6.

## [0.1.1] - 2026-10-30

### Added

- Dashboard CSS
- Dashboard tile navigation
- Dashboard icon support
- Custom dashboard graphics
- Dashboard module layout

### Dashboard Modules

- Disciplines
- Coaches
- Requests
- Configuration

### Improved

- Dashboard appearance
- Dashboard navigation structure
- Media file integration
- CSS asset loading

### Result

The application now provides a visual management dashboard and a primary navigation structure for future development.

## [0.1.0] - 2026-10-29

### Added

- Joomla 6 component installation manifest
- Service Provider infrastructure
- Component bootstrap
- Component class
- Display Controller
- Dashboard HtmlView
- Dashboard template
- Administrator menu integration
- Working Joomla MVC implementation

### Result

The component:

- Installs successfully in Joomla 6
- Appears in the Joomla administrator menu
- Loads through the Joomla MVC framework
- Displays a working administrator dashboard

## [0.0.1] - 2026-09-16

### Added

- GitHub repository created
- Initial project documentation
- Architecture design started
- Database design started
- Joomla component planning
