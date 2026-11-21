<?php

$user_group_options = getUserGroupOptions();
$user_designation_options = getUserDesignationOptions();
$treatment_site_options = getTreatmentSiteOptions();
$address_states_options = getAddressStatesOptions();

// get user designation
$user_designation_id = $user['user_designation'];
$user_designation_err_msg = '';

if (!empty($user_designation_id)) {
    $designation_res = getUserDesignationById($user_designation_id);
    $designation_data = mysqli_fetch_assoc($designation_res);

    if ($designation_data) {
        if ($designation_data['is_deleted']) {
            $user_designation_err_msg = 'This User belongs to Designation "' . $designation_data['designation_name'] . '", which has been deleted.';
        } elseif (!$designation_data['is_active']) {
            $user_designation_err_msg = 'This User belongs to Designation "' . $designation_data['designation_name'] . '", which has been deactivated.';
        }
    } else {
        $user_designation_err_msg = 'This User has an invalid Designation (not found).';
    }
} else {
    $user_designation_err_msg = "This User has not been assigned a Designation.";
}

// get user group
$user_group_id = $user['user_group'];
$user_group_err_msg = '';

if (!empty($user_group_id)) {
    $group_res = getUserGroupById($user_group_id);
    $group_data = mysqli_fetch_assoc($group_res);

    if ($group_data) {
        if ($group_data['is_deleted']) {
            $user_group_err_msg = 'This User belongs to Group "' . $group_data['group_name'] . '", which has been deleted.';
        } elseif (!$group_data['is_active']) {
            $user_group_err_msg = 'This User belongs to Group "' . $group_data['group_name'] . '", which has been deactivated.';
        }
    } else {
        $user_group_err_msg = 'This User has an invalid Group (not found).';
    }
} else {
    $user_group_err_msg = "This User has not been assigned a Group.";
}

// get treatment site
$treatment_site_id = $user['treatment_site'];
$treatment_site_err_msg = '';

if (!empty($treatment_site_id)) {
    $site_res = getSiteById($treatment_site_id);
    $site_data = mysqli_fetch_assoc($site_res);

    if ($site_data) {
        if ($site_data['is_deleted']) {
            $treatment_site_err_msg = 'This User belongs to Site "' . $site_data['site_name'] . '", which has been deleted.';
        } elseif (!$site_data['is_active']) {
            $treatment_site_err_msg = 'This User belongs to Site "' . $site_data['site_name'] . '", which has been deactivated.';
        }
    } else {
        $treatment_site_err_msg = 'This User has an invalid Site (not found).';
    }
} else {
    $treatment_site_err_msg = "This User has not been assigned a Site.";
}

$error_messages = [
    $user_designation_err_msg,
    $user_group_err_msg,
    $treatment_site_err_msg
];
?>

