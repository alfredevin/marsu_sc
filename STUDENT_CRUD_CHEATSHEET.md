# 🚀 MarSU ERP — Student CRUD & Database Cheat Sheet
### Simpleng Gabay sa Pag-Insert, Pag-Fetch, at Pag-Display ng Data sa Iyong Module

Maligayang pagdating sa Phase 2! Kapag tapos na ang inyong HTML/CSS layout, oras na para ikonekta ang inyong module sa totoong database (MySQL). 

Heto ang pinakasimpleng gabay para makapag-save at makapag-display kayo ng data nang walang sakit ng ulo.

---

## 🛑 1. Ang Gintong Panuntunan (Zero Core Modification)

> [!IMPORTANT]
> **HUWAG gagalawin ang mga files sa loob ng `app/`, `core/`, o `scripts/`!**  
> Ang lahat ng inyong code (Controllers, Views, Models, Routes) ay dapat **eksklusibong nakatira sa loob ng inyong assigned module directory**:  
> `modules/<your_module>/` (Halimbawa: `modules/housing/`, `modules/health/`, `modules/guidance/`).

---

## 🏷️ 2. Table Prefix ng Bawat Module

Bawat table na gagawin ninyo sa MySQL ay **REQUIRED** na magsimula sa nakatakdang prefix ng inyong grupo:

| Module Slug | Prefix | Halimbawa ng Table |
| :--- | :--- | :--- |
| **housing** | `hsg_` | `hsg_rooms`, `hsg_tenants`, `hsg_applications` |
| **health** | `hth_` | `hth_consultations`, `hth_prescriptions` |
| **guidance** | `gdc_` | `gdc_appointments`, `gdc_case_notes` |
| **welfare** | `wlf_` | `wlf_grantees`, `wlf_applications` |
| **expense4ps** | `exp_` | `exp_beneficiaries`, `exp_expenses` |
| **assets** | `ast_` | `ast_items`, `ast_maintenance` |
| **retention** | `ret_` | `ret_risk_logs`, `ret_interventions` |
| **orgfinance** | `orf_` | `orf_dues`, `orf_disbursements` |
| **orgleadership** | `sld_` | `sld_officers`, `sld_evaluations` |
| **workload** | `wkl_` | `wkl_assignments`, `wkl_schedules` |
| **irimkms** | `kmp_` | `kmp_publications`, `kmp_categories` |

---

## ⚡ 3. Ang 4 na Database Commands (`Core\Database`)

Walang Laravel Eloquent dito. Native PHP at ang `Core\Database` helper ng MarSU ang gagamitin natin:

### 1️⃣ Mag-FETCH ng Marami (List / Table)
```php
$records = Database::fetchAll("SELECT * FROM hsg_rooms WHERE deleted_at IS NULL ORDER BY id DESC");
```

### 2️⃣ Mag-FETCH ng Isa Lang (Single Record / View Details)
```php
$record = Database::fetchOne("SELECT * FROM hsg_rooms WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
```

### 3️⃣ Mag-INSERT (Create / Save)
```php
Database::insert('hsg_rooms', [
    'room_name'  => $roomName,
    'price'      => $price,
    'created_at' => date('Y-m-d H:i:s')
]);
```

### 4️⃣ Mag-UPDATE o Mag-DELETE (Soft Delete)
```php
// Update:
Database::update('hsg_rooms', ['price' => 1800.00], 'id = :id', ['id' => $id]);

// Delete (Soft Delete - itago nang hindi nabubura sa database):
Database::update('hsg_rooms', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
```

> [!WARNING]
> **Iwasan ang SQL Injection!**  
> ❌ **BAWAL:** `Database::fetchOne("SELECT * FROM hsg_rooms WHERE id = " . $_GET['id']);`  
> ✔️ **TAMA:** `Database::fetchOne("SELECT * FROM hsg_rooms WHERE id = :id", ['id' => $id]);`

---

## 🛠️ 4. Ang Pinakasimpleng Pattern (The 3-Step All-In-One Method)

Halimbawa, gusto mong gumawa ng simpleng listahan ng **Rooms** na may **Room Name** at **Price**:

### Hakbang 1: Gumawa ng Table sa phpMyAdmin
Pumunta sa `http://localhost/phpmyadmin` $\rightarrow$ buksan ang `marsu_erp` database $\rightarrow$ i-click ang **SQL** tab $\rightarrow$ i-run ito:

