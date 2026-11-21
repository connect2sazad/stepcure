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

$ticket_id = isset($_POST['ticket_id']) ? $_POST['ticket_id'] : '';
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
    "reply_to_id" => $ticket_id,
    "title" => "",
    "description" => $description,
    "issue_type" => "",
    "attachments" => $attachments,
    "created_by" => $_SESSION[USER_AUTH]
);

// Save ticket
saveSupportTicket($ticket);

$column_values = [
    'updated_by' => $_SESSION[USER_AUTH],
    'status' => "Replied"
];
$where_conditions = [
    'id' => $ticket_id
];
$update_ticket = UPDATE('support_tickets', $column_values, $where_conditions);
runQuery($update_ticket);

// Redirect after saving
header('location: ./?id='.$ticket_id);
exit;
