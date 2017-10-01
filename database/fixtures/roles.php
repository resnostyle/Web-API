<?php

return [
    [
        'name'              => 'Disabled',
        'api_requests'      => 0,
        'download_requests' => 0,
        'invites'           => 0,
        'is_default'        => false,
        'can_preview'       => false
    ],
    [
        'name'              => 'Member',
        'api_requests'      => 100,
        'download_requests' => 10,
        'invites'           => 0,
        'is_default'        => true,
        'can_preview'       => false
    ],
    [
        'name'              => 'VIP',
        'api_requests'      => 5000,
        'download_requests' => 500,
        'invites'           => 5,
        'is_default'        => false,
        'can_preview'       => true
    ],
    [
        'name'              => 'Moderator',
        'api_requests'      => 10000,
        'download_requests' => 10000,
        'invites'           => 1000,
        'is_default'        => false,
        'can_preview'       => true
    ],
    [
        'name'              => 'Admin',
        'api_requests'      => 10000,
        'download_requests' => 10000,
        'invites'           => 1000,
        'is_default'        => false,
        'can_preview'       => true
    ]
];