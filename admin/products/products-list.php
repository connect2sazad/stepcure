<?php

$products_list = admin_list_fetch(fn()=>getProductsList(), 'products', 'products_list');
$trashed_products = admin_list_fetch(fn()=>getTrashedProductsList(), 'products', 'trashed_products');


// Column definitions
$columns = [
    [
        'key'   => 'slug',
        'label' => 'Product',
        'renderer' => function ($row) {

            $name = isset($row['product_name']) ? htmlspecialchars($row['product_name']) : '';

            $productImage = isset($row['product_images']) ? $row['product_images'] : '';
            $productImage = json_decode($productImage, true);
            $productImage = $productImage[0] ?? ''; // Get the first image if available

            $id = isset($row['id']) ? (int)$row['id'] : 0;
            $userId = isset($row['slug']) ? htmlspecialchars($row['slug']) : '';

            $load_dp = getDP([
                'full_name' => $name,
                'file_name' => $productImage,
                'class'     => 'rounded-circle',
                'alt'       => 'Product Image'
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
                        <small id="table-row-userid-' . $id . '">' . $userId . '</small>
                    </div>
                </div>
            ';
        }
    ],
    [
        'key' => 'type',
        'label' => 'Type',
        'renderer' => function ($row) {
            $types = ["Women's Footwear",  "Men's Footwear", "Foot Orthotics", "Custom Footwear"];
            $type = isset($row['type']) ? htmlspecialchars($row['type']) : 'Unknown Type';
            return '<span class="badge bg-label-dark">' . $types[$type] . '</span>';
        }
    ],
    [
        'key'   => 'category_id',
        'label' => 'Category',
        'renderer' => function ($row) {

            $category = $row['category_id'];
            $category = getProductCategoryById($category);
            $category = mysqli_fetch_assoc($category);
            $category_name = isset($category['category_name']) ? htmlspecialchars($category['category_name']) : 'Unknown Category';
            $category_slug = isset($category['slug']) ? htmlspecialchars($category['slug']) : 'Unknown Category';

            $categoryImage = isset($category['category_image']) ? $category['category_image'] : '';

            $id = isset($category['id']) ? (int)$category['id'] : 0;

            $load_dp = getDP([
                'full_name' => $category_name,
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
                        <a href="' . systemVariable('SITE_HOME') . 'admin/product-categories?id=' . $id . '&view" class="text-heading text-truncate">
                            <span class="fw-medium" id="table-row-full-name-' . $id . '">' . $category_name . '</span>
                        </a>
                        <small id="table-row-userid-' . $id . '">' . $category_slug . '</small>
                    </div>
                </div>
            ';
        }
    ],
    ['key' => 'updated_by', 'label' => 'Updated By'],
];

// Counts
$activeCount = admin_list_total($products_list, 'products_list');
$trashedCount = admin_list_total($trashed_products, 'trashed_products');
?>

<div class="card-body" id="section-data">

    <?php renderModuleTabs('product', $activeCount, $trashedCount); ?>

    <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">

        <!-- Active Sites -->
        <div class="tab-pane fade show active" id="tab-active" role="tabpanel">
            <?php renderPermissionAwareTable(
                'product',
                $products_list,
                $columns,
                ['view', 'edit', 'trash']  // allowed actions
            ); ?>
        </div>

        <!-- Trashed Sites -->
        <div class="tab-pane fade" id="tab-trash" role="tabpanel">
            <?php renderPermissionAwareTable(
                'product',
                $trashed_products,
                $columns,
                ['restore', 'delete_permanent'] // trashed actions
            ); ?>
        </div>
    </div>
</div>



<script>
    async function takeAction(action, product_id) {
        let product_name = $('#table-row-full-name-' + product_id).text() ||
            $('#table-row-full-name-' + product_id).text();

        let confirmMsg = '';
        let apiRequestType = '';

        switch (action) {
            case 'trash':
                confirmMsg = `Are you sure you want to move '${product_name}' to trash?`;
                apiRequestType = 'send_product_to_trash';
                break;

            case 'restore':
                confirmMsg = `Are you sure you want to restore '${product_name}'?`;
                apiRequestType = 'restore_product_from_trash';
                break;

            case 'delete':
                confirmMsg = `Are you sure you want to permanently delete '${product_name}'?`;
                apiRequestType = 'delete_product';
                break;

            default:
                console.error("Unknown action:", action);
                return;
        }

        let confirmed = await ConfirmDialogBox(confirmMsg, "Confirm Action");
        if (!confirmed) return;

        let form_data = "request_type=" + apiRequestType + "&id=" + product_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

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
                    $('table:not([data-server-page="1"])').DataTable({
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