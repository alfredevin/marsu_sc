<?php
namespace Modules\Irimkms\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Institutional Repository & Knowledge Management (IRIMKMS)
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `kmp_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('irimkms/Views/index', [
            'title'       => 'Institutional Repository & Knowledge Management (IRIMKMS)',
            'moduleName'  => 'Institutional Repository & Knowledge Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Research & Innovation' => '',
                'Institutional Repository & Knowledge Management (IRIMKMS)' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `kmp_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('irimkms'));
        }

        View::render('irimkms/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'Institutional Repository & Knowledge Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['Institutional Repository & Knowledge Management (IRIMKMS)' => url('irimkms'), 'View' => '']
        ]);
    }


    public function proposalsandapprovals(): void {
        $user = Auth::user();
        View::render('irimkms/Views/proposalsandapprovals', [
            'title'       => 'Proposals & Approvals',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Research Management' => '',
                'Proposals & Approvals' => ''
            ]
        ]);
    }

   
    public function researchprofiles(): void {
        $user = Auth::user();
        View::render('irimkms/Views/researchprofiles', [
            'title'       => 'Research Profiles',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Research Management' => '',
                'Research Profiles' => ''
            ]
        ]);
    }


    public function researchprojects(): void {
        $user = Auth::user();
        View::render('irimkms/Views/researchprojects', [
            'title'       => 'Research Projects',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Research Management' => '',
                'Research Projects' => ''
            ]
        ]);
    }


    public function fundingandresources(): void {
        $user = Auth::user();
        View::render('irimkms/Views/fundingandresources', [
            'title'       => 'Funding & Resources',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Research Management' => '',
                'Funding & Resources' => ''
            ]
        ]);
    }


    public function projectmilestone(): void {
        $user = Auth::user();
        View::render('irimkms/Views/projectmilestone', [
            'title'       => 'Project Milestone',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Monitoring & Evaluation' => '',
                'Project Milestone' => ''
            ]
        ]);
    }


    public function implementationprogress(): void {
        $user = Auth::user();
        View::render('irimkms/Views/implementationprogress', [
            'title'       => 'Implementation Progress',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Monitoring & Evaluation' => '',
                'Implementation Progress' => ''
            ]
        ]);
    }


    public function evaluationforms(): void {
        $user = Auth::user();
        View::render('irimkms/Views/evaluationforms', [
            'title'       => 'Evaluation Forms & Assessment Tools',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Monitoring & Evaluation' => '',
                'Evaluation Forms & Assessment Tools' => ''
            ]
        ]);
    }


    public function performanceindicators(): void {
        $user = Auth::user();
        View::render('irimkms/Views/performanceindicators', [
            'title'       => 'Performance Indicators & Analytics',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Monitoring & Evaluation' => '',
                'Performance Indicators & Analytics' => ''
            ]
        ]);
    }


    public function completionreporting(): void {
        $user = Auth::user();
        View::render('irimkms/Views/completionreporting', [
            'title'       => 'Completion & Accomplishment Reporting',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Monitoring & Evaluation' => '',
                'Completion & Accomplishment Reporting' => ''
            ]
        ]);
    }


    public function researchstorage(): void {
        $user = Auth::user();
        View::render('irimkms/Views/researchstorage', [
            'title'       => 'Digital Research Storage',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Repository & Knowledge Management (IRIMKMS)' => '',
                'Digital Research Storage' => ''
            ]
        ]);
    }


    public function filemanagement(): void {
        $user = Auth::user();
        View::render('irimkms/Views/filemanagement', [
            'title'       => 'File Management',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Repository & Knowledge Management (IRIMKMS)' => '',
                'File Management' => ''
            ]
        ]);
    }


    public function knowledgemanagement(): void {
        $user = Auth::user();
        View::render('irimkms/Views/knowledgemanagement', [
            'title'       => 'Knowledge Management & Library',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Repository & Knowledge Management (IRIMKMS)' => '',
                'Knowledge Management & Library' => ''
            ]
        ]);
    }


    public function searchableresearch(): void {
        $user = Auth::user();
        View::render('irimkms/Views/searchableresearch', [
            'title'       => 'Searchable Research',
            'moduleName'  => 'Research Management (IRIMKMS)',
            'slug'        => 'irimkms',
            'user'        => $user,
            'crumbs'      => [
                'Research Management (IRIMKMS)' => url('irimkms'),
                'Repository & Knowledge Management (IRIMKMS)' => '',
                'Searchable Research' => ''
            ]
        ]);
    }
    
    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('irimkms'));
        }

        try {
            Database::insert('kmp_records', [
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

        redirect(url('irimkms'));
    }
}
    