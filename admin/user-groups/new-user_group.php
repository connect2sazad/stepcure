
        <div class="card">
            <div class="card-body">
                <form id="add_new_user_group" method="POST" onsubmit="return false">
                    <div class="row">

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="group_name">Group Name</label>
                            <input type="text" class="form-control" id="group_name" placeholder="Group Name" value="" name="group_name" required>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="color_code">Group Color</label>
                            <input type="color" class="form-control" id="color_code" value="<?= systemVariable('default_user_group_color') ?>" name="color_code" title="Choose User Group color">
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea class="form-control" id="remarks" placeholder="Enter Remarks" name="remarks" data-info="remarks"></textarea>
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
                                        $permissions = getPermissionsList();
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
                                                <td class="text-center">
                                                    <?php if ($row['view_id']): ?>
                                                        <input type="checkbox"
                                                            name="permissions[<?= $row['name'] ?>][]"
                                                            value="<?= $row['view_id'] ?>"
                                                            data-column="view"
                                                            data-bs-toggle="tooltip"
                                                            data-popup="tooltip-custom"
                                                            data-bs-placement="top"
                                                            aria-label="<?= htmlspecialchars($row['view_desc']) ?>"
                                                            data-bs-original-title="<?= htmlspecialchars($row['view_desc']) ?>">
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($row['create_id']): ?>
                                                        <input type="checkbox"
                                                            name="permissions[<?= $row['name'] ?>][]"
                                                            value="<?= $row['create_id'] ?>"
                                                            data-column="create"
                                                            data-bs-toggle="tooltip"
                                                            data-popup="tooltip-custom"
                                                            data-bs-placement="top"
                                                            aria-label="<?= htmlspecialchars($row['create_desc']) ?>"
                                                            data-bs-original-title="<?= htmlspecialchars($row['create_desc']) ?>">
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($row['update_id']): ?>
                                                        <input type="checkbox"
                                                            name="permissions[<?= $row['name'] ?>][]"
                                                            value="<?= $row['update_id'] ?>"
                                                            data-column="update"
                                                            data-bs-toggle="tooltip"
                                                            data-popup="tooltip-custom"
                                                            data-bs-placement="top"
                                                            aria-label="<?= htmlspecialchars($row['update_desc']) ?>"
                                                            data-bs-original-title="<?= htmlspecialchars($row['update_desc']) ?>">
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($row['delete_id']): ?>
                                                        <input type="checkbox"
                                                            name="permissions[<?= $row['name'] ?>][]"
                                                            value="<?= $row['delete_id'] ?>"
                                                            data-column="delete"
                                                            data-bs-toggle="tooltip"
                                                            data-popup="tooltip-custom"
                                                            data-bs-placement="top"
                                                            aria-label="<?= htmlspecialchars($row['delete_desc']) ?>"
                                                            data-bs-original-title="<?= htmlspecialchars($row['delete_desc']) ?>">
                                                    <?php endif; ?>
                                                </td>
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
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Publish</button>
                        <button type="reset" class="btn btn-secondary me-2">Reset</button>
                    </div>
                </form>
            </div>
        </div>


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
        const userGroupForm = enableUnsavedChangesWarning('#add_new_user_group');

        $('#add_new_user_group').on('submit', function(e) {
            e.preventDefault();

            var form_data = $(this).serialize();
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=add_new_user_group";

            ajax_request(form_data).done(function(response) {
                // console.log(response);
                // response = JSON.parse(response);

                if (response.status === 'success') {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    userGroupForm.markFormClean(); // Reset dirty flag on success

                    window.location = "<?= systemVariable('SITE_HOME') ?>admin/user-groups/?id=" + response.id;
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