# 📘 MarSU ERP — Gabay para sa mga Estudyante (Beginner Cheatsheet)

Kamusta mga ka-MarSU! Kung bago ka pa lang sa web development at hindi ka pa sanay sa **JavaScript** o **Backend PHP**, huwag kang matakot! 

Ang buong system na ito ay **pre-built at gumagana na agad**. Hindi mo kailangang mag-code mula sa scratch. **Copy-paste at palit ng text lang sa HTML ang gagawin mo!**

---

## 🛑 Ang Nag-iisang Mahigpit na Patakaran
> **BAWAL galawin ang folder ng `core/`, `app/`, at `scripts/`.**  
> Lahat ng code, design, at files ng inyong grupo ay dapat nasa loob **LAMANG** ng inyong sariling folder:  
> 👉 `modules/<pangalan_ng_module>/` (Halimbawa: `modules/health/` o `modules/housing/`)

---

## 📂 Aling Files Lang ang Kailangan Mong Buksan?

Sa loob ng folder ng inyong module (hal. `modules/health/`), tatlong (3) files lang ang gagalawin ninyo:

| File Name | Para Saan Ito? | Kailangan ba ng Coding? |
|---|---|---|
| **`Views/index.php`** | Dito nakalagay ang UI, Table, at Form/Modal | **HTML lang! Walang JavaScript!** |
| **`module.json`** | Dito nakalagay ang pamagat at Sidebar Menu | **Palit ng text sa listahan lang!** |
| **`Controllers/HomeController.php`** | Dito nagse-save sa database | **May ready-made code na, kokopyahin mo lang!** |

---

## 🎨 Cheat 1: Paano Palitan ang Pamagat at Kulay sa Inyong Page

Buksan ang `modules/<inyong_module>/Views/index.php`:
Hanapin ang bandang itaas:

```html
<!-- PALITAN ANG PAMAGAT DITO -->
<h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
    <i class="bi bi-heart-pulse-fill me-2 text-gold"></i>Clinic Consultations
</h1>

<!-- PALITAN ANG MAIKLING DESCRIPTION DITO -->
<p class="text-muted small mb-0">Talaan ng mga pasyente at gamot sa campus clinic.</p>
```

---

## 📝 Cheat 2: Copy-Paste Templates para sa Input Form

Kung gusto ninyong magdagdag ng mga tanong o fields sa inyong **"New Entry" Form**, pumunta sa `Views/index.php` (bandang ibaba, sa loob ng `<div class="modal-body">`). 

Piliin lang ang kailangan ninyo at i-paste:

### A. Pangalan o Karaniwang Text:
```html
<div class="mb-3">
    <label class="form-label small fw-bold">Pangalan ng Pasyente / Estudyante</label>
    <input type="text" name="title" class="form-control form-control-sm" required placeholder="Hal. Juan Dela Cruz">
</div>
```

### B. Petsa (Date Picker):
```html
<div class="mb-3">
    <label class="form-label small fw-bold">Petsa ng Konsultasyon</label>
    <input type="date" name="consultation_date" class="form-control form-control-sm">
</div>
```

### C. Dropdown / Pagpipilian (Select Option):
```html
<div class="mb-3">
    <label class="form-label small fw-bold">Uri ng Karamdaman / Category</label>
    <select name="category" class="form-select form-select-sm">
        <option value="Checkup">General Checkup</option>
        <option value="Dental">Dental Care</option>
        <option value="Emergency">First Aid / Emergency</option>
    </select>
</div>
```

### D. Mahabang Text / Remarks (Textarea):
```html
<div class="mb-3">
    <label class="form-label small fw-bold">Diagnosis / Reseta ng Doktor</label>
    <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Isulat dito ang mga detalye o gamot..."></textarea>
</div>
```

---

## 📊 Cheat 3: Paano Magdagdag ng Column sa Table

Gusto mo bang magdagdag ng bagong column sa inyong Records Table?
Sa loob pa rin ng `Views/index.php`:

1. Magdagdag ng Header sa `<thead>`:
```html
<thead class="table-marsu">
    <tr>
        <th>#</th>
        <th>Pangalan</th>
        <th>Diagnosis</th>
        <th>Status</th>
        <th>Aksyon</th> <!-- Dagdag mo ito kung gusto mo -->
    </tr>
</thead>
```

2. Maglagay ng kaukulang Data sa loob ng `<tbody>`:
```html
<tr>
    <td><?= $i + 1 ?></td>
    <td class="fw-bold"><?= e($r['title']) ?></td>
    <td><?= e($r['description']) ?></td>
    <td><span class="badge bg-success">Active</span></td>
</tr>
```

---

## 📌 Cheat 4: Paano Magdagdag ng Sub-Menu sa Sidebar

Buksan ang `modules/<inyong_module>/module.json`.  
Sa ilalim ng `"menu" -> "items"`, magdagdag lang ng panibagong curly braces `{ }`:

```json
"menu": {
    "icon": "bi-heart-pulse-fill",
    "items": [
        {
            "label": "Talaan ng Pasyente",
            "route": "health",
            "permission": "health.view"
        },
        {
            "label": "Medical Supplies Inventory",
            "route": "health",
            "permission": "health.view"
        }
    ]
}
```
👉 Pag-save mo nito, **awtomatiko nang lilitaw ang dalawang sub-menu sa sidebar!**

---

## 🚀 Cheat 5: Paano I-save at I-upload sa GitHub (Git Workflow)

Kapag tapos ka nang mag-edit at gumagana na sa `localhost`, 3 simpleng utos lang ang kailangan mong i-type sa **Git Bash**:

1. **Gumawa ng sariling branch ng inyong grupo:**
   ```bash
   git checkout -b feature/health-clinic
   ```

2. **I-save ang inyong gawa:**
   ```bash
   git add modules/health/
   git commit -m "feat(health): inayos ang form at table ng clinic"
   ```

3. **I-upload sa GitHub:**
   ```bash
   git push origin feature/health-clinic
   ```

Pagkatapos, pumunta sa GitHub repository link ng inyong lead at i-click ang berdeng button na **`Compare & pull request`**. Awtomatiko nang maipapasa ang gawa ninyo para ma-merge ng admin!

---

💡 **Tandaan:** Hindi kailangang maging kumplikado! Ang mahalaga ay maipakita ng grupo ninyo ang malinis na form, maayos na table, at tamang records para sa inyong module. Good luck, MarSU BSIS! 🎓
