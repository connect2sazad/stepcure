<?php

function getSiteById($id)
{
    $query = WHERE('sites', 'id', $id);
    $site = runQuery($query);
    return $site;
}

function getSitesList()
{
    $sites = "SELECT * FROM `sites` WHERE `sites`.`is_active` = 1 AND `sites`.`is_deleted` = 0;";
    $run_query = runQuery($sites);
    return $run_query;
}

function getTrashedSitesList()
{
    $sites = "SELECT * FROM `sites` WHERE `sites`.`is_active` = 0 AND `sites`.`is_deleted` = 0;";
    $run_query = runQuery($sites);
    return $run_query;
}

function getTreatmentSiteOptions()
{
    $sites = "SELECT * FROM `sites` WHERE `sites`.`is_active` = 1 AND `sites`.`is_deleted` = 0;";
    $run_query = runQuery($sites);
    return $run_query;
}

function getAddressStatesOptions()
{
    $conditions = [
        "is_active" => 1,
        "is_deleted" => 0
    ];
    $query = WHEREm('address_states', $conditions);
    $run_query = runQuery($query);
    return $run_query;
}

function getAddressStatesList()
{
    return getAddressStatesOptions();
}

function getTrashedAddressStatesList()
{
    $conditions = [
        "is_deleted" => 1
    ];
    $query = WHEREm('address_states', $conditions);
    $run_query = runQuery($query);
    return $run_query;
}

function getPermissionsList()
{
    $query = "
        SELECT 
            name,
            MAX(CASE WHEN slug LIKE '%view' THEN id END) AS view_id,
            MAX(CASE WHEN slug LIKE '%view' THEN description END) AS view_desc,
            MAX(CASE WHEN slug LIKE '%create' THEN id END) AS create_id,
            MAX(CASE WHEN slug LIKE '%create' THEN description END) AS create_desc,
            MAX(CASE WHEN slug LIKE '%update' THEN id END) AS update_id,
            MAX(CASE WHEN slug LIKE '%update' THEN description END) AS update_desc,
            MAX(CASE WHEN slug LIKE '%delete' THEN id END) AS delete_id,
            MAX(CASE WHEN slug LIKE '%delete' THEN description END) AS delete_desc
        FROM 
            permissions
        WHERE slug LIKE '%view' OR slug LIKE '%create' OR slug LIKE '%update' OR slug LIKE '%delete'
        GROUP BY 
            name ASC;
    ";

    return runQuery($query);
}

function getPermissionsListWithGroup($group_id)
{
    $query = "
        SELECT 
            p.name,
            MAX(CASE WHEN p.slug LIKE '%view' THEN p.id END) AS view_id,
            MAX(CASE WHEN p.slug LIKE '%create' THEN p.id END) AS create_id,
            MAX(CASE WHEN p.slug LIKE '%update' THEN p.id END) AS update_id,
            MAX(CASE WHEN p.slug LIKE '%delete' THEN p.id END) AS delete_id,

            MAX(CASE WHEN p.slug LIKE '%view' THEN p.description END) AS view_desc,
            MAX(CASE WHEN p.slug LIKE '%create' THEN p.description END) AS create_desc,
            MAX(CASE WHEN p.slug LIKE '%update' THEN p.description END) AS update_desc,
            MAX(CASE WHEN p.slug LIKE '%delete' THEN p.description END) AS delete_desc,

            MAX(CASE WHEN p.slug LIKE '%view' AND gp.permission_id IS NOT NULL THEN 1 ELSE 0 END) AS has_view,
            MAX(CASE WHEN p.slug LIKE '%create' AND gp.permission_id IS NOT NULL THEN 1 ELSE 0 END) AS has_create,
            MAX(CASE WHEN p.slug LIKE '%update' AND gp.permission_id IS NOT NULL THEN 1 ELSE 0 END) AS has_update,
            MAX(CASE WHEN p.slug LIKE '%delete' AND gp.permission_id IS NOT NULL THEN 1 ELSE 0 END) AS has_delete

        FROM permissions p
        LEFT JOIN group_permissions gp ON gp.permission_id = p.id AND gp.group_id = $group_id
        GROUP BY p.name
    ";

    return runQuery($query);
}

