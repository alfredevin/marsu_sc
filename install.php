<?php
/**
 * MarSU Centralized ERP - Web Installer Wizard
 * Checks environment, creates database, writes .env, runs migrations & seeders, then locks itself.
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

$lockFile = __DIR__ . '/storage/installed.lock';
$isLocked = file_exists($lockFile);

// Requirements
$reqs = [
    'PHP Version (>= 8.1)' => [version_compare(PHP_VERSION, '8.1.0', '>='), 'Current: ' . PHP_VERSION],
    'PDO Extension'        => [extension_loaded('pdo'), 'Required for database operations'],
    'PDO MySQL Driver'     => [extension_loaded('pdo_mysql'), 'Required for MariaDB/MySQL'],
    'Mbstring Extension'   => [extension_loaded('mbstring'), 'Required for UTF-8 string handling'],
    'FileInfo Extension'   => [extension_loaded('fileinfo'), 'Required for secure file uploads'],
    'GD Library'           => [extension_loaded('gd'), 'Required for image processing & badge generation'],
    'Storage Writable'     => [is_writable(__DIR__ . '/storage') || @mkdir(__DIR__ . '/storage', 0777, true), 'storage/ must be writable']
];

$allReqsPassed = !in_array(false, array_column($reqs, 0));

$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$isLocked) {
    $dbHost = trim($_POST['db_host'] ?? '127.0.0.1');
    $dbPort = trim($_POST['db_port'] ?? '3306');
    $dbName = trim($_POST['db_name'] ?? 'marsu_erp');
    $dbUser = trim($_POST['db_user'] ?? 'root');
    $dbPass = $_POST['db_pass'] ?? '';

    $adminUser = trim($_POST['admin_user'] ?? 'admin');
    $adminEmail = trim($_POST['admin_email'] ?? 'admin@marsu.edu.ph');
    $adminPass = $_POST['admin_pass'] ?? 'Password123!';

    try {
        // 1. Test server connection without db
        $dsn = "mysql:host={$dbHost};port={$dbPort};charset=utf8mb4";
        $pdo = new PDO($dsn, $dbUser, $dbPass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        // 2. Create database if missing
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

        // 3. Write .env
        $envContent = "APP_NAME=\"MarSU Centralized ERP\"\n"
            . "APP_ENV=local\n"
            . "APP_DEBUG=true\n"
            . "APP_URL=http://localhost/marsu-erp\n"
            . "PRETTY_URLS=true\n\n"
            . "DB_CONNECTION=mysql\n"
            . "DB_HOST={$dbHost}\n"
            . "DB_PORT={$dbPort}\n"
            . "DB_DATABASE={$dbName}\n"
            . "DB_USERNAME={$dbUser}\n"
            . "DB_PASSWORD=\"{$dbPass}\"\n\n"
            . "SESSION_LIFETIME=120\n"
            . "TIMEZONE=\"Asia/Manila\"\n";

        file_put_contents(__DIR__ . '/.env', $envContent);

        // 4. Run Autoloader & Migrations
        require_once __DIR__ . '/core/Autoloader.php';
        require_once __DIR__ . '/core/helpers.php';
        
        \Core\Database::loadEnv(__DIR__ . '/.env');
        \Core\Migration::runAll();
        \Core\Seeder::runAll();

        // 5. Update admin account if custom values supplied
        if ($adminUser !== 'admin' || $adminEmail !== 'admin@marsu.edu.ph' || $adminPass !== 'Password123!') {
            $hashed = password_hash($adminPass, PASSWORD_BCRYPT, ['cost' => 12]);
            \Core\Database::update('users', [
                'username' => $adminUser,
                'email'    => $adminEmail,
                'password' => $hashed
            ], 'id = 1');
        }

        // 6. Write lock file
        file_put_contents($lockFile, "Installed on " . date('Y-m-d H:i:s') . " by " . $adminEmail . "\n");
        $isLocked = true;
        $success = "MarSU Centralized ERP has been successfully installed and initialized!";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MarSU ERP - Web Installer</title>
    <link href="public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="public/assets/css/theme.css" rel="stylesheet">
    <style>
        body { background: #FAF7F7; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem 1rem; }
        .installer-card { max-width: 840px; width: 100%; border: none; border-radius: 1rem; box-shadow: 0 10px 40px rgba(128, 0, 32, 0.12); overflow: hidden; background: #FFFFFF; }
        .installer-header { background: linear-gradient(135deg, #800020 0%, #5C0016 100%); color: #FFFFFF; padding: 2.5rem; text-align: center; border-bottom: 4px solid #D4AF37; }
        .installer-body { padding: 2.5rem; }
    </style>
</head>
<body>

<div class="installer-card">
    <div class="installer-header">
        <img src="public/assets/img/marsu.png" alt="MarSU Seal" style="width: 80px; height: 80px; border-radius: 50%; border: 3px solid #D4AF37; background: #fff; padding: 4px;" class="mb-3">
        <h2 class="h3 font-weight-bold mb-1">Marinduque State University</h2>
        <h5 class="text-gold font-weight-normal mb-2" style="color: #D4AF37;">College of Information and Computing Sciences</h5>
        <p class="small mb-0 text-white-50">Centralized ERP & Executive Dashboard Platform Installer</p>
    </div>

    <div class="installer-body">
        <?php if ($isLocked): ?>
            <div class="alert alert-success d-flex align-items-center mb-4">
                <i class="bi bi-shield-check fs-2 text-success me-3"></i>
                <div>
                    <h5 class="alert-heading mb-1 font-weight-bold">System Successfully Installed & Locked</h5>
                    <p class="mb-0 text-muted">The core platform is active. Security lock <code>storage/installed.lock</code> is engaged.</p>
                </div>
            </div>

            <div class="card mb-4 border-0 bg-light">
                <div class="card-body">
                    <h6 class="font-weight-bold text-marsu-burgundy mb-3"><i class="bi bi-key-fill text-gold me-2"></i>Default Credentials</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered bg-white mb-0">
                            <thead class="bg-light">
                                <tr><th>Role</th><th>Username</th><th>Password</th></tr>
                            </thead>
                            <tbody>
                                <tr><td><strong>Super Administrator</strong></td><td><code>admin</code></td><td><code>Password123!</code></td></tr>
                                <tr><td><strong>College Dean</strong></td><td><code>dean</code></td><td><code>Password123!</code></td></tr>
                                <tr><td><strong>Faculty</strong></td><td><code>faculty</code></td><td><code>Password123!</code></td></tr>
                                <tr><td><strong>Student</strong></td><td><code>student</code></td><td><code>Password123!</code></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="public/index.php" class="btn btn-marsu btn-lg px-5 me-2"><i class="bi bi-box-arrow-in-right me-2"></i>Open Application</a>
                <a href="public/index.php?r=login" class="btn btn-outline-secondary btn-lg px-4"><i class="bi bi-person-circle me-2"></i>Login</a>
            </div>

        <?php else: ?>

            <?php if ($error): ?>
                <div class="alert alert-danger mb-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Installation Error:</strong> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <h5 class="text-marsu-burgundy font-weight-bold mb-3 border-bottom pb-2">1. System Pre-flight Requirements</h5>
            <div class="row g-2 mb-4">
                <?php foreach ($reqs as $label => [$passed, $subtext]): ?>
                    <div class="col-md-6">
                        <div class="p-2 border rounded d-flex align-items-center justify-content-between <?= $passed ? 'border-success-subtle bg-success-subtle' : 'border-danger-subtle bg-danger-subtle' ?>">
                            <div>
                                <strong class="small d-block"><?= htmlspecialchars($label) ?></strong>
                                <span class="text-muted" style="font-size: 0.75rem;"><?= htmlspecialchars($subtext) ?></span>
                            </div>
                            <?php if ($passed): ?>
                                <span class="badge bg-success"><i class="bi bi-check-lg"></i> OK</span>
                            <?php else: ?>
                                <span class="badge bg-danger"><i class="bi bi-x-lg"></i> Missing</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($allReqsPassed): ?>
                <form method="POST" action="install.php">
                    <h5 class="text-marsu-burgundy font-weight-bold mb-3 border-bottom pb-2">2. Database Configuration (MySQL / MariaDB)</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Database Host</label>
                            <input type="text" name="db_host" class="form-control" value="127.0.0.1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Database Port</label>
                            <input type="text" name="db_port" class="form-control" value="3306" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Database Name</label>
                            <input type="text" name="db_name" class="form-control" value="marsu_erp" required>
                            <small class="text-muted" style="font-size: 0.75rem;">Created automatically if not existing.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Database Username</label>
                            <input type="text" name="db_user" class="form-control" value="root" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small font-weight-bold">Database Password</label>
                            <input type="password" name="db_pass" class="form-control" placeholder="Leave empty for default XAMPP root">
                        </div>
                    </div>

                    <h5 class="text-marsu-burgundy font-weight-bold mb-3 border-bottom pb-2">3. Super Administrator Account</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Username</label>
                            <input type="text" name="admin_user" class="form-control" value="admin" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Email Address</label>
                            <input type="email" name="admin_email" class="form-control" value="admin@marsu.edu.ph" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small font-weight-bold">Password</label>
                            <input type="password" name="admin_pass" class="form-control" value="Password123!" required>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-marsu btn-lg py-2 font-weight-bold">
                            <i class="bi bi-gear-fill me-2"></i>Install MarSU ERP Core Platform
                        </button>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-warning">
                    Please enable the missing PHP extensions in your <code>php.ini</code> before proceeding.
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</div>

</body>
</html>
