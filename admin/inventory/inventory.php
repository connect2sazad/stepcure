<?php

// get site of the current user
$current_site = userVariable('treatment_site');
$current_site_exists = $current_site && $current_site > 0;

// Fetch Inventory Data for user's site
$my_site_inventory = fetchAsArray(getInventoryBySiteId($current_site_exists ? $current_site : null));

// Fetch Inventory Data for all sites
$all_sites_inventory = fetchAsArray(getInventoryBySiteId());

// Fetch Inventory Data for central hub
$central_hub_site_id = systemVariable('default_site_id');
$central_hub_site_inventory = fetchAsArray(getInventoryBySiteId($central_hub_site_id));

$current_inventory_value = getCurrentInventoryValueBySiteId($current_site_exists ? $current_site : null);

// get the current month and last month sold quantity
$current_month_sold_quantity = getCurrentMonthProductsSoldQuantity(null, $current_site_exists ? $current_site : null);
$last_month_sold_quantity = getLastMonthProductsSoldQuantity(null, $current_site_exists ? $current_site : null);
$is_sales_up = $current_month_sold_quantity > $last_month_sold_quantity;
$change_percentage = $last_month_sold_quantity > 0
    ? round((($current_month_sold_quantity - $last_month_sold_quantity) / $last_month_sold_quantity) * 100, 0)
    : 0;
$change_icon = $is_sales_up ? '&#9650;' : '&#9660;'; // ▲ or ▼
$change_class = $is_sales_up ? 'text-success' : 'text-danger';

// get the current month and last month sold amount
$current_month_sold_amount = getCurrentMonthProductsSoldAmount(null, $current_site_exists ? $current_site : null);
$last_month_sold_amount = getLastMonthProductsSoldAmount(null, $current_site_exists ? $current_site : null);
$is_amount_up = $current_month_sold_amount > $last_month_sold_amount;
$change_amount_percentage = $last_month_sold_amount > 0
    ? round((($current_month_sold_amount - $last_month_sold_amount) / $last_month_sold_amount) * 100, 0)
    : 0;
$change_amount_icon = $is_amount_up ? '&#9650;' : '&#9660;';
$change_amount_class = $is_amount_up ? 'text-success' : 'text-danger';

