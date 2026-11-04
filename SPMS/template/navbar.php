<?php
session_start();
include '../config.php';

$fullname = '';
$account_role = '';

if (isset($_SESSION['userid'])) {
    $userid = mysqli_real_escape_string($conn, $_SESSION['userid']);
    $navbar = "SELECT * FROM user_tbl WHERE userid = '$userid'";
    $result_navbar = mysqli_query($conn, $navbar);

    if ($result_navbar && mysqli_num_rows($result_navbar) > 0) {
        $row = mysqli_fetch_assoc($result_navbar);
        $fullname = isset($row['fullname']) ? $row['fullname'] : $row['first_name'] . ' ' . $row['last_name'];
        $account_role = 'ADMINISTRATOR';
    }
} elseif (isset($_SESSION['dean_id'])) {
    $dean_id_row = mysqli_real_escape_string($conn, $_SESSION['dean_id']);
    $navbar = "SELECT * FROM dean_tbl WHERE dean_id = '$dean_id_row'";
    $result_navbar = mysqli_query($conn, $navbar);

    if ($result_navbar && mysqli_num_rows($result_navbar) > 0) {
        $row = mysqli_fetch_assoc($result_navbar);
        $fullname = $row['first_name'] . ' ' . $row['last_name'];
        $account_role = 'DEAN';
        $dept_id = $row['department_id'];
        $dean_id = $row['dean_id'];
    }
} elseif (isset($_SESSION['employee_id'])) {
    $employee_id = mysqli_real_escape_string($conn, $_SESSION['employee_id']);
    $navbar = "SELECT * FROM employee_tbl WHERE employee_id = '$employee_id'";
    $result_navbar = mysqli_query($conn, $navbar);

    if ($result_navbar && mysqli_num_rows($result_navbar) > 0) {
        $row = mysqli_fetch_assoc($result_navbar);
        $fullname = $row['first_name'] . ' ' . $row['last_name'];
        $account_role = 'EMPLOYEE';
        $employee_id = $row['employee_id'];
    }
} else {
    header("Location: ../index");
    exit();
}
?>

<header id="header" class="header fixed-top d-flex align-items-center" style="background:rgb(128,0,36);border-bottom:white 1px solid;">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index" class="logo d-flex align-items-center">
            <img src="https://www.mscmarinduque.edu.ph/wp-content/uploads/2024/07/MARSU-Seal-no-background-1024x995.png" alt="" style="border-radius: 50%;">
            <span class="d-none d-lg-block" style="text-align:left;color:white;font-family:poppins;font-size:15px;text-transform:uppercase;">

                Marinduque State University
                <hr style="margin: 3px;"> 
        </a>
        <i class="bi bi-list toggle-sidebar-btn" style="color:white;"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2" style="color:white;">
                        <?php echo $fullname; ?></span>
                </a>
                <!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>
                            <?php echo $fullname; ?></h6>
                        <span><?php echo $account_role; ?></span>


                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="profile">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="log">
                            <i class="bi bi-question-circle"></i>
                            <span>Activity Log</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
<!-- 
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="changepassword">
                            <i class="bi bi-gear"></i>
                            <span>Change Password</span>
                        </a>
                    </li> -->
                    <li>
                        <hr class="dropdown-divider">
                    </li>


                    <li>
                        <a class="dropdown-item d-flex align-items-center" id="signOutLinkNav">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('signOutLinkNav').addEventListener('click', function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to sign out?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, sign out',
            cancelButtonText: 'No, stay here'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../logout';
            }
        });
    });
</script>