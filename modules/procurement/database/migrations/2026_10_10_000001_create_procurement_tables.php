<?php
use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();

        // 1. Suppliers Directory
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_suppliers` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `supplier_code` VARCHAR(50) NOT NULL UNIQUE,
            `company_name` VARCHAR(150) NOT NULL,
            `contact_person` VARCHAR(100) NOT NULL,
            `contact_phone` VARCHAR(50) NOT NULL,
            `email` VARCHAR(100) NOT NULL,
            `address` TEXT NOT NULL,
            `tin_number` VARCHAR(50) NOT NULL,
            `philgeps_reg_number` VARCHAR(50) NOT NULL,
            `classification` ENUM('IT Equipment', 'Office Supplies', 'Laboratory Equipment', 'Furniture & Fixtures', 'General Services') NOT NULL DEFAULT 'IT Equipment',
            `status` ENUM('Accredited', 'Pending', 'Suspended', 'Inactive') NOT NULL DEFAULT 'Accredited',
            `rating` DECIMAL(3,1) NOT NULL DEFAULT 5.0,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 2. Purchase Requests (PR)
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_purchase_requests` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pr_number` VARCHAR(50) NOT NULL UNIQUE,
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

        // 3. PR Items
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

        // 4. Purchase Orders (PO)
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_purchase_orders` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `po_number` VARCHAR(50) NOT NULL UNIQUE,
            `pr_id` INT NULL,
            `supplier_id` INT NOT NULL,
            `po_date` DATE NOT NULL,
            `mode_of_procurement` VARCHAR(120) NOT NULL DEFAULT 'Small Value Procurement (Sec. 53.9)',
            `delivery_term` VARCHAR(100) NOT NULL DEFAULT '30 Calendar Days upon receipt of NTP',
            `payment_term` VARCHAR(100) NOT NULL DEFAULT 'Government Terms (Check/LDDAP)',
            `total_amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            `status` ENUM('Draft', 'Issued', 'Partially Delivered', 'Completed', 'Cancelled') NOT NULL DEFAULT 'Issued',
            `approved_by` VARCHAR(100) NOT NULL DEFAULT 'University President / VP Administration',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            CONSTRAINT `fk_prc_po_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `prc_suppliers` (`id`) ON DELETE RESTRICT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 5. Inspection & Acceptance Reports (IAR) with Asset Handover
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_inspection_acceptance` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `iar_number` VARCHAR(50) NOT NULL UNIQUE,
            `po_id` INT NOT NULL,
            `invoice_number` VARCHAR(60) NULL,
            `inspection_date` DATE NOT NULL,
            `inspection_status` ENUM('Inspected & Accepted', 'Partially Accepted', 'Rejected') NOT NULL DEFAULT 'Inspected & Accepted',
            `inspected_by` VARCHAR(100) NOT NULL,
            `asset_handover_status` ENUM('Pending Handover', 'Transferred to Assets', 'Not Applicable') NOT NULL DEFAULT 'Pending Handover',
            `asset_tag_generated` VARCHAR(100) NULL,
            `custodian_office` VARCHAR(120) NOT NULL DEFAULT 'CICS IT Laboratory 3',
            `remarks` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            CONSTRAINT `fk_prc_iar_po` FOREIGN KEY (`po_id`) REFERENCES `prc_purchase_orders` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 6. Canvass & Quotations (Price Matrix)
        $db->exec("CREATE TABLE IF NOT EXISTS `prc_canvass_quotations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pr_id` INT NOT NULL,
            `supplier_id` INT NOT NULL,
            `quotation_ref` VARCHAR(50) NULL,
            `quoted_amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            `is_lowest_calculated` TINYINT(1) NOT NULL DEFAULT 0,
            `status` ENUM('Received', 'Evaluated', 'Awarded', 'Disqualified') NOT NULL DEFAULT 'Received',
            `evaluated_by` VARCHAR(100) NULL,
            `remarks` TEXT NULL,
            `created_at` DATETIME NOT NULL,
            CONSTRAINT `fk_prc_canvass_pr` FOREIGN KEY (`pr_id`) REFERENCES `prc_purchase_requests` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_prc_canvass_sup` FOREIGN KEY (`supplier_id`) REFERENCES `prc_suppliers` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // Seed Initial Realistic Procurement Data
        $now = date('Y-m-d H:i:s');

        // Check if suppliers already seeded
        $cntSup = (int)Database::fetchColumn("SELECT COUNT(*) FROM `prc_suppliers`");
        if ($cntSup === 0) {
            $db->exec("INSERT INTO `prc_suppliers` 
                (`supplier_code`, `company_name`, `contact_person`, `contact_phone`, `email`, `address`, `tin_number`, `philgeps_reg_number`, `classification`, `status`, `rating`, `created_at`) 
                VALUES
                ('SUP-2026-001', 'Marinduque TechSolutions & Supplies Corp.', 'Engr. Roberto M. Tan', '0917-555-8921', 'sales@marinduquetech.ph', 'Boac Commercial Complex, Boac, Marinduque', '204-889-112-000', 'PHILGEPS-2026-88901', 'IT Equipment', 'Accredited', 4.9, '{$now}'),
                ('SUP-2026-002', 'Island Academic & Office Essentials Inc.', 'Maria Clara Santos', '0919-444-1234', 'orders@islandoffice.com.ph', 'National Highway, Gasan, Marinduque', '109-332-990-000', 'PHILGEPS-2026-77432', 'Office Supplies', 'Accredited', 4.8, '{$now}'),
                ('SUP-2026-003', 'Mimaropa Scientific Equipment & Lab Depot', 'Dr. Alvin G. Navarro', '0928-888-9012', 'info@mimaropalabs.com', 'Capitol Road, Boac, Marinduque', '312-776-554-000', 'PHILGEPS-2026-66519', 'Laboratory Equipment', 'Accredited', 5.0, '{$now}'),
                ('SUP-2026-004', 'Apex Southern Educational Furnitures', 'Carmela D. Reyes', '0935-123-7654', 'apex.furniture@gmail.com', 'Mogpog Poblacion, Marinduque', '441-229-887-000', 'PHILGEPS-2026-55410', 'Furniture & Fixtures', 'Accredited', 4.7, '{$now}');");

            // Seed Purchase Requests
            $db->exec("INSERT INTO `prc_purchase_requests` 
                (`id`, `pr_number`, `requesting_office`, `fund_source`, `purpose`, `requested_by`, `approved_by`, `priority`, `status`, `estimated_total`, `date_needed`, `created_at`) 
                VALUES
                (1, 'PR-2026-10-001', 'College of Information & Computing Sciences (CICS)', 'Special Trust Fund (STF)', 'Procurement of High-Performance Desktop Units & Managed Network Switches for CICS Computer Laboratory 3 Expansion', 'Prof. Angela Gutierrez', 'Dr. Diosdado P. Zulueta (University President)', 'High', 'Approved', 185000.00, '2026-10-25', '{$now}'),
                (2, 'PR-2026-10-002', 'Office of Student Affairs and Services (OSAS)', 'General Fund (GAA)', 'Purchase of Ergonomic Office Desks and Heavy-Duty Filing Cabinets for Student Records Archiving', 'Atty. Manuel Beltran', 'Dr. Marissa C. Mingoa (VP Administration)', 'Regular', 'Canvassing', 48500.00, '2026-11-05', '{$now}'),
                (3, 'PR-2026-10-003', 'College of Engineering & Technology', 'Fiduciary Fund', 'Procurement of Digital Multimeters, Microcontroller Kits & Soldering Stations for ECE Laboratory', 'Engr. Jayson Morales', 'Dr. Diosdado P. Zulueta (University President)', 'High', 'PO Issued', 92000.00, '2026-10-18', '{$now}'),
                (4, 'PR-2026-10-004', 'University Library System', 'General Fund (GAA)', 'Supply and Delivery of RFID Security Gate and Barcode Scanners for Boac Campus Central Library', 'Ms. Lourdes V. Fabregas', NULL, 'Regular', 'Submitted', 125000.00, '2026-11-15', '{$now}');");

            // Seed PR Items
            $db->exec("INSERT INTO `prc_pr_items` 
                (`pr_id`, `item_description`, `quantity`, `unit`, `estimated_unit_cost`, `total_cost`, `created_at`) 
                VALUES
                (1, 'Core i7 14th Gen Desktop PC, 32GB DDR5 RAM, 1TB NVMe SSD, 24-inch IPS Monitor', 3, 'sets', 55000.00, 165000.00, '{$now}'),
                (1, '24-Port Gigabit Managed Layer-2 PoE Switch with SFP Uplink', 1, 'unit', 20000.00, 20000.00, '{$now}'),
                (2, 'Steel 4-Drawer Vertical Filing Cabinet with Central Lock', 4, 'units', 8500.00, 34000.00, '{$now}'),
                (2, 'Ergonomic Mid-Back Mesh Office Chair with Lumbar Support', 5, 'units', 2900.00, 14500.00, '{$now}'),
                (3, 'Digital Storage Oscilloscope 100MHz Dual Channel', 2, 'units', 32000.00, 64000.00, '{$now}'),
                (3, 'IoT Microcontroller Trainer Kit with Sensor Bundle', 10, 'kits', 2800.00, 28000.00, '{$now}');");

            // Seed Purchase Orders
            $db->exec("INSERT INTO `prc_purchase_orders` 
                (`id`, `po_number`, `pr_id`, `supplier_id`, `po_date`, `mode_of_procurement`, `delivery_term`, `payment_term`, `total_amount`, `status`, `approved_by`, `created_at`) 
                VALUES
                (1, 'PO-2026-10-001', 1, 1, '2026-10-05', 'Small Value Procurement (Sec. 53.9)', '15 Calendar Days', 'LDDAP-ADA Government Terms', 182500.00, 'Issued', 'Dr. Diosdado P. Zulueta', '{$now}'),
                (2, 'PO-2026-09-088', 3, 3, '2026-09-28', 'Small Value Procurement (Sec. 53.9)', '30 Calendar Days', 'Check upon acceptance', 89500.00, 'Completed', 'Dr. Marissa C. Mingoa', '{$now}');");

            // Seed Inspection & Acceptance (IAR)
            $db->exec("INSERT INTO `prc_inspection_acceptance` 
                (`iar_number`, `po_id`, `invoice_number`, `inspection_date`, `inspection_status`, `inspected_by`, `asset_handover_status`, `asset_tag_generated`, `custodian_office`, `remarks`, `created_at`) 
                VALUES
                ('IAR-2026-10-001', 1, 'SI-89021', '2026-10-09', 'Inspected & Accepted', 'Engr. Kenneth P. Lim (Supply Officer III)', 'Transferred to Assets', 'AST-2026-CICS-014', 'CICS IT Laboratory 3', 'All 3 Core i7 desktop units and PoE Switch inspected, stress-tested, and tagged. Transferred to University Equipment & IT Asset Management.', '{$now}'),
                ('IAR-2026-09-042', 2, 'INV-77319', '2026-10-02', 'Inspected & Accepted', 'Maria Luisa D. Cruz (Inspection Committee Chair)', 'Transferred to Assets', 'AST-2026-ENG-089', 'College of Engineering ECE Lab', 'Complete oscilloscope units and trainer kits received in good condition. Warranty certificates catalogued.', '{$now}');");

            // Seed Canvass Quotations
            $db->exec("INSERT INTO `prc_canvass_quotations` 
                (`pr_id`, `supplier_id`, `quotation_ref`, `quoted_amount`, `is_lowest_calculated`, `status`, `evaluated_by`, `remarks`, `created_at`) 
                VALUES
                (1, 1, 'QT-2026-MTC-991', 182500.00, 1, 'Awarded', 'BAC Technical Working Group (TWG)', 'Lowest Calculated and Responsive Bidder. Full compliance with technical specs.', '{$now}'),
                (1, 2, 'QT-2026-IAO-102', 189000.00, 0, 'Evaluated', 'BAC TWG', 'Compliant with specs but higher price quotation.', '{$now}'),
                (2, 2, 'QT-2026-IAO-304', 47200.00, 1, 'Evaluated', 'BAC TWG', 'Lowest calculated quote for heavy-duty filing cabinets.', '{$now}'),
                (2, 4, 'QT-2026-APX-811', 49500.00, 0, 'Evaluated', 'BAC TWG', 'Exceeds target budget by 2%.', '{$now}');");
        }
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `prc_canvass_quotations`;");
        $db->exec("DROP TABLE IF EXISTS `prc_inspection_acceptance`;");
        $db->exec("DROP TABLE IF EXISTS `prc_purchase_orders`;");
        $db->exec("DROP TABLE IF EXISTS `prc_pr_items`;");
        $db->exec("DROP TABLE IF EXISTS `prc_purchase_requests`;");
        $db->exec("DROP TABLE IF EXISTS `prc_suppliers`;");
    }
};
