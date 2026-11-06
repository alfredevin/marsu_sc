<?php
$backupOutput = trim(shell_exec('git ls-tree -r --name-only backup/group8a-work modules/retention'));
$backupFiles = explode("\n", $backupOutput);

$anaOutput = trim(shell_exec('git ls-files modules/analytics'));
$anaFiles = explode("\n", $anaOutput);

$backupNames = array_map(function($f) {
    return trim(str_replace('modules/retention/', '', $f));
}, $backupFiles);

$anaNames = array_map(function($f) {
    return trim(str_replace('modules/analytics/', '', $f));
}, $anaFiles);

echo "Total in backup modules/retention: " . count($backupNames) . "\n";
echo "Total in modules/analytics: " . count($anaNames) . "\n\n";

echo "Files in backup retention but missing in analytics:\n";
foreach ($backupNames as $b) {
    $mapped = str_replace('Retention', 'Analytics', $b);
    $mapped = str_replace('retention', 'analytics', $mapped);
    if (!in_array($mapped, $anaNames) && !in_array($b, $anaNames)) {
        echo " - $b (mapped: $mapped)\n";
    }
}

echo "\nFiles in analytics but not in backup retention:\n";
foreach ($anaNames as $a) {
    $mapped = str_replace('Analytics', 'Retention', $a);
    $mapped = str_replace('analytics', 'retention', $mapped);
    if (!in_array($mapped, $backupNames) && !in_array($a, $backupNames)) {
        echo " - $a (mapped: $mapped)\n";
    }
}
