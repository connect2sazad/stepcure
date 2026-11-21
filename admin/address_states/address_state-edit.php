<div class="card-body">

    <form id="update_address_state" method="POST" onsubmit="return false" enctype="multipart/form-data">

        <div class="row">

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="state_name">State Name</label>
                <input type="text" class="form-control" id="state_name" placeholder="<?= $address_state['state_name'] ?>" value="<?= $address_state['state_name'] ?>" name="state_name" required>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="state_code">State Code</label>
                <input type="text" class="form-control" id="state_code" placeholder="<?= $address_state['state_code'] ?>" value="<?= $address_state['state_code'] ?>" name="state_code" required>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="gst_code">GST Code</label>
                <input type="number" class="form-control" id="gst_code" placeholder="<?= $address_state['gst_code'] ?>" value="<?= $address_state['gst_code'] ?>" name="gst_code" required>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label" for="remarks">Remarks</label>
                <textarea class="form-control" id="remarks" placeholder="<?= $address_state['remarks'] ?>" name="remarks" data-info="remarks"><?= $address_state['remarks'] ?></textarea>
            </div>
        </div>

        <div class="mt-2 d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-dark">Reset</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>
        </div>

    </form>
</div>


<script>
    $(document).ready(() => {

        const address_stateForm = enableUnsavedChangesWarning('#update_address_state');

        $('#update_address_state').on('submit', function(e) {
            e.preventDefault();

            const formElem = document.getElementById('update_address_state');

            let form_data;

            form_data = $(formElem).serialize();
            form_data += "&id=<?= $address_state['id'] ?>";
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=update_address_state";


            ajax_request(form_data).done(function(response) {

                if (response.status == 'success') {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    address_stateForm?.markFormClean?.(); // only if defined

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
            }).fail(function(jqXHR, textStatus, errorThrown) {
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
        });
    });
</script>