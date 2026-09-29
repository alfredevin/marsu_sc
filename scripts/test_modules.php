<?php
/**
 * Test All 11 Modules and Executive Dashboard Widgets
 */

$baseUrl = 'http://localhost/marsu-erp';
$cookieFile = __DIR__ . '/test_cookie.txt';

function makeRequest($url, $method = 'GET', $data = [], $cookieFile = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    if ($cookieFile) {
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    }

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [
        'code' => $httpCode,
        'body' => $response
    ];
}

if (file_exists($cookieFile)) unlink($cookieFile);

echo "=========================================================\n";
echo " TESTING 11 STUDENT MODULES & DASHBOARD WIDGETS\n";
echo "=========================================================\n";

// 1. Login as Admin
$res = makeRequest($baseUrl . '/login', 'GET', [], $cookieFile);
preg_match('/name=["\']_token["\']\s+value=["\']([^"\']+)["\']/i', $res['body'], $matches);
$csrf = $matches[1] ?? '';

$loginRes = makeRequest($baseUrl . '/login', 'POST', [
    '_token' => $csrf,
    'username' => 'admin',
    'password' => 'Password123!'
], $cookieFile);

echo "Admin login status: {$loginRes['code']}\n\n";

// 2. Test Executive Dashboard Widgets
$dashRes = makeRequest($baseUrl . '/dashboard', 'GET', [], $cookieFile);
echo "Dashboard Status: {$dashRes['code']}\n";

$modules = [
    'expense4ps'    => '4Ps Beneficiary',
    'irimkms'       => 'IRIMKMS',
    'workload'      => 'Teaching Workload',
    'health'        => 'Health',
    'orgfinance'    => 'Student Organizations',
    'orgleadership' => 'Student Leadership',
    'housing'       => 'Boarding House',
    'retention'     => 'Retention',
    'assets'        => 'Equipment',
    'welfare'       => 'Student Welfare',
    'guidance'      => 'Guidance'
];

$passCount = 0;
foreach ($modules as $slug => $label) {
    $res = makeRequest($baseUrl . '/' . $slug, 'GET', [], $cookieFile);
    $containsLabel = (strpos($res['body'], $label) !== false);
    if ($res['code'] === 200 && $containsLabel) {
        echo "  ✔ [{$slug}] Route /{$slug} -> HTTP 200 OK ('{$label}' verified)\n";
        $passCount++;
    } else {
        echo "  ❌ [{$slug}] Route /{$slug} -> Code {$res['code']}\n";
    }
}

echo "\nResult: {$passCount}/11 student group modules verified working successfully!\n";

// Check if dashboard renders module widgets
$widgetMatches = substr_count($dashRes['body'], 'card card-kpi');
echo "Dashboard Total KPI Cards rendered: {$widgetMatches}\n";

if (file_exists($cookieFile)) unlink($cookieFile);
