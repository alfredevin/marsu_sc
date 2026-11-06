<?php
require 'core/Autoloader.php';
Core\Database::loadEnv('.env');

echo "=== ANA_ TABLES ===\n";
$ana = Core\Database::fetchAll("SHOW TABLES LIKE 'ana_%'");
foreach ($ana as $row) {
    $tbl = array_values($row)[0];
    $cnt = Core\Database::fetchOne("SELECT COUNT(*) as c FROM `$tbl`")['c'] ?? 0;
    echo "$tbl: $cnt rows\n";
}

echo "\n=== RET_ TABLES ===\n";
$ret = Core\Database::fetchAll("SHOW TABLES LIKE 'ret_%'");
foreach ($ret as $row) {
    $tbl = array_values($row)[0];
    $cnt = Core\Database::fetchOne("SELECT COUNT(*) as c FROM `$tbl`")['c'] ?? 0;
    echo "$tbl: $cnt rows\n";
}
