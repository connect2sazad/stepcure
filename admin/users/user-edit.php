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
        <form onsubmit="return false" method="POST" id="update_user" enctype="multipart/form-data">

            <!-- Account Details -->
            <div id="account-details" class="content active dstepper-block">
                <div class="content-header mb-4">
                    <h6 class="mb-0">Personal Details</h6>
                    <small>Enter Your Personal & Account Details.</small>
                </div>
                <div class="row g-6">
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="<?= $user['first_name'] ?>" value="<?= $user['first_name'] ?>">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="<?= $user['last_name'] ?>" value="<?= $user['last_name'] ?>" aria-label="Last Name">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="aadhaar_no">Aadhaar No</label>
                        <input type="number" id="aadhaar_no" name="aadhaar_no" class="form-control" placeholder="<?= $user['aadhaar_no'] ?>" value="<?= $user['aadhaar_no'] ?>" readonly>
                        <div class="text-danger mt-1" style="display: none;" id="aadhaar_error">Aadhaar No already exists. Please try another!!</div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="pan_no">PAN No</label>
                        <input type="text" id="pan_no" name="pan_no" class="form-control" placeholder="<?= $user['pan_no'] ?>" value="<?= $user['pan_no'] ?>" aria-label="PAN No" readonly>
                        <div class="text-danger mt-1" style="display: none;" id="pan_error">PAN No already exists. Please try another!!</div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="userid">UserId</label>
                        <input type="text" id="userid" name="userid" class="form-control" placeholder="<?= $user['userid'] ?>" value="<?= $user['userid'] ?>" readonly>
                        <div class="text-danger mt-1" style="display: none;" id="userid_error">UserId is not available. Please try another!!</div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="<?= $user['email'] ?>" value="<?= $user['email'] ?>" aria-label="Email" readonly>
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

                        <button type="reset" class="btn btn-dark">Reset</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>

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
                        <select name="user_designation" id="user_designation" class="form-control" required>
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
                        <select name="user_group" id="user_group" class="form-control" required>
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
                        <select name="treatment_site" id="treatment_site" class="form-control" required>
                            <?php
                            if (mysqli_num_rows($treatment_site_options) > 0) {
                                echo '<option selected disabled>Select Treatment Site</option>';
                                while ($row = mysqli_fetch_assoc($treatment_site_options)) {

                                    // select the user site in ui from db
                                    $selected_treatment_site = $user['treatment_site'] == $row['id'] ? 'selected' : '';

                                    $state = getAddressStateById($row['address_state']);
                                    $state_name = $state['state_name'];
                                    echo '<option value="' . $row['id'] . '" ' . $selected_treatment_site . '>' . $row['site_name'] . ' (' . $row['site_id'] . ') - ' . $state_name . '</option>';
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
                                <input class="form-check-input" id="select-all-permissions" type="checkbox">
                                <label class="form-check-label" for="select-all-permissions"> Select / Deselect All Permissions </label>
                            </div>
                            <table class="table" data-info="no-pagination">
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
                                                    id="view-all">
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
                                                    id="create-all">
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
                                                    id="update-all">
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
                                                    id="delete-all">
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
                                                    <input type="checkbox" id="permission-<?= $SL ?>" class="form-check-input select-row" title="<?= htmlspecialchars($row['name']) ?>">
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
                                                            data-bs-original-title="<?= htmlspecialchars($row[$perm . '_desc']) ?>">
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
                                                    id="view-all2">
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
                                                    id="create-all2">
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
                                                    id="update-all2">
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
                                                    id="delete-all2">
                                                <label for="delete-all2" class="form-check-label">Delete</label>
                                            </div>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>


                            <div class="form-check">
                                <input class="form-check-input" id="select-all-permissions2" type="checkbox">
                                <label class="form-check-label" for="select-all-permissions2"> Select / Deselect All Permissions </label>
                            </div>
                        </div>

                    </div>


                    <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-primary btn-prev" type="button">
                            <i class="icon-base bx bx-left-arrow-alt scaleX-n1-rtl icon-sm ms-sm-n2 me-sm-2"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>

                        <button type="reset" class="btn btn-dark">Reset</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>

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
                        <input type="text" class="form-control" id="address" name="address" placeholder="<?= $user['address'] ?>" value="<?= $user['address'] ?>">
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="address_state">State Location</label>
                        <select class="form-control" name="address_state" id="address_state" required>
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
                        <input type="text" class="form-control" name="address_city" id="address_city" placeholder="<?= $user['address_city'] ?>" value="<?= $user['address_city'] ?>">
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="address_pin">PIN Code</label>
                        <input type="number" class="form-control" id="address_pin" name="address_pin" placeholder="<?= $user['address_pin'] ?>" value="<?= $user['address_pin'] ?>">
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="phone">Phone No</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="<?= $user['phone'] ?>" value="<?= $user['phone'] ?>">
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="whatsapp_no">Whatsapp No</label>
                        <input type="text" class="form-control" id="whatsapp_no" name="whatsapp_no" placeholder="<?= $user['whatsapp_no'] ?>" value="<?= $user['whatsapp_no'] ?>">
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="alt_phone">Alt. Phone No</label>
                        <input type="text" class="form-control" id="alt_phone" name="alt_phone" placeholder="<?= $user['alt_phone'] ?>" value="<?= $user['alt_phone'] ?>">
                    </div>

                    <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-primary btn-prev" type="button">
                            <i class="icon-base bx bx-left-arrow-alt scaleX-n1-rtl icon-sm ms-sm-n2 me-sm-2"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>

                        <button type="reset" class="btn btn-dark">Reset</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>

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
                        <input type="text" id="twitter_url" name="twitter_url" class="form-control" placeholder="<?= $user['twitter_url'] ?>" value="<?= $user['twitter_url'] ?>">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="facebook_url">Facebook</label>
                        <input type="text" id="facebook_url" name="facebook_url" class="form-control" placeholder="<?= $user['facebook_url'] ?>" value="<?= $user['facebook_url'] ?>">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="instagram_url">Instagram</label>
                        <input type="text" id="instagram_url" name="instagram_url" class="form-control" placeholder="<?= $user['instagram_url'] ?>" value="<?= $user['instagram_url'] ?>">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="linkedin_url">Linkedin</label>
                        <input type="text" id="linkedin_url" name="linkedin_url" class="form-control" placeholder="<?= $user['linkedin_url'] ?>" value="<?= $user['linkedin_url'] ?>">
                    </div>

                    <hr>

                    <div class="content-header mb-4">
                        <small>Upload Documents</small>
                    </div>

                    <div class="col-6 mb-3">
                        <img src="<?= systemVariable('SITE_HOME') ?>uploads/<?= $user['aadhaar_image'] ?>" style="height: auto; width: 100%;" id="aadhaar_file_display" alt="Profile Image">
                    </div>
                    <div class="col-6 mb-3">
                        <img src="<?= systemVariable('SITE_HOME') ?>uploads/<?= $user['pan_image'] ?>" style="height: auto; width: 100%;" id="pan_file_display" alt="Profile Image">
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="aadhaar_file">Aadhaar Upload (File Type: Image Only)</label>
                        <input type="file" id="aadhaar_file" name="aadhaar_file" class="form-control" accept="image/jpeg,image/png,image/gif" placeholder="Aadhaar Upload">
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="pan_file">PAN Upload (File Type: Image Only)</label>
                        <input type="file" id="pan_file" name="pan_file" class="form-control" accept="image/jpeg,image/png,image/gif" placeholder="PAN Upload">
                    </div>

                    <div class="col-12 mb-3">
                        <img src="<?= systemVariable('SITE_HOME') ?>uploads/<?= $user['profile_image'] ?>" style="height: 100px; width: 100px; border-radius: 50%;" id="profile_image_display" alt="Profile Image">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="profile_image">Profile Image</label>
                        <input type="file" id="profile_image" name="profile_image" class="form-control" accept="image/*" placeholder="Profile Image">
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
                        <textarea class="form-control" id="remarks" placeholder="<?= $user['remarks'] ?>" name="remarks" data-info="remarks"><?= $user['remarks'] ?></textarea>
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
        </form>
    </div>
</div>

<!-- script to validate details in page 1 -->
<script>
    $(document).ready(function() {
        const aadhaarInput = $('#aadhaar_no');
        const panInput = $('#pan_no');
        const passwordInput = $('#password');
        const confirmPasswordInput = $('#confirm-password');
        const userIdInput = $('#userid');
        const emailInput = $('#email');
        const nextBtn = $('#p1-btn');

        let aadhaarTouched = true;
        let panTouched = true;
        let passwordTouched = true;
        let userIdTouched = true;
        let emailTouched = true;

        function validateAadhaar() {
            const raw = aadhaarInput.val().replace(/\D/g, '');
            if (!aadhaarTouched) return false;

            if (raw.length !== 12) {
                $('#aadhaar_error').show().text('Invalid Aadhaar No. Aadhaar No must be exactly 12 digits.');
                aadhaarInput.addClass('is-invalid');
                return false;
            } else {
                $('#aadhaar_error').hide().text('');
                aadhaarInput.removeClass('is-invalid');

                // ✅ Add availability check
                // checkAvailability('aadhaar_no', raw, 'aadhaar_error', 'Aadhaar No already exists. Please try another!!');

                return true;
            }
        }


        function validatePAN() {
            const value = panInput.val().toUpperCase();
            const panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/;
            if (!panTouched) return false;

            if (!panRegex.test(value)) {
                $('#pan_error').show().text('Invalid PAN No. Format must be ABCDE1234F.');
                panInput.addClass('is-invalid');
                return false;
            } else {
                $('#pan_error').hide().text('');
                panInput.removeClass('is-invalid');

                // ✅ Add availability check
                // checkAvailability('pan_no', value, 'pan_error', 'PAN No already exists. Please try another!!');

                return true;
            }
        }


        function validatePasswordMatch() {
            if (!passwordTouched) return false;
            const pass = passwordInput.val();
            const confirm = confirmPasswordInput.val();

            if (pass !== confirm || !pass) {
                $('#password_error').show().text('Passwords do not match.');
                confirmPasswordInput.addClass('is-invalid');
                return false;
            } else {
                $('#password_error').hide().text('');
                confirmPasswordInput.removeClass('is-invalid');
                return true;
            }
        }

        function validateUserId() {
            const value = userIdInput.val();
            const userIdRegex = /^[a-z0-9_]+$/;
            if (!userIdTouched) return false;

            if (!userIdRegex.test(value)) {
                $('#userid_error').show().text('User ID can contain only lowercase letters, numbers, and underscores.');
                userIdInput.addClass('is-invalid');
                return false;
            } else {
                $('#userid_error').hide().text('');
                userIdInput.removeClass('is-invalid');
                // checkAvailability('userid', value, 'userid_error', 'UserId is not available. Please try another!!');
                return true;
            }
        }

        function validateEmail() {
            const value = emailInput.val().trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
            if (!emailTouched) return false;

            if (!emailRegex.test(value)) {
                $('#email_error').show().text('Please enter a valid email address.');
                emailInput.addClass('is-invalid');
                return false;
            } else {
                $('#email_error').hide().text('');
                emailInput.removeClass('is-invalid');
                // checkAvailability('email', value, 'email_error', 'Email Id already exists. Please try another!!');
                return true;
            }
        }

        function checkFormValidity() {
            const validAadhaar = validateAadhaar();
            const validPAN = validatePAN();
            const validPassword = validatePasswordMatch();
            const validUserId = validateUserId();
            const validEmail = validateEmail();

            const allValid = validAadhaar && validPAN && validPassword && validUserId && validEmail;
            nextBtn.prop('disabled', !allValid);
        }

        // Aadhaar formatting
        aadhaarInput.on('input', function() {
            let raw = $(this).val().replace(/\D/g, '').substring(0, 12); // only digits, max 12
            $(this).val(raw);
        }).on('blur', function() {
            aadhaarTouched = true;
            checkFormValidity();
        }).on('keyup change', checkFormValidity);


        // PAN formatting
        panInput.on('input', function() {
            let raw = $(this).val().toUpperCase().replace(/[^A-Z0-9]/g, '').substring(0, 10);
            $(this).val(raw);
        }).on('blur', function() {
            panTouched = true;
            checkFormValidity();
        }).on('keyup change', checkFormValidity);

        // Password
        passwordInput.on('input', function() {
            passwordTouched = true;
            checkFormValidity();
        });

        confirmPasswordInput.on('input blur', function() {
            passwordTouched = true;
            checkFormValidity();
        });

        // User ID
        userIdInput.on('input', function() {
            let raw = $(this).val().toLowerCase().replace(/[^a-z0-9_]/g, '');
            $(this).val(raw);
            userIdTouched = true;
            checkFormValidity();
        }).on('blur change', function() {
            userIdTouched = true;
            checkFormValidity();
        });

        // Email
        emailInput.on('input', function() {
            emailTouched = true;
            checkFormValidity();
        }).on('blur change', function() {
            emailTouched = true;
            checkFormValidity();
        });

        // Initial state
        nextBtn.prop('disabled', true);
    });

    async function checkAvailability() {

        const first_name = $('#first_name').val().trim();
        const last_name = $('#last_name').val().trim();
        const aadhaar_no = $('#aadhaar_no').val().replace(/\D/g, '');
        const pan_no = $('#pan_no').val().toUpperCase().trim();
        const userid = $('#userid').val().trim();
        const email = $('#email').val().trim();

        var isEmpty = !first_name || !last_name || !aadhaar_no || !pan_no || !userid || !email;

        if (isEmpty) {
            const confirm = await ConfirmDialogBox(
                'Please fill up all the fields of the form. Ready to proceed?',
                'Empty Form Submitted'
            );

            // If user cancels, stop here
            if (!confirm) return;

            // Optionally highlight missing fields
            if (!first_name) $('#first_name').addClass('is-invalid');
            if (!last_name) $('#last_name').addClass('is-invalid');
            if (!aadhaar_no) $('#aadhaar_no').addClass('is-invalid');
            if (!pan_no) $('#pan_no').addClass('is-invalid');
            if (!userid) $('#userid').addClass('is-invalid');
            if (!email) $('#email').addClass('is-invalid');
        }

        // Reset previous errors
        $('.text-danger').hide();
        $('.form-control').removeClass('is-invalid');

        // Build request
        const form_data = {
            table: 'users',
            request_type: 'check_multiple_availability',
            values: {
                aadhaar_no: aadhaar_no,
                pan_no: pan_no,
                userid: userid,
                email: email
            }
        };

        ajax_request(form_data, false).done(function(response) {
            try {
                response = JSON.parse(response);

                let allAvailable = true;


                if (response.availability.aadhaar_no === 'positive') {
                    $('#aadhaar_error').show().text('Aadhaar No already exists.');
                    $('#aadhaar_no').addClass('is-invalid');
                    allAvailable = false;
                }
                if (response.availability.pan_no === 'positive') {
                    $('#pan_error').show().text('PAN No already exists.');
                    $('#pan_no').addClass('is-invalid');
                    allAvailable = false;
                }
                if (response.availability.userid === 'positive') {
                    $('#userid_error').show().text('User ID is not available.');
                    $('#userid').addClass('is-invalid');
                    allAvailable = false;
                }
                if (response.availability.email === 'positive') {
                    $('#email_error').show().text('Email already exists.');
                    $('#email').addClass('is-invalid');
                    allAvailable = false;
                }


                if (allAvailable) {
                    $('#goto-p2').click();
                }
            } catch (e) {
                console.error('Failed to parse response:', e, response);
            }
        });
    }
</script>

<!-- script for page 2 -->
<script>
    $(document).ready(function() {
        $('#user_designation').on('change', function() {
            const selectedOption = $(this).find(':selected'); // get selected <option>
            const userGroup = selectedOption.data('user-group'); // read its data-user-group

            if (userGroup !== undefined && userGroup !== "") {
                const $userGroupDropdown = $('#user_group');

                // Check if the target User Group exists in dropdown
                const exists = $userGroupDropdown.find(`option[value="${userGroup}"]`).length > 0;

                if (exists) {
                    $userGroupDropdown.val(userGroup); // set value

                    // ✅ Trigger correct event depending on Select2 usage
                    if ($userGroupDropdown.hasClass('select2-hidden-accessible')) {
                        $userGroupDropdown.trigger('change.select2');
                    } else {
                        $userGroupDropdown.trigger('change');
                    }
                } else {
                    console.warn("No matching User Group option found for:", userGroup);
                }
            }
        });
    });
</script>

<!-- script for page 2 and permissions -->
<script>
    $(document).ready(() => {

        const permissionCheckboxesSelector = 'input[type="checkbox"][name^="permissions"]';
        const selectAllSelectors = '#select-all-permissions, #select-all-permissions2';

        const columnIDs = {
            view: ['#view-all', '#view-all2'],
            create: ['#create-all', '#create-all2'],
            update: ['#update-all', '#update-all2'],
            delete: ['#delete-all', '#delete-all2']
        };

        let isUpdating = false;

        function toggleAllPermissions(sourceCheckbox) {
            const isChecked = $(sourceCheckbox).is(':checked');
            isUpdating = true;
            $(permissionCheckboxesSelector).prop('checked', isChecked);
            $(selectAllSelectors).prop('checked', isChecked);
            Object.keys(columnIDs).forEach(col => {
                $(columnIDs[col].join(',')).prop('checked', isChecked);
            });
            isUpdating = false;
            updateAll();
        }

        function updateSelectAllCheckbox() {
            const total = $(permissionCheckboxesSelector).length;
            const checked = $(permissionCheckboxesSelector + ':checked').length;
            const allChecked = total > 0 && total === checked;
            $(selectAllSelectors).prop('checked', allChecked);
        }

        function updateRowToggles() {
            $('tbody tr').each(function() {
                const checkboxes = $(this).find(permissionCheckboxesSelector);
                const checked = checkboxes.filter(':checked').length;
                $(this).find('.select-row').prop('checked', checkboxes.length > 0 && checkboxes.length === checked);
            });
        }

        function updateColumnToggles() {
            Object.keys(columnIDs).forEach(col => {
                const checkboxes = $(`input[type="checkbox"][data-column="${col}"]`);
                const checked = checkboxes.filter(':checked').length;
                const allChecked = checkboxes.length > 0 && checkboxes.length === checked;
                $(columnIDs[col].join(',')).prop('checked', allChecked);
            });
        }

        function updateRowHighlighting() {
            $('tbody tr').each(function() {
                const isAnyChecked = $(this).find(permissionCheckboxesSelector).is(':checked');
                $(this).toggleClass('bg-success-subtle', isAnyChecked);
            });
        }

        function updateAll() {
            updateSelectAllCheckbox();
            updateRowToggles();
            updateColumnToggles();
            updateRowHighlighting();
        }

        // Select All Permissions (top and bottom)
        $(selectAllSelectors).on('change', function() {
            if (isUpdating) return;
            toggleAllPermissions(this);
        });

        // Column master checkboxes (top and bottom)
        Object.entries(columnIDs).forEach(([col, ids]) => {
            $(ids.join(',')).on('change', function() {
                if (isUpdating) return;
                const isChecked = $(this).is(':checked');
                isUpdating = true;
                $(ids.join(',')).prop('checked', isChecked);
                $(`input[data-column="${col}"]`).prop('checked', isChecked);
                isUpdating = false;
                updateAll();
            });
        });

        // Row master checkboxes
        $(document).on('change', '.select-row', function() {
            if (isUpdating) return;
            const row = $(this).closest('tr');
            const isChecked = $(this).is(':checked');
            isUpdating = true;
            row.find(permissionCheckboxesSelector).prop('checked', isChecked);
            isUpdating = false;
            updateAll();
        });

        // Individual cell checkbox (update column masters)
        $(document).on('change', permissionCheckboxesSelector, function() {
            if (isUpdating) return;

            const col = $(this).data('column');
            if (col) {
                const allCheckboxes = $(`input[data-column="${col}"]`);
                const checkedCount = allCheckboxes.filter(':checked').length;
                const allChecked = checkedCount === allCheckboxes.length;
                $(columnIDs[col].join(',')).prop('checked', allChecked);
            }

            updateAll();
        });

        // On initial page load
        updateAll();

    });
</script>

<!-- script for page 4 image view -->
<script>
    $(document).ready(function() {
        previewSelectedUploadImage('#aadhaar_file', '#aadhaar_file_display');
        previewSelectedUploadImage('#pan_file', '#pan_file_display');
        previewSelectedUploadImage('#profile_image', '#profile_image_display');
    });
</script>

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

<!-- script to submit data to server -->
<script>
    $(document).ready(() => {

        // Form submission
        const userForm = enableUnsavedChangesWarning('#update_user');

        $('#update_user').on('submit', function(e) {
            e.preventDefault();

            const formElem = document.getElementById('update_user');

            // ✅ Detect if there is a file input
            let hasFiles = $(formElem).find('input[type="file"]').length > 0;

            let form_data;

            if (hasFiles) {
                // ✅ Create FormData for file upload
                form_data = new FormData(formElem);

                // ✅ Client-side file size validation (1MB max)
                let fileInput = $(formElem).find('input[type="file"]')[0];
                if (fileInput && fileInput.files.length > 0) {
                    let file = fileInput.files[0];
                    if (file.size > 1048576) { // 1MB = 1024*1024 bytes
                        Toastify({
                            text: "File size exceeds 1 MB limit!",
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "red",
                        }).showToast();
                        return; // stop submission
                    }
                }

                // ✅ Add extra params manually for FormData
                form_data.append('id', '<?= $user['id'] ?>');
                form_data.append('updated_by', '<?= $_SESSION[USER_AUTH] ?>');
                form_data.append('request_type', 'update_user');

            } else {
                // ✅ Old behavior if no files
                form_data = $(formElem).serialize();
                form_data += "&id=<?= $user['id'] ?>";
                form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
                form_data += "&request_type=update_user";
            }

            // ✅ Now call ajax_request with `files=hasFiles`
            ajax_request(form_data, true, hasFiles).done(function(response) {
                console.log(response);

                if (response.status === 'success') {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    userForm?.markFormClean?.(); // only if defined

                } else {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "red",
                    }).showToast();
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error(jqXHR);
                Toastify({
                    text: "Server error. Please try again.",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "red",
                }).showToast();
            });
        });

    });
</script>