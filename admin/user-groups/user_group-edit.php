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

        <form id="update_user_group" method="POST" onsubmit="return false">

            <div class="row">

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="group_name">Group Name</label>
                    <input type="text" class="form-control" id="group_name" placeholder="<?= $user_group['group_name'] ?>" value="<?= $user_group['group_name'] ?>" name="group_name" required>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="color_code">Group Color</label>
                    <input type="color" class="form-control" id="color_code" value="<?= $user_group['color_code'] ?>" name="color_code" title="Choose User Group color">
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label" for="remarks">Remarks</label>
                    <textarea class="form-control" id="remarks" placeholder="<?= $user_group['remarks'] ?>" name="remarks" data-info="remarks"><?= $user_group['remarks'] ?></textarea>
                </div>

                <div class="col-12 mb-3">

                    <div class="table-responsive text-nowrap">
                        <div class="form-check">
                            <input class="form-check-input" id="select-all-permissions" type="checkbox">
                            <label class="form-check-label" for="select-all-permissions"> Select / Deselect All Permissions </label>
                        </div>
                        <table class="table" data-info="no-pagination">
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
                                                id="view-all">
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
                                                id="create-all">
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
                                                id="update-all">
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
                                                id="delete-all">
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
                                                <input type="checkbox" id="permission-<?= $SL ?>" class="form-check-input select-row" title="<?= htmlspecialchars($row['name']) ?>">
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
                                                        data-bs-original-title="<?= htmlspecialchars($row[$perm . '_desc']) ?>">
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
                                                id="view-all2">
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
                                                id="create-all2">
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
                                                id="update-all2">
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
                                                id="delete-all2">
                                            <label for="delete-all2" class="form-check-label">Delete</label>
                                        </div>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>


                        <div class="form-check">
                            <input class="form-check-input" id="select-all-permissions2" type="checkbox">
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
                                        <!-- <img class="rounded-circle" src="< ?= systemVariable('SITE_HOME') ?>uploads/< ?= $row['profile_image'] ?>" alt="<?= $row['first_name'] ?> <?= $row['last_name'] ?>"> -->
                                        <?php echo getDP([
                                            'full_name' => $row['first_name'] . ' ' . $row['last_name'],
                                            'file_name' => $row['profile_image'],
                                            'class'     => 'rounded-circle',
                                            'alt'       => $row['first_name'] . ' ' . $row['last_name']
                                        ]); ?>
                                        <?php
                                        if (!$current_user) {
                                        ?>
                                            <button class="user-group-users-remove-btn" type="button"><i class="fas fa-times"></i></button>
                                        <?php
                                        }
                                        ?>
                                    </li>
                            <?php
                                }
                            }
                            // remove comma if it is in end
                            $user_id_in_user_group = rtrim($user_id_in_user_group, ',');
                            ?>
                        </ul>
                        <div class="my-3">
                            <label class="form-label" for="users_in_user_group">Add Users</label>

                            <div class="users-search-container" id="users_in_user_group">
                                <div class="users-search-box">
                                    <div id="user-search-options-input" class="form-control" contenteditable="true" data-placeholder="Search for Users to add in this User Group"></div>
                                    <div id="user-search-options" class="user-search-options enable-perfect-scrollbar">

                                        <?php

                                        if (mysqli_num_rows($users_options) > 0) {
                                            while ($row = mysqli_fetch_assoc($users_options)) {

                                                // hide the current user from option
                                                if ($row['userid'] == $_SESSION[USER_AUTH]) continue;

                                                // hide users from options who are already in the user group
                                                $is_hidden = in_array((int)$row['id'], array_map('intval', $exclude_user_options));

                                                // check if any site is assigned
                                                if ($row['treatment_site']) {
                                                    $site = getSiteById($row['treatment_site']);
                                                    $site = mysqli_fetch_assoc($site);
                                                    $site_name = $site['site_name'] . ' (' . $site['site_id'] . ')';
                                                } else {
                                                    $site_name = 'No Site is Asigned.';
                                                }

                                        ?>
                                                <div class="search-option"
                                                    data-id="<?= $row['id'] ?>"
                                                    data-first_name="<?= $row['first_name'] ?>"
                                                    data-last_name="<?= $row['last_name'] ?>"
                                                    data-userid="<?= $row['userid'] ?>"
                                                    data-profile_image="<?= $row['profile_image'] ?: '' ?>"
                                                    style="<?= $is_hidden ? 'display:none;' : '' ?>">
                                                    <div class="avatar_img">
                                                        <?= getDP([
                                                            'full_name' => $row['first_name'] . ' ' . $row['last_name'],
                                                            'file_name' => $row['profile_image'],
                                                            'class'     => 'rounded-circle',
                                                            'alt'       => $row['first_name'] . ' ' . $row['last_name']
                                                        ]); ?>
                                                    </div>
                                                    <div class="name-details">
                                                        <?= $row['first_name'] ?> <?= $row['last_name'] ?> (<?= $row['userid'] ?>) <br>
                                                        <strong><?= $site_name ?></strong>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            echo '<div class="search-option no-users-message">No Users Available</div>';
                                        }
                                        ?>
                                        <div class="search-option no-users-message" style="display: none;">No Users Available</div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="users_in_user_group_old" value="<?= $user_id_in_user_group ?>">
                            <input type="hidden" id="users_in_user_group_hidden" name="users_in_user_group" value="<?= $user_id_in_user_group ?>">

                        </div>
                    </div>
                </div>

                <div class="mt-2 d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn btn-dark">Reset</button>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>
                </div>
            </div>

        </form>
    </div>
</div>


<script>
    $(document).ready(function() {
        const $input = $('#user-search-options-input');
        const $options = $('#user-search-options');
        const $usersContainer = $('.users-container');
        const $hiddenInput = $('#users_in_user_group_hidden');
        const $noUsersMessage = $('.no-users-message');
        const siteUrl = '<?= SITE_URL ?>';

        function updateUserGroupHiddenInput() {
            const ids = [];
            $usersContainer.find('li[data-user-id]').each(function() {
                ids.push($(this).data('user-id'));
            });
            $hiddenInput.val(ids.join(','));
        }

        function updateNoUsersMessage() {
            const visibleOptions = $options.find('.search-option:not(.no-users-message):visible').length;
            $noUsersMessage.toggle(visibleOptions === 0);
        }

        // Show dropdown on click
        $input.on('click', function(e) {
            e.stopPropagation();
            $options.css('display', 'flex');

            // Show all unselected options again
            $options.find('.search-option:not(.no-users-message)').each(function() {
                const userId = $(this).data('id');
                const isAlreadySelected = $usersContainer.find(`li[data-user-id="${userId}"]`).length > 0;
                $(this).toggle(!isAlreadySelected);
            });

            updateNoUsersMessage();
        });

        // Hide dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#user-search-options-input').length &&
                !$(e.target).closest('#user-search-options').length) {
                $options.css('display', 'none');
            }
        });

        // Live filter
        $input.on('input', function() {
            const query = $(this).text().toLowerCase();
            $options.find('.search-option:not(.no-users-message)').each(function() {
                const $opt = $(this);
                const userId = $opt.data('id');
                const isAlreadySelected = $usersContainer.find(`li[data-user-id="${userId}"]`).length > 0;

                if (isAlreadySelected) {
                    $opt.hide();
                    return;
                }

                const fullText = $opt.text().toLowerCase();
                $opt.toggle(fullText.includes(query));
            });

            updateNoUsersMessage();
        });

        // ✅ Add user to group
        $options.on('click', '.search-option:not(.no-users-message)', async function() {
            const $option = $(this);

            const userId = $option.data('id');
            const firstName = $option.data('first_name') || '';
            const lastName = $option.data('last_name') || '';
            let profileImage = $option.data('profile_image');

            if (!profileImage || profileImage === 'null' || profileImage === 'undefined') {
                profileImage = '';
            }

            // ✅ Prevent duplicates
            if ($usersContainer.find(`li[data-user-id="${userId}"]`).length) return;

            const initials = (firstName.charAt(0) + (lastName.charAt(0) || '')).toUpperCase();
            let avatarContent = `<div class="rounded-circle" style="
                width:100%;
                height:100%;
                background:#e1e5ee;
                color:#444;
                font-weight:600;
                font-size:15px;
                display:flex;
                align-items:center;
                justify-content:center;
                border-radius:50%;
            ">${initials}</div>`;

            if (profileImage !== '') {
                const exists = await dp_exists(profileImage); // ✅ async check
                if (exists) {
                    avatarContent = `<img class="rounded-circle" src="${siteUrl}uploads/${profileImage}" alt="${firstName} ${lastName}">`;
                }
            }

            const avatarHTML = `
                <li data-user-id="${userId}"
                    aria-label="${firstName} ${lastName}"
                    class="avatar user-group-users-avatar pull-up"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="${firstName} ${lastName}">
                    ${avatarContent}
                    <button class="user-group-users-remove-btn" type="button">
                        <i class="fas fa-times"></i>
                    </button>
                </li>`;

            $usersContainer.append(avatarHTML);

            $usersContainer.find('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();

            $option.hide();
            $input.text('');
            $options.css('display', 'none');

            updateUserGroupHiddenInput();
            updateNoUsersMessage();
        });





        // ✅ Remove user from group
        $(document).on('click', '.user-group-users-remove-btn', function() {
            const $avatar = $(this).closest('li');
            const userId = $avatar.data('user-id');

            // ✅ Restore the hidden option with its data intact
            const $existingOption = $options.find(`.search-option[data-id="${userId}"]`);
            if ($existingOption.length > 0) {
                $existingOption.show();
            }

            // ✅ Remove avatar
            $avatar.tooltip('dispose').remove();

            updateUserGroupHiddenInput();
            updateNoUsersMessage();
        });


    });
