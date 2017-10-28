<?php

return [
    [
        'username' => 'admin',
        'email' => encrypt('admin@example.com'),
        'password' => bcrypt('secret'),
        'apikey'=>'1a64038e383ec2aab5ca451cb56e669a'
    ],
    [
        'username' => 'basicuser',
        'email' => encrypt('basic@example.com'),
        'password' => bcrypt('secret'),
        'apikey'=>'1a64038e383ec2aab5ca451cb56e669a'
    ]
];