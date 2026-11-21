<?php

function admin_login($request)
{

    $query = WHERE('users', 'userid', $request['userid']);
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

        if (password_verify($request['password'], $fetch['password']) == 1) {
            $response['status'] = 'success';
            $response['message'] = "Login Successfull!";
            // Start the session if needed
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION[USER_AUTH] = $fetch['userid'];

            $user = $_SESSION[USER_AUTH];
            $user = getIdFromUserid($user);
            $user = getUserById($user);
            $user = mysqli_fetch_assoc($user);

            if ($user['user_group'] != 1) {
                addNewAdminUpdate($user['userid'], 'User Logged In');
            }
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

function add_new_page($request)
{

    $page_title = addslashes($request['page_title']);
    $page_unique_name = $request['page_unique_name'];
    $slug = $request['page_unique_name'];
    $featured_image = $request['featured_image'];
    $page_htmls = addslashes($request['page_htmls']);
    $updated_by = $request['updated_by'];

    $response = array();

    $check_existence = WHERE('pages', 'page_unique_name', $page_unique_name);
    $check_existence = runQuery($check_existence);
    $check_existence = mysqli_num_rows($check_existence);

    // $sql_seo = createQueryForSEO($request, 'pages', 3);

    if ($check_existence > 0) {
        $response['status'] = 'failed';
        $response['message'] = "Such Page already exists!";
    } else {
        $unique_id = getRandomId('8');

        $query = "INSERT INTO `pages` (`page_title`, `page_unique_name`, `slug`, `featured_image`, `page_htmls`, `updated_by`, `meta_unique_name`) VALUES ('$page_title', '$page_unique_name', '$slug', '$featured_image', '$page_htmls', '$updated_by', 'pages_$unique_id');";

        $run_query = runQuery($query);

        $meta_query = createQueryForSEO($request, 'pages', $unique_id);

        $meta_data_insert = setMetaData($meta_query, 'pages', $unique_id);

        if ($run_query == 1) {

            $query2 = WHERE('pages', 'page_unique_name', $page_unique_name);
            $run_query2 = runQuery($query2);
            $fetch = mysqli_fetch_assoc($run_query2);

            $update_text = 'Added a new page to the site! Check out, how they have managed to do it! <a href="' . systemVariable('SITE_HOME') . 'admin/pages?page_id=' . $fetch['page_id'] . '">Check</a>';
            // return ["status" => "info", "message" => $update_text];
            $admin_update = addNewAdminUpdate($updated_by, $update_text);

            $response['status'] = 'success';
            $response['message'] = "Published '$page_title' as a Page!";
            $response['page_id'] = $fetch['page_id'];
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to publish Page!";
        }
    }

    return $response;
}

function update_page($request)
{
    $page_title = addslashes($request['page_title']);
    // return $request;
    $featured_image = $request['featured_image'];
    $page_htmls = addslashes($request['page_htmls']);

    $updated_by = $request['updated_by'];
    $page_id = $request['page_id'];

    $response = array();

    $check_existence = getPageById($page_id);

    if (mysqli_num_rows($check_existence) > 0) {
        $query = "UPDATE `pages` SET `page_title` = '$page_title', `featured_image` = '$featured_image', `page_htmls` = '$page_htmls', `updated_by` = '$updated_by' WHERE `pages`.`page_id` = $page_id;";
        $run_query = runQuery($query);

        $check_existence = mysqli_fetch_assoc($check_existence);
        $meta_key = $check_existence['meta_unique_name'];
        $meta_key = str_replace('pages_', '', $meta_key);
        // return $meta_key;
        $meta_query = createQueryForSEO($request, 'pages', $meta_key);
        setMetaData($meta_query, 'pages', $meta_key);


        if ($run_query == 1) {

            addNewAdminUpdate($updated_by, 'Updated "' . $page_title . '" Page for the site! <a href="' . systemVariable('SITE_HOME') . 'admin/pages?page_id=' . $page_id . '">View all details</a>!');

            $response['status'] = 'success';
            $response['message'] = "Page updated Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to update Page!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Page Found!";
    }

    return $response;
}

function send_page_to_trash($request)
{
    $page_id = $request['page_id'];
    $updated_by = $request['updated_by'];

    if (mysqli_num_rows(getPageById($page_id)) > 0) {
        $query = "UPDATE `pages` SET `is_trashed` = 1, `updated_by` = '$updated_by' WHERE `pages`.`page_id` = $page_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $page = getPageById($page_id);
            $page = mysqli_fetch_assoc($page);
            $page_title = $page['page_title'];

            addNewAdminUpdate($updated_by, 'Trashed "' . $page_title . '" Page for the site!');

            $response['status'] = 'success';
            $response['message'] = "Page trashed Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to trash Page!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Page Found!";
    }
    return $response;
}

function restore_page_from_trash($request)
{
    $page_id = $request['page_id'];
    $updated_by = $request['updated_by'];

    if (mysqli_num_rows(getPageById($page_id)) > 0) {
        $query = "UPDATE `pages` SET `is_trashed` = 0, `updated_by` = '$updated_by' WHERE `pages`.`page_id` = $page_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $page = getPageById($page_id);
            $page = mysqli_fetch_assoc($page);
            $page_title = $page['page_title'];

            addNewAdminUpdate($updated_by, 'Restored "' . $page_title . '" Page for the site!');

            $response['status'] = 'success';
            $response['message'] = "Page restored Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to restore Page!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Page Found!";
    }
    return $response;
}

function delete_page($request)
{
    $page_id = $request['page_id'];
    $updated_by = $request['updated_by'];

    if (mysqli_num_rows(getPageById($page_id)) > 0) {
        $query = "UPDATE `pages` SET `is_deleted` = 1, `updated_by` = '$updated_by' WHERE `pages`.`page_id` = $page_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $page = getPageById($page_id);
            $page = mysqli_fetch_assoc($page);
            $page_title = $page['page_title'];

            addNewAdminUpdate($updated_by, 'Permanently Deleted "' . $page_title . '" Page for the site!');

            $response['status'] = 'success';
            $response['message'] = "Page deleted Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to delete Page!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Page Found!";
    }
    return $response;
}

// check availability of something
function check_availability($request)
{
    $table = $request['table'];
    $column = $request['column'];
    $value = $request['value'];

    $query = WHERE($table, $column, $value);
    $run_query = runQuery($query);


    $response = array();

    if (mysqli_num_rows($run_query) > 0) {
        $response['status'] = 'success';
        $response['availability'] = 'positive';
        $response["alotted_to"] = mysqli_fetch_assoc($run_query)[$column];
        $response['message'] = "Not Available!";
    } else {
        $response['status'] = 'failed';
        $response['availability'] = 'negative';
        $response['message'] = "Available!";
    }
    return $response;
}

// check multiple availability of something
function check_multiple_availability($request)
{
    $table = $request['table'];
    $values = $request['values'];

    $availability = [];

    foreach ($values as $column => $value) {
        if ($value !== null && $value !== '') {
            $query = WHERE($table, $column, $value);
            $run_query = runQuery($query);
            $availability[$column] = (mysqli_num_rows($run_query) > 0) ? 'positive' : 'negative';
        }
    }

    return [
        'status' => 'success',
        'availability' => $availability
    ];
}

function add_new_user($request)
{
    // data section - page 1
    $first_name = $request['first_name'];
    $last_name = $request['last_name'];
    $aadhaar_no = $request['aadhaar_no'];
    $pan_no = $request['pan_no'];
    $userid = $request['userid'];
    $email = $request['email'];

    $password = $request['password'];
    $password = password_hash($password, PASSWORD_BCRYPT); // hashed password

    // data section - page 2
    $user_designation = $request['user_designation'];
    $user_group = $request['user_group'];
    $treatment_site = $request['treatment_site'];
    $permissions = $request['permissions'] ?? [];
    if (!empty($permissions)) {
        $permissions = array_merge(...array_values($permissions));
        $permissions = array_map('intval', $permissions);
    } else {
        $permissions = [];
    }

    // data section - page 3
    $address = $request['address'];
    $address_state = $request['address_state'];
    $address_city = $request['address_city'];
    $address_pin = $request['address_pin'];
    $phone = $request['phone'];
    $whatsapp_no = $request['whatsapp_no'];
    $alt_phone = $request['alt_phone'];

    // data section - page 4
    $twitter_url = $request['twitter_url'];
    $facebook_url = $request['facebook_url'];
    $instagram_url = $request['instagram_url'];
    $linkedin_url = $request['linkedin_url'];

    // data section - page 4
    $remarks = $request['remarks'];
    $updated_by = getIdFromUserid($request['updated_by']);

    // file upload section
    $profile_image = upload_file('profile_image');
    $aadhaar_file = upload_file('aadhaar_file');
    $pan_file = upload_file('pan_file');

    // upload profile image
    if ($profile_image['status'] === 'success') {
        $profile_image_url = $profile_image['file_name'];
    } else if ($profile_image['err_code'] == 'FILE_NOT_SELECTED') {
        $profile_image_url = '';
    } else {
        $profile_image_url = '';
        return ['status' => 'failed', 'message' => $profile_image['message']];
    }

    // upload aadhaar image
    if ($aadhaar_file['status'] === 'success') {
        $aadhaar_file_url = $aadhaar_file['file_name'];
    } else if ($aadhaar_file['err_code'] == 'FILE_NOT_SELECTED') {
        $aadhaar_file_url = '';
    }  else {
        $aadhaar_file_url = '';
        return ['status' => 'failed', 'message' => $aadhaar_file['message']];
    }

    // upload pan image
    if ($pan_file['status'] === 'success') {
        $pan_file_url = $pan_file['file_name'];
    } else if ($pan_file['err_code'] == 'FILE_NOT_SELECTED') {
        $pan_file_url = '';
    } else {
        $pan_file_url = '';
        return ['status' => 'failed', 'message' => $pan_file['message']];
    }

    $response = [];

    $table = "users";
    $columns_values = [
        "first_name" => $first_name,
        "last_name" => $last_name,
        "aadhaar_no" => $aadhaar_no,
        "pan_no" => $pan_no,
        "userid" => $userid,
        "password" => $password,
        "email" => $email,
        "user_designation" => $user_designation,
        "user_group" => $user_group,
        "treatment_site" => $treatment_site,
        "address" => $address,
        "address_state" => $address_state,
        "address_city" => $address_city,
        "address_pin" => $address_pin,
        "phone" => $phone,
        "whatsapp_no" => $whatsapp_no,
        "alt_phone" => $alt_phone,
        "twitter_url" => $twitter_url,
        "facebook_url" => $facebook_url,
        "instagram_url" => $instagram_url,
        "linkedin_url" => $linkedin_url,

        'profile_image' => $profile_image_url,
        'aadhaar_image' => $aadhaar_file_url,
        'pan_image' => $pan_file_url,

        "created_by" => $updated_by,
        "updated_by" => $updated_by,
        "remarks" => $remarks,
    ];

    $query = INSERT($table, $columns_values);
    $insertedUserId = runQuery($query, true);

    if ($insertedUserId) {
        // Loop through permission IDs and insert/update user_permissions
        foreach ($permissions as $permission_id) {
            $insertPermQuery = <<<SQL
                INSERT INTO user_permissions (user_id, permission_id, allow, created_by, updated_by)
                VALUES ($insertedUserId, $permission_id, 1, $updated_by, $updated_by)
                ON DUPLICATE KEY UPDATE allow = 1, updated_by = $updated_by, updated_at = CURRENT_TIMESTAMP;
            SQL;
            runQuery($insertPermQuery);
        }

        // Optional: Admin notification or updates
        $update_text = 'Added a new User <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/profile/?userid=' . $userid . '">@' . $userid . ' (' . $first_name . ' ' . $last_name . ')</a> for the organization! Check out, how they have managed to do it! <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/users?id=' . $insertedUserId . '">Check</a>';
        addNewAdminUpdate($updated_by, $update_text);

        $response['status'] = 'success';
        $response['message'] = "Published  @' . $userid . ' (' . $first_name . ' ' . $last_name . ') as a User!";
        $response['id'] = $insertedUserId;
    } else {
        $response['status'] = 'failed';
        $response['message'] = "Unable to publish User!";
    }


    return $response;
}

function update_user($request)
{
    // data section - page 1
    $first_name = $request['first_name'];
    $last_name = $request['last_name'];
    $userid = $request['userid'];


    // data section - page 2
    $user_designation = $request['user_designation'] ?? '';
    $user_group = $request['user_group'] ?? '';
    $treatment_site = $request['treatment_site'] ?? '';
    $permissions = $request['permissions'] ?? [];
    if (!empty($permissions)) {
        $permissions = array_merge(...array_values($permissions));
        $permissions = array_map('intval', $permissions);
    } else {
        $permissions = [];
    }

    // data section - page 3
    $address = $request['address'];
    $address_state = $request['address_state'] ?? '';
    $address_city = $request['address_city'];
    $address_pin = $request['address_pin'];
    $phone = $request['phone'];
    $whatsapp_no = $request['whatsapp_no'];
    $alt_phone = $request['alt_phone'];

    // data section - page 4
    $twitter_url = $request['twitter_url'];
    $facebook_url = $request['facebook_url'];
    $instagram_url = $request['instagram_url'];
    $linkedin_url = $request['linkedin_url'];

    // data section - page 4
    $remarks = $request['remarks'];
    $user_id = (int) $request['id'];
    $updated_by = getIdFromUserid($request['updated_by']);

    // Default to existing values
    $existing = WHERE('users', 'id', $user_id);
    $existing = runQuery($existing);
    $existing = mysqli_fetch_assoc($existing);

    // get existing url
    $profile_image_url = $existing['profile_image'] ?? '';
    $aadhaar_file_url = $existing['aadhaar_image'] ?? '';
    $pan_file_url = $existing['pan_image'] ?? '';

    if (!empty($_FILES['profile_image']['name'])) {
        $profile_image = upload_file('profile_image');
        if ($profile_image['status'] === 'success') {
            $profile_image_url = $profile_image['file_name'];
        } else {
            return ['status' => 'failed', 'message' => $profile_image['message']];
        }
    }

    if (!empty($_FILES['aadhaar_file']['name'])) {
        $aadhaar_file = upload_file('aadhaar_file');
        if ($aadhaar_file['status'] === 'success') {
            $aadhaar_file_url = $aadhaar_file['file_name'];
        } else {
            $aadhaar_file_url = '';
            return ['status' => 'failed', 'message' => $aadhaar_file['message']];
        }
    }

    if (!empty($_FILES['pan_file']['name'])) {
        $pan_file = upload_file('pan_file');
        if ($pan_file['status'] === 'success') {
            $pan_file_url = $pan_file['file_name'];
        } else {
            $pan_file_url = '';
            return ['status' => 'failed', 'message' => $pan_file['message']];
        }
    }

    $response = [];

    $table = "users";
    $columns_values = [
        "first_name" => $first_name,
        "last_name" => $last_name,
        "user_designation" => $user_designation,
        "user_group" => $user_group,
        "treatment_site" => $treatment_site,
        "address" => $address,
        "address_state" => $address_state,
        "address_city" => $address_city,
        "address_pin" => $address_pin,
        "phone" => $phone,
        "whatsapp_no" => $whatsapp_no,
        "alt_phone" => $alt_phone,
        "twitter_url" => $twitter_url,
        "facebook_url" => $facebook_url,
        "instagram_url" => $instagram_url,
        "linkedin_url" => $linkedin_url,

        'profile_image' => $profile_image_url,
        'aadhaar_image' => $aadhaar_file_url,
        'pan_image' => $pan_file_url,

        "created_by" => $updated_by,
        "updated_by" => $updated_by,
        "remarks" => $remarks,
    ];
    $where_conditions = [
        "id" => $user_id
    ];

    $query = UPDATE($table, $columns_values, $where_conditions);
    $run_update_query = runQuery($query);

    if ($user_id) {

        // Remove all old permissions (optional or skip and use UPSERT logic)
        $deleteOld = "DELETE FROM user_permissions WHERE user_id = $user_id";
        runQuery($deleteOld);

        // Insert/update new permissions
        foreach ($permissions as $permission_id) {
            $insertPermQuery = "
            INSERT INTO user_permissions (user_id, permission_id, allow, created_by, updated_by)
            VALUES ($user_id, $permission_id, 1, $updated_by, $updated_by)
            ON DUPLICATE KEY UPDATE allow = 1, updated_by = $updated_by, updated_at = CURRENT_TIMESTAMP;
        ";
            runQuery($insertPermQuery);
        }

        // Optional: Admin notification or updates
        $update_text = 'Updated User <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/profile/?userid=' . $userid . '">@' . $userid . ' (' . $first_name . ' ' . $last_name . ')</a> for the organization! Check out, how they have managed to do it! <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/users?id=' . $user_id . '">Check</a>';
        addNewAdminUpdate($updated_by, $update_text);

        $response['status'] = 'success';
        $response['message'] = "Updated  @" . $userid . " as a User!";
        $response['id'] = $user_id;
    } else {
        $response['status'] = 'failed';
        $response['message'] = "Unable to update User!";
    }


    return $response;
}

function send_user_to_trash($request)
{
    $id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getUserById($id)) > 0) {
        $query = "UPDATE `users` SET `is_active` = 0, `updated_by` = '$updated_by' WHERE `users`.`id` = $id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $user = getUserById($id);
            $user = mysqli_fetch_assoc($user);
            $userid = $user['userid'];
            $first_name = $user['first_name'];
            $last_name = $user['last_name'];
            $full_name = $first_name . ' ' . $last_name;
            $full_name = trim($full_name);

            addNewAdminUpdate($updated_by, 'Trashed User @' . $userid . ' (' . $full_name . ') from the organization!');

            $response['status'] = 'success';
            $response['message'] = "User trashed Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to trash User!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such User Found!";
    }
    return $response;
}

function restore_user_from_trash($request)
{
    $id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getUserById($id)) > 0) {
        $query = "UPDATE `users` SET `is_active` = 1, `updated_by` = '$updated_by' WHERE `users`.`id` = $id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $user = getUserById($id);
            $user = mysqli_fetch_assoc($user);
            $userid = $user['userid'];
            $first_name = $user['first_name'];
            $last_name = $user['last_name'];
            $full_name = $first_name . ' ' . $last_name;
            $full_name = trim($full_name);

            addNewAdminUpdate($updated_by, 'Restored User @' . $userid . ' (' . $full_name . ') from the organization!');

            $response['status'] = 'success';
            $response['message'] = "User restored Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to restore User!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such User Found!";
    }
    return $response;
}

