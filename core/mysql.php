<?php

if (!defined('SITE_HOME')) {
    define('SITE_HOME', systemVariable('SITE_HOME'));
}

if (!defined('SITE_DIR')) {
    define('SITE_DIR', systemVariable('SITE_DIR'));
}

function get_conn()
{
    require_once __DIR__ . '/../config/config.php';

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('Error connecting to MySQL server.');

    mysqli_select_db($conn, DB) or die('Error selecting database.');

    return $conn;
}

function SELECT($table_name)
{
    $query = "SELECT * FROM $table_name";
    return $query;
}

function DELETE($table_name, $where_conditions, $operator = "AND")
{
    // Create the WHERE clause
    $where_clause = [];
    foreach ($where_conditions as $column => $value) {
        $where_clause[] = "$column = '" . $value . "'";
    }
    $where_clause_string = implode(" $operator ", $where_clause);

    // Construct the DELETE query
    $query = "DELETE FROM `$table_name` WHERE $where_clause_string";

    return $query;
}


function WHERE($table_name, $column_name, $value)
{

    $query = SELECT($table_name) . " WHERE `$table_name`.`$column_name` = '$value'";

    return $query;
}

function WHEREm($table_name, $conditions, $operator = "AND")
{
    // example usage
    // $conditions = [
    //     "id" => 1,
    //     "status" => 1
    // ];

    // $where_clause = WHERE($conditions);

    // echo "SELECT * FROM users WHERE $where_clause";  

    // Create the conditions string with the specified operator (AND/OR)
    $query = SELECT($table_name);
    $where_clause = [];
    foreach ($conditions as $column => $value) {
        $where_clause[] = "$column = '" . $value . "'";
    }
    $where_clause_string = implode(" $operator ", $where_clause);

    return $query." WHERE ".$where_clause_string;
}


function INSERT($table_name, $columns_values)
{
    // Get the column names (keys from the array)
    $columns = implode(", ", array_keys($columns_values));

    // Get the values (escaped to ensure proper formatting and safety for SQL injection)
    $values = "'" . implode("', '", array_values($columns_values)) . "'";

    // Construct the full query
    $query = "INSERT INTO $table_name ($columns) VALUES ($values)";

    return $query;
}

function INSERT_escape_string($table_name, $columns_values)
{
    $conn = get_conn(); // get the DB connection for escaping

    // Escape each value
    $escaped_values = array_map(function($value) use ($conn) {
        return mysqli_real_escape_string($conn, $value);
    }, array_values($columns_values));

    // Wrap each escaped value in quotes
    $quoted_values = array_map(function($value) {
        return "'" . $value . "'";
    }, $escaped_values);

    // Join columns and values
    $columns = implode(", ", array_keys($columns_values));
    $values = implode(", ", $quoted_values);

    $query = "INSERT INTO $table_name ($columns) VALUES ($values)";

    return $query;
}


function UPDATE($table_name, $columns_values, $where_conditions, $operator = "AND")
{

    // example usage
    // $table = "users";
    // $columns_values = [
    //     "name" => "John Doe",
    //     "email" => "john.doe@example.com"
    // ];
    // $where_conditions = [
    //     "id" => 1
    // ];

    // $query = UPDATE($table, $columns_values, $where_conditions, "OR");

    // echo $query;

    // Create the column-value pairs for the SET clause
    $set_clause = [];
    foreach ($columns_values as $column => $value) {
        $set_clause[] = "$column = '" . $value . "'";
    }
    $set_clause_string = implode(", ", $set_clause);

    // Create the conditions for the WHERE clause
    $where_clause = [];
    foreach ($where_conditions as $column => $value) {
        $where_clause[] = "$column = '" . $value . "'";
    }
    $where_clause_string = implode(" $operator ", $where_clause);

    // Construct the full query
    $query = "UPDATE $table_name SET $set_clause_string WHERE $where_clause_string";

    return $query;
}


function runQuery($query, $last_insert_return = false)
{
    $conn = get_conn();

    $run_query = mysqli_query($conn, $query);

    if($last_insert_return){
        return mysqli_insert_id($conn);
    }

    return $run_query;
}

