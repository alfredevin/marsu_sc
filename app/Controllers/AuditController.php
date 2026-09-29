<?php
namespace App\Controllers;

use Core\View;
use App\Models\AuditLog;

class AuditController {
    public function index(): void {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $search = trim($_GET['q'] ?? '');
        $actionFilter = trim($_GET['action'] ?? '');

        $result = AuditLog::paginate($page, 20, $search, $actionFilter);

        View::render('audit/index', [
            'title'        => 'System Audit Trail',
            'logs'         => $result['data'],
            'pagination'   => $result,
            'search'       => $search,
            'actionFilter' => $actionFilter,
            'crumbs'       => ['Administration' => '', 'Audit Trail' => '']
        ]);
    }
}
