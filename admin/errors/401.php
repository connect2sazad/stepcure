<?php

require_once __DIR__ . '/../admin.php';


?>
<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>

    <!-- Admin Meta Data -->
    <?= loadAdminMetaData() ?>

    <!-- Title & Favion -->
    <?= loadAdminTitleAndFavicon('Unauthorized Access') ?>

    <!-- Core CSS & Fonts -->
    <?= loadAdminStyleSheets() ?>

    <!-- page css -->
    <link rel="stylesheet" href="<?= systemVariable('SITE_DIR') ?>assets/vendor/css/pages/page-misc.css" />

    <!-- JS & JQuery -->
    <?= loadAdminScripts() ?>

    <?= getAjaxRequester() ?>

</head>

<body>
    <!-- Content -->

    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">401</h1>
            <h4 class="mb-2 mx-2">You are not authorized! 🔐</h4>
            <p class="mb-6 mx-2">You don't have permission to access this page. Go Home!</p>
            <button class="btn btn-primary" onclick="history.back()">Go Back</button>
            <div class="mt-6">
                <img src="<?= systemVariable('SITE_HOME') ?>assets/img/illustrations/girl-with-laptop-light.png" style="visibility: visible;">
            </div>
        </div>
    </div>

    <script>
        const seo_engine = {
            status: true,
            version: 1.2,
            code: '<?= base64_encode(base64_encode(systemVariable('meta_keywords_limit'))) ?>'
        };
    </script>

    <!-- Core JS -->
    <?= loadAdminFooterScripts() ?>

</body>

</html>