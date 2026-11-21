<?php

$product_categories_list = fetchAsArray(getProductCategoriesList());
$trashed_product_categories = fetchAsArray(getTrashedProductCategoriesList());


// Column definitions
$columns = [
    // ['key' => 'product_category_id', 'label' => 'Site ID'],
    [
        'key'   => 'slug',
        'label' => 'Category',
        'renderer' => function ($row) {

            $name = isset($row['category_name']) ? htmlspecialchars($row['category_name']) : '';

            $categoryImage = isset($row['category_image']) ? $row['category_image'] : '';

            $id = isset($row['id']) ? (int)$row['id'] : 0;
            $slug = isset($row['slug']) ? htmlspecialchars($row['slug']) : '';

            $load_dp = getDP([
                'full_name' => $name,
                'file_name' => $categoryImage,
                'class'     => 'rounded-circle',
                'alt'       => 'Category Image'
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
                            <span class="fw-medium" id="table-row-full-name-' . $id . '">' . $name . '</span>
                        </a>
                        <small id="table-row-userid-' . $id . '">' . $slug . '</small>
                    </div>
                </div>
            ';
        }
    ],
    [
        'key' => 'created_by',
        'label' => 'No of Products',
        'renderer' => function ($row) {
            $productCount = getProductByProductCategoryId($row['id']);
            return mysqli_num_rows($productCount);
        }
    ],
    ['key' => 'updated_by', 'label' => 'Updated By'],
];

// Counts
$activeCount = count($product_categories_list);
$trashedCount = count($trashed_product_categories);
?>

<div class="card-body" id="section-data">

    <?php renderModuleTabs('product_category', $activeCount, $trashedCount); ?>

    <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">

        <!-- Active Sites -->
        <div class="tab-pane fade show active" id="tab-active" role="tabpanel">
            <?php renderPermissionAwareTable(
                'product_category',
                $product_categories_list,
                $columns,
                ['view', 'edit', 'trash']  // allowed actions
            ); ?>
        </div>

        <!-- Trashed Sites -->
        <div class="tab-pane fade" id="tab-trash" role="tabpanel">
            <?php renderPermissionAwareTable(
                'product_category',
                $trashed_product_categories,
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