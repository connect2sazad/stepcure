<?php

// Fetch Active & Trashed
$active_designations = fetchAsArray(getUserDesignationsList());
$trashed_designations = fetchAsArray(getTrashedUserDesignationsList());

// Columns for the table
$columns = [
    [
        'key' => 'designation_name',
        'label' => 'Designation Name',
        'renderer' => function ($row) {
            $id = $row['id'];
            $designation_name = $row['designation_name'];
            return '<a href="./?id=' . $id . '&view">' . $designation_name . '</a>';
        }
    ],
    ['key' => 'updated_by', 'label' => 'Updated By'],
    ['key' => 'updated_at', 'label' => 'Last Update'],
];

// Counts
$activeCount  = count($active_designations);
$trashedCount = count($trashed_designations);
?>

<div class="card-body" id="section-data">

    <?php 
    // ✅ Generic Tabs (Active, Trash, +New)
    renderModuleTabs('user_designation', $activeCount, $trashedCount); 
    ?>

    <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">
        
        <!-- ✅ Active -->
        <div class="tab-pane fade show active" id="tab-active" role="tabpanel">
            <?php 
            renderPermissionAwareTable(
                'user_designation',   // module name
                $active_designations,
                $columns,
                ['view','edit','trash'],   // allowed actions for active list
                'id'  // rowIdKey
            ); 
            ?>
        </div>

        <!-- ✅ Trashed -->
        <div class="tab-pane fade" id="tab-trash" role="tabpanel">
            <?php 
            renderPermissionAwareTable(
                'user_designation', 
                $trashed_designations,
                $columns,
                ['restore','delete_permanent'], // trashed actions
                'id'
            ); 
            ?>
        </div>
    </div>
</div>

<script>
async function takeAction(action, id) {
    let name = $('#table-row-title-' + id + ' strong a').text() || 
               $('#table-row-title-' + id + ' strong').text();

    let confirmMsg = '';
    let apiRequestType = '';

    switch (action) {
        case 'trash':
            confirmMsg = `Are you sure you want to move '${name}' to trash?`;
            apiRequestType = 'send_user_designation_to_trash';
            break;
        case 'restore':
            confirmMsg = `Are you sure you want to restore '${name}'?`;
            apiRequestType = 'restore_user_designation_from_trash';
            break;
        case 'delete':
            confirmMsg = `Are you sure you want to permanently delete '${name}'?`;
            apiRequestType = 'delete_user_designation';
            break;
        default:
            console.error("Unknown action:", action);
            return;
    }

    let confirmed = await ConfirmDialogBox(confirmMsg, "Confirm Action");
    if (!confirmed) return;

    let form_data = "request_type=" + apiRequestType + "&id=" + id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

    ajax_request(form_data, false).done(function(response) {
        response = JSON.parse(response);

        if (response.status === 'success') {
            Toastify({
                text: response.message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#4fbe87",
            }).showToast();

            // ✅ Reload table dynamically + re-init DataTables
            $('#section-data').load(location.href + ' #section-data > *', function() {
                $('table').DataTable({
                    destroy: true,
                    select: true
                });
            });

        } else {
            Toastify({
                text: response.message || 'Action failed!',
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
