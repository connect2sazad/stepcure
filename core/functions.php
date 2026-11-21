<?php

function pre($item)
{
    echo '<pre>';
    print_r($item);
    echo '</pre>';
}

function theme_url($path = '')
{
    return systemVariable('SITE_DIR') . 'themes/' . ACTIVE_THEME . '/' . ltrim($path, '/');
}

function admin_dir($path = '')
{
    return __DIR__ . '/../admin/' . ltrim($path, '/');
}

function load_component($component)
{
    $component_path = admin_dir() . 'components/' . $component . '.php';
    if (file_exists($component_path)) {
        require_once $component_path;
    } else {
        echo "Component '$component' not found.";
    }
}

function load_admin_auth()
{

    if (isset($_SESSION[USER_AUTH])) {
        load_component('admin-nav');
        echo '<script id="str_aslOu" src="' . systemVariable('SITE_HOME') . 'assets/js/addon.js"></script>';
    }
}

function loadAdminStyleSheets()
{

    $stylesheets = '

            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

            <!-- core stylessheets -->
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="' . systemVariable('SITE_DIR') . 'assets/vendor/css/core.css" class="template-customizer-core-css" />
            <link rel="stylesheet" href="' . systemVariable('SITE_DIR') . 'assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
            <link rel="stylesheet" href="' . systemVariable('SITE_DIR') . 'assets/css/style.css" />
            <link rel="stylesheet" href="' . systemVariable('SITE_DIR') . 'assets/css/admin-nav.css" />
            
            <!-- Icons. Uncomment required icon fonts -->
            <link rel="stylesheet" href="' . systemVariable('SITE_DIR') . 'assets/vendor/fonts/boxicons.css" />
            
            <!-- Vendors CSS -->
            <link rel="stylesheet" href="' . systemVariable('SITE_DIR') . 'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
            <link rel="stylesheet" href="' . systemVariable('SITE_DIR') . 'assets/vendor/libs/apex-charts/apex-charts.css" />
            <link rel="stylesheet" href="' . systemVariable('SITE_DIR') . 'assets/vendor/libs/toastify/toastify.css" />
            <link rel="stylesheet" href="' . systemVariable('SITE_DIR') . 'assets/vendor/libs/DataTables/datatables.min.css" />
            <link rel="stylesheet" href="' . systemVariable('SITE_DIR') . 'assets/vendor/libs/bs-stepper/bs-stepper.css" />
            <link rel="stylesheet" href="' . systemVariable('SITE_DIR') . 'assets/css/addon.css" />

            <style>
            body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url(' . systemVariable('SITE_DIR') . 'uploads/' . systemVariable('background_image') . ');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    filter: blur(10px);
    z-index: -1;
}
body {
    position: relative;
    z-index: 0;
}
            </style>
        ';



    return $stylesheets;
}

function loadAdminScripts()
{

    $scripts = '
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

            <script src="' . systemVariable('SITE_DIR') . 'assets/vendor/js/helpers.js"></script>
            <script src="' . systemVariable('SITE_DIR') . 'assets/js/config.js"></script>
            <script src="' . systemVariable('SITE_DIR') . 'assets/js/head-addon.js"></script>
            <script src="' . systemVariable('SITE_DIR') . 'assets/js/api_req.js"></script>
            <script src="' . systemVariable('SITE_DIR') . 'assets/js/stock.js"></script>
            ';

    // comment this line
    // $scripts .= '
    //         <!-- comment this line -->
    //         <script src="' . systemVariable('SITE_DIR') . 'assets/js/fill-inputs.js"></script>
    // ';

    return $scripts;
}

function loadAdminFooterScripts()
{
    // include_once __DIR__."/contextMenu.php";
    include_once __DIR__ . "/../admin/components/contextMenu.php";
    $footer_scripts = '  
    
      <!-- Vendors -->
      <script src="' . systemVariable('SITE_DIR') . 'assets/vendor/libs/jquery/jquery.js"></script>
      <script src="' . systemVariable('SITE_DIR') . 'assets/vendor/libs/popper/popper.js"></script>
      <script src="' . systemVariable('SITE_DIR') . 'assets/vendor/js/bootstrap.js"></script>
      <script src="' . systemVariable('SITE_DIR') . 'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
      <script src="' . systemVariable('SITE_DIR') . 'assets/vendor/js/menu.js"></script>
      <script src="' . systemVariable('SITE_DIR') . 'assets/vendor/libs/apex-charts/apexcharts.js"></script>
      <script src="' . systemVariable('SITE_DIR') . 'assets/vendor/libs/toastify/toastify.js"></script>
      <script src="' . systemVariable('SITE_DIR') . 'assets/vendor/libs/DataTables/datatables.min.js"></script>
      <script src="' . systemVariable('SITE_DIR') . 'assets/vendor/libs/bs-stepper/bs-stepper.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

      <!-- Javascripts -->
      <script src="' . systemVariable('SITE_DIR') . 'assets/js/main.js"></script>
      <script src="' . systemVariable('SITE_DIR') . 'assets/js/seo-maker.js"></script>
      <script src="' . systemVariable('SITE_DIR') . 'assets/js/dashboards-analytics.js"></script>
      <script src="' . systemVariable('SITE_DIR') . 'assets/js/form-wizard-icons.js"></script>
      <script src="' . systemVariable('SITE_DIR') . 'assets/js/addon.js"></script>
    ';

    return $footer_scripts;
}

function loadCustomCss($css_loc)
{
    return '<link rel="stylesheet" href="' . systemVariable('SITE_DIR') . $css_loc . '" />';
}

function loadCustomJs($js_loc)
{
    return '<script src="' . systemVariable('SITE_DIR') . $js_loc . '"></script>';
}



function loadAdminMetaData()
{
    require_once __DIR__ . '/signature.php';
    $meta = '
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        ';

    return $meta;
}

function loadAdminTitleAndFavicon(...$basic)
{

    if (isset($basic[0])) {
        $title = $basic[0] . ' — ' . systemVariable('SITE_NAME') . ' • Lyncdigit Admin Console';
    } else {
        $title = systemVariable('SITE_NAME') . ' • Lyncdigit Admin Console';
    }
    $favicon = systemVariable('SITE_DIR') . "assets/img/favicon/favicon.ico";

    $compound = '
            <title>' . $title . '</title>
            <link rel="shortcut icon" href="' . $favicon . '">
            <link rel="apple-touch-icon image_src" href="' . $favicon . '">
            <link rel="icon" href="' . $favicon . '">
        ';

    return $compound;
}


function loadAdminCopyright()
{

    $copyright_year = date('Y');

    $copyright = '
        <div class="credit">
            copyright &copy; ' . $copyright_year . ' ' . systemVariable('SITE_NAME') . ' | all rights reserved. | 
            Powered by <a href="https://www.lyncdigit.com" target="_blank">Lyncdigit</a>
        </div>
    ';

    return $copyright;
}

function loadAdminSidebar(...$active_menu)
{
    include_once __DIR__ . "/../admin/components/sidebar.php";
}

function loadAdminNavbar()
{
    load_component("navbar");
}

function loadAdminFooter()
{
    load_component("footer");
}

function userVariable($variable_name)
{
    $query = WHERE('users', 'userid', $_SESSION[USER_AUTH]);
    $run_query = runQuery($query);
    $fetch = mysqli_fetch_assoc($run_query);
    return $fetch[$variable_name];
}

function getPagesList()
{
    $pages = "SELECT * FROM `pages` WHERE `pages`.`is_trashed` = 0 AND `pages`.`is_deleted` = 0;";
    $run_query = runQuery($pages);
    return $run_query;
}

function getTrashedPagesList()
{
    // $pages = WHERE('pages', 'is_trashed', '1');
    $pages = "SELECT * FROM `pages` WHERE `pages`.`is_trashed` = 1 AND `pages`.`is_deleted` = 0;";
    $run_query = runQuery($pages);
    return $run_query;
}

function getPageBySlug($slug)
{
    $query = WHERE('pages', 'slug', $slug);
    $page = runQuery($query);
    return $page;
}

function getPageById($id)
{
    $query = WHERE('pages', 'page_id', $id);
    $page = runQuery($query);
    return $page;
}

function getBlocksList()
{
    $blocks = WHERE('design_blocks', 'is_deleted', '0');
    $run_query = runQuery($blocks);
    return $run_query;
}

function getDeletedBlocksList()
{
    $blocks = WHERE('design_blocks', 'is_deleted', '1');
    $run_query = runQuery($blocks);
    return $run_query;
}

function getBlockById($id)
{
    $query = WHERE('design_blocks', 'block_id', $id);
    $block = runQuery($query);
    return $block;
}

function getMetaData($meta_unique_name)
{
    $metas = WHERE('metas', 'meta_unique_name', $meta_unique_name);
    $metas = runQuery($metas);
    return $metas;
}