function getPermissionsListWithUser($user_id)
{
    $query = "
        SELECT 
            p.name,
            MAX(CASE WHEN p.slug LIKE '%view' THEN p.id END) AS view_id,
            MAX(CASE WHEN p.slug LIKE '%create' THEN p.id END) AS create_id,
            MAX(CASE WHEN p.slug LIKE '%update' THEN p.id END) AS update_id,
            MAX(CASE WHEN p.slug LIKE '%delete' THEN p.id END) AS delete_id,

            MAX(CASE WHEN p.slug LIKE '%view' THEN p.description END) AS view_desc,
            MAX(CASE WHEN p.slug LIKE '%create' THEN p.description END) AS create_desc,
            MAX(CASE WHEN p.slug LIKE '%update' THEN p.description END) AS update_desc,
            MAX(CASE WHEN p.slug LIKE '%delete' THEN p.description END) AS delete_desc,

            MAX(CASE WHEN p.slug LIKE '%view' AND gp.permission_id IS NOT NULL THEN 1 ELSE 0 END) AS has_view,
            MAX(CASE WHEN p.slug LIKE '%create' AND gp.permission_id IS NOT NULL THEN 1 ELSE 0 END) AS has_create,
            MAX(CASE WHEN p.slug LIKE '%update' AND gp.permission_id IS NOT NULL THEN 1 ELSE 0 END) AS has_update,
            MAX(CASE WHEN p.slug LIKE '%delete' AND gp.permission_id IS NOT NULL THEN 1 ELSE 0 END) AS has_delete

        FROM permissions p
        LEFT JOIN user_permissions gp ON gp.permission_id = p.id AND gp.user_id = $user_id
        GROUP BY p.name
    ";

    return runQuery($query);
}

function getUserGroupPermissions($id)
{
    $query = WHERE('group_permissions', 'group_id', $id);
    $run_query = runQuery($query);
    return $run_query;
}

function getUserDesignationById($id)
{
    $query = WHERE('user_designations', 'id', $id);
    $user_designation = runQuery($query);
    return $user_designation;
}

function getUserDesignationsList()
{
    $conditions = [
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $user_designations = WHEREm('user_designations', $conditions);
    $run_query = runQuery($user_designations);
    return $run_query;
}

function getUserDesignationOptions()
{
    $conditions = [
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $user_designations = WHEREm('user_designations', $conditions);
    $run_query = runQuery($user_designations);
    return $run_query;
}


function getTrashedUserDesignationsList()
{
    $conditions = [
        'is_active' => 0,
        'is_deleted' => 0
    ];
    $user_designations = WHEREm('user_designations', $conditions);
    $run_query = runQuery($user_designations);
    return $run_query;
}

// get all permissions by PERMISSION_NAME, PERMISSION_NAME is defined in each page starts
function getAllPermissionsByPERMISSION_NAME($with_details = false)
{
    $query = "SELECT * FROM permissions WHERE slug LIKE \"" . PERMISSION_NAME . ":%\"";
    $run_query = runQuery($query);
    $permissions_list = [];
    if (mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_assoc($run_query)) {
            if ($with_details) {
                array_push($permissions_list, $row);
            } else {
                array_push($permissions_list, str_replace(PERMISSION_NAME . ':', '', $row['slug']));
            }
        }
    }
    return $permissions_list;
}

// get all user permissions by PERMISSION_NAME, PERMISSION_NAME is defined in each page starts
function getUserPermissionsByPERMISSION_NAME($with_details = false)
{
    $user_id = getIdFromUserid($_SESSION[USER_AUTH]);  // logged-in user ID

    if (!defined('PERMISSION_NAME')) {
        return []; // no module defined
    }

    $permission_name = PERMISSION_NAME; // e.g. 'treatment_site'

    // ✅ Correct string concatenation
    $sql = "
        SELECT p.*
        FROM user_permissions up
        INNER JOIN permissions p ON up.permission_id = p.id
        WHERE 
            up.user_id = {$user_id}
            AND up.allow = 1
            AND p.slug LIKE '{$permission_name}:%'
    ";

    $run_query = runQuery($sql);
    $permissions_list = [];

    if (mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_assoc($run_query)) {
            if ($with_details) {
                $permissions_list[] = $row; // full details (id, name, slug, description)
            } else {
                // Only return action part (view/create/update/delete)
                $permissions_list[] = str_replace($permission_name . ':', '', $row['slug']);
            }
        }
    }

    return $permissions_list;
}


