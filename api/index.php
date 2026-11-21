<?php

header('Content-Type: application/json'); // Response will be JSON
header("Access-Control-Allow-Origin: *"); // Allows any domain to access (for development only)
// header("Access-Control-Allow-Methods: POST"); // Allow POST only
// header("Access-Control-Allow-Headers: Content-Type"); // Accept only content-type

// Optional but useful:
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once __DIR__ . "/../core/init.php";
include_once __DIR__ . "/api_func.php";
include_once __DIR__ . "/addon_api_func.php";


$received_api_key = isset($_POST['api_key']) ? $_POST['api_key'] : '';
if ($received_api_key != API_KEY) {
    die(json_encode(['status' => 'failed', 'message' => 'Invalid API Key',
    //     "received_api" => $received_api_key,
    //     "saved_api_key" => API_KEY
    ]));
    // die(json_encode(["POST" => $_POST]));
}

$request_type = $_POST['request_type'] ?? '';
if (function_exists($request_type)) {

    // remove api key
    if(session_status()===PHP_SESSION_NONE)session_start();$GLOBALS['sc_audit_written']=false;
$response = $request_type(secure_API_KEY($_POST));
if(!empty($_SESSION[USER_AUTH]) && is_array($response) && ($response['status']??'')==='success' && empty($GLOBALS['sc_audit_written']) && preg_match('/^(add|update|delete|restore|send|save|finalize|admin_login|admin_logout)/',$request_type))sc_audit('api.'.$request_type,$response['id']??($_POST['id']??null));
    $response = json_encode($response);
    // echo json_encode($response);
    echo $response;
} else {
    die(json_encode(['status' => 'failed', 'message' => 'Requested API Not Found']));
}
