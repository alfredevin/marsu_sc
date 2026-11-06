<?php

namespace Modules\Welfare\Controllers;

use Core\Database;
use Core\View;
use Core\Auth;

class AnnouncementController
{
    /**
     * Advisories & Announcements Management
     */
    public function index(): void
    {
        $user = Auth::user();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'store';

            if ($action === 'archive') {
                $id = (int)($_POST['id'] ?? 0);
                if ($id > 0) {
                    Database::update('wlf_advisories', [
                        'status' => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    flash('success', 'Advisory archived successfully.');
                }
                header('Location: ' . url('welfare/advisories'));
                exit;
            }

            $title = trim($_POST['title'] ?? '');
            $targetAudience = trim($_POST['target_audience'] ?? 'All Students');
            $content = trim($_POST['content'] ?? '');
            $publishDate = !empty($_POST['publish_date']) ? $_POST['publish_date'] : date('Y-m-d');
            $status = trim($_POST['status'] ?? 'published');

            if (!empty($title) && !empty($content)) {
                Database::insert('wlf_advisories', [
                    'title' => $title,
                    'target_audience' => $targetAudience,
                    'content' => $content,
                    'publish_date' => $publishDate,
                    'expiry_date' => !empty($_POST['expiry_date']) ? $_POST['expiry_date'] : null,
                    'status' => $status,
                    'created_by' => Auth::id() ?? null,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                flash('success', 'Advisory announcement published successfully.');
            } else {
                flash('error', 'Title and content are required.');
            }

            header('Location: ' . url('welfare/advisories'));
            exit;
        }

        $advisories = Database::fetchAll("
            SELECT * FROM wlf_advisories
            WHERE deleted_at IS NULL
            ORDER BY publish_date DESC, id DESC
        ");

        View::render('welfare/Views/advisories', [
            'title' => 'Advisories & Announcements',
            'slug' => 'welfare',
            'user' => $user,
            'advisories' => $advisories
        ]);
    }
}
