<?php

$random_id = (int) getRandomId(5, 'numeric');

$pages = getPagesList();

$temp_site_id = "SC-TMP-" . getRandomId(5, 'numeric');

$address_states_options = getAddressStatesOptions();

?>
<div class="card-body">
    <form id="add_new_site" method="POST" onsubmit="return false" enctype="multipart/form-data">
        <div class="row">

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="site_name">Site Name</label>
                <input type="text" class="form-control" id="site_name" placeholder="Site Name" value="" name="site_name" required>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="ref_person_name">Reference Person Name</label>
                <input type="text" class="form-control" id="ref_person_name" placeholder="Reference Person Name" value="" name="ref_person_name">
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="ref_person_details">Reference Person Details</label>
                <input type="text" class="form-control" id="ref_person_details" placeholder="Reference Person Details" value="" name="ref_person_details">
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

            <div class="col-12">
                <p class="text-info text-justify">* Please Note that Site's Location State &amp; City cannot be changed once it is created!</p>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="address_pin">PIN Code</label>
                <input type="text" class="form-control" id="address_pin" placeholder="PIN Code" value="" name="address_pin">
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="color_code">Site Color</label>
                <input type="color" class="form-control" id="color_code" value="<?= systemVariable('default_site_color') ?>" name="color_code" title="Choose site color">
            </div>

            <div class="col-12 mb-3">
                <img src="" style="height: 100px; width: 100px;" id="site_logo_display" alt="Site Logo">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="site_logo">Site Logo</label>
                <input type="file" id="site_logo" name="site_logo" class="form-control" accept="image/*" placeholder="Site Logo">
            </div>

            <div class="col-12 mb-3">
                <label class="form-label" for="remarks">Remarks</label>
                <textarea class="form-control" id="remarks" placeholder="Enter Remarks" name="remarks" data-info="remarks"></textarea>
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

        previewSelectedUploadImage('#site_logo', '#site_logo_display');

        const siteForm = enableUnsavedChangesWarning('#add_new_site');

        $('#add_new_site').on('submit', function(e) {
            e.preventDefault();

            const formElem = document.getElementById('add_new_site');

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
                form_data.append('updated_by', '<?= $_SESSION[USER_AUTH] ?>');
                form_data.append('request_type', 'add_new_site');

            } else {
                // ✅ Old behavior if no files
                form_data = $(formElem).serialize();
                form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
                form_data += "&request_type=add_new_site";
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

                    window.location = "<?= systemVariable('SITE_HOME') ?>admin/treatment-sites/?id=" + response.id;

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