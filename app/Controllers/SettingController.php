<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use Core\Logger;
use App\Models\Setting;
use App\Models\AcademicYear;
use App\Models\Semester;

class SettingController {
    public function index(): void {
        $academicYears = AcademicYear::all();
        $semesters = Semester::all();

        View::render('settings/index', [
            'title'         => 'System Settings & Branding',
            'academicYears' => $academicYears,
            'semesters'     => $semesters,
            'crumbs'        => ['Administration' => '', 'Settings' => '']
        ]);
    }

    public function update(): void {
        $allowed = [
            'system_name', 'university_name', 'college_name', 'tagline', 
            'school_address', 'active_academic_year', 'active_semester', 'theme_accent'
        ];

        foreach ($allowed as $key) {
            if (isset($_POST[$key])) {
                Setting::set($key, trim($_POST[$key]));
            }
        }

        // Handle optional logo upload
        if (isset($_FILES['system_logo']) && $_FILES['system_logo']['error'] === UPLOAD_ERR_OK) {
            $tmp = $_FILES['system_logo']['tmp_name'];
            $ext = strtolower(pathinfo($_FILES['system_logo']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['png', 'jpg', 'jpeg', 'svg'], true)) {
                $target = dirname(__DIR__, 2) . '/public/assets/img/custom_logo.' . $ext;
                if (move_uploaded_file($tmp, $target)) {
                    Setting::set('system_logo', 'public/assets/img/custom_logo.' . $ext);
                }
            }
        }

        Logger::audit('settings.update', 'settings', null, []);
        Session::flash('success', 'System settings and branding tokens updated successfully.');
        redirect(url('settings'));
    }
}
