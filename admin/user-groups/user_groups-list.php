<?php

$user_groups = getUserGroups();

?>

<div class="row g-6" id="section-data">

    <p>User Groups help manage permissions more efficiently by assigning access rights to a group of users instead of configuring them individually. When a user is added to a group, they automatically inherit that group's permissions. This makes it easier to control access across teams or roles.</p>

    <div class="mb-4">
        <input type="search" id="userGroupSearch" class="form-control" placeholder="Search for a User Group..">
    </div>

    <?php
    if (mysqli_num_rows($user_groups) > 0) {
        while ($row = mysqli_fetch_assoc($user_groups)) {

            // remove if the group belongs to super user where permission is set to 'all'
            if ($row['is_super_admin'] == 1) continue;

            // get count of permissions
            $no_of_permissions = getUserGroupPermissions($row['id']);
            $no_of_permissions = mysqli_num_rows($no_of_permissions);

            // get all users in this user group
            $users_in_group = getUsersByUserGroupId($row['id']);
            $users_count = mysqli_num_rows($users_in_group);

    ?>
            <div class="col-xl-4 col-lg-6 col-md-6 mb-4" id="user_group-<?= $row['id'] ?>">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="fw-normal mb-0 text-body">Total <?= $users_count ?> user<?= $users_count > 1 ? 's' : '' ?> with <?= $no_of_permissions ?>
                                <!-- check if permission is more than 1, then add 's' to word 'permission' -->
                                permission<?= $no_of_permissions > 1 ? 's' : '' ?>
                            </h6>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <?php
                                if ($users_count > 0) {
                                    $max_display = 3;
                                    $counter = 0;

                                    while ($user = mysqli_fetch_assoc($users_in_group)) {
                                        if ($counter < $max_display) {
                                            $current_user = $user['userid'] == $_SESSION[USER_AUTH];
                                ?>
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="<?= $user['first_name'] ?> <?= $user['last_name'] ?> <?= $current_user ? '(You)' : '' ?>" data-bs-original-title="<?= $user['first_name'] ?> <?= $user['last_name'] ?> <?= $current_user ? '(You)' : '' ?>">
                                                <a href="<?= SITE_HOME ?>admin/profile/?userid=<?= $user['userid'] ?>">
                                                    <?php echo getDP([
                                                        'full_name' => $user['first_name'] . ' ' . $user['last_name'],
                                                        'file_name' => $user['profile_image'],
                                                        'id'        => 'nav-bar-admin-pic-1',
                                                        'class'     => 'rounded-circle',
                                                        'alt'       => $user['first_name'] . ' ' . $user['last_name']
                                                    ]); ?>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        $counter++;
                                    }

                                    if ($users_count > $max_display) {
                                        $remaining = $users_count - $max_display;
                                        ?>
                                        <li class="avatar">
                                            <span class="avatar-initial rounded-circle pull-up" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="<?= $remaining ?> more">+<?= $remaining ?></span>
                                        </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h5 class="mb-1" id="user_group-<?= $row['id'] ?>_name"><?= $row['group_name'] ?></h5>
                                <?php
                                if (checkPermissions('view', $user_permissions, $user_group_permissions)) {
                                ?>
                                    <a href="./?id=<?= urlencode($row['id']) ?>&view" class="role-edit-modal"><span>View </span></a> |
                                <?php
                                }
                                if (checkPermissions('update', $user_permissions, $user_group_permissions)) {
                                ?>
                                    <a href="./?id=<?= urlencode($row['id']) ?>" class="role-edit-modal"><span>Edit </span></a>
                                <?php
                                }
                                ?>
                            </div>

                            <?php
                            if (checkPermissions('delete', $user_permissions, $user_group_permissions)) {
                                if ($row['is_active']) {

                                    echo '
                                        <!--a data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Users" data-bs-original-title="Users" href="javascript:void(0);" onclick="window.location.href=./?id=.$row[id]."><i class="icon-base fas fa-user-tie icon-md text-warning"></i></a-->
                                        <a data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Trash" data-bs-original-title="Trash" href="javascript:void(0);" onclick="send_to_trash(' . htmlspecialchars($row['id']) . ')"><i class="icon-base fas fa-minus-circle icon-md text-secondary"></i></a>
                                    ';
                                } else {
                                    echo '
                                        <a data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Restore" data-bs-original-title="Restore" href="javascript:void(0);" onclick="restore_from_trash(' . htmlspecialchars($row['id']) . ')"><i class="icon-base fas fa-plus-circle icon-md text-primary"></i></a>
                                        <a data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Permanently Delete" data-bs-original-title="Permanently Delete" href="javascript:void(0);" onclick="delete_user_group(' . htmlspecialchars($row['id']) . ')"><i class="icon-base fas fa-trash-alt icon-md text-danger"></i></a>
                                    ';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>

    <?php

    if (checkPermissions('create', $user_permissions, $user_group_permissions)) {
    ?>

        <div class="col-xl-4 col-lg-6 col-md-6 mb-4" id="new_user_group">
            <div class="card h-100">
                <div class="row h-100">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-4 ps-6">
                            <img src="<?= SITE_URL ?>assets/img/illustrations/lady-with-laptop-light.png" class="img-fluid" alt="Image" width="120" data-app-light-img="illustrations/lady-with-laptop-light.png" data-app-dark-img="illustrations/lady-with-laptop-dark.png" style="visibility: visible;">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <a href="./?new_user_group" class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">Add New User Group</a>
                            <p class="mb-0">
                                Add new user group, <br>
                                if it doesn't exist.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

</div>

<script>
    $('#userGroupSearch').on('keyup', function() {
        var searchValue = $(this).val().toLowerCase();

        // Loop through all user group cards and toggle visibility based on search
        $('#section-data .card').each(function() {
            var groupName = $(this).find('h5').text().toLowerCase();

            if (groupName.includes(searchValue)) {
                $(this).closest('.col-xl-4, .col-lg-6, .col-md-6').show();
            } else {
                $(this).closest('.col-xl-4, .col-lg-6, .col-md-6').hide();
            }
        });
    });


    async function send_to_trash(user_group_id) {

        var user_group_name = $('#user_group-' + user_group_id + '_name').text();

        var delete_confirmation = await ConfirmDialogBox("Are you sure you want to trash/deactivate the User Group '" + user_group_name + "'?", "Trash/Deactivate User Group", "Please note: This will remove all permissions of the users that belong to the User Group '" + user_group_name + "'. However, any individual (overriding) user permissions will remain unaffected.'");

        if (!delete_confirmation) {
            return;
        }

        var form_data = "request_type=send_user_group_to_trash&id=" + user_group_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

        ajax_request(form_data, false).done(function(response) {
            // console.log(response);
            // response = JSON.parse(response);
            response = JSON.parse(response);

            if (response.status == 'success') {
                Toastify({
                    text: response.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
                $('#section-data').load(location.href + ' #section-data > *');
            } else {
                Toastify({
                    text: 'failed',
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "red",
                }).showToast();
            }
        });
    }

    async function restore_from_trash(user_group_id) {

        var user_group_name = $('#user_group-' + user_group_id + '_name').text();

        var delete_confirmation = await ConfirmDialogBox("Are you sure you want to restore User Group'" + user_group_name + "'?", "Restore User Group", "Please note: This will restore all permissions of the users that belong to the User Group '" + user_group_name + "'. However, any individual (overriding) user permissions will remain unaffected.'");

        if (!delete_confirmation) {
            return;
        }

        var form_data = "request_type=restore_user_group_from_trash&id=" + user_group_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

        ajax_request(form_data, false).done(function(response) {
            response = JSON.parse(response);
            // response = JSON.parse(response);
            if (response.status == 'success') {
                Toastify({
                    text: response.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
                $('#section-data').load(location.href + ' #section-data > *');
            } else {
                Toastify({
                    text: 'failed',
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "red",
                }).showToast();
            }
        });
    }

    async function delete_user_group(user_group_id) {
        var user_group_name = $('#user_group-' + user_group_id + '_name').text();

        var delete_confirmation = await ConfirmDialogBox("Are you sure you want to permanently delete User Group '" + user_group_name + "'?", "Permanently Delete User Group", "Please note: This will permanently delete all permissions of the users that belong to the User Group '" + user_group_name + "'. However, any individual (overriding) user permissions will remain unaffected.'");

        if (!delete_confirmation) {
            return;
        }

        var form_data = "request_type=delete_user_group&id=" + user_group_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

        ajax_request(form_data, false).done(function(response) {
            response = JSON.parse(response);
            // response = JSON.parse(response);
            if (response.status == 'success') {
                Toastify({
                    text: response.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
                $('#section-data').load(location.href + ' #section-data > *');
            } else {
                Toastify({
                    text: 'failed',
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "red",
                }).showToast();
            }
        });
    }
</script>