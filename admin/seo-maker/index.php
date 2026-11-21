<?php

require_once __DIR__ . '/../admin.php';
require_once __DIR__ . '/cons.php';

// Define current module
define('PERMISSION_NAME', 'seo_maker_settings');

define('ALL_PERMISSIONS', getAllPermissionsByPERMISSION_NAME());
define('USER_ALLOWED_PERMISSIONS', getUserPermissionsByPERMISSION_NAME());
define('USER_GROUP_ALLOWED_PERMISSIONS', getUserGroupPermissionsByPERMISSION_NAME());

// Fetch all permissions for current user
$user_permissions        = USER_ALLOWED_PERMISSIONS;
$user_group_permissions  = USER_GROUP_ALLOWED_PERMISSIONS;


$current_admin = $_SESSION[USER_AUTH];

if (array_key_exists('tool', $_GET)) {
    $tool_exists = true;
    $tool = $_GET['tool'];
    if ($tool == '') {
        header('location: ' . systemVariable('SITE_HOME') . 'admin/seo-maker/');
    }
} else {
    $tool_exists = false;
}

if (!checkPermissions('update', $user_permissions, $user_group_permissions)) {
    include_once __DIR__ . "/../errors/401.php";
    exit;
}

// $is_super_powered = adminVariable('super_power');

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="./" data-template="vertical-menu-template-free">

<head>

    <?= loadAdminMetaData() ?>
    <?= loadAdminTitleAndFavicon() ?>
    <?= loadAdminStyleSheets() ?>
    <?= loadAdminScripts() ?>
    <?= getAjaxRequester() ?>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?= loadAdminSidebar('SEO Maker') ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?= loadAdminNavbar() ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">

                        <?php
                            if ($tool_exists) {
                                $check_tool = __SEO_MAKER_TOOLS___ . $tool;
                                if (is_dir($check_tool) || file_exists($check_tool)) {
                                    if (file_exists(__SEO_MAKER_TOOLS___ . $tool . "/" . $tool . ".php")) {
                                        include_once "tools/" . $tool . "/" . $tool . ".php";
                                    } else {
                                        include_once "tools-list.php";
                                    }
                                } else {
                                    include_once "tools-list.php";
                                }
                            } else {
                                include_once "tools-list.php";
                            }
                        ?>

                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?= loadAdminFooter() ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <?= loadAdminFooterScripts() ?>


</body>

</html>