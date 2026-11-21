<?php

$user_group_options = getUserGroupOptions();

?>
<div class="card-body">
    <form id="add_new_user_designation" method="POST" onsubmit="return false">

        <div class="row">


            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="designation_name">Designation Name</label>
                <input type="text" class="form-control" id="designation_name" placeholder="Designation Name" value="" name="designation_name" required>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="default_honorifics">Default Honorifics</label>
                <input type="text" class="form-control" id="default_honorifics" placeholder="Default Honorifics" value="" name="default_honorifics">
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="default_user_group">Default User Group</label>
                <select name="default_user_group" id="default_user_group" class="form-control" required>
                    <?php
                    if (mysqli_num_rows($user_group_options) > 0) {
                        echo '<option selected disabled>Select Default User Group</option>';
                        while ($row = mysqli_fetch_assoc($user_group_options)) {
                            // ignore if super user group
                            if ($row['is_super_admin'] == 1) continue;

                            echo '<option value="' . $row['id'] . '">' . $row['group_name'] . '</option>';
                        }
                    } else {
                        echo '<option disabled>No User Groups Available</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="color_code">User Designation Color</label>
                <input type="color" class="form-control" id="color_code" value="<?= systemVariable('default_user_designation_color') ?>" name="color_code" title="Choose User Designation color">
            </div>

            <div class="col-12 col-md-6 mb-3 mt-4">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_consultant" id="is_consultant">
                    <label class="form-check-label" for="is_consultant">Is the User a Consultant?</label>
                </div>
            </div>


            <div class="col-12 mb-3">
                <label class="form-label" for="remarks">Remarks</label>
                <textarea class="form-control" id="remarks" placeholder="Remarks" name="remarks" data-info="remarks"></textarea>
            </div>
        </div>

        <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Publish</button>
            <button type="reset" class="btn btn-secondary me-2">Reset</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(() => {


        $('#add_new_user_designation').on('submit', function(e) {
            e.preventDefault();

            var form_data = $('#add_new_user_designation').serialize();
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=add_new_user_designation";


            ajax_request(form_data).done(function(response) {
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

                    window.location = "<?= systemVariable('SITE_HOME') ?>admin/user-designations/?id=" + response.id;

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