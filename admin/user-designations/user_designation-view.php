<?php
$user_group_options = getUserGroupOptions();
?>
<div class="card-body">

    <div class="row">

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="designation_name">Designation Name</label>
            <input type="text" class="form-control" id="designation_name" placeholder="<?= $user_designation['designation_name'] ?>" value="<?= $user_designation['designation_name'] ?>" name="designation_name" disabled>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="default_honorifics">Default Honorifics</label>
            <input type="text" class="form-control" id="default_honorifics" placeholder="<?= $user_designation['default_honorifics'] ?>" value="<?= $user_designation['default_honorifics'] ?>" name="default_honorifics" disabled>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="default_user_group">Default User Group</label>
            <select name="default_user_group" id="default_user_group" class="form-control" disabled>
                <option disabled>Select Default User Group</option>
                <?php
                if (mysqli_num_rows($user_group_options) > 0) {
                    while ($row = mysqli_fetch_assoc($user_group_options)) {
                        // check if the user group is already selected
                        $selected_user_group = $user_designation['default_user_group'] == $row['id'] ? 'selected' : '';

                        // ignore if super user group
                        if ($row['is_super_admin'] == 1) continue;

                        echo '<option value="' . $row['id'] . '" ' . $selected_user_group . '>' . $row['group_name'] . '</option>';
                    }
                } else {
                    echo '<option disabled>No User Groups Available</option>';
                }
                ?>
            </select>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="color_code">User Designation Color</label>
            <input type="color" class="form-control" id="color_code" value="<?= $user_designation['color_code'] ?>" name="color_code" title="Choose User Designation color" disabled>
        </div>

        <div class="col-12 col-md-6 mb-3 mt-4">
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" name="is_consultant" id="is_consultant" <?= $user_designation['is_consultant'] ? 'checked' : '' ?> disabled>
                <label class="form-check-label" for="is_consultant">Is the User a Consultant?</label>
            </div>
        </div>


        <div class="col-12 mb-3">
            <label class="form-label" for="remarks">Remarks</label>
            <textarea class="form-control" id="remarks" placeholder="<?= $user_designation['remarks'] ?>" name="remarks" data-info="remarks" disabled><?= $user_designation['remarks'] ?></textarea>
        </div>
    </div>

    <div class="mt-2">
        <button type="button" class="btn btn-secondary me-2" onclick="window.location.href='./?id=<?= $user_designation_id ?>'">Edit</button>
    </div>
    </form>
</div>


<script>
    $(document).ready(() => {

        $('#update_user_designation').on('submit', function(e) {
            e.preventDefault();

            var form_data = $('#update_user_designation').serialize();
            form_data += "&id=<?= $user_designation['id'] ?>";
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=update_user_designation";


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