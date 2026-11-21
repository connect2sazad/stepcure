<div class="card-body">

    <div class="row" id="address_state-details">

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="state_name">State Name</label>
            <input type="text" class="form-control" id="state_name" placeholder="<?= $address_state['state_name'] ?>" value="<?= $address_state['state_name'] ?>" name="state_name" disabled>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="state_code">State Code</label>
            <input type="text" class="form-control" id="state_code" placeholder="<?= $address_state['state_code'] ?>" value="<?= $address_state['state_code'] ?>" name="state_code" disabled>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="gst_code">GST Code</label>
            <input type="text" class="form-control" id="gst_code" placeholder="<?= $address_state['gst_code'] ?>" value="<?= $address_state['gst_code'] ?>" name="gst_code" disabled>
        </div>

        <div class="col-12 mb-3">
            <label class="form-label" for="remarks">Remarks</label>
            <textarea class="form-control" id="remarks" placeholder="<?= $address_state['remarks'] ?>" name="remarks" data-info="remarks" disabled><?= $address_state['remarks'] ?></textarea>
        </div>
    </div>

    <div class="mt-2 d-flex flex-wrap gap-2">
        <?php
        // show edit button only when the user has access
        if (checkPermissions('update', $user_permissions, $user_group_permissions)) {
        ?>

            <button type="button" class="btn btn-info" onclick="window.location.href='./?id=<?= $address_state_id ?>'">Edit</button>

        <?php
        }
        ?>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>
    </div>

</div>


<script>
    $(document).ready(() => {

        $('#update_address_state').on('submit', function(e) {
            e.preventDefault();

            var form_data = $('#update_address_state').serialize();
            form_data += "&id=<?= $address_state['id'] ?>";
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=update_address_state";

            // console.log(form_data);

            ajax_request(form_data).done(function(response) {
                // console.log(response);
                response = JSON.parse(response);

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