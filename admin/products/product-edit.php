<?php

$category_options = getProductCategoryOptions();

$product_images = $product['product_images'];
$product_images = json_decode($product_images, true);

$details = json_decode($product['details'], true);
$technology = json_decode($product['technology'], true);
$features = json_decode($product['features'], true);
$pathology = json_decode($product['pathology'], true);

?>
<div class="card-body">

    <form id="update_product" method="POST" onsubmit="return false" enctype="multipart/form-data"><?= sc_token() ?>

        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" placeholder="<?= $product['slug'] ?>" value="<?= $product['slug'] ?>" name="slug" readonly>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" placeholder="<?= $product['product_name'] ?>" value="<?= $product['product_name'] ?>" name="product_name" required>
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="category_id">Product Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <?php
                    if (mysqli_num_rows($category_options) > 0) {
                        while ($row = mysqli_fetch_assoc($category_options)) {

                            // check if the category is already selected
                            $selected_category = $product['category_id'] == $row['id'] ? 'selected' : '';

                            echo '<option value="' . $row['id'] . '" ' . $selected_category . '>' . $row['category_name'] . '</option>';
                        }
                    } else {
                        echo '<option disabled>No Product Categories Available</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="type">Product Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="0" <?= $product['type'] == '0' ? 'selected' : '' ?>>Women's Footwear</option>
                    <option value="1" <?= $product['type'] == '1' ? 'selected' : '' ?>>Men's Footwear</option>
                    <option value="2" <?= $product['type'] == '2' ? 'selected' : '' ?>>Foot Orthotics</option><option value="3" <?= $product['type'] == '3' ? 'selected' : '' ?>>Custom Footwear</option>
                </select>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="product_color">Color</label>
                <input type="text" class="form-control" id="product_color" placeholder="Color" value="<?= $product['product_color'] ?>" name="product_color" required>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="product_color_display">Selected Color</label>
                <div id="product_color_display" style="height: 35px; width: 100%; border-radius: 0.375rem; background-color: <?= $product['product_color'] ?>;"></div>
            </div>

            <div class="col-12">
                <p class="text-info text-justify">* Please note that the above color input box accepts Color by Name, RGB/RGBA Code, HSL/HSLA Code, or Hexadecimal Code.</p>
            </div>


            <div class="divider">
                <div class="divider-text">Product Details</div>
            </div>

            <!-- Product Details Section -->
            <div id="product_details_wrapper">
                <?php
                if (!empty($details)) {
                    $index = 0;
                    foreach ($details as $key => $value) {

                ?>
                        <div class="row align-items-center product-detail" id="product_details<?= $index ?>">
                            <div class="col-12 col-md-5 mb-3">
                                <label class="form-label" for="details_name<?= $index ?>">Detail Name</label>
                                <input type="text" class="form-control" id="details_name<?= $index ?>" placeholder="Detail Name" name="details_name[]" value="<?= $key ?>" required>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="details_value<?= $index ?>">Detail Value</label>
                                <input type="text" class="form-control" id="details_value<?= $index ?>" placeholder="Detail Value" name="details_value[]" value="<?= $value ?>" required>
                            </div>
                            <div class="col-12 col-md-1 mt-2 d-flex align-items-center justify-content-center">
                                <button type="button" class="btn btn-outline-danger remove-detail ms-md-2">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    <?php
                        $index++;
                    }
                } else {

                    ?>
                    <div class="row align-items-center product-detail" id="product_details0">
                        <div class="col-12 col-md-5 mb-3">
                            <label class="form-label" for="details_name0">Detail Name</label>
                            <input type="text" class="form-control" id="details_name0" placeholder="Detail Name" name="details_name[]">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="details_value0">Detail Value</label>
                            <input type="text" class="form-control" id="details_value0" placeholder="Detail Value" name="details_value[]">
                        </div>
                        <div class="col-12 col-md-1 mt-2 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-outline-danger remove-detail ms-md-2">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="col-12 mb-3">
                <button type="button" class="btn btn-outline-info btn-sm" id="add_detail">+ Add Another Detail</button>
            </div>

            <div class="divider">
                <div class="divider-text">Product Technology</div>
            </div>

            <!-- Product Technology Section -->
            <div id="product_technology_wrapper">
                <?php
                if (!empty($technology)) {
                    $index = 0;
                    foreach ($technology as $key => $value) {

                ?>
                        <div class="row align-items-center product-technology" id="product_technology<?= $index ?>">
                            <div class="col-12 col-md-5 mb-3">
                                <label class="form-label" for="technology_name<?= $index ?>">Technology Name</label>
                                <input type="text" class="form-control" id="technology_name<?= $index ?>" placeholder="Technology Name" name="technology_name[]" value="<?= $key ?>" required>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="technology_description<?= $index ?>">Technology Value</label>
                                <input type="text" class="form-control" id="technology_description<?= $index ?>" placeholder="Technology Value" name="technology_description[]" value="<?= $value ?>" required>
                            </div>
                            <div class="col-12 col-md-1 mt-2 d-flex align-items-center justify-content-center">
                                <button type="button" class="btn btn-outline-danger remove-technology ms-md-2">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    <?php
                        $index++;
                    }
                } else {

                    ?>
                    <div class="row align-items-center product-technology" id="product_technology0">
                        <div class="col-12 col-md-5 mb-3">
                            <label class="form-label" for="technology_name0">Technology Name</label>
                            <input type="text" class="form-control" id="technology_name0" placeholder="Technology Name" name="technology_name[]">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="technology_description0">Technology Value</label>
                            <input type="text" class="form-control" id="technology_description0" placeholder="Technology Value" name="technology_description[]">
                        </div>
                        <div class="col-12 col-md-1 mt-2 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-outline-danger remove-technology ms-md-2">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="col-12 mb-3">
                <button type="button" class="btn btn-outline-info btn-sm" id="add_technology">+ Add Another Technology</button>
            </div>


            <div class="divider">
                <div class="divider-text">Product Features</div>
            </div>

            <!-- Product Features Section -->
            <div id="product_features_wrapper">
                <?php
                if (!empty($features)) {
                    $index = 0;
                    foreach ($features as $key => $value) {

                ?>
                        <div class="row align-items-center product-feature" id="product_features<?= $index ?>">
                            <div class="col-12 col-md-5 mb-3">
                                <label class="form-label" for="features_name<?= $index ?>">Feature Name</label>
                                <input type="text" class="form-control" id="features_name<?= $index ?>" placeholder="Feature Name" name="features_name[]" value="<?= $key ?>" required>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="features_value<?= $index ?>">Feature Value</label>
                                <input type="text" class="form-control" id="features_value<?= $index ?>" placeholder="Feature Value" name="features_value[]" value="<?= $value ?>" required>
                            </div>
                            <div class="col-12 col-md-1 mt-2 d-flex align-items-center justify-content-center">
                                <button type="button" class="btn btn-outline-danger remove-feature ms-md-2">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    <?php
                        $index++;
                    }
                } else {

                    ?>
                    <div class="row align-items-center product-feature" id="product_features0">
                        <div class="col-12 col-md-5 mb-3">
                            <label class="form-label" for="features_name0">Feature Name</label>
                            <input type="text" class="form-control" id="features_name0" placeholder="Feature Name" name="features_name[]">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="features_value0">Feature Value</label>
                            <input type="text" class="form-control" id="features_value0" placeholder="Feature Value" name="features_value[]">
                        </div>
                        <div class="col-12 col-md-1 mt-2 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-outline-danger remove-feature ms-md-2">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="col-12 mb-3">
                <button type="button" class="btn btn-outline-info btn-sm" id="add_feature">+ Add Another Feature</button>
            </div>

            <div class="divider">
                <div class="divider-text">Product Pathology</div>
            </div>

            <!-- Product Pathology Section -->
            <div id="product_pathology_wrapper">
                <?php
                if (!empty($pathology)) {
                    $index = 0;
                    foreach ($pathology as $key => $value) {

                ?>
                        <div class="row align-items-center product-pathology" id="product_pathology<?= $index ?>">
                            <div class="col-12 col-md-5 mb-3">
                                <label class="form-label" for="pathology_name<?= $index ?>">Pathology Name</label>
                                <input type="text" class="form-control" id="pathology_name<?= $index ?>" placeholder="Pathology Name" name="pathology_name[]" value="<?= $key ?>" required>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="pathology_description<?= $index ?>">Pathology Value</label>
                                <input type="text" class="form-control" id="pathology_description<?= $index ?>" placeholder="Pathology Value" name="pathology_description[]" value="<?= $value ?>" required>
                            </div>
                            <div class="col-12 col-md-1 mt-2 d-flex align-items-center justify-content-center">
                                <button type="button" class="btn btn-outline-danger remove-pathology ms-md-2">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    <?php
                        $index++;
                    }
                } else {

                    ?>
                    <div class="row align-items-center product-pathology" id="product_pathology0">
                        <div class="col-12 col-md-5 mb-3">
                            <label class="form-label" for="pathology_name0">Pathology Name</label>
                            <input type="text" class="form-control" id="pathology_name0" placeholder="Pathology Name" name="pathology_name[]">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="pathology_description0">Pathology Value</label>
                            <input type="text" class="form-control" id="pathology_description0" placeholder="Pathology Value" name="pathology_description[]">
                        </div>
                        <div class="col-12 col-md-1 mt-2 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-outline-danger remove-pathology ms-md-2">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="col-12 mb-3">
                <button type="button" class="btn btn-outline-info btn-sm" id="add_pathology">+ Add Another Pathology</button>
            </div>


            <div class="divider">
                <div class="divider-text">Product Images x4</div>
            </div>

            <div class="text-danger">
                <h6>Image Preference Details:</h6>
                <ul>
                    <li><strong>Type:</strong> PNG</li>
                    <li><strong>Max Size:</strong> 150kb</li>
                    <li><strong>Background:</strong> Transparent</li>
                    <li><strong>Height:</strong> 500px</li>
                    <li><strong>Width:</strong> 500px</li>
                    <li class="text-info">The above <strong>Image Preference Details</strong> are not mandatory, yet required for best view in <strong>Client Mode View</strong>.</li>
                </ul>
            </div>

            <div class="col-3 mb-3">
                <img src="<?= systemVariable('SITE_HOME') . 'uploads/' . $product_images[0] ?>" style="height: 100px; width: 100px;" id="product_image_1_display" alt="Product Image">
            </div>

            <div class="col-3 mb-3">
                <img src="<?= systemVariable('SITE_HOME') . 'uploads/' . $product_images[1] ?>" style="height: 100px; width: 100px;" id="product_image_2_display" alt="Product Image">
            </div>

            <div class="col-3 mb-3">
                <img src="<?= systemVariable('SITE_HOME') . 'uploads/' . $product_images[2] ?>" style="height: 100px; width: 100px;" id="product_image_3_display" alt="Product Image">
            </div>

            <div class="col-3 mb-3">
                <img src="<?= systemVariable('SITE_HOME') . 'uploads/' . $product_images[3] ?>" style="height: 100px; width: 100px;" id="product_image_4_display" alt="Product Image">
            </div>

            <div class="col-sm-3 mb-3">
                <label class="form-label" for="product_image_1">Product Image 1 (Details)</label>
                <input type="file" id="product_image_1" name="product_image_1" class="form-control" accept="image/*" placeholder="Product Image">
            </div>

            <div class="col-sm-3 mb-3">
                <label class="form-label" for="product_image_2">Product Image 2 (Technology)</label>
                <input type="file" id="product_image_2" name="product_image_2" class="form-control" accept="image/*" placeholder="Product Image">
            </div>

            <div class="col-sm-3 mb-3">
                <label class="form-label" for="product_image_3">Product Image 3 (Features)</label>
                <input type="file" id="product_image_3" name="product_image_3" class="form-control" accept="image/*" placeholder="Product Image">
            </div>

            <div class="col-sm-3 mb-3">
                <label class="form-label" for="product_image_4">Product Image 4 (Pathology)</label>
                <input type="file" id="product_image_4" name="product_image_4" class="form-control" accept="image/*" placeholder="Product Image">
            </div>
            
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="price">Price</label>
                <div class="input-group">
                    <span class="input-group-text" id="price-symbol1">₹</span>
                    <input type="number" class="form-control" step="0.01" id="price" placeholder="Price" name="price" value="<?= $product['price'] ?>" required>
                </div>
                <span id="price_display"></span>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="discounted_price">Discounted Price</label>
                <div class="input-group">
                    <span class="input-group-text" id="price-symbol2">₹</span>
                    <input type="number" class="form-control" step="0.01" id="discounted_price" placeholder="Price" name="discounted_price" value="<?= $product['discounted_price'] ?>" required>
                </div>
                <span id="discounted_price_display"></span>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="tax1_percent">Tax 1 (CGST)</label>
                <div class="input-group">
                    <input type="number" class="form-control" step="0.01" min="0" max="90" id="tax1_percent" placeholder="Price" name="tax1_percent" placeholder="Tax 1 Percent" value="<?= $product['tax1_percent'] ?>">
                    <span class="input-group-text" id="tax1_percent-symbol2">%</span>
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="tax2_percent">Tax 2 (SGST)</label>
                <div class="input-group">
                    <input type="number" class="form-control" step="0.01" min="0" max="90" id="tax2_percent" placeholder="Price" name="tax2_percent" placeholder="Tax 2 Percent" value="<?= $product['tax2_percent'] ?>">
                    <span class="input-group-text" id="tax2_percent-symbol2">%</span>
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="igst_percent">IGST</label>
                <div class="input-group">
                    <input type="number" class="form-control" step="0.01" id="igst_percent" placeholder="Price" name="igst_percent" value="<?= $product['igst_percent'] ?>">
                    <span class="input-group-text" id="igst_percent-symbol2">%</span>
                </div>
            </div>


            <div class="col-12 mb-3">
                <label class="form-label" for="remarks">Remarks</label>
                <textarea class="form-control" id="remarks" placeholder="<?= $product['remarks'] ?>" name="remarks" data-info="remarks"><?= $product['remarks'] ?></textarea>
            </div>
        </div>

        <div class="mt-2 d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-dark">Reset</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>
        </div>

    </form>
</div>


<!-- product details section -->
<script>
    $(document).ready(function() {
        // Initialize detailIndex based on last used index in PHP
        let detailIndex = $('#product_details_wrapper .product-detail').length;

        $('#add_detail').click(function() {
            // Clone the last detail row instead of always the first
            const $lastDetail = $('#product_details_wrapper .product-detail').last();
            const $clone = $lastDetail.clone();

            // Update the row ID
            $clone.attr('id', 'product_details' + detailIndex);

            // Update inputs and labels inside the clone
            $clone.find('input').each(function() {
                const $input = $(this);
                const oldId = $input.attr('id');
                const baseId = oldId.replace(/\d+$/, '');
                const newId = baseId + detailIndex;

                // Clear the value and update ID and name
                $input.val('').attr('id', newId);

                // Update label[for]
                $clone.find(`label[for="${oldId}"]`).attr('for', newId);
            });

            // Append the new cloned detail block
            $('#product_details_wrapper').append($clone);

            detailIndex++;
        });

        // Remove detail row
        $('#product_details_wrapper').on('click', '.remove-detail', function() {
            if ($('#product_details_wrapper .product-detail').length > 1) {
                $(this).closest('.product-detail').remove();
            }
        });
    });
</script>


<!-- product color -->
<script>
    $(document).ready(function() {
        $('#product_color').on('input', function() {
            const colorValue = $(this).val();
            $('#product_color_display').css('background-color', colorValue);
        });
    });
</script>

<!-- product technology section -->
<script>
    $(document).ready(function() {

        // Initialize technologyIndex based on last used index in PHP
        let technologyIndex = $('#product_technology_wrapper .product-technology').length;

        $('#add_technology').click(function() {
            // Clone the first product-technology block
            const $clone = $('#product_technology0').clone();

            // Update IDs and labels in the clone
            $clone.attr('id', `product_technology${technologyIndex}`);

            // Update input fields inside the clone
            $clone.find('input').each(function() {
                const oldId = $(this).attr('id');
                const baseId = oldId.replace(/\d+$/, ''); // strip trailing number
                const newId = baseId + technologyIndex;

                $(this)
                    .attr('id', newId)
                    .val(''); // Clear the input value

                // Update corresponding label 'for' attribute
                $clone.find(`label[for="${oldId}"]`).attr('for', newId);
            });

            // Append the cloned and modified element
            $('#product_technology_wrapper').append($clone);

            technologyIndex++;
        });

        // Remove detail row
        $('#product_technology_wrapper').on('click', '.remove-technology', function() {
            // Only remove if it's not the first (default) one
            if ($('#product_technology_wrapper .product-technology').length > 1) {
                $(this).closest('.product-technology').remove();
            }
        });
    });
</script>

<!-- product features section -->
<script>
    $(document).ready(function() {

        let featureIndex = $('#product_features_wrapper .product-feature').length;

        $('#add_feature').click(function() {
            // Clone the first product-feature block
            const $clone = $('#product_features0').clone();

            // Update IDs and labels in the clone
            $clone.attr('id', `product_features${featureIndex}`);

            // Update input fields inside the clone
            $clone.find('input').each(function() {
                const oldId = $(this).attr('id');
                const baseId = oldId.replace(/\d+$/, ''); // strip trailing number
                const newId = baseId + featureIndex;

                $(this)
                    .attr('id', newId)
                    .val(''); // Clear the input value

                // Update corresponding label 'for' attribute
                $clone.find(`label[for="${oldId}"]`).attr('for', newId);
            });

            // Append the cloned and modified element
            $('#product_features_wrapper').append($clone);

            featureIndex++;
        });

        // Remove feature row
        $('#product_features_wrapper').on('click', '.remove-feature', function() {
            // Only remove if it's not the first (default) one
            if ($('#product_features_wrapper .product-feature').length > 1) {
                $(this).closest('.product-feature').remove();
            }
        });
    });
</script>

<!-- product pathology section -->
<script>
    $(document).ready(function() {

        let pathologyIndex = $('#product_pathology_wrapper .product-pathology').length;

        $('#add_pathology').click(function() {
            // Clone the first product-detail block
            const $clone = $('#product_pathology0').clone();

            // Update IDs and labels in the clone
            $clone.attr('id', `product_pathology${pathologyIndex}`);

            // Update input fields inside the clone
            $clone.find('input').each(function() {
                const oldId = $(this).attr('id');
                const baseId = oldId.replace(/\d+$/, ''); // strip trailing number
                const newId = baseId + pathologyIndex;

                $(this)
                    .attr('id', newId)
                    .val(''); // Clear the input value

                // Update corresponding label 'for' attribute
                $clone.find(`label[for="${oldId}"]`).attr('for', newId);
            });

            // Append the cloned and modified element
            $('#product_pathology_wrapper').append($clone);

            pathologyIndex++;
        });

        // Remove detail row
        $('#product_pathology_wrapper').on('click', '.remove-pathology', function() {
            // Only remove if it's not the first (default) one
            if ($('#product_pathology_wrapper .product-pathology').length > 1) {
                $(this).closest('.product-pathology').remove();
            }
        });
    });
</script>

<!-- form submit -->
<script>
    $(document).ready(() => {

        $(document).ready(function() {
            $('#product_name').on('input', function() {
                const product_name = $(this).val();
                const slug = slugify(product_name);
                $('#slug').val(slug);
            });
        });

        previewSelectedUploadImage('#product_image_1', '#product_image_1_display');
        previewSelectedUploadImage('#product_image_2', '#product_image_2_display');
        previewSelectedUploadImage('#product_image_3', '#product_image_3_display');
        previewSelectedUploadImage('#product_image_4', '#product_image_4_display');

        const productForm = enableUnsavedChangesWarning('#update_product');

        $('#update_product').on('submit', function(e) {
            e.preventDefault();

            const formElem = document.getElementById('update_product');

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
                form_data.append('id', '<?= $product['id'] ?>');
                form_data.append('updated_by', '<?= $_SESSION[USER_AUTH] ?>');
                form_data.append('request_type', 'update_product');

            } else {
                // ✅ Old behavior if no files
                form_data = $(formElem).serialize();
                form_data += "&id=<?= $product['id'] ?>";
                form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
                form_data += "&request_type=update_product";
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

                    productForm?.markFormClean?.(); // only if defined

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