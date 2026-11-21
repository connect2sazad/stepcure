<?php

function add_new_site($request)
{

    $site_name = addslashes($request['site_name']);
    $address = $request['address'];
    $address_state = $request['address_state'];
    $address_city = addslashes($request['address_city']);
    $address_pin = addslashes($request['address_pin']);
    $color_code = addslashes($request['color_code']);
    $ref_person_name = addslashes($request['ref_person_name']);
    $ref_person_details = addslashes($request['ref_person_details']);
    $remarks = addslashes($request['remarks']);
    $updated_by = getIdFromUserid($request['updated_by']);


    $state_code = get_state_code($address_state);
    $city_code = get_city_code($address_city);
    $last_site_id = get_last_generated_site_code($state_code);
    $next_site_id = prefix_0($last_site_id + 1);
    $site_id = "SC-$state_code-$city_code-$next_site_id";

    // file upload section
    $site_logo = upload_file('site_logo');

    // upload profile image
    if ($site_logo['status'] === 'success') {
        $site_logo_url = $site_logo['file_name'];
    } else if ($site_logo['err_code'] == 'FILE_NOT_SELECTED') {
        $site_logo_url = '';
    } else {
        $site_logo_url = '';
        return ['status' => 'failed', 'message' => $site_logo['message']];
    }

    // return $site_logo_url;

    $response = array();

    $check_existence = WHERE('sites', 'site_id', $site_id);
    $check_existence = runQuery($check_existence);
    $check_existence = mysqli_num_rows($check_existence);

    if ($check_existence > 0) {
        $response['status'] = 'failed';
        $response['message'] = "Such Site already exists!";
    } else {

        $table = "sites";
        $columns_values = [
            "site_id" => $site_id,
            "site_name" => $site_name,
            "address" => $address,
            "address_state" => $address_state,
            "address_city" => $address_city,
            "address_pin" => $address_pin,
            "color_code" => $color_code,
            "ref_person_name" => $ref_person_name,
            "ref_person_details" => $ref_person_details,
            "site_logo" => $site_logo_url,
            "remarks" => $remarks,
            "created_by" => $updated_by,
            "updated_by" => $updated_by,
        ];

        $query = INSERT($table, $columns_values);

        $run_query = runQuery($query);


        if ($run_query == 1) {

            $query2 = UPDATE('address_states', [
                'last_id' => $next_site_id
            ], [
                'state_code' =>  $state_code
            ]);

            $run_query2 = runQuery($query2);

            $query3 = WHERE('sites', 'site_id', $site_id);
            $run_query3 = runQuery($query3);
            $fetch3 = mysqli_fetch_assoc($run_query3);

            $update_text = 'Added a new site ' . $site_name . ' for the organization! Check out, how they have managed to do it! <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/treatment-sites?id=' . $fetch3['id'] . '">Check</a>';
            $admin_update = addNewAdminUpdate($updated_by, $update_text);

            $response['status'] = 'success';
            $response['message'] = "Published '$site_name' as a Site!";
            $response['id'] = $fetch3['id'];
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to publish Site!";
        }
    }

    return $response;
}

function update_site($request)
{
    $site_name = addslashes($request['site_name']);
    $address = addslashes($request['address']);
    $address_pin = addslashes($request['address_pin']);
    $color_code = $request['color_code'];
    $ref_person_name = addslashes($request['ref_person_name']);
    $ref_person_details = addslashes($request['ref_person_details']);
    $remarks = addslashes($request['remarks']);

    $updated_by = getIdFromUserid($request['updated_by']);

    $id = $request['id'];

    // Default to existing values
    $existing = WHERE('sites', 'id', $id);
    $existing = runQuery($existing);
    $existing = mysqli_fetch_assoc($existing);

    // get existing url
    $site_logo_url = $existing['site_logo'] ?? '';

    // check if site_logo is empty during site update
    if (!empty($_FILES['site_logo']['name'])) {
        $site_logo = upload_file('site_logo');
        if ($site_logo['status'] === 'success') {
            $site_logo_url = $site_logo['file_name'];
        } else {
            return ['status' => 'failed', 'message' => $site_logo['message']];
        }
    }

    $response = array();

    $check_existence = getSiteById($id);

    if (mysqli_num_rows($check_existence) > 0) {

        $columns_values = [
            "site_name" => $site_name,
            "address" => $address,
            "address_pin" => $address_pin,
            "color_code" => $color_code,
            "ref_person_name" => $ref_person_name,
            "ref_person_details" => $ref_person_details,
            "site_logo" => $site_logo_url,
            "remarks" => $remarks,
            "updated_by" => $updated_by
        ];

        $where_conditions = [
            "id" => $id
        ];

        $query = UPDATE('sites', $columns_values, $where_conditions);


        $run_query = runQuery($query);

        if ($run_query == 1) {

            addNewAdminUpdate($updated_by, 'Updated details for the site "' . $site_name . '". <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/treatment-sites/?id=' . $id . '">View all details</a>!');

            $response['status'] = 'success';
            $response['message'] = "Site updated Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to update Site!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Site Found!";
    }

    return $response;
}

function send_site_to_trash($request)
{
    $site_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getSiteById($site_id)) > 0) {
        $query = "UPDATE `sites` SET `is_active` = 0, `updated_by` = '$updated_by' WHERE `sites`.`id` = $site_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $site = getSiteById($site_id);
            $site = mysqli_fetch_assoc($site);
            $site_name = $site['site_name'];

            addNewAdminUpdate($updated_by, 'Trashed "' . $site_name . '" Site!');

            $response['status'] = 'success';
            $response['message'] = "Site trashed Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to trash Site!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Site Found!";
    }
    return $response;
}

function restore_site_from_trash($request)
{
    $site_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getSiteById($site_id)) > 0) {
        $query = "UPDATE `sites` SET `is_active` = 1, `updated_by` = '$updated_by' WHERE `sites`.`id` = $site_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $site = getSiteById($site_id);
            $site = mysqli_fetch_assoc($site);
            $site_name = $site['site_name'];

            addNewAdminUpdate($updated_by, 'Restored "' . $site_name . '" Site!');

            $response['status'] = 'success';
            $response['message'] = "Site restored Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to restore Site!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Site Found!";
    }
    return $response;
}

function delete_site($request)
{
    $site_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getSiteById($site_id)) > 0) {
        $query = "UPDATE `sites` SET `is_deleted` = 1, `updated_by` = '$updated_by' WHERE `sites`.`id` = $site_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $site = getSiteById($site_id);
            $site = mysqli_fetch_assoc($site);
            $site_name = $site['site_name'];

            addNewAdminUpdate($updated_by, 'Permanently Deleted "' . $site_name . '" Site for the site!');

            $response['status'] = 'success';
            $response['message'] = "Site deleted Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to delete Site!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Site Found!";
    }
    return $response;
}

function add_new_user_group($request)
{
    $permissions = $request['permissions'];
    $permissions = array_merge(...array_values($permissions));
    $permissions = array_map('intval', $permissions);

    $group_name = addslashes($request['group_name']);
    $color_code = addslashes($request['color_code']);
    $remarks = addslashes($request['remarks']);

    $updated_by = getIdFromUserid($request['updated_by']);
    $created_by = $updated_by;

    $response = [];

    // Insert into user_groups table
    $table = "user_groups";
    $columns_values = [
        "group_name" => $group_name,
        "color_code" => $color_code,
        "remarks" => $remarks,
        "created_by" => $created_by,
        "updated_by" => $updated_by,
    ];

    $query = INSERT($table, $columns_values);
    $insertedGroupId = runQuery($query, true); // true returns last insert ID

    if ($insertedGroupId) {
        // Loop through permission IDs and insert/update group_permissions
        foreach ($permissions as $permission_id) {
            $insertPermQuery = <<<SQL
                INSERT INTO group_permissions (group_id, permission_id, allow, created_by, updated_by)
                VALUES ($insertedGroupId, $permission_id, 1, $created_by, $updated_by)
                ON DUPLICATE KEY UPDATE allow = 1, updated_by = $updated_by, updated_at = CURRENT_TIMESTAMP;
            SQL;
            runQuery($insertPermQuery);
        }

        // Optional: Admin notification or updates
        $update_text = 'Added a new User Group ' . $group_name . ' for the organization! Check out, how they have managed to do it! <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/user-groups?id=' . $insertedGroupId . '">Check</a>';
        addNewAdminUpdate($updated_by, $update_text);

        $response['status'] = 'success';
        $response['message'] = "Published '$group_name' as a User Group!";
        $response['id'] = $insertedGroupId;
    } else {
        $response['status'] = 'failed';
        $response['message'] = "Unable to publish User Group!";
    }

    return $response;
}

function update_user_group($request)
{
    $permissions = $request['permissions'];
    $permissions = array_merge(...array_values($permissions));
    $permissions = array_map('intval', $permissions);

    $users_in_user_group_old = addslashes($request['users_in_user_group_old']);
    $users_in_user_group = addslashes($request['users_in_user_group']);

    $group_name = addslashes($request['group_name']);
    $color_code = addslashes($request['color_code']);
    $remarks = addslashes($request['remarks']);

    $updated_by = getIdFromUserid($request['updated_by']);
    $group_id = (int) $request['id'];

    $response = [];

    // Check if group exists
    $check_existence = getUserGroupById($group_id); // make sure you have this function
    if (mysqli_num_rows($check_existence) === 0) {
        $response['status'] = 'failed';
        $response['message'] = "No such User Group found!";
        return $response;
    }

    // Update user_groups table
    $table = "user_groups";
    $columns_values = [
        "group_name" => $group_name,
        "color_code" => $color_code,
        "remarks" => $remarks,
        "updated_by" => $updated_by
    ];
    $where_conditions = [
        "id" => $group_id
    ];

    $query = UPDATE($table, $columns_values, $where_conditions);
    $run_query = runQuery($query);

    // Remove all old permissions (optional or skip and use UPSERT logic)
    $deleteOld = "DELETE FROM group_permissions WHERE group_id = $group_id";
    runQuery($deleteOld);

    // Insert/update new permissions
    foreach ($permissions as $permission_id) {
        $insertPermQuery = "
            INSERT INTO group_permissions (group_id, permission_id, allow, created_by, updated_by)
            VALUES ($group_id, $permission_id, 1, $updated_by, $updated_by)
            ON DUPLICATE KEY UPDATE allow = 1, updated_by = $updated_by, updated_at = CURRENT_TIMESTAMP;
        ";
        runQuery($insertPermQuery);
    }

    // update User Group of the Users with new User Group
    if (!empty($users_in_user_group)) {
        $user_ids_array = array_map('intval', explode(',', $users_in_user_group_old));
        $user_ids_string = implode(',', $user_ids_array);
        $assignGroupQuery = "UPDATE users SET user_group = NULL WHERE id IN ($user_ids_string)";
        runQuery($assignGroupQuery);
    }

    // update User Group of the Users with new User Group
    if (!empty($users_in_user_group)) {
        $user_ids_array = array_map('intval', explode(',', $users_in_user_group));
        $user_ids_string = implode(',', $user_ids_array);
        $assignGroupQuery = "UPDATE users SET user_group = $group_id WHERE id IN ($user_ids_string)";
        runQuery($assignGroupQuery);
    }

    // Optional: Admin notification
    $update_text = "Updated User Group <b>$group_name</b> successfully. <a target=\"_blank\" href=\"" . systemVariable('SITE_HOME') . "admin/user-groups?id=$group_id\">View</a>";
    addNewAdminUpdate($updated_by, $update_text);

    $response['status'] = 'success';
    $response['message'] = "User Group '$group_name' updated successfully!";
    $response['id'] = $group_id;

    return $response;
}

