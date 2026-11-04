<?php

include './../config.php';



if (isset($_POST['submit'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];
    $id = $_POST['id'];
    $sql = "SELECT userid, password FROM user_tbl WHERE userid = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (password_verify($old_password, $row['password'])) {
        if ($new_password === $confirm_new_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_sql = "UPDATE user_tbl SET password = '$hashed_password' WHERE userid = '$id'";
            if (mysqli_query($conn, $update_sql)) {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Show the toast notification first
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end", 
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener("mouseenter", Swal.stopTimer);
                            toast.addEventListener("mouseleave", Swal.resumeTimer);
                        }
                    });
        
                    // First toast message for successful update
                    Toast.fire({
                        icon: "success",
                        title: "Successfully Updated!!!"
                    }).then(function() {
                        // Show modal to confirm logging out
                        Swal.fire({
                            title: "You need to log out",
                            text: "Please log out to apply the changes.",
                            icon: "info",
                            showCancelButton: true,
                            confirmButtonText: "Logout",
                            cancelButtonText: "Stay logged in"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../logout";
                            }
                        });
                    });
                });
            </script>';
            } else {
                echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
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
                })

                Toast.fire({
                    icon: "error",
                    title: "Update Failed!!!"
                }) 
            });
        </script>';
            }
        } else {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
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
                })

                Toast.fire({
                    icon: "error",
                    title: "Mismatch Password!!!"
                }) 
            });
        </script>';
        }
    } else {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
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
            })

            Toast.fire({
                icon: "error",
                title: "Incorrect old Password!!!"
            }) 
        });
    </script>';
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
            <h1>Change Password</h1>

        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Password Information</h5>
                            <form class="row g-3" method="POST">

                                <input type="hidden" name="id" value="<?php echo $userid; ?>">
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Old Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="inputName4" name="old_password">
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">New Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="inputName4" name="new_password">
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="inputName4" name="confirm_new_password">
                                </div>
                                <div class="text-end">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form><!-- Vertical Form -->

                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>
    <?php include '../template/footer.php'; ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php include '../template/script.php'; ?>

</body>

</html>