// get all user group permissions by PERMISSION_NAME, PERMISSION_NAME is defined in each page starts
function getUserGroupPermissionsByPERMISSION_NAME($with_details = false)
{
    $user = getUserByUserid($_SESSION[USER_AUTH]);  // logged-in user
    $user = mysqli_fetch_assoc($user);
    $user_group_id = $user['user_group'];
    $user_group = getUserGroupById($user_group_id);
    $user_group = mysqli_fetch_assoc($user_group);

    // if permission is not defined
    if (!defined('PERMISSION_NAME')) {
        return []; // no module defined
    }

    // If group not found → return empty
    if (!$user_group) {
        return [];
    }

    // If group inactive or deleted → return empty
    if (!$user_group['is_active'] || $user_group['is_deleted']) {
        return []; // no module defined
    }

    $permission_name = PERMISSION_NAME; // e.g. 'treatment_site'

    // ✅ Correct string concatenation
    $sql = "
        SELECT p.*
        FROM group_permissions gp
        INNER JOIN permissions p ON gp.permission_id = p.id
        WHERE 
            gp.group_id = {$user_group_id}
            AND gp.allow = 1
            AND p.slug LIKE '{$permission_name}:%'
    ";

    $run_query = runQuery($sql);
    $permissions_list = [];

    if (mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_assoc($run_query)) {
            if ($with_details) {
                $permissions_list[] = $row; // full details (id, name, slug, description)
            } else {
                // Only return action part (view/create/update/delete)
                $permissions_list[] = str_replace($permission_name . ':', '', $row['slug']);
            }
        }
    }

    return $permissions_list;
}

function checkPermissions($check_permission, $user_permissions, $group_permissions)
{
    $user = getUserByUserid($_SESSION[USER_AUTH]);
    $user = mysqli_fetch_assoc($user);

    // If user not found → deny
    if (!$user) {
        return false;
    }

    $user_group_id = (int)$user['user_group'];

    // 1️⃣ SUPER ADMIN → Always allow
    if ($user_group_id === 1) {
        return true;
    }

    // 2️⃣ Validate requested permission is valid for this module
    $valid_permissions = getAllPermissionsByPERMISSION_NAME(); // e.g. ["create","update","delete","view"]

    if (!in_array($check_permission, $valid_permissions, true)) {
        // Invalid permission requested → log attempt
        addNewAdminUpdate($user['userid'], "⚠ Invalid permission '{$check_permission}' requested for module " . PERMISSION_NAME);
        return false;
    }

    // 3️⃣ Merge user + group permissions
    $effective_permissions = array_unique(array_merge($user_permissions, $group_permissions));

    // 4️⃣ Check if allowed
    $allowed = in_array($check_permission, $effective_permissions, true);

    if (!$allowed) {
        // Log denied attempt
        addNewAdminUpdate($user['userid'], "<strong>Permission denied</strong>: Tried '{$check_permission}' on module " . PERMISSION_NAME);
    }

    return $allowed;
}

function getAllPermissionNames($with_details = false)
{
    $permission_names = [];
    $query = "
        SELECT DISTINCT SUBSTRING_INDEX(slug, ':', 1) AS base_slug
        FROM permissions
        WHERE slug LIKE '%:create'
        OR slug LIKE '%:view'
        OR slug LIKE '%:update'
        OR slug LIKE '%:delete';
    ";

    $run_query = runQuery($query);

    if (mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_assoc($run_query)) {
            // get the base slug as the mysql gives the pre-slugs as base_slug | check $query
            array_push($permission_names, $row['base_slug']);
        }
    }

    return $permission_names;
}