function send_user_group_to_trash($request)
{
    $user_group_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getUserGroupById($user_group_id)) > 0) {
        $query = "UPDATE `user_groups` SET `is_active` = 0, `updated_by` = '$updated_by' WHERE `user_groups`.`id` = $user_group_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $user_group = getUserGroupById($user_group_id);
            $user_group = mysqli_fetch_assoc($user_group);
            $user_group_name = $user_group['group_name'];

            addNewAdminUpdate($updated_by, 'Trashed "' . $user_group_name . '" User Group!');

            $response['status'] = 'success';
            $response['message'] = "User Group trashed Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to trash User Group!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such User Group Found!";
    }
    return $response;
}

function restore_user_group_from_trash($request)
{
    $user_group_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getUserGroupById($user_group_id)) > 0) {
        $query = "UPDATE `user_groups` SET `is_active` = 1, `updated_by` = '$updated_by' WHERE `user_groups`.`id` = $user_group_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $user_group = getUserGroupById($user_group_id);
            $user_group = mysqli_fetch_assoc($user_group);
            $user_group_name = $user_group['group_name'];

            addNewAdminUpdate($updated_by, 'Restored "' . $user_group_name . '" User Group!');

            $response['status'] = 'success';
            $response['message'] = "User Group restored Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to restore User Group!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such User Group Found!";
    }
    return $response;
}

function delete_user_group($request)
{
    $user_group_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getUserGroupById($user_group_id)) > 0) {
        $query = "UPDATE `user_groups` SET `is_deleted` = 1, `updated_by` = '$updated_by' WHERE `user_groups`.`id` = $user_group_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $user_group = getUserGroupById($user_group_id);
            $user_group = mysqli_fetch_assoc($user_group);
            $user_group_name = $user_group['group_name'];

            addNewAdminUpdate($updated_by, 'Permanently Deleted "' . $user_group_name . '" User Group!');

            $response['status'] = 'success';
            $response['message'] = "User Group deleted Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to delete UserGroup!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such User Group Found!";
    }
    return $response;
}


function add_new_user_designation($request)
{

    $designation_name = addslashes($request['designation_name']);
    $default_honorifics = addslashes($request['default_honorifics']);
    $default_user_group = addslashes($request['default_user_group']);
    $color_code = $request['color_code'];
    $is_consultant = isset($request['is_consultant']) ? 1 : 0;
    $remarks = addslashes($request['remarks']);

    $updated_by = getIdFromUserid($request['updated_by']);

    $response = array();


    $table = "user_designations";
    $columns_values = [
        "designation_name" => $designation_name,
        "default_honorifics" => $default_honorifics,
        "default_user_group" => $default_user_group,
        "color_code" => $color_code,
        "remarks" => $remarks,
        "is_consultant" => $is_consultant,
        "created_by" => $updated_by,
        "updated_by" => $updated_by,
    ];

    $query = INSERT($table, $columns_values);

    $run_query = runQuery($query, true);

    if ($run_query != 0) {

        $query = WHERE('user_designations', 'id', $run_query);
        $run_query = runQuery($query);
        $fetch = mysqli_fetch_assoc($run_query);

        $update_text = 'Added a new User Designation ' . $designation_name . ' for the organization! Check out, how they have managed to do it! <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/user-designations?id=' . $fetch['id'] . '">Check</a>';
        $admin_update = addNewAdminUpdate($updated_by, $update_text);

        $response['status'] = 'success';
        $response['message'] = "Published '$designation_name' as a User Designation!";
        $response['id'] = $fetch['id'];
    } else {
        $response['status'] = 'failed';
        $response['message'] = "Unable to publish User Designation!";
    }

    return $response;
}

function update_user_designation($request)
{
    $designation_name = addslashes($request['designation_name']);
    $default_honorifics = addslashes($request['default_honorifics']);
    $default_user_group = addslashes($request['default_user_group']);
    $color_code = $request['color_code'];
    $is_consultant = isset($request['is_consultant']) ? 1 : 0;
    $remarks = addslashes($request['remarks']);

    $updated_by = getIdFromUserid($request['updated_by']);

    $id = $request['id'];

    $response = array();

    $check_existence = getSiteById($id);

    if (mysqli_num_rows($check_existence) > 0) {

        $columns_values = [
            "designation_name" => $designation_name,
            "default_honorifics" => $default_honorifics,
            "default_user_group" => $default_user_group,
            "color_code" => $color_code,
            "is_consultant" => $is_consultant,
            "remarks" => $remarks,
            "updated_by" => $updated_by
        ];

        $where_conditions = [
            "id" => $id
        ];

        $query = UPDATE('user_designations', $columns_values, $where_conditions);


        $run_query = runQuery($query);

        if ($run_query == 1) {

            addNewAdminUpdate($updated_by, 'Updated details for User Designation "' . $designation_name . '". <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/user-designations/?id=' . $id . '">View all details</a>!');

            $response['status'] = 'success';
            $response['message'] = "User Designation updated Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to update User Designation!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such User Designation Found!";
    }

    return $response;
}

function send_user_designation_to_trash($request)
{
    $id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getUserDesignationById($id)) > 0) {
        $query = "UPDATE `user_designations` SET `is_active` = 0, `updated_by` = '$updated_by' WHERE `user_designations`.`id` = $id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $user_designation = getUserDesignationById($id);
            $user_designation = mysqli_fetch_assoc($user_designation);
            $user_designation_name = $user_designation['designation_name'];

            addNewAdminUpdate($updated_by, 'Trashed "' . $user_designation_name . '" User Designation!');

            $response['status'] = 'success';
            $response['message'] = "User Designation trashed Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to trash User Designation!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such User Designation Found!";
    }
    return $response;
}

function restore_user_designation_from_trash($request)
{
    $id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getUserDesignationById($id)) > 0) {
        $query = "UPDATE `user_designations` SET `is_active` = 1, `updated_by` = '$updated_by' WHERE `user_designations`.`id` = $id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $user_designation = getUserDesignationById($id);
            $user_designation = mysqli_fetch_assoc($user_designation);
            $user_designation_name = $user_designation['designation_name'];

            addNewAdminUpdate($updated_by, 'Restored "' . $user_designation_name . '" User Designation!');

            $response['status'] = 'success';
            $response['message'] = "User Designation restored Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to restore User Designation!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such User Designation Found!";
    }
    return $response;
}

function delete_user_designation($request)
{
    $id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getUserDesignationById($id)) > 0) {
        $query = "UPDATE `user_designations` SET `is_deleted` = 1, `updated_by` = '$updated_by' WHERE `user_designations`.`id` = $id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $user_designation = getUserDesignationById($id);
            $user_designation = mysqli_fetch_assoc($user_designation);
            $user_designation_name = $user_designation['designation_name'];

            addNewAdminUpdate($updated_by, 'Permanently Deleted "' . $user_designation_name . '" User Designation for the organization!');

            $response['status'] = 'success';
            $response['message'] = "User Designation deleted Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to delete User Designation!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such User Designation Found!";
    }
    return $response;
}

function send_patient_to_trash($request)
{
    $patient_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getPatientById($patient_id)) > 0) {
        $query = "UPDATE `patients` SET `is_active` = 0, `updated_by` = '$updated_by' WHERE `patients`.`id` = $patient_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $patient = getPatientById($patient_id);
            $patient = mysqli_fetch_assoc($patient);
            $patient_name = $patient['first_name'] . ' ' . $patient['last_name'];

            addNewAdminUpdate($updated_by, 'Trashed Patient "' . $patient_name . '"!');

            $response['status'] = 'success';
            $response['message'] = "Patient trashed Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to trash Patient!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Patient Found!";
    }
    return $response;
}

function restore_patient_from_trash($request)
{
    $patient_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getPatientById($patient_id)) > 0) {
        $query = "UPDATE `patients` SET `is_active` = 1, `updated_by` = '$updated_by' WHERE `patients`.`id` = $patient_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $patient = getPatientById($patient_id);
            $patient = mysqli_fetch_assoc($patient);
            $patient_name = $patient['first_name'] . ' ' . $patient['last_name'];

            addNewAdminUpdate($updated_by, 'Restored Patient "' . $patient_name . '"!');

            $response['status'] = 'success';
            $response['message'] = "Patient restored Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to restore Patient!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Patient Found!";
    }
    return $response;
}

function delete_patient($request)
{
    $patient_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getPatientById($patient_id)) > 0) {
        $query = "UPDATE `patients` SET `is_deleted` = 1, `updated_by` = '$updated_by' WHERE `patients`.`id` = $patient_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $patient = getPatientById($patient_id);
            $patient = mysqli_fetch_assoc($patient);
            $patient_name = $patient['first_name'] . ' ' . $patient['last_name'];

            addNewAdminUpdate($updated_by, 'Permanently Deleted Patient "' . $patient_name . '" !');

            $response['status'] = 'success';
            $response['message'] = "Patient deleted Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to delete Patient!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Patient Found!";
    }
    return $response;
}

function add_new_patient($request)
{

    $uhid = addslashes($request['uhid']) ?? '';
    $first_name = addslashes($request['first_name']);
    $last_name = addslashes($request['last_name']) ?? '';
    $gender = addslashes($request['gender']);
    $age = addslashes($request['age']) ?? '';
    $address = $request['address'];
    $address_state = $request['address_state'];
    $address_city = addslashes($request['address_city']);
    $address_pin = addslashes($request['address_pin']);
    $email = addslashes($request['email']);
    $phone = addslashes($request['phone']);
    $whatsapp_no = addslashes($request['whatsapp_no']);
    $alt_phone = addslashes($request['alt_phone']);
    $height = addslashes($request['height']);
    $weight = addslashes($request['weight']);
    $is_diabetic = isset($request['is_diabetic']) ? 1 : 0;
    $diabetic_years = addslashes($request['diabetic_years']);
    $diabetic_value = addslashes($request['diabetic_value']);
    $diabetic_level = addslashes($request['diabetic_level']);
    $is_inherited = isset($request['is_inherited']) ? 1 : 0;
    $is_foot_examination_done = isset($request['is_foot_examination_done']) ? 1 : 0;

    $remarks = addslashes($request['remarks']);
    $updated_by = getIdFromUserid($request['updated_by']);

    $response = array();

    $check_existence = WHERE('patients', 'uhid', $uhid);
    $check_existence = runQuery($check_existence);
    $check_existence = mysqli_num_rows($check_existence);

    if ($check_existence > 0) {
        $response['status'] = 'failed';
        $response['message'] = "Such Patient with same UHID already exists!";
    } else {

        // generate patientid for public view
        $patientid = nextId('patients', 'patientid');

        $table = "patients";
        $columns_values = [
            "patientid" => $patientid,
            "uhid" => $uhid,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "gender" => $gender,
            "age" => $age,
            "address" => $address,
            "address_state" => $address_state,
            "address_city" => $address_city,
            "address_pin" => $address_pin,
            "email" => $email,
            "phone" => $phone,
            "whatsapp_no" => $whatsapp_no,
            "alt_phone" => $alt_phone,
            "height" => $height,
            "weight" => $weight,
            "is_diabetic" => $is_diabetic,
            "diabetic_years" => $diabetic_years,
            "diabetic_value" => $diabetic_value,
            "diabetic_level" => $diabetic_level,
            "is_inherited" => $is_inherited,
            "is_foot_examination_done" => $is_foot_examination_done,
            "remarks" => $remarks,
            "created_by" => $updated_by,
            "updated_by" => $updated_by,
        ];

        $query = INSERT($table, $columns_values);

        $inserted_patient_id = runQuery($query, true);


        if ($inserted_patient_id) {

            $update_text = 'Added a new patient ' . $first_name . ' ' . $last_name . ' for the organization! Check out, how they have managed to do it! <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/patients?id=' . $inserted_patient_id . '">Check</a>';
            $admin_update = addNewAdminUpdate($updated_by, $update_text);

            $response['status'] = 'success';
            $response['message'] = "Published " . $first_name . " " . $last_name . " as a Patient!";
            $response['id'] = $inserted_patient_id;
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to publish Patient!";
        }
    }

    return $response;
}

