<?php

require_once __DIR__ . '/../admin.php';

// Define current module
define('PERMISSION_NAME', 'user_group');

define('ALL_PERMISSIONS', getAllPermissionsByPERMISSION_NAME());
define('USER_ALLOWED_PERMISSIONS', getUserPermissionsByPERMISSION_NAME());
define('USER_GROUP_ALLOWED_PERMISSIONS', getUserGroupPermissionsByPERMISSION_NAME());

// Fetch all permissions for current user
$user_permissions        = USER_ALLOWED_PERMISSIONS;
$user_group_permissions  = USER_GROUP_ALLOWED_PERMISSIONS;

// get current logged in user
$current_admin = $_SESSION[USER_AUTH];

// check if view permission is present
if (!checkPermissions('view', $user_permissions, $user_group_permissions)) {
    include_once __DIR__ . "/../errors/401.php";
    exit;
}

$new_user_group_create = isset($_GET['new_user_group']);
$user_group_id_exists  = isset($_GET['id']) && $_GET['id'] !== '';

$view_mode = isset($_GET['view']); // ✅ Detect "view" param in URL

if ($user_group_id_exists) {
    $user_group_id = $_GET['id'];
    $user_group = getUserGroupById($user_group_id);

    // if user_group is not found
    if (!$user_group || mysqli_num_rows($user_group) == 0) {
        // header('location: ' . SITE_URL . 'user_groups/');
        include_once __DIR__ . "/../errors/404.php";
        exit;
    }

    $user_group = mysqli_fetch_assoc($user_group);

    //  if user_group is deleted
    if ($user_group['is_deleted'] == 1) {
        // header('location: ' . SITE_URL . 'user_groups/'); // replace this with 404 error page
        include_once __DIR__ . "/../errors/404.php";
        exit;
    }

    // ✅ Permission check for view/edit
    if ($view_mode) {
        // View mode requires 'view'
        if (!checkPermissions('view', $user_permissions, $user_group_permissions)) {
            include_once __DIR__."/../errors/401.php";
            exit;
        }
    } else {
        // Edit mode requires 'update'
        if (!checkPermissions('update', $user_permissions, $user_group_permissions)) {
            include_once __DIR__."/../errors/401.php";
            exit;
        }
    }
}

// If creating a new site
if ($new_user_group_create) {
    // Create mode requires 'create'
    if (!checkPermissions('create', $user_permissions, $user_group_permissions)) {
        include_once __DIR__."/../errors/401.php";
        exit;
    }
}

// If just listing sites (default view)
if (!$user_group_id_exists && !$new_user_group_create) {
    // Listing requires at least 'view'
    if (!checkPermissions('view', $user_permissions, $user_group_permissions)) {
        include_once __DIR__."/../errors/401.php";
        exit;
    }
}

// ✅ If we reach here → user is authorized for this page mode
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="./" data-template="vertical-user_group-template-free">

<head>

    <?= loadAdminMetaData() ?>
    <?= loadAdminTitleAndFavicon() ?>
    <?= loadAdminStyleSheets() ?>
    <?= loadAdminScripts() ?>
    <?= getAjaxRequester() ?>
    <style>
        ::-webkit-inner-spin-button {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- UserGroup -->

            <?= loadAdminSidebar('User Groups') ?>
            <!-- / UserGroup -->

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
                        if ($user_group_id_exists) {
                            echo '<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="./">User Groups</a> /</span> <span id="user_group-edit-name">' . $user_group['group_name'] . '</span></h4>';
                        } else if ($new_user_group_create) {
                            echo '<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="./">User Groups</a> /</span> New User Group</h4>';
                        } else {
                            echo '<h4 class="fw-bold py-3 mb-4">User Groups List</h4>';
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                if ($user_group_id_exists) {
                                    if ($view_mode) {
                                        include_once('user_group-view.php'); // ✅ If URL has &view
                                    } else {
                                        include_once('user_group-edit.php'); // ✅ Otherwise edit mode
                                    }
                                } elseif ($new_user_group_create) {
                                    include_once('new-user_group.php');
                                } else {
                                    include_once('user_groups-list.php');
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?= loadAdminFooter() ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout user_group -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-user_group-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <?= loadAdminFooterScripts() ?>

    <script src="<?= SITE_URL ?>assets/vendor/libs/tinymce/tinymce.min.js"></script>

    <script>
        // $('#tox-statusbar__branding').hide();
        $('.tox-promotion').hide();
        tinymce.init({
            selector: 'textarea:not([data-info="remarks"])',
            height: 500,
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'user_groupbreak',
                'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
                'table', 'emoticons', 'template', 'help'
            ],
            toolbar1: 'undo redo | styleselect | bold italic underline ' +
                'fontsizeselect fontselect | forecolor backcolor',
            toolbar2: ' spellchecker | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat lineheight | code fullscreen codesample preview | help',
            table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
            table_appearance_options: true,
            spellchecker_dialog: true,
            user_groupbar: 'favs file edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
            statusbar: false,
            fontsize_formats: '6pt 8pt 10pt 12pt 14pt 18pt 24pt 36pt 72pt',
            // skin: skin,
            // content_css: content_css,
        });
    </script>

</body>

</html>