</script>

<!-- check if dp file exists or not -->
<script>
    function dp_exists(file_name) {
        const form_data = {
            file_name: file_name,
            file_loc: 'uploads/',
            request_type: 'validate_file_existence'
        };

        return ajax_request(form_data).then(response => {
            return response.status === 'success'; // true if exists
        }).catch(() => false);
    }
</script>

<!-- submit form -->
<script>
    $(document).ready(() => {

        const permissionCheckboxesSelector = 'input[type="checkbox"][name^="permissions"]';
        const selectAllSelectors = '#select-all-permissions, #select-all-permissions2';

        const columnIDs = {
            view: ['#view-all', '#view-all2'],
            create: ['#create-all', '#create-all2'],
            update: ['#update-all', '#update-all2'],
            delete: ['#delete-all', '#delete-all2']
        };

        let isUpdating = false;

        function toggleAllPermissions(sourceCheckbox) {
            const isChecked = $(sourceCheckbox).is(':checked');
            isUpdating = true;
            $(permissionCheckboxesSelector).prop('checked', isChecked);
            $(selectAllSelectors).prop('checked', isChecked);
            Object.keys(columnIDs).forEach(col => {
                $(columnIDs[col].join(',')).prop('checked', isChecked);
            });
            isUpdating = false;
            updateAll();
        }

        function updateSelectAllCheckbox() {
            const total = $(permissionCheckboxesSelector).length;
            const checked = $(permissionCheckboxesSelector + ':checked').length;
            const allChecked = total > 0 && total === checked;
            $(selectAllSelectors).prop('checked', allChecked);
        }

        function updateRowToggles() {
            $('tbody tr').each(function() {
                const checkboxes = $(this).find(permissionCheckboxesSelector);
                const checked = checkboxes.filter(':checked').length;
                $(this).find('.select-row').prop('checked', checkboxes.length > 0 && checkboxes.length === checked);
            });
        }

        function updateColumnToggles() {
            Object.keys(columnIDs).forEach(col => {
                const checkboxes = $(`input[type="checkbox"][data-column="${col}"]`);
                const checked = checkboxes.filter(':checked').length;
                const allChecked = checkboxes.length > 0 && checkboxes.length === checked;
                $(columnIDs[col].join(',')).prop('checked', allChecked);
            });
        }

        function updateRowHighlighting() {
            $('tbody tr').each(function() {
                const isAnyChecked = $(this).find(permissionCheckboxesSelector).is(':checked');
                $(this).toggleClass('bg-success-subtle', isAnyChecked);
            });
        }

        function updateAll() {
            updateSelectAllCheckbox();
            updateRowToggles();
            updateColumnToggles();
            updateRowHighlighting();
        }

        // Select All Permissions (top and bottom)
        $(selectAllSelectors).on('change', function() {
            if (isUpdating) return;
            toggleAllPermissions(this);
        });

        // Column master checkboxes (top and bottom)
        Object.entries(columnIDs).forEach(([col, ids]) => {
            $(ids.join(',')).on('change', function() {
                if (isUpdating) return;
                const isChecked = $(this).is(':checked');
                isUpdating = true;
                $(ids.join(',')).prop('checked', isChecked);
                $(`input[data-column="${col}"]`).prop('checked', isChecked);
                isUpdating = false;
                updateAll();
            });
        });

        // Row master checkboxes
        $(document).on('change', '.select-row', function() {
            if (isUpdating) return;
            const row = $(this).closest('tr');
            const isChecked = $(this).is(':checked');
            isUpdating = true;
            row.find(permissionCheckboxesSelector).prop('checked', isChecked);
            isUpdating = false;
            updateAll();
        });

        // Individual cell checkbox (update column masters)
        $(document).on('change', permissionCheckboxesSelector, function() {
            if (isUpdating) return;

            const col = $(this).data('column');
            if (col) {
                const allCheckboxes = $(`input[data-column="${col}"]`);
                const checkedCount = allCheckboxes.filter(':checked').length;
                const allChecked = checkedCount === allCheckboxes.length;
                $(columnIDs[col].join(',')).prop('checked', allChecked);
            }

            updateAll();
        });

        // On initial page load
        updateAll();

        // Form submission
        const userGroupForm = enableUnsavedChangesWarning('#update_user_group');

        $('#update_user_group').on('submit', function(e) {
            e.preventDefault();

            var form_data = $('#update_user_group').serialize();
            form_data += "&id=<?= $user_group['id'] ?>";
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=update_user_group";

            // console.log(form_data);

            ajax_request(form_data).done(function(response) {
                // console.log(response);
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

                    userGroupForm.markFormClean(); // Reset dirty flag on success

                } else {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "red",
                    }).showToast();
                }
            });
        });

    });
</script>