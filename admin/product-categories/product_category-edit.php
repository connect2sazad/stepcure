<div class="card-body">

    <form id="update_product_category" method="POST" onsubmit="return false" enctype="multipart/form-data"><?= sc_token() ?>

        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" placeholder="<?= $product_category['slug'] ?>" value="<?= $product_category['slug'] ?>" name="slug" readonly>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" placeholder="<?= $product_category['category_name'] ?>" value="<?= $product_category['category_name'] ?>" name="category_name" required>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="color_code">Category Color</label>
                <input type="color" class="form-control" id="color_code" value="<?= $product_category['color_code'] ?>" name="color_code" title="Choose product_category color">
            </div>

            <div class="col-12 mb-3">
                <img src="<?= systemVariable('SITE_HOME') . 'uploads/' . $product_category['category_image'] ?>" style="height: 100px; width: 100px;" id="category_image_display" alt="Category Image Not Found">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="category_image">Category Image</label>
                <input type="file" id="category_image" name="category_image" class="form-control" accept="image/*" placeholder="Category Image">
            </div>

            <div class="col-12 mb-3">
                <label class="form-label" for="remarks">Remarks</label>
                <textarea class="form-control" id="remarks" placeholder="<?= $product_category['remarks'] ?>" name="remarks" data-info="remarks"><?= $product_category['remarks'] ?></textarea>
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
        
        previewSelectedUploadImage('#category_image', '#category_image_display');

        const product_categoryForm = enableUnsavedChangesWarning('#update_product_category');

        $('#update_product_category').on('submit', function(e) {
            e.preventDefault();

            const formElem = document.getElementById('update_product_category');

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
                form_data.append('id', '<?= $product_category['id'] ?>');
                form_data.append('updated_by', '<?= $_SESSION[USER_AUTH] ?>');
                form_data.append('request_type', 'update_product_category');

            } else {
                // ✅ Old behavior if no files
                form_data = $(formElem).serialize();
                form_data += "&id=<?= $product_category['id'] ?>";
                form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
                form_data += "&request_type=update_product_category";
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

                    product_categoryForm?.markFormClean?.(); // only if defined

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