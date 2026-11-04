<?php
session_start();
date_default_timezone_set("Asia/Manila");
include 'config.php';

// PHPMailer Classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './mailer/src/Exception.php';
require './mailer/src/PHPMailer.php';
require './mailer/src/SMTP.php';

// --- LOGIN LOGIC ---
if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $lockoutTime = 10 * 60;
  $maxLoginAttempts = 3;

  $currentTime = time();
  $ipAddress = $_SERVER['REMOTE_ADDR'];

  $sql = "SELECT * FROM login_attempts WHERE ip_address = '$ipAddress'";
  $result = mysqli_query($conn, $sql);

  $failedAttemptsCount = mysqli_num_rows($result);

  if ($failedAttemptsCount >= $maxLoginAttempts) {
    $lastAttemptTime = mysqli_fetch_assoc($result)['last_attempt'];
    $remainingLockoutTime = $lastAttemptTime + $lockoutTime - $currentTime;

    if ($remainingLockoutTime > 0) {
      $minutesRemaining = ceil($remainingLockoutTime / 60);
      echo '<script>
                document.addEventListener("DOMContentLoaded", function () {
                    Swal.fire({
                        title: "Unable to Login!",
                        text: "Try Again After ' . $minutesRemaining . ' minutes!",
                        icon: "error",
                        confirmButtonText: "Okay",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    });
                });
            </script>';
    } else {
      $sql = "DELETE FROM login_attempts WHERE ip_address = '$ipAddress'";
      mysqli_query($conn, $sql);
    }
  } else {
    $sql = "SELECT * FROM user_tbl WHERE username = '$username' AND useractive = '1'";
    $result = mysqli_query($conn, $sql);

    $dean = "SELECT * FROM dean_tbl WHERE employee_no = '$username' AND d_status = '1'";
    $deanResult = mysqli_query($conn, $dean);

    $employee_user = "SELECT * FROM employee_tbl WHERE employee_no = '$username' AND status = '1'";
    $employeeResult = mysqli_query($conn, $employee_user);


    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      $usertype = $row['usertype'];

      if (password_verify($password, $row['password'])) {
        $sql = "DELETE FROM login_attempts WHERE ip_address = '$ipAddress'";
        mysqli_query($conn, $sql);

        $loginTime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO userlogs_tbl (userid, username, login_time, ip_address) VALUES ('$usertype', '$username', '$loginTime', '$ipAddress')";
        mysqli_query($conn, $sql);
        $encodedUrl = base64_encode("./admin/");
        $_SESSION['usertype'] = 1;
        $_SESSION['userid'] = $row['userid'];
        echo '<script>
                  document.addEventListener("DOMContentLoaded", function () {
                      const Toast = Swal.mixin({
                          toast: true,
                          position: "top-end",
                          showConfirmButton: false,
                          timer: 2000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                              toast.addEventListener("mouseenter", Swal.stopTimer)
                              toast.addEventListener("mouseleave", Swal.resumeTimer)
                          }
                      });
                      Toast.fire({ icon: "success", title: "Signed In Successfully!!!" });
                      setTimeout(function () { window.location.href = atob("' . $encodedUrl . '"); }, 2000);
                  });
              </script>';
      } else {
        $sql = "INSERT INTO login_attempts (ip_address, last_attempt) VALUES ('$ipAddress', $currentTime)";
        mysqli_query($conn, $sql);
        echo '<script>
                  document.addEventListener("DOMContentLoaded", function () {
                      Swal.fire({ title: "Incorrect Credential!", text: "Try Again!!!", icon: "warning", confirmButtonText: "Okay", confirmButtonColor: "#800000" });
                  });
              </script>';
      }
    } else if (mysqli_num_rows($deanResult) === 1) {
      $dean_row = mysqli_fetch_assoc($deanResult);
      $dean_id = $dean_row['dean_id'];
      $employee_no = $dean_row['employee_no'];

      if (password_verify($password, $dean_row['password'])) {
        $sql = "DELETE FROM login_attempts WHERE ip_address = '$ipAddress'";
        mysqli_query($conn, $sql);

        $loginTime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO userlogs_tbl (userid, username, login_time, ip_address) VALUES ('$dean_id', '$username', '$loginTime', '$ipAddress')";
        mysqli_query($conn, $sql);
        $deanUrl = base64_encode("./dean/");
        $_SESSION['dean_id'] = $dean_row['dean_id'];
        echo '<script>
                  document.addEventListener("DOMContentLoaded", function () {
                      const Toast = Swal.mixin({
                          toast: true,
                          position: "top-end",
                          showConfirmButton: false,
                          timer: 2000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                              toast.addEventListener("mouseenter", Swal.stopTimer)
                              toast.addEventListener("mouseleave", Swal.resumeTimer)
                          }
                      });
                      Toast.fire({ icon: "success", title: "Signed In Successfully!!!" });
                      setTimeout(function () { window.location.href = atob("' . $deanUrl . '"); }, 2000);
                  });
              </script>';
      } else {
        $sql = "INSERT INTO login_attempts (ip_address, last_attempt) VALUES ('$ipAddress', $currentTime)";
        mysqli_query($conn, $sql);
        echo '<script>
                  document.addEventListener("DOMContentLoaded", function () {
                      Swal.fire({ title: "Incorrect Credential!", text: "Try Again!!!", icon: "warning", confirmButtonText: "Okay", confirmButtonColor: "#800000" });
                  });
              </script>';
      }
    } else if (mysqli_num_rows($employeeResult) === 1) {
      $employeeRow = mysqli_fetch_assoc($employeeResult);
      $employee_id = $employeeRow['employee_id'];
      $employee_no = $employeeRow['employee_no'];

      if (password_verify($password, $employeeRow['password'])) {
        $sql = "DELETE FROM login_attempts WHERE ip_address = '$ipAddress'";
        mysqli_query($conn, $sql);

        $loginTime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO userlogs_tbl (userid, username, login_time, ip_address) VALUES ('$employee_id', '$username', '$loginTime', '$ipAddress')";
        mysqli_query($conn, $sql);
        $employeeUrl = base64_encode("./employee/");
        $_SESSION['employee_id'] = $employeeRow['employee_id'];
        echo '<script>
                  document.addEventListener("DOMContentLoaded", function () {
                      const Toast = Swal.mixin({
                          toast: true,
                          position: "top-end",
                          showConfirmButton: false,
                          timer: 2000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                              toast.addEventListener("mouseenter", Swal.stopTimer)
                              toast.addEventListener("mouseleave", Swal.resumeTimer)
                          }
                      });
                      Toast.fire({ icon: "success", title: "Signed In Successfully!!!" });
                      setTimeout(function () { window.location.href = atob("' . $employeeUrl . '"); }, 2000);
                  });
              </script>';
      } else {
        $sql = "INSERT INTO login_attempts (ip_address, last_attempt) VALUES ('$ipAddress', $currentTime)";
        mysqli_query($conn, $sql);
        echo '<script>
                  document.addEventListener("DOMContentLoaded", function () {
                      Swal.fire({ title: "Incorrect Credential!", text: "Try Again!!!", icon: "warning", confirmButtonText: "Okay", confirmButtonColor: "#800000" });
                  });
              </script>';
      }
    }
  }
}

