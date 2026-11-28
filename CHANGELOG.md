# Changelog

All notable changes to this project will be documented in this file.

The format is based on Keep a Changelog.

## [0.1.5] - 2026-11-22

### Added
- Administrator membership management view (`view=memberships`)
- Administrator membership edit/create form (`view=membership&layout=edit`)
- Moderator management (assign, update and revoke moderator privileges per discipline)
- Visual moderator status indicators (✓ / ✕) in the memberships overview table
- `MembershipTable` (`administrator/src/Table/MembershipTable.php`) for `#__dc_discipline_memberships`
- `MembershipModel` extending `AdminModel` for form data handling and validation
- `MembershipsModel` and `MembershipsController` extending `AdminController`
- `is_moderator` column in `#__dc_discipline_memberships` table
- Database schema update script `0.1.5.sql`
- Uniqueness validation preventing duplicate trainer-discipline memberships
- Automatic creation timestamp assignment
- Form definition (`administrator/forms/membership.xml`) with user selector, discipline dropdown and moderator toggle
- Clickable table rows in memberships overview with hover effect (`#e7f1ff`) and pointer cursor
- Checkbox click isolation preventing unintended navigation during row selection
- Joomla toolbar integration: New, Delete, Apply, Save, Save & Close, Cancel
- CSRF form token protection and validation on membership views
- Dutch (`nl-NL`) and English (`en-GB`) language strings for membership and moderator administration

### Changed
- Modernized installer script (`script.php`) to implement `InstallerScriptInterface` via direct class return
- Replaced deprecated/removed `Joomla\CMS\Filesystem\Folder` calls with native PHP filesystem functions (`is_dir`, `mkdir`, `file_put_contents`) for Joomla 6 compatibility
- Wrapped installer folder creation and asset deployment in exception handling to prevent installation halts
- Corrected edit form identifier to standard `adminForm` for seamless Joomla toolbar integration
- Standardized toolbar button definitions using `ToolbarHelper::addNew()`

### Fixed
- Fatal PHP error during component installation caused by missing `getParent()` on installer adapter
- "Class Joomla\CMS\Filesystem\Folder not found" error during extension installation in Joomla 6
- Non-functioning toolbar buttons on the memberships list view caused by missing `adminForm` container
- "Table membership not supported. File not found" exception during membership save operations

### Result
Administrators can now view, create, edit and delete trainer-discipline memberships directly in the Joomla administrator interface, fully manage moderator privileges per membership, and experience a smooth, clickable overview table aligned with the discipline management interface.

## [0.1.4] - 2026-11-19

### Added
- Frontend menu item support for DisciplineCoach
- Frontend discipline selection view
- User discipline preference storage
- Loading and displaying previously selected disciplines
- Discipline card image display
- Dutch frontend language support
- English frontend language support
- Frontend language files
- Frontend CSS styling

### Changed
- Redesigned discipline selection interface using discipline cards
- Improved card sizing and responsiveness
- Improved discipline image presentation
- Improved selection visibility for chosen disciplines
- Updated frontend routing and menu integration

### Fixed
- Component installation issues
- Database update script execution
- Frontend menu item routing
- Frontend asset loading
- Discipline selection persistence

### Result

Authenticated Joomla users can now open DisciplineCoach from a frontend
menu item, view available disciplines, select their preferred disciplines
and save their personal discipline preferences. Previously saved
selections are automatically restored when revisiting the page.

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