```sql
CREATE TABLE IF NOT EXISTS `hsg_rooms` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `room_name` VARCHAR(100) NOT NULL,
    `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NULL,
    `deleted_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

### Hakbang 2: Sa Controller (`modules/<slug>/Controllers/HomeController.php`)
Pagsamahin ang **Insert** at **Fetch** sa iisang function lang para hindi magulo!

```php
public function rooms(): void {
    $user = Auth::user();

    // A. INSERT LOGIC: Kapag may nag-submit ng form, i-save agad
    if (!empty($_POST['room_name'])) {
        Database::insert('hsg_rooms', [
            'room_name'  => trim($_POST['room_name']),
            'price'      => (float)($_POST['price'] ?? 0),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Session::flash('success', 'Room added successfully!');
        redirect(url('housing/rooms')); // Refresh page pagka-save
    }

    // B. FETCH LOGIC: Kunin lahat ng rooms mula sa database
    $rooms = [];
    try {
        $rooms = Database::fetchAll("SELECT * FROM `hsg_rooms` WHERE deleted_at IS NULL ORDER BY id DESC");
    } catch (\Exception $e) {
        $rooms = [];
    }

    // C. RENDER: Ipadala ang $rooms array sa view
    View::render('housing/Views/rooms', [
        'title'      => 'Room Directory',
        'moduleName' => 'Housing (ISHAMIS)',
        'slug'       => 'housing',
        'user'       => $user,
        'rooms'      => $rooms, // <-- Dito ipinapasa
        'crumbs'     => [
            'Housing (ISHAMIS)' => url('housing'),
            'Room & Accomodation' => '',
            'Rooms' => ''
        ]
    ]);
}
```

---

### Hakbang 3: Sa View File (`modules/<slug>/Views/rooms.php`)
Isang simpleng form sa itaas para mag-input, at table sa ibaba para mag-display:

```html
<!-- FLASH MESSAGES (Alert kapag nag-success o nag-error) -->
<?php if (Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= e(Session::flash('success')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- 1. SIMPLENG FORM SA ITAAS -->
<div class="card p-3 mb-4 shadow-sm border-0">
    <h5 class="text-marsu-burgundy fw-bold mb-3">
        <i class="bi bi-plus-circle me-1 text-gold"></i>Add New Room
    </h5>
    <form method="POST">
        <!-- MANDATORY: CSRF Token security protection -->
        <?= csrf_field() ?>

        <div class="row g-2">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Room Name</label>
                <input type="text" name="room_name" class="form-control" placeholder="e.g. Room 101 - Bed A" required>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Monthly Price (₱)</label>
                <input type="number" step="0.01" name="price" class="form-control" placeholder="e.g. 1500.00" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-marsu w-100">
                    <i class="bi bi-save me-1"></i>Save
                </button>
            </div>
        </div>
    </form>
</div>

<!-- 2. TABLE SA IBABA PARA I-DISPLAY ANG NAFETCH -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">Registered Rooms List</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">ID</th>
                    <th>Room Name</th>
                    <th>Monthly Price</th>
                    <th>Date Added</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rooms)): ?>
                    <?php foreach ($rooms as $room): ?>
                        <tr>
                            <td class="ps-3 text-muted">#<?= e($room['id']) ?></td>
                            <td class="fw-bold"><?= e($room['room_name']) ?></td>
                            <td class="text-success fw-semibold">₱<?= number_format((float)$room['price'], 2) ?></td>
                            <td class="text-muted small"><?= e(date('M d, Y', strtotime($room['created_at']))) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-2 d-block mb-1"></i>
                            Walang laman ang records. Subukan mag-add gamit ang form sa itaas!
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
```

---

## 🧰 5. Mahahalagang MarSU Helpers (Cheat Table)

| Helper | Gamit | Halimbawa ng Paggamit |
| :--- | :--- | :--- |
| `<?= csrf_field() ?>` | **Security token** (Kailangan sa lahat ng `<form>`) | Ilagay sa unang linya sa loob ng `<form>` tag |
| `<?= e($value) ?>` | **Sanitization** (Proteksyon laban sa XSS hack) | `<td><?= e($room['room_name']) ?></td>` |
| `url('path')` | **URL generator** | `<a href="<?= url('housing/rooms') ?>">` |
| `redirect(url('path'))` | **Lipat ng pahina** pagkatapos mag-save | `redirect(url('housing/rooms'));` |
| `Auth::user()` | **Naka-login na user details** | `$user = Auth::user();` |
| `Auth::id()` | **ID ng kasalukuyang user** | `$userId = Auth::id();` |
| `Session::flash('key', 'msg')` | **Alert message** na lilitaw nang isang beses | `Session::flash('success', 'Saved!');` |

---

## ❓ 6. Mga Karaniwang Error at Solusyon

1. **`CSRF token mismatch o Error 419`**:
   * *Dahilan:* Nakalimutan mong ilagay ang `<?= csrf_field() ?>` sa loob ng iyong `<form>`.
2. **`Fatal error: Cannot redeclare HomeController::function_name()`**:
   * *Dahilan:* May dalawang magkaparehong pangalan ng function sa iyong `HomeController.php`. Burahin ang duplicate.
3. **`Base table or view not found`**:
   * *Dahilan:* Hindi pa nagagawa ang table sa database o mali ang spelling ng prefix (e.g. `hsg_` para sa housing).
4. **`Headers already sent`**:
   * *Dahilan:* May `echo` o whitespace bago mag-`redirect()` o `header()`. Siguraduhing nauuna ang redirect bago mag-render ng view.