function delete_user($request)
{
    $id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getUserById($id)) > 0) {
        $query = "UPDATE `users` SET `is_deleted` = 1, `updated_by` = '$updated_by' WHERE `users`.`id` = $id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $user = getUserById($id);
            $user = mysqli_fetch_assoc($user);
            $userid = $user['userid'];
            $first_name = $user['first_name'];
            $last_name = $user['last_name'];
            $full_name = $first_name . ' ' . $last_name;
            $full_name = trim($full_name);

            addNewAdminUpdate($updated_by, 'Permanently Deleted User @' . $userid . ' (' . $full_name . ') from the organization!');

            $response['status'] = 'success';
            $response['message'] = "User deleted Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to delete User!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such User Found!";
    }
    return $response;
}

function validate_file_existence($request)
{
    $file_name = trim($request['file_name']);
    $file_loc  = !empty($request['file_loc']) ? trim($request['file_loc'], '/') . '/' : 'uploads/';

    // ✅ Base path is one level above api_func.php
    $base_path = realpath(__DIR__ . '/../');

    // ✅ Absolute file path
    $file_path = $base_path . '/' . $file_loc . $file_name;

    $response = [];

    if (!empty($file_name) && file_exists($file_path)) {
        $response['status']  = 'success';
        $response['message'] = "File Exists! ✅ ($file_path)";
    } else {
        $response['status']  = 'failed';
        $response['message'] = "No such File Exists! ❌ ($file_path)";
    }

    return $response;
}

function file_editor($request)
{
    $updated_by = getIdFromUserid($request['updated_by']);
    $file_path = base64_decode($request['file_path']);
    $file_contents = $request['file_contents'];
    $file_name = $request['file_name'];
    $file_url = $request['file_url'];

    $response = array();

    $put_contents = file_put_contents($file_path, $file_contents);

    if ($put_contents) {

        addNewAdminUpdate($updated_by, 'Updated the <a href="' . $file_url . '" target="_blank">' . $file_name . '</a>! See how they have improved the site\'s SEO!');

        $response['status'] = 'success';
        $response['message'] = "File Updated Successfully!";
    } else {
        $response['status'] = 'failed';
        $response['message'] = "Unable to update File!";
    }

    return $response;
}