function update_patient($request)
{
    $first_name = addslashes($request['first_name']);
    $last_name = addslashes($request['last_name']) ?? '';
    $gender = addslashes($request['gender']);
    $age = addslashes($request['age']) ?? '';
    $address = $request['address'];
    $address_state = $request['address_state'];
    $address_city = addslashes($request['address_city']);
    $address_pin = addslashes($request['address_pin']);
    $email = addslashes($request['email']);
    $phone = addslashes($request['phone']);
    $whatsapp_no = addslashes($request['whatsapp_no']);
    $alt_phone = addslashes($request['alt_phone']);
    $height = addslashes($request['height']);
    $weight = addslashes($request['weight']);
    $is_diabetic = isset($request['is_diabetic']) ? 1 : 0;
    $diabetic_years = addslashes($request['diabetic_years']);
    $diabetic_value = addslashes($request['diabetic_value']);
    $diabetic_level = addslashes($request['diabetic_level']);
    $is_inherited = isset($request['is_inherited']) ? 1 : 0;
    $is_foot_examination_done = isset($request['is_foot_examination_done']) ? 1 : 0;

    $remarks = addslashes($request['remarks']);;
    $updated_by = getIdFromUserid($request['updated_by']);

    $id = $request['id'];

    $response = array();

    $check_existence = getPatientById($id);

    if (mysqli_num_rows($check_existence) > 0) {

        $columns_values = [
            "first_name" => $first_name,
            "last_name" => $last_name,
            "gender" => $gender,
            "age" => $age,
            "address" => $address,
            "address_state" => $address_state,
            "address_city" => $address_city,
            "address_pin" => $address_pin,
            "email" => $email,
            "phone" => $phone,
            "whatsapp_no" => $whatsapp_no,
            "alt_phone" => $alt_phone,
            "height" => $height,
            "weight" => $weight,
            "is_diabetic" => $is_diabetic,
            "diabetic_years" => $diabetic_years,
            "diabetic_value" => $diabetic_value,
            "diabetic_level" => $diabetic_level,
            "is_inherited" => $is_inherited,
            "is_foot_examination_done" => $is_foot_examination_done,
            "remarks" => $remarks,
            "created_by" => $updated_by,
            "updated_by" => $updated_by,
        ];

        $where_conditions = [
            "id" => $id
        ];

        $query = UPDATE('patients', $columns_values, $where_conditions);


        $run_query = runQuery($query);

        if ($run_query == 1) {

            addNewAdminUpdate($updated_by, 'Updated details for the patient "' . $first_name . " " . $last_name . '". <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/patients/?id=' . $id . '">View all details</a>!');

            $response['status'] = 'success';
            $response['message'] = "Patient updated Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to update Patient!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Patient Found!";
    }

    return $response;
}

function add_new_consultation($request)
{

    $site_id = addslashes($request['site_id']) ?? '';
    $patient_id = addslashes($request['patient_id']);
    $user_id = addslashes($request['user_id']) ?? '';
    $recomended_by_user_id = addslashes($request['recomended_by_user_id']) ?? '';

    $remarks = addslashes($request['remarks']) ?? '';
    $created_by = getIdFromUserid($request['created_by']) ?? '';

    // get patient details
    $patient = getPatientById($patient_id);
    $patient = mysqli_fetch_assoc($patient);
    $patient_first_name = $patient['first_name'];
    $patient_last_name = $patient['last_name'];
    $patient_patientid = "PI-" . prefix_00($patient['patientid']);
    $patient_uhid = $patient['uhid'];

    $patient_display_name = $patient_patientid . " - " . $patient_first_name . " " . $patient_last_name . " (UHID: " . $patient_uhid . ")";

    // get user details
    $user = getUserById($user_id);
    $user = mysqli_fetch_assoc($user);
    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $userid = $user['userid'];

    // get user designation for honorifics
    $user_designation = $user['user_designation'];
    $user_designation = getUserDesignationById($user_designation);
    $user_designation = mysqli_fetch_assoc($user_designation);
    $user_designation = $user_designation['default_honorifics'];

    $user_display_name = $user_designation . " " . $first_name . " " . $last_name . " (@" . $userid . ")";

    $table = "consultations";

    $consultationid = nextId($table, 'consultationid');

    $columns_values = [
        "consultationid" => $consultationid,
        "site_id" => $site_id,
        "patient_id" => $patient_id,
        "user_id" => $user_id,
        "recomended_by_user_id" => $recomended_by_user_id,

        "remarks" => $remarks,
        "created_by" => $created_by,
        "updated_by" => $user_id,
    ];

    $query = INSERT($table, $columns_values);

    $inserted_patient_id = runQuery($query, true);


    if ($inserted_patient_id) {

        $update_text = 'Added Consultation (CI-' . prefix_00($consultationid) . ') for ' . $patient_display_name . " with " . $user_display_name;
        $admin_update = addNewAdminUpdate($created_by, $update_text);

        // notify fucntion to notify the consultant for new

        $response['status'] = 'success';
        $response['message'] = "Published Consultation successfully!";
        $response['id'] = $inserted_patient_id;
    } else {
        $response['status'] = 'failed';
        $response['message'] = "Unable to publish Patient!";
    }

    return $response;
}

function update_consultation($request)
{
    $id = $request['id'];

    // get existing details

    $prior_issues = $request['prior_issues'] ?? [];
    $prior_issues = implode(',', $prior_issues);

    $is_report_finalized = $request['is_report_finalized'] ? 1 : 0;

    // 3d scan parameters
    $scan_3d_parameter = isset($request['scan_3d_parameter']) ? 1 : 0;
    $scan_3d_left_foot_type = $request['scan_3d_left_foot_type'];
    $scan_3d_right_foot_type = $request['scan_3d_right_foot_type'];
    $scan_3d_left_arch_type = $request['scan_3d_left_arch_type'];
    $scan_3d_right_arch_type = $request['scan_3d_right_arch_type'];
    $scan_3d_left_heel_angle = $request['scan_3d_left_heel_angle'];
    $scan_3d_right_heel_angle = $request['scan_3d_right_heel_angle'];

    // planter pressure scan parameters
    $scan_planter_pressure_parameters = isset($request['scan_planter_pressure_parameters']) ? 1 : 0;
    $scan_planter_pressure_left_morpho_type = $request['scan_planter_pressure_left_morpho_type'];
    $scan_planter_pressure_right_morpho_type = $request['scan_planter_pressure_right_morpho_type'];
    $scan_planter_pressure_left_max_pressure = $request['scan_planter_pressure_left_max_pressure'];
    $scan_planter_pressure_right_max_pressure = $request['scan_planter_pressure_right_max_pressure'];

    // ankle brachial index
    $ankle_brachial_index = isset($request['ankle_brachial_index']) ? 1 : 0;
    $ankle_brachial_left_dorsalis_pedis = $request['ankle_brachial_left_dorsalis_pedis'];
    $ankle_brachial_right_dorsalis_pedis = $request['ankle_brachial_right_dorsalis_pedis'];
    $ankle_brachial_left_arm_ap = $request['ankle_brachial_left_arm_ap'];
    $ankle_brachial_right_arm_ap = $request['ankle_brachial_right_arm_ap'];

    // Analysis
    $summary_report = $request['summary_report'];
    $prescriptions = $request['prescriptions'];
    $remarks = addslashes($request['remarks']);

    $updated_by = getIdFromUserid($request['updated_by']);

    $response = array();

    $check_existence = getConsultationById($id);


    if (mysqli_num_rows($check_existence) > 0) {

        // check if form/report is already finalized!!
        $check_existence = mysqli_fetch_assoc($check_existence);
        if ($check_existence['is_report_finalized']) {
            $response['status'] = 'failed';
            $response['message'] = "The consultation report has already been finalized!";
            return $response;
        }

        $columns_values = [
            "prior_issues" => $prior_issues,
            "is_report_finalized" => $is_report_finalized,

            // 3d scan
            "scan_3d_parameter" => $scan_3d_parameter,
            "scan_3d_left_foot_type" => $scan_3d_left_foot_type,
            "scan_3d_right_foot_type" => $scan_3d_right_foot_type,
            "scan_3d_left_arch_type" => $scan_3d_left_arch_type,
            "scan_3d_right_arch_type" => $scan_3d_right_arch_type,
            "scan_3d_left_heel_angle" => $scan_3d_left_heel_angle,
            "scan_3d_right_heel_angle" => $scan_3d_right_heel_angle,

            // planter pressure
            "scan_planter_pressure_parameters" => $scan_planter_pressure_parameters,
            "scan_planter_pressure_left_morpho_type" => $scan_planter_pressure_left_morpho_type,
            "scan_planter_pressure_right_morpho_type" => $scan_planter_pressure_right_morpho_type,
            "scan_planter_pressure_left_max_pressure" => $scan_planter_pressure_left_max_pressure,
            "scan_planter_pressure_right_max_pressure" => $scan_planter_pressure_right_max_pressure,

            // ankle brachial index
            "ankle_brachial_index" => $ankle_brachial_index,
            "ankle_brachial_left_dorsalis_pedis" => $ankle_brachial_left_dorsalis_pedis,
            "ankle_brachial_right_dorsalis_pedis" => $ankle_brachial_right_dorsalis_pedis,
            "ankle_brachial_left_arm_ap" => $ankle_brachial_left_arm_ap,
            "ankle_brachial_right_arm_ap" => $ankle_brachial_right_arm_ap,

            // analysis
            "summary_report" => $summary_report,
            "prescriptions" => $prescriptions,

            "remarks" => $remarks,
            "updated_by" => $updated_by
        ];

        $where_conditions = [
            "id" => $id
        ];

        $query = UPDATE('consultations', $columns_values, $where_conditions);


        $run_query = runQuery($query);

        if ($run_query == 1) {

            $response['status'] = 'success';
            $response['message'] = "Consultation updated Successfully!";

            if ($is_report_finalized) {

                // check_existence is used to get data of current consultation id
                $consultationid = "CI-" . prefix_00($check_existence['consultationid']);

                // Build generic HTML prepareReportData takes consultation id
                $html = buildFootAnalysisReportPDFFromHtml(prepareReportData($id));

                // // Generate PDF and save
                $pdf_name = date('Ymdhis') . "_" . $consultationid . ".pdf";
                $pdf_path = generatePDF($html, $pdf_name, __DIR__ . "/../system_generated");

                // // Store the PDF link in response
                $response['pdf_link'] = $pdf_name;

                // update the report file link
                $query2 = UPDATE('consultations', ['report_file' => $pdf_name], $where_conditions);
                $run_query = runQuery($query2);

                addNewAdminUpdate($updated_by, 'Consultation Details: <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/consultations/?id=' . $id . '">View all details</a>! <a target="_blank" href="' . systemVariable('SITE_HOME') . 'system_generated/' . $pdf_name . '">View Finalized Report</a>!');
                $response['status'] = 'success';
                $response['message'] = "Report generated Successfully!";
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to update Consultation!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Consultation Found!";
    }

    return $response;
}

function send_consultation_to_trash($request)
{
    $consultation_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getConsultationById($consultation_id)) > 0) {
        $query = "UPDATE `consultations` SET `is_active` = 0, `updated_by` = '$updated_by' WHERE `consultations`.`id` = $consultation_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $consultation = getConsultationById($consultation_id);
            $consultation = mysqli_fetch_assoc($consultation);
            $consultation_name = "CI-" . prefix_00($consultation['consultationid']);

            addNewAdminUpdate($updated_by, 'Trashed Consultation "' . $consultation_name . '"!');

            $response['status'] = 'success';
            $response['message'] = "Consultation trashed Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to trash Consultation!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Consultation Found!";
    }
    return $response;
}

function restore_consultation_from_trash($request)
{
    $consultation_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getConsultationById($consultation_id)) > 0) {
        $query = "UPDATE `consultations` SET `is_active` = 1, `updated_by` = '$updated_by' WHERE `consultations`.`id` = $consultation_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $consultation = getConsultationById($consultation_id);
            $consultation = mysqli_fetch_assoc($consultation);
            $consultation_name = "CI-" . prefix_00($consultation['consultationid']);

            addNewAdminUpdate($updated_by, 'Restored Consultation "' . $consultation_name . '"!');

            $response['status'] = 'success';
            $response['message'] = "Consultation restored Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to restore Consultation!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Consultation Found!";
    }
    return $response;
}

