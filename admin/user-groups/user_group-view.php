<?php

$users_options = getUsersOptionsForUserGroupEdit($_SESSION[USER_AUTH]);

$current_users_in_user_group = getCurrentUsersInUserGroup($user_group['id']);

$exclude_user_options = [];

?>
<div class="card">
    <div class="card-body">

        <?php
        if (!$user_group['is_active']) {

        ?>
            <p class="text-danger"><strong>* Please note: This user group is inactive. Any changes to permissions or the User List will not take effect until the group is activated.</strong></p>
        <?php
        }
        ?>

        <div class="row">

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="group_name">Group Name</label>
                <input type="text" class="form-control" id="group_name" placeholder="<?= $user_group['group_name'] ?>" value="<?= $user_group['group_name'] ?>" name="group_name" disabled>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="color_code">Group Color</label>
                <input type="color" class="form-control" id="color_code" value="<?= $user_group['color_code'] ?>" name="color_code" title="Choose User Group color" disabled>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label" for="remarks">Remarks</label>
                <textarea class="form-control" id="remarks" placeholder="<?= $user_group['remarks'] ?>" name="remarks" data-info="remarks" disabled><?= $user_group['remarks'] ?></textarea>
            </div>

            <div class="col-12 mb-3">

                <div class="table-responsive text-nowrap">
                    <div class="form-check">
                        <input class="form-check-input" id="select-all-permissions" type="checkbox" disabled>
                        <label class="form-check-label" for="select-all-permissions"> Select / Deselect All Permissions </label>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Permission Name</th>
                                <th class="text-center" data-orderable="false">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input select-column" data-column="view" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom"
                                            data-bs-placement="top"
                                            aria-label="This permission allows this user group to view everything."
                                            data-bs-original-title="This permission allows this user group to view everything."
                                            id="view-all" disabled>
                                        <label for="view-all" class="form-check-label">View</label>
                                    </div>
                                </th>
                                <th class="text-center" data-orderable="false">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input select-column" data-column="create" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom"
                                            data-bs-placement="top"
                                            aria-label="This permission allows this user group to create everything."
                                            data-bs-original-title="This permission allows this user group to create everything."
                                            id="create-all" disabled>
                                        <label for="create-all" class="form-check-label">Create</label>
                                    </div>
                                </th>
                                <th class="text-center" data-orderable="false">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input select-column" data-column="update" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom"
                                            data-bs-placement="top"
                                            aria-label="This permission allows this user group to update everything."
                                            data-bs-original-title="This permission allows this user group to update everything."
                                            id="update-all" disabled>
                                        <label for="update-all" class="form-check-label">Update</label>
                                    </div>
                                </th>
                                <th class="text-center" data-orderable="false">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input select-column" data-column="delete" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom"
                                            data-bs-placement="top"
                                            aria-label="This permission allows this user group to delete everything."
                                            data-bs-original-title="This permission allows this user group to delete everything."
                                            id="delete-all" disabled>
                                        <label for="delete-all" class="form-check-label">Delete</label>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $permissions = getPermissionsListWithGroup($user_group['id']);
                            $SL = 1;
                            foreach ($permissions as $row):
                            ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" id="permission-<?= $SL ?>" class="form-check-input select-row" title="<?= htmlspecialchars($row['name']) ?>" disabled>
                                            <label for="permission-<?= $SL ?>" class="form-check-label"><?= htmlspecialchars($row['name']) ?></label>
                                        </div>
                                    </td>
                                    <?php foreach (['view', 'create', 'update', 'delete'] as $perm): ?>
                                        <td class="text-center">
                                            <?php if ($row[$perm . '_id']): ?>
                                                <input type="checkbox"
                                                    name="permissions[<?= $row['name'] ?>][]"
                                                    value="<?= $row[$perm . '_id'] ?>"
                                                    data-column="<?= $perm ?>"
                                                    class="form-check-input"
                                                    <?= $row['has_' . $perm] ? 'checked' : '' ?>
                                                    data-bs-toggle="tooltip"
                                                    data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    aria-label="<?= htmlspecialchars($row[$perm . '_desc']) ?>"
                                                    data-bs-original-title="<?= htmlspecialchars($row[$perm . '_desc']) ?>" disabled>
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php
                                $SL += 1;
                            endforeach; ?>
                        </tbody>

                        <tfoot class="table-border-bottom-0">
                            <tr>
                                <th>Permission Name</th>
                                <th class="text-center" data-orderable="false">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input select-column" data-column="view" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom"
                                            data-bs-placement="top"
                                            aria-label="This permission allows this user group to view everything."
                                            data-bs-original-title="This permission allows this user group to view everything."
                                            id="view-all2" disabled>
                                        <label for="view-all2" class="form-check-label">View</label>
                                    </div>
                                </th>
                                <th class="text-center" data-orderable="false">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input select-column" data-column="create" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom"
                                            data-bs-placement="top"
                                            aria-label="This permission allows this user group to create everything."
                                            data-bs-original-title="This permission allows this user group to create everything."
                                            id="create-all2" disabled>
                                        <label for="create-all2" class="form-check-label">Create</label>
                                    </div>
                                </th>
                                <th class="text-center" data-orderable="false">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input select-column" data-column="update" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom"
                                            data-bs-placement="top"
                                            aria-label="This permission allows this user group to update everything."
                                            data-bs-original-title="This permission allows this user group to update everything."
                                            id="update-all2" disabled>
                                        <label for="update-all2" class="form-check-label">Update</label>
                                    </div>
                                </th>
                                <th class="text-center" data-orderable="false">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input select-column" data-column="delete" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom"
                                            data-bs-placement="top"
                                            aria-label="This permission allows this user group to delete everything."
                                            data-bs-original-title="This permission allows this user group to delete everything."
                                            id="delete-all2" disabled>
                                        <label for="delete-all2" class="form-check-label">Delete</label>
                                    </div>
                                </th>
                            </tr>
                        </tfoot>
                    </table>


                    <div class="form-check">
                        <input class="form-check-input" id="select-all-permissions2" type="checkbox" disabled>
                        <label class="form-check-label" for="select-all-permissions2"> Select / Deselect All Permissions </label>
                    </div>
                </div>

            </div>

            <hr>
            <div class="col-12 mb-3">
                <h3>Users</h3>
                <div class="users-in-user-group-wrapper">
                    <ul class="list-unstyled d-flex align-items-center mb-0 users-container" id="">
                        <?php
                        $user_id_in_user_group = '';
                        if (mysqli_num_rows($current_users_in_user_group) > 0) {
                            while ($row = mysqli_fetch_assoc($current_users_in_user_group)) {

                                // this is to get users already in the user group for hidden input
                                $user_id_in_user_group .= $row['id'] . ',';

                                // this is added to do not show people in options if they are already in this user group
                                array_push($exclude_user_options, $row['id']);

                                // this is to check if user is loggedin
                                $current_user = $row['userid'] == $_SESSION[USER_AUTH];
                        ?>
                                <li data-user-id="<?= $row['id'] ?>" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar user-group-users-avatar pull-up" aria-label="<?= $row['first_name'] ?> <?= $row['last_name'] ?> <?= $current_user ? '(You)' : '' ?>" data-bs-original-title="<?= $row['first_name'] ?> <?= $row['last_name'] ?> <?= $current_user ? '(You)' : '' ?>">
                                    <?php echo getDP([
                                        'full_name' => $row['first_name'] . ' ' . $row['last_name'],
                                        'file_name' => $row['profile_image'],
                                        'class'     => 'rounded-circle',
                                        'alt'       => $row['first_name'] . ' ' . $row['last_name']
                                    ]); ?>
                                </li>
                        <?php
                            }
                        }
                        // remove comma if it is in end
                        $user_id_in_user_group = rtrim($user_id_in_user_group, ',');
                        ?>
                    </ul>
                </div>
            </div>
            <?php

            if (checkPermissions('update', $user_permissions, $user_group_permissions)) {
            ?>
                <div class="mt-2 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='./?id=<?= $user_group_id ?>'">Edit</button>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
</div>