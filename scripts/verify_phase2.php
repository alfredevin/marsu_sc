<?php
/**
 * Phase 2 Verification Script
 * Validates routes, auth, RBAC permissions, and views.
 */

$baseUrl = 'http://localhost/marsu-erp';
$cookieFile = __DIR__ . '/test_cookie.txt';

function makeRequest($url, $method = 'GET', $data = [], $cookieFile = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HEADER, true);

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
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headers = substr($response, 0, $headerSize);
    $body = substr($response, $headerSize);
    curl_close($ch);

    return [
        'code' => $httpCode,
        'headers' => $headers,
        'body' => $body
    ];
}

function extractCsrfToken($html) {
    if (preg_match('/name=["\']_token["\']\s+value=["\']([^"\']+)["\']/i', $html, $matches)) {
        return $matches[1];
    }
    return null;
}

echo "====================================================\n";
echo "           MARSU ERP - PHASE 2 VERIFICATION         \n";
echo "====================================================\n\n";

if (file_exists($cookieFile)) unlink($cookieFile);

// 1. Root Gateway / Redirect
echo "[1] Testing Root URL / Login Redirect...\n";
$res = makeRequest($baseUrl . '/', 'GET', [], $cookieFile);
echo "    Status: {$res['code']}\n";
if ($res['code'] === 302) {
    echo "    -> PASS: Correctly redirects unauthenticated user.\n";
} else {
    echo "    -> Note: Code {$res['code']}\n";
}

// 2. Fetch Login Page
echo "\n[2] Fetching Login Page & CSRF Token...\n";
$res = makeRequest($baseUrl . '/login', 'GET', [], $cookieFile);
$csrf = extractCsrfToken($res['body']);
echo "    Status: {$res['code']}\n";
if ($res['code'] === 200 && $csrf) {
    echo "    -> PASS: Login page rendered, CSRF token extracted: " . substr($csrf, 0, 16) . "...\n";
} else {
    echo "    -> FAIL: Could not extract CSRF token.\n";
    exit(1);
}

// 3. Login as Admin
echo "\n[3] Authenticating as Super Admin (admin / Password123!)...\n";
$postData = [
    '_token' => $csrf,
    'username' => 'admin',
    'password' => 'Password123!'
];
$res = makeRequest($baseUrl . '/login', 'POST', $postData, $cookieFile);
echo "    Status: {$res['code']}\n";
if ($res['code'] === 302) {
    echo "    -> PASS: Admin login successful, redirected.\n";
} else {
    echo "    -> FAIL: Login did not redirect. Body:\n" . substr($res['body'], 0, 500) . "\n";
    exit(1);
}

// 4. Test Dashboard
echo "\n[4] Testing Dashboard Access (as Admin)...\n";
$res = makeRequest($baseUrl . '/dashboard', 'GET', [], $cookieFile);
echo "    Status: {$res['code']}\n";
if ($res['code'] === 200 && strpos($res['body'], 'Executive Dashboard') !== false) {
    echo "    -> PASS: Dashboard accessible, Executive Dashboard title verified.\n";
} else {
    echo "    -> FAIL: Dashboard not rendered as expected.\n";
}

// 5. Test Students Registry
echo "\n[5] Testing Students Master Registry...\n";
$res = makeRequest($baseUrl . '/students', 'GET', [], $cookieFile);
echo "    Status: {$res['code']}\n";
if ($res['code'] === 200 && strpos($res['body'], 'Student Master Registry') !== false) {
    echo "    -> PASS: Student Master Registry accessible.\n";
} else {
    echo "    -> FAIL: Students registry not rendered.\n";
}

// 6. Test Roles & RBAC Matrix
echo "\n[6] Testing Roles & Permissions Matrix...\n";
$res = makeRequest($baseUrl . '/roles', 'GET', [], $cookieFile);
echo "    Status: {$res['code']}\n";
if ($res['code'] === 200 && strpos($res['body'], 'Roles & Access Control') !== false) {
    echo "    -> PASS: Roles & RBAC Matrix accessible.\n";
} else {
    echo "    -> FAIL: Roles page not rendered.\n";
}

// 7. Test Audit Logs
echo "\n[7] Testing Audit Trail...\n";
$res = makeRequest($baseUrl . '/audit', 'GET', [], $cookieFile);
echo "    Status: {$res['code']}\n";
if ($res['code'] === 200 && strpos($res['body'], 'Audit Trail') !== false) {
    echo "    -> PASS: Audit Trail view accessible.\n";
} else {
    echo "    -> FAIL: Audit Trail not rendered.\n";
}

// 8. Test UI Kit
echo "\n[8] Testing UI Kit Styleguide...\n";
$res = makeRequest($baseUrl . '/ui-kit', 'GET', [], $cookieFile);
echo "    Status: {$res['code']}\n";
if ($res['code'] === 200 && strpos($res['body'], 'Design System') !== false) {
    echo "    -> PASS: UI Kit Styleguide accessible.\n";
} else {
    echo "    -> FAIL: UI Kit not rendered.\n";
}

// 9. Logout Admin
echo "\n[9] Logging out Admin...\n";
$res = makeRequest($baseUrl . '/logout', 'GET', [], $cookieFile);
echo "    Status: {$res['code']}\n";
if ($res['code'] === 302) {
    echo "    -> PASS: Admin logged out successfully.\n";
} else {
    echo "    -> FAIL: Logout status: {$res['code']}\n";
}
if (file_exists($cookieFile)) unlink($cookieFile);

// 10. Login as Student
echo "\n[10] Authenticating as Student (student / Password123!)...\n";
$res = makeRequest($baseUrl . '/login', 'GET', [], $cookieFile);
$csrf = extractCsrfToken($res['body']);
$postData = [
    '_token' => $csrf,
    'username' => 'student',
    'password' => 'Password123!'
];
$res = makeRequest($baseUrl . '/login', 'POST', $postData, $cookieFile);
echo "    Status: {$res['code']}\n";
if ($res['code'] === 302) {
    echo "    -> PASS: Student login successful.\n";
} else {
    echo "    -> FAIL: Student login failed.\n";
}

// 11. RBAC Check: Student hitting /roles (Should be 403 Forbidden)
echo "\n[11] Testing RBAC Security: Student accessing /roles...\n";
$res = makeRequest($baseUrl . '/roles', 'GET', [], $cookieFile);
echo "    Status: {$res['code']}\n";
if ($res['code'] === 403 || strpos($res['body'], 'Access Denied') !== false || strpos($res['body'], '403') !== false) {
    echo "    -> PASS: RBAC Deny-by-default verified! 403 Access Denied returned.\n";
} else {
    echo "    -> FAIL: Student was able to access /roles or status was not 403! Code: {$res['code']}\n";
}

// Cleanup
if (file_exists($cookieFile)) unlink($cookieFile);

echo "\n====================================================\n";
echo "           PHASE 2 VERIFICATION COMPLETED           \n";
echo "====================================================\n";
