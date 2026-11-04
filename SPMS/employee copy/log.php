<?php

include './../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>

    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Activity Log</h1>

        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">History Log</h5>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Usertype</th>
                                        <th>Username</th>
                                        <th>Login Time</th>
                                        <th>Ip Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM userlogs_tbl";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>


                                        <tr>
                                            <td><?php
                                                if ($row['userid'] == 1) {
                                                    echo 'ADMINISTRATOR';
                                                } else {
                                                    echo 'STAFF';
                                                } ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['login_time']; ?></td>
                                            <td><?php echo $row['ip_address']; ?></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
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