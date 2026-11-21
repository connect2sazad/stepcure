<?php

require_once __DIR__ . '/../core/init.php';

if (!defined('SITE_URL')) {
    define('SITE_URL', systemVariable('SITE_HOME'));
}

// Start the session if needed
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get the current request URI
$requestUri = $_SERVER['REQUEST_URI'];

// Define the exception paths
$excludedPaths = [
    '/admin/login/',
    '/admin/forgot-password/',
    '/admin/reset-password/',
    '/admin/create-account/',
    '/admin/abc121'
];

// Check if current path is in the excluded list
$shouldSkipAuth = false;
foreach ($excludedPaths as $path) {
    if (strpos($requestUri, $path) !== false) {
        $shouldSkipAuth = true;
        break;
    }
}

$ref_url = "http" . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "s" : "") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if ($shouldSkipAuth) {
    // If the user is already authenticated, redirect them to /admin/
    if (isset($_SESSION[USER_AUTH]) && array_key_exists(USER_AUTH, $_SESSION)) {
        header('Location: ' . systemVariable('SITE_HOME') . 'admin/');
        exit;
    }
} else {
    // For protected routes, ensure user is authenticated
    if (!isset($_SESSION[USER_AUTH]) || !array_key_exists(USER_AUTH, $_SESSION)) {
        header('Location: ' . systemVariable('SITE_HOME') . 'admin/login/?ref='.$ref_url);
        exit;
    }
}
