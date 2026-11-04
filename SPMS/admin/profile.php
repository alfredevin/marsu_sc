<?php
include './../config.php';

// Ensure session is started (if not already in config.php)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_user_id = $_SESSION['userid']; // Use Session ID for security

// --- HELPER: SweetAlert ---
function showAlert($icon, $title, $timer = 2000)
{
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: ' . $timer . ',
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer)
                    toast.addEventListener("mouseleave", Swal.resumeTimer)
                }
            });
            Toast.fire({ icon: "' . $icon . '", title: "' . $title . '" });
        });
    </script>';
}

// --- FETCH CURRENT USER DATA ---
$user_stmt = $conn->prepare("SELECT * FROM user_tbl WHERE userid = ?");
$user_stmt->bind_param("i", $current_user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user_data = $user_result->fetch_assoc();
$user_stmt->close();

// --- HANDLE PROFILE UPDATE ---
if (isset($_POST['update_profile'])) {
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    // Update Query using Prepared Statement
    $update_stmt = $conn->prepare("UPDATE user_tbl SET fullname = ?, username = ?, email = ? WHERE userid = ?");
    $update_stmt->bind_param("sssi", $fullname, $username, $email, $current_user_id);

    if ($update_stmt->execute()) {
        showAlert('success', 'Profile Updated Successfully!');
        // Refresh data immediately
        $user_data['fullname'] = $fullname;
        $user_data['username'] = $username;
        $user_data['email'] = $email;
    } else {
        showAlert('error', 'Failed to Update Profile.');
    }
    $update_stmt->close();
}

// --- HANDLE PASSWORD CHANGE ---
if (isset($_POST['change_password'])) {
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_new_password'];

    // Get current password hash
    $pass_stmt = $conn->prepare("SELECT password FROM user_tbl WHERE userid = ?");
    $pass_stmt->bind_param("i", $current_user_id);
    $pass_stmt->execute();
    $pass_res = $pass_stmt->get_result();
    $pass_row = $pass_res->fetch_assoc();
    $pass_stmt->close();

    if (password_verify($old_pass, $pass_row['password'])) {
        if ($new_pass === $confirm_pass) {
            $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

            $update_pass = $conn->prepare("UPDATE user_tbl SET password = ? WHERE userid = ?");
            $update_pass->bind_param("si", $hashed_password, $current_user_id);

            if ($update_pass->execute()) {
                // Success with Logout Prompt
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "Password Changed!",
                        text: "Please log out to apply security changes.",
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonText: "Logout Now",
                        cancelButtonText: "Stay Logged In"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../../logout"; 
                        }
                    });
                });
                </script>';
            } else {
                showAlert('error', 'Database Error.');
            }
            $update_pass->close();
        } else {
            showAlert('error', 'New passwords do not match!');
        }
    } else {
        showAlert('error', 'Incorrect Old Password!');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>My Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Profile Settings</li>
                </ol>
            </nav>
        </div>

        <section class="section profile">
            <div class="row">

                <div class="col-xl-4">
                    <div class="card shadow-sm">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user_data['fullname']); ?>&background=0d6efd&color=fff" alt="Profile" class="rounded-circle mb-3" width="100">
                            <h2><?php echo htmlspecialchars($user_data['fullname']); ?></h2>
                            <h3 class="badge bg-primary mt-2">
                                <?php echo ($user_data['usertype'] == 1) ? 'ADMINISTRATOR' : 'STAFF'; ?>
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card shadow-sm">
                        <div class="card-body pt-3">

                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                        <i class="bi bi-person-gear me-2"></i>Edit Profile
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-password">
                                        <i class="bi bi-shield-lock me-2"></i>Change Password
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                    <form method="POST">
                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="fullname" type="text" class="form-control" value="<?php echo htmlspecialchars($user_data['fullname']); ?>" required>
                                            </div>
                                        </div>
<!-- 
                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Username</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="username" type="text" class="form-control" value="<?php echo htmlspecialchars($user_data['username']); ?>" required>
                                            </div>
                                        </div> -->

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" name="update_profile" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade pt-3" id="profile-password">
                                    <form method="POST">

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="input-group">
                                                    <input name="old_password" type="password" class="form-control" id="currentPassword" required>
                                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePass('currentPassword')"><i class="bi bi-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="input-group">
                                                    <input name="new_password" type="password" class="form-control" id="newPassword" required>
                                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePass('newPassword')"><i class="bi bi-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="input-group">
                                                    <input name="confirm_new_password" type="password" class="form-control" id="renewPassword" required>
                                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePass('renewPassword')"><i class="bi bi-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" name="change_password" class="btn btn-danger">Change Password</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include '../template/footer.php'; ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php include '../template/script.php'; ?>

    <script>
        // Simple toggle password visibility
        function togglePass(inputId) {
            const input = document.getElementById(inputId);
            const icon = event.currentTarget.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>

</body>

</html>