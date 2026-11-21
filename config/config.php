<?php

define('DB_HOST', 'localhost');
define('DB', 'stepcure'); // Server: lyncrzng_stepcure

// server-prod
// define('DB_USER', 'stepcure'); // Server: stepcure // server-prod
// define('DB_PASSWORD', 'Stepcure@17062025'); // Server: Stepcure@17062025 // server-prod

// local-dev
define('DB_USER', 'root'); // local-dev
define('DB_PASSWORD', ''); // local-dev

define('API_KEY', 'FJGCP-4DFJD-GJY49-VJBQ7-HYRR2-KH2J9-PC326-T44D4-39H6V-TVPBY');

define('ACTIVE_THEME', 'LT-367');
define('USER_AUTH', 'stepcure_user'); // admin user
define('USER_PERMISSIONS', 'stepcure_user_permissions');
define('UPLOAD_FILE_SIZE', '1048576'); // 1048576 = 1 MB

define('CLIENT_USER_AUTH', 'stepcure_online_user'); // online users who buy using the website store


if (!defined('__ROOT__')) {
    // define('__ROOT__', realpath(__DIR__ . '/../'));
    define('__ROOT__', realpath(__DIR__ . '/'));
}

define('FILE_UPLOAD_DIR', __ROOT__ . '\uploads\\');

// Set your default timezone
date_default_timezone_set('Asia/Kolkata');


// https://console.cloud.google.com/
// lyncdigit@gmail.com