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
    public function assetclassification (): void {
        $user = Auth::user();
        View::render('assets/Views/assetclassification', [
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
    public function acquisitiondetails (): void {
        $user = Auth::user();
        View::render('assets/Views/acquisitiondetails', [
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
    public function ownershipaccountabilityrecords (): void {
        $user = Auth::user();
        View::render('assets/Views/ownershipaccountabilityrecords', [
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
    public function supplyandequipmentinventory (): void {
        $user = Auth::user();
        View::render('assets/Views/supplyandequipmentinventory', [
            'title'       => 'SupplyAndEquipmentInventory',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Supply And Equipment Inventory'           => ''
            ]
        ]);
    }
    public function stockmonitoring (): void {
        $user = Auth::user();
        View::render('assets/Views/stockmonitoring', [
            'title'       => 'StockMonitoring',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Stock Monitoring'           => ''
            ]
        ]);
    }
    public function insuanceandreturntracking(): void {
        $user = Auth::user();
        View::render('assets/Views/InsuanceAndReturnTracking', [
            'title'       => 'InsuanceAndReturnTracking',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Insuance And Return Tracking'           => ''
            ]
        ]);
    }
    public function reorderlevelalerts(): void {
        $user = Auth::user();
        View::render('assets/Views/reorderlevelalerts', [
            'title'       => 'Reorder Level Alerts',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Reorder Level Alerts'           => ''
            ]
        ]);
    }
    public function inventoryhistory(): void {
        $user = Auth::user();
        View::render('assets/Views/inventoryhistory', [
            'title'       => 'Inventory History',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Inventory History'           => ''
            ]
        ]);
    }
    public function locationmonitoring(): void {
        $user = Auth::user();
        View::render('assets/Views/locationmonitoring', [
            'title'       => 'Location Monitoring',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Location Monitoring'           => ''
            ]
        ]);
    }
    public function assignedpersonnelunitTracking(): void {
        $user = Auth::user();
        View::render('assets/Views/assignedpersonnelunittracking', [
            'title'       => 'Assigned Personnel Unit Tracking',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Assigned Personnel Unit Tracking'           => ''
            ]
        ]);
        
    }
    public function transferrecords(): void {
        $user = Auth::user();
        View::render('assets/Views/transferrecords', [
            'title'       => 'Transfer Records',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Transfer Records'           => ''
            ]
        ]);
        
    }
    public function disposalandretirementmanagement(): void {
        $user = Auth::user();
        View::render('assets/Views/disposalandretirementmanagement', [
            'title'       => 'Disposal And Retirement Management',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Disposal And Retirement Management'           => ''
            ]
        ]);  
    }
    public function buildingandroomrecords(): void {
        $user = Auth::user();
        View::render('assets/Views/buildingandroomrecords', [
            'title'       => 'Building And RoomRecords',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Building And Room Records'           => ''
            ]
        ]);  
    }
    public function facilityconditionmonitoring(): void {
        $user = Auth::user();
        View::render('assets/Views/facilityconditionmonitoring', [
            'title'       => 'FacilityConditionMonitoring',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Asset Disposal And Replacement'           => ''
            ]
        ]);  
    }
    public function maintenancescheduling(): void {
        $user = Auth::user();
        View::render('assets/Views/maintenancescheduling', [
            'title'       => 'Maintenance Scheduling',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Maintenance Scheduling'           => ''
            ]
        ]);  
    }
    public function repairrequest(): void {
        $user = Auth::user();
        View::render('assets/Views/repairrequest', [
            'title'       => 'Repair Request',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Repair Request'           => ''
            ]
        ]);  
    }
    public function servicehistory(): void {
        $user = Auth::user();
        View::render('assets/Views/repairrequest', [
            'title'       => 'Service History',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Service History'           => ''
            ]
        ]);  
    }
    public function workservicerequests(): void {
        $user = Auth::user();
        View::render('assets/Views/workservicerequests', [
            'title'       => 'Work Service Request',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Work Service Requests'           => ''
            ]
        ]);  
    }
    public function jobordertracking(): void {
        $user = Auth::user();
        View::render('assets/Views/jobordertracking', [
            'title'       => 'Job Order Tracking',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Job Order Tracking'           => ''
            ]
        ]);  
    }
    public function maintenancepersonnelassignment(): void {
        $user = Auth::user();
        View::render('assets/Views/maintenancepersonnelassignment', [
            'title'       => 'Maintenance Personnel Assignment',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Maintenance Personnel Assignment'           => ''
            ]
        ]);  
    }
    public function completionmonitoring(): void {
        $user = Auth::user();
        View::render('assets/Views/completionmonitoring', [
            'title'       => 'Completion Monitoring',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Completion Monitoring'           => ''
            ]
        ]);  
    }
    public function inventoryreports(): void {
        $user = Auth::user();
        View::render('assets/Views/inventoryreports', [
            'title'       => 'Inventory Reports',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Inventory Reports'           => ''
            ]
        ]);  
    }
    public function propertyaccountabilityreports(): void {
        $user = Auth::user();
        View::render('assets/Views/propertyaccountabilityreports', [
            'title'       => 'Property Accountability Reports',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Property Accountability Reports'           => ''
            ]
        ]);  
    }
    public function assetutilizationreports(): void {
        $user = Auth::user();
        View::render('assets/Views/assetutilizationreports', [
            'title'       => 'Asset Utilization Reports',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Asset Utilization Reports'           => ''
            ]
        ]);  
    }
    public function maintenanceperformancereports(): void {
        $user = Auth::user();
        View::render('assets/Views/maintenanceperformancereports', [
            'title'       => 'Maintenance Performance Reports',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Maintenance Performance Reports'           => ''
            ]
        ]);  
    }
    public function auditreadydocumentation(): void {
        $user = Auth::user();
        View::render('assets/Views/maintenanceperformancereports', [
            'title'       => 'Audit Ready Documentation',
            'moduleName'  => 'University Equipment & IT Asset Management',
            'slug'        => 'assets',
            'user'        => $user,
            'crumbs'      => [
                'University Equipment & IT Asset Management' => url('assets'),
                'Audit Ready Documentation'           => ''
            ]
        ]);
    }
}
