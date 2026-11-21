<?php
require_once __DIR__ . '/../admin.php';

$current_admin = $_SESSION[USER_AUTH];

$new_menu_create = isset($_GET['new_menu']);
$menu_id_exists  = isset($_GET['menu_id']) && $_GET['menu_id'] !== '';

$view_mode = isset($_GET['view']); // ✅ Detect "view" param in URL

if ($menu_id_exists) {
    $menu_id = $_GET['menu_id'];
    $menu = getMenuById($menu_id);

    if (!$menu || mysqli_num_rows($menu) == 0) {
        header('location: ' . SITE_URL . 'menus/');
        exit;
    }

    $menu = mysqli_fetch_assoc($menu);

    if ($menu['is_deleted'] == 1) {
        header('location: ' . SITE_URL . 'menus/');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="./" data-template="vertical-menu-template-free">

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
            <!-- Menu -->

            <?= loadAdminSidebar('Menus') ?>
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
                        if ($menu_id_exists) {
                            echo '<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="./">Menus</a> /</span> <span id="menu-edit-title">' . $menu['menu_name'] . '</span></h4>';
                        } else if ($new_menu_create) {
                            echo '<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="./">Menus</a> /</span> New Menu</h4>';
                        } else {
                            echo '<h4 class="fw-bold py-3 mb-4">Menus List</h4>';
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <?php
                                    if ($menu_id_exists) {
                                        if ($view_mode) {
                                            include_once('menu-view.php'); // ✅ If URL has &view
                                        } else {
                                            include_once('menu-edit.php'); // ✅ Otherwise edit mode
                                        }
                                    } elseif ($new_menu_create) {
                                        include_once('new-menu.php');
                                    } else {
                                        include_once('menus-list.php');
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
            <!-- / Layout menu -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <?= loadAdminFooterScripts() ?>

    <script src="<?= SITE_URL ?>assets/vendor/libs/tinymce/tinymce.min.js"></script>

    <script>
        // $('#tox-statusbar__branding').hide();
        $('.tox-promotion').hide();
        tinymce.init({
            selector: 'textarea',
            height: 500,
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'menubreak',
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
            menubar: 'favs file edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
            statusbar: false,
            fontsize_formats: '6pt 8pt 10pt 12pt 14pt 18pt 24pt 36pt 72pt',
            // skin: skin,
            // content_css: content_css,
        });
    </script>

</body>

</html>