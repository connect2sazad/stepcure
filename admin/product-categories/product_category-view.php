<div class="card-body">

    <div class="row" id="product_category-details">
        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" placeholder="<?= $product_category['slug'] ?>" value="<?= $product_category['slug'] ?>" name="slug" disabled>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="category_name">Category Name</label>
            <input type="text" class="form-control" id="category_name" placeholder="<?= $product_category['category_name'] ?>" value="<?= $product_category['category_name'] ?>" name="category_name" disabled>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="color_code">Category Color</label>
            <input type="color" class="form-control" id="color_code" value="<?= $product_category['color_code'] ?>" name="color_code" title="Choose product_category color" disabled>
        </div>

        <?php
            if($product_category['category_image'] != '') {
        ?>
        <div class="col-12 mb-3">
            <img src="<?= systemVariable('SITE_HOME') . 'uploads/' . $product_category['category_image'] ?>" style="height: 100px; width: 100px;" id="category_image_display" alt="Category Image">
        </div>
        <?php
            }
            ?>

        <div class="col-12 mb-3">
            <label class="form-label" for="remarks">Remarks</label>
            <textarea class="form-control" id="remarks" placeholder="<?= $product_category['remarks'] ?>" name="remarks" data-info="remarks" disabled><?= $product_category['remarks'] ?></textarea>
        </div>
    </div>

    <div class="mt-2 d-flex flex-wrap gap-2">
        <?php
        // show edit button only when the user has access
        if (checkPermissions('update', $user_permissions, $user_group_permissions)) {
        ?>

            <button type="button" class="btn btn-info" onclick="window.location.href='./?id=<?= $product_category_id ?>'">Edit</button>

        <?php
        }
        ?>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>
    </div>

</div>


<script>
    $(document).ready(() => {

        $('#update_product_category').on('submit', function(e) {
            e.preventDefault();

            var form_data = $('#update_product_category').serialize();
            form_data += "&id=<?= $product_category['id'] ?>";
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=update_product_category";

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