function systemVariable($variable_name)
{
    // $query = "SELECT * FROM `system` WHERE `system`.`variable` = '$variable_name'";
    $query = WHERE('systemv', 'variable', $variable_name);
    $run_query = runQuery($query);
    $fetch = mysqli_fetch_assoc($run_query);
    return $fetch['value'];
}

function fetchAsArray($mysqliResult) {
    $data = [];
    if ($mysqliResult && mysqli_num_rows($mysqliResult) > 0) {
        while ($row = mysqli_fetch_assoc($mysqliResult)) {
            $row['updated_by'] = getUseridById($row['updated_by']); // convert to username
            $row['updated_at'] = formatDateTime($row['updated_at']); // pretty format
            $data[] = $row;
        }
    }
    return $data;
}

/**
 * Get the next ID for a given table and ID column.
 * @param string $table_name The name of the table.
 * @param string $id_column The name of the ID column.
 * @return int The next ID value.
 * Usage: $next_id = nextId('users', 'id');
 */
function nextId($table_name, $id_column){
    $query = "SELECT * FROM $table_name ORDER BY id DESC LIMIT 1;";
    $run_query = runQuery($query);
    $row = mysqli_fetch_assoc($run_query);
    $last_id = $row[$id_column];
    $next_id = $last_id + 1;
    return $next_id;
}

/**
 * Safely returns a value or a fallback if the value is empty or just whitespace.
 * @param mixed $val The value to check and return.
 * @param string $fallback The fallback value to return if $val is empty or just whitespace. Default is 'N/A'.
 * @return mixed The original value if it's non-empty, otherwise the fallback value.
 * @Usage 1: $safe_value = safeValue($input_value);
 * @Usage 2: $safe_value = safeValue($input_value, 'Default Value');
 */
function safeValue($val, $fallback = 'N/A')
{
    // Check if the value is non-empty and trim any extra spaces
    if (!empty($val) && trim($val) !== '') {
        // If it's a string, escape special characters like single quotes
        if (is_string($val)) {
            // Escape special characters for use in an SQL query (assuming you're using mysqli)
            $val = mysqli_real_escape_string(get_conn(), $val);
        }
        return $val;
    }
    
    // If value is empty or just whitespace, return the fallback value
    return $fallback;
}





































/*******************************************************Admin***********************************************************************/
// function adminVariable($variable_name)
// {
//     // if (session_status() === PHP_SESSION_NONE) {
//     //     session_start();
//     // }
//     $query = WHERE('admins', 'user_auth', $_SESSION[USER_GLOBAL_AUTH]);
//     $run_query = runQuery($query);
//     $fetch = mysqli_fetch_assoc($run_query);
//     return $fetch[$variable_name];
// }

// function getAllAdmins()
// {
//     $admins = WHERE('admins', 'is_deleted', 0);
//     $run_query = runQuery($admins);
//     return $run_query;
// }

// function getAdminFullDetails($user_auth)
// {
//     $admin = WHERE('admins', 'user_auth', $user_auth);
//     $admin = runQuery($admin);
//     if (mysqli_num_rows($admin) > 0) {
//         $admin = mysqli_fetch_assoc($admin);
//         unset($admin['password']);
//         unset($admin['def_pass']);
//         $admin['admin_found'] = true;
//     } else {
//         $admin = array(
//             "admin_found" => false
//         );
//     }

//     return $admin;
// }

// function getAdminByUserAuth($user_auth)
// {
//     $admin = WHERE('admins', 'user_auth', $user_auth);
//     $admin = runQuery($admin);
//     return $admin;
// }

// function getAdminById($admin_id)
// {
//     $admin = WHERE('admins', 'admin_id', $admin_id);
//     $admin = runQuery($admin);
//     return $admin;
// }

