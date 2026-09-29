<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="MarSU CICS Centralized ERP and Executive Dashboard Platform">
    <meta name="author" content="College of Information and Computing Sciences">

    <title><?= e($title ?? 'Dashboard') ?> | MarSU CICS ERP</title>

    <!-- MarSU Favicon -->
    <link rel="icon" type="image/png" href="<?= asset('assets/img/marsu-sm.png') ?>">

    <!-- Inline Dark Theme Initializer (Prevents FOUC) -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('marsu_erp_theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
        })();
    </script>

    <!-- Offline Vendor Stylesheets -->
    <link href="<?= asset('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= asset('assets/vendor/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">

    <!-- MarSU Official Brand Theme & Component Styles -->
    <link href="<?= asset('assets/css/theme.css') ?>" rel="stylesheet">
</head>
<body class="<?= e($bodyClass ?? '') ?>">
