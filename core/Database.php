<?php
namespace Core;

use PDO;
use PDOException;
use PDOStatement;

/**
 * MarSU Centralized ERP - High-Performance Database Engine (PDO)
 * Prepared statements only. UTF-8mb4 unicode compliant.
 */
class Database {
    private static ?Database $instance = null;
    private ?PDO $pdo = null;

    private function __construct() {
        self::loadEnv();

        $host     = $_ENV['DB_HOST'] ?? 'localhost';
        $port     = $_ENV['DB_PORT'] ?? '3306';
        $dbname   = $_ENV['DB_DATABASE'] ?? 'marsu_erp';
        $username = $_ENV['DB_USERNAME'] ?? 'root';
        $password = $_ENV['DB_PASSWORD'] ?? '';

        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
        ];

        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            // If connection failed, check if install.php exists and DB might not exist yet
            throw new PDOException("Database connection error: " . $e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function pdo(): PDO {
        return self::getInstance()->getConnection();
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }

    public static function query(string $sql, array $params = []): PDOStatement {
        $stmt = self::pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function fetchAll(string $sql, array $params = []): array {
        return self::query($sql, $params)->fetchAll();
    }

    public static function fetchOne(string $sql, array $params = []): ?array {
        $result = self::query($sql, $params)->fetch();
        return $result ?: null;
    }

    public static function fetchColumn(string $sql, array $params = [], int $col = 0) {
        return self::query($sql, $params)->fetchColumn($col);
    }

    public static function insert(string $table, array $data): int {
        $fields = array_keys($data);
        $placeholders = array_map(fn($f) => ":{$f}", $fields);

        $sql = "INSERT INTO `{$table}` (`" . implode('`, `', $fields) . "`) VALUES (" . implode(', ', $placeholders) . ")";
        self::query($sql, $data);
        return (int)self::pdo()->lastInsertId();
    }

    public static function update(string $table, array $data, string $where, array $whereParams = []): int {
        $setClauses = [];
        $params = [];

        foreach ($data as $field => $value) {
            $paramName = "set_" . $field;
            $setClauses[] = "`{$field}` = :{$paramName}";
            $params[$paramName] = $value;
        }

        $params = array_merge($params, $whereParams);
        $sql = "UPDATE `{$table}` SET " . implode(', ', $setClauses) . " WHERE {$where}";
        $stmt = self::query($sql, $params);
        return $stmt->rowCount();
    }

    public static function delete(string $table, string $where, array $whereParams = []): int {
        $sql = "DELETE FROM `{$table}` WHERE {$where}";
        $stmt = self::query($sql, $whereParams);
        return $stmt->rowCount();
    }

    public static function beginTransaction(): bool {
        return self::pdo()->beginTransaction();
    }

    public static function commit(): bool {
        return self::pdo()->commit();
    }

    public static function rollBack(): bool {
        return self::pdo()->rollBack();
    }

    /**
     * Parse root .env file if available
     */
    public static function loadEnv(?string $filePath = null): void {
        $path = $filePath ?? dirname(__DIR__) . '/.env';
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || str_starts_with($line, '#')) {
                continue;
            }
            if (str_contains($line, '=')) {
                [$key, $val] = explode('=', $line, 2);
                $key = trim($key);
                $val = trim($val);
                // Strip optional quotes
                if ((str_starts_with($val, '"') && str_ends_with($val, '"')) ||
                    (str_starts_with($val, "'") && str_ends_with($val, "'"))) {
                    $val = substr($val, 1, -1);
                }
                $_ENV[$key] = $val;
                putenv("{$key}={$val}");
            }
        }
    }
}