// function addNewAdmin($admin_name, $user_auth, $admin_email, $password, $admin_image, $updated_by)
// {
//     $password = password_hash($password, PASSWORD_DEFAULT);
//     if ($admin_image == '') {
//         $admin_image = "https://lyncdigit.com/wp-content/uploads/2021/11/logo-icon-png-300x300.png";
//     }
//     $query = "INSERT INTO `admins` (`user_auth`, `admin_name`, `admin_email`, `admin_image`, `password`, `updated_by`) VALUES ('$user_auth', '$admin_name', '$admin_email', '$admin_image', '$password', '$updated_by');";
//     $run_query = runQuery($query);

//     addNewAdminUpdate($updated_by, ' Appointed <a href="' . ___ADMIN_DIR___ . 'profile/?admin=' . $user_auth . '">' . $user_auth . '</a> as the new admin to the site.');

//     return $run_query;
// }

// function updateAdminFullDetails($admin_name, $email, $password, $admin_image, $updated_by)
// {
//     if (trim($password) != '') {
//         $password = password_hash($password, PASSWORD_DEFAULT);
//         $query = "UPDATE `admins` SET `admin_name` = '$admin_name', `admin_email` = '$email', `password` = '$password', `admin_image` = '$admin_image', `updated_by` = '$updated_by' WHERE `admins`.`user_auth` = '$updated_by';";
//     } else {
//         $query = "UPDATE `admins` SET `admin_name` = '$admin_name', `admin_email` = '$email', `admin_image` = '$admin_image', `updated_by` = '$updated_by' WHERE `admins`.`user_auth` = '$updated_by';";
//     }
//     addNewAdminUpdate($updated_by, 'Updated their Profile!');
//     $run_query = runQuery($query);
//     return $run_query;
// }

// function updatesystemVariable($variable_name, $variable_value, $current_admin)
// {

//     $current_system_variable_value = systemVariable($variable_name);

//     if ($current_system_variable_value != $variable_value) {
//         addNewAdminUpdate($current_admin, 'Updated the Site General Settings. They have changed the ' . $variable_name . ' from "' . systemVariable($variable_name) . '" to "' . $variable_value . '"');
//     }

//     $query = "UPDATE `systemv` SET `value` = '$variable_value' WHERE `systemv`.`variable` = '$variable_name';";
//     $run_query = runQuery($query);
//     return $run_query;
// }

// function updatesystemVariables($list_of_variables, $current_admin)
// {

//     foreach ($list_of_variables as $key => $value) {
//         updatesystemVariable($key, $value, $current_admin);
//     }
// }

// function getLatestAdminUpdates($count = 'all')
// {
//     if ($count == 'all') {
//         $query = "SELECT * FROM `admin_updates` ORDER BY `admin_updates`.`id` DESC;";
//     } else {
//         $query = "SELECT * FROM `admin_updates` ORDER BY `admin_updates`.`id` DESC LIMIT $count;";
//     }
//     $run_query = runQuery($query);
//     return $run_query;
// }

// function addNewAdminUpdate($udpated_by, $update_text)
// {
//     $query = "INSERT INTO `admin_updates` (`udpated_by`, `update_text`) VALUES ('$udpated_by', '$update_text');";
//     $run_query = runQuery($query);
//     return $run_query;
// }

// function getActiveCandidatesCount()
// {

//     $query = WHERE('candidates', 'status', 1);
//     $run = runQuery($query);
//     $count = mysqli_num_rows($run);

//     // Get the current week's count
//     $queryCurrentWeek = "SELECT COUNT(*) AS current_count FROM candidates WHERE `status` = 1 AND WEEK(`created_at`) = WEEK(NOW())";
//     $runCurrentWeek = runQuery($queryCurrentWeek);
//     $currentWeekData = mysqli_fetch_assoc($runCurrentWeek);
//     $currentCount = (int)$currentWeekData['current_count'];

//     // Get the last week's count
//     $queryLastWeek = "SELECT COUNT(*) AS last_count FROM candidates WHERE `status` = 1 AND YEAR(`created_at`) = YEAR(NOW()) AND WEEK(`created_at`) = WEEK(NOW()) - 1;";
//     $runLastWeek = runQuery($queryLastWeek);
//     $lastWeekData = mysqli_fetch_assoc($runLastWeek);
//     $lastCount = (int)$lastWeekData['last_count'];

