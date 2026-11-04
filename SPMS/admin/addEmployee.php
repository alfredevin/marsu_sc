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

// --- HELPER FUNCTION FOR ALERTS ---
function showAlert($icon, $title, $text = "")
{
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "' . $icon . '",
                title: "' . $title . '",
                text: "' . $text . '",
                confirmButtonColor: "#3085d6"
            });
        });
    </script>';
}

// --- 2. ADD EMPLOYEE LOGIC ---
if (isset($_POST['submit'])) {
    $employee_no = strtoupper(trim($_POST['employee_no']));
    $first_name = strtoupper(trim($_POST['first_name']));
    $last_name = strtoupper(trim($_POST['last_name']));
    $department_id = $_POST['department_id'];
    $position_id = $_POST['position_id'];
    $contact = $_POST['contact_number'];
    $email = trim($_POST['email']);

    // Image Handling
    $photo = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $allowed_ext = ['jpg', 'jpeg', 'png'];
    $file_ext = strtolower(pathinfo($photo, PATHINFO_EXTENSION));

    $default_password = "123456"; // Password na ise-send sa email
    $hashed_password = password_hash($default_password, PASSWORD_DEFAULT);

    // Check Duplicates
    $check_stmt = mysqli_prepare($conn, "SELECT employee_id FROM employee_tbl WHERE employee_no = ? OR email = ?");
    mysqli_stmt_bind_param($check_stmt, "ss", $employee_no, $email);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        showAlert('error', 'Duplicate Entry!', 'Employee ID or Email already exists in the system.');
    } elseif (!in_array($file_ext, $allowed_ext)) {
        showAlert('error', 'Invalid File!', 'Only JPG, JPEG, and PNG are allowed.');
    } else {
        $new_photo_name = uniqid() . '.' . $file_ext;
        $upload_path = './uploads/' . $new_photo_name;

        if (move_uploaded_file($photo_tmp, $upload_path)) {
            $insert_stmt = $conn->prepare("INSERT INTO employee_tbl (employee_no, first_name, last_name, department_id, position_name, contact_number, email, photo, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("sssisssss", $employee_no, $first_name, $last_name, $department_id, $position_id, $contact, $email, $new_photo_name, $hashed_password);

            if ($insert_stmt->execute()) {

                // --- START EMAIL NOTIFICATION ---
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'onlineorderingandinventory@gmail.com'; // Admin Email
                    $mail->Password = 'kdikvnkzmzrcvylc'; // App Password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;

                    $mail->setFrom('onlineorderingandinventory@gmail.com', 'MarSU HR Admin');
                    $mail->addAddress($email, $first_name . ' ' . $last_name);

                    $mail->isHTML(true);
                    $mail->Subject = 'Account Created - MarSU Management System';
                    $mail->Body = '
                        <div style="font-family: Arial, sans-serif; max-width: 600px; border: 1px solid #ddd; padding: 20px;">
                            <h2 style="color: #800000;">Welcome to MarSU, ' . $first_name . '!</h2>
                            <p>Your employee account has been successfully created. You can now access the system using the credentials below:</p>
                            <div style="background: #f4f4f4; padding: 15px; border-radius: 5px;">
                                <p><strong>Login URL:</strong> <a href="http://localhost/boac/spms/login.php">Click here to login</a></p>
                                <p><strong>Username/Email:</strong> ' . $email . '</p>
                                <p><strong>Temporary Password:</strong> ' . $default_password . '</p>
                            </div>
                            <p style="margin-top: 20px;">Please change your password immediately after your first login for security purposes.</p>
                            <p>Best regards,<br>MarSU BAC/HR Secretariat</p>
                        </div>';

                    $mail->send();
                    showAlert('success', 'Employee Added!', 'Credentials have been sent to ' . $email);
                } catch (Exception $e) {
                    showAlert('warning', 'Employee Added!', 'System saved the data, but failed to send email. Error: ' . $mail->ErrorInfo);
                }
                // --- END EMAIL NOTIFICATION ---

            } else {
                showAlert('error', 'Error!', 'Could not save employee to database.');
            }
            $insert_stmt->close();
        } else {
            showAlert('error', 'Upload Fail!', 'Failed to move photo to uploads folder.');
        }
    }
    $check_stmt->close();
}