function getMetaSingle($meta_unique_name, $property_type)
{
    $meta = SELECT('metas') . " WHERE `metas`.`meta_unique_name` = '$meta_unique_name' AND `metas`.`attr_value` = '$property_type';";
    $meta = runQuery($meta);
    $meta = mysqli_fetch_assoc($meta);
    return $meta;
}

function createQueryForSEO($object, $table_name, $id)
{

    $meta_unique_name = $table_name . "_" . $id;
    $updated_by = $object['updated_by'];
    $meta_keywords = $object['meta-keywords'];
    $meta_description = $object['meta-description'];

    $dup_request = $object;

    $meta_field_ids = array();
    $meta_names = array();
    $meta_properties = array();

    foreach ($dup_request as $key => $value) {
        if (startsWith($key, 'name-content-')) {
            $field_id = getMetaFieldId($key, 'name-content-');
            array_push($meta_field_ids, $field_id);
        } else if (startsWith($key, 'property-content-')) {
            $field_id = getMetaFieldId($key, 'property-content-');
            array_push($meta_field_ids, $field_id);
        }
    }

    for ($i = 0; $i < count($meta_field_ids); $i++) {
        $field_id = $meta_field_ids[$i];
        if (array_key_exists('name-' . $field_id, $dup_request)) {
            $meta_names[$dup_request['name-' . $field_id]] = $dup_request['name-content-' . $field_id];
        } else if (array_key_exists('property-' . $field_id, $dup_request)) {
            $meta_properties[$dup_request['property-' . $field_id]] = $dup_request['property-content-' . $field_id];
        }
    }

    $sql = "INSERT INTO `metas` (`meta_unique_name`, `attr_type`, `attr_value`, `content`, `updated_by`) VALUES ('$meta_unique_name', 'name', 'keywords', '$meta_keywords', '$updated_by'), ('$meta_unique_name', 'name', 'description', '$meta_description', '$updated_by'),";
    foreach ($meta_names as $key => $value) {
        $sql .= " ('$meta_unique_name', 'name', '$key', '$value', '$updated_by'),";
    }

    foreach ($meta_properties as $key => $value) {
        $sql .= " ('$meta_unique_name', 'property', '$key', '$value', '$updated_by'),";
    }

    $sql = substr($sql, 0, (strlen($sql) - 1));
    $sql .= ";";

    return $sql;
}

function setMetaData($query, $table_name, $id)
{
    $meta_unique_name = $table_name . "_" . $id;
    $remove_old_data = DELETE('metas', 'meta_unique_name', $meta_unique_name);
    $remove_old_data = runQuery($remove_old_data);
    if ($remove_old_data == 1) {
        $new_seo = runQuery($query);
    }

    return $new_seo;
}

function getLatestAdminUpdates($count = 'all')
{
    if ($count == 'all') {
        $query = "SELECT * FROM `admin_updates` ORDER BY `admin_updates`.`id` DESC;";
    } else {
        $query = "SELECT * FROM `admin_updates` ORDER BY `admin_updates`.`id` DESC LIMIT $count;";
    }
    $run_query = runQuery($query);
    return $run_query;
}

function addNewAdminUpdate($updated_by, $update_text)
{
    $conn = get_conn(); // get mysqli connection

    // ✅ Escape both values safely
    $updated_by  = mysqli_real_escape_string($conn, $updated_by);
    $update_text = mysqli_real_escape_string($conn, $update_text);

    $query = "INSERT INTO `admin_updates` (`updated_by`, `update_text`) VALUES ('$updated_by', '$update_text')";
    return runQuery($query);
}



function getMenuById($id)
{
    $query = WHERE('menus', 'menu_id', $id);
    $package = runQuery($query);
    return $package;
}

function getMenusList()
{
    $menus = "SELECT * FROM `menus` WHERE `menus`.`is_trashed` = 0 AND `menus`.`is_deleted` = 0;";
    $run_query = runQuery($menus);
    return $run_query;
}

function getTrashedMenusList()
{
    $menus = "SELECT * FROM `menus` WHERE `menus`.`is_trashed` = 1 AND `menus`.`is_deleted` = 0;";
    $run_query = runQuery($menus);
    return $run_query;
}

function getProductCategoryBySlug($slug)
{
    $query = "SELECT * FROM `product_categories` WHERE `product_categories`.`slug` = '$slug' AND `product_categories`.`is_active` = 1 AND `product_categories`.`is_deleted` = 0;";
    $category = runQuery($query);
    return $category;
}

function getUseridById($id)
{
    $query = WHERE('users', 'id', $id);
    $user = runQuery($query);
    $user = mysqli_fetch_assoc($user);
    $userid = $user['userid'];
    return $userid;
}

function getIdFromUserid($userid)
{
    $query = WHERE('users', 'userid', $userid);
    $user = runQuery($query);
    $user = mysqli_fetch_assoc($user);
    $userid = $user['id'];
    return $userid;
}

function getAddressStateById($stateid)
{
    $query = WHERE('address_states', 'id', $stateid);
    $state = runQuery($query);
    $state = mysqli_fetch_assoc($state);
    return $state;
}

function getAdminLogs()
{
    $query = SELECT('admin_updates') . " ORDER BY admin_updates.id DESC;";
    $logs = runQuery($query);
    return $logs;
}

function get_state_code($id)
{
    $query = WHERE('address_states', 'id', $id);
    $state = runQuery($query);
    $state = mysqli_fetch_assoc($state);
    $state_code = $state['state_code'];
    return $state_code;
}

function get_last_generated_site_code($state_code)
{
    $query = WHERE('address_states', 'state_code', $state_code);
    $state = runQuery($query);
    $state = mysqli_fetch_assoc($state);
    $last_id = $state['last_id'];
    return $last_id;
}

function getUserGroupById($id)
{
    $query = WHERE('user_groups', 'id', $id);
    $user_group = runQuery($query);
    return $user_group;
}

function getUserGroups()
{

    // check if the current user belongs to user group 1 (Super Admin)
    $current_user = $_SESSION[USER_AUTH];
    $current_user = getUserByUserId($current_user);
    $current_user = mysqli_fetch_assoc($current_user);

    $admin_exc = " AND id != 2";

    // if the user is Super Admin then only show Admin
    if ($current_user['user_group'] == 1) {
        $admin_exc = '';
    }

    $user_groups = "SELECT * FROM user_groups WHERE is_deleted = 0 " . $admin_exc . ";";
    $run_query = runQuery($user_groups);
    return $run_query;
}

function getUserGroupOptions()
{
    $conditions = [
        'is_active' => 1,
        'is_deleted' => 0,
    ];
    $user_groups = WHEREm('user_groups', $conditions);
    $run_query = runQuery($user_groups);
    return $run_query;
}

