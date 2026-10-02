# 📘 MarSU ERP — Beginner Developer Guide & Cheatsheet
### For Students Transitioning from Pure HTML/CSS to Backend Development

Welcome, MarSU Student Developers! 👋

If your group only has experience in **pure HTML and CSS** and you have never touched backend programming (PHP) or databases (MySQL), **do not worry!** This entire platform is built with pre-made, working templates so you can learn and build step-by-step without getting overwhelmed.

---

## 1. 🧠 The Big Picture: How Data Flows (In Plain English)

In pure HTML/CSS, your forms cannot save data permanently—when you refresh the page, everything disappears. In this ERP system, data is saved permanently using **4 simple steps**:

```
[ Step 1: HTML Form ] 
   👉 The user types in an <input> and clicks "Save Entry".
             ⬇️
[ Step 2: The Controller (Brain) ]
   👉 Captures what was typed in the form ($_POST).
             ⬇️
[ Step 3: The Database (Storage) ]
   👉 Saves the data permanently into your MySQL table.
             ⬇️
[ Step 4: The HTML Table ]
   👉 Pulls the saved data from the database and displays it in rows!
```

---

## 2. 📂 What is Each Folder and File For?

Inside your module folder (`modules/<your_slug>/`), you will see these files. Here is what each one actually does:

| Folder / File | What is it for? | Pure HTML/CSS Analogy |
|---|---|---|
| **`Views/index.php`** | Your actual webpage design, cards, tables, and modal popup forms. | Just like your usual `index.html`, with Bootstrap classes! |
| **`module.json`** | The "Settings / ID Card" of your module. Determines the title, icon, and sidebar sub-menus. | A simple JSON list of links for your sidebar. |
| **`Controllers/HomeController.php`** | The "Waiter / Brain". Takes data from the HTML form and sends it to MySQL, or fetches data to show in your table. | Handles button clicks and form submissions. |
| **`routes.php`** | The "URL Directory". Defines web addresses (e.g., `http://localhost/marsu_sc/housing`). | Directs URLs to the right controller function. |
| **`database/migrations/`** | The database table blueprint. Tells MySQL what columns your table needs. | Like creating an Excel spreadsheet with column headers. |

---

## 3. 🛠️ How to Add a New Input Field (Form ➡️ Database ➡️ Table)

Let's walk through an actual example. Suppose you want to add a **"Contact Number"** field.

### Step 1: Add the Input Field in the HTML Form (`Views/index.php`)
Scroll down to the modal form in `Views/index.php` (around the modal body) and paste this:

```html
<div class="mb-3">
    <label class="form-label small fw-bold">Contact Number <span class="text-danger">*</span></label>
    <input type="text" name="contact_no" class="form-control form-control-sm" required placeholder="0917-xxx-xxxx">
</div>
```
> 💡 **Notice `name="contact_no"`**: This name is the "key" that the backend uses to identify this input.

---

### Step 2: Receive and Save the Field (`Controllers/HomeController.php`)
Open `modules/<your_slug>/Controllers/HomeController.php` and find the `store()` method:

```php
public function store(): void {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    
    // 👉 1. CAPTURE YOUR NEW FIELD HERE:
    $contactNo = trim($_POST['contact_no'] ?? '');

    try {
        Database::insert('hsg_records', [
            'title'       => $title,
            'description' => $description,
            'contact_no'  => $contactNo, // 👉 2. SAVE IT TO DATABASE
            'status'      => 'active',
            'created_by'  => Auth::id(),
            'created_at'  => date('Y-m-d H:i:s')
        ]);
        Session::flash('success', 'Record saved successfully!');
    } catch (\Exception $e) {
        Session::flash('error', 'Error: ' . $e->getMessage());
    }

    redirect(url('housing'));
}
```

---

### Step 3: Add the Column to Your Database Table

You can do this easily through **phpMyAdmin** (Visual / No Coding!):
1. Open your browser and go to `http://localhost/phpmyadmin`.
2. Click **`marsu_erp`** on the left menu.
3. Click your module table (e.g., `hsg_records` for Housing, `hth_records` for Health, etc.).
4. Click the **Structure** tab at the top.
5. Under the columns list, select **Add 1 column after `description`** and click **Go**.
6. Name it `contact_no`, Type: `VARCHAR`, Length: `100`, check **Null**, and click **Save**!

---

