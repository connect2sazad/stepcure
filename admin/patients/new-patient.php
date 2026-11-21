<?php

$address_states_options = getAddressStatesOptions();

?>
<div class="card">
    <div class="card-body">
        <form id="add_new_patient" method="POST" onsubmit="return false">
            <div class="row">

                <div class="col-12 mb-3">
                    <label class="form-label" for="uhid">UHID</label>
                    <input type="number" class="form-control" id="uhid" placeholder="UHID" value="" name="uhid">
                    <div class="text-danger mt-1" id="uhid_error" style="display: none;">A patient with the same UHD already exists!</div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" placeholder="First Name" value="" name="first_name" required>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" placeholder="Last Name" value="" name="last_name">
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <small class="form-label d-block">Gender</small>
                    <div class="form-check form-check-inline mt-3">
                        <input class="form-check-input" type="radio" name="gender" id="gender_m" value="m">
                        <label class="form-check-label" for="gender_m">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_f" value="f">
                        <label class="form-check-label" for="gender_f">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_o" value="o">
                        <label class="form-check-label" for="gender_o">Others</label>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="age">Age (in years)</label>
                    <input type="number" class="form-control" id="age" placeholder="Age (in years)" value="" name="age">
                </div>

                <div class="card-body">
                    <div class="divider">
                        <div class="divider-text">CONTACT DETAILS</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Address" value="" name="address">
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="address_state">State Location</label>
                    <select class="form-control" name="address_state" id="address_state" required>
                        <!-- <option value="19">Odisha</option> -->
                        <?php
                        if (mysqli_num_rows($address_states_options) > 0) {
                            echo '<option selected disabled>Select a State</option>';
                            while ($row = mysqli_fetch_assoc($address_states_options)) {
                        ?>
                                <option value="<?= $row['id'] ?>"><?= $row['state_name'] ?> (<?= $row['state_code'] ?>)</option>
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
                    <input type="text" class="form-control" id="address_city" placeholder="City Location" value="" name="address_city" required>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="address_pin">PIN Code</label>
                    <input type="text" class="form-control" id="address_pin" placeholder="PIN Code" value="" name="address_pin" required>
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" aria-label="Email">
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="phone">Phone No</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone No">
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="whatsapp_no">Whatsapp No</label>
                    <input type="text" class="form-control" id="whatsapp_no" name="whatsapp_no" placeholder="Whatsapp No">
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="alt_phone">Alt. Phone No</label>
                    <input type="text" class="form-control" id="alt_phone" name="alt_phone" placeholder="Alt. Phone No">
                </div>

                <div class="card-body">
                    <div class="divider">
                        <div class="divider-text">OTHER DETAILS</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="height">Height (IN CM)</label>
                    <input type="number" class="form-control" id="height" placeholder="Height (in cm)" value="" name="height">
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="weight">Weight (IN KG)</label>
                    <input type="number" class="form-control" id="weight" placeholder="Weight (in kg)" value="" name="weight">
                </div>

                <div class="col-12 col-md-6 mb-3 mt-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_diabetic" id="is_diabetic">
                        <label class="form-check-label" for="is_diabetic">Is the patient Diabetic?</label>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3" data-info="patient-diabetic">
                    <label class="form-label" for="diabetic_type">Diabetic Type</label>
                    <input type="text" class="form-control" id="diabetic_type" placeholder="Diabetic Type" value="" name="diabetic_type">
                </div>

                <div class="col-12 col-md-6 mb-3" data-info="patient-diabetic">
                    <label class="form-label" for="diabetic_years">For how many years has the patient had diabetes?</label>
                    <input type="number" class="form-control" id="diabetic_years" placeholder="For how many years has the patient had diabetes?" name="diabetic_years">
                </div>

                <div class="col-12 col-md-6 mb-3" data-info="patient-diabetic">
                    <label class="form-label" for="diabetic_level">Diabetic Level</label>
                    <select class="form-control" name="diabetic_level" id="diabetic_level">
                        <option selected disabled>Select a State</option>
                        <option value="hba1c">HBA1c</option>
                        <option value="rbs">RBS</option>
                    </select>
                </div>

                <div class="col-12 col-md-6 mb-3" data-info="patient-diabetic">
                    <label class="form-label" for="diabetic_value">Diabetes Value</label>
                    <input type="number" class="form-control" id="diabetic_value" placeholder="Diabetes Value" name="diabetic_value">
                </div>

                <div class="col-12 col-md-6 mb-3 mt-4" data-info="patient-diabetic">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_inherited" id="is_inherited">
                        <label class="form-check-label" for="is_inherited">Does the patient have a family history of diabetes?</label>
                    </div>
                </div>


                <div class="col-12 col-md-6 mb-3 mt-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_foot_examination_done" id="is_foot_examination_done">
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
                    <textarea class="form-control" id="remarks" placeholder="Enter Remarks" name="remarks" data-info="remarks"></textarea>
                </div>
            </div>

            <div class="mt-2">
                <button type="submit" id="submit-btn" class="btn btn-primary me-2">Publish</button>
                <button type="reset" class="btn btn-secondary me-2">Reset</button>
                <!--<button type="button" onclick="fillsample()">fill</button>-->
            </div>
        </form>
    </div>
</div>

<!-- script to fill data -->
<script>
    // fills_manual();

    // // sample data filler script
    // function fillsample() {
    //     fill('uhid', 'uhid');
    //     fill('firstname', 'first_name');
    //     fill('lastname', 'last_name');
    //     fill_radio('gender');
    //     fill_number('age', 2);
    //     fill('address', 'address');
    //     fill_select('address_state', true);
    //     fill('city', 'address_city');
    //     fill('pin', 'address_pin');
    //     fill('email', 'email');
    //     fill('phone', 'phone');
    //     fill('phone', 'whatsapp_no');
    //     fill('phone', 'alt_phone');
    //     fill_number('height', 3);
    //     fill_number('weight', 3);
    //     fill_checkboxes('is_diabetic');
    //     fill_number('diabetic_years', 1);
    //     fill_number('diabetic_value', 3);
    //     fill_select('diabetic_level', true);
    //     fill_checkboxes('is_inherited');
    //     fill_checkboxes('is_foot_examination_done');
    // }
</script>

<script>
    $(document).ready(() => {

        $('#add_new_patient').on('submit', function(e) {
            e.preventDefault();

            var form_data = $('#add_new_patient').serialize();
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=add_new_patient";

            console.log(form_data);

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

                    window.location = "<?= systemVariable('SITE_HOME') ?>admin/patients/?id=" + response.id;

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

<!-- script to check uhid -->
<script>
    $(document).ready(function() {

        // hide all data-info="patient-diabetic" initially
        $('[data-info="patient-diabetic"]').hide();

        // check if patient is diabetic
        $('#is_diabetic').on('change', function() {
            if ($(this).is(':checked')) {
                $('[data-info="patient-diabetic"]').toggle();
            } else {
                $('[data-info="patient-diabetic"]').toggle();
            }
        });


        // check uhid details
        // Bind the event correctly
        $('#uhid').on('change keyup blur', function() {
            checkAvailability();
        });

        // this function is used to check availability
        function checkAvailability() {
            const uhid = $('#uhid').val().trim();

            // Reset previous errors
            $('#uhid_error').hide();
            $('#uhid').removeClass('is-invalid');

            // If empty -> allow submit
            if (uhid === '') {
                $('#submit-btn').prop('disabled', false);
                return;
            }

            // Build request
            const form_data = {
                table: 'patients',
                request_type: 'check_multiple_availability',
                values: {
                    uhid: uhid
                }
            };

            ajax_request(form_data, false).done(function(response) {
                let parsed;

                try {
                    // If response already an object skip parsing
                    parsed = (typeof response === 'object') ? response : JSON.parse(response);
                } catch (e) {
                    console.error('Invalid JSON response for UHID check', response);
                    return;
                }

                if (parsed?.availability?.uhid === 'positive') {
                    // UHID already exists ❌
                    $('#uhid_error').show().text('A patient with the same UHID already exists!');
                    $('#uhid').addClass('is-invalid');
                    $('#submit-btn').prop('disabled', true);
                } else {
                    // UHID available ✅
                    $('#submit-btn').prop('disabled', false);
                }
            });
        }

    });
</script>