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
$consultation_prior_issues = array_map('intval', explode(",", $consultation_prior_issues));

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
                <form id="update_consultation" method="POST" onsubmit="return false">
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
                                        <input class="form-check-input" type="checkbox" name="prior_issues[]" value="<?= $row['id'] ?>" id="<?= $row['issue_slug'] ?>" <?= $checked ?>>
                                        <label class="form-check-label" for="<?= $row['issue_slug'] ?>"><?= $row['issue_name'] ?></label>
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
                                <input class="form-check-input" type="checkbox" name="scan_3d_parameter" id="scan_3d_parameter" <?= $consultation['scan_3d_parameter'] == 1 ? 'checked' : '' ?>>
                                <label class="form-check-label" for="scan_3d_parameter">3D Scan Parameters</label>
                            </div>
                        </div>

                        <!-- foot type -->
                        <div class="col-6 mb-3" data-info="scan_3d_parameter">
                            <label class="form-label" for="scan_3d_left_foot_type">Left Foot Type</label>
                            <select name="scan_3d_left_foot_type" id="scan_3d_left_foot_type">
                                <option value="Normal" <?= $consultation['scan_3d_left_foot_type'] == "Normal" ? "selected" : "" ?>>Normal</option>
                                <option value="Cavus" <?= $consultation['scan_3d_left_foot_type'] == "Cavus" ? "selected" : "" ?>>Cavus</option>
                                <option value="Flatfoot" <?= $consultation['scan_3d_left_foot_type'] == "Flatfoot" ? "selected" : "" ?>>Flatfoot</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3" data-info="scan_3d_parameter">
                            <label class="form-label" for="scan_3d_right_foot_type">Right Foot Type</label>
                            <select name="scan_3d_right_foot_type" id="scan_3d_right_foot_type">
                                <option value="Normal" <?= $consultation['scan_3d_right_foot_type'] == "Normal" ? "selected" : "" ?>>Normal</option>
                                <option value="Cavus" <?= $consultation['scan_3d_right_foot_type'] == "Cavus" ? "selected" : "" ?>>Cavus</option>
                                <option value="Flatfoot" <?= $consultation['scan_3d_right_foot_type'] == "Flatfoot" ? "selected" : "" ?>>Flatfoot</option>
                            </select>
                        </div>

                        <!-- arch type -->
                        <div class="col-6 mb-3" data-info="scan_3d_parameter">
                            <label class="form-label" for="scan_3d_left_arch_type">Left Arch Type</label>
                            <select name="scan_3d_left_arch_type" id="scan_3d_left_arch_type">
                                <option value="Normal" <?= $consultation['scan_3d_left_arch_type'] == "Normal" ? "selected" : "" ?>>Normal</option>
                                <option value="Mild" <?= $consultation['scan_3d_left_arch_type'] == "Mild" ? "selected" : "" ?>>Mild</option>
                                <option value="Moderate" <?= $consultation['scan_3d_left_arch_type'] == "Moderate" ? "selected" : "" ?>>Moderate</option>
                                <option value="Severe" <?= $consultation['scan_3d_left_arch_type'] == "Severe" ? "selected" : "" ?>>Severe</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3" data-info="scan_3d_parameter">
                            <label class="form-label" for="scan_3d_right_arch_type">Right Arch Type</label>
                            <select name="scan_3d_right_arch_type" id="scan_3d_right_arch_type">
                                <option value="Normal" <?= $consultation['scan_3d_right_arch_type'] == "Normal" ? "selected" : "" ?>>Normal</option>
                                <option value="Mild" <?= $consultation['scan_3d_right_arch_type'] == "Mild" ? "selected" : "" ?>>Mild</option>
                                <option value="Moderate" <?= $consultation['scan_3d_right_arch_type'] == "Moderate" ? "selected" : "" ?>>Moderate</option>
                                <option value="Severe" <?= $consultation['scan_3d_right_arch_type'] == "Severe" ? "selected" : "" ?>>Severe</option>
                            </select>
                        </div>

                        <!-- heel angle -->
                        <div class="col-6 mb-3" data-info="scan_3d_parameter">
                            <label class="form-label" for="scan_3d_left_heel_angle">Left Heel Angle</label>
                            <select name="scan_3d_left_heel_angle" id="scan_3d_left_heel_angle">
                                <option value="Normal" <?= $consultation['scan_3d_left_heel_angle'] == "Normal" ? "selected" : "" ?>>Normal</option>
                                <option value="Inversion" <?= $consultation['scan_3d_left_heel_angle'] == "Inversion" ? "selected" : "" ?>>Inversion</option>
                                <option value="Eversion" <?= $consultation['scan_3d_left_heel_angle'] == "Eversion" ? "selected" : "" ?>>Eversion</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3" data-info="scan_3d_parameter">
                            <label class="form-label" for="scan_3d_right_heel_angle">Right Heel Angle</label>
                            <select name="scan_3d_right_heel_angle" id="scan_3d_right_heel_angle">
                                <option value="Normal" <?= $consultation['scan_3d_right_heel_angle'] == "Normal" ? "selected" : "" ?>>Normal</option>
                                <option value="Inversion" <?= $consultation['scan_3d_right_heel_angle'] == "Inversion" ? "selected" : "" ?>>Inversion</option>
                                <option value="Eversion" <?= $consultation['scan_3d_right_heel_angle'] == "Eversion" ? "selected" : "" ?>>Eversion</option>
                            </select>
                        </div>

                    </div>

                    <!-- planter pressure scans -->
                    <div class="row">
                        <div class="col-12 mb-3 mt-4">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="scan_planter_pressure_parameters" id="scan_planter_pressure_parameters" <?= $consultation['scan_planter_pressure_parameters'] == 1 ? 'checked' : '' ?>>
                                <label class="form-check-label" for="scan_planter_pressure_parameters">Planter Pressure Scan Parameters</label>
                            </div>
                        </div>

                        <!-- foot type -->
                        <div class="col-6 mb-3" data-info="scan_planter_pressure_parameters">
                            <label class="form-label" for="scan_planter_pressure_left_morpho_type">Left Morpho Type</label>
                            <select name="scan_planter_pressure_left_morpho_type" id="scan_planter_pressure_left_morpho_type">
                                <option value="Normal" <?= $consultation['scan_planter_pressure_left_morpho_type'] == "Normal" ? "selected" : "" ?>>Normal</option>
                                <option value="Flat" <?= $consultation['scan_planter_pressure_left_morpho_type'] == "Flat" ? "selected" : "" ?>>Flat</option>
                                <option value="High" <?= $consultation['scan_planter_pressure_left_morpho_type'] == "High" ? "selected" : "" ?>>High</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3" data-info="scan_planter_pressure_parameters">
                            <label class="form-label" for="scan_planter_pressure_right_morpho_type">Right Morpho Type</label>
                            <select name="scan_planter_pressure_right_morpho_type" id="scan_planter_pressure_right_morpho_type">
                                <option value="Normal" <?= $consultation['scan_planter_pressure_right_morpho_type'] == "Normal" ? "selected" : "" ?>>Normal</option>
                                <option value="Flat" <?= $consultation['scan_planter_pressure_right_morpho_type'] == "Flat" ? "selected" : "" ?>>Flat</option>
                                <option value="High" <?= $consultation['scan_planter_pressure_right_morpho_type'] == "High" ? "selected" : "" ?>>High</option>
                            </select>
                        </div>

                        <!-- arch type -->
                        <div class="col-6 mb-3" data-info="scan_planter_pressure_parameters">
                            <label class="form-label" for="scan_planter_pressure_left_max_pressure"> Left Max Pressure</label>
                            <select name="scan_planter_pressure_left_max_pressure" id="scan_planter_pressure_left_max_pressure">
                                <option value="Normal" <?= $consultation['scan_planter_pressure_left_max_pressure'] == "Normal" ? "selected" : "" ?>>Normal</option>
                                <option value="Forefoot" <?= $consultation['scan_planter_pressure_left_max_pressure'] == "Forefoot" ? "selected" : "" ?>>Forefoot</option>
                                <option value="Midfoot" <?= $consultation['scan_planter_pressure_left_max_pressure'] == "Midfoot" ? "selected" : "" ?>>Midfoot</option>
                                <option value="Hindfoot" <?= $consultation['scan_planter_pressure_left_max_pressure'] == "Hindfoot" ? "selected" : "" ?>>Hindfoot</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3" data-info="scan_planter_pressure_parameters">
                            <label class="form-label" for="scan_planter_pressure_right_max_pressure">Right Max Pressure</label>
                            <select name="scan_planter_pressure_right_max_pressure" id="scan_planter_pressure_right_max_pressure">
                                <option value="Normal" <?= $consultation['scan_planter_pressure_right_max_pressure'] == "Normal" ? "selected" : "" ?>>Normal</option>
                                <option value="Forefoot" <?= $consultation['scan_planter_pressure_right_max_pressure'] == "Forefoot" ? "selected" : "" ?>>Forefoot</option>
                                <option value="Midfoot" <?= $consultation['scan_planter_pressure_right_max_pressure'] == "Midfoot" ? "selected" : "" ?>>Midfoot</option>
                                <option value="Hindfoot" <?= $consultation['scan_planter_pressure_right_max_pressure'] == "Hindfoot" ? "selected" : "" ?>>Hindfoot</option>
                            </select>
                        </div>


                    </div>

                    <!-- ANKLE-BRACHIAL INDEX -->
                    <div class="row">
                        <div class="col-12 mb-3 mt-4">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="ankle_brachial_index" id="ankle_brachial_index" <?= $consultation['ankle_brachial_index'] == 1 ? 'checked' : '' ?>>
                                <label class="form-check-label" for="ankle_brachial_index">Ankle-Brachial Index</label>
                            </div>
                        </div>

                        <!-- foot type -->
                        <div class="col-6 mb-3" data-info="ankle_brachial_index">
                            <label class="form-label" for="ankle_brachial_left_dorsalis_pedis">Left Dorsalis Pedis</label>
                            <input type="text" class="form-control" name="ankle_brachial_left_dorsalis_pedis" id="ankle_brachial_left_dorsalis_pedis" placeholder="<?= $consultation['ankle_brachial_left_dorsalis_pedis'] ?>" value="<?= $consultation['ankle_brachial_left_dorsalis_pedis'] ?>">
                        </div>
                        <div class="col-6 mb-3" data-info="ankle_brachial_index">
                            <label class="form-label" for="ankle_brachial_right_dorsalis_pedis">Right Dorsalis Pedis</label>
                            <input type="text" class="form-control" id="ankle_brachial_right_dorsalis_pedis" name="ankle_brachial_right_dorsalis_pedis" placeholder="<?= $consultation['ankle_brachial_right_dorsalis_pedis'] ?>" value="<?= $consultation['ankle_brachial_right_dorsalis_pedis'] ?>">
                        </div>

                        <!-- arch type -->
                        <div class="col-6 mb-3" data-info="ankle_brachial_index">
                            <label class="form-label" for="ankle_brachial_left_arm_ap">Left Arm Ap</label>
                            <input type="text" class="form-control" id="ankle_brachial_left_arm_ap" name="ankle_brachial_left_arm_ap" placeholder="<?= $consultation['ankle_brachial_left_arm_ap'] ?>" value="<?= $consultation['ankle_brachial_left_arm_ap'] ?>">
                        </div>
                        <div class="col-6 mb-3" data-info="ankle_brachial_index">
                            <label class="form-label" for="ankle_brachial_right_arm_ap">Right Arm Ap</label>
                            <input type="text" class="form-control" id="ankle_brachial_right_arm_ap" name="ankle_brachial_right_arm_ap" placeholder="<?= $consultation['ankle_brachial_right_arm_ap'] ?>" value="<?= $consultation['ankle_brachial_right_arm_ap'] ?>">
                        </div>


                    </div>

                    <hr>
                    <p class="h4">Analysis</p>

                    <!-- Remarks, recommendations & prescriptions -->
                    <div class="row">
                        <!-- summary report -->
                        <div class="col-12 mb-3">
                            <label class="form-label" for="summary_report">Summary Report</label>
                            <textarea name="summary_report" id="summary_report"><?= $consultation['summary_report'] ?></textarea>
                        </div>

                        <!-- prescriptions -->
                        <div class="col-12 mb-3">
                            <label class="form-label" for="prescriptions">Prescriptions</label>
                            <textarea name="prescriptions" id="prescriptions"><?= $consultation['prescriptions'] ?></textarea>
                        </div>

                        <!-- prescriptions -->
                        <div class="col-12 mb-3">
                            <label class="form-label" for="remarks">remarks</label>
                            <textarea class="form-control" name="remarks" id="remarks" data-info="remarks"><?= $consultation['remarks'] ?></textarea>
                        </div>

                    </div>

                    <div class="mt-2 d-flex flex-wrap gap-2">
                        <?php
                        // show edit button only when the user has access
                        if (checkPermissions('update', $user_permissions, $user_group_permissions) && !$consultation['is_report_finalized'] && $consultation['user_id'] == userVariable('id')) {
                        ?>
                            <div class="row text-info my-2" style="width: 100%; margin-left: 5px;">
                                Please Note: <br>
                                1. A report can only be generated once the form is finalized. <br>
                                2. Once a report is generated, the consultation form cannot be updated.
                            </div>

                            <button type="submit" data-info="action-button" class="btn btn-primary save-draft-btn">Save Draft</button>
                            <button type="submit" data-info="action-button" class="btn btn-warning finalize-btn">Finalize</button>
                        <?php
                        }
                        ?>
                        <?php
                        // show view button only when the user has access
                        if (checkPermissions('view', $user_permissions, $user_group_permissions) && $consultation['is_report_finalized']) {
                        ?>
                            <!-- open pdf report file in another tab -->
                            <a info="action-button" class="btn btn-info" target="_blank" href="<?= systemVariable('SITE_HOME') . 'system_generated/' . $consultation['report_file'] ?>">View Report</a>
                        <?php
                        }
                        ?>
                        <button type="button" data-info="action-button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>
                    </div>

                </form>

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

    $(document).ready(function() {

        // check if report has scan_3d_parameter
        $('#scan_3d_parameter').on('change', function() {
            if ($(this).is(':checked')) {
                $('[data-info="scan_3d_parameter"]').toggle();
            } else {
                $('[data-info="scan_3d_parameter"]').toggle();
            }
        });

        // check if report has scan_planter_pressure_parameters
        $('#scan_planter_pressure_parameters').on('change', function() {
            if ($(this).is(':checked')) {
                $('[data-info="scan_planter_pressure_parameters"]').toggle();
            } else {
                $('[data-info="scan_planter_pressure_parameters"]').toggle();
            }
        });

        // check if report has ankle_brachial_index
        $('#ankle_brachial_index').on('change', function() {
            if ($(this).is(':checked')) {
                $('[data-info="ankle_brachial_index"]').toggle();
            } else {
                $('[data-info="ankle_brachial_index"]').toggle();
            }
        });

    });
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

