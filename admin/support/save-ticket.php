<?php

require_once __DIR__ . '/../admin.php';

// Define current module
define('PERMISSION_NAME', 'support');

define('ALL_PERMISSIONS', getAllPermissionsByPERMISSION_NAME());
define('USER_ALLOWED_PERMISSIONS', getUserPermissionsByPERMISSION_NAME());
define('USER_GROUP_ALLOWED_PERMISSIONS', getUserGroupPermissionsByPERMISSION_NAME());

// Fetch all permissions for current user
$user_permissions        = USER_ALLOWED_PERMISSIONS;
$user_group_permissions  = USER_GROUP_ALLOWED_PERMISSIONS;

$current_admin = $_SESSION[USER_AUTH];

// Handle POST data
$title = isset($_POST['title']) ? $_POST['title'] : '';
$issue_type = isset($_POST['issue_type']) ? $_POST['issue_type'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';

// Define target upload directory
// $support_file_location = __ROOT__ . '\admin\support\uploads\\';

// Handle file uploads
$uploaded_files = upload_multiple_files('ticket_attachments');

// Prepend relative path for DB or frontend use
$attachments = array_map(function ($file) {
    return 'uploads/' . $file;
}, $uploaded_files);



// Build ticket data
$ticket = array(
    "reply_to_id" => "",
    "title" => $title,
    "description" => $description,
    "issue_type" => $issue_type,
    "attachments" => $attachments,
    "created_by" => $_SESSION[USER_AUTH]
);

// Save ticket
saveSupportTicket($ticket);

// Redirect after saving
header('location: ./');
exit;
