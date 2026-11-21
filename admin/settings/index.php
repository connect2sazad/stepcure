<?php

require_once __DIR__ . '/../admin.php';

// Define current module
define('PERMISSION_NAME', 'app_settings');

define('ALL_PERMISSIONS', getAllPermissionsByPERMISSION_NAME());
define('USER_ALLOWED_PERMISSIONS', getUserPermissionsByPERMISSION_NAME());
define('USER_GROUP_ALLOWED_PERMISSIONS', getUserGroupPermissionsByPERMISSION_NAME());

// Fetch all permissions for current user
$user_permissions        = USER_ALLOWED_PERMISSIONS;
$user_group_permissions  = USER_GROUP_ALLOWED_PERMISSIONS;

$current_admin = $_SESSION[USER_AUTH];

if (!checkPermissions('update', $user_permissions, $user_group_permissions)) {
    include_once __DIR__ . "/../errors/401.php";
    exit;
}

$site_icon = systemVariable('SITE_HOME') . 'uploads/' . systemVariable('SITE_ICON');
$site_logo = systemVariable('SITE_HOME') . 'uploads/' . systemVariable('SITE_LOGO');


$user_group_options = getUserGroupOptions();
$treatment_site_options = getSitesList();

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="./" data-template="vertical-menu-template-free">