function getUserAllEffectivePermissions($user_id)
{
    $permissions = [];

    // 1️⃣ Get direct user permissions
    $query_user = "
        SELECT DISTINCT SUBSTRING_INDEX(p.slug, ':', 1) AS base_slug
        FROM user_permissions up
        INNER JOIN permissions p ON p.id = up.permission_id
        WHERE up.user_id = '$user_id' AND up.allow = 1
    ";
    $run_user = runQuery($query_user);
    while ($row = mysqli_fetch_assoc($run_user)) {
        $permissions[] = $row['base_slug'];
    }

    // 2️⃣ Find the user's group_id
    $query_group_id = "SELECT user_group FROM users WHERE id = '$user_id' LIMIT 1";
    $run_group_id = runQuery($query_group_id);
    $group_id = null;
    if ($run_group_id && mysqli_num_rows($run_group_id) > 0) {
        $group_row = mysqli_fetch_assoc($run_group_id);
        $group_id = $group_row['user_group'];
    }


    // 3️⃣ If user has a group, get its permissions
    if (!empty($group_id)) {

        $user_group = getUserGroupById($group_id);
        $user_group = mysqli_fetch_assoc($user_group);

        if ($user_group['is_active'] && !$user_group['is_deleted']) {

            $query_group = "
            SELECT DISTINCT SUBSTRING_INDEX(p.slug, ':', 1) AS base_slug
            FROM group_permissions gp
            INNER JOIN permissions p ON p.id = gp.permission_id
            WHERE gp.group_id = '$group_id' AND gp.allow = 1
            ";
            $run_group = runQuery($query_group);
            while ($row = mysqli_fetch_assoc($run_group)) {
                $permissions[] = $row['base_slug'];
            }
        }
    }

    // 4️⃣ Merge + unique
    $permissions = array_unique($permissions);

    return $permissions;
}

function getPatientById($id)
{
    $query = WHERE('patients', 'id', $id);
    $user = runQuery($query);
    return $user;
}