function delete_consultation($request)
{
    $consultation_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getConsultationById($consultation_id)) > 0) {
        $query = "UPDATE `consultations` SET `is_deleted` = 1, `updated_by` = '$updated_by' WHERE `consultations`.`id` = $consultation_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $consultation = getConsultationById($consultation_id);
            $consultation = mysqli_fetch_assoc($consultation);
            $consultation_name = "CI-" . prefix_00($consultation['consultationid']);

            addNewAdminUpdate($updated_by, 'Permanently Deleted Consultation "' . $consultation_name . '" !');

            $response['status'] = 'success';
            $response['message'] = "Consultation deleted Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to delete Consultation!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Consultation Found!";
    }
    return $response;
}


function add_new_product_category($request)
{

    $category_name = addslashes($request['category_name']);
    $slug = addslashes($request['slug']);
    $color_code = addslashes($request['color_code']);
    $remarks = addslashes($request['remarks']);
    $updated_by = getIdFromUserid($request['updated_by']);

    // file upload section
    $category_image = upload_file('category_image');

    // upload profile image
    if ($category_image['status'] === 'success') {
        $category_image_url = $category_image['file_name'];
    } else if ($category_image['err_code'] == 'FILE_NOT_SELECTED') {
        $category_image_url = '';
    } else {
        $category_image_url = '';
        return ['status' => 'failed', 'message' => $category_image['message']];
    }

    // return $category_image_url;

    $response = array();

    $check_existence = WHERE('product_categories', 'slug', $slug);
    $check_existence = runQuery($check_existence);
    $check_existence = mysqli_num_rows($check_existence);

    if ($check_existence > 0) {
        $response['status'] = 'failed';
        $response['message'] = "Such Product Category already exists!";
    } else {

        $table = "product_categories";
        $columns_values = [
            "slug" => $slug,
            "category_name" => $category_name,
            "color_code" => $color_code,
            "category_image" => $category_image_url,
            "remarks" => $remarks,
            "created_by" => $updated_by,
            "updated_by" => $updated_by,
        ];

        $query = INSERT($table, $columns_values);

        $run_query = runQuery($query);


        if ($run_query == 1) {

            $query3 = WHERE('product_categories', 'slug', $slug);
            $run_query3 = runQuery($query3);
            $fetch3 = mysqli_fetch_assoc($run_query3);

            $update_text = 'Added a new product_category ' . $category_name . ' for the organization! Check out, how they have managed to do it! <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/product-categories?id=' . $fetch3['id'] . '&view">Check</a>';
            $admin_update = addNewAdminUpdate($updated_by, $update_text);

            $response['status'] = 'success';
            $response['message'] = "Published '$category_name' as a Product Category!";
            $response['id'] = $fetch3['id'];
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to publish Product Category!";
        }
    }

    return $response;
}

function update_product_category($request)
{
    $category_name = addslashes($request['category_name']);
    $color_code = $request['color_code'];
    $remarks = addslashes($request['remarks']);

    $updated_by = getIdFromUserid($request['updated_by']);

    $id = $request['id'];

    // Default to existing values
    $existing = WHERE('product_categories', 'id', $id);
    $existing = runQuery($existing);
    $existing = mysqli_fetch_assoc($existing);

    // get existing url
    $category_image_url = $existing['category_image'] ?? '';

    // check if category_image is empty during product_category update
    if (!empty($_FILES['category_image']['name'])) {
        $category_image = upload_file('category_image');
        if ($category_image['status'] === 'success') {
            $category_image_url = $category_image['file_name'];
        } else {
            return ['status' => 'failed', 'message' => $category_image['message']];
        }
    }

    $response = array();

    $check_existence = getProductCategoryById($id);

    if (mysqli_num_rows($check_existence) > 0) {

        $columns_values = [
            "category_name" => $category_name,
            "color_code" => $color_code,
            "category_image" => $category_image_url,
            "remarks" => $remarks,
            "updated_by" => $updated_by
        ];

        $where_conditions = [
            "id" => $id
        ];

        $query = UPDATE('product_categories', $columns_values, $where_conditions);


        $run_query = runQuery($query);

        if ($run_query == 1) {

            addNewAdminUpdate($updated_by, 'Updated details for the Product Category "' . $category_name . '". <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/product-categories/?id=' . $id . '">View all details</a>!');

            $response['status'] = 'success';
            $response['message'] = "Product Category updated Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to update Product Category!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Product Category Found!";
    }

    return $response;
}

function send_product_category_to_trash($request)
{
    $product_category_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getProductCategoryById($product_category_id)) > 0) {
        $query = "UPDATE `product_categories` SET `is_active` = 0, `updated_by` = '$updated_by' WHERE `product_categories`.`id` = $product_category_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $product_category = getProductCategoryById($product_category_id);
            $product_category = mysqli_fetch_assoc($product_category);
            $product_category_name = $product_category['category_name'];

            addNewAdminUpdate($updated_by, 'Trashed "' . $product_category_name . '" Product Category!');

            $response['status'] = 'success';
            $response['message'] = "Product Category trashed Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to trash Product Category!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Product Category Found!";
    }
    return $response;
}

function restore_product_category_from_trash($request)
{
    $product_category_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getProductCategoryById($product_category_id)) > 0) {
        $query = "UPDATE `product_categories` SET `is_active` = 1, `updated_by` = '$updated_by' WHERE `product_categories`.`id` = $product_category_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $product_category = getProductCategoryById($product_category_id);
            $product_category = mysqli_fetch_assoc($product_category);
            $product_category_name = $product_category['category_name'];

            addNewAdminUpdate($updated_by, 'Restored "' . $product_category_name . '" Product Category!');

            $response['status'] = 'success';
            $response['message'] = "Product Category restored Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to restore Product Category!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Product Category found!";
    }
    return $response;
}

function delete_product_category($request)
{
    $product_category_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getProductCategoryById($product_category_id)) > 0) {
        $query = "UPDATE `product_categories` SET `is_deleted` = 1, `updated_by` = '$updated_by' WHERE `product_categories`.`id` = $product_category_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $product_category = getProductCategoryById($product_category_id);
            $product_category = mysqli_fetch_assoc($product_category);
            $product_category_name = $product_category['category_name'];

            addNewAdminUpdate($updated_by, 'Permanently Deleted "' . $product_category_name . '" Product Category for the product_category!');

            $response['status'] = 'success';
            $response['message'] = "Product Category deleted Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to delete Product Category!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Product Category Found!";
    }
    return $response;
}


function add_new_product($request)
{

    $category_id = $request['category_id'];
    $product_name = addslashes($request['product_name']);
    $slug = addslashes($request['slug']);
    $product_color = addslashes($request['product_color']);
    $type = $request['type'];
    $price = addslashes($request['price']);
    $discounted_price = addslashes($request['discounted_price']);
    $tax1_percent = $request['tax1_percent'];
    $tax2_percent = $request['tax2_percent'];
    $igst_percent = $request['igst_percent'];

    // product details captured
    $details_name = $request['details_name'];
    $details_value = $request['details_value'];
    $details = [];
    foreach ($details_name as $index => $name) {
        // Optional: sanitize both name and value
        $key = addslashes($name);
        $value = isset($details_value[$index]) ? addslashes($details_value[$index]) : null;

        // Only add if key is not empty
        if (!empty($key)) {
            $details[$key] = $value;
        }
    }
    $details = json_encode($details);

    // product technology captured here
    $technology_name = $request['technology_name'];
    $technology_description = $request['technology_description'];
    $technology = [];
    foreach ($technology_name as $index => $name) {
        // Optional: sanitize both name and value
        $key = addslashes($name);
        $value = isset($technology_description[$index]) ? addslashes($technology_description[$index]) : null;

        // Only add if key is not empty
        if (!empty($key)) {
            $technology[$key] = $value;
        }
    }
    $technology = json_encode($technology);

    // product features captured
    $features_name = $request['features_name'];
    $features_value = $request['features_value'];
    $features = [];
    foreach ($features_name as $index => $name) {
        // Optional: sanitize both name and value
        $key = addslashes($name);
        $value = isset($features_value[$index]) ? addslashes($features_value[$index]) : null;

        // Only add if key is not empty
        if (!empty($key)) {
            $features[$key] = $value;
        }
    }
    $features = json_encode($features);

    // product pathology captured here
    $pathology_name = $request['pathology_name'];
    $pathology_description = $request['pathology_description'];
    $pathology = [];
    foreach ($pathology_name as $index => $name) {
        // Optional: sanitize both name and value
        $key = addslashes($name);
        $value = isset($pathology_description[$index]) ? addslashes($pathology_description[$index]) : null;

        // Only add if key is not empty
        if (!empty($key)) {
            $pathology[$key] = $value;
        }
    }
    $pathology = json_encode($pathology);


    $remarks = addslashes($request['remarks']);
    $updated_by = getIdFromUserid($request['updated_by']);


    // file upload section
    $product_image_1 = upload_file('product_image_1');
    $product_image_2 = upload_file('product_image_2');
    $product_image_3 = upload_file('product_image_3');
    $product_image_4 = upload_file('product_image_4');

    // upload product_image_1
    if ($product_image_1['status'] === 'success') {
        $product_image_1_url = $product_image_1['file_name'];
    } else if ($product_image_1['err_code'] == 'FILE_NOT_SELECTED') {
        $product_image_1_url = '';
    } else {
        $product_image_1_url = '';
        return ['status' => 'failed', 'message' => $product_image_1['message']];
    }

    // upload product_image_2
    if ($product_image_2['status'] === 'success') {
        $product_image_2_url = $product_image_2['file_name'];
    } else if ($product_image_2['err_code'] == 'FILE_NOT_SELECTED') {
        $product_image_2_url = '';
    } else {
        $product_image_2_url = '';
        return ['status' => 'failed', 'message' => $product_image_2['message']];
    }

    // upload product_image_3
    if ($product_image_3['status'] === 'success') {
        $product_image_3_url = $product_image_3['file_name'];
    } else if ($product_image_3['err_code'] == 'FILE_NOT_SELECTED') {
        $product_image_3_url = '';
    } else {
        $product_image_3_url = '';
        return ['status' => 'failed', 'message' => $product_image_3['message']];
    }

    // upload product_image_4
    if ($product_image_4['status'] === 'success') {
        $product_image_4_url = $product_image_4['file_name'];
    } else if ($product_image_4['err_code'] == 'FILE_NOT_SELECTED') {
        $product_image_4_url = '';
    } else {
        $product_image_4_url = '';
        return ['status' => 'failed', 'message' => $product_image_4['message']];
    }

    $product_image_urls = [
        $product_image_1_url,
        $product_image_2_url,
        $product_image_3_url,
        $product_image_4_url,
    ];

    $product_image_urls = json_encode($product_image_urls);

    $response = array();

    $check_existence = WHERE('products', 'slug', $slug);
    $check_existence = runQuery($check_existence);
    $check_existence = mysqli_num_rows($check_existence);

    if ($check_existence > 0) {
        $response['status'] = 'failed';
        $response['message'] = "Such Product already exists!";
    } else {

        $table = "products";
        $columns_values = [
            "category_id" => $category_id,
            "product_name" => $product_name,
            "slug" => $slug,
            "product_color" => $product_color,
            "product_images" => $product_image_urls,
            "type" => $type,
            "price" => $price,
            "discounted_price" => $discounted_price,
            "tax1_percent" => $tax1_percent,
            "tax2_percent" => $tax2_percent,
            "igst_percent" => $igst_percent,
            "details" => $details,
            "technology" => $technology,
            "features" => $features,
            "pathology" => $pathology,
            "remarks" => $remarks,
            "created_by" => $updated_by,
            "updated_by" => $updated_by,
        ];

        $query = INSERT($table, $columns_values);

        $run_query = runQuery($query);


        if ($run_query == 1) {

            $query3 = WHERE('products', 'slug', $slug);
            $run_query3 = runQuery($query3);
            $fetch3 = mysqli_fetch_assoc($run_query3);

            // new inventory id
            $inventoryid = nextId('inventory', 'inventoryid');

            // default site
            $site_id = systemVariable('default_site_id'); // getting site id from system variable

            // add initial inventory entry
            $inventory = "inventory";
            $inventory_columns_values = [
                "inventoryid" => $inventoryid,
                "site_id" => $site_id,
                "product_id" => $fetch3['id'],
                "quantity" => 0, // initial quantity is 0
                "created_by" => $updated_by,
                "updated_by" => $updated_by,
            ];
            $query = INSERT($inventory, $inventory_columns_values);
            $inventory_id = runQuery($query, true);

            // add initial inventory transaction
            $inventory_transactions = "inventory_transactions";
            $transactionid = nextId('inventory_transactions', 'transactionid');
            $inventory_transactions_columns_values = [
                "transactionid" => $transactionid,
                "inventory_id" => $inventory_id,
                "site_id" => $site_id,
                "product_id" => $fetch3['id'],
                "old_quantity" => 0,
                "new_quantity" => 0,
                "change_quantity" => 0,
                "transaction_type" => 0,
                "amount" => 0,
                "invoice" => "",
                "remarks" => "Initial Inventory Entry",
                "created_by" => $updated_by,
                "updated_by" => $updated_by,
            ];
            $inventory_transactions_query = INSERT($inventory_transactions, $inventory_transactions_columns_values);
            $inventory_transactions_query_run_query = runQuery($inventory_transactions_query);

            $update_text = 'Added a new product ' . $product_name . ' for the organization! Check out, how they have managed to do it! <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/products?id=' . $fetch3['id'] . '&view">Check</a>';
            $admin_update = addNewAdminUpdate($updated_by, $update_text);

            $response['status'] = 'success';
            $response['message'] = "Published '$product_name' as a Product!";
            $response['id'] = $fetch3['id'];
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to publish Product!";
        }
    }

    return $response;
}

