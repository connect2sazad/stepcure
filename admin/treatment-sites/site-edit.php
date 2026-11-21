<?php

$address_state = getAddressStateById($site['address_state']);
$address_state = $address_state['state_name'] . " (" . $address_state['state_code'] . ")";

?>
<div class="card-body">

    <form id="update_site" method="POST" onsubmit="return false" enctype="multipart/form-data">

        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="site_id">Site ID</label>
                <input type="text" class="form-control" id="site_id" placeholder="<?= $site['site_id'] ?>" value="<?= $site['site_id'] ?>" name="site_id" readonly>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="site_name">Site Name</label>
                <input type="text" class="form-control" id="site_name" placeholder="<?= $site['site_name'] ?>" value="<?= $site['site_name'] ?>" name="site_name" required>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="ref_person_name">Reference Person Name</label>
                <input type="text" class="form-control" id="ref_person_name" placeholder="<?= $site['ref_person_name'] ?>" value="<?= $site['ref_person_name'] ?>" name="ref_person_name" required>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="ref_person_details">Reference Person Details</label>
                <input type="text" class="form-control" id="ref_person_details" placeholder="<?= $site['ref_person_details'] ?>" value="<?= $site['ref_person_details'] ?>" name="ref_person_details" required>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label" for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="<?= $site['address'] ?>" value="<?= $site['address'] ?>" name="address" >
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="address_state">State Location</label>
                <input type="text" class="form-control" id="address_state" placeholder="<?= $address_state ?>" value="<?= $address_state ?>" name="address_state" readonly>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="address_city">City Location</label>
                <input type="text" class="form-control" id="address_city" placeholder="<?= $site['address_city'] ?> (<?= get_city_code($site['address_city']) ?>)" value="<?= $site['address_city'] ?> (<?= get_city_code($site['address_city']) ?>)" name="address_city" readonly>
            </div>

            <div class="col-12">
                <p class="text-info text-justify">* Please Note that Site's Location State &amp; City cannot be changed once it is created!</p>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="address_pin">PIN Code</label>
                <input type="text" class="form-control" id="address_pin" placeholder="<?= $site['address_pin'] ?>" value="<?= $site['address_pin'] ?>" name="address_pin">
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="color_code">Site Color</label>
                <input type="color" class="form-control" id="color_code" value="<?= $site['color_code'] ?>" name="color_code" title="Choose site color">
            </div>

            <div class="col-12 mb-3">
                <img src="<?= systemVariable('SITE_HOME') . 'uploads/' . $site['site_logo'] ?>" style="height: 100px; width: 100px;" id="site_logo_display" alt="Site Logo">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="site_logo">Site Logo</label>
                <input type="file" id="site_logo" name="site_logo" class="form-control" accept="image/*" placeholder="Site Logo">
            </div>

            <div class="col-12 mb-3">
                <label class="form-label" for="remarks">Remarks</label>
                <textarea class="form-control" id="remarks" placeholder="<?= $site['remarks'] ?>" name="remarks" data-info="remarks"><?= $site['remarks'] ?></textarea>
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
        
        previewSelectedUploadImage('#site_logo', '#site_logo_display');

        const siteForm = enableUnsavedChangesWarning('#update_site');

        $('#update_site').on('submit', function(e) {
            e.preventDefault();

            const formElem = document.getElementById('update_site');

            let hasFiles = $(formElem).find('input[type="file"]').length > 0;

            let form_data;

            if (hasFiles) {
                // ✅ Create FormData for file upload
                form_data = new FormData(formElem);

                // ✅ Client-side file size validation (1MB max)
                let fileInput = $(formElem).find('input[type="file"]')[0];
                if (fileInput && fileInput.files.length > 0) {
                    let file = fileInput.files[0];
                    if (file.size > 1048576) { // 1MB = 1024*1024 bytes
                        Toastify({
                            text: "File size exceeds 1 MB limit!",
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "red",
                        }).showToast();
                        return; // stop submission
                    }
                }

                // ✅ Add extra params manually for FormData
                form_data.append('id', '<?= $site['id'] ?>');
                form_data.append('updated_by', '<?= $_SESSION[USER_AUTH] ?>');
                form_data.append('request_type', 'update_site');

            } else {
                // ✅ Old behavior if no files
                form_data = $(formElem).serialize();
                form_data += "&id=<?= $site['id'] ?>";
                form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
                form_data += "&request_type=update_site";
            }


            ajax_request(form_data, true, hasFiles).done(function(response) {

                if (response.status == 'success') {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    siteForm?.markFormClean?.(); // only if defined

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