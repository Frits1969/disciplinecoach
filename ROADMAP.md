# DisciplineCoach Roadmap

## Phase 1 - Foundation ✅ Completed (Version 0.1.0)

### Documentation

- GitHub repository created
- Architecture defined
- Database design documented
- Design decisions documented
- Terminology defined
- Project roadmap established

### Joomla 6 Foundation

- Joomla component skeleton created
- Installation manifest created
- Service Provider implemented
- Component class implemented
- Display Controller implemented
- Dashboard View implemented
- Dashboard Template implemented
- Administrator menu integration completed
- Working Joomla MVC architecture established

### Result

DisciplineCoach installs successfully and provides a working Joomla administrator environment.

---

## Phase 2 - Dashboard ✅ Completed (Version 0.1.1)

### Dashboard

- Dashboard CSS implemented
- Dashboard icon support implemented
- Dashboard graphics integrated
- Dashboard tile navigation implemented

### Dashboard Modules

- Disciplines
- Coaches
- Requests
- Configuration

### Result

The dashboard serves as the central navigation hub of DisciplineCoach.

---

## Phase 3 - Discipline Management ✅ Completed (Version 0.1.2)

### Administration

- Discipline overview
- Create discipline
- Edit discipline
- Delete discipline
- Publish discipline
- Unpublish discipline
- Bulk operations
- Search and filtering
- Sorting
- Image management
- Media Manager integration

### Result

Administrators can fully manage disciplines.

---

## Phase 4 - Multilingual Support ✅ Completed (Version 0.1.3)

### Administrator

- Dutch language support
- English language support
- Multilingual dashboard
- Multilingual forms
- Multilingual validation messages

### Disciplines

- Multilingual discipline names
- Multilingual aliases
- Language-aware administration
- Translation storage architecture

### Result

DisciplineCoach became fully multilingual.

---

## Phase 5 - User Discipline Selection ✅ Completed (Version 0.1.4)

### Frontend

- Frontend menu item support
- Discipline overview
- Discipline card layout
- Discipline image display
- Responsive frontend interface

### User Selection

- Users can select disciplines
- Users can deselect disciplines
- User selections are stored
- Previous selections are automatically restored

### Language Support

- Dutch frontend translations
- English frontend translations

### Database

- User-discipline relationship storage

### Result

Authenticated users can select and manage their preferred disciplines from the frontend.

---

## Phase 6 - Membership & Moderator Foundation ✅ Completed (Version 0.1.5)

### Membership Administration

- Membership overview (`view=memberships`)
- Membership create and edit interface (`view=membership&layout=edit`)
- Membership deletion and bulk deletion
- Native Joomla MVC Table (`MembershipTable`) implementation
- AdminModel integration with automatic data binding and validation
- Form definition with user selection, discipline SQL dropdown and moderator toggle
- Clickable overview table rows with hover highlighting (`#e7f1ff`) and pointer cursor
- Checkbox event propagation isolation

### Moderator Management

- Assign moderator responsibilities to discipline members
- Update or revoke moderator status via the edit form
- Visual moderator status indicators (✓ / ✕) in the overview table
- Database storage via `is_moderator` column in `#__dc_discipline_memberships`

### System & Installer

- Modernized `script.php` implementing `InstallerScriptInterface`
- Native PHP filesystem operations replacing deprecated `Joomla\CMS\Filesystem\Folder` for Joomla 6
- Exception handling in installer asset routines
- Full Dutch (`nl-NL`) and English (`en-GB`) language support

### Database

- Added `is_moderator` column to `#__dc_discipline_memberships`
- Created schema update script `0.1.5.sql`

### Result

Administrators can fully manage trainer-discipline memberships and designate moderators with a refined, clickable user interface.

---

## Phase 7 - Discipline Requests (Version 0.1.6)

### Request Workflow

- Request new discipline
- Submit request
- Approve request
- Reject request

### Administration

- Request overview
- Request processing
- Audit information
- Status tracking

### Result

Users can request new disciplines and administrators can manage the approval process.

---