function update_product($request)
{
    $category_id = $request['category_id'];
    $product_name = addslashes($request['product_name']);
    $slug = addslashes($request['slug']);
    $product_color = addslashes($request['product_color']);
    $type = $request['type'];
    $price = addslashes($request['price']);
    $discounted_price = addslashes($request['discounted_price']);
    $tax1_percent = $request['tax1_percent'];
    $tax2_percent = $request['tax2_percent'];
    $igst_percent = $request['igst_percent'];

    // product details captured
    $details_name = $request['details_name'];
    $details_value = $request['details_value'];
    $details = [];
    foreach ($details_name as $index => $name) {
        // Optional: sanitize both name and value
        $key = addslashes($name);
        $value = isset($details_value[$index]) ? addslashes($details_value[$index]) : null;

        // Only add if key is not empty
        if (!empty($key)) {
            $details[$key] = $value;
        }
    }
    $details = json_encode($details);

    // product technology captured here
    $technology_name = $request['technology_name'];
    $technology_description = $request['technology_description'];
    $technology = [];
    foreach ($technology_name as $index => $name) {
        // Optional: sanitize both name and value
        $key = addslashes($name);
        $value = isset($technology_description[$index]) ? addslashes($technology_description[$index]) : null;

        // Only add if key is not empty
        if (!empty($key)) {
            $technology[$key] = $value;
        }
    }
    $technology = json_encode($technology);

    // product features captured
    $features_name = $request['features_name'];
    $features_value = $request['features_value'];
    $features = [];
    foreach ($features_name as $index => $name) {
        // Optional: sanitize both name and value
        $key = addslashes($name);
        $value = isset($features_value[$index]) ? addslashes($features_value[$index]) : null;

        // Only add if key is not empty
        if (!empty($key)) {
            $features[$key] = $value;
        }
    }
    $features = json_encode($features);

    // product pathology captured here
    $pathology_name = $request['pathology_name'];
    $pathology_description = $request['pathology_description'];
    $pathology = [];
    foreach ($pathology_name as $index => $name) {
        // Optional: sanitize both name and value
        $key = addslashes($name);
        $value = isset($pathology_description[$index]) ? addslashes($pathology_description[$index]) : null;

        // Only add if key is not empty
        if (!empty($key)) {
            $pathology[$key] = $value;
        }
    }
    $pathology = json_encode($pathology);

    $remarks = addslashes($request['remarks']);
    $updated_by = getIdFromUserid($request['updated_by']);

    $id = $request['id'];

    // Default to existing values
    $existing = WHERE('products', 'id', $id);
    $existing = runQuery($existing);
    $existing = mysqli_fetch_assoc($existing);

    // get existing url
    $product_image_urls = $existing['product_images'] ?? '';
    $product_image_urls = json_decode($product_image_urls, true);
    $product_image_1_url = $product_image_urls[0] ?? '';
    $product_image_2_url = $product_image_urls[1] ?? '';
    $product_image_3_url = $product_image_urls[2] ?? '';
    $product_image_4_url = $product_image_urls[3] ?? '';

    // check if product_image_1 is empty during product update
    if (!empty($_FILES['product_image_1']['name'])) {
        $product_image_1 = upload_file('product_image_1');
        if ($product_image_1['status'] === 'success') {
            $product_image_1_url = $product_image_1['file_name'];
        } else {
            return ['status' => 'failed', 'message' => $product_image_1['message']];
        }
    }

    // check if product_image_2 is empty during product update
    if (!empty($_FILES['product_image_2']['name'])) {
        $product_image_2 = upload_file('product_image_2');
        if ($product_image_2['status'] === 'success') {
            $product_image_2_url = $product_image_2['file_name'];
        } else {
            return ['status' => 'failed', 'message' => $product_image_2['message']];
        }
    }

    // check if product_image_3 is empty during product update
    if (!empty($_FILES['product_image_3']['name'])) {
        $product_image_3 = upload_file('product_image_3');
        if ($product_image_3['status'] === 'success') {
            $product_image_3_url = $product_image_3['file_name'];
        } else {
            return ['status' => 'failed', 'message' => $product_image_3['message']];
        }
    }

    // check if product_image_4 is empty during product update
    if (!empty($_FILES['product_image_4']['name'])) {
        $product_image_4 = upload_file('product_image_4');
        if ($product_image_4['status'] === 'success') {
            $product_image_4_url = $product_image_4['file_name'];
        } else {
            return ['status' => 'failed', 'message' => $product_image_4['message']];
        }
    }

    $product_image_urls = [
        $product_image_1_url,
        $product_image_2_url,
        $product_image_3_url,
        $product_image_4_url,
    ];
    $product_image_urls = json_encode($product_image_urls);

    $response = array();

    $check_existence = getProductById($id);

    if (mysqli_num_rows($check_existence) > 0) {

        $columns_values = [
            "category_id" => $category_id,
            "product_name" => $product_name,
            "slug" => $slug,
            "product_color" => $product_color,
            "product_images" => $product_image_urls,
            "type" => $type,
            "price" => $price,
            "discounted_price" => $discounted_price,
            "tax1_percent" => $tax1_percent,
            "tax2_percent" => $tax2_percent,
            "igst_percent" => $igst_percent,
            "details" => $details,
            "technology" => $technology,
            "features" => $features,
            "pathology" => $pathology,
            "remarks" => $remarks,
            "updated_by" => $updated_by
        ];

        $where_conditions = [
            "id" => $id
        ];

        $query = UPDATE('products', $columns_values, $where_conditions);


        $run_query = runQuery($query);

        if ($run_query == 1) {

            addNewAdminUpdate($updated_by, 'Updated details for the Product "' . $product_name . '". <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/products/?id=' . $id . '">View all details</a>!');

            $response['status'] = 'success';
            $response['message'] = "Product updated Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to update Product!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Product Found!";
    }

    return $response;
}


function send_product_to_trash($request)
{
    $product_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getProductById($product_id)) > 0) {
        $query = "UPDATE `products` SET `is_active` = 0, `updated_by` = '$updated_by' WHERE `products`.`id` = $product_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $product = getProductById($product_id);
            $product = mysqli_fetch_assoc($product);
            $product_name = $product['product_name'];

            addNewAdminUpdate($updated_by, 'Trashed "' . $product_name . '" Site!');

            $response['status'] = 'success';
            $response['message'] = "Product trashed Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to trash Product!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Product Found!";
    }
    return $response;
}

function restore_product_from_trash($request)
{
    $product_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getProductById($product_id)) > 0) {
        $query = "UPDATE `products` SET `is_active` = 1, `updated_by` = '$updated_by' WHERE `products`.`id` = $product_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $product = getProductById($product_id);
            $product = mysqli_fetch_assoc($product);
            $product_name = $product['product_name'];

            addNewAdminUpdate($updated_by, 'Restored "' . $product_name . '" Site!');

            $response['status'] = 'success';
            $response['message'] = "Product restored Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to restore Product!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Product found!";
    }
    return $response;
}

function delete_product($request)
{
    $product_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getProductById($product_id)) > 0) {
        $query = "UPDATE `products` SET `is_deleted` = 1, `updated_by` = '$updated_by' WHERE `products`.`id` = $product_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $product = getProductById($product_id);
            $product = mysqli_fetch_assoc($product);
            $product_name = $product['product_name'];

            addNewAdminUpdate($updated_by, 'Permanently Deleted "' . $product_name . '" Product for the product!');

            $response['status'] = 'success';
            $response['message'] = "Product deleted Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to delete Product!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Product Found!";
    }
    return $response;
}


// function add_stock($request)
// {
//     $product_id = $request['product_id'];
//     $site_id = $request['site_id'];
//     $change_quantity = $request['change_quantity'];

//     // get product details
//     $product = getProductById($product_id);
//     $product = mysqli_fetch_assoc($product);

//     // get current inventory details 
//     $inventory = getInventoryByProductId($product_id);
//     $inventory = mysqli_fetch_assoc($inventory);

//     // get site details
//     $site = getSiteById($site_id);
//     $site = mysqli_fetch_assoc($site);

//     $old_quantity = (int) $inventory['quantity'];
//     $new_quantity = $old_quantity + $change_quantity;
//     $transaction_type = 0; // 0 for stock addition
//     $amount = ((float) $product['discounted_price']) * $change_quantity; // calculate change amount based on discounted price

//     $remarks = addslashes($request['remarks']);
//     $created_by = getIdFromUserid($request['updated_by']);
//     $updated_by = getIdFromUserid($request['updated_by']);

//     $transactionid = nextId('inventory_transactions', 'transactionid');

//     // save invoice file
//     $invoice = upload_file('invoice');

//     // upload product_image_1
//     if ($invoice['status'] === 'success') {
//         $invoice_url = $invoice['file_name'];
//     } else if ($invoice['err_code'] == 'FILE_NOT_SELECTED') {
//         $invoice_url = '';
//     } else {
//         $invoice_url = '';
//         return ['status' => 'failed', 'message' => $invoice['message']];
//     }

