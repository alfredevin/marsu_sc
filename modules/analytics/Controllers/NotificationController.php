<?php
namespace Modules\Analytics\Controllers;

use Core\Auth;
use Core\Database;
use Core\View;

/**
 * In-app notifications for the signed-in user only.
 */
class NotificationController
{
    public function index(): void
    {
        $rows = Database::fetchAll(
            "SELECT * FROM `ana_notifications` WHERE user_id = :uid ORDER BY id DESC LIMIT 100",
            ['uid' => (int) Auth::id()]
        );
        View::render('analytics/Views/notifications', [
            'rows'   => $rows,
            'title'  => 'Notifications',
            'crumbs' => ['Academic Analytics' => url('analytics'), 'Notifications' => ''],
        ]);
    }

    public function read(string $id): void
    {
        $row = Database::fetchOne(
            "SELECT * FROM `ana_notifications` WHERE id = :id AND user_id = :uid",
            ['id' => (int) $id, 'uid' => (int) Auth::id()]
        );
        if (!$row) {
            redirect(url('analytics/notifications'));
        }
        if ($row['read_at'] === null) {
            Database::update('ana_notifications', ['read_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => (int) $row['id']]);
        }
        $link = (string) ($row['link'] ?? '');
        if (preg_match('#^analytics(/[A-Za-z0-9_\-/]*)?$#', $link)) {
            redirect(url($link));
        }
        redirect(url('analytics/notifications'));
    }

    public function readAll(): void
    {
        Database::query(
            "UPDATE `ana_notifications` SET read_at = NOW() WHERE user_id = :uid AND read_at IS NULL",
            ['uid' => (int) Auth::id()]
        );
        redirect(url('analytics/notifications'), 'success', 'All notifications marked as read.');
    }
}