//     // Calculate the percentage change
//     if ($lastCount > 0) {
//         $percentageChange = (($currentCount - $lastCount) / $lastCount) * 100;
//     } else {
//         // If there were no candidates last week, percentage change is 100% for any new count
//         $percentageChange = $currentCount > 0 ? 100 : 0;
//     }

//     // Return both the current count and the percentage change
//     return [
//         'current_count' => $count,
//         'percentage_change' => round($percentageChange, 2) // Round to two decimal places
//     ];
// }


// function get3AboveAverageRating()
// {
//     // Define the SQL query to count rows with average above 3
//     $query = "SELECT COUNT(*) AS count_above_3 FROM candidates WHERE (behaviour_satisfaction + joining_confidence) / 2 > 3;";
//     $run = runQuery($query);
//     $row = $run->fetch_assoc(); 

//     $queryCurrentWeek = "SELECT COUNT(*) AS current_count FROM candidates WHERE (behaviour_satisfaction + joining_confidence) / 2 > 3 AND WEEK(`created_at`) = WEEK(NOW())";
//     $runCurrentWeek = runQuery($queryCurrentWeek);
//     $currentWeekData = mysqli_fetch_assoc($runCurrentWeek);
//     $currentCount = (int)$currentWeekData['current_count'];

//     // Get the last week's count
//     $queryLastWeek = "SELECT COUNT(*) AS last_count FROM candidates WHERE (behaviour_satisfaction + joining_confidence) / 2 > 3 AND YEAR(`created_at`) = YEAR(NOW()) AND WEEK(`created_at`) = WEEK(NOW()) - 1;";
//     $runLastWeek = runQuery($queryLastWeek);
//     $lastWeekData = mysqli_fetch_assoc($runLastWeek);
//     $lastCount = (int)$lastWeekData['last_count'];

//     // Calculate the percentage change
//     if ($lastCount > 0) {
//         $percentageChange = (($currentCount - $lastCount) / $lastCount) * 100;
//     } else {
//         // If there were no candidates last week, percentage change is 100% for any new count
//         $percentageChange = $currentCount > 0 ? 100 : 0;
//     }

//     // Return both the current count and the percentage change
//     return [
//         'current_count' => (int) $row['count_above_3'],
//         'percentage_change' => round($percentageChange, 2) // Round to two decimal places
//     ];
// }

// function getRelieverCandidatesCount()
// {
//     $query = WHERE('candidates', 'reliever', 1);
//     $run = runQuery($query);
//     $count = mysqli_num_rows($run);
    
//     $queryCurrentWeek = "SELECT COUNT(*) AS current_count FROM candidates WHERE `reliever` = 1 AND `status` = 1 AND WEEK(`created_at`) = WEEK(NOW())";
//     $runCurrentWeek = runQuery($queryCurrentWeek);
//     $currentWeekData = mysqli_fetch_assoc($runCurrentWeek);
//     $currentCount = (int)$currentWeekData['current_count'];

//     // Get the last week's count
//     $queryLastWeek = "SELECT COUNT(*) AS last_count FROM candidates WHERE `reliever` = 1 AND `status` = 1 AND WEEK(`created_at`) = WEEK(NOW()) - 1;";
//     $runLastWeek = runQuery($queryLastWeek);
//     $lastWeekData = mysqli_fetch_assoc($runLastWeek);
//     $lastCount = (int)$lastWeekData['last_count'];

//     // Calculate the percentage change
//     if ($lastCount > 0) {
//         $percentageChange = (($currentCount - $lastCount) / $lastCount) * 100;
//     } else {
//         // If there were no candidates last week, percentage change is 100% for any new count
//         $percentageChange = $currentCount > 0 ? 100 : 0;
//     }

//     // Return both the current count and the percentage change
//     return [
//         'current_count' => $count,
//         'percentage_change' => round($percentageChange, 2) // Round to two decimal places
//     ];
// }


// function getTotalCandidatesCount()
// {

//     $query = SELECT('candidates');
//     $run = runQuery($query);
//     $count = mysqli_num_rows($run);