//     // update stock case
//     // if the product already exists in the site
//     $where_conditions = [
//         "product_id" => $product_id,
//         "site_id" => $site_id
//     ];
//     $product_in_site_query = WHEREm('inventory', $where_conditions);
//     $product_in_site = runQuery($product_in_site_query);
//     if (mysqli_num_rows($product_in_site) > 0) { // check if the product exists in the site
//         // Product exists in the site, update the stock
//         $column_values = [
//             "quantity" => $new_quantity,
//             "updated_by" => $updated_by
//         ];
//         $query = UPDATE('inventory', $column_values, $where_conditions); // using same $where_conditions to update stock product in site
//         $run_query = runQuery($query);


//         if ($run_query == 1) {
//             // Add inventory transaction
//             $transaction_query = INSERT('inventory_transactions', [
//                 "transactionid" => $transactionid,
//                 "site_id" => $site_id,
//                 "product_id" => $product_id,
//                 "old_quantity" => $old_quantity,
//                 "new_quantity" => $new_quantity,
//                 "change_quantity" => $change_quantity,
//                 "transaction_type" => $transaction_type,
//                 "invoice" => $invoice_url,
//                 "amount" => $amount,
//                 "remarks" => $remarks,
//                 "created_by" => $created_by,
//                 "updated_by" => $updated_by
//             ]);
//             runQuery($transaction_query);

//             addNewAdminUpdate($updated_by, 'Added ' . $change_quantity . ' units of stock for Product: ' . $product['product_name'] . ' at Site: ' . $site['site_id']);

//             return ['status' => 'success', 'message' => "Stock added successfully!"];
//         } else {
//             return ['status' => 'failed', 'message' => "Unable to update stock!"];
//         }

//     } else {
//         // Product does not exist in the site, insert a new record
//         // Create a new inventory entry
//         // Generate a new inventory ID
//         $inventoryid = nextId('inventory', 'inventoryid');

//         $column_values = [
//             "inventoryid" => $inventoryid,
//             "site_id" => $site_id,
//             "product_id" => $product_id,
//             "quantity" => $new_quantity,
//             "created_by" => $created_by,
//             "updated_by" => $updated_by
//         ];
//         $query = INSERT('inventory', $column_values);
//         $inventory_id = runQuery($query, true);

//         if ($inventory_id) {
//             // Add inventory transaction
//             $transaction_query = INSERT('inventory_transactions', [
//                 "transactionid" => $transactionid,
//                 "inventory_id" => $inventory_id,
//                 "site_id" => $site_id,
//                 "product_id" => $product_id,
//                 "old_quantity" => 0, // since it's a new entry, old quantity is 0
//                 "new_quantity" => $new_quantity,
//                 "change_quantity" => $change_quantity,
//                 "transaction_type" => $transaction_type,
//                 "invoice" => $invoice_url,
//                 "amount" => $amount,
//                 "remarks" => $remarks,
//                 "created_by" => $created_by,
//                 "updated_by" => $updated_by
//             ]);
//             runQuery($transaction_query);

//             addNewAdminUpdate($updated_by, 'Added ' . $change_quantity . ' units of stock for Product: ' . $product['product_name'] . ' at Site: ' . $site['site_id']);

//             return ['status' => 'success', 'message' => "Stock added successfully!"];
//         } else {
//             return ['status' => 'failed', 'message' => "Unable to add stock!"];
//         }
//     }

// }
function add_stock($request)
{

    $product_id = $request['product_id'];
    $site_id = $request['site_id'];
    $change_quantity = $request['change_quantity'];

    // get product details
    $product = getProductById($product_id);
    $product = mysqli_fetch_assoc($product);

    // get site details
    $site = getSiteById($site_id);
    $site = mysqli_fetch_assoc($site);

    // get current inventory details
    $inventory = WHEREm('inventory', [
        'product_id' => $product_id,
        'site_id' => $site_id
    ]);
    $inventory = runQuery($inventory);

    $remarks = addslashes($request['remarks']);
    $created_by = getIdFromUserid($request['updated_by']);
    $updated_by = getIdFromUserid($request['updated_by']);

    // save invoice file
    $invoice = upload_file('invoice');

    // upload product_image_1
    if ($invoice['status'] === 'success') {
        $invoice_url = $invoice['file_name'];
    } else if ($invoice['err_code'] == 'FILE_NOT_SELECTED') {
        $invoice_url = '';
    } else {
        $invoice_url = '';
        return ['status' => 'failed', 'message' => $invoice['message']];
    }

    // update stock case
    // if the product already exists in the site
    if (mysqli_num_rows($inventory) > 0) {

        // Product exists in the site, update the stock
        $inventory = mysqli_fetch_assoc($inventory);
        $old_quantity = (int) $inventory['quantity'];
        $new_quantity = $old_quantity + $change_quantity;
        $transaction_type = 0; // 0 for stock addition
        $amount = ((float) $product['discounted_price']) * $change_quantity; // calculate change amount based on discounted price


        // new transaction id
        $transactionid = nextId('inventory_transactions', 'transactionid');
        $column_values = [
            "quantity" => $new_quantity,
            "updated_by" => $updated_by
        ];
        $query = UPDATE('inventory', $column_values, [
            "product_id" => $product_id,
            "site_id" => $site_id
        ]); // using same $where_conditions to update stock product in site
        $run_query = runQuery($query);

        if ($run_query == 1) {
            // Add inventory transaction
            $transaction_query = INSERT('inventory_transactions', [
                "transactionid" => $transactionid,
                "inventory_id" => $inventory['id'],
                "site_id" => $site_id,
                "product_id" => $product_id,
                "old_quantity" => $old_quantity,
                "new_quantity" => $new_quantity,
                "change_quantity" => $change_quantity,
                "transaction_type" => $transaction_type,
                "invoice" => $invoice_url,
                "amount" => $amount,
                "remarks" => $remarks,
                "created_by" => $created_by,
                "updated_by" => $updated_by
            ]);
            runQuery($transaction_query);

            addNewAdminUpdate($updated_by, 'Added ' . $change_quantity . ' units of stock for Product: ' . $product['product_name'] . ' at Site: ' . $site['site_id']);

            return ['status' => 'success', 'message' => "Stock added successfully!"];
        } else {
            return ['status' => 'failed', 'message' => "Unable to update stock!"];
        }
    } else {
        // Product does not exist in the site, insert a new record
        // Create a new inventory entry
        // Generate a new inventory ID
        $inventoryid = nextId('inventory', 'inventoryid');
        $transactionid = nextId('inventory_transactions', 'transactionid');

        $old_quantity = 0; // since it's a new entry, old quantity is 0
        $new_quantity = $old_quantity + $change_quantity;
        $transaction_type = 0; // 0 for stock addition
        $amount = ((float) $product['discounted_price']) * $change_quantity; // calculate change amount based on discounted price


        $column_values = [
            "inventoryid" => $inventoryid,
            "site_id" => $site_id,
            "product_id" => $product_id,
            "quantity" => $new_quantity,
            "created_by" => $created_by,
            "updated_by" => $updated_by
        ];
        $query = INSERT('inventory', $column_values);
        $inventory_id = runQuery($query, true);

        if ($inventory_id) {
            // Add inventory transaction
            $transaction_query = INSERT('inventory_transactions', [
                "transactionid" => $transactionid,
                "inventory_id" => $inventory_id,
                "site_id" => $site_id,
                "product_id" => $product_id,
                "old_quantity" => 0, // since it's a new entry, old quantity is 0
                "new_quantity" => $new_quantity,
                "change_quantity" => $change_quantity,
                "transaction_type" => $transaction_type,
                "invoice" => $invoice_url,
                "amount" => $amount,
                "remarks" => $remarks,
                "created_by" => $created_by,
                "updated_by" => $updated_by
            ]);
            runQuery($transaction_query);

            addNewAdminUpdate($updated_by, 'Added ' . $change_quantity . ' units of stock for Product: ' . $product['product_name'] . ' at Site: ' . $site['site_id']);

            return ['status' => 'success', 'message' => "Stock added successfully!"];
        } else {
            return ['status' => 'failed', 'message' => "Unable to add stock!"];
        }
    }
}

function get_patient_by_consultation_id($request)
{
    $consultation_id = $request['consultation_id'];

    $consultation = getConsultationById($consultation_id);

    $response = [];

    if (mysqli_num_rows($consultation) > 0) {

        $consultation = mysqli_fetch_assoc($consultation);

        $patient_id = $consultation['patient_id'];
        $patient = getPatientById($patient_id);

        if (mysqli_num_rows($patient) > 0) {
            $patient = mysqli_fetch_assoc($patient);

            $response = ['status' => 'success', 'message' => "Fetched details of patient from consultation!", "data" => $patient];
        } else {
            $response = ['status' => 'failed', 'message' => "Unable to fetch details of patient from consultation!"];
        }
    } else {
        $response = ['status' => 'failed', 'message' => "Unable to fetch details of patient from consultation!"];
    }

    return $response;
}

function get_patient_by_id($request)
{
    $patient_id = $request['patient_id'];

    $response = [];

    $patient = getPatientById($patient_id);

    if (mysqli_num_rows($patient) > 0) {
        $patient = mysqli_fetch_assoc($patient);

        $response = ['status' => 'success', 'message' => "Fetched details of patient!", "data" => $patient];
    } else {
        $response = ['status' => 'failed', 'message' => "Unable to fetch details of patient!"];
    }

    return $response;
}

function get_consent_form($request)
{

    $sale_id = $request['sale_id']; // this is unqiue sale id and it is autogenerated by mysql
    $saleid = $request['saleid']; // this is of format SI-00x 
    $patient_id = $request['patient_id'];
    $consultation_id = $request['consultation_id'];
    $site_id = $request['site_id'];
    $updated_by = $request['updated_by'];

    $response = [];



    $html = buildConsentFormPDFFromHtml(prepareConsentFormData($consultation_id, $patient_id, $updated_by, $site_id, $saleid));

    // // Generate PDF and save
    $pdf_name = date('Ymdhis') . "_CF" . ".pdf";
    $pdf_path = generatePDF($html, $pdf_name, __DIR__ . "/../system_generated");

    // // // Store the PDF link in response
    // $response['pdf_link'] = $pdf_name;

    $column_values = [
        'is_consent_done' => 1,
        'consent_file' => $pdf_name
    ];

    $where_conditions = [
        'id' => $sale_id,
    ];

    $query = UPDATE('sales', $column_values, $where_conditions);
    $run_query = runQuery($query);

    if ($run_query) {
        $response['consent_form'] = $pdf_name;
        $response['status'] = 'success';
        $response['message'] = 'Consent Form Successfully generated!';
    } else {
        $response['status'] = 'failed';
        $response['message'] = 'Consent Form generation failed!';
    }

    return $response;
}

