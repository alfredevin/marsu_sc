<?php
namespace Modules\Assets\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for University Equipment & IT Asset Management
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `ast_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('assets/Views/index', [
            'title'       => 'University Equipment & IT Asset Management',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Campus Operations' => '',
                'University Equipment & IT Asset Management' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `ast_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('assets'));
        }

        View::render('assets/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['University Equipment & IT Asset Management' => url('assets'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('assets'));
        }

        try {
            Database::insert('ast_records', [
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

        redirect(url('assets'));
    }

    public function assetprofilecreation(): void {
        $user = Auth::user();
        View::render('assets/Views/assetprofilecreation', [
            'title'       => 'Asset Profile Creation',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Asset Profile Creation'           => ''
            ]
        ]);
    }
    public function propertyidentificationnumbers (): void {
        $user = Auth::user();
        View::render('assets/Views/propertyidentificationnumbers', [
            'title'       => 'Property Identification Numbers',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Property Identification Numbers'           => ''
            ]
        ]);
    }
    public function AssetClassification (): void {
        $user = Auth::user();
        View::render('assets/Views/AssetClassification', [
            'title'       => 'Asset Classification',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Asset Classification'           => ''
            ]
        ]);
    }
    public function AcquisitionDetails (): void {
        $user = Auth::user();
        View::render('assets/Views/AcquisitionDetails', [
            'title'       => 'Acquisition Details',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Acquisition Details'           => ''
            ]
        ]);
    }
    public function OwnershipAccountabilityRecords (): void {
        $user = Auth::user();
        View::render('assets/Views/OwnershipAccountabilityRecords', [
            'title'       => 'Ownership Accountability Records',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Ownership Accountability Records'           => ''
            ]
        ]);
    }
    public function SupplyAndEquipmentInventory (): void {
        $user = Auth::user();
        View::render('assets/Views/SupplyAndEquipmentInventory', [
            'title'       => 'SupplyAndEquipmentInventory',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'SupplyAndEquipmentInventory'           => ''
            ]
        ]);
    }
    public function StockMonitoring (): void {
        $user = Auth::user();
        View::render('assets/Views/StockMonitoring', [
            'title'       => 'StockMonitoring',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'StockMonitoring'           => ''
            ]
        ]);
    }
    public function InsuanceAndReturnTracking(): void {
        $user = Auth::user();
        View::render('assets/Views/InsuanceAndReturnTracking', [
            'title'       => 'InsuanceAndReturnTracking',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'InsuanceAndReturnTracking'           => ''
            ]
        ]);
    }
    public function ReorderLevelAlerts(): void {
        $user = Auth::user();
        View::render('assets/Views/ReorderLevelAlerts', [
            'title'       => 'ReorderLevelAlerts',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'ReorderLevelAlerts'           => ''
            ]
        ]);
    }
    public function InventoryHistory(): void {
        $user = Auth::user();
        View::render('assets/Views/InventoryHistory', [
            'title'       => 'InventoryHistory',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'InventoryHistory'           => ''
            ]
        ]);
    }
    public function LocationMonitoring(): void {
        $user = Auth::user();
        View::render('assets/Views/LocationMonitoring', [
            'title'       => 'LocationMonitoring',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'LocationMonitoring'           => ''
            ]
        ]);
    }
    public function AssignedPersonnelUnitTracking(): void {
        $user = Auth::user();
        View::render('assets/Views/AssignedPersonnel', [
            'title'       => 'AssignedPersonnel',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'AssetDisposalAndReplacement'           => ''
            ]
        ]);
    }
}