<head>

    <?= loadAdminMetaData() ?>
    <?= loadAdminTitleAndFavicon() ?>
    <?= loadAdminStyleSheets() ?>
    <?= loadAdminScripts() ?>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?= loadAdminSidebar('Settings') ?>
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

                        <!-- Heading -->
                        <h4 class="fw-bold py-3 mb-4">General Site Settings</h4><p><a class="btn btn-outline-primary" href="../festivals/">Manage festive season animations</a></p>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-body" id="section-data">

                                        <form id="general-site-settings" action="save-settings.php" method="post" enctype="multipart/form-data"><?= sc_token() ?><section class="mb-4"><h5>Website contact information</h5><p>Displayed on the public contact page and footer.</p><?php foreach(sc_site_fields() as $publicKey=>$field):if(!str_starts_with($publicKey,'website_'))continue; ?><label class="d-block mb-3"><?= sc_e($field[0]) ?><input class="form-control" name="<?= $publicKey ?>" maxlength="<?= $field[2] ?>" value="<?= sc_e(sc_public_setting($publicKey,$field[1])) ?>"></label><?php endforeach; ?><a href="../footer/">Customize website footer</a></section>

                                            <div class="row">

                                                <div class="mb-3">
                                                    <label class="form-label" for="SITE_HOME">Site Home</label>
                                                    <input type="text" class="form-control" id="SITE_HOME" placeholder="Site Home" value="<?= systemVariable('SITE_HOME') ?>" readonly>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="SITE_NAME">Site Name</label>
                                                    <input type="text" class="form-control" id="SITE_NAME" placeholder="Site Name" value="<?= systemVariable('SITE_NAME') ?>" name="SITE_NAME" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="site_icon">Site Icon</label><br>
                                                    <img id="site_icon_display" src="<?= $site_icon ?>" alt="Site Logo" class="mb-3" style="height: 100px; width: auto; object-fit: cover; cursor: pointer;">
                                                    <input type="file" class="form-control" id="site_icon" placeholder="Site Logo" value="<?= $site_icon ?>" name="site_icon">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="site_logo">Site Logo</label><br>
                                                    <img id="site_logo_display" src="<?= $site_logo ?>" alt="Site Logo" class="mb-3" style="height: 100px; width: auto; object-fit: cover; cursor: pointer;">
                                                    <input type="file" class="form-control" id="site_logo" placeholder="Site Logo" value="<?= $site_logo ?>" name="site_logo">
                                                </div>

                                                <div class="col-12 col-md-4 mb-3">
                                                    <label class="form-label" for="default_site_color">Default Treatment Site Color</label>
                                                    <input type="color" class="form-control" id="default_site_color" value="<?= systemVariable('default_site_color') ?>" name="default_site_color" title="Choose Default Site color">
                                                </div>

                                                <div class="col-12 col-md-4 mb-3">
                                                    <label class="form-label" for="default_user_group_color">Default User Group Color</label>
                                                    <input type="color" class="form-control" id="default_user_group_color" value="<?= systemVariable('default_user_group_color') ?>" name="default_user_group_color" title="Choose Default User Group color">
                                                </div>

                                                <div class="col-12 col-md-4 mb-3">
                                                    <label class="form-label" for="default_user_designation_color">Default User Designation Color</label>
                                                    <input type="color" class="form-control" id="default_user_designation_color" value="<?= systemVariable('default_user_designation_color') ?>" name="default_user_designation_color" title="Choose Default User Designation color">
                                                </div>

                                                <div class="col-12 col-md-6 mb-3">
                                                    <label class="form-label" for="default_site_id">Default Site</label>
                                                    <select name="default_site_id" id="default_site_id" class="form-control" required>
                                                        <?php
                                                        if (mysqli_num_rows($treatment_site_options) > 0) {
                                                            echo '<option selected disabled>Select Default Site</option>';
                                                            while ($row = mysqli_fetch_assoc($treatment_site_options)) {
                                                                // ignore if super user group
                                                                if (($row['is_super_admin'] ?? 0) == 1) continue;

                                                                $selected = systemVariable('default_site_id') == $row['id'] ? 'selected' : '';
                                                                $state_name = getAddressStateById($row['address_state']);
                                                                $state_name = $state_name['state_name'];

                                                                echo '<option value="' . $row['id'] . '" '.$selected.'>' . $row['site_name'] . ' ( ' . $row['site_id'] . ') - ' . $state_name . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option disabled>No Sites Available</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-md-6 mb-3">
                                                    <label class="form-label" for="default_user_group">Default User Group</label>
                                                    <select name="default_user_group" id="default_user_group" class="form-control" required>
                                                        <?php
                                                        if (mysqli_num_rows($user_group_options) > 0) {
                                                            echo '<option selected disabled>Select Default User Group</option>';
                                                            while ($row = mysqli_fetch_assoc($user_group_options)) {
                                                                // ignore if super user group
                                                                if (($row['is_super_admin'] ?? 0) == 1) continue;

                                                                $selected = systemVariable('default_user_group') == $row['id'] ? 'selected' : '';

                                                                echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['group_name'] . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option disabled>No User Groups Available</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="consent_form_text">Consent Form Content</label>
                                                    <textarea id="consent_form_text" placeholder="Consent Form Content" name="consent_form_text"><?= systemVariable('consent_form_text') ?></textarea>
                                                </div>




                                                <?php

                                                if (userVariable('user_group') == 1) {
                                                    echo '
                                                    <div class="mb-3">
                                                        <label class="form-label" for="meta_keywords_limit">Meta Keywords Limit</label>
                                                        <input type="number" class="form-control" id="meta_keywords_limit" placeholder="Meta Keywords Limit" value="' . systemVariable('meta_keywords_limit') . '" name="meta_keywords_limit" required>
                                                    </div>

                                                    ';
                                                }

                                                ?>

                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary me-2">Save</button>
                                                    <button type="reset" class="btn btn-dark me-2" onclick="fix_values()">Reset</button>
                                                    <button type="button" class="btn btn-outline-secondary me-2" onclick="window.location.href='../'">Go Back</button>
                                                </div>

                                            </div>

                                        </form>

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
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
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

    <script>
        // site icon
        $('#site_icon_display').on('click', function() {
            $('#site_icon').click();
        });
        $('#site_icon').on('change', function() {
            var the_file = document.querySelector('#site_icon');
            $('#site_icon_display').attr('src', URL.createObjectURL(the_file.files[0]))

        });

        // site logo
        $('#site_logo_display').on('click', function() {
            $('#site_logo').click();
        });
        $('#site_logo').on('change', function() {
            var the_file = document.querySelector('#site_logo');
            $('#site_logo_display').attr('src', URL.createObjectURL(the_file.files[0]))

        });

        // default_featured_image
        $('#default_featured_image_display').on('click', function() {
            $('#default_featured_image').click();
        });
        $('#default_featured_image').on('change', function() {
            var the_file = document.querySelector('#default_featured_image');
            $('#default_featured_image_display').attr('src', URL.createObjectURL(the_file.files[0]))

        });

        // car_default_image
        $('#car_default_image_display').on('click', function() {
            $('#car_default_image').click();
        });
        $('#car_default_image').on('change', function() {
            var the_file = document.querySelector('#car_default_image');
            $('#car_default_image_display').attr('src', URL.createObjectURL(the_file.files[0]))

        });
    </script>

</body>

</html>