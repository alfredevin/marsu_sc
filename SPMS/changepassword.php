<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
date_default_timezone_set("Asia/Manila");
include 'config.php';


$msg = "";


if (isset($_GET['reset'])) {
    if (mysqli_num_rows(result: mysqli_query($conn, "SELECT * FROM user_tbl WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm-password'];

            if ($password === $confirm_password) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $query = mysqli_query($conn, "UPDATE user_tbl SET password='{$hashed_password}', code='' WHERE code='{$_GET['reset']}'");

                if ($query) {
?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            swal.fire({
                                title: "Success",
                                text: "Password changed successfully. You can sign-in now!",
                                icon: "success",
                                confirmButtonText: "Okay",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = ('http://localhost/boac/spms/');
                                }
                            })
                        });
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        swal.fire({
                            title: "Failed",
                            text: "Password and Confirmation Password did not match!",
                            icon: "error",
                            confirmButtonText: "Okay",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then((result) => {
                            if (result.isConfirmed) {}
                        })
                    });
                </script>
        <?php
            }
        }
    } else {
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal.fire({
                    title: "Failed",
                    text: "Invalid link!",
                    icon: "error",
                    confirmButtonText: "Okay",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = ('http://localhost/boac/spms/');
                    }
                })
            });
        </script>
    <?php
    }
} else {
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            swal.fire({
                title: "Failed",
                text: "Invalid link!",
                icon: "error",
                confirmButtonText: "Okay",
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = ('http://localhost/boac/spms/');
                }
            })
        });
    </script>
<?php
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | Supply and Property Management</title>
    <link href="https://www.mscmarinduque.edu.ph/wp-content/uploads/2025/04/marsu_logo.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: linear-gradient(rgba(128, 0, 0, 0.6), rgba(0, 0, 0, 0.8)), url('https://www.mscmarinduque.edu.ph/wp-content/uploads/2024/07/449516121_1284678695691355_7898451616750512347_n.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }

        .logo-img {
            width: 80px;
            height: 80px;
            border: 4px solid #fff;
            border-radius: 50%;
            background-color: white;
            margin-top: -40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-maroon {
            background-color: #800000;
            color: white;
            font-weight: 600;
            border: none;
        }

        .btn-maroon:hover {
            background-color: #600000;
            color: white;
        }

        .form-control:focus {
            border-color: #800000;
            box-shadow: 0 0 0 0.25rem rgba(128, 0, 0, 0.25);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body px-4 pb-4 pt-0 text-center">

                        <img src="https://www.mscmarinduque.edu.ph/wp-content/uploads/2025/04/marsu_logo.png" alt="Logo" class="logo-img mb-3">

                        <h4 style="color: #800000; font-weight: 700;">RESET PASSWORD</h4>
                        <p class="text-muted small mb-4">Create a new strong password.</p>

                        <form method="POST" class="text-start">
                            <input type="hidden" name="email_hidden" value="<?php echo htmlspecialchars($emailFromUrl); ?>">

                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="newPass" placeholder="New Password" required minlength="6">
                                <label for="newPass">New Password</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" name="confirm-password" class="form-control" id="confPass" placeholder="Confirm Password" required minlength="6">
                                <label for="confPass">Confirm New Password</label>
                            </div>

                            <button type="submit" name="submit" class="btn btn-maroon w-100 py-2">
                                UPDATE PASSWORD
                            </button>

                            <div class="text-center mt-3">
                                <a href="index.php" class="text-decoration-none small text-secondary">Back to Login</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>