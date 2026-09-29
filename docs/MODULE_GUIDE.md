# MarSU Student Developer Guide: Building Your ERP Module

Welcome, BSIS Student Developers!

This guide is your hands-on manual for building your capstone module inside the **MarSU Centralized ERP** platform. Follow these step-by-step instructions to create new pages, add database tables, protect routes with permissions, and connect widgets to the Executive Dashboard — **with zero risk of merge conflicts**.

---

## Tutorial 1: Building Your First Page in 15 Minutes

Every module is isolated inside its own folder in `modules/<your_slug>/`. Let's assume your module slug is `housing`.

### Step 1: Declare Your Route in `routes.php`
Open `modules/housing/routes.php`:

```php
<?php
use Modules\Housing\Controllers\HomeController;

// Register your route with authentication and permission middleware
$router->get('/housing/rooms', [HomeController::class, 'rooms'], ['auth', 'permission:housing.view']);
$router->post('/housing/rooms/book', [HomeController::class, 'bookRoom'], ['auth', 'permission:housing.register', 'csrf']);
```

### Step 2: Add Your Controller Method
Open `modules/Housing/Controllers/HomeController.php`:

```php
<?php
namespace Modules\Housing\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

class HomeController {
    public function rooms(): void {
        $user = Auth::user();

        // Query your module's table using PDO prepared statements
        $rooms = Database::fetchAll(
            "SELECT r.*, bh.name as boarding_house_name 
             FROM hsg_rooms r 
             JOIN hsg_boarding_houses bh ON r.boarding_house_id = bh.id 
             WHERE r.status = :status AND r.deleted_at IS NULL",
            ['status' => 'available']
        );

        // Render the view template
        View::render('housing/Views/rooms', [
            'title' => 'Available Bed Spaces',
            'rooms' => $rooms,
            'user'  => $user,
            'crumbs'=> ['Boarding Houses' => url('housing'), 'Available Rooms' => '']
        ]);
    }
}
```

### Step 3: Create Your View Template
Create `modules/housing/Views/rooms.php`:

```html
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Available Bed Spaces</h1>
        <p class="text-muted small mb-0">Browse accredited boarding house accommodations near MarSU campus.</p>
    </div>
</div>

<div class="card">
    <div class="card-header card-header-accent">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-door-open-fill me-2"></i>Vacant Rooms Directory</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-marsu">
                    <tr>
                        <th>Boarding House</th>
                        <th>Room No.</th>
                        <th>Capacity</th>
                        <th>Monthly Rent</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($rooms)): ?>
                        <tr><td colspan="5" class="text-center py-4 text-muted">No vacant rooms currently available.</td></tr>
                    <?php else: ?>
                        <?php foreach ($rooms as $r): ?>
                            <tr>
                                <td class="fw-bold text-marsu-burgundy"><?= e($r['boarding_house_name']) ?></td>
                                <td><?= e($r['room_number']) ?></td>
                                <td><span class="badge badge-gold"><?= e($r['vacant_beds']) ?> beds</span></td>
                                <td class="fw-semibold">₱<?= number_format((float)$r['monthly_rate'], 2) ?></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-marsu" onclick="openBookingModal(<?= $r['id'] ?>)">Reserve Space</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
```

Test your new page in the browser at: [`http://localhost/marsu-erp/housing/rooms`](http://localhost/marsu-erp/housing/rooms)!

---

## Tutorial 2: Adding a Database Table

### The Table Prefix Rule
To prevent collisions, your module has been assigned an exclusive prefix (e.g. `hsg_` for Housing, `exp_` for 4Ps, `orf_` for Org Finance). All your tables **must begin with this prefix**.

### Step 1: Create a Migration File
Create a new file in `modules/<slug>/database/migrations/`:
Filename format: `YYYY_MM_DD_NNNNNN_create_<table_name>_table.php`  
Example: `modules/housing/database/migrations/2026_10_01_000001_create_hsg_reservations_table.php`

```php
<?php
use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        $db->exec("CREATE TABLE IF NOT EXISTS `hsg_reservations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `room_id` INT NOT NULL,
            `student_id` INT NOT NULL,
            `reservation_date` DATE NOT NULL,
            `status` ENUM('pending', 'confirmed', 'cancelled') NOT NULL DEFAULT 'pending',
            `remarks` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `hsg_reservations`;");
    }
};
```

### Step 2: Run Your Migration
From PowerShell or Command Prompt, run:
```bash
php scripts/migrate.php housing
```
The migration runner detects your new migration, records it in the `migrations` table under your module's batch, and executes it forward cleanly!

---

## Tutorial 3: Registering Permissions & Protecting Routes

### Step 1: Declare Permissions in `module.json`
Open `modules/<slug>/module.json` and declare your permissions:

```json
"permissions": {
    "housing.view": "View Accredited Boarding Houses",
    "housing.register": "Reserve or Book Room Spaces",
    "housing.inspect": "Conduct Health and Safety Inspections"
}
```

### Step 2: Protect Routes in `routes.php`
```php
// Only users with 'housing.inspect' can access the inspection form
$router->get('/housing/inspect', [HomeController::class, 'inspect'], ['auth', 'permission:housing.inspect']);
```

### Step 3: Check Permissions in Views
Use the global `can()` helper to selectively show UI buttons:

```html
<?php if (can('housing.inspect')): ?>
    <a href="<?= url('housing/inspect') ?>" class="btn btn-accent btn-sm">
        <i class="bi bi-clipboard-check me-1"></i>New Inspection
    </a>
