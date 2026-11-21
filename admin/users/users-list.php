<?php

// Fetch Active & Trashed
$active_users = admin_list_fetch(fn()=>getUsersListDetailed(), 'users', 'active_users');
$trashed_users = admin_list_fetch(fn()=>getTrashedUsersListDetailed(), 'users', 'trashed_users');

// Columns for the table
$columns = [
    [
        'key'   => 'profile_image',
        'label' => 'User',
        'renderer' => function ($row) {

            $firstName = isset($row['first_name']) ? htmlspecialchars($row['first_name']) : '';
            $lastName = isset($row['last_name']) ? htmlspecialchars($row['last_name']) : '';
            $name = trim($firstName . ' ' . $lastName);

            $profileImage = isset($row['profile_image']) ? $row['profile_image'] : '';
            $userHonorifics = isset($row['default_honorifics']) ? htmlspecialchars($row['default_honorifics']) . ' ' : '';

            $id = isset($row['id']) ? (int)$row['id'] : 0;
            $userId = isset($row['userid']) ? htmlspecialchars($row['userid']) : '';

            $load_dp = getDP([
                'full_name' => $name,
                'file_name' => $profileImage,
                'class'     => 'rounded-circle',
                'alt'       => 'User Profile Picture'
            ]);

            return '
                <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper">
                        <div class="avatar avatar-sm me-4">
                            ' . $load_dp . '
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="./?id=' . $id . '&view" class="text-heading text-truncate">
                            <span class="fw-medium" id="table-row-full-name-' . $id . '">' . $userHonorifics . $name . '</span>
                        </a>
                        <small id="table-row-userid-' . $id . '">@' . $userId . '</small>
                    </div>
                </div>
            ';
        }
    ],
    [
        'key'   => 'designation_name',
        'label' => 'Designation',
        'renderer' => function ($row) {
            $designationName = isset($row['designation_name']) ? htmlspecialchars($row['designation_name']) : '';
            $isActive = isset($row['user_designations_active']) ? (bool)$row['user_designations_active'] : false;
            $isDeleted = isset($row['user_designations_deleted']) ? (bool)$row['user_designations_deleted'] : false;

            $error = (!$isActive || $isDeleted) ? ' <i class="text-danger fas fa-exclamation-triangle"></i>' : '';

            return $designationName . $error;
        }
    ],
    [
        'key'   => 'group_name',
        'label' => 'Group',
        'renderer' => function ($row) {
            $groupName = isset($row['group_name']) ? htmlspecialchars($row['group_name']) : '';
            $isActive = isset($row['user_groups_active']) ? (bool)$row['user_groups_active'] : false;
            $isDeleted = isset($row['user_groups_deleted']) ? (bool)$row['user_groups_deleted'] : false;

            $error = (!$isActive || $isDeleted) ? ' <i class="text-danger fas fa-exclamation-triangle"></i>' : '';

            return $groupName . $error;
        }
    ],
    [
        'key'   => 'site_name',
        'label' => 'Site',
        'renderer' => function ($row) {
            $siteName = isset($row['site_name']) ? htmlspecialchars($row['site_name']) : '';
            $isActive = isset($row['sites_active']) ? (bool)$row['sites_active'] : false;
            $isDeleted = isset($row['sites_deleted']) ? (bool)$row['sites_deleted'] : false;

            $error = (!$isActive || $isDeleted) ? ' <i class="text-danger fas fa-exclamation-triangle"></i>' : '';

            return $siteName . $error;
        }
    ],
    [
        'key'   => 'updated_by',
        'label' => 'Updated By',
        // No renderer, so default output will be $row['updated_by']
    ]
];


// Counts
$activeCount  = admin_list_total($active_users, 'active_users');
$trashedCount = admin_list_total($trashed_users, 'trashed_users');
?>
<div class="card-body" id="section-data">

    <?php
    // ✅ Generic Tabs (Active, Trash, +New)
    renderModuleTabs('user', $activeCount, $trashedCount);
    ?>

    <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">

        <!-- ✅ Active -->
        <div class="tab-pane fade show active" id="tab-active" role="tabpanel">
            <?php
            renderPermissionAwareTable(
                'user',   // module name
                $active_users,
                $columns,
                ['view', 'edit', 'trash'],   // allowed actions for active list
                'id'  // rowIdKey
            );
            ?>
        </div>


        <div class="tab-pane fade" id="tab-trash" role="tabpanel">
            <?php
            renderPermissionAwareTable(
                'user',   // module name
                $trashed_users,
                $columns,
                ['restore', 'delete_permanent'], // trashed actions
                'id'  // rowIdKey
            );
            ?>
        </div>
    </div>

</div>


<script>
    async function takeAction(action, id) {
        let full_name = $('#table-row-full-name-' + id).text().trim();
        let userid = $('#table-row-userid-' + id).text().trim();
        let display_name = userid + " (" + full_name + ")";

        let confirmMsg = "";
        let dialogTitle = "";
        let requestType = "";

        switch (action) {
            case "trash":
                confirmMsg = `Are you sure you want to trash/deactivate the User ${display_name}?`;
                dialogTitle = "Trash/Deactivate User";
                requestType = "send_user_to_trash";
                break;
            case "restore":
                confirmMsg = `Are you sure you want to restore the User '${display_name}'?`;
                dialogTitle = "Restore User";
                requestType = "restore_user_from_trash";
                break;
            case "delete":
                confirmMsg = `Are you sure you want to permanently delete the User '${display_name}'?`;
                dialogTitle = "Permanently Delete User";
                requestType = "delete_user";
                break;
            default:
                console.warn("Unknown action:", action);
                return;
        }

        // ✅ Ask confirmation
        let confirmed = await ConfirmDialogBox(confirmMsg, dialogTitle);
        if (!confirmed) return;

        let form_data = `request_type=${requestType}&id=${id}&updated_by=<?= $_SESSION[USER_AUTH] ?>`;

        ajax_request(form_data, false).done(function(response) {
            try {
                response = JSON.parse(response);
                if (response.status === "success") {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    // ✅ Reload table section only
                    // ✅ Reload table dynamically + re-init DataTables
                    $('#section-data').load(location.href + ' #section-data > *', function() {
                        $('table:not([data-server-page="1"])').DataTable({
                            destroy: true,
                            select: true
                        });
                    });

                } else {
                    showErrorToast("Failed to process request!");
                }
            } catch (e) {
                console.error("Invalid JSON:", response);
                showErrorToast("Unexpected response!");
            }
        }).fail(function(err) {
            console.error("AJAX Error:", err);
            showErrorToast("Request failed!");
        });
    }

    function showErrorToast(msg) {
        Toastify({
            text: msg,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "red",
        }).showToast();
    }
</script>