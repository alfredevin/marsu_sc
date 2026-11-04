<?php
include './../config.php';

// --- 1. IMPORT PHPMAILER CLASSES ---
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './../mailer/src/Exception.php';
require './../mailer/src/PHPMailer.php';
require './../mailer/src/SMTP.php';

include '../template/header.php';

// --- HELPER: SweetAlert Toast ---
function showAlert($icon, $title, $text = "")
{
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "' . $icon . '",
                title: "' . $title . '",
                text: "' . $text . '",
                timer: 4000,
                showConfirmButton: true
            });
        });
    </script>';
}

// --- 2. ADD DEAN LOGIC ---
if (isset($_POST['submit'])) {
    $employee_no = strtoupper(trim($_POST['employee_no']));
    $first_name = strtoupper(trim($_POST['first_name']));
    $last_name = strtoupper(trim($_POST['last_name']));
    $department_id = $_POST['department_id'];
    $contact = $_POST['contact_number'];
    $email = trim($_POST['email']);
    $year_assigned = intval($_POST['year_assigned']);
    $semester_assigned = intval($_POST['semester_assigned']);

    // Image Upload Logic
    $photo = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $ext = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png'];

    // Check duplicates
    $check_stmt = mysqli_prepare($conn, "SELECT dean_id FROM dean_tbl WHERE employee_no = ? OR email = ? OR department_id = ?");
    mysqli_stmt_bind_param($check_stmt, "sss", $employee_no, $email, $department_id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        showAlert('error', 'Duplicate Entry!', 'Dean, Email, or Department already has an assigned head.');
    } elseif (!in_array($ext, $allowed)) {
        showAlert('error', 'Invalid file type!', 'Use JPG or PNG only.');
    } else {
        $new_photo_name = uniqid() . '.' . $ext;
        $upload_path = './uploads/' . $new_photo_name;

        if (move_uploaded_file($photo_tmp, $upload_path)) {
            $plain_password = 'dean123'; // Password na ise-send sa email
            $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

            $insert_stmt = $conn->prepare("INSERT INTO dean_tbl (employee_no, first_name, last_name, department_id, contact_number, email, photo, password, year_assigned, semester_assigned) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("sssissssii", $employee_no, $first_name, $last_name, $department_id, $contact, $email, $new_photo_name, $hashed_password, $year_assigned, $semester_assigned);

            if ($insert_stmt->execute()) {

                // --- START EMAIL NOTIFICATION ---
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'onlineorderingandinventory@gmail.com';
                    $mail->Password = 'kdikvnkzmzrcvylc';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;

                    $mail->setFrom('onlineorderingandinventory@gmail.com', 'MarSU HR Admin');
                    $mail->addAddress($email, $first_name . ' ' . $last_name);

                    $mail->isHTML(true);
                    $mail->Subject = 'Official Appointment - Department Head Account Credentials';
                    $mail->Body = '
                        <div style="font-family: Arial, sans-serif; max-width: 600px; border: 1px solid #ddd; padding: 20px;">
                            <h2 style="color: #800000;">Greetings, Prof. ' . $last_name . '!</h2>
                            <p>You have been officially registered as a <strong>Department Head</strong> in the MarSU Intelligent Procurement System.</p>
                            <div style="background: #f9f9f9; padding: 15px; border-left: 4px solid #800000; margin: 20px 0;">
                                <p><strong>Login URL:</strong> <a href="http://localhost/boac/spms/login.php">System Login Page</a></p>
                                <p><strong>Username/Email:</strong> ' . $email . '</p>
                                <p><strong>Temporary Password:</strong> ' . $plain_password . '</p>
                                <p><strong>Designated Year:</strong> ' . $year_assigned . ' (' . ($semester_assigned == 1 ? "1st" : "2nd") . ' Semester)</p>
                            </div>
                            <p>For security, please change your password immediately after your first login.</p>
                            <p>Regards,<br><strong>MarSU Admin</strong></p>
                        </div>';

                    $mail->send();
                    showAlert('success', 'Dean Added!', 'Account created and credentials sent to ' . $email);
                } catch (Exception $e) {
                    showAlert('warning', 'Dean Added!', 'Record saved, but failed to send email: ' . $mail->ErrorInfo);
                }
                // --- END EMAIL NOTIFICATION ---

            } else {
                showAlert('error', 'Database Error.');
            }
            $insert_stmt->close();
        } else {
            showAlert('error', 'Failed to upload photo.');
        }
    }
    $check_stmt->close();
}

