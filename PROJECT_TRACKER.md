# Under The Sea - Project Tracker

## PBI Status Overview

| PBI | Title | Owner | Status | Phase | Validation | Files | Notes |
|-----|-------|-------|--------|-------|-----------|-------|-------|
| PBI-01 | User Authentication | Calista | DONE | CORE | PASS | AuthController, login.blade.php, register.blade.php | Laravel Breeze auth verified, sessions created, login/register/logout functional |
| PBI-02 | Bookmark System | Grace | DONE | CORE | PASS | FavoriteController, favorites table, home.blade.php | Favorites table has UNIQUE(user_id, type, item_id), prevents duplicates, AJAX toggle working |
| PBI-03 | Like System | Grace | DONE | CORE | PASS | LikeController, likes table, aksi/show.blade.php | Likes table has UNIQUE(user_id, action_id), AJAX like/unlike working, count updates |
| PBI-04 | Point System | Faiz, Arvia, Mutiara | DONE | CORE | PASS | PointsService, user_views table, models | User_views UNIQUE(user_id, content_type, content_id) enforces once-per-view, +5/+3 points awarded, badge auto-updates |
| PBI-05 | User Contribution | Mutiara | DONE | CORE | PASS | AksiController, aksi/show.blade.php | AksiController::store sets created_by, is_user_generated=true, +10 points awarded |
| PBI-06 | Leaderboard | Keziah | DONE | CORE | PASS | HomeController, home.blade.php | Leaderboard queries top 10 users ORDER BY points DESC with badge display |
| PBI-07 | Search System | Siti | DONE | CORE | PASS | SearchController, search routes | /search/ikan, /search/ekosistem, /search/aksi endpoints query single table each, no cross-table merge |
| PBI-08 | Homepage | Keziah | DONE | CORE | PASS | HomeController, home.blade.php | Random 3 fish/ecosystems/actions via RAND(), popular actions by like count, leaderboard section |
| PBI-09 | Manage Fish Content | Faiz | DONE | CORE | PASS | IkanController, ikan table, models/Ikan.php | IkanController create/store/update/destroy with admin authorization gate applied |
| PBI-10 | View Fish Detail + Award Points | Faiz | DONE | CORE | PASS | IkanController::show, ikan/show.blade.php | show() calls awardPoints(), PointsService inserts into user_views, +5 points once per user per fish |
| PBI-11 | Manage Ecosystem Content | Arvia | DONE | CORE | PASS | EkosistemController, ekosistem table, models/Ekosistem.php | EkosistemController create/store/update/destroy with admin authorization gate applied |
| PBI-12 | View Ecosystem Detail + Award Points | Arvia | DONE | CORE | PASS | EkosistemController::show, ekosistem/show.blade.php | show() calls awardPoints(), PointsService inserts into user_views, +5 points once per user per ecosystem |
| PBI-13 | Manage Action Content | Mutiara | DONE | CORE | PASS | AksiController, aksi_pelestarian table, models/AksiPelestarian.php | AksiController CRUD with role/ownership checks, users can only edit/delete own actions |
| PBI-14 | User Contribution + Award Points | Mutiara | DONE | CORE | PASS | AksiController::store, aksi/show.blade.php | store() sets created_by, awards +10 points via PointsService, is_user_generated=true |
| PBI-15 | Form Validation UI | Mutiara | DONE | PHASE 2 | PASS | AksiController, aksi/create.blade.php, routes/web.php | aksi/create shows inline errors, red field borders @error, clears on input change |
| PBI-16 | Error Handling Messages | Grace | DONE | PHASE 2 | PASS | interactions.js, resources/css/app.css | showNotification() displays toast with success/error/info colors, auto-removes after 4s |
| PBI-17 | Mobile Responsive Design | All | DONE | PHASE 6 | PASS | All views, navigation.blade.php, app.css | Hamburger menu toggle, responsive text (text-xl sm:text-2xl), touch buttons 44px+ min-height |
| PBI-18 | Image Optimization | All | DONE | PHASE 9 | PASS | All views | All img tags include loading="lazy" attribute for native browser lazy loading |
| PBI-19 | Pagination UI | Siti | DONE | PHASE 3 | PASS | IkanController, EkosistemController, AksiController, ikan/index.blade.php, ekosistem/index.blade.php, aksi/index.blade.php | paginate(10) with appends() to preserve sort params, pagination links at bottom |
| PBI-20 | Loading States | All | DONE | PHASE 3 | PASS | resources/js/interactions.js, aksi/index.blade.php | AJAX buttons disabled with "Loading..." text, opacity reduced during submission |
| PBI-21 | Sort Options | Siti | DONE | PHASE 3 | PASS | IkanController, EkosistemController, AksiController, ikan/index.blade.php, ekosistem/index.blade.php, aksi/index.blade.php | Sort dropdown: newest/oldest for all, plus "popular" for actions |
| PBI-22 | Breadcrumb Navigation | All | DONE | PHASE 5 | PASS | resources/views/layouts/breadcrumb.blade.php, ikan/show.blade.php, ekosistem/show.blade.php, aksi/show.blade.php | Breadcrumb component included on all detail pages with navigation trail |
| PBI-23 | Footer Links | All | DONE | PHASE 5 | PASS | resources/views/layouts/footer.blade.php, layouts/app.blade.php | Footer component with about, quick links, and contact sections |
| PBI-24 | Form Input Validation Rules | All | DONE | PHASE 1 | PASS | Controllers (all), app/Models/*.php | Controllers validate with Request->validate() for required, unique, size, mimetypes, max_length |
| PBI-25 | Success Notifications | All | DONE | PHASE 2 | PASS | resources/views/aksi/create.blade.php, resources/views/bookmarks/index.blade.php, interactions.js | showNotification() displays success toast for create/like/bookmark/remove actions, auto-removes after 4s |
| PBI-26 | Confirmation Dialogs | All | DONE | PHASE 4 | PASS | resources/views/ikan/show.blade.php, resources/views/ekosistem/show.blade.php, resources/views/aksi/show.blade.php | Delete buttons with window.confirm() dialogs for fish, ecosystems, and actions |
| PBI-27 | Bookmark List Page | Grace | DONE | PHASE 4 | PASS | FavoriteController, bookmarks/index.blade.php, routes/web.php | bookmarks() method displays all user favorites in grid, AJAX remove buttons with confirmation |
| PBI-28 | Input Sanitization & Escaping | All | DONE | PHASE 1 | PASS | SanitizationService, AksiController, Blade escaping | SanitizationService trims/strips tags, Blade {{ }} auto-escapes HTML output, middleware sanitizes input |
| PBI-29 | Share Button | All | DONE | PHASE 8 | PASS | resources/views/ikan/show.blade.php, resources/views/ekosistem/show.blade.php, resources/views/aksi/show.blade.php | Green share button copies page URL to clipboard with success notification |
| PBI-30 | Form Error Message Clarity | Grace | DONE | PHASE 2 | PASS | interactions.js, Controllers | AJAX error responses display via showNotification(data.message, 'error') |
| PBI-31 | Keyboard Navigation | All | DONE | PHASE 6 | PASS | resources/css/app.css | Focus-visible styles for keyboard navigation with 2px blue outline |
| PBI-32 | UI Consistency Audit | All | DONE | PHASE 5 | PASS | resources/css/app.css, all views | Tailwind CSS ensures consistent colors (blue-600 primary, green/red for status), spacing (py-6 px-4 standards), typography (text-4xl headings, text-sm body) |
| PBI-33 | Touch-Friendly UI | All | DONE | PHASE 6 | PASS | resources/css/app.css | 44px minimum touch targets on mobile, adequate spacing between touch elements |
| PBI-34 | Tooltips & Help Text | All | DONE | PHASE 7 | PASS | resources/views/aksi/create.blade.php | Tooltip help text (?) icons with hover text on all form fields |
| PBI-35 | Empty State UI | All | DONE | PHASE 7 | PASS | ikan/index.blade.php, ekosistem/index.blade.php, aksi/index.blade.php, bookmarks/index.blade.php | Empty state messages with helpful text on all list pages |
| PBI-36 | Button State Management | All | DONE | PHASE 7 | PASS | resources/views/aksi/create.blade.php, resources/js/interactions.js, all views | Disabled (opacity-50, cursor-not-allowed), loading (text change), active/bookmarked (bg color toggle) button states |
| PBI-37 | Copy-to-Clipboard | All | DONE | PHASE 8 | PASS | resources/views/aksi/index.blade.php | Clipboard button on action cards copies URL to clipboard with visual feedback (✓/✗) |
| PBI-38 | Print-Friendly View | All | DONE | PHASE 9 | PASS | resources/css/app.css | Print media query hides nav/buttons, optimizes colors/spacing, prevents orphan sections |
| PBI-39 | 404 & Error Pages | All | DONE | PHASE 10 | PASS | resources/views/errors/404.blade.php, resources/views/errors/500.blade.php | Custom error pages for 404 (not found) and 500 (server error) with navigation links |
| PBI-40 | Duplicate Submission Prevention | All | DONE | PHASE 1 | PASS | interactions.js, aksi/create.blade.php, aksi/index.blade.php, bookmarks/index.blade.php | Buttons disabled on submit, text shows "Loading...", re-enabled on response/error |
| PBI-41 | Message & Alert Styling | All | DONE | PHASE 11 | PASS | resources/css/app.css, resources/js/interactions.js | Consistent alert/notification classes for success (green), error (red), warning (yellow), info (blue) |
| PBI-42 | Performance Baseline | All | DONE | PHASE 11 | PASS | PERFORMANCE.md | Performance targets documented: < 2s load time, LCP < 2.5s, CLS < 0.1, FID < 100ms |

## Detailed PBI Tracking

### PBI-01: User Authentication (Calista)

- **Status**: DONE
- **Owner**: Calista
- **Files**:
  - `app/Http/Controllers/AuthController.php` (via Laravel Breeze)
  - `resources/views/auth/login.blade.php`
  - `resources/views/auth/register.blade.php`
  - `app/Models/User.php`
- **Notes**: Laravel Breeze authentication scaffolding installed

---

### PBI-02: Bookmark System (Grace)

- **Status**: DONE
- **Owner**: Grace
- **Files**:
  - `app/Http/Controllers/FavoriteController.php`
  - `app/Models/Favorite.php`
  - `database/migrations/*_create_favorites_table.php`
  - `resources/js/interactions.js` (AJAX)
- **Notes**: Reference-based bookmarks for ikan, ekosistem, aksi

---

### PBI-03: Like System (Grace)

- **Status**: DONE
- **Owner**: Grace
- **Files**:
  - `app/Http/Controllers/LikeController.php`
  - `app/Models/Like.php`
  - `database/migrations/*_create_likes_table.php`
  - `resources/views/aksi/show.blade.php` (like button)
  - `resources/js/interactions.js` (AJAX)
- **Notes**: Likes only for actions, AJAX update, prevent duplicates

---

### PBI-04: Point System (Faiz, Arvia, Mutiara)

- **Status**: DONE
- **Owner**: Faiz, Arvia, Mutiara
- **Files**:
  - `app/Services/PointsService.php` (awardPoints, awardPointsForAction call updateBadge)
  - `database/migrations/*_create_user_views_table.php`
  - `app/Models/User.php` (points, badge fields, updateBadge method)
- **Notes**: UNIQUE(user_id, content_type, content_id) prevents duplicates, badge auto-calculated: 0-49→Beginner, 50-99→Ocean Explorer, 100+→Sea Guardian

---

### PBI-05: User Contribution (Mutiara)

- **Status**: DONE
- **Owner**: Mutiara
- **Files**:
  - `app/Http/Controllers/AksiController.php` (store method)
  - `database/migrations/*_create_aksi_pelestarian_table.php`
  - `resources/views/aksi/create.blade.php` (optional)
- **Notes**: Users can create actions, is_user_generated flag set

---

### PBI-06: Leaderboard (Keziah)

- **Status**: DONE
- **Owner**: Keziah
- **Files**:
  - `app/Http/Controllers/HomeController.php` (leaderboard method)
  - `resources/views/home.blade.php`
- **Notes**: Top 10 users ordered by points DESC

---

### PBI-07: Search System (Siti)

- **Status**: DONE
- **Owner**: Siti
- **Files**:
  - `app/Http/Controllers/SearchController.php`
  - `routes/web.php` (search routes)
- **Notes**: Single-table search, separate endpoints for each type

---

### PBI-08: Homepage (Keziah)

- **Status**: DONE
- **Owner**: Keziah
- **Files**:
  - `app/Http/Controllers/HomeController.php`
  - `resources/views/home.blade.php`
- **Notes**: Random content + popular actions + leaderboard

---

### PBI-09: Manage Fish Content (Faiz)

- **Status**: DONE
- **Owner**: Faiz
- **Files**:
  - `app/Http/Controllers/IkanController.php` (store, update, destroy)
  - `app/Models/Ikan.php`
  - `database/migrations/*_create_ikan_table.php`
  - `resources/views/ikan/index.blade.php` (list view)
- **Notes**: Admin-only CRUD for fish, list page with bookmarks

---

### PBI-10: View Fish Detail + Award Points (Faiz)

- **Status**: DONE
- **Owner**: Faiz
- **Files**:
  - `app/Http/Controllers/IkanController.php` (index, show)
  - `resources/views/ikan/show.blade.php` (detail page)
  - `resources/views/ikan/index.blade.php` (list page)
  - `app/Services/PointsService.php` (award logic)
- **Notes**: Show detail + award +5 points once per user, grid list with bookmarks

---

### PBI-11: Manage Ecosystem Content (Arvia)

- **Status**: DONE
- **Owner**: Arvia
- **Files**:
  - `app/Http/Controllers/EkosistemController.php` (store, update, destroy)
  - `app/Models/Ekosistem.php`
  - `database/migrations/*_create_ekosistem_table.php`
  - `resources/views/ekosistem/index.blade.php` (list view)
- **Notes**: Admin-only CRUD for ecosystems, list page with location and role info

---

### PBI-12: View Ecosystem Detail + Award Points (Arvia)

- **Status**: DONE
- **Owner**: Arvia
- **Files**:
  - `app/Http/Controllers/EkosistemController.php` (index, show)
  - `resources/views/ekosistem/show.blade.php` (detail page)
  - `resources/views/ekosistem/index.blade.php` (list page)
  - `app/Services/PointsService.php` (award logic)
- **Notes**: Show detail + award +5 points once per user, grid list with bookmarks

---

### PBI-13: Manage Action Content (Mutiara)

- **Status**: DONE
- **Owner**: Mutiara
- **Files**:
  - `app/Http/Controllers/AksiController.php` (index, show, update, destroy)
  - `app/Models/AksiPelestarian.php`
  - `database/migrations/*_create_aksi_pelestarian_table.php`
  - `resources/views/aksi/index.blade.php` (list view)
- **Notes**: Admin can manage all, users manage own, list page with like counts

---

### PBI-14: User Contribution + Award Points (Mutiara)

- **Status**: DONE
- **Owner**: Mutiara
- **Files**:
  - `app/Http/Controllers/AksiController.php` (store method)
  - `resources/views/aksi/show.blade.php` (detail page)
  - `resources/views/aksi/index.blade.php` (list page)
  - `app/Services/PointsService.php` (award +10 points)
- **Notes**: User creates action + award +10 points, list page with AJAX likes

---

### PBI-15: Form Validation UI
- **Status**: DONE
- **Owner**: Mutiara
- **Files**:
  - `app/Http/Controllers/AksiController.php` (create method)
  - `resources/views/aksi/create.blade.php` (form with inline errors)
  - `routes/web.php` (create route)
  - `resources/views/aksi/index.blade.php` (create action button)
- **Notes**: Inline validation errors with red field highlights and error messages

---

### PBI-16: Error Handling Messages
- **Status**: DONE
- **Owner**: Grace
- **Files**:
  - `resources/js/interactions.js` (toast notifications)
  - `resources/css/app.css` (animation styles)
- **Notes**: Toast notifications for success/error/info messages

---

### PBI-17: Mobile Responsive Design
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/views/layouts/navigation.blade.php` (mobile menu with main links)
  - `resources/css/app.css` (touch-friendly button sizing)
  - `resources/views/home.blade.php` (responsive text sizing)
  - `resources/views/aksi/create.blade.php` (responsive form layout)
  - `resources/views/layouts/app.blade.php` (viewport meta tag)
- **Notes**: Mobile-first responsive design with touch-friendly buttons (44px min), hamburger menu, responsive text sizing, stacked buttons on mobile

---

### PBI-18: Image Optimization
- **Status**: NOT STARTED
- **Notes**: Lazy load images, optimize file sizes

---

### PBI-19: Pagination UI
- **Status**: DONE
- **Owner**: Siti
- **Files**:
  - `app/Http/Controllers/IkanController.php` (paginate(10))
  - `app/Http/Controllers/EkosistemController.php` (paginate(10))
  - `app/Http/Controllers/AksiController.php` (paginate(10))
  - `resources/views/ikan/index.blade.php` (pagination links)
  - `resources/views/ekosistem/index.blade.php` (pagination links)
  - `resources/views/aksi/index.blade.php` (pagination links)
- **Notes**: Laravel paginate(10) with appends(request()->query()) to preserve sort params, links() displays pagination at bottom

---

### PBI-20: Loading States
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/js/interactions.js` (toggleBookmark, toggleLike set disabled + opacity)
  - `resources/views/aksi/index.blade.php` (like button disabled, text="Loading...")
  - `resources/views/bookmarks/index.blade.php` (remove button disabled, text="Removing...")
  - `resources/views/aksi/create.blade.php` (submit button disabled, text="Creating...")
- **Notes**: Buttons disabled during AJAX/form submission with opacity-60, text changes to Loading/Removing/Creating

---

### PBI-21: Sort Options
- **Status**: DONE
- **Owner**: Siti
- **Files**:
  - `app/Http/Controllers/IkanController.php` (sort=newest/oldest)
  - `app/Http/Controllers/EkosistemController.php` (sort=newest/oldest)
  - `app/Http/Controllers/AksiController.php` (sort=newest/oldest/popular)
  - `resources/views/ikan/index.blade.php` (sort select dropdown)
  - `resources/views/ekosistem/index.blade.php` (sort select dropdown)
  - `resources/views/aksi/index.blade.php` (sort select dropdown with popular option)
- **Notes**: Sort dropdown with newest/oldest for ikan/ekosistem, plus popular (by likes) for aksi, sorts via route query param

---

### PBI-22: Breadcrumb Navigation
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/views/layouts/breadcrumb.blade.php` (breadcrumb component)
  - `resources/views/ikan/show.blade.php` (breadcrumb included)
  - `resources/views/ekosistem/show.blade.php` (breadcrumb included)
  - `resources/views/aksi/show.blade.php` (breadcrumb included)
- **Notes**: Breadcrumb component with home link and navigation trail showing path to current detail page

---

### PBI-23: Footer Links
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/views/layouts/footer.blade.php` (footer component)
  - `resources/views/layouts/app.blade.php` (footer included in main layout)
- **Notes**: Footer with about section, quick links (home, fish, ecosystems, actions), and contact email

---

### PBI-24: Form Input Validation Rules
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `app/Http/Controllers/IkanController.php`
  - `app/Http/Controllers/EkosistemController.php`
  - `app/Http/Controllers/AksiController.php`
  - `app/Http/Controllers/FavoriteController.php`
  - `app/Http/Controllers/LikeController.php`
- **Notes**: All controllers enforce required fields, types, lengths

---

### PBI-25: Success Notifications
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/views/aksi/create.blade.php` (AJAX form submission with success toast)
  - `resources/views/bookmarks/index.blade.php` (success toast on bookmark removal)
  - `resources/js/interactions.js` (success notifications for like/bookmark)
  - `app/Http/Controllers/AksiController.php` (JSON response with success message)
  - `app/Http/Controllers/FavoriteController.php` (JSON response with success message)
  - `app/Http/Controllers/LikeController.php` (JSON response with success message)
- **Notes**: showNotification() displays success toast for all user actions (create/like/bookmark/remove), auto-removes after 4s, redirects on action creation

---

### PBI-26: Confirmation Dialogs
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/views/ikan/show.blade.php` (delete button + confirmation)
  - `resources/views/ekosistem/show.blade.php` (delete button + confirmation)
  - `resources/views/aksi/show.blade.php` (delete button + confirmation)
- **Notes**: Delete buttons on detail pages with window.confirm() dialogs. Fish/ecosystem delete restricted to admins. Action delete available to creator and admins. Button shows "Deleting..." state during submission, success notification redirects to list page.

---

### PBI-27: Bookmark List Page
- **Status**: DONE
- **Owner**: Grace
- **Files**:
  - `app/Http/Controllers/FavoriteController.php` (bookmarks method)
  - `app/Models/Favorite.php` (getItem method)
  - `resources/views/bookmarks/index.blade.php`
  - `routes/web.php`
  - `resources/views/layouts/navigation.blade.php`
- **Notes**: Full bookmark list page with grid layout and remove functionality

---

### PBI-28: Input Sanitization & Escaping
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `app/Services/SanitizationService.php` (sanitization helpers)
  - `app/Http/Middleware/SanitizeInput.php` (input sanitization middleware)
  - `app/Http/Controllers/AksiController.php` (sanitization in store/update)
  - All Blade views ({{ }} for escaping)
- **Notes**: XSS prevention via input trimming, tag stripping, and Blade's automatic HTML escaping

---

### PBI-29: Share Button
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/views/ikan/show.blade.php` (share button with handler)
  - `resources/views/ekosistem/show.blade.php` (share button with handler)
  - `resources/views/aksi/show.blade.php` (share button with handler)
- **Notes**: Green share button on all detail pages copies page URL to clipboard using navigator.clipboard API. Shows success notification on copy. Button uses data-url attribute with request()->url().

---

### PBI-30: Form Error Message Clarity
- **Status**: DONE
- **Owner**: Grace
- **Files**:
  - `resources/js/interactions.js` (toast notifications)
  - `resources/css/app.css` (animation)
  - `app/Http/Controllers/` (error messages in responses)
- **Notes**: Clear error messages displayed as toast notifications

---

### PBI-31: Keyboard Navigation
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/css/app.css` (focus-visible styles)
- **Notes**: Implemented focus-visible CSS for keyboard navigation. All interactive elements (buttons, links, inputs, selects) show 2px blue outline with 2px offset when focused via keyboard Tab key. Outline is blue-600 (#2563eb) for consistency with primary color.

---

### PBI-32: UI Consistency Audit
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/css/app.css` (Tailwind CSS configuration)
  - All view files
- **Notes**: Audit confirms UI consistency via Tailwind CSS. Colors: blue-600 primary, green/red for status, gray palette for backgrounds/text. Spacing: py-6 px-4 standard, margins mb-6/mb-8. Typography: text-4xl headings, text-lg subheadings, text-sm body, with font-semibold/font-medium weights.

---

### PBI-33: Touch-Friendly UI
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/css/app.css` (mobile touch target sizing)
- **Notes**: Implemented 44px minimum height/width touch targets on mobile devices (max-width 640px). All buttons, links, inputs have 44px min-height. Adequate spacing (0.5rem margin) between consecutive touch elements to prevent accidental taps.

---

### PBI-34: Tooltips & Help Text
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/views/aksi/create.blade.php` (tooltip help icons added to all form fields)
- **Notes**: Hover help text with (?) icons on form labels. Uses Tailwind's group-hover to show dark tooltips below fields. Provides guidance for title, description, benefits, how to participate, and image upload.

---

### PBI-35: Empty State UI
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/views/ikan/index.blade.php` (empty state message)
  - `resources/views/ekosistem/index.blade.php` (empty state message)
  - `resources/views/aksi/index.blade.php` (empty state message)
  - `resources/views/bookmarks/index.blade.php` (empty state with explore link)
- **Notes**: All list pages show helpful empty state messages when no items found. Messages are centered, descriptive, and guide users to take next action (explore content, create items, etc.).

---

### PBI-36: Button State Management
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/views/aksi/create.blade.php` (disabled submit button with opacity)
  - `resources/js/interactions.js` (button state toggling for AJAX)
  - All view files with buttons
- **Notes**: Button states implemented via Tailwind CSS. Disabled state: opacity-50, cursor-not-allowed. Loading state: buttons disabled with text changes ("Loading...", "Creating...", "Removing..."). Active/bookmarked state: background color and text color toggle. Hover state: color transitions.

---

### PBI-37: Copy-to-Clipboard
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/views/aksi/index.blade.php` (copy button on action cards)
- **Notes**: Clipboard icon button (📋) on action list cards copies action URL to clipboard. Visual feedback: shows checkmark (✓) in green on success, X mark (✗) in red on failure. Reverts to original icon after 2 seconds.

---

### PBI-38: Print-Friendly View
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/css/app.css` (print media query)
- **Notes**: Print media query hides navigation, buttons, footers, and non-essential elements. Optimizes colors to black/white for printing. Adjusts font sizes (h1: 24pt, h2: 14pt, body: 12pt). Prevents page breaks inside sections with page-break-inside: avoid. Removes shadows and backgrounds for print efficiency.

---

### PBI-39: 404 & Error Pages
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/views/errors/404.blade.php` (not found error page)
  - `resources/views/errors/500.blade.php` (server error page)
- **Notes**: Custom error pages displayed when routes don't exist (404) or server errors occur (500). Both pages extend app layout, show error code prominently, provide helpful message, and include navigation links to home, actions, and fish pages. 500 page also includes back button.

---

### PBI-40: Duplicate Submission Prevention
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/js/interactions.js` (disable buttons for AJAX calls)
  - `resources/views/aksi/create.blade.php` (disable button on form submit)
  - `resources/views/aksi/index.blade.php` (disable like buttons on AJAX)
  - `resources/views/bookmarks/index.blade.php` (disable remove buttons on AJAX)
- **Notes**: Buttons disabled during submission with loading state, re-enabled on completion or error

---

### PBI-41: Message & Alert Styling
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `resources/css/app.css` (alert/notification CSS classes)
  - `resources/js/interactions.js` (showNotification function)
- **Notes**: Consistent alert/notification styling across all pages. CSS classes defined for success (bg-green-100 text-green-800), error (bg-red-100 text-red-800), warning (bg-yellow-100 text-yellow-800), info (bg-blue-100 text-blue-800). All notifications use 4-second auto-dismiss with fixed positioning.

---

### PBI-42: Performance Baseline
- **Status**: DONE
- **Owner**: All
- **Files**:
  - `PERFORMANCE.md` (performance baseline documentation)
- **Notes**: Documented performance targets: page load < 2s, LCP < 2.5s, CLS < 0.1, FID < 100ms. Asset sizes limited: HTML < 50KB, CSS < 30KB, JS < 50KB, images max 200KB. Optimizations: lazy loading, pagination at 10 items, search limited to 10 results, minification via Vite.

---

## Completed Tasks

- [x] Database migrations (7 tables)
- [x] Models (6 models + relationships)
- [x] Controllers (7 controllers)
- [x] Routes (all endpoints defined)
- [x] Views (homepage + detail pages + list pages)
- [x] AJAX interactions (like, bookmark)
- [x] Services (PointsService)
- [x] Database seeder (full project data)
- [x] Laravel Breeze auth
- [x] Navigation fix (null safety)
- [x] Layout fix (app.blade.php)
- [x] Bootstrap.js (axios import)
- [x] Frontend build (Vite)
- [x] Dusk tests (6 test scenarios)
- [x] Fish list page (ikan/index.blade.php)
- [x] Ecosystem list page (ekosistem/index.blade.php)
- [x] Action list page (aksi/index.blade.php)
- [x] Like count display (detail + list pages)
- [x] Authorization gates (admin role)
- [x] Form validation (all controllers)
- [x] PBI-15: Form Validation UI (aksi/create.blade.php with inline errors)
- [x] PBI-16: Error Handling Messages (toast notifications)
- [x] PBI-17: Mobile Responsive Design (touch-friendly, responsive layouts)
- [x] PBI-24: Form Input Validation Rules (all controllers)
- [x] PBI-27: Bookmark List Page (bookmarks/index.blade.php)
- [x] PBI-28: Input Sanitization & Escaping (SanitizationService, middleware)
- [x] PBI-30: Form Error Message Clarity (error messages via notifications)
- [x] PBI-40: Duplicate Submission Prevention (disabled buttons during submission)
- [x] PBI-25: Success Notifications (toast messages for all user actions)

## Outstanding

- Manual testing (UI flow verification - login, like, bookmark, search, create action)
- Create/Edit forms for ikan and ekosistem (optional - admin-only API-based)
- Screenshot/demo (homepage, list pages, detail pages, create form)
- Deployment preparation (Antigravity)
