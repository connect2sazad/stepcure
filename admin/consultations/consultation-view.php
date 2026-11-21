<?php

$patient_id = $consultation['patient_id'];
$patient = getPatientById($patient_id);
$patient = mysqli_fetch_assoc($patient);
$patient_gender = $patient['gender'] == 'm' ? 'Male' : ($patient['gender'] == 'f' ? 'Female' : 'Others');

$consultant_id = $consultation['user_id'];
$consultant = getUserById($consultant_id);
$consultant = mysqli_fetch_assoc($consultant);
$consultant_userid = $consultant['userid'];
$honorifics = $consultant['user_designation'];
$honorifics = getUserDesignationById($honorifics);
$honorifics = mysqli_fetch_assoc($honorifics);
$honorifics = $honorifics['default_honorifics'];

$site_id = $consultation['site_id'];
$site = getSiteById($site_id);
$site = mysqli_fetch_assoc($site);

// get the patient's prior issues: stored in ids of prior_issues table
$consultation_prior_issues = $consultation['prior_issues'];
if($consultation_prior_issues){
    $consultation_prior_issues = array_map('intval', explode(",", $consultation_prior_issues));
} else {
$consultation_prior_issues = [];
}

$prior_issues_list = getPriorIssuesList();
?>

<div class="row">

    <!-- view details regarding the consultation - patient, consultant and site details -->
    <div class="col-4">

        <!-- patient details -->
        <div class="card mb-4">
            <div class="card-body">
                <p class="h4">Patient Details</p>

                <div class="col-12 mb-3">
                    <label class="form-label" for="details_pid">Patient ID</label>
                    <input type="text" class="form-control" id="details_pid" placeholder="PI-<?= prefix_00($patient['patientid']) ?>" value="PI-<?= prefix_00($patient['patientid']) ?>" readonly>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label" for="details_full_name">Full Name</label>
                    <input type="text" class="form-control" id="details_full_name" placeholder="<?= $patient['first_name'] . ' ' . $patient['last_name'] ?>" value="<?= $patient['first_name'] . ' ' . $patient['last_name'] ?>" readonly>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label" for="details_gender">Gender</label>
                    <input type="text" class="form-control" id="details_gender" placeholder="<?= $patient_gender ?>" value="<?= $patient_gender ?>" readonly>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label" for="details_bmi">BMI (Body Mass Index)</label>
                    <input type="text" class="form-control" id="details_bmi"
                        placeholder="<?= calculateBMI($patient['weight'], $patient['height']) ?> kg/m²" value="<?= calculateBMI($patient['weight'], $patient['height']) ?> kg/m²" readonly>
                </div>

                <button class="btn btn-info" onclick="loadDetailsDialogData('patient_details')" data-bs-toggle="modal" data-bs-target="#modalCenter">View Details</button>

            </div>
        </div>

        <!-- consultant details -->
        <div class="card mb-4">
            <div class="card-body">
                <p class="h4">Consultant Details</p>

                <div class="col-12 mb-3">
                    <label class="form-label" for="details_pid">Consultant Userid</label>
                    <input type="text" class="form-control" id="details_pid" placeholder="@<?= $consultant_userid ?>" value="@<?= $consultant_userid ?>" readonly>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label" for="details_full_name">Full Name</label>
                    <input type="text" class="form-control" id="details_full_name" placeholder="<?= $honorifics . ' ' . $consultant['first_name'] . ' ' . $consultant['last_name'] ?>" value="<?= $honorifics . ' ' . $consultant['first_name'] . ' ' . $consultant['last_name'] ?>" readonly>
                </div>


                <button class="btn btn-info" onclick="loadDetailsDialogData('consultant_details')" data-bs-toggle="modal" data-bs-target="#modalCenter">View Details</button>

            </div>
        </div>

        <!-- site details -->
        <div class="card mb-4">
            <div class="card-body">
                <p class="h4">Site Details</p>

                <div class="col-12 mb-3">
                    <label class="form-label" for="details_site_id">Site ID</label>
                    <input type="text" class="form-control" id="details_site_id" placeholder="<?= $site['site_id'] ?>" value="<?= $site['site_id'] ?>" readonly>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label" for="details_site_name">Site Name</label>
                    <input type="text" class="form-control" id="details_site_name" placeholder="<?= $site['site_name'] ?>" value="<?= $site['site_name'] ?>" readonly>
                </div>

                <button class="btn btn-info" onclick="loadDetailsDialogData('site_details')" data-bs-toggle="modal" data-bs-target="#modalCenter">View Details</button>

            </div>
        </div>
    </div>


    <!-- view details regarding the report/consultation -->
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <p class="h4">Prior Issues</p>
                <div class="row" id="prior-issues-toggle-btns">

                    <?php
                    if (mysqli_num_rows($prior_issues_list) != 0) {
                        while ($row = mysqli_fetch_assoc($prior_issues_list)) {

                            // check if the current prior_issue is already in data of patient's prior issue
                            $checked = in_array($row['id'], $consultation_prior_issues) ? 'checked' : '';

                    ?>
                            <div class="col-4 mb-3 mt-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" name="prior_issues" id="prior_issues" <?= $checked ?> disabled="">
                                    <label class="form-check-label" for="prior_issues"><?= $row['issue_name'] ?></label>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p> No issues found!</p>';
                    }
                    ?>

                </div>

                <hr>
                <p class="h4">Scan Parameters</p>

                <!-- 3d scans -->
                <div class="row">
                    <div class="col-12 mb-3 mt-4">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="scan_3d_parameter" id="scan_3d_parameter" <?= $consultation['scan_3d_parameter'] == 1 ? 'checked' : '' ?> disabled="">
                            <label class="form-check-label" for="scan_3d_parameter">3D Scan Parameters</label>
                        </div>
                    </div>

                    <!-- foot type -->
                    <div class="col-6 mb-3" data-info="scan_3d_parameter">
                        <label class="form-label" for="pid">Left Foot Type</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['scan_3d_left_foot_type'] ?>" value="<?= $consultation['scan_3d_left_foot_type'] ?>" readonly>
                    </div>
                    <div class="col-6 mb-3" data-info="scan_3d_parameter">
                        <label class="form-label" for="pid">Right Foot Type</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['scan_3d_right_foot_type'] ?>" value="<?= $consultation['scan_3d_right_foot_type'] ?>" readonly>
                    </div>

                    <!-- arch type -->
                    <div class="col-6 mb-3" data-info="scan_3d_parameter">
                        <label class="form-label" for="pid">Left Arch Type</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['scan_3d_left_arch_type'] ?>" value="<?= $consultation['scan_3d_left_arch_type'] ?>" readonly>
                    </div>
                    <div class="col-6 mb-3" data-info="scan_3d_parameter">
                        <label class="form-label" for="pid">Right Arch Type</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['scan_3d_right_arch_type'] ?>" value="<?= $consultation['scan_3d_right_arch_type'] ?>" readonly>
                    </div>

                    <!-- heel angle -->
                    <div class="col-6 mb-3" data-info="scan_3d_parameter">
                        <label class="form-label" for="pid">Left Heel Angle</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['scan_3d_left_heel_angle'] ?>" value="<?= $consultation['scan_3d_left_heel_angle'] ?>" readonly>
                    </div>
                    <div class="col-6 mb-3" data-info="scan_3d_parameter">
                        <label class="form-label" for="pid">Right Heel Angle</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['scan_3d_right_heel_angle'] ?>" value="<?= $consultation['scan_3d_right_heel_angle'] ?>" readonly>
                    </div>

                </div>

                <!-- planter pressure scans -->
                <div class="row">
                    <div class="col-12 mb-3 mt-4">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="scan_planter_pressure_parameters" id="scan_planter_pressure_parameters" <?= $consultation['scan_planter_pressure_parameters'] == 1 ? 'checked' : '' ?> disabled="">
                            <label class="form-check-label" for="scan_planter_pressure_parameters">Planter Pressure Scan Parameters</label>
                        </div>
                    </div>

                    <!-- foot type -->
                    <div class="col-6 mb-3" data-info="scan_planter_pressure_parameters">
                        <label class="form-label" for="pid">Left Morpho Type</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['scan_planter_pressure_left_morpho_type'] ?>" value="<?= $consultation['scan_planter_pressure_left_morpho_type'] ?>" readonly>
                    </div>
                    <div class="col-6 mb-3" data-info="scan_planter_pressure_parameters">
                        <label class="form-label" for="pid">Right Morpho Type</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['scan_planter_pressure_right_morpho_type'] ?>" value="<?= $consultation['scan_planter_pressure_right_morpho_type'] ?>" readonly>
                    </div>

                    <!-- arch type -->
                    <div class="col-6 mb-3" data-info="scan_planter_pressure_parameters">
                        <label class="form-label" for="pid"> Left Max Pressure</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['scan_planter_pressure_left_max_pressure'] ?>" value="<?= $consultation['scan_planter_pressure_left_max_pressure'] ?>" readonly>
                    </div>
                    <div class="col-6 mb-3" data-info="scan_planter_pressure_parameters">
                        <label class="form-label" for="pid">Right Max Pressure</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['scan_planter_pressure_right_max_pressure'] ?>" value="<?= $consultation['scan_planter_pressure_right_max_pressure'] ?>" readonly>
                    </div>


                </div>

                <!-- ANKLE-BRACHIAL INDEX -->
                <div class="row">
                    <div class="col-12 mb-3 mt-4">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="ankle_brachial_index" id="ankle_brachial_index" <?= $consultation['ankle_brachial_index'] == 1 ? 'checked' : '' ?> disabled="">
                            <label class="form-check-label" for="ankle_brachial_index">Ankle-Brachial Index</label>
                        </div>
                    </div>

                    <!-- foot type -->
                    <div class="col-6 mb-3" data-info="ankle_brachial_index">
                        <label class="form-label" for="pid">Left Dorsalis Pedis</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['ankle_brachial_left_dorsalis_pedis'] ?>" value="<?= $consultation['ankle_brachial_left_dorsalis_pedis'] ?>" readonly>
                    </div>
                    <div class="col-6 mb-3" data-info="ankle_brachial_index">
                        <label class="form-label" for="pid">Right Dorsalis Pedis</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['ankle_brachial_right_dorsalis_pedis'] ?>" value="<?= $consultation['ankle_brachial_right_dorsalis_pedis'] ?>" readonly>
                    </div>

                    <!-- arch type -->
                    <div class="col-6 mb-3" data-info="ankle_brachial_index">
                        <label class="form-label" for="pid">Left Arm Ap</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['ankle_brachial_left_arm_ap'] ?>" value="<?= $consultation['ankle_brachial_left_arm_ap'] ?>" readonly>
                    </div>
                    <div class="col-6 mb-3" data-info="ankle_brachial_index">
                        <label class="form-label" for="pid">Right Arm Ap</label>
                        <input type="text" class="form-control" id="pid" placeholder="<?= $consultation['ankle_brachial_right_arm_ap'] ?>" value="<?= $consultation['ankle_brachial_right_arm_ap'] ?>" readonly>
                    </div>


                </div>

                <hr>
                <p class="h4">Analysis</p>

                <!-- Remarks, recommendations & prescriptions -->
                <div class="row">
                    <!-- summary report -->
                    <div class="col-12 mb-3">
                        <label class="form-label" for="summary_report">Summary Report</label>
                        <p name="summary_report" id="summary_report" readonly><?= $consultation['summary_report'] ?></p>
                    </div>

                    <!-- prescriptions -->
                    <div class="col-12 mb-3">
                        <label class="form-label" for="prescriptions">Prescriptions</label>
                        <p name="prescriptions" id="prescriptions" readonly><?= $consultation['prescriptions'] ?></p>
                    </div>

                    <!-- prescriptions -->
                    <div class="col-12 mb-3">
                        <label class="form-label" for="remarks">remarks</label>
                        <textarea class="form-control" name="remarks" id="remarks" data-info="remarks" readonly><?= $consultation['remarks'] ?></textarea>
                    </div>

                </div>

                <div class="mt-2 d-flex flex-wrap gap-2">
                    <?php
                    // show edit button only when the user has access
                    if (checkPermissions('update', $user_permissions, $user_group_permissions) && !$consultation['is_report_finalized'] && $consultation['user_id'] == userVariable('id')) {
                    ?>
                        <button type="button" data-info="action-button" class="btn btn-primary" onclick="window.location.href='./?id=<?= $consultation_id ?>'">Finalize</button>
                    <?php
                    }
                    ?>
                    <?php
                    // show edit button only when the user has access
                    if (checkPermissions('view', $user_permissions, $user_group_permissions) && $consultation['is_report_finalized']) {
                    ?>
                        <!-- open pdf report file in another tab -->
                        <a info="action-button" class="btn btn-info" target="_blank" href="<?= systemVariable('SITE_HOME') . 'system_generated/' . $consultation['report_file'] ?>">View Report</a>
                    <?php
                    }
                    ?>
                    <button type="button" data-info="action-button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    if (!<?= $consultation['scan_3d_parameter'] ?>) {
        $('[data-info="scan_3d_parameter"]').hide();
    }
    if (!<?= $consultation['scan_planter_pressure_parameters'] ?>) {
        $('[data-info="scan_planter_pressure_parameters"]').hide();
    }
    if (!<?= $consultation['ankle_brachial_index'] ?>) {
        $('[data-info="ankle_brachial_index"]').hide();
    }
</script>

<script>
    function loadDetailsDialogData(type) {
        let url = '';
        let selector = '';

        switch (type) {
            case 'patient_details':
                $('#modalCenterTitle').text('Patient Details');
                url = '<?= systemVariable('SITE_HOME') . 'admin/patients/?id=' . $patient_id . '&view' ?>';
                selector = '#patient-details';
                break;

            case 'consultant_details':
                $('#modalCenterTitle').text('Consultant Details');
                url = '<?= systemVariable('SITE_HOME') . 'admin/profile/?userid=' . $consultant_id ?>';
                selector = '#user-details';
                break;

            case 'site_details':
                $('#modalCenterTitle').text('Site Details');
                url = '<?= systemVariable('SITE_HOME') . 'admin/treatment-sites/?id=' . $site_id . '&view' ?>';
                selector = '#site-details';
                break;
        }

        // Load content and manipulate after load
        $('#details-dialog-body').load(url + ' ' + selector, function() {
            // Disable only buttons with data-info="action-button"
            $('#details-dialog-body').find('button[data-info="action-button"]').hide();

            // Add target="_blank" to all links inside the loaded content
            $('#details-dialog-body').find('a').attr('target', '_blank');
        });
    }
</script>