// Columns for the table
$columns = [
    [
        'key'   => 'slug',
        'label' => 'Product',
        'renderer' => function ($row) {

            $name = isset($row['product_name']) ? htmlspecialchars($row['product_name']) : '';

            $productImage = isset($row['product_images']) ? $row['product_images'] : '';
            $productImage = json_decode($productImage, true);
            $productImage = $productImage[0] ?? ''; // Get the first image if available

            // pre($row);

            $id = isset($row['id']) ? (int)$row['id'] : 0;
            $product_id = isset($row['product_id']) ? (int)$row['product_id'] : 0;
            $produt_slug = isset($row['slug']) ? htmlspecialchars($row['slug']) : '';

            $load_dp = getDP([
                'full_name' => $name,
                'file_name' => $productImage,
                'class'     => 'rounded-circle',
                'alt'       => 'Product Image'
            ]);

            $user_group = userVariable('user_group');
            $is_authorized_group = ($user_group == 1 || $user_group == 2);
            $is_site_matched = ($row['site_id'] == userVariable('treatment_site'));
            $href = ($is_site_matched || $is_authorized_group) ? 'href="./?id=' . $id . '&transactions"' : '';


            return '
                <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper">
                        <div class="avatar avatar-sm me-4">
                            ' . $load_dp . '
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <a ' . $href . ' class="text-heading text-truncate">
                            <span class="fw-medium" id="table-row-full-name-' . $id . '">' . $name . '</span>
                        </a>
                        <a href="' . systemVariable('SITE_HOME') . 'admin/products/?id=' . $product_id . '&view" class="text-heading text-truncate">
                            <small id="table-row-userid-' . $id . '">' . $produt_slug . '</small>
                        </a>
                    </div>
                </div>
            ';
        }
    ],
    [
        'key'   => 'stock',
        'label' => 'Current Stock',
        'renderer' => function ($row) {
            $stock_quantity = getInventoryById($row['id']);
            $stock_quantity = mysqli_fetch_assoc($stock_quantity);
            if ($stock_quantity) {
                return $stock_quantity['quantity'] ? $stock_quantity['quantity'] : 'Out of Stock';
            }
        }
    ],
    [
        'key'   => 'amount',
        'label' => 'Stock Amount',
        'renderer' => function ($row) {
            $stock_quantity = getInventoryById($row['id']);
            $stock_quantity = mysqli_fetch_assoc($stock_quantity);
            if ($stock_quantity) {
                return rupee($stock_quantity['quantity'] * $row['discounted_price'] ?? '0');
            }
        }
    ],
    [
        'key'   => 'sales',
        'label' => 'Sales',
        'renderer' => function ($row) {
            $products_sold_current = getCurrentMonthProductsSoldQuantity($row['id']);
            $products_sold_last = getLastMonthProductsSoldQuantity($row['id']);
            $is_sales_up = $products_sold_current > $products_sold_last;
            $change_percentage = $products_sold_last > 0
                ? round((($products_sold_current - $products_sold_last) / $products_sold_last) * 100, 0)
                : 0;
            $change_icon = $is_sales_up ? '<span class="text-success">&#9650;</span>' : '<span class="text-danger">&#9660;</span>'; // Up or Down triangle
            $change_class = $is_sales_up ? 'text-success' : 'text-danger';
            return '
                    <span>' . $products_sold_current . '</span>
                    <span class="' . $change_class . '">' . $change_icon . ' ' . abs($change_percentage) . '%</span>
                ';
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
];

// Counts
$activeCount  = $current_inventory_value['products_count'];
?>

<div class="row">
    <div class="col-sm-6 col-xl-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="text-heading">Items</span>
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2"><?= indian_number_format($activeCount) ?></h4>
                            <!-- <p class="text-success mb-0">(+29%)</p> -->
                        </div>
                        <small class="mb-0">Total Products</small>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="icon-base fas fa-box icon-lg"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="text-heading">Current Stock</span>
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2"><?= indian_number_format($current_inventory_value['total_count']) ?></h4>
                            <!-- <p class="text-success mb-0">(&#9650;18%)</p> -->
                        </div>
                        <small class="mb-0"><?= rupee($current_inventory_value['total_value']) ?></small>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-danger">
                            <i class="icon-base fas fa-warehouse icon-lg"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="text-heading">Product Sales</span>
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2"><?= indian_number_format($current_month_sold_quantity) ?></h4>
                            <p class="<?= $change_class ?> mb-0"><?= $change_icon . abs($change_percentage) ?>%</p>
                        </div>
                        <small class="mb-0">Last month analytics</small>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-success">
                            <i class="icon-base fas fa-chart-bar icon-lg"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="text-heading">Sales</span>
                        <div class="d-flex align-items-center my-1">
                            <h6 class="mb-0 me-2"><?= rupee($current_month_sold_amount) ?></h6>
                            <p class="<?= $change_amount_class ?> mb-0"><?= $change_amount_icon . abs($change_amount_percentage) ?>%</p>
                        </div>
                        <small class="mb-0">Last month analytics</small>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-warning">
                            <i class="icon-base fas fa-rupee-sign icon-lg"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body" id="section-data">

        <?php
        $customTabs = [];
        if ($current_site_exists) {
            $customTabs[] = [
                'label' => 'My Site',
                'permission' => 'view',
                'target' => '#tab-my-site-stock',
                'index' => 1,
                "active" => true
            ];
        }
        array_push($customTabs, [
            'label' => 'All Sites',
            'permission' => 'view',
            'target' => '#tab-all-sites-stock',
            'index' => 1,
            "active" => true
        ]);
        array_push($customTabs, [
            'label' => 'Central Hub',
            'permission' => 'view',
            'target' => '#tab-central-site-stock',
            'index' => 1,
            "active" => true
        ]);


        renderModuleTabs('current_stock', 0, 0, $customTabs, false);
        ?>

        <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">

            <?php

            $user_group = userVariable('user_group');
            $is_authorized_group = ($user_group == 1 || $user_group == 2);

            // action buttons
            $actions1 = [
                [
                    'label' => 'View Transactions',
                    'icon' => 'bx bx-transfer',
                    'permission' => 'view',
                    'onclick' => 'goToTransactions', // JS function name
                    'params' => ['id'], // optional keys from row to pass
                ],
                [
                    'label' => 'Add Stock',
                    'icon' => 'bx bx-plus',
                    'permission' => 'update',
                    'onclick' => 'addStockData', // JS function name
                    'params' => ['id'], // optional keys from row to pass
                    'data' => [ // custom data attributes
                        'bs-toggle' => 'modal', // e.g., data-info="action-button"
                        'bs-target' => '#modalCenter', // e.g., data-target="#details-dialog-body"
                    ]
                ]
            ];

            $actions2 = [
                // [
                //     'label' => 'Request Item',
                //     'icon' => 'fas fa-hand-paper',
                //     'permission' => 'update',
                //     'onclick' => 'alert("Item Requested | waiting to receive")', // JS function name
                //     // 'onclick' => 'addStockData', // JS function name
                //     // 'params' => ['id'], // optional keys from row to pass
                //     // 'data' => [ // custom data attributes
                //     //     'bs-toggle' => 'modal', // e.g., data-info="action-button"
                //     //     'bs-target' => '#modalCenter', // e.g., data-target="#details-dialog-body"
                //     // ]
                // ],
                // [
                //     'label' => 'Send Item',
                //     'icon' => 'fas fa-paper-plane',
                //     'permission' => 'update',
                //     'onclick' => 'alert("Item Sent | Waiting for receipt")', // JS function name
                //     // 'onclick' => 'addStockData', // JS function name
                //     // 'params' => ['id'], // optional keys from row to pass
                //     // 'data' => [ // custom data attributes
                //     //     'bs-toggle' => 'modal', // e.g., data-info="action-button"
                //     //     'bs-target' => '#modalCenter', // e.g., data-target="#details-dialog-body"
                //     // ]
                // ]
            ];


            ?>

            <!-- ✅ Active -->
            <div class="tab-pane fade show active" id="tab-my-site-stock" role="tabpanel">
                <?php
                renderPermissionAwareTable(
                    'current_stock',   // module name
                    $my_site_inventory,
                    $columns,
                    $actions1,   // allowed actions for active list
                    'id'  // rowIdKey
                );
                ?>
            </div>

            <div class="tab-pane fade" id="tab-all-sites-stock" role="tabpanel">
                <?php

                // site details here
                $site_details = [
                    'key'   => 'site_name',
                    'label' => 'Site',
                    'renderer' => function ($row) {
                        $site = $row['site_id'];
                        $site = getSiteById($site);
                        $site = mysqli_fetch_assoc($site);
                        $siteName = isset($site['site_name']) ? htmlspecialchars($site['site_name']) : '';
                        $siteId = isset($site['site_id']) ? htmlspecialchars($site['site_id']) : '';


                        return $siteName . '<br><span class="text-muted">' . $siteId . '</span>';
                    }
                ];

                // replace 'sales' with 'site_name'
                $columns = array_map(function ($col) use ($site_details) {
                    return $col['key'] === 'sales' ? $site_details : $col;
                }, $columns);

                // remove stock amount if the user doesn't belong to 1 or 2
                if (!$is_authorized_group) {
                    $columns = array_filter($columns, function ($col) {
                        return $col['key'] !== 'amount';
                    });
                }


                renderPermissionAwareTable(
                    'current_stock',   // module name
                    $all_sites_inventory,
                    $columns,
                    $is_authorized_group ? $actions1 : $actions2,   // allowed actions for active list
                    'id'  // rowIdKey
                );
                ?>
            </div>

            <div class="tab-pane fade" id="tab-central-site-stock" role="tabpanel">
                <?php

                // remove site_name as it is for central site
                $columns = array_filter($columns, function ($col) {
                    return $col['key'] !== 'site_name';
                });

                renderPermissionAwareTable(
                    'current_stock',   // module name
                    $central_hub_site_inventory,
                    $columns,
                    $is_authorized_group ? $actions1 : $actions2,   // allowed actions for active list
                    'id'  // rowIdKey
                );
                ?>
            </div>

        </div>
    </div>
</div>

<script>
    function goToTransactions(id) {
        if (!id) return;
        window.location.href = `./?id=${id}&transactions`;
    }
</script>
<script>
    function addStockData(id) {
        let url = '<?= systemVariable('SITE_HOME') ?>admin/inventory/add-stock/?id=' + id;
        let selector = '#add-stock-form';


        $('#modalCenterTitle').text('Add Stock');
        console.log(url, selector);

        // Load content and manipulate after load
        $('#details-dialog-body').load(url + ' ' + selector, function() {
            // Disable only buttons with data-info="action-button"
            // $('#details-dialog-body').find('button[data-info="action-button"]').hide();

            // Add target="_blank" to all links inside the loaded content
            $('#details-dialog-body').find('a').attr('target', '_blank');
        });


    }
</script>