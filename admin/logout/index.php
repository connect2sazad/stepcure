<?php

require_once __DIR__ . '/../admin.php';

$user = $_SESSION[USER_AUTH];
$user = getIdFromUserid($user);
$user = getUserById($user);
$user = mysqli_fetch_assoc($user);

if (array_key_exists(USER_AUTH, $_SESSION)) {
    unset($_SESSION[USER_AUTH]);
}

if ($user['user_group'] != 1) {
    addNewAdminUpdate($user['userid'], 'User Logged Out');
}

session_destroy();

header('location: ../');
