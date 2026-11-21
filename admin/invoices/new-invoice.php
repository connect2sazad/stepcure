<?php

$address_states_options = getAddressStatesOptions();

?>
<div class="card">
    <div class="card-body">
        <form id="add_new_invoice" method="POST" onsubmit="return false">
            <div class="row">

                <div class="col-6 mb-3">
                    <label class="form-label" for="customer_name">Customer Name</label>
                    <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name" required>
                </div>

                <div class="col-6 mb-3">
                    <label class="form-label" for="gst">GST No</label>
                    <input type="text" class="form-control text-uppercase" name="gst" id="gst" placeholder="GST No" required>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label" for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" autocomplete="off" required>
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="address_state">State Location</label>
                    <select class="form-control" name="address_state" id="address_state">
                        <?php
                        if (mysqli_num_rows($address_states_options) > 0) {
                            echo '<option selected disabled>Select Address State</option>';
                            while ($row = mysqli_fetch_assoc($address_states_options)) {

                                // select the user designation in ui from db
                                $selected_address_state = $invoice['address_state'] == $row['id'] ? 'selected' : '';

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
                    <input type="text" class="form-control" id="address_city" placeholder="City" name="address_city" required>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="address_pin">PIN Code</label>
                    <input type="text" class="form-control" id="address_pin" placeholder="PIN Code" name="address_pin" required>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="invoice_date">Invoice Date</label>
                    <input class="form-control" type="date" id="invoice_date" name="invoice_date" placeholder="Invoice Date" required>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="due_date">Due Date</label>
                    <input class="form-control" type="date" id="due_date" name="due_date" placeholder="Due Date" required>
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


<script>
    $(document).ready(() => {

        $('#add_new_invoice').on('submit', function(e) {
            e.preventDefault();

            

            var form_data = $('#add_new_invoice').serialize();
            form_data += "&created_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=add_new_invoice";

            if($('#address_state').val() == null){
                Toastify({
                        text: "Please select a State Location",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "red",
                    }).showToast();
                return;
            }
            // console.log(form_data);

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

                    window.location = "<?= systemVariable('SITE_HOME') ?>admin/invoices/?id=" + response.id;

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
                // console.log(response);
            });
        });
    });
</script>