 <?php

    include './../config.php';

    if (isset($_POST["update"])) {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $userid = $_POST['userid'];
        $sql = "UPDATE user_tbl SET fullname = '$fullname', email = '$email', username = '$username'
    WHERE userid = '$userid'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
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
                icon: "success",
                title: "Successfully Update!!!"
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
             <h1>My Profile</h1>

         </div><!-- End Page Title -->
         <section class="section">
             <div class="row">
                 <div class="col-lg-12">

                     <div class="card">
                         <?php
                            $sql = "SELECT * FROM user_tbl WHERE userid = '" . $_SESSION['userid'] . "'";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                             <div class="card-body">
                                 <p>Edit Profile Information </p>

                                 <form action="" method="post" class="text-center">
                                     <div class="row text-black">
                                         <input type="hidden" name="userid" value="<?php echo $row['userid'] ?>">
                                         <div class="col-6">
                                             <label for="formGroupExampleInput" class="font-weight-bolder">Usertype
                                             </label>
                                             <input type="text" class="form-control" name=" " id="validationCustom03"
                                                 value="
                                            <?php
                                            if ($row['usertype'] == 1) {
                                                echo 'ADMINISTRATOR';
                                            } else {
                                                echo 'STAFF';
                                            }
                                            ?>" readonly>
                                         </div>

                                         <div class="col-6">
                                             <label for="formGroupExampleInput" class="font-weight-bolder">FullName
                                             </label>
                                             <input type="text" class="form-control text-center" name="fullname"
                                                 id="validationCustom03" value="<?php echo $row['fullname'] ?>">
                                         </div>
                                         <div class="col-6 mt-3">
                                             <label for="formGroupExampleInput" class="font-weight-bolder">Username
                                             </label>
                                             <input type="text" class="form-control text-center" name="username"
                                                 id="validationCustom03" value="<?php echo $row['username'] ?>">
                                         </div>
                                         <div class="col-6 mt-3">
                                             <label for="formGroupExampleInput" class="font-weight-bolder">Email </label>
                                             <input type="text" class="form-control text-center" name="email"
                                                 id="validationCustom03" value="<?php echo $row['email'] ?>">
                                         </div>
                                     </div>
                                     <div class="modal-footer mt-3">
                                         <a href=""><button type="submit" name="update"
                                                 class="btn btn-success">Save</button></a>
                                     </div>
                                 </form>
                             </div>
                         <?php } ?>
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