<div id="user-details">
    <div class="m-4 mb-0">
        <?php foreach ($error_messages as $msg): ?>
            <?php if ($msg != ''): ?>
                <div class="alert alert-danger mb-2" role="alert">
                    <i class="text-danger fas fa-exclamation-triangle"></i> <?= $msg ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>


    <div class="bs-stepper wizard-icons wizard-icons-example mt-2">
        <div class="bs-stepper-header">
            <div class="step active" data-target="#account-details">
                <button type="button" class="step-trigger" aria-selected="true" disabled>
                    <span class="bs-stepper-icon">
                        <svg viewBox="0 0 54 54">
                            <use xlink:href="<?= SITE_URL ?>assets/svg/icons/form-wizard-account.svg#wizardAccount"></use>
                        </svg>
                    </span>
                    <span class="bs-stepper-label">Personal Details</span>
                </button>
            </div>
            <div class="line">
                <i class="icon-base bx bx-right-arrow-alt icon-md scaleX-n1-rtl"></i>
            </div>
            <div class="step" data-target="#personal-info">
                <button type="button" class="step-trigger" aria-selected="false" disabled>
                    <span class="bs-stepper-icon">
                        <svg viewBox="0 0 58 54">
                            <use xlink:href="<?= SITE_URL ?>assets/svg/icons/form-wizard-personal.svg#wizardPersonal"></use>
                        </svg>
                    </span>
                    <span class="bs-stepper-label">Account Config</span>
                </button>
            </div>
            <div class="line">
                <i class="icon-base bx bx-right-arrow-alt icon-md scaleX-n1-rtl"></i>
            </div>
            <div class="step" data-target="#address-sec">
                <button type="button" class="step-trigger" aria-selected="false" disabled>
                    <span class="bs-stepper-icon">
                        <svg viewBox="0 0 54 54">
                            <use xlink:href="<?= SITE_URL ?>assets/svg/icons/form-wizard-address.svg#wizardAddress"></use>
                        </svg>
                    </span>
                    <span class="bs-stepper-label">Contact Details</span>
                </button>
            </div>
            <div class="line">
                <i class="icon-base bx bx-right-arrow-alt icon-md scaleX-n1-rtl"></i>
            </div>
            <div class="step" data-target="#social-links">
                <button type="button" class="step-trigger" aria-selected="false" disabled>
                    <span class="bs-stepper-icon">
                        <svg viewBox="0 0 54 54">
                            <use xlink:href="<?= SITE_URL ?>assets/svg/icons/form-wizard-social-link.svg#wizardSocialLink"></use>
                        </svg>
                    </span>
                    <span class="bs-stepper-label">Documents & Social</span>
                </button>
            </div>
            <div class="line">
                <i class="icon-base bx bx-right-arrow-alt icon-md scaleX-n1-rtl"></i>
            </div>
            <div class="step" data-target="#review-submit">
                <button type="button" class="step-trigger" aria-selected="false" disabled>
                    <span class="bs-stepper-icon">
                        <svg viewBox="0 0 54 54">
                            <use xlink:href="<?= SITE_URL ?>assets/svg/icons/form-wizard-submit.svg#wizardSubmit"></use>
                        </svg>
                    </span>
                    <span class="bs-stepper-label">Review &amp; Submit</span>
                </button>
            </div>
        </div>


        <div class="bs-stepper-content">

            <!-- Account Details -->
            <div id="account-details" class="content active dstepper-block">
                <div class="content-header mb-4">
                    <h6 class="mb-0">Personal Details</h6>
                    <small>Enter Your Personal & Account Details.</small>
                </div>
                <div class="row g-6">
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="<?= $user['first_name'] ?>" value="<?= $user['first_name'] ?>" disabled>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="<?= $user['last_name'] ?>" value="<?= $user['last_name'] ?>" aria-label="Last Name" disabled>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="aadhaar_no">Aadhaar No</label>
                        <input type="number" id="aadhaar_no" name="aadhaar_no" class="form-control" placeholder="<?= $user['aadhaar_no'] ?>" value="<?= $user['aadhaar_no'] ?>" disabled>
                        <div class="text-danger mt-1" style="display: none;" id="aadhaar_error">Aadhaar No already exists. Please try another!!</div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="pan_no">PAN No</label>
                        <input type="text" id="pan_no" name="pan_no" class="form-control" placeholder="<?= $user['pan_no'] ?>" value="<?= $user['pan_no'] ?>" aria-label="PAN No" disabled>
                        <div class="text-danger mt-1" style="display: none;" id="pan_error">PAN No already exists. Please try another!!</div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="userid">UserId</label>
                        <input type="text" id="userid" name="userid" class="form-control" placeholder="<?= $user['userid'] ?>" value="<?= $user['userid'] ?>" disabled>
                        <div class="text-danger mt-1" style="display: none;" id="userid_error">UserId is not available. Please try another!!</div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="<?= $user['email'] ?>" value="<?= $user['email'] ?>" aria-label="Email" disabled>
                        <div class="text-danger mt-1" style="display: none;" id="email_error">Email Id already exists. Please try another!!</div>
                    </div>

                    <div class="col-12 my-3">
                        <p class="text-info text-justify">* Please Note that details like <strong><i>Aadhaar No, PAN No, Userid &amp; Email</i></strong> cannot be changed once it is created!</p>
                    </div>

                    <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-label-secondary btn-prev" type="button" disabled="">
                            <i class="icon-base bx bx-left-arrow-alt scaleX-n1-rtl icon-sm ms-sm-n2 me-sm-2"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>

                        <button type="button" class="btn btn-info" onclick="window.location.href='./'">Go Back</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='./?id=<?= $user_id ?>'">Edit</button>

                        <!-- trigger button -->
                        <button class="btn btn-primary btn-next" id="goto-p2" type="button">
                            <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span>
                            <i class="icon-base bx bx-right-arrow-alt icon-sm scaleX-n1-rtl me-sm-n2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Personal Info -->
            <div id="personal-info" class="content">
                <div class="content-header mb-4">
                    <h6 class="mb-0">Account Configuration</h6>
                    <small>Enter Account Configuration & Permission Details</small>
                </div>
                <div class="row g-6">

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="user_designation">User Designation</label>
                        <select name="user_designation" id="user_designation" class="form-control" disabled>
                            <?php
                            if (mysqli_num_rows($user_designation_options) > 0) {
                                echo '<option selected disabled>Select User Designation</option>';
                                while ($row = mysqli_fetch_assoc($user_designation_options)) {

                                    // select the user designation in ui from db
                                    $selected_user_designation = $user['user_designation'] == $row['id'] ? 'selected' : '';

                                    echo '<option data-user-group="' . $row['default_user_group'] . '" value="' . $row['id'] . '" ' . $selected_user_designation . '>' . $row['designation_name'] . ' (' . $row['default_honorifics'] . ')' . '</option>';
                                }
                            } else {
                                echo '<option disabled>No User Designations Available</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="user_group">User Group</label>
                        <select name="user_group" id="user_group" class="form-control" disabled>
                            <?php
                            if (mysqli_num_rows($user_group_options) > 0) {
                                echo '<option selected disabled>Select User Group</option>';
                                while ($row = mysqli_fetch_assoc($user_group_options)) {

                                    // ignore if super user group
                                    if ($row['is_super_admin'] == 1) continue;

                                    // select the user group in ui from db
                                    $selected_user_group = $user['user_group'] == $row['id'] ? 'selected' : '';

                                    echo '<option value="' . $row['id'] . '" ' . $selected_user_group . '>' . $row['group_name'] . '</option>';
                                }
                            } else {
                                echo '<option disabled>No User Groups Available</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="treatment_site">Treatment Site</label>
                        <select name="treatment_site" id="treatment_site" class="form-control" disabled>
                            <?php
                            if (mysqli_num_rows($treatment_site_options) > 0) {
                                echo '<option selected disabled>Select Treatment Site</option>';
                                while ($row = mysqli_fetch_assoc($treatment_site_options)) {

                                    // select the user site in ui from db
                                    $selected_treatment_site = $user['treatment_site'] == $row['id'] ? 'selected' : '';

                                    $state = getAddressStateById($row['id']);
                                    $state_name = $state['state_name'];
                                    echo '<option value="' . $row['id'] . '" ' . $selected_treatment_site . '>' . $row['site_name'] . ' ( ' . $row['site_id'] . ') - ' . $state_name . '</option>';
                                }
                            } else {
                                echo '<option disabled>No Treatment Sites Available</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <hr>

                    <h3>User Privileged Permissions</h3>

                    <div class="col-12 mb-3">

                        <div class="table-responsive text-nowrap">
                            <div class="form-check">
                                <input class="form-check-input" id="select-all-permissions" type="checkbox" disabled>
                                <label class="form-check-label" for="select-all-permissions"> Select / Deselect All Permissions </label>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Permission Name</th>
                                        <th class="text-center" data-orderable="false">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input select-column" data-column="view" data-bs-toggle="tooltip"
                                                    data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    aria-label="This permission allows this user over the group to view everything."
                                                    data-bs-original-title="This permission allows this user over the group to view everything."
                                                    id="view-all" disabled>
                                                <label for="view-all" class="form-check-label">View</label>
                                            </div>
                                        </th>
                                        <th class="text-center" data-orderable="false">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input select-column" data-column="create" data-bs-toggle="tooltip"
                                                    data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    aria-label="This permission allows this user over the group to create everything."
                                                    data-bs-original-title="This permission allows this user over the group to create everything."
                                                    id="create-all" disabled>
                                                <label for="create-all" class="form-check-label">Create</label>
                                            </div>
                                        </th>
                                        <th class="text-center" data-orderable="false">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input select-column" data-column="update" data-bs-toggle="tooltip"
                                                    data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    aria-label="This permission allows this user over the group to update everything."
                                                    data-bs-original-title="This permission allows this user over the group to update everything."
                                                    id="update-all" disabled>
                                                <label for="update-all" class="form-check-label">Update</label>
                                            </div>
                                        </th>
                                        <th class="text-center" data-orderable="false">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input select-column" data-column="delete" data-bs-toggle="tooltip"
                                                    data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    aria-label="This permission allows this user over the group to delete everything."
                                                    data-bs-original-title="This permission allows this user over the group to delete everything."
                                                    id="delete-all" disabled>
                                                <label for="delete-all" class="form-check-label">Delete</label>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $permissions = getPermissionsListWithUser($user['id']);
                                    $SL = 1;
                                    foreach ($permissions as $row):
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" id="permission-<?= $SL ?>" class="form-check-input select-row" title="<?= htmlspecialchars($row['name']) ?>" disabled>
                                                    <label for="permission-<?= $SL ?>" class="form-check-label"><?= htmlspecialchars($row['name']) ?></label>
                                                </div>
                                            </td>
                                            <?php foreach (['view', 'create', 'update', 'delete'] as $perm): ?>
                                                <td class="text-center">
                                                    <?php if ($row[$perm . '_id']): ?>
                                                        <input type="checkbox"
                                                            name="permissions[<?= $row['name'] ?>][]"
                                                            value="<?= $row[$perm . '_id'] ?>"
                                                            data-column="<?= $perm ?>"
                                                            class="form-check-input"
                                                            <?= $row['has_' . $perm] ? 'checked' : '' ?>
                                                            data-bs-toggle="tooltip"
                                                            data-popup="tooltip-custom"
                                                            data-bs-placement="top"
                                                            aria-label="<?= htmlspecialchars($row[$perm . '_desc']) ?>"
                                                            data-bs-original-title="<?= htmlspecialchars($row[$perm . '_desc']) ?>" disabled>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php
                                        $SL += 1;
                                    endforeach; ?>
                                </tbody>

                                <tfoot class="table-border-bottom-0">
                                    <tr>
                                        <th>Permission Name</th>
                                        <th class="text-center" data-orderable="false">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input select-column" data-column="view" data-bs-toggle="tooltip"
                                                    data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    aria-label="This permission allows this user over the group to view everything."
                                                    data-bs-original-title="This permission allows this user over the group to view everything."
                                                    id="view-all2" disabled>
                                                <label for="view-all2" class="form-check-label">View</label>
                                            </div>
                                        </th>
                                        <th class="text-center" data-orderable="false">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input select-column" data-column="create" data-bs-toggle="tooltip"
                                                    data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    aria-label="This permission allows this user over the group to create everything."
                                                    data-bs-original-title="This permission allows this user over the group to create everything."
                                                    id="create-all2" disabled>
                                                <label for="create-all2" class="form-check-label">Create</label>
                                            </div>
                                        </th>
                                        <th class="text-center" data-orderable="false">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input select-column" data-column="update" data-bs-toggle="tooltip"
                                                    data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    aria-label="This permission allows this user over the group to update everything."
                                                    data-bs-original-title="This permission allows this user over the group to update everything."
                                                    id="update-all2" disabled>
                                                <label for="update-all2" class="form-check-label">Update</label>
                                            </div>
                                        </th>
                                        <th class="text-center" data-orderable="false">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input select-column" data-column="delete" data-bs-toggle="tooltip"
                                                    data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    aria-label="This permission allows this user over the group to delete everything."
                                                    data-bs-original-title="This permission allows this user over the group to delete everything."
                                                    id="delete-all2" disabled>
                                                <label for="delete-all2" class="form-check-label">Delete</label>
                                            </div>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>


                            <div class="form-check">
                                <input class="form-check-input" id="select-all-permissions2" type="checkbox" disabled>
                                <label class="form-check-label" for="select-all-permissions2"> Select / Deselect All Permissions </label>
                            </div>
                        </div>

                    </div>


                    <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-primary btn-prev" type="button">
                            <i class="icon-base bx bx-left-arrow-alt scaleX-n1-rtl icon-sm ms-sm-n2 me-sm-2"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>

                        <button type="button" class="btn btn-info" onclick="window.location.href='./'">Go Back</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='./?id=<?= $user_id ?>'">Edit</button>

                        <button class="btn btn-primary btn-next" type="button">
                            <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span>
                            <i class="icon-base bx bx-right-arrow-alt icon-sm scaleX-n1-rtl me-sm-n2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Address -->
            <div id="address-sec" class="content">
                <div class="content-header mb-4">
                    <h6 class="mb-0">Contact Information</h6>
                    <small>Enter Your Contact Details.</small>
                </div>
                <div class="row g-6">

                    <div class="col-sm-12 mb-3">
                        <label class="form-label" for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="<?= $user['address'] ?>" value="<?= $user['address'] ?>" disabled>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="address_state">State Location</label>
                        <select class="form-control" name="address_state" id="address_state" disabled>
                            <!-- <option value="19">Odisha</option> -->
                            <?php
                            if (mysqli_num_rows($address_states_options) > 0) {
                                echo '<option selected disabled>Select Address State</option>';
                                while ($row = mysqli_fetch_assoc($address_states_options)) {

                                    // select the user designation in ui from db
                                    $selected_address_state = $user['address_state'] == $row['id'] ? 'selected' : '';

                            ?>
                                    <option value="<?= $row['id'] ?>" <?= $selected_address_state ?>><?= $row['state_name'] ?> (<?= $row['state_code'] ?>)</option>
                            <?php
                                }
                            } else {
                                echo '<option selected disabled>No States Available</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="address_city">City Location</label>
                        <input type="text" class="form-control" name="address_city" id="address_city" placeholder="<?= $user['address_city'] ?>" value="<?= $user['address_city'] ?>" disabled>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="address_pin">PIN Code</label>
                        <input type="number" class="form-control" id="address_pin" name="address_pin" placeholder="<?= $user['address_pin'] ?>" value="<?= $user['address_pin'] ?>" disabled>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="phone">Phone No</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="<?= $user['phone'] ?>" value="<?= $user['phone'] ?>" disabled>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="whatsapp_no">Whatsapp No</label>
                        <input type="text" class="form-control" id="whatsapp_no" name="whatsapp_no" placeholder="<?= $user['whatsapp_no'] ?>" value="<?= $user['whatsapp_no'] ?>" disabled>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="alt_phone">Alt. Phone No</label>
                        <input type="text" class="form-control" id="alt_phone" name="alt_phone" placeholder="<?= $user['alt_phone'] ?>" value="<?= $user['alt_phone'] ?>" disabled>
                    </div>

                    <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-primary btn-prev" type="button">
                            <i class="icon-base bx bx-left-arrow-alt scaleX-n1-rtl icon-sm ms-sm-n2 me-sm-2"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>

                        <button type="button" class="btn btn-info" onclick="window.location.href='./'">Go Back</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='./?id=<?= $user_id ?>'">Edit</button>

                        <button class="btn btn-primary btn-next" type="button">
                            <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span>
                            <i class="icon-base bx bx-right-arrow-alt scaleX-n1-rtl icon-sm me-sm-n2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Social Links -->
            <div id="social-links" class="content">
                <div class="content-header mb-4">
                    <h6 class="mb-0">Documents &amp; Social Links</h6>
                    <small>Enter Social Links.</small>
                </div>
                <div class="row g-6">
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="twitter_url">Twitter</label>
                        <input type="text" id="twitter_url" name="twitter_url" class="form-control" placeholder="<?= $user['twitter_url'] ?>" value="<?= $user['twitter_url'] ?>" disabled>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="facebook_url">Facebook</label>
                        <input type="text" id="facebook_url" name="facebook_url" class="form-control" placeholder="<?= $user['facebook_url'] ?>" value="<?= $user['facebook_url'] ?>" disabled>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="instagram_url">Instagram</label>
                        <input type="text" id="instagram_url" name="instagram_url" class="form-control" placeholder="<?= $user['instagram_url'] ?>" value="<?= $user['instagram_url'] ?>" disabled>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="linkedin_url">Linkedin</label>
                        <input type="text" id="linkedin_url" name="linkedin_url" class="form-control" placeholder="<?= $user['linkedin_url'] ?>" value="<?= $user['linkedin_url'] ?>" disabled>
                    </div>

                    <hr>

                    <div class="content-header mb-4">
                        <small>Upload Documents</small>
                    </div>

                    <div class="col-12 mb-3">
                        <img src="<?= systemVariable('SITE_HOME') ?>uploads/<?= $user['profile_image'] ?>" style="height: 100px; width: 100px; border-radius: 50%;" id="profile_image_display" alt="Profile Image">
                    </div>
                    <div class="col-6 mb-3">
                        <img src="<?= systemVariable('SITE_HOME') ?>uploads/<?= $user['aadhaar_image'] ?>" style="height: auto; width: 100%;" id="aadhaar_file_display" alt="Adhaar Image">
                    </div>
                    <div class="col-6 mb-3">
                        <img src="<?= systemVariable('SITE_HOME') ?>uploads/<?= $user['pan_image'] ?>" style="height: auto; width: 100%;" id="pan_file_display" alt="PAN Image">
                    </div>


                    <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-primary btn-prev" type="button">
                            <i class="icon-base bx bx-left-arrow-alt scaleX-n1-rtl icon-sm ms-sm-n2 me-sm-2"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>

                        <button type="reset" class="btn btn-dark">Reset</button>

                        <button type="button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>

                        <button class="btn btn-primary btn-next" id="next-to-review" type="button" style="display: none;">
                            <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span>
                            <i class="icon-base bx bx-right-arrow-alt scaleX-n1-rtl icon-sm me-sm-n2"></i>
                        </button>

                        <button class="btn btn-primary" type="button" onclick="go_to_review()">
                            <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span>
                            <i class="icon-base bx bx-right-arrow-alt icon-sm scaleX-n1-rtl me-sm-n2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Review -->
            <div id="review-submit" class="content">

                <div class="row g-6">
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">First Name</p>
                        <p id="first_name_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Last Name</p>
                        <p id="last_name_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Full Name</p>
                        <p id="full_name_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Aadhaar No</p>
                        <p id="aadhaar_no_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">PAN No</p>
                        <p id="pan_no_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Userid</p>
                        <p id="userid_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Email</p>
                        <p id="email_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Password</p>
                        <p>Your choosen password</p>
                    </div>
                    <hr>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">User Designation</p>
                        <p id="user_designation_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">User Group</p>
                        <p id="user_group_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Treatment Site</p>
                        <p id="treatment_site_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">User Privileged Permissions</p>
                        <p id="extra_perm_review"></p>
                    </div>
                    <hr>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Address</p>
                        <p id="address_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">State Location</p>
                        <p id="address_state_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">City Location</p>
                        <p id="address_city_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">PIN Code</p>
                        <p id="address_pin_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Phone No</p>
                        <p id="phone_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Whatsapp No</p>
                        <p id="whatsapp_no_review"></p>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Alt. Phone No</p>
                        <p id="alt_phone_review"></p>
                    </div>
                    <hr>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Twitter</p>
                        <a href="https://twitter.com/abc" target="_blank" id="twitter_url_review"></a>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Facebook</p>
                        <a href="https://facebook.com/abc" target="_blank" id="facebook_url_review"></a>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Instagram</p>
                        <a href="https://instagram.com/abc" target="_blank" id="instagram_url_review"></a>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <p class="form-label">Linkedin</p>
                        <a href="https://linkedin.com/in/abc" target="_blank" id="linkedin_url_review"></a>
                    </div>
                    <hr>
                    <div class="col-12 mb-3">
                        <label class="form-label" for="remarks">Remarks</label>
                        <textarea class="form-control" id="remarks" placeholder="<?= $user['remarks'] ?>" name="remarks" data-info="remarks" disabled><?= $user['remarks'] ?></textarea>
                    </div>

                    <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-primary btn-prev" type="button">
                            <i class="icon-base bx bx-left-arrow-alt scaleX-n1-rtl icon-sm ms-sm-n2 me-sm-2"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>

                        <button type="reset" class="btn btn-dark">Reset</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>

                        <button class="btn btn-success btn-submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>




<!-- script for page 5 when page 4 is submitted -->
<script>
    function go_to_review() {

        var field_ids = [
            'first_name', 'last_name', 'aadhaar_no', 'pan_no', 'userid', 'email', 'address', 'address_city', 'address_pin', 'phone', 'whatsapp_no', 'alt_phone', 'twitter_url', 'facebook_url', 'instagram_url', 'linkedin_url'
        ];

        field_ids.forEach(function(id) {
            var value = $('#' + id).val(); // Get the value of the input field
            $('#' + id + '_review').text(value); // Set the text of the corresponding review element
        });

        $('#full_name_review').text($('#first_name').val() + ' ' + $('#last_name').val());

        // update select2 values
        $('#user_designation_review').text($('#user_designation option:selected').text());
        $('#user_group_review').text($('#user_group option:selected').text());
        $('#treatment_site_review').text($('#treatment_site option:selected').text());
        $('#address_state_review').text($('#address_state option:selected').text());

        // update social link urls
        $('#twitter_url_review').prop('href', $('#twitter_url').val());
        $('#facebook_url_review').prop('href', $('#facebook_url').val());
        $('#instagram_url_review').prop('href', $('#instagram_url').val());
        $('#linkedin_url_review').prop('href', $('#linkedin_url').val());


        // count permissions
        var checkedCount = $('#permission-tbody input[type="checkbox"]:checked').length;
        checkedCount = Math.max(0, checkedCount - 1);
        if (checkedCount > 1) {
            // if more than 1 show plural line
            $('#extra_perm_review').text(checkedCount + ' permissions added')
        } else {
            $('#extra_perm_review').text(checkedCount + ' permission added')
        }

        $('#next-to-review').click();
    }
</script>

</div>