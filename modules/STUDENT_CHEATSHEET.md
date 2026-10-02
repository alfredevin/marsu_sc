# 📘 MarSU ERP — Student Developer Cheatsheet

Welcome, BSIS Student Developers!

The **MarSU Centralized ERP** architecture is fully pre-built, modular, and ready to use. You do **not** need advanced JavaScript or complex backend PHP to build your assigned capstone module. Follow this quick guide to customize your module's interface, forms, and database records.

---

## 🛑 Golden Rule (Zero Core Modification)
> **DO NOT modify, add, or delete files inside `core/`, `app/`, or `scripts/`.**  
> All of your group's code, designs, and files must reside **STRICTLY** within your assigned module directory:  
> 👉 `modules/<your_module_slug>/` (e.g., `modules/housing/` or `modules/health/`)

---

## 📂 Which Files Do You Need to Work On?

Inside your module folder (e.g., `modules/housing/`), you only need to work with these files:

| File Name | Purpose | What to do? |
|---|---|---|
| **`Views/index.php`** | Main UI, KPI cards, table, and input modal | **Plain HTML & Bootstrap! No complex JS needed!** |
| **`module.json`** | Module title, description, and Sidebar sub-menus | **Edit text labels & configuration!** |
| **`Controllers/HomeController.php`** | Request handling & saving to database | **Pre-wired methods ready to use!** |

---

## 🎨 Cheat 1: Customizing Your Page Title & Description

Open `modules/<your_module>/Views/index.php` and update the header section:

```html
<!-- UPDATE PAGE HEADING HERE -->
<h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
    <i class="bi bi-house-check-fill me-2 text-gold"></i>Student Housing & Accommodation Directory
</h1>

<!-- UPDATE DESCRIPTION HERE -->
<p class="text-muted small mb-0">Official university-accredited boarding houses and bed space vacancies.</p>
```

---

## 📝 Cheat 2: Copy-Paste Templates for Your Input Form

To customize or add input fields to your **"New Entry" Form Modal**, open `Views/index.php` (inside `<div class="modal-body">`).

Choose the field templates you need:

### A. Standard Text Input (Names, Titles, Code):
```html
<div class="mb-3">
    <label class="form-label small fw-bold">Boarding House Name <span class="text-danger">*</span></label>
    <input type="text" name="title" class="form-control form-control-sm" required placeholder="e.g. Villa Marinduque Residence">
</div>
```

### B. Date Picker:
```html
<div class="mb-3">
    <label class="form-label small fw-bold">Inspection / Booking Date</label>
    <input type="date" name="record_date" class="form-control form-control-sm">
</div>
```

### C. Dropdown Select Menu:
```html
<div class="mb-3">
    <label class="form-label small fw-bold">Room Category / Classification</label>
    <select name="category" class="form-select form-select-sm">
        <option value="Single">Single Occupancy</option>
        <option value="Shared">Shared Bed Space (2-4 pax)</option>
        <option value="Studio">Studio Apartment</option>
    </select>
</div>
```

### D. Multi-line Text Area (Notes, Remarks, Diagnosis):
```html
<div class="mb-3">
    <label class="form-label small fw-bold">Detailed Observations / Amenities</label>
    <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Enter amenities, rules, or inspection findings..."></textarea>
</div>
```

---

## 📊 Cheat 3: Adding Columns to Your Records Table

Inside `Views/index.php`:

1. Add a Column Header in `<thead>`:
```html
<thead class="table-marsu">
    <tr>
        <th>#</th>
        <th>Title / Property</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</thead>
```

2. Output the corresponding data row in `<tbody>`:
```html
<tr>
    <td><?= $i + 1 ?></td>
    <td class="fw-bold text-marsu-burgundy"><?= e($r['title']) ?></td>
    <td class="small text-muted"><?= e($r['description'] ?? 'N/A') ?></td>
    <td><span class="badge bg-success">Active</span></td>
    <td class="text-end">
        <button class="btn btn-sm btn-outline-secondary" onclick="alert('Viewing entry #<?= $r['id'] ?>')">
            <i class="bi bi-eye"></i>
        </button>
    </td>
</tr>
```

---

## 📌 Cheat 4: Adding Sub-Menus to the Sidebar

Open `modules/<your_module>/module.json`. Under `"menu" -> "items"`, add sub-pages by adding objects to the array:

```json
"menu": {
    "icon": "bi-house-check-fill",
    "items": [
        {
            "label": "Overview & Records",
            "route": "housing",
            "permission": "housing.view"
        },
        {
            "label": "Accreditation Directory",
            "route": "housing",
            "permission": "housing.view"
        }
    ]
}
```
👉 Once saved, your new sub-menus will **automatically render in the sidebar** when logged in!

---

## 🚀 Cheat 5: Git Collaboration Workflow (Saving & Pushing)

When you are finished editing on `localhost`, run these three (3) standard Git commands in **Git Bash**:

1. **Create and switch to your feature branch:**
   ```bash
   git checkout -b feature/your-module-update
   ```

2. **Stage and commit your changes:**
   ```bash
   git add modules/<your_module>/
   git commit -m "feat(housing): update directory tables and intake form"
   ```

3. **Push to GitHub:**
   ```bash
   git push origin feature/your-module-update
   ```

4. Go to the project's GitHub repository and click **`Compare & pull request`**. The lead administrator will review and merge your contribution into the main system!
