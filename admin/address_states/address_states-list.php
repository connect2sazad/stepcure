<?php

$address_states_list = fetchAsArray(getAddressStatesList());
$trashed_address_states = fetchAsArray(getTrashedAddressStatesList());


// Column definitions
$columns = [
    // ['key' => 'product_category_id', 'label' => 'Site ID'],
    [
        'key'   => 'slug',
        'label' => 'State',
        'renderer' => function ($row) {

            $name = isset($row['state_name']) ? htmlspecialchars($row['state_name']) : '';

            $id = isset($row['id']) ? (int)$row['id'] : 0;
            $slug = isset($row['slug']) ? htmlspecialchars($row['slug']) : '';

            return '
                <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="d-flex flex-column">
                        <a href="./?id=' . $id . '&view" class="text-heading text-truncate">
                            <span class="fw-medium" id="table-row-full-name-' . $id . '">' . $name . '</span>
                        </a>
                        <small id="table-row-userid-' . $id . '">' . $slug . '</small>
                    </div>
                </div>
            ';
        }
    ],
    [
        'key' => 'state_code',
        'label' => 'State Code'
    ],
    [
        'key' => 'gst_code',
        'label' => 'GST Code'
    ],
    ['key' => 'updated_by', 'label' => 'Updated By'],
];

// Counts
$activeCount = count($address_states_list);
$trashedCount = count($trashed_address_states);
?>

<div class="card-body" id="section-data">

    <?php renderModuleTabs('product_category', $activeCount, $trashedCount); ?>

    <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">

        <!-- Active Sites -->
        <div class="tab-pane fade show active" id="tab-active" role="tabpanel">
            <?php renderPermissionAwareTable(
                'product_category',
                $address_states_list,
                $columns,
                ['view', 'edit', 'trash']  // allowed actions
            ); ?>
        </div>

        <!-- Trashed Sites -->
        <div class="tab-pane fade" id="tab-trash" role="tabpanel">
            <?php renderPermissionAwareTable(
                'product_category',
                $trashed_address_states,
                $columns,
                ['restore', 'delete_permanent'] // trashed actions
            ); ?>
        </div>
    </div>
</div>



<script>
    async function takeAction(action, product_category_id) {
        let product_category_name = $('#table-row-full-name-' + product_category_id).text() ||
            $('#table-row-full-name-' + product_category_id).text();

        let confirmMsg = '';
        let apiRequestType = '';

        switch (action) {
            case 'trash':
                confirmMsg = `Are you sure you want to move '${product_category_name}' to trash?`;
                apiRequestType = 'send_product_category_to_trash';
                break;

            case 'restore':
                confirmMsg = `Are you sure you want to restore '${product_category_name}'?`;
                apiRequestType = 'restore_product_category_from_trash';
                break;

            case 'delete':
                confirmMsg = `Are you sure you want to permanently delete '${product_category_name}'?`;
                apiRequestType = 'delete_product_category';
                break;

            default:
                console.error("Unknown action:", action);
                return;
        }

        let confirmed = await ConfirmDialogBox(confirmMsg, "Confirm Action");
        if (!confirmed) return;

        let form_data = "request_type=" + apiRequestType + "&id=" + product_category_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

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