// update sale function and egenrate invoice from sale with patient details
function add_new_sale($request)
{

    $consultation_id = $request['consultation_id'] ? $request['consultation_id'] : null;
    $patient_id = $request['patient_id'];
    $date = $request['date'];
    $site_id = $request['site_id'];
    $saleid = nextId('sales', 'saleid');

    // list items
    $items = json_decode($request['items'], true);

    $adjustment = $request['adjustment'];

    $created_by = getIdFromUserid($request['updated_by']);
    $updated_by = getIdFromUserid($request['updated_by']);
    $remarks = $request['remarks'];

    $response = [];

    $column_values = [
        'saleid' => $saleid,
        'date' => $date,
        'patient_id' => $patient_id,
        'site_id' => $site_id,
        'user_id' => $created_by,
        'consultation_id' => $consultation_id,
        'date' => $date,
        'adjustment' => $adjustment,
        'remarks' => $remarks,
        'created_by' => $created_by,
        'updated_by' => $updated_by,

    ];
    $query = INSERT('sales', $column_values);
    $sale_id = runQuery($query, true);

    $total_amount = 0;
    $grand_total = 0;

    if ($sale_id) {

        // add sale_id to response
        $response['id'] = $sale_id;

        // $items_query = "";
        $items_run_query = null;

        foreach ($items as $item) {
            $total_amount += $item['amount'];
            $item_column_values = [
                "sale_id" => $sale_id,
                "product_id" => $item['product_id'],
                "quantity" => $item['quantity'],
                "rate" => $item['rate'],
                "tax" => $item['tax'],
                "amount" => $item['amount'],
            ];

            $items_query = INSERT('sales_items', $item_column_values);
            $items_run_query = runQuery($items_query);
        }

        // calculate grand total
        $grand_total = $total_amount + $adjustment;
        $column_values = [
            'total_amount' => $total_amount,
            'grand_total' => $grand_total,
        ];
        $where_conditions = [
            'id' => $sale_id
        ];
        $final_update_query = UPDATE('sales', $column_values, $where_conditions);
        runQuery($final_update_query);

        if ($items_run_query) {
            $response['status'] = "success";
            $response['message'] = "New Sale Added!";
        } else {
            $response['status'] = "failed";
            $response['message'] = "Unable to add items in the Sale!";
        }
    } else {
        $response['status'] = "failed";
        $response['message'] = "Unable to add new Sale!";
    }


    return $response;
}

// update sale function and egenrate invoice from sale with patient details
function update_sale($request)
{
    $sale_id = $request['sale_id']; // This is the primary key from `sales` table
    $consultation_id = !empty($request['consultation_id']) ? $request['consultation_id'] : null;
    $patient_id = $request['patient_id'];
    $date = $request['date'];
    $site_id = $request['site_id'];
    $is_sale_finalized = !empty($request['is_sale_finalized']) ? 1 : 0;
    $adjustment = isset($request['adjustment']) ? floatval($request['adjustment']) : 0;

    $created_by = getIdFromUserid($request['updated_by']);
    $updated_by = getIdFromUserid($request['updated_by']);
    $remarks = $request['remarks'];

    $patient = getPatientById($patient_id);
    $patient = mysqli_fetch_assoc($patient);

    $items = json_decode($request['items'], true);
    $response = [];

    // 🔄 Update Sale Basic Info
    $column_values = [
        'date' => $date,
        'patient_id' => $patient_id,
        'site_id' => $site_id,
        'user_id' => $created_by,
        'consultation_id' => $consultation_id,
        'adjustment' => $adjustment,
        'remarks' => $remarks,
        'updated_by' => $updated_by,
    ];
    $where_conditions = ['id' => $sale_id];

    $update_sale_query = UPDATE('sales', $column_values, $where_conditions);
    $update_result = runQuery($update_sale_query);

    if (!$update_result) {
        return [
            'status' => 'failed',
            'message' => 'Unable to update sale record!',
        ];
    }

    // 🔄 Remove old sale items
    $delete_query = DELETE('sales_items', ['sale_id' => $sale_id]);
    runQuery($delete_query);

    // stores the transaction ids
    $transaction_ids = [];

    // 🛒 Insert new sale items
    $total_amount = 0;
    foreach ($items as $item) {
        $total_amount += floatval($item['amount']);
        $item_column_values = [
            "sale_id" => $sale_id,
            "product_id" => $item['product_id'],
            "quantity" => $item['quantity'],
            "rate" => $item['rate'],
            "tax" => $item['tax'],
            "amount" => $item['amount'],
        ];
        $insert_query = INSERT('sales_items', $item_column_values);
        $item_inserted = runQuery($insert_query);



        if ($item_inserted) {
            // if item is inserted successfully, then get current stock and update stock
            $inventory_where_conditions = [
                "product_id" => $item['product_id'],
                "site_id" => $site_id
            ];
            $current_inventory_value = WHEREm('inventory', $inventory_where_conditions);
            $current_inventory_value = runQuery($current_inventory_value);
            $current_inventory_value = mysqli_fetch_assoc($current_inventory_value);

            // check if current inventory stock is more than item required stock in invoice
            if ($current_inventory_value['quantity'] > $item['quantity']) {
                // update inventory value
                $new_stock = $current_inventory_value['quantity'] - $item['quantity'];
                $inventory_update_column_values = [
                    "quantity" => $new_stock,
                    "updated_by" => $updated_by
                ];
                $inventory_update_query = UPDATE('inventory', $inventory_update_column_values, $inventory_where_conditions);
                $inventory_update_query = runQuery($inventory_update_query);

                // insert new transaction
                $new_transactionid = nextId('inventory_transactions', 'transactionid');
                $new_transaction_column_values = [
                    'transactionid' => $new_transactionid,
                    'inventory_id' => $current_inventory_value['id'],
                    'site_id' => $site_id,
                    'product_id' => $item['product_id'],
                    'old_quantity' => $current_inventory_value['quantity'],
                    'new_quantity' => $new_stock,
                    'change_quantity' => $item['quantity'],
                    'transaction_type' => 1, // since it is in sales 	0=incoming,1=outgoing	
                    'amount' => $item['amount'],
                    'remarks' => 'Sale done for ' . 'PI-' . prefix_00($patient['patientid']) . ': ' . $patient['first_name'] . ' ' . $patient['last_name'] . ' (UHID: ' . $patient['uhid'] . ')',
                    'updated_by' => $updated_by
                ];
                $new_transaction = INSERT('inventory_transactions', $new_transaction_column_values);
                $new_transaction = runQuery($new_transaction, true);
                array_push($transaction_ids, $new_transaction);
            }
        }
    }

    // 🧮 Calculate Grand Total
    $grand_total = $total_amount + $adjustment;
    $update_totals_query = UPDATE('sales', [
        'total_amount' => $total_amount,
        'grand_total' => $grand_total,
    ], $where_conditions);
    runQuery($update_totals_query);

    // ✅ Fetch updated sale info
    $sale = getSaleById($sale_id);
    $sale = mysqli_fetch_assoc($sale);

    if (!$sale) {
        return [
            'status' => 'failed',
            'message' => 'Failed to fetch updated sale record!',
        ];
    }

    // 🧾 Generate Invoice (if finalized)
    if ($is_sale_finalized) {
        $invoice_number = prefix_00($sale['saleid']); // Be careful: saleid != id
        $pdf_name = date('YmdHis') . "_SI-" . $invoice_number . ".pdf";

        $html = buildInvoicePDFFromHtml(
            prepareInvoiceData($invoice_number, $consultation_id, $patient_id, $updated_by, $site_id, $sale_id, $sale_id)
        );

        $pdf_path = generatePDF($html, $pdf_name, __DIR__ . "/../system_generated");

        // Update sale with file and finalize flag
        $finalize_query = UPDATE('sales', [
            'sale_file' => $pdf_name,
            'is_sale_finalized' => 1
        ], ['id' => $sale_id]);
        $invoice_generated = runQuery($finalize_query);

        // get all new transaction ids to update the invoice
        $where_conditions = [];
        foreach ($transaction_ids as $transaction_id) {
            if ($transaction_id != 0) {
                $where_conditions[] = "`inventory_transactions`.`id` = $transaction_id";
            }
        }

        // create query and update
        $update_invoice_query = "";
        if (!empty($where_conditions)) {
            $where_clause = implode(" OR ", $where_conditions);
            $update_invoice_query = "UPDATE `inventory_transactions` SET `invoice` = '$pdf_name' WHERE $where_clause;";
            runQuery($update_invoice_query);
        }

        addNewAdminUpdate($updated_by, 'Sale Details: <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/sales/?id=' . $sale_id . '&view">View all details</a>! <a target="_blank" href="' . systemVariable('SITE_HOME') . 'system_generated/' . $pdf_name . '">View Invoice</a>!');

        $response['invoice_file'] = $pdf_name;
        $response['status'] = 'success';
        $response['message'] = 'Invoice generated successfully!';
        $response['q'] = $update_invoice_query;
        $response['tids'] = $transaction_ids;
    } else {
        $response['status'] = 'success';
        $response['message'] = 'Sale saved as draft.';
    }

    return $response;
}

// for customer invoice add
function add_new_invoice($request)
{

    $customer_name = safeValue($request['customer_name']);
    $gst = safeValue($request['gst']);
    // return $gst;
    $address = safeValue($request['address']);
    $address_state = $request['address_state'];
    $address_city = safeValue($request['address_city']);
    $address_pin = $request['address_pin'];
    $invoice_date = $request['invoice_date'];
    $due_date = $request['due_date'];
    
    $customerinvoiceuid = nextId('customer_invoices', 'customerinvoiceuid') ?? 1; // if there is no record, then start from 1

    $created_by = getIdFromUserid($request['created_by']);
    $updated_by = getIdFromUserid($request['created_by']);
    $remarks = $request['remarks'];
    
    $is_igst = 0; // default is 0
    $hub = systemVariable('default_site_id');
    $hub = getSiteById($hub);
    $hub = mysqli_fetch_assoc($hub);
    if($hub['address_state'] != $address_state){
        $is_igst = 1; // if state is different then igst is 1
    }
    
    // return $is_igst;

    $response = [];

    $column_values = [
        'customerinvoiceuid' => $customerinvoiceuid,
        'customer_name' => $customer_name,
        'gst' => $gst,
        'address' => $address,
        'address_state' => $address_state,
        'address_city' => $address_city,
        'address_pin' => $address_pin,
        'supply_place' => $address_state,
        'invoice_date' => $invoice_date,
        'due_date' => $due_date,
        'is_igst' => $is_igst,
        'remarks' => $remarks,
        'created_by' => $created_by,
        'updated_by' => $updated_by,

    ];
    $query = INSERT('customer_invoices', $column_values);
    $invoice_id = runQuery($query, true);

    if ($invoice_id) {

        $response['status'] = "success";
        $response['message'] = "New Customer Invoice Added!";
        $response['id'] = $invoice_id;
    } else {
        $response['status'] = "failed";
        $response['message'] = "Unable to add new Customer Invoice!";
    }


    return $response;
}