// --- 3. EDIT EMPLOYEE LOGIC ---
if (isset($_POST['update'])) {
    $emp_id = $_POST['employee_id'];
    $first_name = strtoupper(trim($_POST['first_name']));
    $last_name = strtoupper(trim($_POST['last_name']));
    $department_id = $_POST['department_id'];
    $position_id = $_POST['position_id'];
    $contact = $_POST['contact_number'];
    $email = trim($_POST['email']);
    $old_photo = $_POST['old_photo'];

    if (!empty($_FILES['photo']['name'])) {
        $file_ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $new_photo = uniqid() . '.' . $file_ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], "./uploads/" . $new_photo);
    } else {
        $new_photo = $old_photo;
    }

    $update = $conn->prepare("UPDATE employee_tbl SET first_name=?, last_name=?, department_id=?, position_name=?, contact_number=?, email=?, photo=? WHERE employee_id=?");
    $update->bind_param("sssssssi", $first_name, $last_name, $department_id, $position_id, $contact, $email, $new_photo, $emp_id);

    if ($update->execute()) {
        showAlert('success', 'Update Successful!', 'Employee details have been updated.');
    } else {
        showAlert('error', 'Update Failed!', 'Something went wrong while updating.');
    }
    $update->close();
}
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Employee Management</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-person-plus-fill me-2"></i>Add New Employee</h5>
                            <form class="row g-3" method="POST" enctype="multipart/form-data">
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Employee Number</label>
                                    <input type="text" class="form-control" name="employee_no"
                                        placeholder="e.g. 2024-001" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-bold">First Name</label>
                                    <input type="text" class="form-control" name="first_name" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-bold">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Department</label>
                                    <select class="form-select" name="department_id" required>
                                        <option value="" selected disabled>Choose...</option>
                                        <?php
                                        $deptQuery = mysqli_query($conn, "SELECT * FROM department_tbl WHERE dept_status = 1");
                                        while ($dept = mysqli_fetch_assoc($deptQuery)) {
                                            echo "<option value='{$dept['department_id']}'>{$dept['department_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Position</label>
                                    <select class="form-select" name="position_id" required>
                                        <option value="" selected disabled>Choose...</option>
                                        <?php
                                        $posQuery = mysqli_query($conn, "SELECT * FROM position_tbl");
                                        while ($pos = mysqli_fetch_assoc($posQuery)) {
                                            echo "<option value='{$pos['position_name']}'>{$pos['position_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Contact Number</label>
                                    <input type="text" class="form-control" name="contact_number" maxlength="11"
                                        required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Email Address</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Photo</label>
                                    <input type="file" class="form-control" name="photo" accept="image/*" required>
                                </div>
                                <div class="col-12 d-grid mt-3">
                                    <button type="submit" name="submit" class="btn btn-primary py-2 shadow-sm">
                                        <i class="bi bi-save me-1"></i> Register Employee
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">Active Employees</h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable">
                                    <thead class="table-light small">
                                        <tr>
                                            <th>Photo</th>
                                            <th>ID & Name</th>
                                            <th>Department</th>
                                            <th>Contact</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $employees = mysqli_query($conn, "SELECT e.*, d.department_name FROM employee_tbl e LEFT JOIN department_tbl d ON e.department_id = d.department_id WHERE e.status = 1 ORDER BY e.employee_id DESC");
                                        while ($emp = mysqli_fetch_assoc($employees)) {
                                            $imgSource = !empty($emp['photo']) && file_exists("./uploads/" . $emp['photo']) ? "./uploads/" . $emp['photo'] : "https://ui-avatars.com/api/?name=" . $emp['first_name'];
                                            ?>
                                            <tr>
                                                <td class="text-center"><img src="<?= $imgSource ?>" width="40" height="40"
                                                        class="rounded-circle border"></td>
                                                <td>
                                                    <span
                                                        class="d-block fw-bold text-primary"><?= $emp['employee_no'] ?></span>
                                                    <small><?= $emp['first_name'] . ' ' . $emp['last_name'] ?></small>
                                                </td>
                                                <td><span
                                                        class="badge bg-light text-dark border"><?= $emp['department_name'] ?></span>
                                                </td>
                                                <td class="small"><?= $emp['email'] ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                        data-bs-target="#edit<?= $emp['employee_id'] ?>"><i
                                                            class="bi bi-pencil"></i></button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="edit<?= $emp['employee_id'] ?>" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title">Edit Details</h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="employee_id"
                                                                    value="<?= $emp['employee_id'] ?>">
                                                                <input type="hidden" name="old_photo"
                                                                    value="<?= $emp['photo'] ?>">
                                                                <div class="row g-2">
                                                                    <div class="col-6">
                                                                        <label class="small">First Name</label>
                                                                        <input type="text" name="first_name"
                                                                            value="<?= $emp['first_name'] ?>"
                                                                            class="form-control" required>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label class="small">Last Name</label>
                                                                        <input type="text" name="last_name"
                                                                            value="<?= $emp['last_name'] ?>"
                                                                            class="form-control" required>
                                                                    </div>
                                                                    <div class="col-12 mt-2">
                                                                        <label class="small">Contact</label>
                                                                        <input type="text" name="contact_number"
                                                                            value="<?= $emp['contact_number'] ?>"
                                                                            class="form-control" required>
                                                                    </div>
                                                                    <div class="col-12 mt-2">
                                                                        <label class="small">Email</label>
                                                                        <input type="email" name="email"
                                                                            value="<?= $emp['email'] ?>"
                                                                            class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="update"
                                                                    class="btn btn-success">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
</body>

</html>