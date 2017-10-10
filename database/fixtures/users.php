<?php

return [
    [
        'username' => 'admin',
        'email' => encrypt('admin@example.com'),
        'password' => bcrypt('secret'),
        'role_id' => 5
    ],
    [
        'username' => 'basicuser',
        'email' => encrypt('basic@example.com'),
        'password' => bcrypt('secret'),
        'role_id' => 2
    ]
];