<?php
$current_page = basename($_SERVER['PHP_SELF'], '.php');

?>
<style>
    .sidebar-nav .nav-link.collapsed {
        color: #333333 !important;
        /* Light Green for Collapsed Links */
    }

    .sidebar-nav .nav-link:not(.collapsed) {
        color: #4FC3F7 !important;
        /* Yellow for Expanded Links */
    }
</style>
<aside id="sidebar" class="sidebar" style="background:#F5F5F5;">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link  <?php echo ($current_page == 'index') ? '' : 'collapsed'; ?>" href="index"
                style="background:#F5F5F5;color:white;">
                <i class="bi bi-grid" style="color:#333333;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <?php if (isset($_SESSION['userid'])): ?>
            <hr style="color:white;">

            <li class="nav-heading" style="color:#333333;">Manage</li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'admin_consolidate' || $current_page == 'rfq' || $current_page == 'admin_app_tracking' || $current_page == 'supplier_rfq' || $current_page == 'view_items_for_recieve') ? '' : 'collapsed'; ?>"
                    data-bs-target="#listPPMP" data-bs-toggle="collapse" href="#" style="background:#F5F5F5; color:white;">
                    <i class="bi bi-calendar-check" style="color:#333333;"></i><span>Procurement</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="listPPMP"
                    class="nav-content collapse <?php echo ($current_page == 'admin_consolidate' || $current_page == 'admin_app_tracking' || $current_page == 'rfq' || $current_page == 'supplier_rfq') ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="admin_consolidate" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>PPMP/APP</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin_pr_list" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>  Purchase Records</span>
                        </a>
                    </li>
                    <li>
                        <a href="rfq" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>PR/RFQ</span>
                        </a>
                    </li>
                    <li>
                        <a href="supplier_rfq" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Supplier RFQ</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin_po" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Purchased Order</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin_app_tracking" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>APP Document Tracking</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'admin_receiving' || $current_page == 'admin_returns' || $current_page == 'admin_inspection' || $current_page == 'for_inspection' || $current_page == 'view_items_for_recieve' || $current_page == 'for_received_purchase_order' || $current_page == 'view_item_for_inspection' || $current_page == 'admin_inspection_form' || $current_page == 'view_pr_items' || $current_page == 'today_appointments' || $current_page == 'appointment_history') ? '' : 'collapsed'; ?>"
                    data-bs-target="#appointmentMenu" data-bs-toggle="collapse" href="#"
                    style="background:#F5F5F5; color:white;">
                    <i class="bi bi-calendar-check" style="color:#333333;"></i><span>Purchase Order</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="appointmentMenu"
                    class="nav-content collapse <?php echo ($current_page == 'admin_receiving' || $current_page == 'admin_returns' || $current_page == 'admin_inspection' || $current_page == 'view_items_for_recieve' || $current_page == 'for_received_purchase_order' || $current_page == 'view_item_for_inspection' || $current_page == 'for_inspection' || $current_page == 'view_pr_items' || $current_page == 'admin_inspection_form' || $current_page == 'today_appointments' || $current_page == 'appointment_history') ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">
                    <!-- <li>
                        <a href="add_purchase" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span> Purchase Order</span>
                        </a>
                    </li>

                    <li>
                        <a href="pending_purchase_request" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Pending Purchase Request</span>
                        </a>
                    </li>
                    <li>
                        <a href="for_received_purchase_order" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>For Received Purchase Order </span>
                        </a>
                    </li>
                    <li>
                        <a href="for_inspection" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>For Inspection Purchase Request</span>
                        </a>
                    </li>
                    <li>
                        <a href="completed_purchase_order" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Completed Purchase Order</span>
                        </a>
                    </li> -->

                    <li>
                        <a href="admin_receiving" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>For Recieve Purchase Order</span>
                        </a>
                    </li>

                    <li>
                        <a href="admin_inspection" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>For Inspection </span>
                        </a>
                    </li>
                    <li>
                        <a href="admin_returns" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>For Returned Order </span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'admin_inventory' || $current_page == 'admin_issuance_list' || $current_page == 'admin_issued_items' || $current_page == 'admin_issuance') ? '' : 'collapsed'; ?>"
                    data-bs-target="#issuance" data-bs-toggle="collapse" href="#" style="background:#F5F5F5; color:white;">
                    <i class="bi bi-calendar-check" style="color:#333333;"></i><span>Issuance</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="issuance"
                    class="nav-content collapse <?php echo ($current_page == 'admin_inventory' || $current_page == 'admin_issuance_list' || $current_page == 'admin_issued_items' || $current_page == 'admin_issuance') ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="admin_inventory" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Items Stocks</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin_issuance_list" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Issuance Items </span>
                        </a>
                    </li>
                    <li>
                        <a href="admin_issued_items" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Issued Items</span>
                        </a>
                    </li>



                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link  <?php echo ($current_page == 'employee_list') ? '' : 'collapsed'; ?>"
                    href="employee_list" style="background:#F5F5F5;color:white;">
                    <i class="bi bi-people" style="color:#333333;"></i>
                    <span>Employee List</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link  <?php echo ($current_page == 'par') ? '' : 'collapsed'; ?>" href="par"
                    style="background:#F5F5F5;color:white;">
                    <i class="bi bi-person" style="color:#333333;"></i>
                    <span>Property Acknowledgement Report</span>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'for_issuance_item' || $current_page == 'add_new_requisition' || $current_page == 'issued_items') ? '' : 'collapsed'; ?>" data-bs-target="#requisition" data-bs-toggle="collapse" href="#" style="background:#F5F5F5; color:white;">
                    <i class="bi bi-file" style="color:#333333;"></i><span>Requisition Slip</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="requisition" class="nav-content collapse <?php echo ($current_page == 'for_issuance_item' || $current_page == 'add_new_requisition' || $current_page == 'issued_items') ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="add_new_requisition" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Add New Requisition</span>
                        </a>
                    </li>
                    <li>
                        <a href="for_issuance_item" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>For Issuance Items</span>
                        </a>
                    </li>
                    <li>
                        <a href="issued_items" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>List of Items Issued</span>
                        </a>
                    </li>

                </ul>
            </li> -->

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'list_supply' || $current_page == 'list_equipment' || $current_page == 'view_inventory') ? '' : 'collapsed'; ?>"
                    data-bs-target="#property" data-bs-toggle="collapse" href="#" style="background:#F5F5F5; color:white;">
                    <i class="bi bi-calendar-check" style="color:#333333;"></i><span>Issued Items</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="property"
                    class="nav-content collapse <?php echo ($current_page == 'list_supply' || $current_page == 'list_equipment' || $current_page == 'view_inventory') ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="list_supply" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Issued Supply</span>
                        </a>
                    </li>
                    <li>
                        <a href="list_equipment" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Issued Equipment</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link  <?php echo ($current_page == 'property_monitoring') ? '' : 'collapsed'; ?>"
                    href="property_monitoring" style="background:#F5F5F5;color:white;">
                    <i class="bi bi-person" style="color:#333333;"></i>
                    <span>Property Monitoring List</span>
                </a>
            </li>
            <!-- 

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'serviceable' || $current_page == 'missing' || $current_page == 'forCondemn' || $current_page == 'condemned') ? '' : 'collapsed'; ?>" data-bs-target="#equipment_status" data-bs-toggle="collapse" href="#" style="background:#F5F5F5; color:white;">
                    <i class="bi bi-folder" style="color:#333333;"></i><span>Equipment Status</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="equipment_status" class="nav-content collapse <?php echo ($current_page == 'serviceable' || $current_page == 'missing' || $current_page == 'condemned' || $current_page == 'forCondemn') ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="serviceable" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Serviceable Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="missing" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Missing Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="forCondemn" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>For Condemn Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="condemned" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span> Condemned Equipment</span>
                        </a>
                    </li>
                </ul>
            </li> -->

            <!-- <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'newInventory' || $current_page == 'inventoryHistory') ? '' : 'collapsed'; ?>" data-bs-target="#inventory" data-bs-toggle="collapse" href="#" style="background:#F5F5F5; color:white;">
                    <i class="bi bi-calendar" style="color:#333333;"></i><span>Inventory</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="inventory" class="nav-content collapse <?php echo ($current_page == 'newInventory' || $current_page == 'inventoryHistory') ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="newInventory" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>New Inventory</span>
                        </a>
                    </li>
                    <li>
                        <a href="inventoryHistory" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Inventory History</span>
                        </a>
                    </li>

                </ul>
            </li> -->


            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'admin_conduct_inventory' || $current_page == 'inventoryHistory') ? '' : 'collapsed'; ?>"
                    data-bs-target="#inventory" data-bs-toggle="collapse" href="#" style="background:#F5F5F5; color:white;">
                    <i class="bi bi-calendar" style="color:#333333;"></i><span>Inventory</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="inventory"
                    class="nav-content collapse <?php echo ($current_page == 'admin_conduct_inventory' || $current_page == 'inventoryHistory') ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="admin_conduct_inventory" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Conduct Inventory</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin_inventory_history" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Inventory History</span>
                        </a>
                    </li>

                </ul>
            </li>
            <!-- <hr style="color:white;">

            <li class="nav-heading" style="color:#333333;">Report</li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'obgyn_checkup_report' || $current_page == 'obgyn_ultrasound_report' || $current_page == 'general_checK_up_report'
                    || $current_page == 'pap_smear_report'
                    || $current_page == 'medical_list_report'
                    || $current_page == 'patient_list_report'
                ) ? '' : 'collapsed'; ?>" data-bs-target="#report" data-bs-toggle="collapse" href="#" style="background:#F5F5F5;color:white;">
                    <i class="bi bi-folder " style="color:#333333;"></i><span>Report List</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="report" class="nav-content collapse  <?php echo ($current_page == 'obgyn_checkup_report' || $current_page == 'obgyn_ultrasound_report' || $current_page == 'general_checK_up_report'
                    || $current_page == 'pap_smear_report'
                    || $current_page == 'medical_list_report'
                    || $current_page == 'patient_list_report'
                ) ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="404.html" class="" style="color:#333333;">
                            <i class="bi bi-circle " style="color:#333333;"></i><span>On Going Report</span>
                        </a>
                    </li>
                    <li>
                </ul>
            </li> -->

            <li class="nav-item">
                <a class="nav-link  <?php echo ($current_page == 'admin_manage_reports') ? '' : 'collapsed'; ?>"
                    href="admin_manage_reports" style="background:#F5F5F5;color:white;">
                    <i class="bi bi-folder" style="color:#333333;"></i>
                    <span>Reported Equipment</span>
                </a>
            </li>
            <hr style="color:white;">

            <li class="nav-heading" style="color:#333333;">Maintenace</li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'addEmployee' || $current_page == 'fund' || $current_page == 'unit' || $current_page == 'isuppliernspector' || $current_page == 'position' || $current_page == 'addDean' || $current_page == 'add_supply' || $current_page == 'add_equipment' || $current_page == 'department' || $current_page == 'changepassword') ? '' : 'collapsed'; ?>"
                    data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#" style="background:#F5F5F5;color:white;">
                    <i class="bi bi-menu-button-wide " style="color:#333333;"></i><span>Settings</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="icons-nav"
                    class="nav-content collapse  <?php echo ($current_page == 'fund' || $current_page == 'addEmployee' || $current_page == 'addDean' || $current_page == 'add_supply' || $current_page == 'supplier' || $current_page == 'add_equipment' || $current_page == 'unit' || $current_page == 'position' || $current_page == 'department' || $current_page == 'changepassword') ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="fund" class="" style="color:#333333;">
                            <i class="bi bi-circle " style="color:#333333;"></i><span>Add Allocated Fund</span>
                        </a>
                    </li>

                    <li>
                        <a href="addEmployee" class="" style="color:#333333;">
                            <i class="bi bi-circle " style="color:#333333;"></i><span>Add Employee</span>
                        </a>
                    </li>

                    <li>
                        <a href="addDean" class="" style="color:#333333;">
                            <i class="bi bi-circle " style="color:#333333;"></i><span>Add Department Head</span>
                        </a>
                    </li>
                    <li>
                        <a href="unit" class="" style="color:#333333;">
                            <i class="bi bi-circle " style="color:#333333;"></i><span>Unit Type</span>
                        </a>
                    </li>
                    <li>
                        <a href="supplier" class="" style="color:#333333;">
                            <i class="bi bi-circle " style="color:#333333;"></i><span>Add Supplier</span>
                        </a>
                    </li>
                    <li>
                        <a href="position" class="" style="color:#333333;">
                            <i class="bi bi-circle " style="color:#333333;"></i><span>Add Position</span>
                        </a>
                    </li>
                    <li>
                        <a href="department" class="" style="color:#333333;">
                            <i class="bi bi-circle " style="color:#333333;"></i><span>Add Department</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="add_supply" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Add Supply</span>
                        </a>
                    </li> -->

                    <li>
                        <a href="add_equipment" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Add Equipment/Supply</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="changepassword" class="" style="color:#333333;">
                            <i class="bi bi-circle " style="color:#333333;"></i><span>Change Password</span>
                        </a>
                    </li> -->
                </ul>
            </li>
        <?php elseif (isset($_SESSION['dean_id'])): ?>
            <hr style="color:white;">

            <li class="nav-heading" style="color:#333333;">Manage</li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'crete_ppmp' || $current_page == 'ppmp_history') ? '' : 'collapsed'; ?>"
                    data-bs-target="#ppmp" data-bs-toggle="collapse" href="#" style="background:#F5F5F5; color:white;">
                    <i class="bi bi-calendar-check" style="color:#333333;"></i><span>PPMP</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="ppmp"
                    class="nav-content collapse <?php echo ($current_page == 'create_ppmp' || $current_page == 'ppmp_history') ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="create_ppmp" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Create A PPMP</span>
                        </a>
                    </li>
                    <li>
                        <a href="ppmp_history" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>List of PPMP Created</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?php echo ($current_page == 'dean_my_accountability') ? '' : 'collapsed'; ?>"
                    href="dean_my_accountability" style="background:#F5F5F5;color:white;">
                    <i class="bi bi-person" style="color:#333333;"></i>
                    <span>Property Monitoring List</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?php echo ($current_page == 'par') ? '' : 'collapsed'; ?>" href="par"
                    style="background:#F5F5F5;color:white;">
                    <i class="bi bi-file" style="color:#333333;"></i>
                    <span>Property Acknowledgement Report</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?php echo ($current_page == 'dean_equipment_status') ? '' : 'collapsed'; ?>"
                    href="dean_equipment_status" style="background:#F5F5F5;color:white;">
                    <i class="bi bi-folder" style="color:#333333;"></i>
                    <span>Department Equipment Status</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?php echo ($current_page == 'dean_manage_reports') ? '' : 'collapsed'; ?>"
                    href="dean_manage_reports" style="background:#F5F5F5;color:white;">
                    <i class="bi bi-folder" style="color:#333333;"></i>
                    <span>Reported Equipment Status</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link  <?php echo ($current_page == 'dean_equipment_reported') ? '' : 'collapsed'; ?>" href="dean_equipment_reported" style="background:#F5F5F5;color:white;">
                    <i class="bi bi-file" style="color:#333333;"></i>
                    <span> Equipment Status Report</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'add_purchase' || $current_page == 'view_completed_purchase_order' || $current_page == 'completed_purchase_request' || $current_page == 'for_inspection' || $current_page == 'approved_purchase_request' || $current_page == 'view_item_for_inspection' || $current_page == 'pending_purchase_request' || $current_page == 'view_pr_items') ? '' : 'collapsed'; ?>" data-bs-target="#appointmentMenu" data-bs-toggle="collapse" href="#" style="background:#F5F5F5; color:white;">
                    <i class="bi bi-calendar-check" style="color:#333333;"></i><span>Purchase Request</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="appointmentMenu" class="nav-content collapse <?php echo ($current_page == 'add_purchase' || $current_page == 'view_completed_purchase_order' || $current_page == 'completed_purchase_request' || $current_page == 'approved_purchase_request' || $current_page == 'view_item_for_inspection' || $current_page == 'for_inspection' || $current_page == 'view_pr_items' || $current_page == 'pending_purchase_request') ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="add_purchase" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Add Purchase Request</span>
                        </a>
                    </li>
                    <li>
                        <a href="pending_purchase_request" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Pending Purchase Request</span>
                        </a>
                    </li>
                    <li>
                        <a href="approved_purchase_request" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Approved Purchase Request</span>
                        </a>
                    </li>
                    <li>
                        <a href="completed_purchase_request" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Completed Purchase Request</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'serviceable' || $current_page == 'missing' || $current_page == 'forCondemn' || $current_page == 'condemned') ? '' : 'collapsed'; ?>" data-bs-target="#equipment_status" data-bs-toggle="collapse" href="#" style="background:#F5F5F5; color:white;">
                    <i class="bi bi-folder" style="color:#333333;"></i><span>Equipment Status</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="equipment_status" class="nav-content collapse <?php echo ($current_page == 'serviceable' || $current_page == 'missing' || $current_page == 'forCondemn' || $current_page == 'condemned') ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="serviceable" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Available Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="missing" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Missing Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="forCondemn" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>For Condemn Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="condemned" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span> Condemned Equipment</span>
                        </a>
                    </li>
                </ul>
            </li> -->
        <?php elseif (isset($_SESSION['employee_id'])): ?>
            <hr style="color:white;">

            <li class="nav-heading" style="color:#333333;">Manage</li>


            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'myEquipment' || $current_page == 'issuedItems') ? '' : 'collapsed'; ?>"
                    data-bs-target="#appointmentMenu" data-bs-toggle="collapse" href="#"
                    style="background:#F5F5F5; color:white;">
                    <i class="bi bi-calendar-check" style="color:#333333;"></i><span>My Property</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="appointmentMenu"
                    class="nav-content collapse <?php echo ($current_page == 'myEquipment' || $current_page == 'issuedItems') ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="myEquipment" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>List of my Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="issuedItems" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>List of Issued Items</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'serviceableEquipment' || $current_page == 'missingEquipment' || $current_page == 'forCondemned' || $current_page == 'condemned') ? '' : 'collapsed'; ?>" data-bs-target="#equipment_status" data-bs-toggle="collapse" href="#" style="background:#F5F5F5; color:white;">
                    <i class="bi bi-folder" style="color:#333333;"></i><span>Equipment Status</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="equipment_status" class="nav-content collapse <?php echo ($current_page == 'serviceableEquipment' || $current_page == 'missingEquipment' || $current_page == 'forCondemned' || $current_page == 'condemned') ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="serviceableEquipment" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Serviceable Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="missingEquipment" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>Missing Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="forCondemned" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span>For Condemn Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="condemned" class="" style="color:#333333;">
                            <i class="bi bi-circle" style="color:#333333;"></i><span> Condemned Equipment</span>
                        </a>
                    </li>
                </ul>
            </li> -->

        <?php endif; ?>
    </ul>

</aside>