<?php

require_once __DIR__ . '/../admin.php';

$current_admin = $_SESSION[USER_AUTH];

if (array_key_exists('new_page', $_GET)) {
    $new_page_create = true;
} else {
    $new_page_create = false;
}

if (array_key_exists('front_page', $_GET)) {
    $front_page = true;
} else {
    $front_page = false;
}

if (array_key_exists('page_id', $_GET)) {
    $page_id_exists = true;
    $page_id = $_GET['page_id'];
    if($page_id == ''){
        header('location: '.SITE_URL .'admin/pages/');
    }
    $page = getPageById($page_id);
    if(mysqli_num_rows($page) == 0){
        header('location: '.SITE_URL .'admin/pages/');
    }
    $page = mysqli_fetch_assoc($page);
    if($page['is_deleted'] == 1){
       header('location: '.SITE_URL .'admin/pages/');
    }
    if ($page['slug'] == 'front_page') {
        header('location: '.SITE_URL .'admin/pages/?front_page');
    }
} else {
    $page_id_exists = false;
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

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?= loadAdminSidebar('Pages') ?>
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
                        if ($page_id_exists) {
                            echo '<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="./">Pages</a> /</span> <strong style="text-transform: capitalize;" id="page-edit-title">' . $page['page_title'] . '</strong> <a href="' . SITE_URL . $page['page_unique_name'] . '" target="_blank"><i class="fa fa-eye"></i></a></h4>';
                        } else if ($new_page_create) {
                            echo '<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="./">Pages</a> /</span> New Page</h4>';
                        } else if ($front_page) {
                            echo '<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="./">Pages</a> /</span> Front Page</h4>';
                        } else {
                            echo '<h4 class="fw-bold py-3 mb-4">Pages</h4>';
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <?php
                                    if ($page_id_exists) {
                                        include_once('page-edit.php');
                                    } else if ($new_page_create) {
                                        include_once('new-page.php');
                                    } else if ($front_page) {
                                        include_once('front-page.php');
                                    } else {
                                        include_once('pages-list.php');
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
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <?= loadAdminFooterScripts() ?>

    <script src="<?= SITE_URL ?>assets/vendor/libs/tinymce/tinymce.min.js"></script>

    <script>
        $('#tox-statusbar__branding').hide();
        tinymce.init({
            selector: 'textarea',
            height: 500,
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
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