// for customer invoice update
function update_invoice($request)
{

    $site_id = $central_hub = systemVariable('default_site_id'); // central hub site id (set in settings)

    $invoice_id = $request['invoice_id']; // This is the primary key from `customer_invoices` table
    $customer_name = safeValue($request['customer_name']);
    $customerinvoiceuid = $request['customerinvoiceuid'];
    $address_state = $request['address_state'];
    $gst = safeValue($request['gst']);
    $address = safeValue($request['address']);
    $address_city = safeValue($request['address_city']);
    $address_pin = $request['address_pin'];
    $invoice_date = $request['invoice_date'];
    $due_date = $request['due_date'];
    $is_invoice_finalized = !empty($request['is_invoice_finalized']) ? 1 : 0;
    $is_igst = !empty($request['is_igst']) ? 1 : 0;
    $adjustment = isset($request['adjustment']) ? floatval($request['adjustment']) : 0;

    $updated_by = getIdFromUserid($request['updated_by']);
    $remarks = $request['remarks'];


    $items = json_decode($request['items'], true);
    $response = [];

    // 🔄 Update Invoice Basic Info
    $column_values = [
        'customer_name' => $customer_name,
        'gst' => $gst,
        'address' => $address,
        'address_city' => $address_city,
        'address_pin' => $address_pin,
        'invoice_date' => $invoice_date,
        'due_date' => $due_date,
        'is_invoice_generated' => $is_invoice_finalized,
        'adjustment' => $adjustment,
        'remarks' => $remarks,
        'updated_by' => $updated_by,
    ];
    $where_conditions = ['id' => $invoice_id];

    $update_invoice_query = UPDATE('customer_invoices', $column_values, $where_conditions);
    // return $update_invoice_query;
    $update_result = runQuery($update_invoice_query);

    if (!$update_result) {
        return [
            'status' => 'failed',
            'message' => 'Unable to update invoice record!',
        ];
    }

    // 🔄 Remove old sale items
    $delete_query = DELETE('customer_invoice_items', ['customer_invoice_id' => $invoice_id]);
    runQuery($delete_query);

    // // stores the transaction ids
    $transaction_ids = [];

    // // 🛒 Insert new invoice items
    $total_amount = 0;
    foreach ($items as $item) {
        $total_amount += floatval($item['amount']);
        $item_column_values = [
            "customer_invoice_id" => $invoice_id,
            "product_id" => $item['product_id'],
            "quantity" => $item['quantity'],
            "rate" => $item['rate'],
            "cgst" => $item['cgst'],
            "sgst" => $item['sgst'],
            "igst" => $item['igst'],
            "amount" => $item['amount'],
        ];
        $insert_query = INSERT('customer_invoice_items', $item_column_values);
        $item_inserted = runQuery($insert_query);



        if ($item_inserted) {
            // if item is inserted successfully, then get current stock and update stock
            $inventory_where_conditions = [
                "product_id" => $item['product_id'],
                "site_id" => $site_id
            ];
            $current_inventory_value = WHEREm('inventory', $inventory_where_conditions);
            $current_inventory_value = runQuery($current_inventory_value);
            $current_inventory_value = mysqli_fetch_assoc($current_inventory_value);

            // check if current inventory stock is more than item count required in invoice
            if ($current_inventory_value['quantity'] > $item['quantity']) {
                // update inventory value
                $new_stock = $current_inventory_value['quantity'] - $item['quantity'];
                $inventory_update_column_values = [
                    "quantity" => $new_stock,
                    "updated_by" => $updated_by
                ];
                $inventory_update_query = UPDATE('inventory', $inventory_update_column_values, $inventory_where_conditions);
                $inventory_update_query = runQuery($inventory_update_query);

                // insert new transaction
                $new_transactionid = nextId('inventory_transactions', 'transactionid');
                $new_transaction_column_values = [
                    'transactionid' => $new_transactionid,
                    'inventory_id' => $current_inventory_value['id'],
                    'site_id' => $site_id,
                    'product_id' => $item['product_id'],
                    'old_quantity' => $current_inventory_value['quantity'],
                    'new_quantity' => $new_stock,
                    'change_quantity' => $item['quantity'],
                    'transaction_type' => 1, // since it is in sales 	0=incoming,1=outgoing	
                    'amount' => $item['amount'],
                    'remarks' => 'Sale done for Customer Invoice ID: CSI-' . prefix_00($customerinvoiceuid) . ', Customer Name: ' . $customer_name,
                    'updated_by' => $updated_by
                ];
                $new_transaction = INSERT('inventory_transactions', $new_transaction_column_values);
                $new_transaction = runQuery($new_transaction, true);
                array_push($transaction_ids, $new_transaction);
            }
        }
    }

    // 🧮 Calculate Grand Total
    $grand_total = $total_amount + $adjustment;
    $update_totals_query = UPDATE('customer_invoices', [
        'total_amount' => $total_amount,
        'grand_total' => $grand_total,
    ], $where_conditions);
    runQuery($update_totals_query);

    // ✅ Fetch updated invoice info
    $invoice = getInvoiceById($invoice_id);
    $invoice = mysqli_fetch_assoc($invoice);

    if (!$invoice) {
        return [
            'status' => 'failed',
            'message' => 'Failed to fetch updated invoice record!',
        ];
    }

    // 🧾 Generate Invoice (if finalized)
    if ($is_invoice_finalized) {
        $address_state_details = getAddressStateById($address_state);

        $invoice_number = 'CSI-' . prefix_00($customerinvoiceuid); // Be careful: customerinvoiceuid != id
        $pdf_name = date('YmdHis') . "_" . $invoice_number . ".pdf";
        $customer_address = $address . ', ' . $address_city . ', ' . $address_state_details['state_name'] . ' - ' . $address_pin;
        $place_of_supply = $address_state_details['gst_code'] . ' - ' . $address_state_details['state_name'] . ' (' . $address_state_details['state_code'] . ')';

        $html = buildCustomerInvoicePDFFromHtml(
            prepareCustomerInvoiceData($invoice_id, $invoice_number, $invoice_date, $due_date, $customer_name, $gst, $customer_address, $place_of_supply, $adjustment, $is_igst)
        );

        $pdf_path = generatePDF($html, $pdf_name, __DIR__ . "/../system_generated");

        // Update invoice with file and finalize flag
        $finalize_query = UPDATE('customer_invoices', [
            'invoice_file' => $pdf_name,
            'is_invoice_generated' => 1
        ], ['id' => $invoice_id]);
        $invoice_generated = runQuery($finalize_query);

        // get all new transaction ids to update the invoice
        $where_conditions = [];
        foreach ($transaction_ids as $transaction_id) {
            if ($transaction_id != 0) {
                $where_conditions[] = "`inventory_transactions`.`id` = $transaction_id";
            }
        }

        // create query and update
        $update_invoice_query = "";
        if (!empty($where_conditions)) {
            $where_clause = implode(" OR ", $where_conditions);
            $update_invoice_query = "UPDATE `inventory_transactions` SET `invoice` = '$pdf_name' WHERE $where_clause;";
            runQuery($update_invoice_query);
        }

        addNewAdminUpdate($updated_by, 'Invoice Details: <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/sales/?id=' . $invoice_id . '&view">View all details</a>! <a target="_blank" href="' . systemVariable('SITE_HOME') . 'system_generated/' . $pdf_name . '">View Invoice</a>!');

        $response['invoice_file'] = $pdf_name;
        $response['status'] = 'success';
        $response['message'] = 'Invoice generated successfully!';
        $response['q'] = $update_invoice_query;
        $response['tids'] = $transaction_ids;
    } else {
        $response['status'] = 'success';
        $response['message'] = 'Sale saved as draft.';
    }

    return $response;
}


function add_new_address_state($request)
{

    $category_name = addslashes($request['category_name']);
    $slug = addslashes($request['slug']);
    $color_code = addslashes($request['color_code']);
    $remarks = addslashes($request['remarks']);
    $updated_by = getIdFromUserid($request['updated_by']);

    // file upload section
    $category_image = upload_file('category_image');

    // upload profile image
    if ($category_image['status'] === 'success') {
        $category_image_url = $category_image['file_name'];
    } else if ($category_image['err_code'] == 'FILE_NOT_SELECTED') {
        $category_image_url = '';
    } else {
        $category_image_url = '';
        return ['status' => 'failed', 'message' => $category_image['message']];
    }

    // return $category_image_url;

    $response = array();

    $check_existence = WHERE('product_categories', 'slug', $slug);
    $check_existence = runQuery($check_existence);
    $check_existence = mysqli_num_rows($check_existence);

    if ($check_existence > 0) {
        $response['status'] = 'failed';
        $response['message'] = "Such Product Category already exists!";
    } else {

        $table = "product_categories";
        $columns_values = [
            "slug" => $slug,
            "category_name" => $category_name,
            "color_code" => $color_code,
            "category_image" => $category_image_url,
            "remarks" => $remarks,
            "created_by" => $updated_by,
            "updated_by" => $updated_by,
        ];

        $query = INSERT($table, $columns_values);

        $run_query = runQuery($query);


        if ($run_query == 1) {

            $query3 = WHERE('product_categories', 'slug', $slug);
            $run_query3 = runQuery($query3);
            $fetch3 = mysqli_fetch_assoc($run_query3);

            $update_text = 'Added a new address_state ' . $category_name . ' for the organization! Check out, how they have managed to do it! <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/product-categories?id=' . $fetch3['id'] . '&view">Check</a>';
            $admin_update = addNewAdminUpdate($updated_by, $update_text);

            $response['status'] = 'success';
            $response['message'] = "Published '$category_name' as a Product Category!";
            $response['id'] = $fetch3['id'];
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to publish Product Category!";
        }
    }

    return $response;
}

function update_address_state($request)
{
    $state_name = addslashes($request['state_name']);
    $state_code = $request['state_code'];
    $gst_code = $request['gst_code'];
    $remarks = addslashes($request['remarks']);

    $state_code_available = check_availability(
        ['table' => 'address_states', 'column' => 'state_code', 'value' => $state_code]
    );
    $gst_code_available = check_availability(
        ['table' => 'address_states', 'column' => 'gst_code', 'value' => $gst_code]
    );

    $updated_by = getIdFromUserid($request['updated_by']);

    $id = $request['id'];

    // Default to existing values
    $existing = WHERE('address_states', 'id', $id);
    $existing = runQuery($existing);
    $existing = mysqli_fetch_assoc($existing);

    $response = array();

    $check_existence = getProductCategoryById($id);

    if (mysqli_num_rows($check_existence) > 0) {

        $columns_values = [
            "state_name" => $state_name,
            "state_code" => $state_code,
            "gst_code" => $gst_code,
            "remarks" => $remarks,
            "updated_by" => $updated_by
        ];

        $where_conditions = [
            "id" => $id
        ];

        $query = UPDATE('address_states', $columns_values, $where_conditions);


        $run_query = runQuery($query);

        if ($run_query == 1) {

            addNewAdminUpdate($updated_by, 'Updated details for the Address State "' . $state_name . '". <a target="_blank" href="' . systemVariable('SITE_HOME') . 'admin/address-states/?id=' . $id . '">View all details</a>!');

            $response['status'] = 'success';
            $response['message'] = "Address State updated Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to update Address State!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Address State Found!";
    }

    return $response;
}

function send_address_state_to_trash($request)
{
    $address_state_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getProductCategoryById($address_state_id)) > 0) {
        $query = "UPDATE `product_categories` SET `is_active` = 0, `updated_by` = '$updated_by' WHERE `product_categories`.`id` = $address_state_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $address_state = getProductCategoryById($address_state_id);
            $address_state = mysqli_fetch_assoc($address_state);
            $address_state_name = $address_state['category_name'];

            addNewAdminUpdate($updated_by, 'Trashed "' . $address_state_name . '" Product Category!');

            $response['status'] = 'success';
            $response['message'] = "Product Category trashed Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to trash Product Category!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Product Category Found!";
    }
    return $response;
}

function restore_address_state_from_trash($request)
{
    $address_state_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getProductCategoryById($address_state_id)) > 0) {
        $query = "UPDATE `product_categories` SET `is_active` = 1, `updated_by` = '$updated_by' WHERE `product_categories`.`id` = $address_state_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $address_state = getProductCategoryById($address_state_id);
            $address_state = mysqli_fetch_assoc($address_state);
            $address_state_name = $address_state['category_name'];

            addNewAdminUpdate($updated_by, 'Restored "' . $address_state_name . '" Product Category!');

            $response['status'] = 'success';
            $response['message'] = "Product Category restored Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to restore Product Category!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Product Category found!";
    }
    return $response;
}

function delete_address_state($request)
{
    $address_state_id = $request['id'];
    $updated_by = $request['updated_by'];
    $updated_by = getIdFromUserid($updated_by);

    if (mysqli_num_rows(getProductCategoryById($address_state_id)) > 0) {
        $query = "UPDATE `product_categories` SET `is_deleted` = 1, `updated_by` = '$updated_by' WHERE `product_categories`.`id` = $address_state_id;";
        $run_query = runQuery($query);

        if ($run_query == 1) {

            $address_state = getProductCategoryById($address_state_id);
            $address_state = mysqli_fetch_assoc($address_state);
            $address_state_name = $address_state['category_name'];

            addNewAdminUpdate($updated_by, 'Permanently Deleted "' . $address_state_name . '" Product Category for the address_state!');

            $response['status'] = 'success';
            $response['message'] = "Product Category deleted Successfully!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Unable to delete Product Category!";
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = "No such Product Category Found!";
    }
    return $response;
}