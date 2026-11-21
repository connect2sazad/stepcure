<?php

$address_states_options = getAddressStatesOptions();
?>
<div class="card">
    <div class="card-body">

        <form id="update_patient" method="POST" onsubmit="return false">

            <div class="row">

                <div class="col-12 mb-3">
                    <label class="form-label" for="pid">Patient ID</label>
                    <input type="number" class="form-control" id="pid" placeholder="PI-<?= prefix_00($patient['patientid']) ?>" value="PI-<?= prefix_00($patient['patientid']) ?>" disabled>
                    <div class="text-info mt-1">Please Note: Patient ID cannot be changed as it is a system generated ID.</div>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label" for="uhid">UHID</label>
                    <input type="number" class="form-control" id="uhid" placeholder="<?= $patient['uhid'] ?>" value="<?= $patient['uhid'] ?>" disabled>
                    <div class="text-info mt-1">Please Note: UHID cannot be changed once a patient is registered.</div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" placeholder="<?= $patient['first_name'] ?>" value="<?= $patient['first_name'] ?>" name="first_name" required>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" placeholder="<?= $patient['last_name'] ?>" value="<?= $patient['last_name'] ?>" name="last_name">
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <small class="form-label d-block">Gender</small>
                    <div class="form-check form-check-inline mt-3">
                        <input class="form-check-input" type="radio" name="gender" id="gender_m" value="m" <?= $patient['gender'] == 'm' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="gender_m">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_f" value="f" <?= $patient['gender'] == 'f' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="gender_f">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_o" value="o" <?= $patient['gender'] == 'o' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="gender_o">Others</label>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="age">Age (in years)</label>
                    <input type="number" class="form-control" id="age" placeholder="<?= $patient['age'] ?>" value="<?= $patient['age'] ?>" name="age">
                </div>

                <div class="card-body">
                    <div class="divider">
                        <div class="divider-text">CONTACT DETAILS</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="" <?= $patient['address'] ?>" value="" <?= $patient['address'] ?>" name="address">
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="address_state">State Location</label>
                    <select class="form-control" name="address_state" id="address_state">
                        <?php
                        if (mysqli_num_rows($address_states_options) > 0) {
                            echo '<option selected disabled>Select Address State</option>';
                            while ($row = mysqli_fetch_assoc($address_states_options)) {

                                // select the user designation in ui from db
                                $selected_address_state = $patient['address_state'] == $row['id'] ? 'selected' : '';

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

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="address_city">City Location</label>
                    <input type="text" class="form-control" id="address_city" placeholder="<?= $patient['address_city'] ?>" value="<?= $patient['address_city'] ?>" name="address_city" required>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="address_pin">PIN Code</label>
                    <input type="text" class="form-control" id="address_pin" placeholder="<?= $patient['address_pin'] ?>" value="<?= $patient['address_pin'] ?>" name="address_pin" required>
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="<?= $patient['email'] ?>" value="<?= $patient['email'] ?>" aria-label="Email">
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="phone">Phone No</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="<?= $patient['phone'] ?>" value="<?= $patient['phone'] ?>">
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="whatsapp_no">Whatsapp No</label>
                    <input type="text" class="form-control" id="whatsapp_no" name="whatsapp_no" placeholder="<?= $patient['whatsapp_no'] ?>" value="<?= $patient['whatsapp_no'] ?>">
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="alt_phone">Alt. Phone No</label>
                    <input type="text" class="form-control" id="alt_phone" name="alt_phone" placeholder="<?= $patient['alt_phone'] ?>" value="<?= $patient['alt_phone'] ?>">
                </div>

                <div class="card-body">
                    <div class="divider">
                        <div class="divider-text">OTHER DETAILS</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="height">Height (IN CM)</label>
                    <input type="number" class="form-control" id="height" placeholder="<?= $patient['height'] ?>" value="<?= $patient['height'] ?>" name="height">
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="weight">Weight (IN KG)</label>
                    <input type="number" class="form-control" id="weight" placeholder="<?= $patient['weight'] ?>" value="<?= $patient['weight'] ?>" name="weight">
                </div>

                <div class="col-12 col-md-6 mb-3 mt-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_diabetic" id="is_diabetic" <?= $patient['is_diabetic'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_diabetic">Is the patient Diabetic?</label>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3" data-info="patient-diabetic" <?= $patient['is_diabetic'] ? '' : 'style="display: none"' ?>>
                    <label class="form-label" for="diabetic_type">Diabetic Type</label>
                    <input type="text" class="form-control" id="diabetic_type" placeholder="<?= $patient['diabetic_type'] ?>" value="<?= $patient['diabetic_type'] ?>" name="diabetic_type">
                </div>

                <div class="col-12 col-md-6 mb-3" data-info="patient-diabetic" <?= $patient['is_diabetic'] ? '' : 'style="display: none"' ?>>
                    <label class="form-label" for="diabetic_years">For how many years has the patient had diabetes?</label>
                    <input type="number" class="form-control" id="diabetic_years" placeholder="<?= $patient['diabetic_years'] ?>" value="<?= $patient['diabetic_years'] ?>" name="diabetic_years">
                </div>

                <div class="col-12 col-md-6 mb-3" data-info="patient-diabetic" <?= $patient['is_diabetic'] ? '' : 'style="display: none"' ?>>
                    <label class="form-label" for="diabetic_level">Diabetic Level</label>
                    <select class="form-control" name="diabetic_level" id="diabetic_level">
                        <option <?= $patient['diabetic_level'] == '' ? 'selected' : '' ?> disabled>Select Diabetic Level</option>
                        <option value="hba1c" <?= $patient['diabetic_level'] == 'hba1c' ? 'selected' : '' ?>>HBA1c</option>
                        <option value="rbs" <?= $patient['diabetic_level'] == 'rbs' ? 'selected' : '' ?>>RBS</option>
                    </select>
                </div>

                <div class="col-12 col-md-6 mb-3" data-info="patient-diabetic" <?= $patient['is_diabetic'] ? '' : 'style="display: none"' ?>>
                    <label class="form-label" for="diabetic_value">Diabetes Value</label>
                    <input type="number" class="form-control" id="diabetic_value" placeholder="<?= $patient['diabetic_value'] ?>" value="<?= $patient['diabetic_value'] ?>" name="diabetic_value">
                </div>

                <div class="col-12 col-md-6 mb-3 mt-4" data-info="patient-diabetic" <?= $patient['is_diabetic'] ? '' : 'style="display: none"' ?>>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_inherited" id="is_inherited" <?= $patient['is_inherited'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_inherited">Does the patient have a family history of diabetes?</label>
                    </div>
                </div>


                <div class="col-12 col-md-6 mb-3 mt-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_foot_examination_done" id="is_foot_examination_done" <?= $patient['is_foot_examination_done'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_foot_examination_done">Has the foot examination been completed?</label>
                    </div>
                </div>

                <div class="card-body">
                    <div class="divider">
                        <div class="divider-text">REMARKS</div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label" for="remarks">Remarks</label>
                    <textarea class="form-control" id="remarks" placeholder="<?= $patient['remarks'] ?>" name="remarks" data-info="remarks"><?= $patient['remarks'] ?></textarea>
                </div>
            </div>

            <div class="mt-2 d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="reset" class="btn btn-dark">Reset</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>
            </div>

        </form>
    </div>
</div>

<script>
    $(document).ready(() => {

        $('#update_patient').on('submit', function(e) {
            e.preventDefault();

            var form_data = $('#update_patient').serialize();
            form_data += "&id=<?= $patient['id'] ?>";
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=update_patient";

            // console.log(form_data);

            ajax_request(form_data).done(function(response) {
                // console.log(response);
                // response = JSON.parse(response);

                if (response.status == 'success') {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();

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
            });
        });
    });
</script>
<script>
    $(document).ready(function() {

        // check if patient is diabetic
        $('#is_diabetic').on('change', function() {
            if ($(this).is(':checked')) {
                $('[data-info="patient-diabetic"]').toggle();
            } else {
                $('[data-info="patient-diabetic"]').toggle();
            }
        });

    });
</script>