// --- FORGOT PASSWORD LOGIC ---
if (isset($_POST['send_reset_link'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $code = mysqli_real_escape_string($conn, md5(rand()));

  // Check if the email exists in user_tbl
  if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user_tbl WHERE email='{$email}'")) > 0) {
    $query = mysqli_query($conn, "UPDATE user_tbl SET code='{$code}' WHERE email='{$email}'");

    if ($query) {
      echo "<div style='display: none;'>";
      $mail = new PHPMailer(true);
      try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'onlineorderingandinventory@gmail.com';
        $mail->Password   = 'kdikvnkzmzrcvylc'; // Your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->setFrom('onlineorderingandinventory@gmail.com', 'MarSU BAC Secretariat');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request - MarSU Supply and Property Management System';

        // IMPORTANT: Updated the link to point to change-password.php
        $resetLink = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/changepassword.php?reset=" . $code;

        $mail->Body = '
                    <p>Dear User,</p>
                    <p>We received a request to reset your password. 
                    If you made this request, please click the button below to create a new password.</p>

                    <p style="text-align: center;">
                        <a href="' . $resetLink . '" style="
                            background-color: #800000; 
                            color: white; 
                            padding: 10px 20px; 
                            text-decoration: none; 
                            border-radius: 5px;
                            font-size: 16px;
                            display: inline-block;
                        ">
                            Reset Your Password
                        </a>
                    </p>
                    <br>
                    <p>Best regards,<br>Marinduque State University</p>
                ';
        $mail->send();
?>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
              title: "Success!",
              text: "We have sent a password reset link to your email address.",
              icon: "success",
              confirmButtonText: "Okay",
              confirmButtonColor: "#800000",
              allowOutsideClick: false,
              allowEscapeKey: false,
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = 'index';
              }
            });
          });
        </script>
      <?php
      } catch (Exception $e) {
      ?>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
              title: "Failed!",
              text: "Message could not be sent. Please try again later.",
              icon: "error",
              confirmButtonText: "Okay",
              confirmButtonColor: "#800000"
            });
          });
        </script>
      <?php
      }
    } else {
      ?>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
            title: "Failed!",
            text: "Something went wrong while processing your request.",
            icon: "error",
            confirmButtonText: "Okay",
            confirmButtonColor: "#800000"
          });
        });
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
          title: "Email Not Found!",
          text: "No account associated with this email address.",
          icon: "warning",
          confirmButtonText: "Okay",
          confirmButtonColor: "#800000"
        });
      });
    </script>