<?php endif; ?>
```

---

## Tutorial 4: Connecting Your Telemetry to the Executive Dashboard

University leadership views institutional performance on `/dashboard`. Every module should export telemetry in `modules/<slug>/widgets.php`:

```php
<?php
use Core\Database;

return [
    // 1. KPI Card Widget
    [
        'id'          => 'housing_kpi_accredited',
        'type'        => 'kpi',
        'title'       => 'Accredited Boarding Houses',
        'icon'        => 'bi-house-check-fill',
        'permission'  => 'housing.view',
        'data'        => function () {
            return (int)Database::fetchColumn("SELECT COUNT(*) FROM hsg_boarding_houses WHERE status = 'accredited' AND deleted_at IS NULL");
        }
    ],

    // 2. Activity List Widget
    [
        'id'          => 'housing_recent_inspections',
        'type'        => 'list',
        'title'       => 'Recent Housing Inspections',
        'icon'        => 'bi-shield-check',
        'permission'  => 'housing.view',
        'data'        => function () {
            return Database::fetchAll(
                "SELECT bh.name as primary_text, i.rating as badge, DATE_FORMAT(i.inspected_at, '%b %d') as sub_text 
                 FROM hsg_inspections i 
                 JOIN hsg_boarding_houses bh ON i.boarding_house_id = bh.id 
                 ORDER BY i.id DESC LIMIT 5"
            );
        }
    ]
];
```

The core dashboard automatically queries your `widgets.php`, evaluates the callbacks, and renders your cards in real-time!

---

## Tutorial 5: MarSU Core Design System & UI Components

### 1. Colors & Theme Classes
| Class | Visual Purpose |
|---|---|
| `.text-marsu-burgundy` | Primary brand color (`#800020`) for headings, emphasis |
| `.btn-marsu` | Primary solid Burgundy button |
| `.btn-outline-marsu` | Subtle Burgundy bordered button |
| `.btn-accent` | Gold accent button (`#D4AF37`) |
| `.badge-gold` | Soft Gold background badge for statuses/years |
| `.badge-burgundy` | Deep Burgundy background badge for categories |
| `.card-header-accent` | Card header with subtle left Gold accent border |
| `.table-marsu` | Burgundy table header with white bold text |

### 2. SweetAlert2 Notifications & Confirmations
Interactive dialogs are bundled locally:

```javascript
// Success toast notification
MarSU.toast('Reservation submitted successfully!', 'success');

// Error toast
MarSU.toast('Unable to process request.', 'error');

// Confirmation modal before destructive actions
MarSU.confirm({
    title: 'Cancel Reservation?',
    text: 'Are you sure you want to cancel this student booking?',
    confirmText: 'Yes, Cancel',
    onConfirm: () => {
        document.getElementById('cancelForm').submit();
    }
});
```

### 3. Forms & CSRF
Always include `<?= csrf_field() ?>` inside `<form>` tags:

```html
<form method="POST" action="<?= url('housing/reserve') ?>">
    <?= csrf_field() ?>
    <input type="hidden" name="room_id" value="<?= e($room['id']) ?>">
    <button type="submit" class="btn btn-marsu">Confirm Booking</button>
</form>
```

---

## Tutorial 6: Compliance with the Data Privacy Act of 2012 (RA 10173)

If you are developing **Group 4 (`health`)**, **Group 10 (`welfare`)**, or **Group 11 (`guidance`)**:
1. **Never expose clinical notes or financial bank records** to non-authorized roles.
2. In your views, display the required statutory confidentiality notice.
3. When returning dashboard telemetry in `widgets.php`, return only **aggregated numbers** (e.g. Total Consultations: 120), never student names, student numbers, or medical diagnoses.
4. Record all sensitive record lookups using the core audit logger:
   ```php
   \Core\Logger::audit('VIEW_CONFIDENTIAL_RECORD', 'hth_consultations', $recordId, ['reason' => 'Doctor consultation']);
   ```

---

**Questions or assistance?**  
Contact the Core Platform Maintainer or check `CONTRIBUTING.md` for Git collaboration procedures. Happy coding!
