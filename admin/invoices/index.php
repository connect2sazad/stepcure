<?php

require_once __DIR__ . '/../admin.php';

// Define current module
define('PERMISSION_NAME', 'invoice');

define('ALL_PERMISSIONS', getAllPermissionsByPERMISSION_NAME());
define('USER_ALLOWED_PERMISSIONS', getUserPermissionsByPERMISSION_NAME());
define('USER_GROUP_ALLOWED_PERMISSIONS', getUserGroupPermissionsByPERMISSION_NAME());

// Fetch all permissions for current invoice
$user_permissions        = USER_ALLOWED_PERMISSIONS;
$user_group_permissions  = USER_GROUP_ALLOWED_PERMISSIONS;

// get current logged in invoice
$current_admin = $_SESSION[USER_AUTH];

$new_invoice_create = isset($_GET['new_invoice']);
$invoice_id_exists  = isset($_GET['id']) && $_GET['id'] !== '';

$view_mode = isset($_GET['view']); // ✅ Detect "view" param in URL

if ($invoice_id_exists) {
    $invoice_id = $_GET['id'];
    $invoice = getInvoiceById($invoice_id);

    // if invoice is not found
    if (!$invoice || mysqli_num_rows($invoice) == 0) {
        // header('location: ' . SITE_URL . 'invoices/');
        include_once __DIR__ . "/../errors/404.php";
        exit;
    }

    $invoice = mysqli_fetch_assoc($invoice);

    // if report/invoice is already finalized, show unauthorized access
    // if ($invoice['is_report_finalized'] == 1 && !$view_mode) {
    //     include_once __DIR__ . "/../errors/401.php";
    //     exit;
    // }

    // if consulting dr/user is not same as loggedin user and it is in edit mode and the loggedin user is not admin or superadmin then show unauthorized access
    if ($invoice['created_by'] != userVariable('id') && !$view_mode && userVariable('user_group') != 1 && userVariable('user_group') != 2) {
        include_once __DIR__ . "/../errors/401.php";
        exit;
    }

    //  if invoice is deleted
    if ($invoice['is_deleted'] == 1) {
        // header('location: ' . SITE_URL . 'invoices/'); // replace this with 404 error page
        include_once __DIR__ . "/../errors/404.php";
        exit;
    }

    // ✅ Permission check for view/edit
    if ($view_mode) {
        // View mode requires 'view'
        if (!checkPermissions('view', $user_permissions, $user_group_permissions)) {
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

// If creating a new site
if ($new_invoice_create) {
    // Create mode requires 'create'
    if (!checkPermissions('create', $user_permissions, $user_group_permissions)) {
        include_once __DIR__ . "/../errors/401.php";
        exit;
    }
}

// If just listing sites (default view)
if (!$invoice_id_exists && !$new_invoice_create) {
    // Listing requires at least 'view'
    if (!checkPermissions('view', $user_permissions, $user_group_permissions)) {
        include_once __DIR__ . "/../errors/401.php";
        exit;
    }
}


// ✅ If we reach here → invoice is authorized for this page mode
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="./" data-template="vertical-invoice-template-free">

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
            <!-- Invoice -->

            <?= loadAdminSidebar('Invoices') ?>
            <!-- / Invoice -->

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
                        if ($invoice_id_exists) {
                            echo '<h4 class="fw-bold py-3 mb-4"><i class="fas fa-user-injured"></i> <span class="text-muted fw-light"><a href="./">Invoices</a> /</span> <span id="invoice-edit-title">' . "CSI-" . prefix_00($invoice['customerinvoiceuid']) . '</span></h4>';
                        } else if ($new_invoice_create) {
                            echo '<h4 class="fw-bold py-3 mb-4"><i class="fas fa-user-injured"></i> <span class="text-muted fw-light"><a href="./">Invoices</a> /</span> New Invoice</h4>';
                        } else {
                            echo '<h4 class="fw-bold py-3 mb-4"><i class="fas fa-user-injured"></i> Invoices List</h4>';
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <?php
                                    if ($invoice_id_exists) {
                                        if ($view_mode) {
                                            include_once('invoice-view.php'); // ✅ If URL has &view
                                        } else {
                                            include_once('invoice-edit.php'); // ✅ Otherwise edit mode
                                        }
                                    } elseif ($new_invoice_create) {
                                        include_once('new-invoice.php');
                                    } else {
                                        include_once('invoices-list.php');
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
            <!-- / Layout invoice -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-invoice-toggle"></div>
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
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'invoicebreak',
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
            invoicebar: 'favs file edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
            statusbar: false,
            fontsize_formats: '6pt 8pt 10pt 12pt 14pt 18pt 24pt 36pt 72pt',
            // skin: skin,
            // content_css: content_css,
            setup: function(editor) {
                editor.on('keydown', function(e) {
                    if (e.key === 'Escape') {
                        if (editor.plugins.fullscreen?.isFullscreen()) {
                            editor.execCommand('mceFullScreen');
                            e.preventDefault();
                        }
                    }
                });
            }
        });
    </script>

</body>

</html>