<?php

namespace Modules\Housing\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

class announcementcontroller
{
   public function announcements(): void
    {
        $user = Auth::user();

        $announcements = Database::fetchAll("SELECT * FROM `hsg_announcements` ORDER BY pinned DESC, id DESC");

        View::render('housing/Views/announcements', [
            'title'         => 'Housing Bulletins & Announcements',
            'slug'          => 'housing',
            'user'          => $user,
            'announcements' => $announcements
        ]);
    }

    public function storeAnnouncement(): void
    {
        $title   = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        Database::insert('hsg_announcements', [
            'title'           => $title,
            'category'        => $_POST['category'] ?? 'General Notice',
            'priority'        => $_POST['priority'] ?? 'Normal',
            'content'         => $content,
            'target_audience' => trim($_POST['target_audience'] ?? 'All Residents'),
            'published_by'    => Auth::user()['first_name'] ?? 'Housing Admin',
            'status'          => 'Published',
            'pinned'          => !empty($_POST['pinned']) ? 1 : 0,
            'created_at'      => date('Y-m-d H:i:s')
        ]);

        redirect(url('housing/announcements'), 'success', 'Announcement published successfully!');
    }

     public function deleteAnnouncement(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            Database::delete('hsg_announcements', 'id = :id', ['id' => $id]);
            redirect(url('housing/announcements'), 'success', 'Announcement deleted successfully.');
        }
        redirect(url('housing/announcements'), 'error', 'Invalid announcement record.');
    }

}
