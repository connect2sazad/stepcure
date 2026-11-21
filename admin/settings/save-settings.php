<?php

require_once __DIR__ . '/../admin.php';

// Define current module
define('PERMISSION_NAME', 'app_settings');

define('ALL_PERMISSIONS', getAllPermissionsByPERMISSION_NAME());
define('USER_ALLOWED_PERMISSIONS', getUserPermissionsByPERMISSION_NAME());
define('USER_GROUP_ALLOWED_PERMISSIONS', getUserGroupPermissionsByPERMISSION_NAME());

// Fetch all permissions for current user
$user_permissions        = USER_ALLOWED_PERMISSIONS;
$user_group_permissions  = USER_GROUP_ALLOWED_PERMISSIONS;

$current_admin = $_SESSION[USER_AUTH];

$SITE_NAME = isset($_POST['SITE_NAME']) ? $_POST['SITE_NAME'] : '';
$default_site_color = isset($_POST['default_site_color']) ? $_POST['default_site_color'] : '';
$default_user_group_color = isset($_POST['default_user_group_color']) ? $_POST['default_user_group_color'] : '';
$default_user_designation_color = isset($_POST['default_user_designation_color']) ? $_POST['default_user_designation_color'] : '';
$default_site_id = isset($_POST['default_site_id']) ? $_POST['default_site_id'] : '';
$default_user_group = isset($_POST['default_user_group']) ? $_POST['default_user_group'] : '';
$consent_form_text = isset($_POST['consent_form_text']) ? $_POST['consent_form_text'] : '';
$consent_form_text = mysqli_real_escape_string(get_conn(), $consent_form_text);


if (userVariable('user_group') == 1) {
    $meta_keywords_limit = isset($_POST['meta_keywords_limit']) ? $_POST['meta_keywords_limit'] : '';
} else {
    $meta_keywords_limit = systemVariable('meta_keywords_limit');
}


// site icon
updateSystemVariables(
    array(
        'SITE_NAME' => $SITE_NAME,
        'default_site_color' => $default_site_color,
        'default_user_group_color' => $default_user_group_color,
        'default_user_designation_color' => $default_user_designation_color,
        'default_site_id' => $default_site_id,
        'default_user_group' => $default_user_group,
        'consent_form_text' => $consent_form_text,
        
        'meta_keywords_limit' => $meta_keywords_limit,
    ),
    $current_admin
);


header('location: ./');
