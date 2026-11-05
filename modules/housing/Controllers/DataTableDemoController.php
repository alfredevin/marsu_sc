<?php

namespace Modules\Housing\Controllers;

use Core\View;
use Core\Auth;

/**
 * SAMPLE CONTROLLER: DataTable Demo
 *
 * Static sample data lang ito para makita kung paano gumagana ang
 * shared DataTable helper (modules/_shared/datatable.php).
 * Sa totoong page, palitan ng Database::fetchAll(...).
 */
class DataTableDemoController
{
    public function index(): void
    {
        $firstNames = ['Juan', 'Maria', 'Jose', 'Ana', 'Pedro', 'Liza', 'Mark', 'Grace', 'Paolo', 'Rica'];
        $lastNames  = ['Dela Cruz', 'Santos', 'Reyes', 'Garcia', 'Mendoza', 'Bautista', 'Villanueva', 'Ramos'];
        $houses     = ['Boac Dormitel', 'Sta. Cruz Lodge', 'Gasan Residences', 'Mogpog Inn', 'Torrijos Homes'];
        $statuses   = ['active', 'pending', 'moved_out'];

        // Sample tenants (35 rows para makita ang pagination)
        $tenants = [];
        for ($i = 1; $i <= 35; $i++) {
            $tenants[] = [
                'id'         => $i,
                'name'       => $firstNames[$i % count($firstNames)] . ' ' . $lastNames[$i % count($lastNames)],
                'house'      => $houses[$i % count($houses)],
                'room'       => 'Room ' . (100 + ($i * 7) % 50),
                'rent'       => 1500 + ($i * 137) % 2500,
                'status'     => $statuses[$i % count($statuses)],
                'created_at' => date('Y-m-d H:i:s', strtotime("-{$i} days")),
            ];
        }

        // Sample rooms (pangalawang table, may sariling search input)
        $rooms = [];
        foreach ($houses as $h => $house) {
            for ($r = 1; $r <= 3; $r++) {
                $rooms[] = [
                    'house'    => $house,
                    'room'     => 'Room ' . ($h + 1) . '0' . $r,
                    'capacity' => 2 + ($r % 3),
                    'occupied' => ($h + $r) % 4,
                ];
            }
        }

        View::render('housing/Views/datatable_demo', [
            'title'      => 'DataTable Demo',
            'moduleName' => 'Housing (ISHAMIS)',
            'slug'       => 'housing',
            'user'       => Auth::user(),
            'tenants'    => $tenants,
            'rooms'      => $rooms,
            'crumbs'     => [
                'Housing (ISHAMIS)' => url('housing'),
                'DataTable Demo'    => ''
            ]
        ]);
    }
}
