<?php
$backupFiles = explode("\n", trim(shell_exec('git ls-tree -r --name-only backup/group8a-work modules/retention')));
$anaFiles = explode("\n", trim(shell_exec('git ls-files modules/analytics')));

$backupRel = array_map(function($f) {
    return str_replace(['modules/retention/', 'Retention', 'retention'], ['', 'Analytics', 'analytics'], $f);
}, $backupFiles);

$anaRel = array_map(function($f) {
    return str_replace('modules/analytics/', '', $f);
}, $anaFiles);

echo "--- In backup/group8a-work (retention) but NOT in analytics ---\n";
foreach ($backupRel as $i => $b) {
    // Check ignoring migration timestamps
    $found = false;
    foreach ($anaRel as $a) {
        $cleanB = preg_replace('/\d{4}_\d{2}_\d{2}_\d{6}_/', '', $b);
        $cleanA = preg_replace('/\d{4}_\d{2}_\d{2}_\d{6}_/', '', $a);
        if ($cleanB === $cleanA) {
            $found = true;
            break;
        }
    }
    if (!$found) {
        echo "MISSING: " . $backupFiles[$i] . " (expected: $b)\n";
    }
}

echo "\n--- In analytics but NOT in backup/group8a-work ---\n";
foreach ($anaRel as $i => $a) {
    $found = false;
    foreach ($backupRel as $b) {
        $cleanB = preg_replace('/\d{4}_\d{2}_\d{2}_\d{6}_/', '', $b);
        $cleanA = preg_replace('/\d{4}_\d{2}_\d{2}_\d{6}_/', '', $a);
        if ($cleanB === $cleanA) {
            $found = true;
            break;
        }
    }
    if (!$found) {
        echo "EXTRA IN ANA: " . $anaFiles[$i] . "\n";
    }
}
