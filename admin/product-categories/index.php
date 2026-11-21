<?php

require_once __DIR__ . '/../admin.php';

// Define current module
define('PERMISSION_NAME', 'product_category');

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

// get url details
$new_product_category_create = isset($_GET['new_product_category']);
$product_category_id_exists  = isset($_GET['id']) && $_GET['id'] !== '';

$view_mode = isset($_GET['view']); // ✅ Detect "view" param in URL

// If editing or viewing a specific product_category
if ($product_category_id_exists) {
    $product_category_id = $_GET['id'];
    $product_category = getProductCategoryById($product_category_id);

    // if product_category is not found
    if (!$product_category || mysqli_num_rows($product_category) == 0) {
        include_once __DIR__."/../errors/404.php";
        exit;
    }
    
    $product_category = mysqli_fetch_assoc($product_category);
    
    //  if product_category is deleted
    if ($product_category['is_deleted'] == 1) {
        include_once __DIR__."/../errors/404.php";
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

// If creating a new product_category
if ($new_product_category_create) {
    // Create mode requires 'create'
    if (!checkPermissions('create', $user_permissions, $user_group_permissions)) {
        include_once __DIR__."/../errors/401.php";
        exit;
    }
}

// If just listing product_categories (default view)
if (!$product_category_id_exists && !$new_product_category_create) {
    // Listing requires at least 'view'
    if (!checkPermissions('view', $user_permissions, $user_group_permissions)) {
        include_once __DIR__."/../errors/401.php";
        exit;
    }
}

// ✅ If we reach here → user is authorized for this page mode
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="./" data-template="vertical-product_category-template-free">

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
            <!-- Site -->

            <?= loadAdminSidebar('Product Categories') ?>
            <!-- / Site -->

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
                        if ($product_category_id_exists) {
                            echo '<h4 class="fw-bold py-3 mb-4"><i class="fas fa-boxes"></i> <span class="text-muted fw-light"><a href="./">Product Categories</a> /</span> <span id="product_category-edit-name">' . $product_category['category_name'] . '</span></h4>';
                        } else if ($new_product_category_create) {
                            echo '<h4 class="fw-bold py-3 mb-4"><i class="fas fa-boxes"></i> <span class="text-muted fw-light"><a href="./">Product Categories</a> /</span> New Category</h4>';
                        } else {
                            echo '<h4 class="fw-bold py-3 mb-4"><i class="fas fa-boxes"></i> Product Categories List</h4>';
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <?php
                                    if ($product_category_id_exists) {
                                        if ($view_mode) {
                                            include_once('product_category-view.php'); // ✅ If URL has &view
                                        } else {
                                            include_once('product_category-edit.php'); // ✅ Otherwise edit mode
                                        }
                                    } elseif ($new_product_category_create) {
                                        include_once('new-product_category.php');
                                    } else {
                                        include_once('product_categories-list.php');
                                    }
                                    ?>
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
            <!-- / Layout product_category -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-product_category-toggle"></div>
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
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'product_categorybreak',
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
            product_categorybar: 'favs file edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
            statusbar: false,
            fontsize_formats: '6pt 8pt 10pt 12pt 14pt 18pt 24pt 36pt 72pt',
            // skin: skin,
            // content_css: content_css,
        });
    </script>

</body>

</html>