<?php
namespace Core;

use Exception;

/**
 * MarSU Centralized ERP - Audit Logging & Application Logger
 */
class Logger {
    public static function audit(string $action, string $entity, ?int $entityId = null, array $details = []): void {
        try {
            $userId = Auth::id();
            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            $ua = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';

            Database::insert('audit_logs', [
                'user_id'    => $userId,
                'action'     => $action,
                'entity'     => $entity,
                'entity_id'  => $entityId,
                'ip_address' => substr($ip, 0, 45),
                'user_agent' => substr($ua, 0, 255),
                'details'    => !empty($details) ? json_encode($details, JSON_UNESCAPED_UNICODE) : null,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
            // Fall back to file logging if DB is unavailable
            self::logToFile('AUDIT_ERROR', $e->getMessage() . ' Action: ' . $action);
        }
    }

    public static function info(string $message, array $context = []): void {
        self::logToFile('INFO', $message, $context);
    }

    public static function error(string $message, array $context = []): void {
        self::logToFile('ERROR', $message, $context);
    }

    private static function logToFile(string $level, string $message, array $context = []): void {
        $logDir = dirname(__DIR__) . '/storage/logs';
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0755, true);
        }
        $logFile = $logDir . '/app.log';
        $timestamp = date('Y-m-d H:i:s');
        $contextStr = !empty($context) ? ' ' . json_encode($context) : '';
        $entry = "[{$timestamp}] [{$level}] {$message}{$contextStr}\n";
        @file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);
    }
}
