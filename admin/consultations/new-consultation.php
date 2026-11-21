<?php

// get user group to check if the user is admin or super admin
$current_user_group = userVariable('user_group');

$user_site = '';
// check if the user is admin 2 or super admin 1
if ($current_user_group != 1 || $current_user_group != 2) {

    // get treatment site for the user
    $user_site = userVariable('treatment_site');
}

// get if any patient is selected
$selected_patient = isset($_GET['patient']) ? $_GET['patient'] : '';

// get if any dr user is selected
$selected_dr = isset($_GET['user']) ? $_GET['user'] : '';

$sites_options = getTreatmentSiteOptions();
$patients_options = getPatientsList();
$recomendations_options = getUsersList();
$consultants_options = getUsersList();


?>
<div class="card">
    <div class="card-body">
        <form id="add_new_consultation" method="POST" onsubmit="return false">
            <div class="row">

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="site_id">Treatment Site</label>
                    <select class="form-control" id="site_id_select" <?= ($current_user_group == 1 || $current_user_group == 2) ? '' : 'disabled' ?>>
                        <?php
                        if (mysqli_num_rows($sites_options) > 0) {

                            echo '<option ' . (($current_user_group == 1 || $current_user_group == 2) ? 'selected' : '') . ' disabled>Select a Treatment Site</option>';

                            while ($row = mysqli_fetch_assoc($sites_options)) {
                        ?>
                                <option value="<?= $row['id'] ?>" <?= $user_site == $row['id'] ? 'selected' : '' ?>><?= $row['site_name'] ?> (<?= $row['site_id'] ?>)</option>
                        <?php
                            }
                        } else {
                            echo '<option selected disabled>No States Available</option>';
                        }
                        ?>
                    </select>
                    <input type="hidden" name="site_id" value="<?= $user_site ?>" id="site_id_value">
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="patient_id">Patient</label>
                    <select class="form-control" id="patient_id" name="patient_id">
                        <?php
                        if (mysqli_num_rows($patients_options) > 0) {

                            echo '<option ' . (($selected_patient == '') ? 'selected' : '') . ' disabled>Select a Patient</option>';

                            while ($row = mysqli_fetch_assoc($patients_options)) {
                        ?>
                                <option value="<?= $row['id'] ?>" <?= $selected_patient == $row['id'] ? 'selected' : '' ?>><?= 'PI-' . prefix_00($row['patientid']) . ' ' . $row['first_name'] . ' ' . $row['last_name'] ?> (UHID: <?= $row['uhid'] ?>)</option>
                        <?php
                            }
                        } else {
                            echo '<option selected disabled>No States Available</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="recomended_by_user_id">Recomended By</label>
                    <select class="form-control" id="recomended_by_user_id" name="recomended_by_user_id">
                        <?php
                        if (mysqli_num_rows($recomendations_options) > 0) {

                            echo '<option ' . (($selected_patient == '') ? 'selected' : '') . ' disabled>Select the User who Recomended</option>';

                            while ($row = mysqli_fetch_assoc($recomendations_options)) {

                                $row_user_designation = $row['user_designation'];

                                // designation is blank if there is no desgignation
                                $row_user_designation_honor = '';
                                if ($row_user_designation) {
                                    $row_user_designation = getUserDesignationById($row_user_designation);
                                    $row_user_designation = mysqli_fetch_assoc($row_user_designation);
                                    $row_user_designation_honor = $row_user_designation['default_honorifics'] . ' ';
                                }

                                // if user is super-admin 1, skip
                                if ($row['user_group'] != 1) {

                        ?>
                                    <option value="<?= $row['id'] ?>" <?= $selected_patient == $row['id'] ? 'selected' : '' ?>><?= $row_user_designation_honor . $row['first_name'] . ' ' . $row['last_name'] ?> (@<?= $row['userid'] ?>)</option>
                        <?php
                                }
                            }
                        } else {
                            echo '<option selected disabled>No Users Available</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="user_id">Consulting User</label>
                    <select class="form-control" id="user_id" name="user_id">
                        <?php
                        if (mysqli_num_rows($consultants_options) > 0) {

                            echo '<option ' . (($selected_patient == '') ? 'selected' : '') . ' disabled>Select a Consulting User</option>';

                            while ($row = mysqli_fetch_assoc($consultants_options)) {

                                $row_user_designation = $row['user_designation'];

                                if ($row_user_designation) {
                                    $row_user_designation = getUserDesignationById($row_user_designation);
                                    $row_user_designation = mysqli_fetch_assoc($row_user_designation);
                                    pre($user_site);
                                    pre($row['treatment_site']);
                                    if ($row_user_designation['is_consultant'] && $user_site == $row['treatment_site']) {
                                        $row_user_designation_honor = $row_user_designation['default_honorifics'] . ' ';


                        ?>
                                        <option value="<?= $row['id'] ?>" <?= $selected_patient == $row['id'] ? 'selected' : '' ?>><?= $row_user_designation_honor . $row['first_name'] . ' ' . $row['last_name'] ?> (@<?= $row['userid'] ?>)</option>
                        <?php
                                    }
                                }
                            }
                        } else {
                            echo '<option selected disabled>No States Available</option>';
                        }
                        ?>
                    </select>
                </div>


                <div class="col-12 mb-3">
                    <label class="form-label" for="remarks">Remarks</label>
                    <textarea class="form-control" id="remarks" placeholder="Enter Remarks" name="remarks" data-info="remarks"></textarea>
                </div>
            </div>

            <div class="mt-2">
                <button type="submit" id="submit-btn" class="btn btn-primary me-2">Publish</button>
                <button type="reset" class="btn btn-secondary me-2">Reset</button>
            </div>
        </form>
    </div>
</div>

<!-- change treatment site -->
<script>
    $(document).ready(function() {
        const $select = $('#site_id_select');
        const $hidden = $('#site_id_value');

        // Set initial value on page load
        $hidden.val($select.val());

        $select.on('change', function() {
            $hidden.val($(this).val());
        });
    });
</script>


<script>
    $(document).ready(() => {

        $('#add_new_consultation').on('submit', function(e) {
            e.preventDefault();

            var form_data = $('#add_new_consultation').serialize();
            form_data += "&created_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=add_new_consultation";

            // if($('#site_id').val() == null){
            //     Toastify({
            //             text: "Please select a Treatment Site",
            //             duration: 3000,
            //             close: true,
            //             gravity: "top",
            //             position: "right",
            //             backgroundColor: "red",
            //         }).showToast();
            //     return;
            // }

            if($('#patient_id').val() == null){
                Toastify({
                        text: "Please select a Patient",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "red",
                    }).showToast();
                return;
            }

            if($('#user_id').val() == null){
                Toastify({
                        text: "Please select a Consulting User",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "red",
                    }).showToast();
                return;
            }


            ajax_request(form_data).done(function(response) {

                console.log(response);

                if (response.status == 'success') {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    window.location = "<?= systemVariable('SITE_HOME') ?>admin/consultations/?id=" + response.id + '&view';

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
                console.log(response);
            });
        });
    });
</script>