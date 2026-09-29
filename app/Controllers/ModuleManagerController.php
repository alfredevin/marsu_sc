<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use Core\Logger;
use Core\ModuleLoader;

class ModuleManagerController {
    public function index(): void {
        $modules = ModuleLoader::discover();

        View::render('modules/index', [
            'title'   => 'Module Manager',
            'modules' => $modules,
            'crumbs'  => ['Administration' => '', 'Modules' => '']
        ]);
    }

    public function toggle(): void {
        $slug = strtolower(trim($_POST['slug'] ?? ''));
        $enabled = (bool)($_POST['enabled'] ?? false);

        ModuleLoader::setModuleEnabled($slug, $enabled);

        Logger::audit('module.toggle_state', 'modules', null, ['slug' => $slug, 'enabled' => $enabled]);
        Session::flash('success', "Module '{$slug}' status updated to " . ($enabled ? 'Enabled' : 'Disabled') . ".");
        redirect(url('modules'));
    }
}
