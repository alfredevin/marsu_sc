<?php
namespace Modules\Housing\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Accredited Boarding House Management & Directory
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();
        
        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `hsg_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('housing/Views/index', [
            'title'       => 'Accredited Boarding House Management & Directory',
            'moduleName'  => 'Accredited Boarding House Management & Directory',
            'slug'        => 'housing',
            'records'     => $records,
            'user'        => $user,
            'crumbs'      => [
                'Student Services' => '',
                'Accredited Boarding House Management & Directory' => ''
            ]
        ]);
    }

    public function tenants(): void {
        $user = Auth::user();

        // Sample tenant records for demo
        $tenants = [
            [
                'id'          => 1,
                'student_id'  => '22-0145',
                'name'        => 'Maria Santos',
                'program'     => 'BS Information Technology - 3A',
                'house'       => 'Villa Marinduque Student Dorm',
                'room'        => 'Room 102 - Bed A',
                'monthly_rent'=> '₱1,500.00',
                'contact'     => '0917-123-4567',
                'move_in'     => 'Aug 15, 2026',
                'status'      => 'Active'
            ],
            [
                'id'          => 2,
                'student_id'  => '23-0891',
                'name'        => 'John Rey Reyes',
                'program'     => 'BS Computer Science - 2B',
                'house'       => 'Greenview Boarding House',
                'room'        => 'Room 204 - Bed B',
                'monthly_rent'=> '₱1,800.00',
                'contact'     => '0918-987-6543',
                'move_in'     => 'Sep 01, 2026',
                'status'      => 'Active'
            ],
            [
                'id'          => 3,
                'student_id'  => '21-0322',
                'name'        => 'Angelica Ramos',
                'program'     => 'BS Civil Engineering - 4A',
                'house'       => 'Sunrise Ladies Dormitory',
                'room'        => 'Room 105',
                'monthly_rent'=> '₱2,000.00',
                'contact'     => '0920-555-8888',
                'move_in'     => 'Aug 20, 2026',
                'status'      => 'Pending'
            ],
            [
                'id'          => 4,
                'student_id'  => '24-1102',
                'name'        => 'Mark Joseph Alcantara',
                'program'     => 'BS Hospitality Management - 1C',
                'house'       => 'Villa Marinduque Student Dorm',
                'room'        => 'Room 104 - Bed C',
                'monthly_rent'=> '₱1,500.00',
                'contact'     => '0919-444-2233',
                'move_in'     => 'Sep 10, 2026',
                'status'      => 'Active'
            ]
        ];

        View::render('housing/Views/tenants', [
            'title'       => 'Tenant Profiles & Directory',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'tenants'     => $tenants,
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Tenant Management' => '',
                'Tenant Profile'    => ''
            ]
        ]);
    }

   
    public function announcements(): void {
        $user = Auth::user();
        View::render('housing/Views/announcements', [
            'title'       => 'Announcements',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Communication'  => '',
                'Announcements'  => ''
            ]
        ]);
    }
    public function approvalworkflow(): void {
        $user = Auth::user();
        View::render('housing/Views/approvalworkflow', [
            'title'       => 'Approval Workflow',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Reservation & App'  => '',
                'Approval Workflow'  => ''
            ]
        ]);
    }
     public function availabilitytracking(): void {
        $user = Auth::user();
        View::render('housing/Views/availabilitytracking', [
            'title'       => 'Availability Tracking',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Room & Accomodation'  => '',
                'Availability Tracking'  => ''
            ]
        ]);
    }
    public function balancemonitoring(): void {
        $user = Auth::user();
        View::render('housing/Views/balancemonitoring', [
            'title'       => 'Balance Monitoring',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Payment & Billing'  => '',
                'Balance Monitoring'  => ''
            ]
        ]);
    }
     public function bedallocation(): void {
        $user = Auth::user();
        View::render('housing/Views/bedallocation', [
            'title'       => 'Bed Allocation',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Room & Accomodation'  => '',
                'Bed Allocation'  => ''
            ]
        ]);
    }
    public function boardingfees(): void {
        $user = Auth::user();
        View::render('housing/Views/boardingfees', [
            'title'       => 'Boarding Fees Tracking',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Payment & Billing'  => '',
                'Boarding Fees Tracking'  => ''
            ]
        ]);
    }
     public function conditionreports(): void {
        $user = Auth::user();
        View::render('housing/Views/conditionreports', [
            'title'       => 'Condition Reports',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Maintenance & Facility'  => '',
                'Condition Reports'  => ''
            ]
        ]);
    }   
      public function facilityutilizations(): void {
        $user = Auth::user();
        View::render('housing/Views/facilityutilizations', [
            'title'       => 'Facility Utilization',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Maintenance & Facility'  => '',
                'Facility Utilizations'  => ''
            ]
        ]);
    }   
    
       public function housingapplication(): void {
        $user = Auth::user();
        View::render('housing/Views/housingapplication', [
            'title'       => 'Housing Application',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Reservation & App'  => '',
                'Housing Application'  => ''
            ]
        ]);
    }   
     public function incidentreporting(): void {
        $user = Auth::user();
        View::render('housing/Views/incidentreporting', [
            'title'       => 'Incident Reporting',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Maintenance & Facility'  => '',
                'Facility Utilizations'  => ''
            ]
        ]);
    } 
    public function maintenancerequests(): void {
        $user = Auth::user();
        View::render('housing/Views/maintenancerequests', [
            'title'       => 'Maintenance Requests',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Maintenance & Facility'  => '',
                'Facility Utilizations'  => ''
            ]
        ]);
    }   
    public function occupancyreports(): void {
        $user = Auth::user();
        View::render('housing/Views/occupancyreports', [
            'title'       => 'Maintenance Requests',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Maintenance & Facility'  => '',
                'Facility Utilizations'  => ''
            ]
        ]);
    }     
    public function occupancymonitoring(): void {
        $user = Auth::user();
        View::render('housing/Views/occupancymonitoring', [
            'title'       => 'Occupancy Monitoring',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Room & Accomodation'  => '',
                'Occupancy Monitoring'  => ''
            ]
        ]);
    }     
    public function paymentrecords(): void {
        $user = Auth::user();
        View::render('housing/Views/paymentrecords', [
            'title'       => 'Payment Records',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Payment & Billing'  => '',
                'Payment Records'  => ''
            ]
        ]);
    }     
    public function receiptgeneration(): void {
        $user = Auth::user();
        View::render('housing/Views/receiptgeneration', [
            'title'       => 'Receipt Generation',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Occupancy & Rooming'  => '',
                'Occupancy Monitoring'  => ''
            ]
        ]);
    }
      public function repairmonitoring(): void {
        $user = Auth::user();
        View::render('housing/Views/repairmonitoring', [
            'title'       => 'Repair Monitoring',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Occupancy & Rooming'  => '',
                'Occupancy Monitoring'  => ''
            ]
        ]);
    }
      public function reports(): void {
        $user = Auth::user();
        View::render('housing/Views/reports', [
            'title'       => 'Receipt Generation',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Occupancy & Rooming'  => '',
                'Occupancy Monitoring'  => ''
            ]
        ]);
    }     
    
       public function reservationmanagement(): void {
        $user = Auth::user();
        View::render('housing/Views/reservationmanagement', [
            'title'       => 'Receipt Generation',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Reservation & App'  => '',
                'Reservation Management'  => ''
            ]
        ]);
    }     
    
       public function residencyhistory(): void {
        $user = Auth::user();
        View::render('housing/Views/residencyhistory', [
            'title'       => 'Receipt Generation',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Occupancy & Rooming'  => '',
                'Occupancy Monitoring'  => ''
            ]
        ]);
    }     
       public function residentstatistics(): void {
        $user = Auth::user();
        View::render('housing/Views/residentstatistics', [
            'title'       => 'Receipt Generation',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Occupancy & Rooming'  => '',
                'Occupancy Monitoring'  => ''
            ]
        ]);
    }     
    
      public function revenuereports(): void {
        $user = Auth::user();
        View::render('housing/Views/revenuereports', [
            'title'       => 'Receipt Generation',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Occupancy & Rooming'  => '',
                'Occupancy Monitoring'  => ''
            ]
        ]);
    }     
    
      public function roomandinventory(): void {
        $user = Auth::user();
        View::render('housing/Views/roomandinventory', [
            'title'       => 'Receipt Generation',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Room & Accomodation'  => '',
                'Room & Inventory'  => ''
            ]
        ]);
    }     
    public function roomassignment(): void {
        $user = Auth::user();
        View::render('housing/Views/roomassignment', [
            'title'       => 'Room Assignment',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Room & Accomodation'  => '',
                'Room Assignments'  => ''
            ]
        ]);
    }     
    public function rooms(): void {
        $user = Auth::user();
        View::render('housing/Views/rooms', [
            'title'       => 'Receipt Generation',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Occupancy & Rooming'  => '',
                'Occupancy Monitoring'  => ''
            ]
        ]);
    }     
    public function rulesandpolicies(): void {
        $user = Auth::user();
        View::render('housing/Views/rulesandpolicies', [
            'title'       => 'Receipt Generation',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Occupancy & Rooming'  => '',
                'Occupancy Monitoring'  => ''
            ]
        ]);
    }

    public function roomandinventory(): void {
        $user = Auth::user();
        View::render('housing/Views/roomandinventory', [
            'title'       => 'Room and Inventory',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'   => url('housing'),
                'Room & Accomodation' => '',
                'Room and Inventory'  => ''
            ]
        ]);
    }

    public function roomassignment(): void {
        $user = Auth::user();
        View::render('housing/Views/roomassignment', [
            'title'       => 'Room Assignment',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'   => url('housing'),
                'Room & Accomodation' => '',
                'Room Assignment'     => ''
            ]
        ]);
    }

    public function roomassignments(): void {
        $this->roomassignment();
    }

    public function occupancymonitoring(): void {
        $user = Auth::user();
        View::render('housing/Views/occupancymonitoring', [
            'title'       => 'Occupancy Monitoring',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'    => url('housing'),
                'Room & Accomodation'  => '',
                'Occupancy Monitoring' => ''
            ]
        ]);
    }

    public function housingapplication(): void {
        $user = Auth::user();
        View::render('housing/Views/housingapplication', [
            'title'       => 'Housing Application',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'   => url('housing'),
                'Reservation & App'   => '',
                'Housing Application' => ''
            ]
        ]);
    }

    public function housingapplications(): void {
        $this->housingapplication();
    }

    public function reservationmanagement(): void {
        $user = Auth::user();
        View::render('housing/Views/reservationmanagement', [
            'title'       => 'Reservation Management',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'      => url('housing'),
                'Reservation & App'      => '',
                'Reservation Management' => ''
            ]
        ]);
    }

    public function waitinglist(): void {
        $user = Auth::user();
        View::render('housing/Views/waitinglist', [
            'title'       => 'Waiting List',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Reservation & App' => '',
                'Waiting List'      => ''
            ]
        ]);
    }

    public function paymentrecords(): void {
        $user = Auth::user();
        View::render('housing/Views/paymentrecords', [
            'title'       => 'Payment Records',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Payment & Billing' => '',
                'Payment Records'   => ''
            ]
        ]);
    }

    public function recieptgeneration(): void {
        $user = Auth::user();
        View::render('housing/Views/receiptgeneration', [
            'title'       => 'Receipt Generation',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'  => url('housing'),
                'Payment & Billing'  => '',
                'Receipt Generation' => ''
            ]
        ]);
    }

    public function receiptgeneration(): void {
        $this->recieptgeneration();
    }

    public function maintenancerequest(): void {
        $user = Auth::user();
        View::render('housing/Views/maintenancerequest', [
            'title'       => 'Maintenance Request',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'      => url('housing'),
                'Maintenance & Facility' => '',
                'Maintenance Request'    => ''
            ]
        ]);
    }

    public function maintenancerequests(): void {
        $this->maintenancerequest();
    }

    public function repairmonitoring(): void {
        $user = Auth::user();
        View::render('housing/Views/repairmonitoring', [
            'title'       => 'Repair Monitoring',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'      => url('housing'),
                'Maintenance & Facility' => '',
                'Repair Monitoring'      => ''
            ]
        ]);
    }

    public function servicehistory(): void {
        $user = Auth::user();
        View::render('housing/Views/servicehistory', [
            'title'       => 'Service History',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'      => url('housing'),
                'Maintenance & Facility' => '',
                'Service History'        => ''
            ]
        ]);
    }

    public function residentsnotifications(): void {
        $user = Auth::user();
        View::render('housing/Views/residentsnotifications', [
            'title'       => 'Residents Notifications',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'       => url('housing'),
                'Communication'           => '',
                'Residents Notifications' => ''
            ]
        ]);
    }

    public function rulesandpolicies(): void {
        $user = Auth::user();
        View::render('housing/Views/rulesandpolicies', [
            'title'       => 'Rules & Policies',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Communication'     => '',
                'Rules & Policies'  => ''
            ]
        ]);
    }

    public function incidentreporting(): void {
        $user = Auth::user();
        View::render('housing/Views/incidentreporting', [
            'title'       => 'Incident Reporting',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'  => url('housing'),
                'Communication'      => '',
                'Incident Reporting' => ''
            ]
        ]);
    }

    public function occupancyreports(): void {
        $user = Auth::user();
        View::render('housing/Views/occupancyreports', [
            'title'       => 'Occupancy Reports',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'     => url('housing'),
                'Reports and Analytics' => '',
                'Occupancy Reports'     => ''
            ]
        ]);
    }

    public function revenuereports(): void {
        $user = Auth::user();
        View::render('housing/Views/revenuereports', [
            'title'       => 'Revenue Reports',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'     => url('housing'),
                'Reports and Analytics' => '',
                'Revenue Reports'       => ''
            ]
        ]);
    }

    public function residentstatistics(): void {
        $user = Auth::user();
        View::render('housing/Views/residentstatistics', [
            'title'       => 'Resident Statistics',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'     => url('housing'),
                'Reports and Analytics' => '',
                'Resident Statistics'   => ''
            ]
        ]);
    }

    public function facilityutilization(): void {
        $user = Auth::user();
        View::render('housing/Views/facilityutilization', [
            'title'       => 'Facility Utilization',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)'     => url('housing'),
                'Reports and Analytics' => '',
                'Facility Utilization'  => ''
            ]
        ]);
    }

    public function facilityutilizations(): void {
        $this->facilityutilization();
    }  
    
    
     public function servicehistory(): void {
        $user = Auth::user();
        View::render('housing/Views/servicehistory', [
            'title'       => 'Receipt Generation',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Occupancy & Rooming'  => '',
                'Occupancy Monitoring'  => ''
            ]
        ]);
    }  
     public function waitinglist(): void {
        $user = Auth::user();
        View::render('housing/Views/waitinglist', [
            'title'       => 'Waiting List',  
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Reservation & App'  => '',
                'Waiting List'  => ''
            ]
        ]);
    }  

    
    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `hsg_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('housing'));
        }

        View::render('housing/Views/index', [
            'title'       => 'View Record #{$id}',
            'moduleName'  => 'Accredited Boarding House Management & Directory',
            'slug'        => 'housing',
            'record'      => $record,
            'records'     => [],
            'crumbs'      => ['Accredited Boarding House Management & Directory' => url('housing'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('housing'));
        }

        try {
            Database::insert('hsg_records', [
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

        redirect(url('housing'));
    }
}