### Step 4: Display the Data in Your Table (`Views/index.php`)
In `Views/index.php`:

1. Add the Table Header in `<thead>`:
```html
<th>Contact Number</th>
```

2. Add the Table Cell in `<tbody>`:
```html
<td><?= e($r['contact_no'] ?? 'N/A') ?></td>
```

👉 **That's it!** You have successfully connected HTML Form ➡️ Backend ➡️ Database ➡️ HTML Table!

---

## 4. 📄 How to Create a Second Page (e.g., "Rooms" or "Reports")

What if your module needs more than one page? (e.g., one page for Boarding Houses and another page for Bed Space Rooms).

### 1. Create the New View File
Duplicate `Views/index.php` and rename it to `Views/rooms.php`.  
Customize the HTML text and headings inside `rooms.php` however you like!

### 2. Add the Function in `HomeController.php`
Open `Controllers/HomeController.php` and add a new method:

```php
public function rooms(): void {
    $user = Auth::user();
    
    // Fetch records
    $records = Database::fetchAll("SELECT * FROM hsg_records WHERE status = 'active' ORDER BY id DESC");

    // Render your new view file (Views/rooms.php)
    View::render('housing/Views/rooms', [
        'title'      => 'Room Vacancies & Bed Spaces',
        'moduleName' => 'Housing (ISHAMIS)',
        'slug'       => 'housing',
        'records'    => $records,
        'user'       => $user,
        'crumbs'     => ['Housing' => url('housing'), 'Rooms' => '']
    ]);
}
```

### 3. Register the Route in `routes.php`
Open `modules/<your_slug>/routes.php` and add:

```php
$router->get('/housing/rooms', [HomeController::class, 'rooms'], ['auth', 'permission:housing.view']);
```

### 4. Add the Link to Your Sidebar in `module.json`
Open `modules/<your_slug>/module.json` and add the new item under `"menu" -> "items"`:

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
            "label": "Room Vacancies",
            "route": "housing/rooms",
            "permission": "housing.view"
        }
    ]
}
```
👉 Now, visiting `http://localhost/marsu_sc/housing/rooms` opens your new page, and it appears in your sidebar!

---

## 5. 🎛️ Copy-Paste Form Field Library

Need more input types for your forms? Copy and paste any of these directly into `<div class="modal-body">`:

### 🔹 Number Input (Prices, Quantities, Capacity):
```html
<div class="mb-3">
    <label class="form-label small fw-bold">Monthly Rate (PHP) <span class="text-danger">*</span></label>
    <div class="input-group input-group-sm">
        <span class="input-group-text">₱</span>
        <input type="number" step="0.01" name="price" class="form-control" required placeholder="1500.00">
    </div>
</div>
```

### 🔹 Dropdown Selection:
```html
<div class="mb-3">
    <label class="form-label small fw-bold">Room Type</label>
    <select name="room_type" class="form-select form-select-sm">
        <option value="Single">Single Bedroom</option>
        <option value="Shared">Shared Bed Space</option>
        <option value="Studio">Studio Unit</option>
    </select>
</div>
```

### 🔹 Date Picker:
```html
<div class="mb-3">
    <label class="form-label small fw-bold">Inspection Date</label>
    <input type="date" name="inspection_date" class="form-control form-control-sm">
</div>
```

### 🔹 Long Text / Paragraph (Remarks, Symptoms, Notes):
```html
<div class="mb-3">
    <label class="form-label small fw-bold">Notes / Observations</label>
    <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Enter detailed remarks here..."></textarea>
</div>
```

---

## 6. 🚀 How to Save and Submit to GitHub (3 Git Steps)

When your group finishes making changes on your computer:

1. **Create and switch to your group's branch:**
   ```bash
   git checkout -b feature/housing-updates
   ```

2. **Stage and commit your module folder:**
   ```bash
   git add modules/<your_module>/
   git commit -m "feat: added new room forms and updated table columns"
   ```

3. **Push to GitHub:**
   ```bash
   git push origin feature/housing-updates
   ```

4. Go to the GitHub repository online (`https://github.com/alfredevin/marsu_sc`) and click **"Compare & pull request"**. The Lead Admin will review and merge your work into the main platform!

---

💡 **Remember**: As long as your code stays inside `modules/<your_module>/`, you cannot break anyone else's code or the central ERP platform. Happy coding, MarSU developers! 🎓