<?php
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login | Supply and Property Management</title>

  <link href="https://www.mscmarinduque.edu.ph/wp-content/uploads/2025/04/marsu_logo.png" rel="icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-image: linear-gradient(rgba(128, 0, 0, 0.6), rgba(0, 0, 0, 0.8)), url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyIp_4d2WLgb_34qruhHnT6dRhagQtSIhZmLg1xPkb&s');
      background-size: cover;
      background-position: center;
      height: 100vh;
      overflow: hidden;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .logo-img {
      width: 90px;
      height: 90px;
      border: 4px solid #fff;
      border-radius: 50%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background-color: white;
      padding: 2px;
      margin-top: -50px;
    }

    .card-title {
      color: #800000;
      /* MarSU Maroon */
      font-weight: 700;
      letter-spacing: 1px;
    }

    .form-floating>label {
      color: #6c757d;
    }

    .form-control:focus {
      border-color: #800000;
      box-shadow: 0 0 0 0.25rem rgba(128, 0, 0, 0.25);
    }

    .btn-login {
      background-color: #800000;
      border: none;
      font-weight: 600;
      letter-spacing: 1px;
      transition: all 0.3s;
    }

    .btn-login:hover {
      background-color: #600000;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(128, 0, 0, 0.3);
    }

    .password-toggle {
      cursor: pointer;
      color: #6c757d;
    }

    .password-toggle:hover {
      color: #800000;
    }
  </style>
</head>

<body>

  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card login-card w-100">
                <div class="card-body pb-4 px-4 pt-0">

                  <div class="d-flex justify-content-center mb-2">
                    <img src="https://hrmis.marsu.edu.ph/dist/img/marsu_logo.png" alt="Logo" class="logo-img">
                  </div>

                  <div id="loginSection">
                    <div class="text-center mb-4">
                      <!-- <h4 class="title-text" style="color: #800000; font-weight: 700;">SIGN IN</h4> -->
                      <p class="small text-muted">Supply & Property Management System</p>
                    </div>

                    <form class="row g-3 needs-validation" method="POST" autocomplete="off" id="loginForm">

                      <div class="col-12">
                        <div class="form-floating">
                          <input type="text" name="username" class="form-control" id="yourUsername" placeholder="Username" required>
                          <label for="yourUsername"><i class="bi bi-person-fill me-1"></i> Username</label>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="input-group">
                          <div class="form-floating flex-grow-1">
                            <input type="password" name="password" class="form-control" id="yourPassword" placeholder="Password" required>
                            <label for="yourPassword"><i class="bi bi-lock-fill me-1"></i> Password</label>
                          </div>
                          <span class="input-group-text bg-white border-start-0">
                            <i class="bi bi-eye-slash password-toggle" id="togglePassword"></i>
                          </span>
                        </div>
                      </div>

                      <div class="col-12 mt-4">
                        <button class="btn btn-primary w-100 btn-login py-2" type="submit" name="submit" id="loginBtn">
                          LOGIN
                        </button>
                      </div>

                      <div class="col-12 text-center mt-4">
                        <div class="credits"> Forgot Password?<br>
                          <a href="javascript:void(0)" onclick="toggleForms('forgot')" style="color: #800000; font-weight: 600;">Click Here</a>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div id="forgotSection" style="display: none;">
                    <div class="text-center mb-4">
                      <h4 class="title-text" style="color: #800000; font-weight: 700;">RESET PASSWORD</h4>
                      <p class="small text-muted">Enter email to receive reset link</p>
                    </div>

                    <form class="row g-3" method="POST" id="forgotForm">
                      <div class="col-12">
                        <div class="form-floating">
                          <input type="email" name="email" class="form-control" id="resetEmail" placeholder="Email" required>
                          <label for="resetEmail"><i class="bi bi-envelope-fill me-1"></i> Email Address</label>
                        </div>
                      </div>
                      <div class="col-12 mt-4">
                        <button class="btn btn-primary w-100 btn-login py-2" type="submit" name="send_reset_link">SEND LINK</button>
                      </div>
                    </form>

                    <div class="col-12 text-center mt-4">
                      <div class="credits">
                        <a href="javascript:void(0)" onclick="toggleForms('login')" class="text-secondary small" style="text-decoration: none;">&larr; Back to Login</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 text-center mt-1">
                    <div class="credits">
                      &copy; <?= date('Y') ?> Marinduque State University<br>
                      </a>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    // Toggle Password Visibility
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#yourPassword');

    if (togglePassword) {
      togglePassword.addEventListener('click', function(e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
      });
    }

    // Toggle Forms Logic
    function toggleForms(type) {
      const loginSec = document.getElementById('loginSection');
      const forgotSec = document.getElementById('forgotSection');

      if (type === 'forgot') {
        loginSec.style.display = 'none';
        forgotSec.style.display = 'block';
      } else {
        forgotSec.style.display = 'none';
        loginSec.style.display = 'block';
      }
    }

    // Check if we need to stay on forgot page (if there was an error submitting it)
    <?php if (isset($_POST['send_reset_link'])): ?>
      toggleForms('forgot');
    <?php endif; ?>
  </script>

</body>

</html>