<?php
// Chia nhỏ bảng 
$ret = [
    // example
    // 'menus' => [
    //     'class' => 'CustomTable\Controllers\TabController',
    //     'method' => 'getDataTab',
    //     'tabs' => [
    //         [
    //             'label' => 'Menu',
    //             'name' => 'home',
    //             'default' => true,
    //             'where' => [
    //             ],
    //         ],
    //         [
    //             'label' => 'Menu 1',
    //             'name' => 'Test',
    //             'default' => true,
    //             'where' => [
    //             ],
    //         ],
    //     ],
    // ],
    ];
$configRechargeRequestsTab = [
    'class' => 'CustomTable\Controllers\TabController',
    'method' => 'getDataTab',
    'tabs' => [
        [
            'label' => 'Tất cả',
            'name' => 'all_recharge_requests',
            'default' => true,
            'where' => [
            ]
        ]
    ]
];
foreach (\DB::table('recharge_statuses')->get() as $key => $item) {
    $configRechargeRequestsAdd = [
        'label' => $item->name,
        'name' => 'recharge_request_statuses'.$item->id,
        'default' => false,
        'where' => [
            [
                'field' => 'recharge_status_id',
                'value' => $item->id
            ]
        ]
    ];
    array_push($configRechargeRequestsTab['tabs'],$configRechargeRequestsAdd);
}
$ret['recharge_requests'] = $configRechargeRequestsTab;

$configWithdrawalRequestsTab = [
    'class' => 'CustomTable\Controllers\TabController',
    'method' => 'getDataTab',
    'tabs' => [
        [
            'label' => 'Tất cả',
            'name' => 'all_withdrawal_requests',
            'default' => true,
            'where' => [
            ]
        ]
    ]
];
foreach (\DB::table('withdrawal_request_statuses')->get() as $key => $item) {
    $configWithdrawalRequestsAdd = [
        'label' => $item->name,
        'name' => 'withdrawal_request_statuses'.$item->id,
        'default' => false,
        'where' => [
            [
                'field' => 'withdrawal_request_status_id',
                'value' => $item->id
            ]
        ]
    ];
    array_push($configWithdrawalRequestsTab['tabs'],$configWithdrawalRequestsAdd);
}
$ret['withdrawal_requests'] = $configWithdrawalRequestsTab;
return $ret;