<script>
    $(document).ready(() => {

        const consultationForm = enableUnsavedChangesWarning('#update_consultation');

        // Common submit handler with extra data
        function submitConsultation(isFinalized) {
            const formElem = document.getElementById('update_consultation');

            // serialize form
            let form_data = $(formElem).serialize();

            // append extra fields
            form_data += "&id=<?= $consultation['id'] ?>";
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=update_consultation";
            form_data += "&is_report_finalized=" + (isFinalized ? 1 : 0);

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

                    consultationForm?.markFormClean?.(); // only if defined

                    if(isFinalized){
                        console.log('complete');
                        
                        window.location.href="./?id=<?= $consultation['id'] ?>&view";
                    }

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
            }).fail(function(jqXHR) {
                console.error(jqXHR);
                Toastify({
                    text: jqXHR.responseText,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "red",
                }).showToast();
            });
        }

        // Save Draft
        $(document).on('click', '.save-draft-btn', function() {
            submitConsultation(false); // is_report_finalized = 0
        });

        // Finalize
        $(document).on('click', '.finalize-btn', async function() {
            const dialogTitle = "Finalize Report";
            const confirmMsg = "This action will finalize the consultation details. Once this form is finalized, it cannot be editing again and thus a Report will be generated.";
            let confirmed = await ConfirmDialogBox(confirmMsg, dialogTitle);
            if (!confirmed) return;
            submitConsultation(true); // is_report_finalized = 1
        });

    });
</script>