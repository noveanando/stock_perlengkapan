<?php

return [
    'account' => [
        'table' => 'users',
        'widthTable' => [null, '140', '87', '89'],
        'labelTable' => ['Nama', 'Peran', 'Status', 'Dibuat'],
        'selectTable' => ['name', 'role_name', 'users.status as status', 'users.created_at as created_at', 'users.id as id'],
        'where' => [['users.id', '!=', '1']],
        'join' => ['table' => 'roles', 'relation' => ['users.role_id', 'roles.id']],
        // 'orderBy' => ['name','asc'],
        'filter' => [
            'table' => ['name', 'role_id', 'users.status as status'],
            'label' => ['nama', 'Peran', 'Status'],
            'between' => [
                [
                    'label' => 'Tanggal Pembuatan',
                    'column' => 'users.created_at',
                    'value' => ['start_date' => 'Mulai Tanggal', 'end_date' => 'Sampai Tanggal'],
                ],
            ],
        ],
        'customLabel' => [
            [
                'label' => 'Status',
                'template' => [
                    '0' => ['html' => '<label class="label label-default">Tidak Aktif</label>'],
                    '1' => ['html' => '<label class="label label-success">Aktif</label>'],
                ],
            ], [
                'label' => 'Dibuat',
                'template' => 'datetime',
            ],
        ],
    ],
    'role' => [
        'table' => 'roles',
        'widthTable' => [null, '87'],
        'labelTable' => ['Nama Peran', 'Status'],
        'selectTable' => ['role_name', 'status', 'id'],
        'where' => [['id', '!=', '1']],
        'join' => [],
        'filter' => ['table' => ['role_name', 'status'], 'label' => ['role_name', 'Status']],
        'customLabel' => [
            [
                'label' => 'Status',
                'template' => [
                    '0' => ['html' => '<label class="label label-default">Tidak Aktif</label>'],
                    '1' => ['html' => '<label class="label label-success">Aktif</label>'],
                ],
            ],
        ],
    ],
    'handle-image' => [
        'table' => 'settings',
        'widthTable' => [null, '87'],
        'labelTable' => ['Nama', 'Status'],
        'selectTable' => ['key', 'status', 'id'],
        'where' => [['type', '=', '"handle-image"']],
        'join' => [],
        'filter' => ['table' => ['key'], 'label' => ['key']],
        'customLabel' => [
            [
                'label' => 'Status',
                'template' => [
                    '0' => ['html' => '<label class="label label-default">Tidak Aktif</label>'],
                    '1' => ['html' => '<label class="label label-success">Aktif</label>'],
                ],
            ],
        ],
    ],
    'log' => [
        'table' => 'logs',
        'widthTable' => [null, '350', '120', '89'],
        'labelTable' => ['Keterangan', 'Catatan', 'Pengguna', 'Waktu'],
        'selectTable' => ['description', 'extra_description', 'users.name as name', 'logs.created_at as created_at', 'logs.id as id'],
        'where' => [],
        'join' => ['table' => 'users', 'relation' => ['logs.user_id', 'users.id']],
        'filter' => ['table' => ['description'], 'label' => ['description']],
        'customLabel' => [
            [
                'label' => 'Waktu',
                'template' => 'datetime',
            ],
        ],
    ],
    'category' => [
        'table' => 'categories',
        'widthTable' => [null, '200', '87'],
        'labelTable' => ['Nama Kategori', 'Kelompok', 'Status'],
        'selectTable' => ['categories.category_name as category_name', 'ca.category_name as group', 'categories.category_status as category_status', 'categories.id as id'],
        'where' => [],
        'join' => ['table' => 'categories as ca', 'relation' => ['categories.parent_id', 'ca.id']],
        'filter' => ['table' => ['categories.category_name', 'categories.category_status as category_status'], 'label' => ['categories.category_name', 'Status']],
        'customLabel' => [
            [
                'label' => 'Status',
                'template' => [
                    '0' => ['html' => '<label class="label label-default">Tidak Aktif</label>'],
                    '1' => ['html' => '<label class="label label-success">Aktif</label>'],
                ],
            ],
        ],
    ],
    'location' => [
        'table' => 'locations',
        'widthTable' => [null, '200', '87'],
        'labelTable' => ['Nama Lokasi', 'Group', 'Status'],
        'selectTable' => ['locations.location_name as location_name', 'la.location_name as group', 'locations.location_status as location_status', 'locations.id as id'],
        'where' => [],
        'join' => ['table' => 'locations as la', 'relation' => ['locations.parent_id', 'la.id']],
        'filter' => ['table' => ['locations.location_name', 'locations.location_status as location_status'], 'label' => ['item_name', 'Status']],
        'customLabel' => [
            [
                'label' => 'Status',
                'template' => [
                    '0' => ['html' => '<label class="label label-default">Tidak Aktif</label>'],
                    '1' => ['html' => '<label class="label label-success">Aktif</label>'],
                ],
            ],
        ],
    ],
    'asset_data' => [
        'table' => 'assets',
        'widthTable' => ['100', '160', '130','130', '130',null, '87'],
        'labelTable' => ['Kode', 'Nama Barang', 'Kategori', 'Lokasi','Tanggal Pembelian','Keterangan', 'Status'],
        'selectTable' => ['asset_code', 'item_name', 'categories.category_name as category_name', 'locations.location_name as location_name','purchase_date','asset_desc', 'asset_statuses.status_name as status', 'assets.id as id'],
        'where' => [],
        'join' => [
            'table' => ['locations', 'categories', 'asset_statuses'],
            'relation' => [
                ['location_id', 'locations.id'],
                ['category_id', 'categories.id'],
                ['asset_status_id', 'asset_statuses.id'],
            ],
        ],
        'filter' => [
            'table' => ['asset_code', 'item_name', 'category_id', 'location_id', 'assets.asset_status_id as asset_status_id'],
            'label' => ['asset_code', 'Nama Barang', 'Kategori', 'Lokasi', 'Status'],
            'like' => ['item_name'],
        ],
        'filterAuth' => ['company_id'],
        'exportExcel' => true,
        'customLabel' => [

        ],
    ],
    'company' => [
        'table' => 'companies',
        'widthTable' => [null, '200', '87'],
        'labelTable' => ['Nama Perusahaan', 'Kode', 'Status'],
        'selectTable' => ['company_name', 'company_code', 'status', 'id'],
        'where' => [],
        'join' => [],
        'filter' => ['table' => ['company_name', 'status'], 'label' => ['Nama Perusahaan', 'Status']],
        'customLabel' => [
            [
                'label' => 'Status',
                'template' => [
                    '0' => ['html' => '<label class="label label-default">Tidak Aktif</label>'],
                    '1' => ['html' => '<label class="label label-success">Aktif</label>'],
                ],
            ],
        ],
    ],
    'asset_status' => [
        'table' => 'asset_statuses',
        'widthTable' => [null, '200', '87'],
        'labelTable' => ['Nama Status', 'Status'],
        'selectTable' => ['status_name', 'status', 'id'],
        'where' => [],
        'join' => [],
        'filter' => ['table' => ['status_name', 'status'], 'label' => ['Nama Status', 'Status']],
        'customLabel' => [
            [
                'label' => 'Status',
                'template' => [
                    '0' => ['html' => '<label class="label label-default">Tidak Aktif</label>'],
                    '1' => ['html' => '<label class="label label-success">Aktif</label>'],
                ],
            ],
        ],
    ],
    'penggunaan' => [
        'table' => 'penggunaan',
        'widthTable' => [null, '87'],
        'labelTable' => ['history_desc'],
        'selectTable' => ['history_desc', 'id_penggunaan as id'],
        'where' => [],
        'join' => [],
        'filter' => ['table' => ['history_desc'], 'label' => ['Nama Status']],
        'customLabel' => [
            
        ],
    ]
];
