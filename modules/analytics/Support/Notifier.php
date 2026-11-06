<?php
namespace Modules\Analytics\Support;

use Core\Database;

/**
 * In-app notifications stored in `ana_notifications`.
 */
class Notifier
{
    public static function user(?int $userId, string $title, ?string $body = null, ?string $link = null): void
    {
        if (!$userId) {
            return;
        }
        Database::insert('ana_notifications', [
            'user_id'    => $userId,
            'title'      => mb_substr($title, 0, 191),
            'body'       => $body,
            'link'       => $link,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public static function student(int $studentId, string $title, ?string $body = null, ?string $link = null): void
    {
        $userId = Database::fetchColumn("SELECT user_id FROM `students` WHERE id = :id", ['id' => $studentId]);
        self::user($userId ? (int) $userId : null, $title, $body, $link);
    }

    /**
     * Notify every rostered (enrolled) student of a class who has a login account.
     */
    public static function classStudents(int $classId, string $title, ?string $body = null, ?string $link = null): int
    {
        $rows = Database::fetchAll(
            "SELECT DISTINCT s.user_id
             FROM `ana_class_students` cs
             JOIN `students` s ON s.id = cs.student_id
             WHERE cs.class_id = :cid AND cs.status = 'enrolled' AND s.user_id IS NOT NULL AND s.deleted_at IS NULL",
            ['cid' => $classId]
        );
        foreach ($rows as $r) {
            self::user((int) $r['user_id'], $title, $body, $link);
        }
        return count($rows);
    }

    public static function unreadCount(int $userId): int
    {
        return (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM `ana_notifications` WHERE user_id = :uid AND read_at IS NULL",
            ['uid' => $userId]
        );
    }
}
