<?php

$address_state = getAddressStateById($site['address_state']);
$address_state = $address_state['state_name'] . " (" . $address_state['state_code'] . ")";

?>
<div class="card-body">

    <div class="row" id="site-details">
        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="site_id">Site ID</label>
            <input type="text" class="form-control" id="site_id" placeholder="<?= $site['site_id'] ?>" value="<?= $site['site_id'] ?>" name="site_id" disabled>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="site_name">Site Name</label>
            <input type="text" class="form-control" id="site_name" placeholder="<?= $site['site_name'] ?>" value="<?= $site['site_name'] ?>" name="site_name" disabled>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="ref_person_name">Reference Person Name</label>
            <input type="text" class="form-control" id="ref_person_name" placeholder="<?= $site['ref_person_name'] ?>" value="<?= $site['ref_person_name'] ?>" name="ref_person_name" disabled>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="ref_person_details">Reference Person Details</label>
            <input type="text" class="form-control" id="ref_person_details" placeholder="<?= $site['ref_person_details'] ?>" value="<?= $site['ref_person_details'] ?>" name="ref_person_details" disabled>
        </div>

        <div class="col-12 mb-3">
            <label class="form-label" for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="<?= $site['address'] ?>" value="<?= $site['address'] ?>" name="address" disabled>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="address_state">State Location</label>
            <input type="text" class="form-control" id="address_state" placeholder="<?= $address_state ?>" value="<?= $address_state ?>" name="address_state" disabled>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="address_city">City Location</label>
            <input type="text" class="form-control" id="address_city" placeholder="<?= $site['address_city'] ?> (<?= get_city_code($site['address_city']) ?>)" value="<?= $site['address_city'] ?> (<?= get_city_code($site['address_city']) ?>)" name="address_city" disabled>
        </div>

        <div class="col-12">
            <p class="text-info text-justify">* Please Note that Site's Location State &amp; City cannot be changed once it is created!</p>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="address_pin">PIN Code</label>
            <input type="text" class="form-control" id="address_pin" placeholder="<?= $site['address_pin'] ?>" value="<?= $site['address_pin'] ?>" name="address_pin" disabled>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="color_code">Site Color</label>
            <input type="color" class="form-control" id="color_code" value="<?= $site['color_code'] ?>" name="color_code" title="Choose site color" disabled>
        </div>

        <div class="col-12 mb-3">
            <img src="<?= systemVariable('SITE_HOME') . 'uploads/' . $site['site_logo'] ?>" style="height: 100px; width: 100px;" id="site_logo_display" alt="Site Logo">
        </div>

        <div class="col-12 mb-3">
            <label class="form-label" for="remarks">Remarks</label>
            <textarea class="form-control" id="remarks" placeholder="<?= $site['remarks'] ?>" name="remarks" data-info="remarks" disabled><?= $site['remarks'] ?></textarea>
        </div>
    </div>

    <div class="mt-2 d-flex flex-wrap gap-2">
        <?php
        // show edit button only when the user has access
        if (checkPermissions('update', $user_permissions, $user_group_permissions)) {
        ?>

            <button type="button" class="btn btn-info" onclick="window.location.href='./?id=<?= $site_id ?>'">Edit</button>

        <?php
        }
        ?>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>
    </div>

</div>


<script>
    $(document).ready(() => {

        $('#update_site').on('submit', function(e) {
            e.preventDefault();

            var form_data = $('#update_site').serialize();
            form_data += "&id=<?= $site['id'] ?>";
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=update_site";

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