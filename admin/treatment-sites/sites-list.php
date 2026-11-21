<?php

$sites_list = fetchAsArray(getSitesList());
$trashed_sites = fetchAsArray(getTrashedSitesList());

// Column definitions
$columns = [
    ['key' => 'site_id', 'label' => 'Site ID'],
    [
        'key' => 'site_name',
        'label' => 'Site Name',
        'renderer' => function ($row) {
            $id = $row['id'];
            $designation_name = $row['site_name'];
            return '<a href="./?id=' . $id . '&view">' . $designation_name . '</a>';
        }
    ],
    ['key' => 'updated_by', 'label' => 'Updated By'],
    ['key' => 'updated_at', 'label' => 'Last Update'],
];

// Counts
$activeCount = count($sites_list);
$trashedCount = count($trashed_sites);
?>

<div class="card-body" id="section-data">

    <?php renderModuleTabs('treatment_site', $activeCount, $trashedCount); ?>

    <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">

        <!-- Active Sites -->
        <div class="tab-pane fade show active" id="tab-active" role="tabpanel">
            <?php renderPermissionAwareTable(
                'treatment_site',
                $sites_list,
                $columns,
                ['view', 'edit', 'trash']  // allowed actions
            ); ?>
        </div>

        <!-- Trashed Sites -->
        <div class="tab-pane fade" id="tab-trash" role="tabpanel">
            <?php renderPermissionAwareTable(
                'treatment_site',
                $trashed_sites,
                $columns,
                ['restore', 'delete_permanent'] // trashed actions
            ); ?>
        </div>
    </div>
</div>



<script>
    async function takeAction(action, site_id) {
        let site_name = $('#table-row-title-' + site_id + ' strong').text() ||
            $('#table-row-title-' + site_id + ' strong a').text();

        let confirmMsg = '';
        let apiRequestType = '';

        switch (action) {
            case 'trash':
                confirmMsg = `Are you sure you want to move '${site_name}' to trash?`;
                apiRequestType = 'send_site_to_trash';
                break;

            case 'restore':
                confirmMsg = `Are you sure you want to restore '${site_name}'?`;
                apiRequestType = 'restore_site_from_trash';
                break;

            case 'delete':
                confirmMsg = `Are you sure you want to permanently delete '${site_name}'?`;
                apiRequestType = 'delete_site';
                break;

            default:
                console.error("Unknown action:", action);
                return;
        }

        let confirmed = await ConfirmDialogBox(confirmMsg, "Confirm Action");
        if (!confirmed) return;

        let form_data = "request_type=" + apiRequestType + "&id=" + site_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

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

                // ✅ Reload table dynamically
                $('#section-data').load(location.href + ' #section-data > *', function() {
                    // ✅ Re-init DataTables after reload
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