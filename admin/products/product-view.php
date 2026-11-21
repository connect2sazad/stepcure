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


        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" placeholder="<?= $product['slug'] ?>" value="<?= $product['slug'] ?>" name="slug" readonly>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" placeholder="<?= $product['product_name'] ?>" value="<?= $product['product_name'] ?>" name="product_name" disabled>
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="category_id">Product Category</label>
                <select name="category_id" id="category_id" class="form-control" disabled>
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
                <select name="type" id="type" class="form-control" disabled>
                    <option value="0" <?= $product['type'] == '0' ? 'selected' : '' ?>>Women's Footwear</option>
                    <option value="1" <?= $product['type'] == '1' ? 'selected' : '' ?>>Men's Footwear</option>
                    <option value="2" <?= $product['type'] == '2' ? 'selected' : '' ?>>Foot Orthotics</option>
                </select>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="product_color">Color</label>
                <input type="text" class="form-control" id="product_color" placeholder="Color" value="<?= $product['product_color'] ?>" name="product_color" disabled>
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
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="details_name<?= $index ?>">Detail Name</label>
                                <input type="text" class="form-control" id="details_name<?= $index ?>" placeholder="Detail Name" name="details_name[]" value="<?= $key ?>" disabled>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="details_value<?= $index ?>">Detail Value</label>
                                <input type="text" class="form-control" id="details_value<?= $index ?>" placeholder="Detail Value" name="details_value[]" value="<?= $value ?>" disabled>
                            </div>
                        </div>
                    <?php
                        $index++;
                    }
                } else {

                    ?>
                        Not added yet!
                <?php
                }
                ?>
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
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="technology_name<?= $index ?>">Technology Name</label>
                                <input type="text" class="form-control" id="technology_name<?= $index ?>" placeholder="Technology Name" name="technology_name[]" value="<?= $key ?>" disabled>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="technology_description<?= $index ?>">Technology Value</label>
                                <input type="text" class="form-control" id="technology_description<?= $index ?>" placeholder="Technology Value" name="technology_description[]" value="<?= $value ?>" disabled>
                            </div>
                        </div>
                    <?php
                        $index++;
                    }
                } else {

                    ?>
                    Not added yet!
                <?php
                }
                ?>
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
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="features_name<?= $index ?>">Feature Name</label>
                                <input type="text" class="form-control" id="features_name<?= $index ?>" placeholder="Feature Name" name="features_name[]" value="<?= $key ?>" disabled>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="features_value<?= $index ?>">Feature Value</label>
                                <input type="text" class="form-control" id="features_value<?= $index ?>" placeholder="Feature Value" name="features_value[]" value="<?= $value ?>" disabled>
                            </div>
                        </div>
                    <?php
                        $index++;
                    }
                } else {

                    ?>
                    Not added yet!
                <?php
                }
                ?>
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
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="pathology_name<?= $index ?>">Pathology Name</label>
                                <input type="text" class="form-control" id="pathology_name<?= $index ?>" placeholder="Pathology Name" name="pathology_name[]" value="<?= $key ?>" disabled>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="pathology_description<?= $index ?>">Pathology Value</label>
                                <input type="text" class="form-control" id="pathology_description<?= $index ?>" placeholder="Pathology Value" name="pathology_description[]" value="<?= $value ?>" disabled>
                            </div>
                        </div>
                    <?php
                        $index++;
                    }
                } else {

                    ?>
                    Not added yet!
                <?php
                }
                ?>
            </div>



            <div class="divider">
                <div class="divider-text">Product Images x4</div>
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

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="price">Price</label>
                <div class="input-group">
                    <span class="input-group-text" id="price-symbol1">₹</span>
                    <input type="number" class="form-control" step="0.01" id="price" placeholder="Price" name="price" value="<?= $product['price'] ?>" disabled>
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="discounted_price">Discounted Price</label>
                <div class="input-group">
                    <span class="input-group-text" id="price-symbol2">₹</span>
                    <input type="number" class="form-control" step="0.01" id="discounted_price" placeholder="Price" name="discounted_price" value="<?= $product['discounted_price'] ?>" disabled>
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="tax1_percent">Tax 1 (CGST)</label>
                <div class="input-group">
                    <input type="number" class="form-control" step="0.01" id="tax1_percent" placeholder="Price" name="tax1_percent" value="<?= $product['tax1_percent'] ?>" disabled>
                    <span class="input-group-text" id="tax1_percent-symbol2">%</span>
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="tax2_percent">Tax 2 (SGST)</label>
                <div class="input-group">
                    <input type="number" class="form-control" step="0.01" id="tax2_percent" placeholder="Price" name="tax2_percent" value="<?= $product['tax2_percent'] ?>" disabled>
                    <span class="input-group-text" id="tax2_percent-symbol2">%</span>
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="igst_percent">IGST</label>
                <div class="input-group">
                    <input type="number" class="form-control" step="0.01" id="igst_percent" placeholder="Price" name="igst_percent" value="<?= $product['igst_percent'] ?>" disabled>
                    <span class="input-group-text" id="igst_percent-symbol2">%</span>
                </div>
            </div>


            <div class="col-12 mb-3">
                <label class="form-label" for="remarks">Remarks</label>
                <textarea class="form-control" id="remarks" disabled placeholder="<?= $product['remarks'] ?>" name="remarks" data-info="remarks"><?= $product['remarks'] ?></textarea>
            </div>
        </div>

        <div class="mt-2 d-flex flex-wrap gap-2">
            <?php
            // show edit button only when the user has access
            if (checkPermissions('update', $user_permissions, $user_group_permissions)) {
            ?>

                <button type="button" class="btn btn-info" onclick="window.location.href='./?id=<?= $product_id ?>'">Edit</button>

            <?php
            }
            ?>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>
        </div>


</div>