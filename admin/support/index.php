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

if (array_key_exists('new_ticket', $_GET)) {
    $new_ticket_create = true;
} else {
    $new_ticket_create = false;
}

if (array_key_exists('id', $_GET)) {
    $ticket_id_exists = true;
    $ticket_id = $_GET['id'];
    if ($ticket_id == '') {
        header('location: ' . systemVariable('SITE_DIR') . 'admin/support/');
    }
    $ticket = getSupportTicketById($ticket_id);
    if (mysqli_num_rows($ticket) == 0) {
        header('location: ' . systemVariable('SITE_DIR') . 'admin/support/');
    }
    $ticket = mysqli_fetch_assoc($ticket);
    if ($ticket['is_deleted'] == 1) {
        header('location: ' . systemVariable('SITE_DIR') . 'admin/support/');
    }
} else {
    $ticket_id_exists = false;
}

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="./" data-template="vertical-ticket-template-free">

<head>

    <?= loadAdminMetaData() ?>
    <?= loadAdminTitleAndFavicon() ?>
    <?= loadAdminStyleSheets() ?>
    <?php //loadCustomCss('assets/vendor/css/pages/app-chat.css') ?>
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
            <!-- ticket -->

            <?= loadAdminSidebar('Support') ?>
            <!-- / ticket -->

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
                        if ($ticket_id_exists) {
                            echo '<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="./">Support Tickets</a> /</span> <span id="ticket-edit-title">[#' . $ticket['ticketid'] . '] ' . $ticket['title'] . ' (' . $ticket['issue_type'] . ')' . '</span></h4>';
                        } else if ($new_ticket_create) {
                            echo '<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="./">Support Tickets</a> /</span> New ticket</h4>';
                        } else {
                            echo '<h4 class="fw-bold py-3 mb-4">Support Tickets</h4>';
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                if ($ticket_id_exists) {
                                    include_once('ticket-edit.php');
                                } else if ($new_ticket_create) {
                                    include_once('new-ticket.php');
                                } else {
                                    include_once('tickets-list.php');
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
            <!-- / Layout ticket -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-ticket-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <?= loadAdminFooterScripts() ?>

    <script src="<?= SITE_URL ?>assets/vendor/libs/tinymce/tinymce.min.js"></script>

    <script>
        // $('.tox-promotion').hide();
        tinymce.init({
            selector: 'textarea:not([data-info="remarks"])',
            height: 500,
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'consultationbreak',
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
            consultationbar: 'favs file edit view insert format tools table help',
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