// --- UPDATE DEAN LOGIC ---
if (isset($_POST['update_dean'])) {
    $dean_id = intval($_POST['dean_id']);
    $employee_no = strtoupper(trim($_POST['employee_no']));
    $first_name = strtoupper(trim($_POST['first_name']));
    $last_name = strtoupper(trim($_POST['last_name']));
    $department_id = $_POST['department_id'];
    $contact = $_POST['contact_number'];
    $email = trim($_POST['email']);
    $year_assigned = intval($_POST['year_assigned']);
    $semester_assigned = intval($_POST['semester_assigned']);
    $old_photo = $_POST['old_photo'];

    if (!empty($_FILES['photo']['name'])) {
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $new_photo = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], './uploads/' . $new_photo);
    } else {
        $new_photo = $old_photo;
    }

    $update_stmt = $conn->prepare("UPDATE dean_tbl SET employee_no=?, first_name=?, last_name=?, department_id=?, contact_number=?, email=?, photo=?, year_assigned=?, semester_assigned=? WHERE dean_id=?");
    $update_stmt->bind_param("sssisssiii", $employee_no, $first_name, $last_name, $department_id, $contact, $email, $new_photo, $year_assigned, $semester_assigned, $dean_id);

    if ($update_stmt->execute()) {
        showAlert('success', 'Update Successful!', 'Dean record has been updated.');
    } else {
        showAlert('error', 'Failed to update record.');
    }
    $update_stmt->close();
}
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dean Management</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-person-badge-fill me-2"></i>Register Department Head</h5>
                            <form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="employee_no" placeholder="D-001" required>
                                        <label>Employee Number</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="first_name" placeholder="Name" required>
                                        <label>First Name</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="last_name" placeholder="Name" required>
                                        <label>Last Name</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select" name="department_id" required>
                                            <option value="" selected disabled>Choose Department...</option>
                                            <?php
                                            $deptQuery = mysqli_query($conn, "SELECT * FROM department_tbl WHERE dept_status = 1");
                                            while ($dept = mysqli_fetch_assoc($deptQuery)) {
                                                echo "<option value='{$dept['department_id']}'>{$dept['department_name']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Department</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="year_assigned" value="<?= date('Y'); ?>" required>
                                        <label>Year Assigned</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="semester_assigned" required>
                                            <option value="1">1st Semester</option>
                                            <option value="2">2nd Semester</option>
                                        </select>
                                        <label>Semester</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="contact_number" maxlength="11" required>
                                        <label>Contact Number</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" name="email" placeholder="email@test.com" required>
                                        <label>Email Address</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-muted small mb-1">Upload Photo</label>
                                    <input type="file" class="form-control" name="photo" accept=".jpg, .jpeg, .png" required>
                                </div>
                                <div class="col-12 d-grid">
                                    <button type="submit" name="submit" class="btn btn-primary py-2 shadow-sm">
                                        <i class="bi bi-save me-1"></i> Register & Send Credentials
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">Registered Department Heads</h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable">
                                    <thead class="table-light small">
                                        <tr>
                                            <th class="text-center">Photo</th>
                                            <th>ID / Name</th>
                                            <th>Department</th>
                                            <th>Assignment</th>
                                            <th>Contact</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $deans = mysqli_query($conn, "SELECT e.*, d.department_name FROM dean_tbl e LEFT JOIN department_tbl d ON e.department_id = d.department_id WHERE e.d_status = 1 ORDER BY e.dean_id DESC");
                                        while ($row = mysqli_fetch_assoc($deans)) {
                                            $imgSrc = !empty($row['photo']) && file_exists("./uploads/" . $row['photo']) ? "./uploads/" . $row['photo'] : "https://ui-avatars.com/api/?name=" . $row['first_name'];
                                            ?>
                                                <tr>
                                                    <td class="text-center"><img src="<?= $imgSrc ?>" width="40" height="40" class="rounded-circle border"></td>
                                                    <td>
                                                        <span class="fw-bold text-primary"><?= $row['employee_no'] ?></span><br>
                                                        <small class="fw-bold"><?= $row['first_name'] . ' ' . $row['last_name'] ?></small>
                                                    </td>
                                                    <td><span class="badge bg-light text-dark border"><?= $row['department_name'] ?></span></td>
                                                    <td class="small">Yr: <?= $row['year_assigned'] ?> | Sem: <?= $row['semester_assigned'] ?></td>
                                                    <td class="small"><?= $row['email'] ?></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-outline-primary edit-btn" 
                                                            data-bs-toggle="modal" data-bs-target="#editDeanModal"
                                                            data-id="<?= $row['dean_id'] ?>" data-emp="<?= $row['employee_no'] ?>"
                                                            data-fname="<?= $row['first_name'] ?>" data-lname="<?= $row['last_name'] ?>"
                                                            data-dept="<?= $row['department_id'] ?>" data-year="<?= $row['year_assigned'] ?>"
                                                            data-sem="<?= $row['semester_assigned'] ?>" data-contact="<?= $row['contact_number'] ?>"
                                                            data-email="<?= $row['email'] ?>" data-photo="<?= $row['photo'] ?>"
                                                            data-imgsrc="<?= $imgSrc ?>">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" id="editDeanModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Head Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="dean_id" id="edit_dean_id">
                        <input type="hidden" name="old_photo" id="edit_old_photo">
                        <div class="row g-3">
                            <div class="col-12 text-center"><img id="preview_img" src="" class="rounded-circle border" width="70" height="70"></div>
                            <div class="col-12"><div class="form-floating"><input type="text" class="form-control" name="employee_no" id="edit_employee_no" required><label>Employee No</label></div></div>
                            <div class="col-6"><div class="form-floating"><input type="text" class="form-control" name="first_name" id="edit_first_name" required><label>First Name</label></div></div>
                            <div class="col-6"><div class="form-floating"><input type="text" class="form-control" name="last_name" id="edit_last_name" required><label>Last Name</label></div></div>
                            <div class="col-12">
                                <select class="form-select py-3" name="department_id" id="edit_department_id" required>
                                    <?php
                                    $dqm = mysqli_query($conn, "SELECT * FROM department_tbl WHERE dept_status = 1");
                                    while ($d = mysqli_fetch_assoc($dqm)) {
                                        echo "<option value='{$d['department_id']}'>{$d['department_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6"><div class="form-floating"><input type="number" class="form-control" name="year_assigned" id="edit_year_assigned" required><label>Year</label></div></div>
                            <div class="col-6"><div class="form-floating"><select class="form-select" name="semester_assigned" id="edit_semester_assigned" required><option value="1">1st Sem</option><option value="2">2nd Sem</option></select><label>Semester</label></div></div>
                            <div class="col-12"><div class="form-floating"><input type="email" class="form-control" name="email" id="edit_email" required><label>Email</label></div></div>
                            <div class="col-12"><label class="small">Change Photo</label><input type="file" class="form-control" name="photo" accept="image/*"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="update_dean" class="btn btn-success">Update Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('edit_dean_id').value = this.getAttribute('data-id');
                    document.getElementById('edit_employee_no').value = this.getAttribute('data-emp');
                    document.getElementById('edit_first_name').value = this.getAttribute('data-fname');
                    document.getElementById('edit_last_name').value = this.getAttribute('data-lname');
                    document.getElementById('edit_department_id').value = this.getAttribute('data-dept');
                    document.getElementById('edit_year_assigned').value = this.getAttribute('data-year');
                    document.getElementById('edit_semester_assigned').value = this.getAttribute('data-sem');
                    document.getElementById('edit_email').value = this.getAttribute('data-email');
                    document.getElementById('edit_old_photo').value = this.getAttribute('data-photo');
                    document.getElementById('preview_img').src = this.getAttribute('data-imgsrc');
                });
            });
        });
    </script>
</body>
</html>