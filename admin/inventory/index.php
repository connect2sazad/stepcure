<?php

// inventory_id is the product_id
// transactions_mode is the view mode for transactions


require_once __DIR__ . '/../admin.php';

// Define current module
define('PERMISSION_NAME', 'inventory');

define('ALL_PERMISSIONS', getAllPermissionsByPERMISSION_NAME());
define('USER_ALLOWED_PERMISSIONS', getUserPermissionsByPERMISSION_NAME());
define('USER_GROUP_ALLOWED_PERMISSIONS', getUserGroupPermissionsByPERMISSION_NAME());

// Fetch all permissions for current user
$user_permissions        = USER_ALLOWED_PERMISSIONS;
$user_group_permissions  = USER_GROUP_ALLOWED_PERMISSIONS;

$current_admin = $_SESSION[USER_AUTH];

if (!checkPermissions('view', $user_permissions, $user_group_permissions)) {
    include_once __DIR__ . "/../errors/401.php";
    exit;
}

$inventory_id_exists  = isset($_GET['id']) && $_GET['id'] !== '';

$transactions_mode = isset($_GET['transactions']); // ✅ Detect "view" param in URL

if ($inventory_id_exists) {
    $inventory_id = $_GET['id'];
    $inventory = getInventoryById($inventory_id);

    // if inventory is not found
    if (!$inventory || mysqli_num_rows($inventory) == 0) {
        // header('location: ' . SITE_URL . 'inventory/');
        include_once __DIR__ . "/../errors/404.php";
        exit;
    }

    $inventory = mysqli_fetch_assoc($inventory);

    // get product_id from inventory and fetch product details
    $product_id = $inventory['product_id'];
    $product = getProductById($product_id);
    $product = mysqli_fetch_assoc($product);

    $site_id = $inventory['site_id'];
    $site = getSiteById($site_id);
    $site = mysqli_fetch_assoc($site);


    // ✅ Permission check for view/edit
    if ($transactions_mode) {

        // View mode requires 'view'
        $user_group = userVariable('user_group');
        $has_permission = checkPermissions('view', $user_permissions, $user_group_permissions);
        $is_site_matched = ($site_id == userVariable('treatment_site'));
        $is_authorized_group = ($user_group == 1 || $user_group == 2);
        if (!$has_permission || (!$is_site_matched && !$is_authorized_group)) {
            include_once __DIR__ . "/../errors/401.php";
            exit;
        }
    } else {
        // Edit mode requires 'update'
        if (!checkPermissions('update', $user_permissions, $user_group_permissions)) {
            include_once __DIR__ . "/../errors/401.php";
            exit;
        }
    }
}

// If just listing inventory (default view)
if (!$inventory_id_exists) {
    // Listing requires at least 'view'
    if (!checkPermissions('view', $user_permissions, $user_group_permissions)) {
        include_once __DIR__ . "/../errors/401.php";
        exit;
    }
}

// ✅ If we reach here → user is authorized for this page mode
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="./" data-template="vertical-inventory-template-free">

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
            <!-- UserDesignation -->

            <?= loadAdminSidebar('Inventory') ?>
            <!-- / UserDesignation -->

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
                        if ($inventory_id_exists) {
                            echo '<h4 class="fw-bold py-3 mb-4"><i class="fas fa-warehouse"></i> <span class="text-muted fw-light"><a href="./">Inventory</a> /</span> <span id="inventory-edit-title">' . $product['product_name'] . ' : ' . $site['site_id'] . ' (' . $site['site_name'] . ') </span></h4>';
                        } else {
                            echo '<h4 class="fw-bold py-3 mb-4"><i class="fas fa-warehouse"></i> Inventory </h4>';
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-12">

                                <?php
                                if ($inventory_id_exists) {
                                    if ($transactions_mode) {
                                        include_once('inventory-transactions.php'); // ✅ If URL has &view
                                    }
                                } else {
                                    include_once('inventory.php');
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
            <!-- / Layout inventory -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-inventory-toggle"></div>
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
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'inventorybreak',
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
            inventorybar: 'favs file edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
            statusbar: false,
            fontsize_formats: '6pt 8pt 10pt 12pt 14pt 18pt 24pt 36pt 72pt',
            // skin: skin,
            // content_css: content_css,
        });
    </script>

</body>

</html>