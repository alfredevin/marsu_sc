# MarSU ERP — Student Developer Starter Guide
### Step-by-Step: From Cloning to Your First Pull Request (Pure HTML/CSS First)

![MarSU ERP 5-Step Developer Workflow](docs/images/student_workflow_guide.jpg)

Welcome, MarSU Student Developers!

For this initial milestone, **you do NOT need to touch backend PHP, SQL, or database migrations**. Your goal is simply to set up the project on your laptop, create your group's branch, and customize **one single file (`Views/index.php`)** using pure HTML/CSS so the Lead Admin can review your changes on GitHub!

---

## The Golden Rule

> [!IMPORTANT]
> **DO NOT modify files inside `core/`, `app/`, or `scripts/`.**  
> Your group's work must live **STRICTLY** inside your assigned module directory:  
> `modules/<your_module>/` (for example: `modules/health/` or `modules/housing/`)

---

## Phase 1: Setup from the Very Beginning (From Scratch)

### 1. Requirements on Your Laptop:
- **XAMPP** (with Apache and MySQL started)
- **Git** (Git Bash installed)
- **GitHub Account** (Sign up at [github.com](https://github.com) if you haven't yet)

#### ⚙️ Step 1.1: Setup Your Git Identity (Isang Beses Lang Gagawin!)
Bago ka makapag-commit o makapag-push, kailangan malaman ni Git kung sino ka (Pangalan at Email). Buksan ang **Git Bash** at i-type ang dalawang linya na ito (palitan ng sarili mong pangalan at email address):
```bash
git config --global user.name "Juan Dela Cruz"
git config --global user.email "juandelacruz@gmail.com"
```
*(Tip: Gamitin ang email na naka-link sa iyong GitHub account para ma-credit sa GitHub profile mo ang commits mo).*

---

### 2. How to Clone the Repository (First Time Only!)

> [!NOTE]
> **Isang beses lang ito gagawin sa pinakaunang araw!** Kapag na-download na ang folder sa laptop mo, **HUWAG** nang mag-`git clone` ulit kailanman. Kapag may bagong update, `git pull` na ang gagamitin.

1. Open **Git Bash**.
2. Navigate to your XAMPP web root folder:
   ```bash
   cd /c/xampp/htdocs
   ```
3. Clone the official MarSU ERP repository:
   ```bash
   git clone https://github.com/alfredevin/marsu_sc.git
   ```
   *(This creates a folder at `C:\xampp\htdocs\marsu_sc` on your laptop).*

---

### 3. Setup Your Local Database (1-Minute Setup)
1. Open **XAMPP Control Panel** and make sure both **Apache** and **MySQL** are running (green).
2. Open your browser and go to: `http://localhost/phpmyadmin`
3. Click **New** (on the left sidebar), name the database **`marsu_erp`**, and click **Create**.
4. In Git Bash, enter your project folder and run the migration and seed scripts:
   ```bash
   cd /c/xampp/htdocs/marsu_sc
   /c/xampp/php/php.exe scripts/migrate.php
   /c/xampp/php/php.exe scripts/seed.php
   ```
   *(Note: Awtomatikong ipapasok ng `seed.php` ang 866 MarSU student records, faculty, at subjects. Kung sakaling nag-seed ka na dati at 0 pa rin ang students, i-run lang ang `/c/xampp/php/php.exe scripts/import_real_data.php`).*
   *(Tip: Kung `php: command not found` kapag nag-type ka ng `php`, gamitin ang buong path `/c/xampp/php/php.exe` tulad ng nasa itaas. O kaya i-run muna ang `export PATH=$PATH:/c/xampp/php` sa Git Bash para gumana ang shortcut na `php`).*

5. Open your browser and go to: `http://localhost/marsu_sc/`  
   The ERP login page should now appear!

---

### 4. How to Open the Project in VS Code or Code Editor
In Git Bash, while inside the project directory, run:
```bash
code .
```
*(Note: May space at tuldok pagkatapos ng `code`. Ang command na `code .` ang awtomatikong magbubukas ng buong folder sa **Visual Studio Code**).*

> [!TIP]
> - Kung **Antigravity IDE** ang gamit: I-type ang `agy .` o buksan via **File > Open Folder** $\rightarrow$ piliin ang `C:\xampp\htdocs\marsu_sc`.
> - Kung gusto mong buksan sa **Windows File Explorer** mula terminal: I-type ang `explorer .` o `start .`

---

## Phase 2: Create Your Group's Branch

**NEVER code directly on the `master` branch.** Always create a separate branch for your group so your work doesn't conflict with other groups.

Inside `/c/xampp/htdocs/marsu_sc`, run:
```bash
git checkout -b feature/group-name
```
*Example for Housing group (ISHAMIS):*
```bash
git checkout -b feature/housing-ishamis
```
*(Or for your own assigned module: `feature/health-clinic`, `feature/guidance-records`, etc.)*

---
## ⚡ Important: How to Get Latest Admin Updates (While on Your Branch)

Kapag nag-announce si Admin na may binago siyang kulay, bagong design, o system update sa GitHub, **paano mo ito makukuha sa laptop mo kahit nasa sarili kang branch?**

> [!WARNING]
> **Huwag mag-clone ulit!** Mag-e-error lang ang Git dahil may existing `marsu_sc` folder ka na sa `htdocs`. Ang tamang gagamitin ay **`git pull origin master`**.

Sundin lang ang **2 simpleng hakbang** na ito sa Git Bash:

### Step 1: I-save (Commit) muna ang ginagawa mo sa iyong module:
*(Napakahalaga nito para hindi magreklamo si Git na may uncommitted files ka).*
```bash
git add .
git commit -m "Save my progress"
```

### Step 2: I-pull ang pinakabagong update mula sa `master`:
```bash
git pull origin master
```

> [!CAUTION]
> **May lumabas bang `|MERGING` sa tabi ng branch name mo sa Git Bash?** *(Halimbawa: `(feature/your-branch|MERGING)`)*  
> 
> **Bakit ito lumabas?**  
> Nasa gitna si Git ng isang hindi pa natatapos na merge (nangyayari ito kapag nag-pull ka habang may binabago ka sa files). Hangga't may `|MERGING`, haharangin ni Git ang anumang bagong `git pull`.  
> 
> **Ang Solusyon (1-Second Fix):**  
> I-type ito sa Git Bash para i-cancel ang bitin na merge at ibalik sa normal ang branch mo:
> ```bash
> git merge --abort
> ```
> *(Mawawala agad ang salitang `|MERGING` sa tabi ng branch mo!).*  
> Pagkatapos, i-save muna ang gawa mo bago mag-pull ulit:
> ```bash
> git add .
> git commit -m "save current work"
> git pull origin master
> ```

✨ **Bakit 100% ligtas ito?**
- Ang gawa ng grupo mo ay nakakulong lang sa loob ng `modules/<your_module>/`.
- Si Admin lang ang humahawak sa core layouts, kulay, at login page.
- **Walang magkakabanggaan (zero merge conflict)!** Pagka-enter mo ng command, papasok agad ang bagong itsura nang buo at ligtas ang module mo. Mag-**Refresh (F5)** lang sa browser!

---

## Phase 3: The ONLY File You Need to Edit for Now (`Views/index.php`)

Do **not** worry about the database or backend right now. Focus on designing your module's interface!

Open this single file in VS Code or your code editor:
`modules/housing/Views/index.php` *(or your own module's `Views/index.php`)*

### What to Customize (Pure HTML & Bootstrap):

#### 1. Page Title & Description (Near the top):
```html
<h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
    <i class="bi bi-house-check-fill me-2 text-gold"></i>Student Housing & Accommodation (ISHAMIS)
</h1>
<p class="text-muted small mb-0">Directory of university-accredited boarding houses and student bed spaces in Santa Cruz Campus.</p>
```

#### 2. Table Column Headers (Inside `<thead>`):
Change the column headers to match your module's records:
```html
<thead class="table-marsu">
    <tr>
        <th>#</th>
        <th>Boarding House Name / Landlord</th>
        <th>Monthly Rate / Amenities</th>
        <th>Accreditation Status</th>
        <th>Date Listed</th>
        <th class="text-end">Actions</th>
    </tr>
</thead>
```

#### 3. Modal Form Input Labels (Inside `<div class="modal-body">`):
Change the input labels so users know what to enter:
```html
<div class="mb-3">
    <label class="form-label small fw-bold">Boarding House Name <span class="text-danger">*</span></label>
    <input type="text" name="title" class="form-control form-control-sm" required placeholder="e.g. Villa Marinduque Student Residence">
</div>

<div class="mb-3">
    <label class="form-label small fw-bold">Landlord Contact & Monthly Rate / Amenities</label>
    <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Landlord: Maria Santos (0917-xxx-xxxx) • Rate: ₱1,500/month • Free WiFi & Water"></textarea>
</div>
```

---

### Visual Preview & Walkthrough Demonstration
Here is how your custom module and modal form look in the browser:

![Housing Intake Form Modal Preview](docs/images/housing_modal_demo.png)

> [!TIP]
> **Video Demonstration**: You can watch the full recorded session walkthrough video located at [`docs/videos/student_walkthrough.webp`](docs/videos/student_walkthrough.webp) showing login, workspace navigation, and modal form opening!

---

## Phase 4: Save, Commit, Push, and Pull Request (Submit to Lead)

Once you test your page on `http://localhost/marsu_sc/` and it looks great, it's time to submit your work to the Lead Admin!

### 1. Stage and Check Your Modified File:
```bash
git status
```
*(You should see `modules/housing/Views/index.php` in red or green).*

### 2. Stage Your File:
```bash
git add modules/housing/Views/index.php
```

### 3. Commit with a Clear Message:
```bash
git commit -m "feat(housing): customize index view title, table, and form"
```

> [!WARNING]
> ### 🛑 Na-stuck ka ba rito sa Error na "Author identity unknown" / "unable to auto-detect email address"?
>
> Kung pagkatapos mong i-enter ang `git commit` ay lumabas ang ganitong pulang error sa terminal:
> ```text
> Author identity unknown
> 
> *** Please tell me who you are.
> 
> Run
> 
>   git config --global user.email "you@example.com"
>   git config --global user.name "Your Name"
> 
> to set your account's default identity.
> Omit --global to set the identity only in this repository.
> 
> fatal: unable to auto-detect email address (got '...')
> ```
>
> **Bakit lumabas ito?**  
> Bago o kaka-install lang ang Git sa laptop mo at hindi pa nito alam kung sino ang author ng code. Normal ito sa pinakaunang beses mag-commit!
>
> **Ano yung sinasabing *"Omit --global"*?**  
> Paalala lang iyon ng Git na pwede raw tanggalin ang `--global` kung para sa repository lang na ito ang pangalan mo. **HUWAG tanggalin ang `--global`!** Mas magandang gamitin ang may `--global` para isang beses mo lang ito i-setup at gagana na sa lahat ng folders at projects mo magpakailanman.
>
> **Ang Solusyon (2 Commands lang sa Git Bash):**  
> I-type ang dalawang command na ito sa Git Bash (palitan ng tunay mong pangalan at email):
> ```bash
> git config --global user.name "Juan Dela Cruz"
> git config --global user.email "juandelacruz@gmail.com"
> ```
>
> Pagkatapos ma-enter ang dalawang commands sa itaas, **i-run ulit ang commit command**:
> ```bash
> git commit -m "feat(housing): customize index view title, table, and form"
> ```
> *(Lalabas na ang `[feature/housing-ishamis ...] 1 file changed` — ibig sabihin successfully saved na ang gawa mo!)*

---

### 4. Push Your Branch to GitHub:
```bash
git push -u origin feature/housing-ishamis
```

> [!TIP]
> **Kung humingi ng GitHub Login / Authentication Popup si Git:**  
> May lilitaw na maliit na window sa browser mo na may button na **"Sign in with your browser"** (GitHub Credential Manager). I-click lang iyon at i-click ang **Authorize git-credential-manager**. Kapag authorized na, awtomatiko nang ma-a-upload ang branch mo sa GitHub repository!

---

## Phase 5: Submit the Pull Request (PR)

1. Open the project GitHub repository in your browser:  
   `https://github.com/alfredevin/marsu_sc`
2. You will see a banner at the top saying:  
   `"feature/your-group-name had recent pushes — Compare & pull request"`
3. Click the green button: **Compare & pull request**.
4. Write a short description of what your group customized in `Views/index.php`.
5. Click **Create pull request**.

The Lead Admin (Alfred) will be notified, inspect your HTML changes, and merge your branch into the master project!

---

## Appendix: What About the Database and Backend? (For Phase 2)

Once your group's initial UI design is approved by the Lead, you can start connecting dynamic database columns:

1. **How Data Flows**:
   - `HTML Form (Views/index.php)` sends input data.
   - `Controllers/HomeController.php` receives it via `$_POST` and runs `Database::insert()`.
   - Data is stored in your MySQL table (`prefix_records`).
   - `Views/index.php` displays rows via `<?php foreach ($records as $r): ?>`.

2. **Testing Your Group Account**:
   - Each group lead has a dedicated account (e.g., `group4_lead`, `group7_lead`, password: `Password123!`).
   - When you log in with your group lead account, your sidebar will **only** display your assigned module!
