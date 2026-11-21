<?php

// inventory_id is the product_id
// transactions_mode is the view mode for transactions


require_once __DIR__ . '/../../admin.php';

// Define current module
define('PERMISSION_NAME', 'inventory');

define('ALL_PERMISSIONS', getAllPermissionsByPERMISSION_NAME());
define('USER_ALLOWED_PERMISSIONS', getUserPermissionsByPERMISSION_NAME());
define('USER_GROUP_ALLOWED_PERMISSIONS', getUserGroupPermissionsByPERMISSION_NAME());

// Fetch all permissions for current user
$user_permissions        = USER_ALLOWED_PERMISSIONS;
$user_group_permissions  = USER_GROUP_ALLOWED_PERMISSIONS;

$current_admin = $_SESSION[USER_AUTH];

if (!checkPermissions('update', $user_permissions, $user_group_permissions)) {
    include_once __DIR__ . "/../../errors/401.php";
    exit;
}

$inventory_id_exists  = isset($_GET['id']) && $_GET['id'] !== '';

if ($inventory_id_exists) {
    $inventory_id = $_GET['id'];
    $inventory = getInventoryById($inventory_id);

    // if inventory is not found
    if (!$inventory || mysqli_num_rows($inventory) == 0) {
        // header('location: ' . SITE_URL . 'inventory/');
        include_once __DIR__ . "/../../errors/404.php";
        exit;
    }

    $inventory = mysqli_fetch_assoc($inventory);
}

// adding stocks (default view)
if ($inventory_id_exists) {
    // Editing requires at least 'update'
    if (!checkPermissions('update', $user_permissions, $user_group_permissions)) {
        include_once __DIR__ . "/../../errors/401.php";
        exit;
    }
} else {
    include_once __DIR__ . "/../../errors/404.php";
    exit;
}

// ✅ If we reach here → user is authorized for this page mode








// get required data for the page
// get inventory details
$inventory = getInventoryById($inventory_id);
$inventory = mysqli_fetch_assoc($inventory);

// get user group to check if the user is admin or super admin
$current_user_group = userVariable('user_group');

$user_site = '';
// check if the user is admin 2 or super admin 1
if ($current_user_group != 1 || $current_user_group != 2) {
    // get treatment site for the current user
    $user_site = userVariable('treatment_site');
}
$sites_options = getTreatmentSiteOptions();

// get product details
$product_id = $inventory['product_id'];
$product = getProductById($product_id);
$product = mysqli_fetch_assoc($product);

// get category details
$category = getProductCategoryById($product['category_id']);
$category = mysqli_fetch_assoc($category);









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

                        <h4 class="fw-bold py-3 mb-4"><i class="fas fa-warehouse"></i> <span class="text-muted fw-light"><a href="../">Inventory</a> /</span> <span id="inventory-edit-title">Add Stock</span></h4>



                        <div class="row">

                            <!-- summary cards -->
                            <div class="col-md-4">

                                <!-- product details -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Product Summary</h5>
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label class="form-label" for="product_name">Product Name</label>
                                                <input class="form-control" type="text" id="product_name" value="<?= $product['product_name'] ?>" readonly>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label" for="slug">Slug</label>
                                                <input class="form-control" type="text" id="slug" value="<?= $product['slug'] ?>" readonly>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label" for="remarks">Remarks</label>
                                                <textarea class="form-control" id="remarks1" data-info="remarks" readonly><?= $product['remarks'] ?></textarea>
                                            </div>
                                            <div class="col-4 mb-3">
                                                <button class="btn btn-info" type="button">Details</button>
                                            </div>
                                            <div class="col-8 mb-3">
                                                <a class="btn btn-dark" target="_blank" href="<?= systemVariable('SITE_HOME') ?>products/<?= $category['slug'] ?>/<?= $product['slug'] ?>">Client View</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- category details -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Category Summary</h5>
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label class="form-label" for="category_name">Category Name</label>
                                                <input class="form-control" type="text" id="category_name" value="<?= $category['category_name'] ?>" readonly>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label" for="slug">Slug</label>
                                                <input class="form-control" type="text" id="slug" value="<?= $category['slug'] ?>" readonly>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label" for="slug">Slug</label>
                                                <input class="form-control" type="text" id="slug" value="<?= $category['slug'] ?>" readonly>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label" for="remarks">Remarks</label>
                                                <textarea class="form-control" id="remarks2" data-info="remarks" readonly><?= $category['remarks'] ?></textarea>
                                            </div>
                                            <div class="col-4 mb-3">
                                                <button class="btn btn-info" type="button">Details</button>
                                            </div>
                                            <div class="col-8 mb-3">
                                                <a class="btn btn-dark" target="_blank" href="<?= systemVariable('SITE_HOME') ?>products/<?= $category['slug'] ?>/">Client View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">

                                <div class="card mb-4">
                                    <div class="card-body" id="add-stock-form">
                                        <?php
                                            include __DIR__ . '/stock-addition-form.php';
                                        ?>
                                    </div>
                                </div>

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