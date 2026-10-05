<?php
namespace Modules\Retention\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Student Retention & Academic Risk Early Warning System
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `ret_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('retention/Views/index', [
            'title'       => 'Student Retention & Academic Risk Early Warning System',
            'moduleName'  => 'Student Retention & Academic Risk Early Warning System',
            'slug'        => 'retention',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Academic Analytics' => '',
                'Student Retention & Academic Risk Early Warning System' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `ret_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('retention'));
        }

        View::render('retention/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'Student Retention & Academic Risk Early Warning System',
            'slug'        => 'retention',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['Student Retention & Academic Risk Early Warning System' => url('retention'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('retention'));
        }

        try {
            Database::insert('ret_records', [
                'title'       => $title,
                'description' => $description,
                'status'      => 'active',
                'created_by'  => Auth::id(),
                'created_at'  => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'New record added successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save record: ' . $e->getMessage());
        }

        redirect(url('retention'));
    }
    public function profile(): void {
        $user = Auth::user();
        View::render('retention/Views/profile', [
            'title'       => 'Student Profile',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Student Information Management'           => '',
                'Occupancy Report'  => ''
            ]
        ]);
    }
    public function academichistory (): void {
        $user = Auth::user();
        View::render('retention/Views/academichistory', [
            'title'       => 'Academic History',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Student Information Management'           => '',
                'Academic History'  => ''
            ]
        ]);
    }
    public function enrollmentrecords (): void {
        $user = Auth::user();
        View::render('retention/Views/enrollmentrecords', [
            'title'       => 'Enrollment Records',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Student Information Management'           => '',
                'Enrollment Records'  => ''
            ]
        ]);
    }
    public function demographicinfo (): void {
        $user = Auth::user();
        View::render('retention/Views/demographicinfo', [
            'title'       => 'Demographic Info',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Student Information Management'           => '',
                'Demographic Info'  => ''
            ]
        ]);
    }
    public function gradestracking (): void {
        $user = Auth::user();
        View::render('retention/Views/gradestracking', [
            'title'       => 'Grades Tracking',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring'           => '',
                'Grades Tracking'  => ''
            ]
        ]);
    }
    public function subjectperformance (): void {
        $user = Auth::user();
        View::render('retention/Views/subjectperformance', [
            'title'       => 'Subject Performance',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring'           => '',
                'Subject Performance'  => ''
            ]
        ]);
    }
    public function progressreports (): void {
        $user = Auth::user();
        View::render('retention/Views/progressreports', [
            'title'       => 'Progress Reports',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring'           => '',
                'Progress Reports'  => ''
            ]
        ]);
    }
    public function failedincompletemonitoring (): void {
        $user = Auth::user();
        View::render('retention/Views/failedincompletemonitoring', [
            'title'       => 'Failed Incomplete Monitoring',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring'           => '',
                'Failed Incomplete Monitoring'  => ''
            ]
        ]);
    }
    public function attendancerecords (): void {
        $user = Auth::user();
        View::render('retention/Views/attendancerecords', [
            'title'       => 'Attendance Records',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring'           => '',
                'Attendance Records'  => ''
            ]
        ]);
    }
    public function participationtracking (): void {
        $user = Auth::user();
        View::render('retention/Views/participationtracking', [
            'title'       => 'Participation Tracking',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring'           => '',
                'Participation Tracking'  => ''
            ]
        ]);
    }
    public function studentengagement (): void {
        $user = Auth::user();
        View::render('retention/Views/studentengagement', [
            'title'       => 'Student Engagement',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring'           => '',
                'Student Engagement'  => ''
            ]
        ]);
    }
    public function behaviorrecords (): void {
        $user = Auth::user();
        View::render('retention/Views/behaviorrecords', [
            'title'       => 'Behavior Records',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring'           => '',
                'Behavioral Records'  => ''
            ]
        ]);
    }
    public function atriskstudents (): void {
        $user = Auth::user();
        View::render('retention/Views/atriskstudents', [
            'title'       => 'At-Risk Students',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Early Warning System'           => '',
                'At-Risk Students'  => ''
            ]
        ]);
    }
    public function risklevelclassification (): void {
        $user = Auth::user();
        View::render('retention/Views/risklevelclassification', [
            'title'       => 'Risk Level Classification',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Risk Management'           => '',
                'Risk Level Classification'  => ''
            ]
        ]);
    }
    public function systemalerts (): void {
        $user = Auth::user();
        View::render('retention/Views/systemalerts', [
            'title'       => 'System Alerts',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Alerts and Notifications'           => '',
                'System Alerts'  => ''
            ]
        ]);
    }
    public function riskoverview (): void {
        $user = Auth::user();
        View::render('retention/Views/riskoverview', [
            'title'       => 'Risk Overview',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Risk Management'           => '',
                'Risk Overview'  => ''
            ]
        ]);
    }
    public function advisingrecords (): void {
        $user = Auth::user();
        View::render('retention/Views/advisingrecords', [
            'title'       => 'Advising Records',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Intervention Management'           => '',
                'Advising Records'  => ''
            ]
        ]);
    }
    public function guidancereferrals (): void {
        $user = Auth::user();
        View::render('retention/Views/guidancereferrals', [
            'title'       => 'Guidance Referrals',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Intervention Management'           => '',
                'Guidance Referrals'  => ''
            ]
        ]);
    }
    public function academicsupportprograms (): void {
        $user = Auth::user();
        View::render('retention/Views/academicsupportprograms', [
            'title'       => 'Academic Support Programs',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Intervention Management'           => '',
                'Academic Support Programs'  => ''
            ]
        ]);
    }
    public function interventionresults (): void {
        $user = Auth::user();
        View::render('retention/Views/interventionresults', [
            'title'       => 'Intervention Results',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Intervention Management'           => '',
                'Intervention Results'  => ''
            ]
        ]);
    }
    public function retentionratereports (): void {
        $user = Auth::user();
        View::render('retention/Views/retentionratereports', [
            'title'       => 'Retention Rate Reports',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Reports and Analytics'           => '',
                'Retention Rate Reports'  => ''
            ]
        ]);
    }
    public function atriskstudentreports (): void {
        $user = Auth::user();
        View::render('retention/Views/atriskstudentreports', [
            'title'       => 'At-Risk Student Reports',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Reports and Analytics'           => '',
                'At-Risk Student Reports'  => ''
            ]
        ]);
    }
    public function studentsuccessreports (): void {
        $user = Auth::user();
        View::render('retention/Views/studentsuccessreports', [
            'title'       => 'Student Success Reports',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Reports and Analytics'           => '',
                'Student Success Reports'  => ''
            ]
        ]);
    }
    public function trendsovertime (): void {
        $user = Auth::user();
        View::render('retention/Views/trendsovertime', [
            'title'       => 'Trends Over Time',
            'moduleName'  => 'Retention (ISREMS)',
            'slug'        => 'retention',
            'user'        => $user,
            'crumbs'      => [
                'Retention (ISREMS)' => url('retention'),
                'Reports and Analytics'           => '',
                'Trends Over Time'  => ''
            ]
        ]);
    }
}
