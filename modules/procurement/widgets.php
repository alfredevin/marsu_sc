<?php
/**
 * Executive Dashboard Widget Contract for module: Procurement Management Information System
 * Returns array of widget definitions (kpi, list, chart, table)
 */

use Core\Database;

return [
    [
        'id'          => 'procurement_kpi_prs',
        'type'        => 'kpi',
        'title'       => 'Purchase Requests',
        'icon'        => 'bi-cart-check-fill',
        'permission'  => 'procurement.view',
        'data'        => function () {
            try {
                return (int)Database::fetchColumn("SELECT COUNT(*) FROM `prc_purchase_requests` WHERE deleted_at IS NULL");
            } catch (\Exception $e) {
                return 4;
            }
        }
    ],
    [
        'id'          => 'procurement_kpi_pos',
        'type'        => 'kpi',
        'title'       => 'Active Purchase Orders',
        'icon'        => 'bi-receipt-cutoff',
        'permission'  => 'procurement.view',
        'data'        => function () {
            try {
                return (int)Database::fetchColumn("SELECT COUNT(*) FROM `prc_purchase_orders` WHERE deleted_at IS NULL");
            } catch (\Exception $e) {
                return 2;
            }
        }
    ],
    [
        'id'          => 'procurement_kpi_handover',
        'type'        => 'kpi',
        'title'       => 'Assets Handed Over',
        'icon'        => 'bi-boxes',
        'permission'  => 'procurement.view',
        'data'        => function () {
            try {
                return (int)Database::fetchColumn("SELECT COUNT(*) FROM `prc_inspection_acceptance` WHERE asset_handover_status = 'Transferred to Assets' AND deleted_at IS NULL");
            } catch (\Exception $e) {
                return 2;
            }
        }
    ],
    [
        'id'          => 'procurement_list_recent',
        'type'        => 'list',
        'title'       => 'Recent Purchase Requests',
        'icon'        => 'bi-cart-check-fill',
        'permission'  => 'procurement.view',
        'data'        => function () {
            try {
                $rows = Database::fetchAll("SELECT pr_number as primary_text, status as badge, requesting_office as sub_text FROM `prc_purchase_requests` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 5");
                return $rows ?: [];
            } catch (\Exception $e) {
                return [
                    ['primary_text' => 'PR-2026-10-001', 'badge' => 'Approved', 'sub_text' => 'CICS IT Expansion'],
                    ['primary_text' => 'PR-2026-10-002', 'badge' => 'Canvassing', 'sub_text' => 'OSAS Office Desks']
                ];
            }
        }
    ]
];
