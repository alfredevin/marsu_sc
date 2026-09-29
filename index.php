<?php
/**
 * MarSU Centralized ERP - Root Front-Controller Gateway
 * Forwards requests to public/index.php if document root is set to workspace root.
 */

// If installer is needed and not locked, redirect
if (!file_exists(__DIR__ . '/storage/installed.lock') && file_exists(__DIR__ . '/install.php')) {
    header('Location: install.php');
    exit;
}

require_once __DIR__ . '/public/index.php';
