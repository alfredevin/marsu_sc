# [SPAMS] Student Performance & Attendance Monitoring System
### Module Sub-System Directory & Ownership Manifest (Modules 1 to 3)

> [!IMPORTANT]
> **NOTICE TO COLLABORATING DEVELOPMENT TEAMS:**  
> The files listed below are owned and maintained by the **SPAMS Research Team (Modules 1 to 3)**.  
> If your group is developing **Modules 4, 5, or 6** (Early Warning System, Intervention Management, Reports & Analytics), please create your own dedicated view files and routes. **Do not modify or overwrite the SPAMS files listed below.**

---

### SPAMS View Inventory (`modules/retention/Views/`)

| File Name | SPAMS Sub-Module | Functional Scope |
| :--- | :--- | :--- |
| **`index.php`** | **Core Dashboard** | Executive analytics, enrollment totals, and audit activity stream |
| **`profile.php`** | **Module 1: Student Information** | Comprehensive 360° student profiling, tabs, and demographics |
| **`academichistory.php`** | **Module 1: Student Information** | Historical subject grades and academic progression |
| **`enrollmentrecords.php`** | **Module 1: Student Information** | Semester enrollment status and registered load |
| **`demographicinfo.php`** | **Module 1: Student Information** | Socio-economic, geographical, and demographic data |
| **`gradestracking.php`** | **Module 2: Academic Monitoring** | Teacher class record, midterm, final grades, and GPA tracking |
| **`subjectperformance.php`** | **Module 2: Academic Monitoring** | Course passing rates, subject failure breakdown, and bottleneck analytics |
| **`progressreports.php`** | **Module 2: Academic Monitoring** | Academic progress evaluation and curriculum checklist completion |
| **`failedincompletemonitoring.php`** | **Module 2: Academic Monitoring** | Deficit units, INC removal tracker, and prerequisite warnings |
| **`attendancerecords.php`** | **Module 3: Attendance & Engagement** | Daily roll-call attendance session logger and telemetry |
| **`participationtracking.php`** | **Module 3: Attendance & Engagement** | Recitation logs, engagement rating, and participation score |
| **`studentengagement.php`** | **Module 3: Attendance & Engagement** | LMS telemetry, study consistency, and engagement index |
| **`behaviorrecords.php`** | **Module 3: Attendance & Engagement** | Student conduct incident roster and behavioral notices |

---

### Database Tables (Prefix `ret_`)
* `ret_records`: Audit trail and retention activity logbook.
* `ret_attendance_records`: Dedicated roll-call session attendance logs.
* `ret_behavior_records`: Student conduct and behavioral incident entries.
*(Core university reference tables used: `students`, `programs`, `departments`, `grades`, `subjects`, `curriculums`, `curriculum_subjects`, `classes`).*

---

### Controller & Routes
* **Controller**: `modules/retention/Controllers/HomeController.php`
* **Routes**: `modules/retention/routes.php`
* **Configuration**: `modules/retention/module.json`
