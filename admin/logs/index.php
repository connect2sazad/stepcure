<?php

require_once __DIR__ . '/../admin.php';

// Define current module
define('PERMISSION_NAME', 'logs');

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

$admin_logs = getAdminLogs();

?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-site-fixed" dir="ltr" data-theme="theme-default" data-assets-path="./" data-template="vertical-site-template-free">

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

    <div class="row m-0 my-4 align-items-center">
        <div class="col-6 p-0">
            <span style="font-weight:700;font-size:20px;color:inherit">connect2sazad</span>
        </div>
        <div class="col-5 text-end">
            <h2 class="px-4">Admin Logs</h2>
        </div>
        <div class="col-1 text-end">
            <a class="btn btn-warning" href="<?= systemVariable('SITE_HOME')?>admin/logout">Logout</a>
        </div>
    </div>

    <div class="container-fluid">
        <?php if ($admin_logs && $admin_logs->num_rows > 0): ?>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="text-white">SL</th>
                        <th class="text-white">Action By</th>
                        <th class="text-white">Update</th>
                        <th class="text-white">Action Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $SL = 1;
                    while ($row = mysqli_fetch_object($admin_logs)) {

                        if (is_numeric($row->updated_by)) {
                            $updated_by = getUseridById($row->updated_by);
                        } else {
                            $updated_by = $row->updated_by;
                        }

                        echo '
                            <tr>
                                <td>' . $SL . '</td>
                                <td>' . $updated_by . '</td>
                                <td>' . $row->update_text . '</td>
                                <td>' . formatDateTime($row->updated_at) . '</td>
                            </tr>
                        ';
                        $SL += 1;
                    }
                    ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">No logs found.</div>
        <?php endif; ?>
    </div>

    <?= loadAdminFooter() ?>
    <?= loadAdminFooterScripts() ?>

</body>

</html>