function getUsersByUserGroupId($group_id)
{
    $conditions = [
        'user_group' => $group_id,
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $users = WHEREm('users', $conditions);
    $run_query = runQuery($users);
    return $run_query;
}

function getUserGroupByUserId($id)
{
    // this function brings you the group id of the current user
    $query = WHERE('users', 'id', $id);
    $run_query = runQuery($query);
    $user = mysqli_fetch_assoc($run_query);
    $user_group_id = $user['user_group'];
    return $user_group_id;
}

function getUsersOptionsForUserGroupEdit($current_userid)
{
    $current_id = getIdFromUserid($current_userid);
    // $current_group = getUserGroupByUserId($current_id);
    $query = "SELECT * FROM users WHERE `user_group` != 1 OR user_group IS NULL;";
    $run_query = runQuery($query);
    return $run_query;
}

function getCurrentUsersInUserGroup($id)
{
    // this function gets the users in the current user group
    $conditions = [
        'user_group' => $id,
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $query = WHEREm('users', $conditions);
    $run_query = runQuery($query);
    return $run_query;
}

function getUserById($id)
{
    $query = WHERE('users', 'id', $id);
    $user = runQuery($query);
    // $user = mysqli_fetch_assoc($user);
    return $user;
}

function getUserByUserid($userid)
{
    $query = WHERE('users', 'userid', $userid);
    $user = runQuery($query);
    // $user = mysqli_fetch_assoc($user);
    return $user;
}

function getUsersList()
{
    $conditions = [
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $users = WHEREm('users', $conditions);
    $run_query = runQuery($users);
    return $run_query;
}

function getUsersListDetailed()
{
    // check if the current user belongs to user group 2 (Admin) or 1 (Super Admin)
    $current_user = $_SESSION[USER_AUTH];
    $current_user = getUserByUserId($current_user);
    $current_user = mysqli_fetch_assoc($current_user);

    $admin_exc = " AND users.user_group != 2";

    if ($current_user['user_group'] == 1 || $current_user['user_group'] == 2) {
        $admin_exc = '';
    }

    // skip the current user
    $skip_self = " AND users.id != " . $current_user['id'];

    $users = "
        SELECT users.*, user_designations.default_honorifics, user_designations.designation_name, user_groups.group_name, sites.site_name,
        user_designations.is_active as user_designations_active, user_designations.is_deleted as user_designations_deleted,
        user_groups.is_active as user_groups_active, user_groups.is_deleted as user_groups_deleted,
        sites.is_active as sites_active, sites.is_deleted as sites_deleted
        FROM users
        LEFT JOIN user_designations ON user_designations.id = users.user_designation
        LEFT JOIN user_groups ON user_groups.id = users.user_group
        LEFT JOIN sites ON sites.id = users.treatment_site
        WHERE
        users.is_active = 1 AND users.is_deleted = 0 AND users.user_group != 1 " . $admin_exc . $skip_self . ";";
    $run_query = runQuery($users);
    return $run_query;
}

function getTrashedUsersList()
{
    $conditions = [
        'is_active' => 0,
        'is_deleted' => 0
    ];
    $users = WHEREm('users', $conditions);
    $run_query = runQuery($users);
    return $run_query;
}

function getTrashedUsersListDetailed()
{

    // check if the current user belongs to user group 2 (Admin) or 1 (Super Admin)
    $current_user = $_SESSION[USER_AUTH];
    $current_user = getUserByUserId($current_user);
    $current_user = mysqli_fetch_assoc($current_user);

    $admin_exc = " AND users.user_group != 2";

    if ($current_user['user_group'] == 1 || $current_user['user_group'] == 2) {
        $admin_exc = '';
    }

    // skip the current user
    $skip_self = " AND users.id != " . $current_user['id'];

    $users = "
        SELECT users.*, user_designations.default_honorifics, user_designations.designation_name, user_groups.group_name, sites.site_name,
        user_designations.is_active as user_designations_active, user_designations.is_deleted as user_designations_deleted,
        user_groups.is_active as user_groups_active, user_groups.is_deleted as user_groups_deleted,
        sites.is_active as sites_active, sites.is_deleted as sites_deleted
        FROM users
        LEFT JOIN user_designations ON user_designations.id = users.user_designation
        LEFT JOIN user_groups ON user_groups.id = users.user_group
        LEFT JOIN sites ON sites.id = users.treatment_site
        WHERE
        users.is_active = 0 AND users.is_deleted = 0 AND users.user_group != 1 " . $admin_exc . $skip_self . ";";
    $run_query = runQuery($users);
    return $run_query;
}


function buildFootAnalysisReportPDFFromHtml($reportData)
{
    // Extract with safe defaults
    $title          = $reportData['title'] ?? 'Analysis Report';
    $report_name          = $reportData['report_name'] ?? 'Analysis Report';
    $date           = $reportData['date'] ?? date('d M Y');
    $time           = $reportData['time'] ?? date('H:i A');
    $consultationId = $reportData['consultation_id'] ?? 'N/A';

    $doctor         = $reportData['doctor'] ?? [];
    $clinicLogo     = $doctor['clinic_logo'] ?? '';
    $clinicName     = $doctor['clinic_name'] ?? 'Clinic Name';
    $doctorName     = $doctor['name'] ?? 'Dr. Name';
    $doctorDetails  = $doctor['details'] ?? 'MBBS, MD';
    $clinicAddress  = $doctor['address'] ?? 'Address not available';

    $rightLogo          = $doctor['right_logo'] ?? '';
    $rightClinicName    = $doctor['right_clinic_name'] ?? 'StepCure';
    $rightDoctorName    = $doctor['right_name'] ?? 'Consulting Doctor';
    $rightDoctorDetails = $doctor['right_details'] ?? 'No details';
    $rightClinicAddress = $doctor['right_address'] ?? 'No address';

    $patient         = $reportData['patient'] ?? [];
    $health          = $reportData['health'] ?? [];
    $footScan        = $reportData['foot_scan'] ?? [];
    $plantarPressure = $reportData['plantar_pressure'] ?? [];
    $ankleBrachial   = $reportData['ankle_brachial'] ?? [];

    $priorIssues     = $reportData['prior_issues'] ?? 'No prior issues recorded.';
    $summary         = $reportData['summary'] ?? 'No summary provided.';
    $recommendation  = $reportData['recommendation'] ?? 'No recommendations provided.';

    // ✅ Auto-shrink font size for long summary/recommendation
    $textLength = strlen(strip_tags($summary . $recommendation));
    $dynamicFontSize = ($textLength > 2000) ? '10px' : '12px';

    ob_start(); ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title><?= htmlspecialchars($title) ?></title>
        <style>
            @page {
                margin: 35px;
            }

            /* ✅ StepCure Watermark */
            body::after {
                content: "StepCure";
                position: fixed;
                top: 40%;
                left: 20%;
                font-size: 80px;
                color: rgba(100, 100, 100, 0.08);
                transform: rotate(-30deg);
                z-index: -1;
            }

            body {
                font-family: Arial, sans-serif;
                font-size: 11px;
                background: #fff;
                color: #212529;
                margin: 0;
                padding: 0;
                line-height: 1.3;
            }

            .container {
                width: 100%;
                padding: 0;
                margin: 0;
            }

            h2,
            h4 {
                margin: 2px 0;
                font-weight: 600;
            }

            .section-title {
                font-size: 12px;
                font-weight: 600;
                padding: 3px 4px;
                margin-top: 8px;
                margin-bottom: 4px;
                background: #f1f3f5;
                border-left: 3px solid #678232;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 6px;
            }

            .table th,
            .table td {
                border: 1px solid #dee2e6;
                padding: 3px 4px;
                vertical-align: middle;
            }

            .table thead th {
                background: #e9ecef;
                font-weight: 600;
            }

            .card {
                border: 1px solid #dee2e6;
                border-radius: 3px;
                padding: 4px;
                margin-bottom: 4px;
            }

            .badge {
                display: inline-block;
                padding: 0.25em 0.45em;
                font-size: 10px;
                font-weight: 600;
                color: #fff;
                background-color: #678232;
                border-radius: 0.25rem;
            }

            .footer {
                text-align: center;
                font-size: 10px;
                margin-top: 8px;
            }

            p,
            li {
                margin: 2px 0;
            }

            ul {
                padding-left: 12px;
                margin: 2px 0;
            }

            /* ✅ Auto-shrink summary/recommendation if too long */
            .summary-section,
            .recommendation-section {
                font-size: <?= $dynamicFontSize ?>;
            }
        </style>
    </head>

    <body>
        <div class="container">

            <!-- HEADER -->
            <table width="100%" style="margin-bottom:6px;">
                <tr>
                    <!-- Left -->
                    <td width="33%" style="text-align:center;">
                        <?php if (!empty($clinicLogo)) : ?>
                            <img src="<?= $clinicLogo ?>" style="height:50px;width:50px;"><br>
                        <?php endif; ?>
                        <b><?= htmlspecialchars($clinicName) ?></b><br>
                        <?= htmlspecialchars($doctorName) ?><br>
                        <?= nl2br(htmlspecialchars($doctorDetails)) ?><br>
                        <?= nl2br(htmlspecialchars($clinicAddress)) ?>
                    </td>

                    <!-- Center -->
                    <td width="33%" style="text-align:center;">
                        <h2><?= htmlspecialchars($report_name) ?></h2>
                        <h4>Date: <?= htmlspecialchars($date) ?></h4>
                        <h4>Time: <?= htmlspecialchars($time) ?></h4>
                        <h4>Consultation ID: <?= htmlspecialchars($consultationId) ?></h4>
                    </td>

                    <!-- Right -->
                    <td width="33%" style="text-align:center;">
                        <?php if (!empty($rightLogo)) : ?>
                            <img src="<?= $rightLogo ?>" style="height:50px;width:50px;"><br>
                        <?php endif; ?>
                        <b><?= htmlspecialchars($rightClinicName) ?></b><br>
                        <?= htmlspecialchars($rightDoctorName) ?><br>
                        <?= nl2br(htmlspecialchars($rightDoctorDetails)) ?><br>
                        <?= nl2br(htmlspecialchars($rightClinicAddress)) ?>
                    </td>
                </tr>
            </table>
            <hr style="margin:4px 0;">

            <!-- PATIENT & HEALTH DETAILS -->
            <table width="100%">
                <tr>
                    <td width="50%" valign="top" style="padding-right:6px;">
                        <div class="section-title">Patient Details</div>
                        <table class="table">
                            <?php if (!empty($patient)) : ?>
                                <?php foreach ($patient as $label => $value): ?>
                                    <tr>
                                        <th><?= htmlspecialchars($label) ?></th>
                                        <td><?= htmlspecialchars($value ?: 'N/A') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">No patient details available</td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </td>
                    <td width="50%" valign="top" style="padding-left:6px;">
                        <div class="section-title">Health Details</div>
                        <table class="table">
                            <?php if (!empty($health)) : ?>
                                <?php foreach ($health as $label => $value): ?>
                                    <tr>
                                        <th><?= htmlspecialchars($label) ?></th>
                                        <td><?= htmlspecialchars($value ?: 'N/A') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">No health details available</td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </td>
                </tr>
            </table>

            <!-- 3D Foot Scan -->
            <div class="section-title">3D Foot Scan Parameters</div>
            <table width="100%">
                <tr>
                    <?php if (!empty($footScan)) : ?>
                        <?php foreach ($footScan as $side => $data): ?>
                            <td width="50%" valign="top" style="padding:3px;">
                                <div class="card">
                                    <h4><?= htmlspecialchars($side) ?> Foot</h4>
                                    <p>Foot Type: <span class="badge"><?= htmlspecialchars($data['foot_type'] ?: 'N/A') ?></span></p>
                                    <p>Arch Type: <?= htmlspecialchars($data['arch_type'] ?: 'N/A') ?></p>
                                    <p>Heel Angle: <?= htmlspecialchars($data['heel_angle'] ?: 'N/A') ?></p>
                                </div>
                            </td>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <td>No foot scan data available</td>
                    <?php endif; ?>
                </tr>
            </table>

            <!-- Plantar Pressure + ABI -->
            <table width="100%">
                <tr>
                    <td width="50%" valign="top" style="padding-right:6px;">
                        <div class="section-title">Plantar Pressure Analysis</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Foot</th>
                                    <th>Morphotype</th>
                                    <th>Max Pressure (kPa)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($plantarPressure)) : ?>
                                    <?php foreach ($plantarPressure as $foot => $values): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($foot) ?></td>
                                            <td><?= htmlspecialchars($values['morphotype'] ?: 'N/A') ?></td>
                                            <td><?= htmlspecialchars($values['pressure'] ?: 'N/A') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3">No plantar pressure data available</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </td>

                    <td width="50%" valign="top" style="padding-left:6px;">
                        <div class="section-title">Ankle Brachial Index</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Measurement</th>
                                    <th>Left</th>
                                    <th>Right</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($ankleBrachial)) : ?>
                                    <?php foreach ($ankleBrachial as $measure => $vals): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($measure) ?></td>
                                            <td><?= htmlspecialchars($vals['left'] ?: 'N/A') ?></td>
                                            <td><?= htmlspecialchars($vals['right'] ?: 'N/A') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3">No ABI data available</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>

            <!-- PRIOR ISSUES -->
            <div class="section-title">Prior Issues</div>
            <p><?= htmlspecialchars($priorIssues) ?></p>

            <!-- SUMMARY -->
            <div class="section-title">Summary</div>
            <div class="summary-section"><?= html_entity_decode($summary) ?></div>

            <!-- RECOMMENDATION -->
            <div class="section-title">Recommendation</div>
            <div class="recommendation-section"><?= html_entity_decode($recommendation) ?></div>

            <div class="footer">
                © <?= date('Y') ?> StepCure | System Generated Foot Analysis Report
            </div>
        </div>
    </body>

    </html>
<?php
    return ob_get_clean();
}

function buildConsentFormPDFFromHtml($reportData)
{
    // Extract with safe defaults
    $title          = $reportData['title'] ?? 'Analysis Report';
    $report_name          = $reportData['report_name'] ?? 'Analysis Report';
    $date           = $reportData['date'] ?? date('d M Y');
    $time           = $reportData['time'] ?? date('H:i A');
    $consultationId = $reportData['consultation_id'] ?? '0';

    $doctor         = $reportData['doctor'] ?? [];
    $clinicLogo     = $doctor['clinic_logo'] ?? '';
    $clinicName     = $doctor['clinic_name'] ?? 'Clinic Name';
    $doctorName     = $doctor['name'] ?? 'Dr. Name';
    $doctorDetails  = $doctor['details'] ?? 'MBBS, MD';
    $clinicAddress  = $doctor['address'] ?? 'Address not available';

    $rightLogo          = $doctor['right_logo'] ?? '';
    $rightClinicName    = $doctor['right_clinic_name'] ?? 'StepCure';
    $rightDoctorName    = $doctor['right_name'] ?? 'Consulting Doctor';
    $rightDoctorDetails = $doctor['right_details'] ?? 'No details';
    $rightClinicAddress = $doctor['right_address'] ?? 'No address';

    $patient         = $reportData['patient'] ?? [];
    $health          = $reportData['health'] ?? [];

    $consent_text = systemVariable('consent_form_text');
    $textLength = strlen($consent_text);
    $dynamicFontSize = ($textLength > 2000) ? '10px' : '12px';

    ob_start(); ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title><?= htmlspecialchars($title) ?></title>
        <style>
            @page {
                margin: 35px;
            }

            /* ✅ StepCure Watermark */
            body::after {
                content: "StepCure";
                position: fixed;
                top: 40%;
                left: 20%;
                font-size: 80px;
                color: rgba(100, 100, 100, 0.08);
                transform: rotate(-30deg);
                z-index: -1;
            }

            body {
                font-family: Arial, sans-serif;
                font-size: 11px;
                background: #fff;
                color: #212529;
                margin: 0;
                padding: 0;
                line-height: 1.3;
            }

            .container {
                width: 100%;
                padding: 0;
                margin: 0;
            }

            h2,
            h4 {
                margin: 2px 0;
                font-weight: 600;
            }

            .section-title {
                font-size: 12px;
                font-weight: 600;
                padding: 3px 4px;
                margin-top: 8px;
                margin-bottom: 4px;
                background: #f1f3f5;
                border-left: 3px solid #678232;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 6px;
            }

            .table th,
            .table td {
                border: 1px solid #dee2e6;
                padding: 3px 4px;
                vertical-align: middle;
            }

            .table thead th {
                background: #e9ecef;
                font-weight: 600;
            }

            .card {
                border: 1px solid #dee2e6;
                border-radius: 3px;
                padding: 4px;
                margin-bottom: 4px;
            }

            .badge {
                display: inline-block;
                padding: 0.25em 0.45em;
                font-size: 10px;
                font-weight: 600;
                color: #fff;
                background-color: #678232;
                border-radius: 0.25rem;
            }

            .footer {
                text-align: center;
                font-size: 10px;
                margin-top: 8px;
            }

            p,
            li {
                margin: 2px 0;
            }

            ul {
                padding-left: 12px;
                margin: 2px 0;
            }

            /* ✅ Auto-shrink summary/recommendation if too long */
            .summary-section,
            .recommendation-section {
                font-size: <?= $dynamicFontSize ?>;
            }
        </style>
    </head>

    <body>
        <div class="container">

            <!-- HEADER -->
            <table width="100%" style="margin-bottom:6px;">
                <tr>
                    <!-- Left -->
                    <td width="33%" style="text-align:center;">
                        <?php if (!empty($clinicLogo)) : ?>
                            <img src="<?= $clinicLogo ?>" style="height:50px;width:50px;"><br>
                        <?php endif; ?>
                        <b><?= htmlspecialchars($clinicName) ?></b><br>
                        <?= htmlspecialchars($doctorName) ?><br>
                        <?= nl2br(htmlspecialchars($doctorDetails)) ?><br>
                        <?= nl2br(htmlspecialchars($clinicAddress)) ?>
                    </td>

                    <!-- Center -->
                    <td width="33%" style="text-align:center;">
                        <h2><?= htmlspecialchars($report_name) ?></h2>
                        <h4>Date: <?= htmlspecialchars($date) ?></h4>
                        <h4>Time: <?= htmlspecialchars($time) ?></h4>
                        <?php
                        if ($consultationId) {

                            echo '<h4>Consultation ID: ' . $consultationId . '</h4>';
                        }
                        ?>
                    </td>

                    <!-- Right -->
                    <td width="33%" style="text-align:center;">
                        <?php if (!empty($rightLogo)) : ?>
                            <img src="<?= $rightLogo ?>" style="height:50px;width:50px;"><br>
                        <?php endif; ?>
                        <b><?= htmlspecialchars($rightClinicName) ?></b><br>
                        <?= htmlspecialchars($rightDoctorName) ?><br>
                        <?= nl2br(htmlspecialchars($rightDoctorDetails)) ?><br>
                        <?= nl2br(htmlspecialchars($rightClinicAddress)) ?>
                    </td>
                </tr>
            </table>
            <hr style="margin:4px 0;">

            <!-- PATIENT & HEALTH DETAILS -->
            <table width="100%">
                <tr>
                    <td width="50%" valign="top" style="padding-right:6px;">
                        <div class="section-title">Basic Details</div>
                        <table class="table">
                            <?php if (!empty($patient)) : ?>
                                <?php foreach ($patient as $label => $value): ?>
                                    <tr>
                                        <th><?= htmlspecialchars($label) ?></th>
                                        <td><?= htmlspecialchars($value ?: 'N/A') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">No patient details available</td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </td>
                    <td width="50%" valign="top" style="padding-left:6px;">
                        <div class="section-title">Other Details</div>
                        <table class="table">
                            <?php if (!empty($health)) : ?>
                                <?php foreach ($health as $label => $value): ?>
                                    <tr>
                                        <th><?= htmlspecialchars($label) ?></th>
                                        <td><?= htmlspecialchars($value ?: 'N/A') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">No details available</td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </td>
                </tr>
            </table>

            <div class="section-title">Consent</div>
            <div class="recommendation-section">
                <?= $consent_text ?>
            </div>

            <!-- Customer Feedback Section -->
            <div class="section-title">Feedback</div>
            <table class="table" style="text-align: center;">
                <thead>
                    <tr>
                        <th>Activity</th>
                        <th>Excellent</th>
                        <th>Good</th>
                        <th>Fair</th>
                        <th>Poor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fitting</td>
                        <td style="height: 25px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Comfort</td>
                        <td style="height: 25px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Running</td>
                        <td style="height: 25px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Walking</td>
                        <td style="height: 25px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <!-- Signature Section -->
            <div class="row" style="margin-top: 40px;">
                <div class="col-6" style="text-align: left; padding-left: 0px">
                    <p><?= strtoupper($patient['Name']) ?></p>
                    <p><strong>(Customer)</strong></p>
                    <p><strong>Date:</strong></p>
                </div>
                <div class="col-6" style="text-align: right; padding-right: 0px">
                    <p><?= $rightDoctorName ?></p>
                    <p><strong>(Orthotist)</strong></p>
                </div>
            </div>

            <div class="footer">
                © <?= date('Y') ?> StepCure | System Generated Consent Form
            </div>
        </div>
    </body>

    </html>
<?php
    return ob_get_clean();
}

function buildInvoicePDFFromHtml($reportData)
{
    // Extract with safe defaults
    $title          = $reportData['title'] ?? 'Analysis Report';
    $report_name          = $reportData['report_name'] ?? 'Analysis Report';
    $date           = $reportData['date'] ?? date('d M Y');
    $time           = $reportData['time'] ?? date('H:i A');
    $consultationId = $reportData['consultation_id'] ?? '0';

    $doctor         = $reportData['doctor'] ?? [];
    $clinicLogo     = $doctor['clinic_logo'] ?? '';
    $clinicName     = $doctor['clinic_name'] ?? 'Clinic Name';
    $doctorName     = $doctor['name'] ?? 'Dr. Name';
    $doctorDetails  = $doctor['details'] ?? 'MBBS, MD';
    $clinicAddress  = $doctor['address'] ?? 'Address not available';

    $rightLogo          = $doctor['right_logo'] ?? '';
    $rightClinicName    = $doctor['right_clinic_name'] ?? 'StepCure';
    $rightDoctorName    = $doctor['right_name'] ?? 'Consulting Doctor';
    $rightDoctorDetails = $doctor['right_details'] ?? 'No details';
    $rightClinicAddress = $doctor['right_address'] ?? 'No address';

    $patient         = $reportData['patient'] ?? [];
    $health          = $reportData['health'] ?? [];

    $items = $reportData['items'];
    $adjustment = $reportData['adjustment'];

    ob_start(); ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title><?= htmlspecialchars($title) ?></title>
        <style>
            @page {
                margin: 35px;
            }


            /* ✅ StepCure Watermark */
            body::after {
                content: "StepCure";
                position: fixed;
                top: 40%;
                left: 20%;
                font-size: 80px;
                color: rgba(100, 100, 100, 0.08);
                transform: rotate(-30deg);
                z-index: -1;
            }

            body {
                font-family: DejaVu Sans, sans-serif;
                font-size: 11px;
                background: #fff;
                color: #212529;
                margin: 0;
                padding: 0;
                line-height: 1.3;
            }

            .container {
                width: 100%;
                padding: 0;
                margin: 0;
            }

            h2,
            h4 {
                margin: 2px 0;
                font-weight: 600;
            }

            .section-title {
                font-size: 12px;
                font-weight: 600;
                padding: 3px 4px;
                margin-top: 8px;
                margin-bottom: 4px;
                background: #f1f3f5;
                border-left: 3px solid #678232;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 6px;
            }

            .table th,
            .table td {
                border: 1px solid #dee2e6;
                padding: 3px 4px;
                vertical-align: middle;
            }

            .table thead th {
                background: #e9ecef;
                font-weight: 600;
            }

            .card {
                border: 1px solid #dee2e6;
                border-radius: 3px;
                padding: 4px;
                margin-bottom: 4px;
            }

            .badge {
                display: inline-block;
                padding: 0.25em 0.45em;
                font-size: 10px;
                font-weight: 600;
                color: #fff;
                background-color: #678232;
                border-radius: 0.25rem;
            }

            .footer {
                text-align: center;
                font-size: 10px;
                margin-top: 8px;
            }

            p,
            li {
                margin: 2px 0;
            }

            ul {
                padding-left: 12px;
                margin: 2px 0;
            }

            /* ✅ Auto-shrink summary/recommendation if too long */
            /* .summary-section,
            .recommendation-section {
                font-size: < ?= $dynamicFontSize ?>;
            } */
        </style>
    </head>

    <body>
        <div class="container">

            <!-- HEADER -->
            <table width="100%" style="margin-bottom:6px;">
                <tr>
                    <!-- Left -->
                    <td width="33%" style="text-align:center;">
                        <?php if (!empty($clinicLogo)) : ?>
                            <img src="<?= $clinicLogo ?>" style="height:50px;width:50px;"><br>
                        <?php endif; ?>
                        <b><?= htmlspecialchars($clinicName) ?></b><br>
                        <?= htmlspecialchars($doctorName) ?><br>
                        <?= nl2br(htmlspecialchars($doctorDetails)) ?><br>
                        <?= nl2br(htmlspecialchars($clinicAddress)) ?>
                    </td>

                    <!-- Center -->
                    <td width="33%" style="text-align:center;">
                        <h2><?= htmlspecialchars($report_name) ?></h2>
                        <h4>Date: <?= htmlspecialchars($date) ?></h4>
                        <h4>Time: <?= htmlspecialchars($time) ?></h4>
                        <?php
                        if ($consultationId) {

                            echo '<h4>Consultation ID: ' . $consultationId . '</h4>';
                        }
                        ?>
                    </td>

                    <!-- Right -->
                    <td width="33%" style="text-align:center;">
                        <?php if (!empty($rightLogo)) : ?>
                            <img src="<?= $rightLogo ?>" style="height:50px;width:50px;"><br>
                        <?php endif; ?>
                        <b><?= htmlspecialchars($rightClinicName) ?></b><br>
                        <?= htmlspecialchars($rightDoctorName) ?><br>
                        <?= nl2br(htmlspecialchars($rightDoctorDetails)) ?><br>
                        <?= nl2br(htmlspecialchars($rightClinicAddress)) ?>
                    </td>
                </tr>
            </table>
            <hr style="margin:4px 0;">

            <!-- PATIENT & HEALTH DETAILS -->
            <table width="100%">
                <tr>
                    <td width="50%" valign="top" style="padding-right:6px;">
                        <div class="section-title">Basic Details</div>
                        <table class="table">
                            <?php if (!empty($patient)) : ?>
                                <?php foreach ($patient as $label => $value): ?>
                                    <tr>
                                        <th><?= htmlspecialchars($label) ?></th>
                                        <td><?= htmlspecialchars($value ?: 'N/A') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">No patient details available</td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </td>
                    <td width="50%" valign="top" style="padding-left:6px;">
                        <div class="section-title">Other Details</div>
                        <table class="table">
                            <?php if (!empty($health)) : ?>
                                <?php foreach ($health as $label => $value): ?>
                                    <tr>
                                        <th><?= htmlspecialchars($label) ?></th>
                                        <td><?= htmlspecialchars($value ?: 'N/A') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">No details available</td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </td>
                </tr>
            </table>

            <!-- Invoice Items -->
            <div class="section-title">Invoice Items</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Rate (Rs.)</th>
                        <th>Tax (%)</th>
                        <th>Total (Rs.)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sl = 1;
                    $total_amount = 0;
                    foreach ($items as $item) {
                        $total_amount += $item['amount'];
                    ?>
                        <tr>
                            <td><?= $sl ?></td>
                            <td><?= $item['product_name'] . '(' . $item['category_name'] . ')' ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= rupee($item['rate'], 'Rs. ') ?></td>
                            <td><?= $item['tax'] ?></td>
                            <td><?= rupee($item['amount'], 'Rs. ') ?></td>
                        </tr>
                    <?php
                        $sl++;
                    }


                    $grand_total = $total_amount + $adjustment;
                    ?>
                </tbody>
            </table>

            <!-- Summary -->
            <div class="row">
                <div class="col-6"></div>
                <div class="col-6">
                    <table class="table">
                        <tr>
                            <th>Subtotal</th>
                            <td><?= rupee($total_amount, 'Rs. ') ?></td>
                        </tr>
                        <tr>
                            <th>Adjustment</th>
                            <td><?= rupee($adjustment, 'Rs. ') ?></td>
                        </tr>
                        <tr>
                            <th><strong>Grand Total</strong></th>
                            <td><?= rupee($grand_total, 'Rs. ') ?></td>
                        </tr>
                        <tr>
                            <th><strong>In Words</strong></th>
                            <td><?= @in_words($grand_total) ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="footer">
                © <?= date('Y') ?> StepCure | System Generated Invoice
            </div>
        </div>
    </body>

    </html>
<?php
    return ob_get_clean();
}

function buildCustomerInvoicePDFFromHtml($reportData)
{
    $companyLogo    = $reportData['company_logo'] ?? '';
    $companyGSTIN   = $reportData['company_gstin'] ?? '';
    $companyAddress = $reportData['company_address'] ?? '';
    $companyCity    = $reportData['company_city'] ?? '';
    $companyState   = $reportData['company_state'] ?? '';
    $companyPIN     = $reportData['company_pin'] ?? '';
    $companyPhone   = $reportData['company_phone'] ?? '';
    $companyEmail   = $reportData['company_email'] ?? '';

    $invoiceNo      = $reportData['invoice_no'] ?? 'CSI-000';
    $invoiceDate    = $reportData['invoice_date'] ?? date('d M Y');
    $dueDate        = $reportData['due_date'] ?? date('d M Y');

    $customerName   = $reportData['customer_name'] ?? 'Customer Name';
    $customerGSTIN  = $reportData['customer_gstin'] ?? 'N/A';
    $billingAddress = $reportData['billing_address'] ?? 'N/A';
    $placeOfSupply  = $reportData['place_of_supply'] ?? 'N/A';

    $bankName       = systemVariable('bank_name');
    $accountName    = systemVariable('bank_account_name');
    $accountNumber  = systemVariable('bank_account_number');
    $ifscCode       = systemVariable('bank_ifsc_code');
    $branch         = systemVariable('bank_branch');
    $swiftCode      = systemVariable('swift_code');

    $items = $reportData['items'] ?? [];
    $summary = $reportData['summary'] ?? [];

    $taxableAmount    = $summary['taxable_amount'] ?? 0;
    $adjustment       = $summary['adjustment'] ?? 0;
    $grandTotal       = $summary['grand_total'] ?? 0;
    $amountInWords    = $summary['amount_in_words'] ?? 'Rupees ' . ucfirst(trim(in_words($grandTotal + $adjustment))) . ' Only';

    ob_start(); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Invoice <?= htmlspecialchars($invoiceNo) ?></title>
        <style>
            @page {
                margin: 35px;
            }

            /* ✅ StepCure Watermark */
            body::after {
                content: "StepCure";
                position: fixed;
                top: 40%;
                left: 20%;
                font-size: 80px;
                color: rgba(100, 100, 100, 0.08);
                transform: rotate(-30deg);
                z-index: -1;
            }

            body {
                font-family: Arial, sans-serif;
                font-size: 11px;
                color: #212529;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 100%;
                margin: 0 auto;
                padding: 0;
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                /* aligns top */
                border-bottom: 2px solid #678232;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }

            .company-left {
                display: flex;
                align-items: flex-start;
                /* align text with top of logo */
                gap: 14px;
                max-width: 60%;
                background-color: yellow;
                /* remove dark background */
            }

            .company-left img {
                height: 72px;
                width: auto;
                border-radius: 6px;
                object-fit: cover;
                border: 1px solid #e6e6e6;
                background: #fff;
                display: flex;
                flex-direction: row;
            }

            .company-details {
                line-height: 1.18;
                font-size: 12px;
            }

            .company-details h2 {
                margin: 0 0 2px 0;
                font-size: 16px;
                color: #678232;
                letter-spacing: 0.2px;
            }

            .text-right {
                text-align: right;
                width: 35%;
                background: pink;
                margin-top: 0;
                /* ensures it's top-aligned */
            }

            .section-title {
                font-weight: 600;
                color: #444;
                background: #f1f3f5;
                border-left: 4px solid #678232;
                padding: 6px 10px;
                margin-top: 20px;
                margin-bottom: 5px;
                font-size: 13px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 10px;
            }

            th,
            td {
                border: 1px solid #dee2e6;
                padding: 8px;
                vertical-align: middle;
            }

            th {
                background: #e9ecef;
                font-weight: 600;
            }

            .summary-table td:first-child {
                font-weight: 600;
            }

            .footer {
                text-align: center;
                font-size: 11px;
                color: #6c757d;
                margin-top: 30px;
                border-top: 1px solid #dee2e6;
                padding-top: 10px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <!-- Header Table -->
            <table width="100%" style="border-bottom:2px solid #678232; border-collapse:collapse; margin-bottom:20px;">
                <tr valign="middle" style="vertical-align:middle;">
                    <!-- Left: Logo + Company Details -->
                    <td width="65%" style="padding:0; border:none; vertical-align:middle;">
                        <table width="100%" style="border:none;">
                            <tr valign="middle" style="vertical-align:middle;">
                                <td style="width:80px; padding:0 10px 0 0; border:none; vertical-align:middle; text-align:left;">
                                    <img src="<?= htmlspecialchars($companyLogo) ?>" alt="Company Logo"
                                        style="height:72px; border:none; display:block;">
                                </td>
                                <td style="border:none; vertical-align:middle;">
                                    <h2 style="margin:0; font-size:16px; color:#678232;">StepCure</h2>
                                    <div style="font-size:10px; line-height:1.5;">
                                        GSTIN: <?= htmlspecialchars($companyGSTIN) ?><br>
                                        <?= nl2br(htmlspecialchars($companyAddress)) ?><br>
                                        <?= htmlspecialchars($companyCity) ?>, <?= strtoupper(htmlspecialchars($companyState)) ?> - <?= htmlspecialchars($companyPIN) ?><br>
                                        Mobile: <?= htmlspecialchars($companyPhone) ?><br>
                                        Email: <?= htmlspecialchars($companyEmail) ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>

                    <!-- Right: Invoice Number + Dates -->
                    <td width="35%" align="right" style="border:none; padding:0; vertical-align:middle; text-align:right;">
                        <h3 style="margin:0 0 5px 0; font-size:16px; font-weight:bold;">TAX INVOICE</h3>
                        <div style="font-size:10px; line-height:1.5;">
                            Invoice No: <?= htmlspecialchars($invoiceNo) ?><br>
                            Invoice Date: <?= htmlspecialchars($invoiceDate) ?><br>
                            Due Date: <?= htmlspecialchars($dueDate) ?>
                        </div>
                    </td>
                </tr>
            </table>




            <!-- Bank Details -->
            <div class="section-title">Bank Details</div>
            <table>
                <tr>
                    <th>Bank Name</th>
                    <td><?= htmlspecialchars($bankName) ?></td>
                </tr>
                <tr>
                    <th>Account Name</th>
                    <td><?= htmlspecialchars($accountName) ?></td>
                </tr>
                <tr>
                    <th>Account Number</th>
                    <td><?= htmlspecialchars($accountNumber) ?></td>
                </tr>
                <tr>
                    <th>IFSC Code</th>
                    <td><?= htmlspecialchars($ifscCode) ?></td>
                </tr>
                <tr>
                    <th>SWIFT Code</th>
                    <td><?= htmlspecialchars($swiftCode) ?></td>
                </tr>
                <tr>
                    <th>Branch</th>
                    <td><?= htmlspecialchars($branch) ?></td>
                </tr>
            </table>

            <!-- Customer Details -->
            <div class="section-title">Customer Details</div>
            <table>
                <tr>
                    <th>Customer Name</th>
                    <td><?= htmlspecialchars($customerName) ?></td>
                </tr>
                <tr>
                    <th>GSTIN</th>
                    <td><?= htmlspecialchars($customerGSTIN) ?></td>
                </tr>
                <tr>
                    <th>Billing Address</th>
                    <td><?= nl2br(htmlspecialchars($billingAddress)) ?></td>
                </tr>
                <tr>
                    <th>Place of Supply</th>
                    <td><?= htmlspecialchars($placeOfSupply) ?></td>
                </tr>
            </table>


            <!-- Items -->
            <div class="section-title">Invoice Items</div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item Description</th>
                        <th>Qty</th>
                        <th>Rate (Rs.)</th>
                        <th>Taxable Value (Rs.)</th>
                        <?php if ($summary['is_igst']): ?>
                            <th>IGST (Rs.)</th>
                        <?php else: ?>
                            <th>CGST (Rs.)</th>
                            <th>SGST (Rs.)</th>
                        <?php endif; ?>
                        <th>Total (Rs.)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl = 1;
                    $total_cgst = 0;
                    $total_sgst = 0;
                    $total_igst = 0;
                    foreach ($items as $item):
                        $total_cgst += $item['cgst'] * $item['taxable'] / 100;
                        $total_sgst += $item['sgst'] * $item['taxable'] / 100;
                        $total_igst += $item['igst'] * $item['taxable'] / 100;
                    ?>
                        <tr>
                            <td><?= $sl++ ?></td>
                            <td><?= htmlspecialchars($item['description']) ?></td>
                            <td><?= $item['qty'] ?></td>
                            <td><?= number_format($item['rate'], 2) ?></td>
                            <td><?= number_format($item['taxable'], 2) ?></td>
                            <?php if ($summary['is_igst']): ?>
                                <td><?= number_format($item['igst'] * $item['taxable'] / 100, 2) ?> (<?= $item['igst'] ?>%)</td>
                            <?php else: ?>
                                <td><?= number_format($item['cgst'] * $item['taxable'] / 100, 2) ?> (<?= $item['cgst'] ?>%)</td>
                                <td><?= number_format($item['sgst'] * $item['taxable'] / 100, 2) ?> (<?= $item['sgst'] ?>%)</td>
                            <?php endif; ?>
                            <td><?= number_format($item['total'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <!-- Summary -->
            <div class="section-title">Summary</div>
            <table class="summary-table">
                <tr>
                    <td>Taxable Amount</td>
                    <td>Rs. <?= number_format($taxableAmount, 2) ?></td>
                </tr>
                <?php if ($summary['is_igst']): ?>
                    <tr>
                        <td>IGST</td>
                        <td>Rs. <?= number_format($total_igst, 2) ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td>CGST</td>
                        <td>Rs. <?= number_format($total_cgst, 2) ?></td>
                    </tr>
                    <tr>
                        <td>SGST</td>
                        <td>Rs. <?= number_format($total_sgst, 2) ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td><strong>Grand Total</strong></td>
                    <td><strong>Rs. <?= number_format($grandTotal, 2) ?></strong></td>
                </tr>
                <tr>
                    <td>Adjustment</td>
                    <td>Rs. <?= number_format($adjustment, 2) ?></td>
                </tr>
                <tr>
                    <td>Amount Payable</td>
                    <td>Rs. <?= number_format($grandTotal + $adjustment, 2) ?></td>
                </tr>
                <tr>
                    <td>Amount in Words</td>
                    <td><?= htmlspecialchars($amountInWords) ?></td>
                </tr>
            </table>


            <div class="footer">
                © <?= date('Y') ?> StepCure Clinic | This invoice is system-generated.
            </div>
        </div>
    </body>

    </html>
<?php
    return ob_get_clean();
}





function prepareReportData($consultation_id)
{

    $consultation = getConsultationById($consultation_id);
    $consultation = mysqli_fetch_assoc($consultation);

    // get site details like site name, address, ref dr. details
    $site_id = $consultation['site_id'];
    $site = getSiteById($site_id);
    $site = mysqli_fetch_assoc($site);
    $address_state = $site['address_state'];
    $address_state = getAddressStateById($address_state);
    $site_address = $site['address'] . ', ' . $site['address_city'] . ', ' . $address_state['state_name'] . ' - ' . $site['address_pin'];

    // get consulting user/dr details
    $user_id = $consultation['user_id'];
    $user = getUserById($user_id);
    $user = mysqli_fetch_assoc($user);
    $honorifics = $user['user_designation'];
    $honorifics = getUserDesignationById($honorifics);
    $honorifics = mysqli_fetch_assoc($honorifics);
    $honorifics = $honorifics['default_honorifics'];
    $consulting_dr = $honorifics . ' ' . $user['first_name'] . ' ' . $user['last_name'];

    // get patient details
    $patient_id = $consultation['patient_id'];
    $patient = getPatientById($patient_id);
    $patient = mysqli_fetch_assoc($patient);
    $patient_bmi = calculateBMI($patient['weight'], $patient['height']);

    $consultation_prior_issues = $consultation['prior_issues'];
    $consultation_prior_issues = array_map('intval', explode(",", $consultation_prior_issues));
    $prior_issues_list = getPriorIssuesList();
    $prior_issues_string = '';

    if (mysqli_num_rows($prior_issues_list) != 0) {
        while ($row = mysqli_fetch_assoc($prior_issues_list)) {

            // check if the current prior_issue is already in data of patient's prior issue
            if (in_array($row['id'], $consultation_prior_issues)) {
                $prior_issues_string .= $row['issue_name'] . ': Yes | ';
            }
        }
    }

    $prior_issues_string = rtrim($prior_issues_string, ' | ');


    $reportData = [
        'title' => 'Foot Analysis Report for ' . 'PI-' . prefix_00($patient['patientid']) . ' ' . $patient['first_name'] . ' ' . $patient['last_name'],
        'report_name' => 'Foot Analysis Report',
        'date'  => date('jS F, Y'),
        'time'  => date('h:i:s A'),
        'consultation_id' => 'CI-' . prefix_00($consultation['consultationid']),

        'doctor' => [
            'clinic_logo'   => safeValue(systemVariable('SITE_HOME') . 'uploads/' . $site['site_logo']),
            'clinic_name'   => safeValue($site['site_name']),
            'name'          => safeValue($site['ref_person_name']),
            'details'       => safeValue($site['ref_person_details']),
            'address'       => safeValue($site_address),

            'right_logo'    => safeValue(systemVariable('SITE_HOME') . 'uploads/' . systemVariable('SITE_LOGO')),
            'right_clinic_name' => 'StepCure',
            'right_name'    => safeValue($consulting_dr),
            'right_details' => 'Phone: ' . safeValue($user['phone']),
            'right_address' => 'Email: ' . safeValue($user['email'])
        ],
        'patient' => [
            'Patient ID' => 'PI-' . prefix_00($patient['patientid']),
            'Name' => $patient['first_name'] . ' ' . $patient['last_name'],
            'Age' => $patient['age'] . ' years',
            'Gender' => $patient['gender'] == 'm' ? "Male" : ($patient['gender'] == 'f' ? "Female" : "Others")
        ],
        'health' => [
            'BMI' => $patient_bmi . ' kg/m²',
            'Diabetic Level' => $patient['diabetic_level'],
            'Diabetes Value' => $patient['diabetic_value'],
            'Foot Examination' => $patient['is_foot_examination_done'] ? 'Completed' : 'Pending'
        ],
        'foot_scan' => [
            'Left' => ['foot_type' => $consultation['scan_3d_left_foot_type'], 'arch_type' => $consultation['scan_3d_left_arch_type'], 'heel_angle' => $consultation['scan_3d_left_heel_angle']],
            'Right' => ['foot_type' => $consultation['scan_3d_right_foot_type'], 'arch_type' => $consultation['scan_3d_right_arch_type'], 'heel_angle' => $consultation['scan_3d_right_heel_angle']]
        ],
        'plantar_pressure' => [
            'Left' => ['morphotype' => $consultation['scan_planter_pressure_left_morpho_type'], 'pressure' => $consultation['scan_planter_pressure_left_max_pressure']],
            'Right' => ['morphotype' => $consultation['scan_planter_pressure_right_morpho_type'], 'pressure' => $consultation['scan_planter_pressure_right_max_pressure']]
        ],
        'ankle_brachial' => [
            'Dorsalis Pedis' => ['left' => $consultation['ankle_brachial_left_dorsalis_pedis'], 'right' => $consultation['ankle_brachial_right_dorsalis_pedis']],
            'Arm AP' => ['left' => $consultation['ankle_brachial_left_arm_ap'], 'right' => $consultation['ankle_brachial_right_arm_ap']]
        ],
        'prior_issues' => $prior_issues_string,
        'summary' => $consultation['summary_report'],
        'recommendation' => $consultation['prescriptions']
    ];

    return $reportData;
}

function prepareConsentFormData($consultation_id, $patient_id, $user_id, $site_id, $saleid)
{

    $consultation = $consultation_id != 0 ? getConsultationById($consultation_id) : 0;
    $consultation =  $consultation_id != 0 ? mysqli_fetch_assoc($consultation) : 0;

    // get site details like site name, address, ref dr. details
    $site = getSiteById($site_id);
    $site = mysqli_fetch_assoc($site);
    $address_state = $site['address_state'];
    $address_state = getAddressStateById($address_state);
    $site_address = $site['address'] . ', ' . $site['address_city'] . ', ' . $address_state['state_name'] . ' - ' . $site['address_pin'];

    // get consulting user/dr details
    $user = getUserByUserId($user_id);
    $user = mysqli_fetch_assoc($user);
    $honorifics = $user['user_designation'];
    $honorifics = getUserDesignationById($honorifics);
    $honorifics = mysqli_fetch_assoc($honorifics);
    $honorifics = $honorifics['default_honorifics'];
    $consulting_dr = $honorifics . ' ' . $user['first_name'] . ' ' . $user['last_name'];

    // get patient details
    $patient = getPatientById($patient_id);
    $patient = mysqli_fetch_assoc($patient);
    $patient_bmi = calculateBMI($patient['weight'], $patient['height']);


    $reportData = [
        'title' => 'Consent Form for ' . 'PI-' . prefix_00($patient['patientid']) . ' ' . $patient['first_name'] . ' ' . $patient['last_name'],
        'report_name' => 'Consent Form',
        'date'  => date('jS F, Y'),
        'time'  => date('h:i:s A'),

        'consultation_id' => $consultation_id != 0 ? 'CI-' . prefix_00($consultation['consultationid']) : 0,

        'doctor' => [
            'clinic_logo'   => safeValue(systemVariable('SITE_HOME') . 'uploads/' . $site['site_logo']),
            'clinic_name'   => safeValue($site['site_name']),
            'name'          => safeValue($site['ref_person_name']),
            'details'       => safeValue($site['ref_person_details']),
            'address'       => safeValue($site_address),

            'right_logo'    => safeValue(systemVariable('SITE_HOME') . 'uploads/' . systemVariable('SITE_LOGO')),
            'right_clinic_name' => 'StepCure',
            'right_name'    => safeValue($consulting_dr),
            'right_details' => 'Phone: ' . safeValue($user['phone']),
            'right_address' => 'Email: ' . safeValue($user['email'])
        ],
        'patient' => [
            'Patient ID' => 'PI-' . prefix_00($patient['patientid']),
            'Name' => $patient['first_name'] . ' ' . $patient['last_name'],
            'Age' => $patient['age'] . ' years',
            'Gender' => $patient['gender'] == 'm' ? "Male" : ($patient['gender'] == 'f' ? "Female" : "Others")
        ],
        'health' => [
            'Phone No' => $patient['phone'],
            'For Invoice No' => $saleid,
            'BMI' => $patient_bmi . ' kg/m²',
            'Diabetic Level' => $patient['diabetic_level']
        ]
    ];

    return $reportData;
}

function prepareInvoiceData($invoice_number, $consultation_id, $patient_id, $user_id, $site_id, $saleid, $sale_id)
{

    $consultation = $consultation_id != 0 ? getConsultationById($consultation_id) : 0;
    $consultation =  $consultation_id != 0 ? mysqli_fetch_assoc($consultation) : 0;

    // get site details like site name, address, ref dr. details
    $site = getSiteById($site_id);
    $site = mysqli_fetch_assoc($site);
    $address_state = $site['address_state'];
    $address_state = getAddressStateById($address_state);
    $site_address = $site['address'] . ', ' . $site['address_city'] . ', ' . $address_state['state_name'] . ' - ' . $site['address_pin'];

    // get consulting user/dr details
    $user = getUserById($user_id);
    $user = mysqli_fetch_assoc($user);
    $honorifics = $user['user_designation'] || '';
    if ($honorifics) {
        $honorifics = getUserDesignationById($honorifics);
        $honorifics = mysqli_fetch_assoc($honorifics);
        $honorifics = $honorifics['default_honorifics'];
    }
    $consulting_dr = $honorifics . ' ' . $user['first_name'] . ' ' . $user['last_name'];

    // get patient details
    $patient = getPatientById($patient_id);
    $patient = mysqli_fetch_assoc($patient);
    $patient_bmi = calculateBMI($patient['weight'], $patient['height']);

    // get sale details
    $sale = getSaleById($sale_id);
    $sale = mysqli_fetch_assoc($sale);

    // sale items
    $sale_items = getSaleItemsBySaleId($sale_id);
    $items = [];
    if (mysqli_num_rows($sale_items) > 0) {
        while ($item = mysqli_fetch_assoc($sale_items)) {
            $product = getProductById($item['product_id']);
            $product = mysqli_fetch_assoc($product);
            $category = getProductCategoryById($product['category_id']);
            $category = mysqli_fetch_assoc($category);
            array_push($items, [
                'product_name' => $product['product_name'],
                'category_name' => $category['category_name'],
                'quantity' => $item['quantity'],
                'rate' => $item['rate'],
                'tax' => $item['tax'],
                'amount' => $item['amount'],
            ]);
        }
    }


    $reportData = [
        'title' => 'Invoice for ' . 'PI-' . prefix_00($patient['patientid']) . ' ' . $patient['first_name'] . ' ' . $patient['last_name'],
        'report_name' => 'Invoice',
        'date'  => date('jS F, Y'),
        'time'  => date('h:i:s A'),

        'consultation_id' => $consultation_id != 0 ? 'CI-' . prefix_00($consultation['consultationid']) : 0,

        'doctor' => [
            'clinic_logo'   => safeValue(systemVariable('SITE_HOME') . 'uploads/' . $site['site_logo']),
            'clinic_name'   => safeValue($site['site_name']),
            'name'          => safeValue($site['ref_person_name']),
            'details'       => safeValue($site['ref_person_details']),
            'address'       => safeValue($site_address),

            'right_logo'    => safeValue(systemVariable('SITE_HOME') . 'uploads/' . systemVariable('SITE_LOGO')),
            'right_clinic_name' => 'StepCure',
            'right_name'    => safeValue($consulting_dr),
            'right_details' => 'Phone: ' . safeValue($user['phone']),
            'right_address' => 'Email: ' . safeValue($user['email'])
        ],
        'patient' => [
            'Patient ID' => 'PI-' . prefix_00($patient['patientid']),
            'Name' => $patient['first_name'] . ' ' . $patient['last_name'],
            'Age' => $patient['age'] . ' years',
            'Gender' => $patient['gender'] == 'm' ? "Male" : ($patient['gender'] == 'f' ? "Female" : "Others")
        ],
        'health' => [
            'Invoice No' => 'SI-' . $invoice_number,
            'Phone No' => $patient['phone'],
            'BMI' => $patient_bmi . ' kg/m²',
            'Diabetic Level' => $patient['diabetic_level']
        ],
        'items' => $items,
        'adjustment' => $sale['adjustment']
    ];

    return $reportData;
}

function prepareCustomerInvoiceData($invoice_id, $invoice_number, $invoice_date, $due_date, $customer_name, $customer_gstin, $customer_billing_address, $place_of_supply, $adjustment, $is_igst = false)
{
    // Get site info
    $hub_id = systemVariable('default_site_id');
    $hub = getSiteById($hub_id);
    $hub = mysqli_fetch_assoc($hub);

    // Sale
    $invoice_items = getInvoiceItemsByInvoiceId($invoice_id);

    $items = [];
    $taxable_amount = 0;
    $total_igst = 0;
    $total_cgst = 0;
    $total_sgst = 0;
    $grand_total = 0;
    $tax_rate = '0%';

    if (mysqli_num_rows($invoice_items) > 0) {
        while ($item = mysqli_fetch_assoc($invoice_items)) {
            $product = mysqli_fetch_assoc(getProductById($item['product_id']));
            $category = mysqli_fetch_assoc(getProductCategoryById($product['category_id']));

            $taxable = $item['quantity'] * $item['rate'];

            $cgst = $item['cgst'];
            $sgst = $item['sgst'];
            $igst = $item['igst'];

            $total = $taxable + $cgst * $taxable / 100 + $sgst * $taxable / 100 + $igst * $taxable / 100;

            $items[] = [
                'description' => $product['product_name'] . ' (' . $category['category_name'] . ')',
                'qty' => $item['quantity'],
                'rate' => $item['rate'],
                'taxable' => $taxable,
                'igst' => $igst,
                'cgst' => $cgst,
                'sgst' => $sgst,
                'total' => $total
            ];

            $taxable_amount += $taxable;
            $grand_total += $total;
        }
    }

    $companyState = systemVariable('company_state');
    $companyState = getAddressStateById($companyState);
    $companyState = $companyState['state_name'];

    $reportData = [
        'company_logo' => systemVariable('SITE_HOME') . 'uploads/' . systemVariable('SITE_LOGO'),
        'company_gstin' => systemVariable('company_gstin'),
        'company_address' => systemVariable('company_address'),
        'company_city' => systemVariable('company_city'),
        'company_state' => ucwords($companyState),
        'company_pin' => systemVariable('company_pin'),
        'company_phone' => systemVariable('company_phone'),
        'company_email' => systemVariable('company_email'),

        'invoice_no' => $invoice_number,
        'invoice_date' => date('jS F, Y', strtotime($invoice_date)),
        'due_date' => date('jS F, Y', strtotime($due_date)),

        'customer_name' => $customer_name,
        'customer_gstin' => $customer_gstin,
        'billing_address' => $customer_billing_address,
        'place_of_supply' => $place_of_supply,

        'items' => $items,
        'summary' => [
            'taxable_amount' => $taxable_amount,
            'tax_amount' => $is_igst ? $total_igst : ($total_cgst + $total_sgst),
            'tax_rate' => $tax_rate,
            'grand_total' => $grand_total,
            'igst' => $total_igst,
            'cgst' => $total_cgst,
            'sgst' => $total_sgst,
            'adjustment' => $adjustment,
            'amount_in_words' => ucfirst(trim(in_words($grand_total + $adjustment))),
            'is_igst' => $is_igst
        ]
    ];

    return $reportData;
}



function updateSystemVariable($variable_name, $variable_value, $current_admin)
{

    $current_system_variable_value = systemVariable($variable_name);

    if ($current_system_variable_value != $variable_value) {
        addNewAdminUpdate($current_admin, 'Updated the Application Settings. They have changed the ' . $variable_name . ' from "' . systemVariable($variable_name) . '" to "' . $variable_value . '"');
    }

    $query = "UPDATE `systemv` SET `value` = '$variable_value' WHERE `systemv`.`variable` = '$variable_name';";
    $run_query = runQuery($query);
    return $run_query;
}

function updateSystemVariables($list_of_variables, $current_admin)
{

    foreach ($list_of_variables as $key => $value) {
        updateSystemVariable($key, $value, $current_admin);
    }
}
