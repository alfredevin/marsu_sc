-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2026 at 07:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocated_funds_tbl`
--

CREATE TABLE `allocated_funds_tbl` (
  `allocation_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `dean_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awarded_items_tbl`
--

CREATE TABLE `awarded_items_tbl` (
  `id` int(11) NOT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `awarded_price` decimal(10,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `award_date` datetime DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending PO',
  `date_awarded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `condemned_tbl`
--

CREATE TABLE `condemned_tbl` (
  `condemned_id` int(11) NOT NULL,
  `condemned_pr_id` int(11) NOT NULL,
  `condemned_by` varchar(150) DEFAULT NULL,
  `date_condemned` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dean_tbl`
--

CREATE TABLE `dean_tbl` (
  `dean_id` int(11) NOT NULL,
  `employee_no` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `d_status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL,
  `year_assigned` int(4) NOT NULL,
  `semester_assigned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dean_tbl`
--

INSERT INTO `dean_tbl` (`dean_id`, `employee_no`, `first_name`, `last_name`, `department_id`, `contact_number`, `email`, `photo`, `d_status`, `created_at`, `password`, `year_assigned`, `semester_assigned`) VALUES
(5, '0001', 'ALFRED', 'FLORES', 1, '09318543347', 'alfredzxc129@gmail.com', '69db51d570868.jpg', 1, '2026-04-12 08:03:33', '$2y$10$WbLshNn/yOvIF7nqn6POhudb9GbC2WQrcz8atfmXY3qi9ed38qqYm', 2026, 1),
(6, '7777', 'JM', 'DALIMM', 3, '123123123', 'jm@gmaul.com', '6abb6547e477b.png', 1, '2026-09-29 07:14:16', '$2y$10$8dWYUxxtXPaiaYqC6dDR7eKnWw/O.ORfK.VfcYfd1KufhRzOMtSYe', 2026, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department_tbl`
--

CREATE TABLE `department_tbl` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `dept_status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_tbl`
--

CREATE TABLE `employee_tbl` (
  `employee_id` int(11) NOT NULL,
  `employee_no` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `position_name` varchar(50) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_tbl`
--

CREATE TABLE `equipment_tbl` (
  `equipment_id` int(10) UNSIGNED NOT NULL,
  `equipment_name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inspection_items_tbl`
--

CREATE TABLE `inspection_items_tbl` (
  `id` int(11) NOT NULL,
  `iar_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `is_complete` tinyint(1) DEFAULT 1,
  `condition_status` varchar(50) DEFAULT 'Good',
  `remarks` varchar(255) DEFAULT NULL,
  `accepted_qty` int(11) DEFAULT 0,
  `rejected_qty` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inspection_report_tbl`
--

CREATE TABLE `inspection_report_tbl` (
  `iar_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `inspection_date` datetime DEFAULT current_timestamp(),
  `inspection_officer` varchar(100) DEFAULT NULL,
  `supply_officer` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_conduct_items_tbl`
--

CREATE TABLE `inventory_conduct_items_tbl` (
  `id` int(11) NOT NULL,
  `conduct_id` int(11) DEFAULT NULL,
  `issuance_item_id` int(11) DEFAULT NULL,
  `recorded_status` varchar(50) DEFAULT NULL,
  `recorded_remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_conduct_tbl`
--

CREATE TABLE `inventory_conduct_tbl` (
  `conduct_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `conducted_by` varchar(100) DEFAULT NULL,
  `date_conducted` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_items_tbl`
--

CREATE TABLE `inventory_items_tbl` (
  `inventory_items_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `date_inventory` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_tbl`
--

CREATE TABLE `inventory_tbl` (
  `inventory_id` int(11) NOT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `qty_on_hand` int(11) DEFAULT NULL,
  `unit_cost` decimal(10,2) DEFAULT NULL,
  `date_added` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_tbl`
--

INSERT INTO `inventory_tbl` (`inventory_id`, `equipment_id`, `description`, `qty_on_hand`, `unit_cost`, `date_added`) VALUES
(15, 4, NULL, 0, 3000.00, '2026-04-12 18:52:50');

-- --------------------------------------------------------

--
-- Table structure for table `issuance_items_tbl`
--

CREATE TABLE `issuance_items_tbl` (
  `id` int(11) NOT NULL,
  `issuance_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `property_number` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `inventory_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT 'Serviceable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issuance_items_tbl`
--

INSERT INTO `issuance_items_tbl` (`id`, `issuance_id`, `equipment_id`, `quantity`, `property_number`, `remarks`, `inventory_id`, `status`) VALUES
(59, 10, NULL, 1, '2026-0001', 'inuwi', 15, 'Missing'),
(60, 10, NULL, 1, '2026-0002', '', 15, 'Serviceable'),
(61, 10, NULL, 1, '2026-0003', '', 15, 'Serviceable'),
(62, 10, NULL, 1, '2026-0004', '', 15, 'Serviceable'),
(63, 10, NULL, 1, '2026-0005', 'binenta', 15, 'Missing');

-- --------------------------------------------------------

--
-- Table structure for table `issuance_tbl`
--

CREATE TABLE `issuance_tbl` (
  `issuance_id` int(11) NOT NULL,
  `tracking_no` varchar(50) DEFAULT NULL,
  `issued_to_user_id` int(11) DEFAULT NULL,
  `issued_by_user_id` int(11) DEFAULT NULL,
  `issue_date` datetime DEFAULT current_timestamp(),
  `type` varchar(20) DEFAULT 'PAR'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issuance_tbl`
--

INSERT INTO `issuance_tbl` (`issuance_id`, `tracking_no`, `issued_to_user_id`, `issued_by_user_id`, `issue_date`, `type`) VALUES
(10, 'PAR-2026-9478', 12, NULL, '2026-04-12 18:57:53', 'PAR');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `attempts_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `last_attempt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position_tbl`
--

CREATE TABLE `position_tbl` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position_tbl`
--

INSERT INTO `position_tbl` (`position_id`, `position_name`) VALUES
(1, 'ADMINISTRATIVE V'),
(2, 'ADMINISTRATIVE IV'),
(3, 'STAFF'),
(4, 'DIRECTOR'),
(5, 'SUPPLY OFFICER'),
(6, 'INSPECTOR');

-- --------------------------------------------------------

--
-- Table structure for table `ppmp_items_tbl`
--

CREATE TABLE `ppmp_items_tbl` (
  `id` int(11) NOT NULL,
  `ppmp_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `custom_item_name` varchar(255) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `is_issued` tinyint(1) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppmp_tbl`
--

CREATE TABLE `ppmp_tbl` (
  `ppmp_id` int(11) NOT NULL,
  `dean_id` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `reason` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `grand_total` decimal(10,2) DEFAULT NULL,
  `rfq_no` varchar(50) DEFAULT NULL,
  `rfq` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_issue_reports_tbl`
--

CREATE TABLE `property_issue_reports_tbl` (
  `report_id` int(11) NOT NULL,
  `issuance_item_id` int(11) NOT NULL COMMENT 'ID ng item galing sa issuance_items_tbl',
  `reported_by_id` int(11) NOT NULL COMMENT 'ID ng employee na nag-report',
  `issue_type` varchar(50) NOT NULL COMMENT 'Missing or For Condemn',
  `description` text NOT NULL COMMENT 'Remarks or Reason',
  `date_incident` date NOT NULL,
  `report_status` varchar(20) DEFAULT 'Pending' COMMENT 'Pending, Verified, Approved',
  `date_reported` datetime DEFAULT current_timestamp(),
  `admin_remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pr_tbl`
--

CREATE TABLE `pr_tbl` (
  `pr_property_id` int(11) NOT NULL,
  `property_number` varchar(100) NOT NULL,
  `item_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `issued_date` date DEFAULT curdate(),
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_tbl`
--

CREATE TABLE `purchase_order_tbl` (
  `po_id` int(11) NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `po_date` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) DEFAULT NULL,
  `delivery_receipt_no` varchar(50) DEFAULT NULL,
  `date_received` datetime DEFAULT NULL,
  `received_by` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending Delivery'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request_items_tbl`
--

CREATE TABLE `purchase_request_items_tbl` (
  `item_id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `tracking_number` varchar(50) NOT NULL,
  `delivered_qty` int(11) DEFAULT 0,
  `dean_id` int(11) DEFAULT NULL,
  `pr_item_status` int(11) NOT NULL DEFAULT 1,
  `issued_qty` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `inserted_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request_tbl`
--

CREATE TABLE `purchase_request_tbl` (
  `pr_id` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `grand_total` decimal(12,2) NOT NULL,
  `tracking_number` varchar(50) NOT NULL,
  `received_by` varchar(50) DEFAULT NULL,
  `received_date` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `inspected_by` varchar(255) DEFAULT NULL,
  `inspected_date` date DEFAULT NULL,
  `dean_id` int(11) DEFAULT NULL,
  `purchase_request_status` int(11) NOT NULL DEFAULT 1,
  `issued_by` varchar(50) DEFAULT NULL,
  `issued_date` varchar(50) DEFAULT NULL,
  `supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rfq_items_tbl`
--

CREATE TABLE `rfq_items_tbl` (
  `id` int(11) NOT NULL,
  `token_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `offered_price` decimal(10,2) DEFAULT 0.00,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rfq_tokens_tbl`
--

CREATE TABLE `rfq_tokens_tbl` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `date_sent` datetime DEFAULT current_timestamp(),
  `tin` varchar(50) DEFAULT NULL,
  `philgeps_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_tbl`
--

CREATE TABLE `supplier_tbl` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_tbl`
--

CREATE TABLE `unit_tbl` (
  `unit_id` int(10) UNSIGNED NOT NULL,
  `unit_name` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userlogs_tbl`
--

CREATE TABLE `userlogs_tbl` (
  `log_id` int(11) NOT NULL,
  `userid` int(2) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `login_time` timestamp NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `userid` int(11) NOT NULL,
  `fullname` varchar(30) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `usertype` int(1) DEFAULT NULL,
  `useractive` int(1) DEFAULT 1,
  `dateCreated` timestamp NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `contact_number` varchar(20) NOT NULL,
  `position` varchar(255) NOT NULL,
  `code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`userid`, `fullname`, `email`, `username`, `password`, `usertype`, `useractive`, `dateCreated`, `dateUpdated`, `contact_number`, `position`, `code`) VALUES
(1, 'HANNA', 'hanna@gmail.com', 'admin', '$2y$10$lndV.03jhnHofxp0f7bzL.V08RKTMHkK8wzBIHBUZUAwlfkBJqlam', 1, 1, '2024-02-28 01:18:05', '2025-11-19 22:02:57', '09215813119', 'REGISTRAR', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocated_funds_tbl`
--
ALTER TABLE `allocated_funds_tbl`
  ADD PRIMARY KEY (`allocation_id`),
  ADD KEY `dean_id` (`dean_id`);

--
-- Indexes for table `awarded_items_tbl`
--
ALTER TABLE `awarded_items_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `condemned_tbl`
--
ALTER TABLE `condemned_tbl`
  ADD PRIMARY KEY (`condemned_id`);

--
-- Indexes for table `dean_tbl`
--
ALTER TABLE `dean_tbl`
  ADD PRIMARY KEY (`dean_id`),
  ADD UNIQUE KEY `employee_no` (`employee_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `department_tbl`
--
ALTER TABLE `department_tbl`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_no` (`employee_no`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `equipment_tbl`
--
ALTER TABLE `equipment_tbl`
  ADD PRIMARY KEY (`equipment_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `inspection_items_tbl`
--
ALTER TABLE `inspection_items_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspection_report_tbl`
--
ALTER TABLE `inspection_report_tbl`
  ADD PRIMARY KEY (`iar_id`);

--
-- Indexes for table `inventory_conduct_items_tbl`
--
ALTER TABLE `inventory_conduct_items_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_conduct_tbl`
--
ALTER TABLE `inventory_conduct_tbl`
  ADD PRIMARY KEY (`conduct_id`);

--
-- Indexes for table `inventory_items_tbl`
--
ALTER TABLE `inventory_items_tbl`
  ADD PRIMARY KEY (`inventory_items_id`);

--
-- Indexes for table `inventory_tbl`
--
ALTER TABLE `inventory_tbl`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `issuance_items_tbl`
--
ALTER TABLE `issuance_items_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuance_tbl`
--
ALTER TABLE `issuance_tbl`
  ADD PRIMARY KEY (`issuance_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`attempts_id`);

--
-- Indexes for table `position_tbl`
--
ALTER TABLE `position_tbl`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `ppmp_items_tbl`
--
ALTER TABLE `ppmp_items_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ppmp_tbl`
--
ALTER TABLE `ppmp_tbl`
  ADD PRIMARY KEY (`ppmp_id`);

--
-- Indexes for table `property_issue_reports_tbl`
--
ALTER TABLE `property_issue_reports_tbl`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `pr_tbl`
--
ALTER TABLE `pr_tbl`
  ADD PRIMARY KEY (`pr_property_id`),
  ADD UNIQUE KEY `property_number` (`property_number`);

--
-- Indexes for table `purchase_order_tbl`
--
ALTER TABLE `purchase_order_tbl`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `purchase_request_items_tbl`
--
ALTER TABLE `purchase_request_items_tbl`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `purchase_request_tbl`
--
ALTER TABLE `purchase_request_tbl`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `rfq_items_tbl`
--
ALTER TABLE `rfq_items_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rfq_tokens_tbl`
--
ALTER TABLE `rfq_tokens_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_tbl`
--
ALTER TABLE `supplier_tbl`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `unit_tbl`
--
ALTER TABLE `unit_tbl`
  ADD PRIMARY KEY (`unit_id`),
  ADD UNIQUE KEY `unit_name` (`unit_name`);

--
-- Indexes for table `userlogs_tbl`
--
ALTER TABLE `userlogs_tbl`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocated_funds_tbl`
--
ALTER TABLE `allocated_funds_tbl`
  MODIFY `allocation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `awarded_items_tbl`
--
ALTER TABLE `awarded_items_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `condemned_tbl`
--
ALTER TABLE `condemned_tbl`
  MODIFY `condemned_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dean_tbl`
--
ALTER TABLE `dean_tbl`
  MODIFY `dean_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department_tbl`
--
ALTER TABLE `department_tbl`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `equipment_tbl`
--
ALTER TABLE `equipment_tbl`
  MODIFY `equipment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inspection_items_tbl`
--
ALTER TABLE `inspection_items_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `inspection_report_tbl`
--
ALTER TABLE `inspection_report_tbl`
  MODIFY `iar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inventory_conduct_items_tbl`
--
ALTER TABLE `inventory_conduct_items_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventory_conduct_tbl`
--
ALTER TABLE `inventory_conduct_tbl`
  MODIFY `conduct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_items_tbl`
--
ALTER TABLE `inventory_items_tbl`
  MODIFY `inventory_items_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_tbl`
--
ALTER TABLE `inventory_tbl`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `issuance_items_tbl`
--
ALTER TABLE `issuance_items_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `issuance_tbl`
--
ALTER TABLE `issuance_tbl`
  MODIFY `issuance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `attempts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `position_tbl`
--
ALTER TABLE `position_tbl`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ppmp_items_tbl`
--
ALTER TABLE `ppmp_items_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ppmp_tbl`
--
ALTER TABLE `ppmp_tbl`
  MODIFY `ppmp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `property_issue_reports_tbl`
--
ALTER TABLE `property_issue_reports_tbl`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pr_tbl`
--
ALTER TABLE `pr_tbl`
  MODIFY `pr_property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `purchase_order_tbl`
--
ALTER TABLE `purchase_order_tbl`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_request_items_tbl`
--
ALTER TABLE `purchase_request_items_tbl`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_request_tbl`
--
ALTER TABLE `purchase_request_tbl`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rfq_items_tbl`
--
ALTER TABLE `rfq_items_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `rfq_tokens_tbl`
--
ALTER TABLE `rfq_tokens_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `supplier_tbl`
--
ALTER TABLE `supplier_tbl`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `unit_tbl`
--
ALTER TABLE `unit_tbl`
  MODIFY `unit_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userlogs_tbl`
--
ALTER TABLE `userlogs_tbl`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allocated_funds_tbl`
--
ALTER TABLE `allocated_funds_tbl`
  ADD CONSTRAINT `allocated_funds_tbl_ibfk_1` FOREIGN KEY (`dean_id`) REFERENCES `dean_tbl` (`dean_id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD CONSTRAINT `employee_tbl_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department_tbl` (`department_id`);

--
-- Constraints for table `equipment_tbl`
--
ALTER TABLE `equipment_tbl`
  ADD CONSTRAINT `equipment_tbl_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `unit_tbl` (`unit_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
