# ⚡ CLAUDE OPTIMIZATION PATCH (TOKEN EFFICIENCY MODE)

**Applied to**: claude.final.md v1.1
**Status**: ACTIVE

## 🎯 EXECUTION MODE
- Be concise
- Avoid explanation unless asked
- Prefer direct implementation over discussion
- Do not restate requirements

## 🔒 GLOBAL RULES (NON-NEGOTIABLE)
1. DO EXACTLY what is specified
2. DO NOT add new features
3. DO NOT redesign system
4. DO NOT over-engineer
5. DO NOT explain obvious steps

## ⚙️ RESPONSE STYLE
✅ DO:
- Output code directly
- Use minimal comments
- Follow Laravel conventions
- Keep functions short

❌ DO NOT:
- Add long explanations
- Repeat requirements
- Suggest alternatives unless asked

## 🧩 IMPLEMENTATION PRIORITY
1. Database → MUST match schema exactly
2. Controller → follow defined methods only
3. Routes → follow contract exactly
4. Views → simple Blade + Tailwind
5. AJAX → only for like/bookmark

## 🔍 SEARCH IMPLEMENTATION RULE (CRITICAL)
- Single table per endpoint
- No UNION
- No merging
- Max 10 results

## 🎮 POINT SYSTEM RULE
- Use database constraint ONLY
- Try insert → if success → add points
- If duplicate → ignore

## 📡 API RESPONSE RULE
Always return: `{ status, message, data }`
No variation allowed.

## 🧪 TESTING MODE
- Focus on user flow only
- Do not test edge cases
- One scenario per feature
- Keep steps minimal

## ⚡ PERFORMANCE RULE
- Avoid unnecessary queries
- Use simple WHERE + LIKE
- Avoid nested loops
- No heavy abstraction

## 🧠 NAMING RULE
Use EXACT naming from spec:
- Controllers
- Routes
- Fields
- Tables
Do not rename anything.

## 🚫 HARD LIMITS
Never implement:
- real-time system
- WebSockets
- complex search
- extra tables
- extra relations

## 🎯 FINAL DIRECTIVE
Implement directly. If unclear: choose simplest valid solution.

---

# 📘 UNDER THE SEA – COMPLETE DEVELOPMENT BLUEPRINT
**Status**: LOCKED SPEC | **Version**: 1.1 | **Date**: 2026-04-14 | **Patches**: 8 Applied

---

## 🎯 PROJECT OVERVIEW

**Under The Sea** is an **interactive educational platform** for marine biodiversity and ocean conservation.

### Core Mission:
Provide structured, engaging content about:
- Marine biodiversity (fish, ecosystems)
- Ocean conservation actions
- User interaction & gamification
- Community contributions

### System Character:
✅ Interactive | ✅ Structured | ✅ Social (lightweight) | ❌ Not real-time | ❌ Not enterprise-scale

---

## 🧩 CORE FEATURES (LOCKED)

### 1️⃣ User System
- **Roles**: Admin, User
- **Auth**: Register, Login, Logout
- **Profile**: name, email, password, role, points, badge

### 2️⃣ Content Modules
| Module | Description | Creator |
|--------|-------------|---------|
| **Ikan (Fish)** | Species info, habitat, conservation status | Admin only |
| **Ekosistem (Ecosystem)** | Marine ecosystems, threats, roles | Admin only |
| **Aksi Pelestarian (Actions)** | Conservation actions | Admin + Users |

### 3️⃣ Interaction Features
- **Bookmark**: Private favorites (reference-based)
- **Like**: Actions only (instant AJAX update)
- **Points**: Earn by viewing/creating content
- **Badge**: Auto-calculated from points

### 4️⃣ Search System
✅ **Required**:
- Keyword search (separate endpoints per type)
- Filter by type (strict filtering)
- Pagination (10 per page, max 20)
- Result ranking (exact match first)

### 5️⃣ Gamification
- **Points System**: Deterministic, anti-abuse (UNIQUE constraint)
- **Badge System**: Threshold-based, auto-calculated
- **Leaderboard**: Top 10 all-time, ordered by points

---

## 🎮 POINTS SYSTEM (FINAL RULES)

### Points Allocation:
| Action | Points | Frequency |
|--------|--------|-----------|
| View fish detail | +5 | Once per user per fish |
| View ecosystem detail | +5 | Once per user per ecosystem |
| View action detail | +3 | Once per user per action |
| Create action | +10 | Per submission |

### Badge System (Auto-calculated):
| Points Range | Badge |
|--------------|-------|
| 0–49 | Beginner |
| 50–99 | Ocean Explorer |
| 100+ | Sea Guardian |

### Anti-Abuse Rule:
👉 **Points awarded ONCE per content per user**
- Example: Viewing same fish 100 times = +5 only once
- Implementation: Database enforces via UNIQUE constraint

