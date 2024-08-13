<?php
function getStatusMessage($statusCode = 0) {
    $status = [
        '0' => '',
        '1' => 'Duplicate email address',
        '2' => 'Username or password empty',
        '3' => 'User created successfully',
        '4' => 'Username and password did not match',
        '5' => 'Username does not exist'
    ];

    return $status[$statusCode];
}