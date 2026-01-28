<?php

return [
    'menus' => [
        [
            'title' => 'Dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'route' => 'dashboard', // path url
            'roles' => ['',], // siapa saja yang bisa lihat
        ],
        [
            'title' => 'Database',
            'icon' => 'fas fa-database',
            'roles' => ['',],
            'submenu' => [
                ['title' => 'Data karyawan', 'route' => 'karyawan'],
                ['title' => 'Data Admin', 'route' => 'admin'],
            ]
        ],
        [
            'title' => 'Contoh menu',
            'icon' => 'fas fa-graduation-cap',
            'roles' => ['',],
            'submenu' => [
                ['title' => 'Menu Level 2', 'route' => '#'],
                [
                    'title' => 'Menu Level 2 (Tree)',
                    'child' => [
                        ['title' => 'Menu 1', 'route' => '#'],
                        ['title' => 'Menu 2', 'route' => '#'],
                    ]
                ]
            ]
        ],
    ]
];