<?php

return [
    [
        'username' => 'admin',
        'email' => encrypt('admin@example.com'),
        'password' => bcrypt('secret')
    ],
    [
        'username' => 'basicuser',
        'email' => encrypt('basic@example.com'),
        'password' => bcrypt('secret')
    ]
];