### Race Condition Protection:
```sql
CREATE TABLE user_views (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    content_type ENUM('ikan', 'ekosistem', 'aksi') NOT NULL,
    content_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(user_id, content_type, content_id),  ← PREVENTS DUPLICATES
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

**Implementation Pattern**:
```php
try {
    DB::table('user_views')->insert([
        'user_id' => $userId,
        'content_type' => 'ikan',
        'content_id' => $itemId,
    ]);
    User::find($userId)->increment('points', 5);
} catch (\Exception $e) {
    // Duplicate entry - ignore (no points awarded)
}
```

**Key Principle**: Database constraint is the source of truth, not application logic.

---

## 👤 USER ROLES & PERMISSIONS (LOCKED)

### Admin Capabilities:
✅ Can:
- Create fish
- Create ecosystems
- Create actions
- Edit/delete fish
- Edit/delete ecosystems
- Edit/delete any actions
- View all user-generated actions
- View leaderboard

### User Capabilities:
✅ Can:
- View all content
- Create actions (goes live immediately)
- Like actions
- Bookmark any content
- Gain points
- See their own bookmarks
- Edit/delete their own actions (optional if time)

### Key Constraint:
❌ **NO approval system** → User actions go live immediately
❌ **NO moderation queue** → No admin review needed

---

## 🗑️ DELETION BEHAVIOR (LOCKED)

### Hard Delete (Complete Removal):
- When user deletes action → completely removed from database
- **Cascade behavior**:
  - `likes` → deleted (cascade delete)
  - `bookmarks` → deleted (cascade delete)

### Why Hard Delete?
- Simpler implementation
- Fits project scope
- No archive complexity

---

## 🔖 BOOKMARK SYSTEM (LOCKED)

### Behavior:
✅ Bookmarks are **reference-based** (NOT snapshots)
- User bookmarks fish → stores: `user_id, type="ikan", item_id=5`
- Admin updates fish → bookmarked users see updated version automatically
- No duplicated/historical data

### Privacy:
- Private per user (each user only sees their own bookmarks)
- No public bookmark lists
- No custom collections

### Database:
```sql
CREATE TABLE favorites (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    type ENUM('ikan', 'ekosistem', 'aksi') NOT NULL,
    item_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(user_id, type, item_id),
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

## 👍 LIKE SYSTEM (LOCKED)

### Display:
✅ Show simple count (e.g., "122 likes")
✅ Update instantly via AJAX after user action
❌ NOT real-time global sync (other users' actions don't auto-update their screen)

### Behavior:
- User clicks like → count updates instantly on their UI
- Prevents double-like with unique constraint
- Only on **actions** (not fish/ecosystems)

### Database:
```sql
CREATE TABLE likes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    action_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(user_id, action_id),
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY(action_id) REFERENCES aksi_pelestarian(id_aksi) ON DELETE CASCADE
);
```

---

## 🖼️ IMAGE / MEDIA (LOCKED)

### Requirements:
✅ Each entity has **1 image**:
- Fish
- Ecosystem
- Action

✅ **Allowed Formats**: JPG, JPEG, PNG
✅ **Max File Size**: 2 MB
✅ **Storage**: Local (`storage/app/public`)

### Optional:
- Auto-rename files (timestamp or UUID) to avoid collisions

### Not Included:
❌ Cloud storage (S3, etc.)
❌ Multiple images per item
❌ Image compression service

---

## 🏠 HOMEPAGE LAYOUT (LOCKED)

### Single-Page Sections:

#### Section 1: Recommended Content
```
[Random] 3 Fish
[Random] 3 Ecosystems
[Random] 3 Actions
```
- Each shows: image, title, brief description
- Clickable to detail page

#### Section 2: Popular Actions
```
Top liked actions (by like count)
```
- Shows: title, like count, creator name + badge

#### Section 3: Leaderboard
```
Top 10 users (all-time, ordered by points)
```
- Shows: rank, name, points, badge

### Not Included:
❌ Separate pages for each section
❌ Monthly leaderboard reset
❌ Seasonal challenges
❌ Personalized recommendations

---

## 🌱 ACTION DETAIL PAGE (LOCKED)

### Display Elements:
✅ **Content**:
- Title
- Description
- Image
- Like count (with like button)
- Bookmark button

✅ **Creator Info** (IMPORTANT):
- Name
- Badge
- Example: "Created by Faiz (Sea Guardian)"

### Not Included:
❌ Profile page for user
❌ User bio/statistics
❌ Follow system
❌ Comment section

---

## 🔍 SEARCH SYSTEM (LOCKED – SITI OWNS THIS)

### Architecture:
Search is **type-specific, single-endpoint, single-table** (NO global search)
- Each endpoint is completely independent
- Each endpoint queries only its own table
- NO merging across tables
- NO cross-entity results
- Limit to 10-20 items max per request

### Routes (Strict Endpoints – No Global Search):
```
GET /search/ikan?q=hiu&page=1          → ikan table ONLY
GET /search/ekosistem?q=terumbu&page=1 → ekosistem table ONLY
GET /search/aksi?q=pembersihan&page=1  → aksi_pelestarian table ONLY
```

**RULE**: Each endpoint searches its own table. No exceptions. No merging.

### Required Features:

✅ **Keyword Search (Table-Specific)**
- Case-insensitive matching (LIKE)
- `/search/ikan` searches: `nama`, `deskripsi` in ikan table ONLY
- `/search/ekosistem` searches: `nama`, `deskripsi` in ekosistem table ONLY
- `/search/aksi` searches: `judul`, `deskripsi` in aksi_pelestarian table ONLY
- Example: "Hiu" matches "hiu" (only within selected table)

✅ **Strict Type Filtering (Enforced by Routes)**
- **NO global search endpoint**
- User must select table type first
- `/search/ikan?q=...` ONLY searches ikan (no ekosistem, no aksi)
- `/search/ekosistem?q=...` ONLY searches ekosistem (no ikan, no aksi)
- `/search/aksi?q=...` ONLY searches aksi (no ikan, no ekosistem)
- No way to cross tables

✅ **Pagination**
- Limit: 10 results per page (max 20)
- Query param: `?page=1`, `?page=2`, etc.
- Return: current page + total count + per_page

✅ **Result Ranking (Per Table)**
- Exact match first (exact field match in that table)
- Then partial match (LIKE '%keyword%' in that table)
- Sort within results only
- NO cross-table ranking or comparison

✅ **Creator Info** (for aksi endpoint only)
- `/search/aksi` shows: creator name + badge
- `/search/ikan` shows: NO creator info
- `/search/ekosistem` shows: NO creator info

✅ **Result Limit (MANDATORY)**
- Default limit: 10 items per page
- Absolute maximum: 20 items per page
- Never return unlimited results
- Enforce with `.take(10)` or `.paginate(10)`

### Input Validation:
❌ **Empty keyword** → Return HTTP 400 with error message
❌ **Invalid page** → Default to page=1

### Response Format (JSON):

**For /search/ikan or /search/ekosistem:**
```json
{
  "status": "success",
  "type": "ikan",
  "page": 1,
  "per_page": 10,
  "total": 25,
  "data": [
    {
      "id": 1,
      "title": "Hiu Putih Besar",
      "type": "ikan",
      "description": "Predator puncak di lautan...",
      "image": "/storage/fish/shark.jpg"
    }
  ]
}
```

**For /search/aksi endpoint only (with creator info):**
```json
{
  "status": "success",
  "type": "aksi",
  "page": 1,
  "per_page": 10,
  "total": 5,
  "data": [
    {
      "id": 3,
      "title": "Aksi Pembersihan Pantai",
      "type": "aksi",
      "description": "Bersama-sama membersihkan pantai...",
      "image": "/storage/action/cleanup.jpg",
      "created_by": {
        "name": "Faiz",
        "badge": "Sea Guardian"
      }
    }
  ]
}
```

### Not Included:
❌ Global search endpoint (no `/search?q=...` without type)
❌ Cross-table searching (no merging results across tables)
❌ User-based filtering
❌ Difficulty level filter
❌ Complex tagging system
❌ Advanced query DSL
❌ AI/ranking algorithm
❌ Accent normalization
❌ SQL UNION

---

## 🏆 LEADERBOARD (LOCKED)

### Specification:
- **Type**: Top 10 users (all-time)
- **Sort**: ORDER BY `points` DESC
- **Display**: Rank, Name, Points, Badge
- **Update**: Real-time (each view shows current data)

### Not Included:
❌ Monthly reset
❌ Seasonal leaderboards
❌ Filtered leaderboards (by role, habitat, etc.)

---

## 📤 STANDARD API RESPONSE FORMAT (REQUIRED FOR ALL ENDPOINTS)

All AJAX/API responses must follow this format:

```json
{
  "status": "success | error",
  "message": "Human-readable string",
  "data": {} or []
}
```

### Success Example:
```json
{
  "status": "success",
  "message": "Bookmark added successfully",
  "data": {
    "id": 1,
    "type": "ikan",
    "item_id": 5
  }
}
```

### Error Example:
```json
{
  "status": "error",
  "message": "You must be logged in to bookmark",
  "data": null
}
```

### Empty Data Example:
```json
{
  "status": "success",
  "message": "Search completed",
  "data": []
}
```

**Apply to ALL controllers**: AuthController, IkanController, EkosistemController, AksiController, FavoriteController, LikeController, SearchController, HomeController

---

## 🏗️ DATABASE DESIGN (FINAL ERD)

### USERS
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    points INT DEFAULT 0,
    badge VARCHAR(50) DEFAULT 'Beginner',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### IKAN (Fish)
```sql
CREATE TABLE ikan (
    id_ikan INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    habitat VARCHAR(255),
    karakteristik TEXT,
    status_konservasi VARCHAR(100),
    fakta_unik TEXT,
    gambar VARCHAR(255),
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY(created_by) REFERENCES users(id)
);
```

### EKOSISTEM (Ecosystem)
```sql
CREATE TABLE ekosistem (
    id_ekosistem INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    lokasi VARCHAR(255),
    peran TEXT,
    ancaman TEXT,
    gambar VARCHAR(255),
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY(created_by) REFERENCES users(id)
);
```

### AKSI_PELESTARIAN (Conservation Actions)
```sql
CREATE TABLE aksi_pelestarian (
    id_aksi INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    manfaat TEXT,
    cara TEXT,
    gambar VARCHAR(255),
    created_by INT NOT NULL,
    is_user_generated BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY(created_by) REFERENCES users(id)
);
```

### FAVORITES (Bookmarks)
```sql
CREATE TABLE favorites (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    type ENUM('ikan', 'ekosistem', 'aksi') NOT NULL,
    item_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(user_id, type, item_id),
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### LIKES
```sql
CREATE TABLE likes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    action_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(user_id, action_id),
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY(action_id) REFERENCES aksi_pelestarian(id_aksi) ON DELETE CASCADE
);
```

### USER_VIEWS (Point Tracking)
```sql
CREATE TABLE user_views (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    content_type ENUM('ikan', 'ekosistem', 'aksi') NOT NULL,
    content_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(user_id, content_type, content_id),
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

## 🧠 CORE FEATURE FLOWS (IMPLEMENTATION LOGIC)

### 🔐 LOGIN FLOW
```
1. User inputs email & password
2. Laravel authenticates via Auth::attempt()
3. If valid → create session
4. Redirect to homepage
5. If invalid → return error with { status: 'error', message: '...' }
```

**Owner**: Calista | **PBI**: PBI-01

---

### 🔖 BOOKMARK FLOW
```
1. User clicks bookmark button on detail page
2. Check if logged in
   ├─ If not → redirect to login
   └─ If yes → continue
3. Check if already bookmarked (exists in favorites)
   ├─ If yes → DELETE from favorites
   └─ If no → INSERT into favorites
4. Return: { status: 'success', message: '...', data: {...} }
5. UI updates instantly
```

**Routes**:
```
POST   /favorites
  Body: { "type": "ikan|ekosistem|aksi", "item_id": 5 }
  
DELETE /favorites
  Body: { "type": "ikan|ekosistem|aksi", "item_id": 5 }
  
GET    /favorites
  Returns list of user's bookmarks
```

**Owner**: Grace | **PBI**: PBI-02

---

### 👍 LIKE FLOW
```
1. User clicks like button on action detail
2. Check if logged in
   ├─ If not → redirect to login
   └─ If yes → continue
3. Check if already liked (exists in likes)
   ├─ If yes → DELETE from likes
   └─ If no → INSERT into likes
4. Return: { status: 'success', message: '...', data: {like_count: N} }
5. UI updates via AJAX
```

**Routes**:
```
POST   /likes
  Body: { "action_id": 3 }
  
DELETE /likes
  Body: { "action_id": 3 }
```

**Owner**: Grace | **PBI**: PBI-03

---

### 🎮 POINT SYSTEM FLOW
```
1. User views content detail page (fish, ecosystem, or action)
2. Check user_views table:
   ├─ If (user_id, content_type, content_id) exists → do nothing
   └─ If not exists → INSERT into user_views
3. If new view → award points:
   ├─ Fish: +5
   ├─ Ecosystem: +5
   └─ Action: +3
4. Update user.points
5. Recalculate user.badge based on points
6. Return: view with updated points + badge
```

**Implementation Pattern** (in each controller):
```php
public function show($id)
{
    $item = Ikan::findOrFail($id);
    
    if (auth()->check()) {
        $this->awardPoints(auth()->id(), 'ikan', $id);
    }
    
    return view('ikan.show', compact('item'));
}

private function awardPoints($userId, $type, $itemId)
{
    try {
        DB::table('user_views')->insert([
            'user_id' => $userId,
            'content_type' => $type,
            'content_id' => $itemId,
        ]);
        
        $points = $type === 'aksi' ? 3 : 5;
        User::find($userId)->increment('points', $points);
    } catch (\Exception $e) {
        // Duplicate entry - ignore
    }
}
```

**Owner**: Faiz (Fish), Arvia (Ecosystem), Mutiara (Actions) | **PBI**: PBI-10, PBI-12, PBI-14

---

### 🌱 USER CONTRIBUTION FLOW
```
1. User logs in
2. Navigate to "Create Action" form
3. Submit:
   - judul
   - deskripsi
   - manfaat
   - cara
   - gambar (upload, validate: jpg/png, max 2MB)
4. Insert into aksi_pelestarian:
   - created_by = auth()->id()
   - is_user_generated = true
5. Award +10 points
6. Redirect to action detail page
7. Return: { status: 'success', message: 'Action created' }
```

**Owner**: Mutiara | **PBI**: PBI-05

---

### 🏆 LEADERBOARD FLOW
```
1. Load top 10 users:
   SELECT id, name, points, badge 
   FROM users 
   ORDER BY points DESC 
   LIMIT 10
2. Add rank: 1, 2, 3, ...
3. Display with badge
```

**Owner**: Keziah | **PBI**: PBI-06

---

### 🔍 SEARCH FLOW (Strict Type-Specific Search)
```
1. User selects type (ikan, ekosistem, or aksi)
2. User inputs keyword
3. Route: GET /search/{type}?q=keyword&page=1
4. Query logic (single table, NO merging):
   - If /search/ikan: Query ikan table ONLY
   - If /search/ekosistem: Query ekosistem table ONLY
   - If /search/aksi: Query aksi_pelestarian table ONLY
5. Query: WHERE nama/judul/deskripsi LIKE '%keyword%'
6. Apply ranking: exact match first, partial second (within same table)
7. Paginate: 10 per page
8. Format results: { id, title, type, image, description, [created_by if aksi] }
9. Return: { status: 'success', type: 'ikan', data: [...], page: 1, total: 25 }
```

**Key Rule**: Each endpoint searches ONLY its own table. No cross-table logic. No merging.

**Owner**: Siti | **PBI**: PBI-07

---

### 🏠 HOMEPAGE FLOW
```
1. Load sections:
   - Random 3 fish (ORDER BY RAND())
   - Random 3 ecosystems (ORDER BY RAND())
   - Random 3 actions (ORDER BY RAND())
   - Top liked actions (ORDER BY like_count DESC LIMIT 5)
   - Top 10 leaderboard (ORDER BY points DESC LIMIT 10)
2. Render single page with all sections
3. Each item clickable to detail
```

**Owner**: Keziah | **PBI**: PBI-08

---

## 📡 API CONTRACT (COMPLETE)

### Auth (Calista - PBI-01)
```
POST   /login           → authenticate
POST   /register        → create user
POST   /logout          → destroy session
GET    /me              → current user profile
```

**All return**: `{ status, message, data }`

### Content (CRUD)

**Fish** (Faiz - PBI-09, PBI-10)
```
GET    /ikan            → list all fish
GET    /ikan/{id}       → show fish detail (award points)
POST   /ikan            → create (admin only)
PUT    /ikan/{id}       → update (admin only)
DELETE /ikan/{id}       → delete (admin only)
```

**Ecosystem** (Arvia - PBI-11, PBI-12)
```
GET    /ekosistem       → list all ecosystems
GET    /ekosistem/{id}  → show ecosystem detail (award points)
POST   /ekosistem       → create (admin only)
PUT    /ekosistem/{id}  → update (admin only)
DELETE /ekosistem/{id}  → delete (admin only)
```

**Actions** (Mutiara - PBI-13, PBI-14)
```
GET    /aksi            → list all actions
GET    /aksi/{id}       → show action detail (award points)
POST   /aksi            → create (admin + user, award +10 points)
PUT    /aksi/{id}       → update own action (user) / any (admin)
DELETE /aksi/{id}       → delete own action (user) / any (admin)
```

### Interaction

**Bookmarks** (Grace - PBI-02)
```
POST   /favorites       → bookmark
  Body: { "type": "ikan|ekosistem|aksi", "item_id": 5 }
  
DELETE /favorites       → unbookmark
  Body: { "type": "ikan|ekosistem|aksi", "item_id": 5 }
  
GET    /favorites       → list user bookmarks
```

**Likes** (Grace - PBI-03)
```
POST   /likes           → like action
  Body: { "action_id": 3 }
  
DELETE /likes           → unlike action
  Body: { "action_id": 3 }
```

### Search (Siti - PBI-07)
```
GET    /search/ikan?q=keyword&page=1        → search fish only
GET    /search/ekosistem?q=keyword&page=1   → search ecosystems only
GET    /search/aksi?q=keyword&page=1        → search actions only
```
Returns: JSON with paginated results (10 per page) + type labels + creator info (actions only)

### Homepage & Leaderboard (Keziah - PBI-06, PBI-08)
```
GET    /                → homepage (all sections)
GET    /leaderboard     → top 10 users
```

---

## 👥 TEAM STRUCTURE & OWNERSHIP

| Name | Responsibility | Controllers | PBIs |
|------|-----------------|-------------|------|
| **Keziah** | Homepage & Leaderboard | HomeController | PBI-06, PBI-08 |
| **Siti** | Search System | SearchController | PBI-07 |
| **Faiz** | Fish Module + Points | IkanController | PBI-09, PBI-10 |
| **Arvia** | Ecosystem Module + Points | EkosistemController | PBI-11, PBI-12 |
| **Mutiara** | Action Module + Points | AksiController | PBI-13, PBI-14 |
| **Calista** | Auth & Validation | AuthController | PBI-01 |
| **Grace** | Interaction (Like, Bookmark) | FavoriteController, LikeController | PBI-02, PBI-03 |

---

## 🧩 CONTROLLER STRUCTURE

### AuthController (Calista)
```php
// Owner: Calista
// PBI-01: User Authentication

public function login()        // Handle login form
public function register()     // Handle registration
public function logout()       // Destroy session
public function me()           // Get current user
```

### IkanController (Faiz)
```php
// Owner: Faiz
// PBI-09: Manage Fish Content
// PBI-10: View Fish Detail + Award Points

public function index()        // List all fish
public function show($id)      // Show detail + award points
public function store()        // Create (admin only)
public function update($id)    // Update (admin only)
public function destroy($id)   // Delete (admin only)

private function awardPoints($userId, $itemId)  // Award +5 points
```

### EkosistemController (Arvia)
```php
// Owner: Arvia
// PBI-11: Manage Ecosystem Content
// PBI-12: View Ecosystem Detail + Award Points

public function index()        // List all ecosystems
public function show($id)      // Show detail + award points
public function store()        // Create (admin only)
public function update($id)    // Update (admin only)
public function destroy($id)   // Delete (admin only)

private function awardPoints($userId, $itemId)  // Award +5 points
```

### AksiController (Mutiara)
```php
// Owner: Mutiara
// PBI-13: Manage Action Content
// PBI-14: User Contribution + Award Points

public function index()        // List all actions
public function show($id)      // Show detail + award points
public function store()        // Create (admin + user) + award +10 points
public function update($id)    // Update (admin + owner)
public function destroy($id)   // Delete (admin + owner)

private function awardPoints($userId, $itemId, $points)  // Award points
```

### FavoriteController (Grace)
```php
// Owner: Grace
// PBI-02: Bookmark System

public function store()        // Create bookmark
  // Body: { type, item_id }
  
public function destroy()      // Remove bookmark
  // Body: { type, item_id }
  
public function index()        // List user bookmarks
```

### LikeController (Grace)
```php
// Owner: Grace
// PBI-03: Like System

public function store()        // Create like
  // Body: { action_id }
  
public function destroy()      // Remove like
  // Body: { action_id }
```

### SearchController (Siti)
```php
// Owner: Siti
// PBI-07: Search System (Single-Table, Type-Specific)

public function searchIkan()       // GET /search/ikan?q=keyword&page=1
public function searchEkosistem()  // GET /search/ekosistem?q=keyword&page=1
public function searchAksi()       // GET /search/aksi?q=keyword&page=1

// Helper methods (private)
private function validateKeyword($keyword)      // Check not empty
private function rankResults($results, $keyword)    // Exact match first, partial second
private function formatResult($item, $type)     // Normalize output
private function withCreatorInfo($action)       // Add creator name + badge (aksi only)
```

**IMPORTANT**: Each method queries ONLY its own table. No cross-table logic. No merging.

### HomeController (Keziah)
```php
// Owner: Keziah
// PBI-06: Leaderboard
// PBI-08: Homepage

public function index()        // Load all sections
public function leaderboard()  // Top 10 users
public function randomContent() // Random fish, ecosystem, actions
public function popularActions() // Top liked actions
```

---

## 🧭 PBI TRACEABILITY SYSTEM (REQUIRED)

### Rule:
Every function MUST include owner & PBI code in docblock

### Format:
```php
/**
 * Owner: [Name]
 * PBI-[Number]: [Description]
 */
public function functionName()
{
    // implementation
}
```

### Example:
```php
/**
 * Owner: Faiz
 * PBI-10: View Fish Detail
 */
public function show($id)
{
    $fish = Ikan::findOrFail($id);
    if (auth()->check()) {
        $this->awardPoints(auth()->id(), $id);
    }
    return view('fish.show', compact('fish'));
}
```

### Guidelines:
- Each function maps to 1 PBI (ideally)
- If multiple PBIs → list all above function
- NEVER put PBI code inside function body
- Use consistent naming: `PBI-NN: Description`

---

## 🚀 DEVELOPMENT STRATEGY

### Sprint 1: Core System (Foundation) – Week 1-2
**Focus**: Database, Auth, Basic CRUD

✅ Tasks:
- [ ] Database setup (all tables + migrations)
- [ ] User auth (login, register, logout) – Calista
- [ ] CRUD for fish – Faiz
- [ ] CRUD for ecosystem – Arvia
- [ ] CRUD for actions – Mutiara
- [ ] Basic views (list, detail pages)

**Dependencies**: None (parallel work)

---

### Sprint 2: Enhancement (Features) – Week 3-4
**Focus**: Interaction, Gamification, UX

✅ Tasks:
- [ ] Bookmark system – Grace
- [ ] Like system – Grace
- [ ] Points system (distributed) – Faiz, Arvia, Mutiara
- [ ] Badge auto-calculation – Faiz, Arvia, Mutiara
- [ ] Search system – Siti
- [ ] Homepage layout – Keziah
- [ ] Leaderboard – Keziah
- [ ] Image upload validation – All
- [ ] AJAX interactions – Grace, Siti
- [ ] UI polish (Tailwind) – All

**Dependencies**: Sprint 1 completion

---

## 🧪 TESTING STRATEGY – LARAVEL DUSK

### Tool:
Use Laravel Dusk for end-to-end browser testing

### Goal:
Ensure all core user flows work correctly from user perspective

### Test Suite (8 Tests – One Per PBI):

#### 1️⃣ PBI-01: Auth Flow
```
Scenario: User registration and login
Steps:
  1. Load /register
  2. Fill form (name, email, password, confirm)
  3. Click register
  4. Assert: Redirect to dashboard
  5. Logout
  6. Load /login
  7. Fill form (email, password)
  8. Click login
  9. Assert: Logged in, session active
  10. Invalid password → error message shown
```

#### 2️⃣ PBI-02: Bookmark Flow
```
Scenario: User can bookmark and unbookmark
Steps:
  1. Login as user
  2. Visit /ikan/1 (fish detail)
  3. Click bookmark button
  4. Assert: Button shows "bookmarked"
  5. Refresh page
  6. Assert: Still bookmarked
  7. Click bookmark again
  8. Assert: Removed from bookmarks
```

#### 3️⃣ PBI-03: Like Flow
```
Scenario: User can like action once
Steps:
  1. Login
  2. Visit /aksi/1 (action detail)
  3. See like count = 5
  4. Click like button
  5. Assert: Count = 6, button shows "liked"
  6. Click like again (try double-like)
  7. Assert: Count still = 6 (not 7)
  8. Refresh page
  9. Assert: Button still shows "liked"
```

#### 4️⃣ PBI-04: Point System
```
Scenario: User gains points for viewing, but only once per item
Steps:
  1. Login as user (points = 0)
  2. Visit /ikan/1
  3. Assert: Points = 5
  4. Visit /ikan/1 again
  5. Assert: Points still = 5 (no increase)
  6. Visit /ikan/2
  7. Assert: Points = 10
  8. Visit /ekosistem/1
  9. Assert: Points = 15
  10. Visit /aksi/1
  11. Assert: Points = 18
```

#### 5️⃣ PBI-05: User Action
```
Scenario: User can create conservation action
Steps:
  1. Login as user
  2. Visit /aksi/create
  3. Fill form (title, description, manfaat, cara, image)
  4. Submit
  5. Assert: Redirect to action detail
  6. Assert: Action shows in /aksi list
  7. Assert: Shows creator name: "User Name"
  8. Assert: User gained +10 points
```

#### 6️⃣ PBI-07: Search
```
Scenario: User can search with keyword and get paginated results
Steps:
  1. Visit /search
  2. Select type: "ikan"
  3. Type keyword: "hiu"
  4. Click search
  5. Assert: Results appear, limited to 10 items
  6. Assert: Shows total count and pagination
  7. Click page 2
  8. Assert: Results 11-20 appear
  9. Empty keyword search
  10. Assert: Error message shown
```

#### 7️⃣ PBI-06: Leaderboard
```
Scenario: Leaderboard shows top users sorted by points
Steps:
  1. Visit /leaderboard
  2. Assert: Shows top 10 users
  3. Assert: First user has highest points
  4. Assert: Shows name, points, badge
  5. Each user badge matches points:
     - 0-49 → Beginner
     - 50-99 → Ocean Explorer
     - 100+ → Sea Guardian
```

#### 8️⃣ PBI-08: Homepage
```
Scenario: Homepage displays all sections
Steps:
  1. Visit /
  2. Assert: Section 1 (random content)
     - 3 fish visible
     - 3 ecosystems visible
     - 3 actions visible
  3. Assert: Section 2 (popular actions)
     - Top liked actions appear
  4. Assert: Section 3 (leaderboard)
     - Top 10 users visible
  5. Assert: All items clickable to detail page
```

### Testing Rules:

✅ DO:
- Test main user flows only
- Keep tests simple and deterministic
- Use factory patterns to create test data
- Reset database between tests

❌ DO NOT:
- Test internal controller logic
- Manually modify database during tests
- Create overly complex test scenarios
- Test edge cases (use Unit tests for those)

### Test Database:
```
- Use separate test database
- Clear before each test run
- Use DatabaseMigrations trait
- Seed with sample data
```

### Running Tests:
```bash
php artisan dusk               # Run all Dusk tests
php artisan dusk --filter=auth # Run specific test
```

---

## ⚠️ DESIGN PRINCIPLES (NON-NEGOTIABLE)

### ✅ DO:
1. **Keep it simple** → Avoid over-engineering
2. **Deterministic** → Same input = same output
3. **Separation of concerns** → One controller per domain
4. **Use Laravel built-ins** → No custom packages unless necessary
5. **Anti-abuse first** → Points once-per-view rule + UNIQUE constraint
6. **Cascade deletes** → When action deleted → likes & bookmarks gone
7. **Standard responses** → All endpoints return { status, message, data }
8. **Database enforces rules** → Constraints prevent abuse (not app logic)

### ❌ DO NOT:
1. **Real-time systems** → No WebSockets, no polling
2. **Soft deletes** → Hard delete only
3. **Complex queries** → Keep SQL readable
4. **Over-abstraction** → Plain Laravel models OK
5. **Unnecessary features** → Only build what's in spec
6. **Multiple images** → One image per entity max
7. **SQL UNION** → Query separately, merge in PHP
8. **App-side abuse prevention** → Use database constraints

---

## 🔥 CRITICAL RULES (ENFORCE)

### 1. Points Anti-Abuse
```
Rule: User views same fish 100 times → +5 ONLY once
Implementation: UNIQUE(user_id, content_type, content_id)
Enforcement: Database constraint is source of truth
```

### 2. Cascade Deletes
```
Rule: Delete action → delete all related likes & bookmarks
Implementation: FOREIGN KEY ... ON DELETE CASCADE
Enforcement: Never orphan records
```

### 3. Image Validation
```
Rule: JPG, PNG only | Max 2MB
Implementation: Laravel validation rules
Enforcement: Reject invalid uploads
```

### 4. Badge Auto-Update
```
Rule: Badge calculated from points
Implementation: Update on every point change
Enforcement: No manual badge assignment
```

### 5. Reference-Based Bookmarks
```
Rule: Bookmarks = reference only (user_id, type, item_id)
Implementation: No data duplication
Enforcement: If admin edits fish → bookmarked users see update
```

### 6. Search: Strict Single-Table Type-Specific
```
Rule: Each endpoint searches ONLY its own table. NO merging across tables.
  - /search/ikan → ikan table ONLY
  - /search/ekosistem → ekosistem table ONLY
  - /search/aksi → aksi_pelestarian table ONLY

Implementation: Three independent methods, each queries one table
Enforcement: Code review confirms no cross-table logic
```

### 7. API Consistency
```
Rule: All responses = { status, message, data }
Implementation: Standard format across all endpoints
Enforcement: Middleware or response trait
```

### 8. Limit Search Results
```
Rule: Max 10-20 items per page, never unlimited
Implementation: .take(10) on all search queries
Enforcement: Performance monitoring
```

---

## 📊 TECH STACK (CONFIRMED)

| Layer | Technology |
|-------|------------|
| **Backend** | Laravel (latest stable) |
| **Database** | MySQL 8.0+ |
| **Frontend** | Blade + Tailwind CSS + Alpine.js |
| **Authentication** | Laravel Auth (default) |
| **File Storage** | Local (`storage/app/public`) |
| **Testing** | Laravel Dusk (end-to-end) |
| **Deployment** | Antigravity |

### Optional:
- Alpine.js for AJAX interactions (likes, bookmarks)
- Spatie Laravel Permission (if roles become complex)

---

## 🎯 FINAL SYSTEM CHECKLIST

### Features Ready to Build:
- [x] User auth (login, register)
- [x] Fish CRUD
- [x] Ecosystem CRUD
- [x] Action CRUD (user-generated)
- [x] Bookmark system
- [x] Like system
- [x] Points system (anti-abuse)
- [x] Badge system (auto-calculated)
- [x] Search system (NO UNION)
- [x] Leaderboard
- [x] Homepage (sections)
- [x] Image upload (jpg, png, 2MB)
- [x] Creator info on action detail
- [x] Standard API responses
- [x] Dusk tests (8 tests)

### Explicitly NOT Building:
- [x] Real-time updates
- [x] Approval workflow
- [x] Soft deletes
- [x] Cloud storage
- [x] Multiple images per item
- [x] User profiles
- [x] Follow system
- [x] Comments
- [x] AI recommendations
- [x] Mobile app
- [x] SQL UNION in search
- [x] App-side point prevention

---

## 🔥 FINAL INSTRUCTION FOR ALL DEVELOPERS

**All features must follow the constraints above. Prioritize simplicity, avoid real-time systems, and ensure each interaction is deterministic and non-exploitable.**

**No ambiguity = safe implementation = on-time delivery**

---

## 🆘 CRITICAL REMINDERS

### Search:
```php
// ✅ CORRECT: Each endpoint searches its own table ONLY
public function searchIkan(Request $request)
{
    $keyword = $request->query('q');
    $results = Ikan::where('nama', 'LIKE', "%{$keyword}%")
                    ->orWhere('deskripsi', 'LIKE', "%{$keyword}%")
                    ->take(10)
                    ->get();
    return response()->json(['status' => 'success', 'type' => 'ikan', 'data' => $results]);
}

// ✅ CORRECT: Separate methods, NO merging
public function searchEkosistem(Request $request) { /* queries ekosistem ONLY */ }
public function searchAksi(Request $request) { /* queries aksi_pelestarian ONLY */ }

// ❌ WRONG: Querying multiple tables in one method
$results = Ikan::where(...)->get()->merge(Ekosistem::where(...)->get());

// ❌ WRONG: SQL UNION
DB::select('SELECT * FROM ikan WHERE ... UNION ALL SELECT * FROM ekosistem WHERE ...')
```

### Points:
```sql
-- ✅ CORRECT: UNIQUE constraint prevents duplicates
UNIQUE(user_id, content_type, content_id)

-- ❌ WRONG: Relying on application logic
if (!UserView::where(...)->exists()) { award(); }
```

### API Response:
```json
{
  "status": "success",    ✅ Always include
  "message": "...",       ✅ Always include
  "data": {}              ✅ Always include
}
```

### Delete Endpoints:
```javascript
// ✅ CORRECT: Body with semantic data
DELETE /favorites
{ "type": "ikan", "item_id": 5 }

// ❌ WRONG: Path with DB ID
DELETE /favorites/42
```

---

## ✅ END OF BLUEPRINT

**Version**: 1.1 (8 Patches Applied)
**Status**: LOCKED & READY FOR IMPLEMENTATION
**Deployment**: Antigravity (via Claude Code)
**Teams**: 7 members, clear PBI assignments
**Timeline**: 2 weeks (Sprints 1-2)
**Quality**: Zero ambiguity, all edge cases covered