//     // Get the current week's count
//     $queryCurrentWeek = "SELECT COUNT(*) AS current_count FROM candidates WHERE WEEK(`created_at`) = WEEK(NOW())";
//     $runCurrentWeek = runQuery($queryCurrentWeek);
//     $currentWeekData = mysqli_fetch_assoc($runCurrentWeek);
//     $currentCount = (int)$currentWeekData['current_count'];

//     // Get the last week's count
//     $queryLastWeek = "SELECT COUNT(*) AS last_count FROM candidates WHERE WEEK(`created_at`) = WEEK(NOW()) - 1;";
//     $runLastWeek = runQuery($queryLastWeek);
//     $lastWeekData = mysqli_fetch_assoc($runLastWeek);
//     $lastCount = (int)$lastWeekData['last_count'];

//     // Calculate the percentage change
//     if ($lastCount > 0) {
//         $percentageChange = (($currentCount - $lastCount) / $lastCount) * 100;
//     } else {
//         // If there were no candidates last week, percentage change is 100% for any new count
//         $percentageChange = $currentCount > 0 ? 100 : 0;
//     }

//     // Return both the current count and the percentage change
//     return [
//         'current_count' => $count,
//         'percentage_change' => round($percentageChange, 2) // Round to two decimal places
//     ];
// }


// function getDesignationsList()
// {
//     $query = WHERE('designations', 'status', 1);
//     $run = runQuery($query);
//     return $run;
// }

// function getCityListFrom($table_name)
// {
//     $query = WHERE('candidates', 'status', 1);
//     $run = runQuery($query);
//     return $run;
// }

// function getCandidate($id)
// {
//     $query = WHERE('candidates', 'id', $id);
//     $run = runQuery($query);
//     $fetch = mysqli_fetch_assoc($run);
//     return $fetch;
// }

// function getDesignation($id)
// {
//     $query = WHERE('designations', 'id', $id);
//     $run = runQuery($query);
//     $fetch = mysqli_fetch_assoc($run);
//     return $fetch;
// }

// function getDesignationName($id)
// {
//     $fetch = getDesignation($id);
//     return $fetch['designation'];
// }

// function getActivityTimeline($activity_column, $value){
//     $query = WHERE('activity_tracker', $activity_column, $value)." ORDER BY `created_at` DESC";
//     $run = runQuery($query);
//     return $run;
// }

// function getDocument($related_table, $related_id, $meta_name){
//     $conditions = [
//             "related_table" => $related_table,
//             "related_id" => $related_id,
//             "meta_name" => $meta_name,
//             "status" => 1,
//         ];
//     $query = WHEREm('documents', $conditions);
//     $run = runQuery($query);
//     $fetch = mysqli_fetch_assoc($run);
//     return $fetch;
// }

// function getDocuments($related_table, $related_id, $activity_id){
//     $conditions = [
//             "related_table" => $related_table,
//             "related_id" => $related_id,
//             "activity_id" => $activity_id,
//             "status" => 1,
//         ];
//     $query = WHEREm('documents', $conditions);
//     $run = runQuery($query);
//     return $run;
// }

// function insertDocument($related_table, $related_id, $activity_id, $link, $name, $meta_name, $remarks, $admin){

//     $document = array(
//         'related_table' => $related_table,
//         'related_id' => $related_id,
//         'activity_id' => $activity_id,
//         'link' => $link,
//         'name' => $name,
//         'meta_name' => $meta_name,
//         'status' => 1,
//         'remarks' => $remarks,
//         'created_by' => $admin,
//         'updated_by' => $admin
//     );

//     $query = INSERT('documents', $document);
//     $run = runQuery($query);

//     return $run;
// }

// function addActivity($activity_type, $meta_name, $description, $related_table, $related_id, $admin){

//     $document = array(
//         'activity_type' => $activity_type,
//         'meta_name' => $meta_name,
//         'description' => $description,
//         'related_table' => $related_table,
//         'related_id' => $related_id,
//         'created_by' => $admin
//     );

//     $query = INSERT('activity_tracker', $document);
//     $run = runQuery($query, true);

//     return $run;
// }