function getPatientsList()
{
    $conditions = [
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $patients = WHEREm('patients', $conditions);
    $run_query = runQuery($patients);
    return $run_query;
}

function getTrashedPatientsList()
{
    $conditions = [
        'is_active' => 0,
        'is_deleted' => 0
    ];
    $patients = WHEREm('patients', $conditions);
    $run_query = runQuery($patients);
    return $run_query;
}

function getConsultationsListByPatientId($patient_id)
{
    $conditions = [
        'patient_id' => $patient_id,
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $consultations = WHEREm('consultations', $conditions);
    $run_query = runQuery($consultations);
    return $run_query;
}

function getSalesListByPatientId($patient_id)
{
    $conditions = [
        'patient_id' => $patient_id,
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $sales = WHEREm('sales', $conditions);
    $run_query = runQuery($sales);
    return $run_query;
}

function getConsultationsListBySiteId($siteid)
{
    $user_group = userVariable('user_group');

    // if user group is 1 super admin or 2 admin, show all sites
    if ($user_group == 1 || $user_group == 2) {
        $consultations = "SELECT * FROM consultations WHERE is_active = 1 AND is_deleted = 0";
    } else {
        $consultations = "SELECT * FROM consultations WHERE site_id = $siteid AND is_active = 1 AND is_deleted = 0";
    }
    $run_query = runQuery($consultations);
    return $run_query;
}

function getConsultationsByUserId()
{
    //  get all consultations as per user id
    $user_id = userVariable('id');
    $conditions = ['is_active' => 1, 'is_deleted' => 0, 'user_id' => $user_id];
    $query = WHEREm('consultations', $conditions);
    $run_query = runQuery($query);
    return $run_query;
}

function getConsultationsList()
{
    //  get all consultations globally
    $conditions = ['is_active' => 1, 'is_deleted' => 0];
    $query = WHEREm('consultations', $conditions);
    $run_query = runQuery($query);
    return $run_query;
}

function getTrashedConsultationsListBySiteId($siteid)
{
    $user_group = userVariable('user_group');

    // if user group is 1 (super admin) or 2 (admin), show all sites
    if ($user_group == 1 || $user_group == 2) {
        $consultations = "SELECT * FROM consultations WHERE is_active = 0 AND is_deleted = 0";
    } else {
        if (!is_null($siteid)) {
            $siteid = intval($siteid); // prevent injection
            $consultations = "SELECT * FROM consultations WHERE site_id = $siteid AND is_active = 0 AND is_deleted = 0";
        } else {
            // fallback if site ID is null but user is not admin
            return []; // or return runQuery("SELECT * FROM consultations WHERE 1=0"); // returns nothing
        }
    }

    return runQuery($consultations);
}

function getConsultationById($id)
{
    $query = WHERE('consultations', 'id', $id);
    $user = runQuery($query);
    return $user;
}

function getConsultationOptions()
{
    $conditions = [
        'is_active' => 1,
        'is_deleted' => 0,
        'is_report_finalized' => 1
    ];
    $consultations = WHEREm('consultations', $conditions);
    $run_query = runQuery($consultations);
    return $run_query;
}

function getPriorIssuesList()
{
    $conditions = [
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $query = WHEREm('prior_issues', $conditions);
    $run_query = runQuery($query);
    return $run_query;
}

function getProductCategoryById($id)
{
    $query = WHERE('product_categories', 'id', $id);
    $product_category = runQuery($query);
    return $product_category;
}

function getProductCategoriesList()
{
    $conditions = [
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $product_categories = WHEREm('product_categories', $conditions);
    $run_query = runQuery($product_categories);
    return $run_query;
}

function getProductCategoryOptions()
{
    $conditions = [
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $product_categories = WHEREm('product_categories', $conditions);
    $run_query = runQuery($product_categories);
    return $run_query;
}

function getTrashedProductCategoriesList()
{
    $conditions = [
        'is_active' => 0,
        'is_deleted' => 0
    ];
    $product_categories = WHEREm('product_categories', $conditions);
    $run_query = runQuery($product_categories);
    return $run_query;
}

function getProductByProductCategoryId($category_id)
{
    $query = WHERE('products', 'category_id', $category_id);
    $product_category = runQuery($query);
    return $product_category;
}

function getProductById($id)
{
    $query = WHERE('products', 'id', $id);
    $product = runQuery($query);
    return $product;
}

function getProductsList()
{
    $conditions = [
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $products = WHEREm('products', $conditions);
    $run_query = runQuery($products);
    return $run_query;
}

function getTrashedProductsList()
{
    $conditions = [
        'is_active' => 0,
        'is_deleted' => 0
    ];
    $products = WHEREm('products', $conditions);
    $run_query = runQuery($products);
    return $run_query;
}

function getInventoryById($id)
{
    $query = WHERE('inventory', 'id', $id);
    $product = runQuery($query);
    return $product;
}

function getCurrentInventoryValueBySiteId($site_id = null)
{
    if ($site_id) {
        $query = "SELECT SUM(inventory.quantity * products.discounted_price) AS total_value, SUM(inventory.quantity) AS total_count, COUNT(DISTINCT inventory.product_id) AS products_count FROM inventory INNER JOIN products ON inventory.product_id = products.id WHERE products.is_active = 1 AND products.is_deleted = 0 AND inventory.site_id = $site_id;";
    } else {
        $query = "SELECT SUM(inventory.quantity * products.discounted_price) AS total_value, SUM(inventory.quantity) AS total_count, COUNT(DISTINCT inventory.product_id) AS products_count FROM inventory INNER JOIN products ON inventory.product_id = products.id WHERE products.is_active = 1 AND products.is_deleted = 0;";
    }
    $result = runQuery($query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['total_value'] === null) {
            $row['total_value'] = 0; // Ensure total_value is not null
        }
        if ($row['total_count'] === null) {
            $row['total_count'] = 0; // Ensure total_count is not null
        }
        return array('total_value' => $row['total_value'], 'total_count' => $row['total_count'], 'products_count' => $row['products_count']) ?? array('total_value' => 0, 'total_count' => 0, 'products_count' => 0);
    }

    return array('total_value' => 0, 'total_count' => 0, 'products_count' => 0);
}

function getCurrentMonthProductsSoldQuantity($product_id = null, $site_id = null)
{
    if ($product_id && $site_id) {
        $query = "SELECT SUM(change_quantity) AS total_quantity FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) AND transaction_type = 1 AND product_id = $product_id AND site_id = $site_id;";
    } elseif ($product_id) {
        $query = "SELECT SUM(change_quantity) AS total_quantity FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) AND transaction_type = 1 AND product_id = $product_id;";
    } elseif ($site_id) {
        $query = "SELECT SUM(change_quantity) AS total_quantity FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) AND transaction_type = 1 AND site_id = $site_id;";
    } else {
        $query = "SELECT SUM(change_quantity) AS total_quantity FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) AND transaction_type = 1;";
    }
    $result = runQuery($query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['total_quantity'] ?? 0;
    }

    return 0; // Return 0 if no products sold this month
}

function getLastMonthProductsSoldQuantity($product_id = null, $site_id = null)
{
    if ($product_id && $site_id) {
        $query = "SELECT SUM(change_quantity) AS total_quantity FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND transaction_type = 1 AND product_id = $product_id AND site_id = $site_id;";
    } elseif ($product_id) {
        $query = "SELECT SUM(change_quantity) AS total_quantity FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND transaction_type = 1 AND product_id = $product_id;";
    } elseif ($site_id) {
        $query = "SELECT SUM(change_quantity) AS total_quantity FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND transaction_type = 1 AND site_id = $site_id;";
    } else {
        $query = "SELECT SUM(change_quantity) AS total_quantity FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND transaction_type = 1;";
    }

    $result = runQuery($query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['total_quantity'] ?? 0;
    }

    return 0; // Return 0 if no products sold last month
}

function getCurrentMonthProductsSoldAmount($product_id = null, $site_id = null)
{
    if ($product_id && $site_id) {
        $query = "SELECT SUM(amount) AS total_amount FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) AND transaction_type = 1 AND product_id = $product_id AND site_id = $site_id;";
    } elseif ($product_id) {
        $query = "SELECT SUM(amount) AS total_amount FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) AND transaction_type = 1 AND product_id = $product_id;";
    } elseif ($site_id) {
        $query = "SELECT SUM(amount) AS total_amount FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) AND transaction_type = 1 AND site_id = $site_id;";
    } else {
        $query = "SELECT SUM(amount) AS total_amount FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) AND transaction_type = 1;";
    }

    $result = runQuery($query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['total_amount'] ?? 0;
    }

    return 0; // Return 0 if no products sold this month
}

function getLastMonthProductsSoldAmount($product_id = null, $site_id = null)
{
    if ($product_id && $site_id) {
        $query = "SELECT SUM(amount) AS total_amount FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND transaction_type = 1 AND product_id = $product_id AND site_id = $site_id;";
    } elseif ($product_id) {
        $query = "SELECT SUM(amount) AS total_amount FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND transaction_type = 1 AND product_id = $product_id;";
    } elseif ($site_id) {
        $query = "SELECT SUM(amount) AS total_amount FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND transaction_type = 1 AND site_id = $site_id;";
    } else {
        $query = "SELECT SUM(amount) AS total_amount FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND transaction_type = 1;";
    }
    // $query = "SELECT SUM(amount) AS total_amount FROM inventory_transactions WHERE MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND transaction_type = 1;";
    $result = runQuery($query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['total_amount'] ?? 0;
    }

    return 0; // Return 0 if no products sold last month
}

function getInventoryBySiteId($site_id = null)
{
    if ($site_id) {
        // Query to get inventory for the specific site
        $query = "
        SELECT i.*, p.product_images, p.product_name, p.slug, p.discounted_price, p.category_id, p.is_active, p.is_deleted
        FROM inventory i
        INNER JOIN products p ON i.product_id = p.id
        WHERE i.site_id = $site_id AND p.is_active = 1 AND p.is_deleted = 0;
        ";
    } else {

        $query = "
        SELECT i.*, p.product_images, p.product_name, p.slug, p.discounted_price, p.category_id, p.is_active, p.is_deleted
        FROM inventory i
        INNER JOIN products p ON i.product_id = p.id
        WHERE p.is_active = 1 AND p.is_deleted = 0;
        ";
    }

    $run_query = runQuery($query);
    return $run_query;
}

function getInventoryByProductIdAndSiteId($product_id, $site_id){
    $conditions = [
        'product_id' => $product_id,
        'site_id' => $site_id
    ];
    $query = WHEREm('inventory', $conditions);
    $run_query = runQuery($query);
    return $run_query;
}

function getInventoryTransactionsById($id)
{
    $conditions = [
        'inventory_id' => $id
    ];
    $inventory_transactions = WHEREm('inventory_transactions', $conditions);
    $run_query = runQuery($inventory_transactions);
    return $run_query;
}

function getSaleById($id)
{
    $query = WHERE('sales', 'id', $id);
    $site = runQuery($query);
    return $site;
}

function getSalesList()
{
    $sales = "SELECT * FROM `sales` WHERE `sales`.`is_active` = 1 AND `sales`.`is_deleted` = 0;";
    $run_query = runQuery($sales);
    return $run_query;
}

function getTrashedSalesList()
{
    $sales = "SELECT * FROM `sales` WHERE `sales`.`is_active` = 0 AND `sales`.`is_deleted` = 0;";
    $run_query = runQuery($sales);
    return $run_query;
}

function getSaleItemsBySaleId($id)
{
    $query = WHERE('sales_items', 'sale_id', $id);
    $site = runQuery($query);
    return $site;
}



function getInvoicesList()
{
    //  get all customer invoices globally
    $conditions = ['is_active' => 1, 'is_deleted' => 0];
    $query = WHEREm('customer_invoices', $conditions);
    $run_query = runQuery($query);
    return $run_query;
}

function getInvoiceById($id)
{
    $query = WHERE('customer_invoices', 'id', $id);
    $user = runQuery($query);
    return $user;
}

function getInvoices()
{
    //  get all invoices
    $conditions = ['is_active' => 1, 'is_deleted' => 0];
    $query = WHEREm('customer_invoices', $conditions);
    $run_query = runQuery($query);
    return $run_query;
}

function getTrashedInvoicesList()
{
    $conditions = ['is_active' => 0, 'is_deleted' => 0];
    $query = WHEREm('customer_invoices', $conditions);
    $run_query = runQuery($query);
    return $run_query;
}

function getSystemGeneratedInvoices(){
    $conditions = ['is_active' => 1, 'is_deleted' => 0, 'is_sale_finalized' => 1];
    $query = WHEREm('sales', $conditions);
    $run_query = runQuery($query);
    return $run_query;
}

function getInvoiceItemsByInvoiceId($id)
{
    $query = WHERE('customer_invoice_items', 'customer_invoice_id', $id);
    $site = runQuery($query);
    return $site;
}

function onlineUserRegister($data){
// ---
}

function onlineUserLogin($data)
{

    $query = WHERE('online_users', 'email', $data['email']);
    $run_query = runQuery($query);


    $response = array();

    if (mysqli_num_rows($run_query) > 0) {

        $fetch = mysqli_fetch_assoc($run_query);

        if ($fetch['is_active'] != 1) {
            $response['status'] = 'failed';
            $response['message'] = "Your account has been deactivated!";
            return $response;
        }

        if ($fetch['is_deleted'] == 1) {
            $response['status'] = 'failed';
            $response['message'] = "No such User Found!";
            return $response;
        }

        if (password_verify($data['password'], $fetch['password']) == 1) {
            
            // Start the session if needed
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION[CLIENT_USER_AUTH] = $fetch['email'];

            $user = $_SESSION[CLIENT_USER_AUTH];

            $user_data = WHERE('online_users', 'email', $data['email']);
            $user_data = runQuery($user_data);
            $user_data = mysqli_fetch_assoc($user_data);

            $response['status'] = 'success';
            $response['message'] = "Login Successfull!";
            $response['data'] = $user_data;

        } else {
            $response['status'] = 'failed';
            $response['message'] = "Incorrect Credentials!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such User Found!";
    }
    return $response;
}

function getOnlineUserByEmail($email)
{
    $query = WHERE('online_users', 'email', $email);
    $user = runQuery($query);
    $user = mysqli_fetch_assoc($user);
    return $user;
}

function getMembersByOnlineUser($online_user_id)
{
    $conditions = [
        'online_user_id' => $online_user_id,
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $query = WHEREm('patients', $conditions);
    echo $query; exit;
    $run_query = runQuery($query);
    return $run_query;
}

function onlineUserVariable($variable_name)
{
    if (isset($_SESSION[CLIENT_USER_AUTH])) {
        $email = $_SESSION[CLIENT_USER_AUTH];
        $user = getOnlineUserByEmail($email);
        return $user[$variable_name];
    }
    return null;
}