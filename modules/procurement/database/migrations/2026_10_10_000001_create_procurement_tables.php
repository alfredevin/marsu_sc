<?php
use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        // 1. Units of Measurement
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_units` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `unit_name` VARCHAR(50) NOT NULL UNIQUE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 2. Equipment & Supplies Master Catalog
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_equipment` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `equipment_name` VARCHAR(150) NOT NULL,
            `price` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            `unit` VARCHAR(30) NOT NULL DEFAULT 'unit',
            `category` VARCHAR(60) NOT NULL DEFAULT 'IT Equipment',
            `description` TEXT NULL,
            `status` TINYINT(1) NOT NULL DEFAULT 1,
            `created_at` DATETIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 3. Suppliers Directory
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_suppliers` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `supplier_code` VARCHAR(50) NOT NULL UNIQUE,
            `company_name` VARCHAR(150) NOT NULL,
            `contact_person` VARCHAR(100) NOT NULL,
            `contact_phone` VARCHAR(50) NOT NULL,
            `email` VARCHAR(100) NOT NULL,
            `address` TEXT NOT NULL,
            `tin_number` VARCHAR(50) NULL,
            `philgeps_reg_number` VARCHAR(50) NULL,
            `classification` VARCHAR(100) NOT NULL DEFAULT 'IT Equipment',
            `status` ENUM('Accredited', 'Pending', 'Suspended', 'Inactive') NOT NULL DEFAULT 'Accredited',
            `rating` DECIMAL(3,1) NOT NULL DEFAULT 5.0,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 4. Allocated Department Funds
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_allocated_funds` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `year` INT NOT NULL,
            `department_id` INT NULL,
            `department_name` VARCHAR(150) NOT NULL,
            `amount` DECIMAL(15,2) NOT NULL DEFAULT 0.00,
            `created_at` DATETIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 5. Project Procurement Management Plan (PPMP)
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_ppmp` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `ppmp_code` VARCHAR(50) NOT NULL UNIQUE,
            `year` INT NOT NULL,
            `department_id` INT NULL,
            `department_name` VARCHAR(150) NOT NULL,
            `requested_by` VARCHAR(150) NOT NULL,
            `grand_total` DECIMAL(15,2) NOT NULL DEFAULT 0.00,
            `status` ENUM('Draft', 'Pending Approval', 'Approved', 'Ready for RFQ', 'Rejected') NOT NULL DEFAULT 'Pending Approval',
            `reason` TEXT NULL,
            `remarks` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 6. PPMP Line Items
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_ppmp_items` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `ppmp_id` INT NOT NULL,
            `equipment_id` INT NULL,
            `item_name` VARCHAR(255) NOT NULL,
            `employee_name` VARCHAR(150) NULL,
            `quantity` INT NOT NULL DEFAULT 1,
            `price` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            `total_amount` DECIMAL(15,2) NOT NULL DEFAULT 0.00,
            `created_at` DATETIME NOT NULL,
            CONSTRAINT `fk_prc_ppmp_items` FOREIGN KEY (`ppmp_id`) REFERENCES `prc_ppmp` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 7. Purchase Requests (PR)
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_purchase_requests` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pr_number` VARCHAR(50) NOT NULL UNIQUE,
            `ppmp_id` INT NULL,
            `requesting_office` VARCHAR(120) NOT NULL,
            `fund_source` VARCHAR(100) NOT NULL DEFAULT 'General Fund (GAA)',
            `purpose` TEXT NOT NULL,
            `requested_by` VARCHAR(100) NOT NULL,
            `approved_by` VARCHAR(100) NULL,
            `priority` ENUM('Regular', 'High', 'Urgent') NOT NULL DEFAULT 'Regular',
            `status` ENUM('Draft', 'Submitted', 'Approved', 'Canvassing', 'PO Issued', 'Rejected', 'Completed') NOT NULL DEFAULT 'Submitted',
            `estimated_total` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            `date_needed` DATE NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 8. PR Items
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_pr_items` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pr_id` INT NOT NULL,
            `item_description` TEXT NOT NULL,
            `quantity` INT NOT NULL DEFAULT 1,
            `unit` VARCHAR(30) NOT NULL DEFAULT 'unit',
            `estimated_unit_cost` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            `total_cost` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            `created_at` DATETIME NOT NULL,
            CONSTRAINT `fk_prc_pr_items_pr` FOREIGN KEY (`pr_id`) REFERENCES `prc_purchase_requests` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 9. Purchase Orders (PO)
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_purchase_orders` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `po_number` VARCHAR(50) NOT NULL UNIQUE,
            `pr_id` INT NULL,
            `ppmp_id` INT NULL,
            `supplier_id` INT NOT NULL,
            `po_date` DATE NOT NULL,
            `mode_of_procurement` VARCHAR(120) NOT NULL DEFAULT 'Small Value Procurement (Sec. 53.9)',
            `delivery_term` VARCHAR(100) NOT NULL DEFAULT '30 Calendar Days upon receipt of NTP',
            `payment_term` VARCHAR(100) NOT NULL DEFAULT 'Government Terms (Check/LDDAP)',
            `total_amount` DECIMAL(15,2) NOT NULL DEFAULT 0.00,
            `delivery_receipt_no` VARCHAR(100) NULL,
            `received_by` VARCHAR(150) NULL,
            `date_received` DATE NULL,
            `status` ENUM('Draft', 'Pending Delivery', 'Ready for Inspection', 'Completed', 'Partially Completed', 'Cancelled') NOT NULL DEFAULT 'Pending Delivery',
            `approved_by` VARCHAR(100) NOT NULL DEFAULT 'University President / VP Administration',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            CONSTRAINT `fk_prc_po_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `prc_suppliers` (`id`) ON DELETE RESTRICT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 10. Inspection & Acceptance Reports (IAR)
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_inspection_acceptance` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `iar_number` VARCHAR(50) NOT NULL UNIQUE,
            `po_id` INT NOT NULL,
            `invoice_number` VARCHAR(60) NULL,
            `inspection_date` DATE NOT NULL,
            `inspection_officer` VARCHAR(150) NOT NULL DEFAULT 'Inspection Committee Chair',
            `supply_officer` VARCHAR(150) NOT NULL DEFAULT 'Supply Officer III',
            `inspection_status` ENUM('Inspected & Accepted', 'Partially Accepted', 'Rejected') NOT NULL DEFAULT 'Inspected & Accepted',
            `remarks` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            CONSTRAINT `fk_prc_iar_po` FOREIGN KEY (`po_id`) REFERENCES `prc_purchase_orders` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 11. IAR Line Items
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_inspection_items` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `iar_id` INT NOT NULL,
            `item_description` VARCHAR(255) NOT NULL,
            `accepted_qty` INT NOT NULL DEFAULT 0,
            `rejected_qty` INT NOT NULL DEFAULT 0,
            `condition_status` VARCHAR(50) NOT NULL DEFAULT 'Good Condition',
            `remarks` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            CONSTRAINT `fk_prc_insp_items_iar` FOREIGN KEY (`iar_id`) REFERENCES `prc_inspection_acceptance` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 12. Canvass & Quotations (Price Matrix / RFQ)
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_canvass_quotations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pr_id` INT NULL,
            `equipment_id` INT NULL,
            `supplier_id` INT NOT NULL,
            `quotation_ref` VARCHAR(50) NULL,
            `quoted_amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            `is_lowest_calculated` TINYINT(1) NOT NULL DEFAULT 0,
            `status` ENUM('Received', 'Evaluated', 'Awarded', 'Disqualified') NOT NULL DEFAULT 'Received',
            `evaluated_by` VARCHAR(100) NULL,
            `remarks` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            CONSTRAINT `fk_prc_canvass_sup` FOREIGN KEY (`supplier_id`) REFERENCES `prc_suppliers` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 13. Inventory Master Ledger
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_inventory` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `equipment_id` INT NULL,
            `item_name` VARCHAR(255) NOT NULL,
            `category` VARCHAR(60) NOT NULL DEFAULT 'General',
            `unit` VARCHAR(30) NOT NULL DEFAULT 'pcs',
            `qty_on_hand` INT NOT NULL DEFAULT 0,
            `unit_cost` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            `reorder_point` INT NOT NULL DEFAULT 5,
            `date_added` DATETIME NOT NULL,
            `updated_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 14. Property Issuances (PAR / ICS / RIS)
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_issuances` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `tracking_no` VARCHAR(50) NOT NULL UNIQUE,
            `issued_to_name` VARCHAR(150) NOT NULL,
            `department_name` VARCHAR(150) NOT NULL,
            `issued_by` VARCHAR(150) NOT NULL,
            `type` ENUM('PAR', 'ICS', 'RIS') NOT NULL DEFAULT 'PAR',
            `issue_date` DATETIME NOT NULL,
            `purpose` TEXT NULL,
            `created_at` DATETIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 15. Issuance Items (Property Tags & Equipment Status)
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_issuance_items` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `issuance_id` INT NOT NULL,
            `inventory_id` INT NULL,
            `item_name` VARCHAR(255) NOT NULL,
            `property_number` VARCHAR(100) NOT NULL,
            `quantity` INT NOT NULL DEFAULT 1,
            `status` ENUM('Serviceable', 'Missing', 'For Condemn', 'Condemned') NOT NULL DEFAULT 'Serviceable',
            `remarks` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            CONSTRAINT `fk_prc_issuance_items` FOREIGN KEY (`issuance_id`) REFERENCES `prc_issuances` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 16. Property Issue Reports & Condemnation Tracking
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_property_issue_reports` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `issuance_item_id` INT NULL,
            `property_number` VARCHAR(100) NOT NULL,
            `item_name` VARCHAR(255) NOT NULL,
            `reported_by` VARCHAR(150) NOT NULL,
            `issue_type` ENUM('Missing', 'Damaged', 'For Condemn') NOT NULL DEFAULT 'Damaged',
            `remarks` TEXT NULL,
            `report_date` DATETIME NOT NULL,
            `status` ENUM('Pending Review', 'Under Investigation', 'Resolved', 'Condemned') NOT NULL DEFAULT 'Pending Review',
            `created_at` DATETIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // ─── Realistic Seed Data Based on SPMS ─────────────────────────────────
        $now = date('Y-m-d H:i:s');

        // Check if already seeded
        $cntSup = (int)Database::fetchColumn("SELECT COUNT(*) FROM `prc_suppliers`");
        if ($cntSup === 0) {
            // Seed Units
            $db->exec("INSERT INTO `prc_units` (`unit_name`) VALUES 
                ('unit'), ('pcs'), ('box'), ('set'), ('pack'), ('ream'), ('lot'), ('roll');");

            // Seed Equipment Catalog
            $db->exec("INSERT INTO `prc_equipment` 
                (`equipment_name`, `price`, `unit`, `category`, `description`, `status`, `created_at`) VALUES
                ('Core i7 14th Gen Desktop PC Set', 55000.00, 'set', 'IT Equipment', 'High performance desktop with 32GB RAM, 1TB NVMe, 24-inch IPS monitor', 1, '{$now}'),
                ('24-Port Gigabit Managed PoE Switch', 20000.00, 'unit', 'IT Equipment', 'Layer-2 switch with SFP fiber uplink', 1, '{$now}'),
                ('Digital Storage Oscilloscope 100MHz Dual Channel', 32000.00, 'unit', 'Laboratory Equipment', 'Color display benchtop oscilloscope', 1, '{$now}'),
                ('IoT Microcontroller Trainer Kit with Sensors', 2800.00, 'set', 'Laboratory Equipment', 'ESP32 / Arduino compatible trainer kit', 1, '{$now}'),
                ('Steel 4-Drawer Vertical Filing Cabinet', 8500.00, 'unit', 'Furniture & Fixtures', 'Heavy gauge steel with anti-tilt central lock', 1, '{$now}'),
                ('Ergonomic Mid-Back Mesh Office Chair', 2900.00, 'unit', 'Furniture & Fixtures', 'Adjustable lumbar support and pneumatic lift', 1, '{$now}'),
                ('Multipurpose A4 Copy Paper 80gsm (500 sheets)', 240.00, 'ream', 'Office Supplies', 'High brightness acid-free laser/inkjet copy paper', 1, '{$now}'),
                ('Heavy-Duty Desktop Stapler 100 Sheets', 750.00, 'pcs', 'Office Supplies', 'All-metal construction with adjustable depth guide', 1, '{$now}');");

            // Seed Suppliers
            $db->exec("INSERT INTO `prc_suppliers` 
                (`supplier_code`, `company_name`, `contact_person`, `contact_phone`, `email`, `address`, `tin_number`, `philgeps_reg_number`, `classification`, `status`, `rating`, `created_at`) 
                VALUES
                ('SUP-2026-001', 'Marinduque TechSolutions & Supplies Corp.', 'Engr. Roberto M. Tan', '0917-555-8921', 'sales@marinduquetech.ph', 'Boac Commercial Complex, Boac, Marinduque', '204-889-112-000', 'PHILGEPS-2026-88901', 'IT Equipment', 'Accredited', 4.9, '{$now}'),
                ('SUP-2026-002', 'Island Academic & Office Essentials Inc.', 'Maria Clara Santos', '0919-444-1234', 'orders@islandoffice.com.ph', 'National Highway, Gasan, Marinduque', '109-332-990-000', 'PHILGEPS-2026-77432', 'Office Supplies', 'Accredited', 4.8, '{$now}'),
                ('SUP-2026-003', 'Mimaropa Scientific Equipment & Lab Depot', 'Dr. Alvin G. Navarro', '0928-888-9012', 'info@mimaropalabs.com', 'Capitol Road, Boac, Marinduque', '312-776-554-000', 'PHILGEPS-2026-66519', 'Laboratory Equipment', 'Accredited', 5.0, '{$now}'),
                ('SUP-2026-004', 'Apex Southern Educational Furnitures', 'Carmela D. Reyes', '0935-123-7654', 'apex.furniture@gmail.com', 'Mogpog Poblacion, Marinduque', '441-229-887-000', 'PHILGEPS-2026-55410', 'Furniture & Fixtures', 'Accredited', 4.7, '{$now}');");

            // Seed Allocated Funds per College
            $db->exec("INSERT INTO `prc_allocated_funds` (`year`, `department_name`, `amount`, `created_at`) VALUES
                (2026, 'College of Information and Computing Sciences (CICS)', 500000.00, '{$now}'),
                (2026, 'College of Engineering and Technology (CET)', 750000.00, '{$now}'),
                (2026, 'College of Arts and Sciences (CAS)', 400000.00, '{$now}'),
                (2026, 'College of Business and Accountancy (CBA)', 450000.00, '{$now}'),
                (2026, 'College of Teacher Education (CTE)', 350000.00, '{$now}');");

            // Seed PPMP Plans
            $db->exec("INSERT INTO `prc_ppmp` 
                (`id`, `ppmp_code`, `year`, `department_name`, `requested_by`, `grand_total`, `status`, `reason`, `remarks`, `created_at`) VALUES
                (1, 'PPMP-2026-CICS-01', 2026, 'College of Information and Computing Sciences (CICS)', 'Dean Alfred Flores', 185000.00, 'Pending Approval', 'Expansion of CICS Computer Laboratory 3 and Networking Infrastructure', 'For review by BAC Secretariat and Campus Director', '{$now}'),
                (2, 'PPMP-2026-CET-02', 2026, 'College of Engineering and Technology (CET)', 'Dean JM Dalimm', 92000.00, 'Approved', 'ECE Laboratory Digital Test Instruments and IoT Microcontroller Kits', 'Consolidated into Annual Procurement Plan', '{$now}'),
                (3, 'PPMP-2026-CAS-03', 2026, 'College of Arts and Sciences (CAS)', 'Dean Ma. Elena Ramos', 48500.00, 'Ready for RFQ', 'Ergonomic Faculty Desks and Archive Steel Cabinets', 'BAC Resolution for Small Value Procurement approved', '{$now}');");

            // Seed PPMP Items
            $db->exec("INSERT INTO `prc_ppmp_items` 
                (`ppmp_id`, `equipment_id`, `item_name`, `employee_name`, `quantity`, `price`, `total_amount`, `created_at`) VALUES
                (1, 1, 'Core i7 14th Gen Desktop PC Set', 'Prof. Angela Gutierrez', 3, 55000.00, 165000.00, '{$now}'),
                (1, 2, '24-Port Gigabit Managed PoE Switch', 'Engr. Jayson Morales', 1, 20000.00, 20000.00, '{$now}'),
                (2, 3, 'Digital Storage Oscilloscope 100MHz Dual Channel', 'Engr. Kenneth Lim', 2, 32000.00, 64000.00, '{$now}'),
                (2, 4, 'IoT Microcontroller Trainer Kit with Sensors', 'Prof. Michael Santos', 10, 2800.00, 28000.00, '{$now}'),
                (3, 5, 'Steel 4-Drawer Vertical Filing Cabinet', 'Ms. Lourdes Fabregas', 4, 8500.00, 34000.00, '{$now}'),
                (3, 6, 'Ergonomic Mid-Back Mesh Office Chair', 'Mr. Renato Garcia', 5, 2900.00, 14500.00, '{$now}');");

            // Seed Purchase Requests
            $db->exec("INSERT INTO `prc_purchase_requests` 
                (`id`, `pr_number`, `ppmp_id`, `requesting_office`, `fund_source`, `purpose`, `requested_by`, `approved_by`, `priority`, `status`, `estimated_total`, `date_needed`, `created_at`) 
                VALUES
                (1, 'PR-2026-10-001', 1, 'College of Information & Computing Sciences (CICS)', 'Special Trust Fund (STF)', 'Procurement of High-Performance Desktop Units & Managed Network Switches for CICS Computer Laboratory 3 Expansion', 'Prof. Angela Gutierrez', 'Dr. Diosdado P. Zulueta (University President)', 'High', 'Approved', 185000.00, '2026-10-25', '{$now}'),
                (2, 'PR-2026-10-002', 3, 'Office of Student Affairs and Services (OSAS)', 'General Fund (GAA)', 'Purchase of Ergonomic Office Desks and Heavy-Duty Filing Cabinets for Student Records Archiving', 'Atty. Manuel Beltran', 'Dr. Marissa C. Mingoa (VP Administration)', 'Regular', 'Canvassing', 48500.00, '2026-11-05', '{$now}'),
                (3, 'PR-2026-10-003', 2, 'College of Engineering & Technology', 'Fiduciary Fund', 'Procurement of Digital Multimeters, Microcontroller Kits & Soldering Stations for ECE Laboratory', 'Engr. Jayson Morales', 'Dr. Diosdado P. Zulueta (University President)', 'High', 'PO Issued', 92000.00, '2026-10-18', '{$now}'),
                (4, 'PR-2026-10-004', NULL, 'University Library System', 'General Fund (GAA)', 'Supply and Delivery of RFID Security Gate and Barcode Scanners for Boac Campus Central Library', 'Ms. Lourdes V. Fabregas', NULL, 'Regular', 'Submitted', 125000.00, '2026-11-15', '{$now}');");

            // Seed PR Items
            $db->exec("INSERT INTO `prc_pr_items` 
                (`pr_id`, `item_description`, `quantity`, `unit`, `estimated_unit_cost`, `total_cost`, `created_at`) VALUES
                (1, 'Core i7 14th Gen Desktop PC Set', 3, 'set', 55000.00, 165000.00, '{$now}'),
                (1, '24-Port Gigabit Managed PoE Switch', 1, 'unit', 20000.00, 20000.00, '{$now}'),
                (2, 'Steel 4-Drawer Vertical Filing Cabinet', 4, 'unit', 8500.00, 34000.00, '{$now}'),
                (2, 'Ergonomic Mid-Back Mesh Office Chair', 5, 'unit', 2900.00, 14500.00, '{$now}'),
                (3, 'Digital Storage Oscilloscope 100MHz Dual Channel', 2, 'unit', 32000.00, 64000.00, '{$now}'),
                (3, 'IoT Microcontroller Trainer Kit with Sensors', 10, 'set', 2800.00, 28000.00, '{$now}');");

            // Seed Purchase Orders
            $db->exec("INSERT INTO `prc_purchase_orders` 
                (`id`, `po_number`, `pr_id`, `ppmp_id`, `supplier_id`, `po_date`, `mode_of_procurement`, `delivery_term`, `payment_term`, `total_amount`, `delivery_receipt_no`, `received_by`, `date_received`, `status`, `approved_by`, `created_at`) 
                VALUES
                (1, 'PO-2026-10-001', 1, 1, 1, '2026-10-05', 'Small Value Procurement (Sec. 53.9)', '15 Calendar Days', 'LDDAP-ADA Government Terms', 182500.00, NULL, NULL, NULL, 'Pending Delivery', 'Dr. Diosdado P. Zulueta', '{$now}'),
                (2, 'PO-2026-10-002', 2, 3, 2, '2026-10-08', 'Small Value Procurement (Sec. 53.9)', '15 Calendar Days', 'Check upon Acceptance', 47200.00, 'DR-2026-8831', 'Engr. Kenneth P. Lim', '2026-10-12', 'Ready for Inspection', 'Dr. Marissa C. Mingoa', '{$now}'),
                (3, 'PO-2026-09-088', 3, 2, 3, '2026-09-28', 'Small Value Procurement (Sec. 53.9)', '30 Calendar Days', 'Check upon Acceptance', 89500.00, 'DR-2026-4412', 'Engr. Kenneth P. Lim', '2026-10-02', 'Completed', 'Dr. Diosdado P. Zulueta', '{$now}');");

            // Seed Inspection & Acceptance (IAR)
            $db->exec("INSERT INTO `prc_inspection_acceptance` 
                (`id`, `iar_number`, `po_id`, `invoice_number`, `inspection_date`, `inspection_officer`, `supply_officer`, `inspection_status`, `remarks`, `created_at`) 
                VALUES
                (1, 'IAR-2026-10-001', 3, 'INV-77319', '2026-10-03', 'Engr. Kenneth P. Lim (Inspection Chair)', 'Maria Luisa D. Cruz (Supply Officer III)', 'Inspected & Accepted', 'All Oscilloscopes and Microcontroller kits verified compliant with technical specifications.', '{$now}'),
                (2, 'IAR-2026-10-002', 2, 'SI-89021', '2026-10-14', 'Prof. Roberto Tan', 'Maria Luisa D. Cruz', 'Partially Accepted', '4 filing cabinets accepted; 1 chair with damaged caster wheel returned for replacement.', '{$now}');");

            // Seed IAR Items
            $db->exec("INSERT INTO `prc_inspection_items` 
                (`iar_id`, `item_description`, `accepted_qty`, `rejected_qty`, `condition_status`, `remarks`, `created_at`) VALUES
                (1, 'Digital Storage Oscilloscope 100MHz Dual Channel', 2, 0, 'Good Condition', 'Complete with probes and warranty certificate', '{$now}'),
                (1, 'IoT Microcontroller Trainer Kit with Sensors', 10, 0, 'Good Condition', 'All 10 sets tested working', '{$now}'),
                (2, 'Steel 4-Drawer Vertical Filing Cabinet', 4, 0, 'Good Condition', 'Passed locking and drawer slide stress test', '{$now}'),
                (2, 'Ergonomic Mid-Back Mesh Office Chair', 4, 1, 'Has Rejects (1)', '1 unit returned due to damaged base caster wheel', '{$now}');");

            // Seed Inventory Ledger
            $db->exec("INSERT INTO `prc_inventory` 
                (`id`, `equipment_id`, `item_name`, `category`, `unit`, `qty_on_hand`, `unit_cost`, `reorder_point`, `date_added`) VALUES
                (1, 1, 'Core i7 14th Gen Desktop PC Set', 'IT Equipment', 'set', 3, 55000.00, 2, '{$now}'),
                (2, 2, '24-Port Gigabit Managed PoE Switch', 'IT Equipment', 'unit', 1, 20000.00, 1, '{$now}'),
                (3, 3, 'Digital Storage Oscilloscope 100MHz Dual Channel', 'Laboratory Equipment', 'unit', 2, 32000.00, 2, '{$now}'),
                (4, 4, 'IoT Microcontroller Trainer Kit with Sensors', 'Laboratory Equipment', 'set', 10, 2800.00, 5, '{$now}'),
                (5, 7, 'Multipurpose A4 Copy Paper 80gsm (500 sheets)', 'Office Supplies', 'ream', 3, 240.00, 10, '{$now}'),
                (6, 6, 'Ergonomic Mid-Back Mesh Office Chair', 'Furniture & Fixtures', 'unit', 4, 2900.00, 3, '{$now}');");

            // Seed Property Issuances (PAR & RIS)
            $db->exec("INSERT INTO `prc_issuances` 
                (`id`, `tracking_no`, `issued_to_name`, `department_name`, `issued_by`, `type`, `issue_date`, `purpose`, `created_at`) VALUES
                (1, 'PAR-2026-9478', 'Engr. Roberto M. Tan', 'College of Information and Computing Sciences (CICS)', 'Maria Luisa D. Cruz', 'PAR', '2026-10-15 10:00:00', 'Assigned equipment for CICS IT Laboratory 3 expansion', '{$now}'),
                (2, 'RIS-2026-1021', 'Prof. Angela Gutierrez', 'College of Information and Computing Sciences (CICS)', 'Maria Luisa D. Cruz', 'RIS', '2026-10-16 14:30:00', 'Office supplies requisition for mid-term exams', '{$now}');");

            // Seed Issuance Items (Matches SPMS issuance_items_tbl: 3 Serviceable, 2 Missing)
            $db->exec("INSERT INTO `prc_issuance_items` 
                (`issuance_id`, `inventory_id`, `item_name`, `property_number`, `quantity`, `status`, `remarks`, `created_at`) VALUES
                (1, 1, 'Core i7 14th Gen Desktop PC Set', 'PRC-2026-0001', 1, 'Missing', 'Missing during physical inventory count (inuwi)', '{$now}'),
                (1, 1, 'Core i7 14th Gen Desktop PC Set', 'PRC-2026-0002', 1, 'Serviceable', 'In good running condition in Lab 3', '{$now}'),
                (1, 1, 'Core i7 14th Gen Desktop PC Set', 'PRC-2026-0003', 1, 'Serviceable', 'In good running condition in Lab 3', '{$now}'),
                (1, 2, '24-Port Gigabit Managed PoE Switch', 'PRC-2026-0004', 1, 'Serviceable', 'Rack-mounted and configured in Server Rack A', '{$now}'),
                (1, 1, 'Core i7 14th Gen Desktop PC Set', 'PRC-2026-0005', 1, 'Missing', 'Reported unlocated during annual audit (binenta)', '{$now}'),
                (2, 6, 'Ergonomic Mid-Back Mesh Office Chair', 'PRC-2026-0006', 1, 'For Condemn', 'Broken hydraulic gas cylinder, uneven tilt', '{$now}');");

            // Seed Property Issue Reports & Audit
            $db->exec("INSERT INTO `prc_property_issue_reports` 
                (`issuance_item_id`, `property_number`, `item_name`, `reported_by`, `issue_type`, `remarks`, `report_date`, `status`, `created_at`) VALUES
                (1, 'PRC-2026-0001', 'Core i7 14th Gen Desktop PC Set', 'Dean Alfred Flores', 'Missing', 'Desktop unit unlocated during laboratory semester inspection.', '2026-10-18 09:30:00', 'Under Investigation', '{$now}'),
                (5, 'PRC-2026-0005', 'Core i7 14th Gen Desktop PC Set', 'Lab Custodian J. Ramos', 'Missing', 'Unaccounted item from previous fiscal turn-over.', '2026-10-19 11:15:00', 'Pending Review', '{$now}'),
                (6, 'PRC-2026-0006', 'Ergonomic Mid-Back Mesh Office Chair', 'Prof. Angela Gutierrez', 'For Condemn', 'Hydraulic mechanism failed, irreparable structural defect.', '2026-10-20 15:00:00', 'Resolved', '{$now}');");
        }
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `prc_property_issue_reports`;");
        $db->exec("DROP TABLE IF EXISTS `prc_issuance_items`;");
        $db->exec("DROP TABLE IF EXISTS `prc_issuances`;");
        $db->exec("DROP TABLE IF EXISTS `prc_inventory`;");
        $db->exec("DROP TABLE IF EXISTS `prc_canvass_quotations`;");
        $db->exec("DROP TABLE IF EXISTS `prc_inspection_items`;");
        $db->exec("DROP TABLE IF EXISTS `prc_inspection_acceptance`;");
        $db->exec("DROP TABLE IF EXISTS `prc_purchase_orders`;");
        $db->exec("DROP TABLE IF EXISTS `prc_pr_items`;");
        $db->exec("DROP TABLE IF EXISTS `prc_purchase_requests`;");
        $db->exec("DROP TABLE IF EXISTS `prc_ppmp_items`;");
        $db->exec("DROP TABLE IF EXISTS `prc_ppmp`;");
        $db->exec("DROP TABLE IF EXISTS `prc_allocated_funds`;");
        $db->exec("DROP TABLE IF EXISTS `prc_equipment`;");
        $db->exec("DROP TABLE IF EXISTS `prc_suppliers`;");
        $db->exec("DROP TABLE IF EXISTS `prc_units`;");
    }
};
