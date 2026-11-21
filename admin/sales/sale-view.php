<?php

$saleid = 'SI-' . prefix_00($sale['saleid']);
$consultation_id = $sale['consultation_id'];
$patient_id = $sale['patient_id'];

// get options
$consultation_options = getConsultationOptions();
$patient_options = getPatientsList();

// current user group
$current_user_group = userVariable('user_group');

// get site id for stock
$site_id = userVariable('treatment_site');

// if site id is not present check if the user is from group 1 or 2.
// if user is from group 1 or 2, then assign site as default site
if (!$site_id) {
    if ($current_user_group == 1 || $current_user_group == 2) {
        $site_id = systemVariable('default_site_id');
    }
}

$product_list = getProductsList();
$product_options = [];
if (mysqli_num_rows($product_list) > 0) {
    while ($row = mysqli_fetch_assoc($product_list)) {
        $inventory = getInventoryByProductIdAndSiteId($row['id'], $site_id);
        $category = getProductCategoryById($row['category_id']);
        $category = mysqli_fetch_assoc($category);

        if (mysqli_num_rows($inventory) > 0) {

            $inventory = mysqli_fetch_assoc($inventory);

            // You can customize which fields to include
            $product_options[] = [
                'id' => $row['id'],
                'name' => $row['product_name'],
                'rate' => $row['discounted_price'],
                'tax1' => $row['tax1_percent'],
                'tax2' => $row['tax2_percent'],
                'stock' => $inventory['quantity'],
                'category' => $category['category_name'],
            ];
        }
    }
}

$json_encoded_products = json_encode($product_options);


$patient = getPatientById($patient_id);
$patient = mysqli_fetch_assoc($patient);

$sale_items_raw = getSaleItemsBySaleId($sale_id);

$sale_items = [];
$sale_amount_total = 0;
if (mysqli_num_rows($sale_items_raw)) {
    while ($item = mysqli_fetch_assoc($sale_items_raw)) {

        $product = getProductById($item['product_id']);
        $product = mysqli_fetch_assoc($product);

        $category = getProductCategoryById($product['category_id']);
        $category = mysqli_fetch_assoc($category);

        $sale_amount_total += $item['amount'];

        array_push($sale_items, [
            'product_id' => $product['id'],
            'product_name' => $product['product_name'],
            'category_name' => $category['category_name'],
            'quantity' => $item['quantity'],
            'rate' => $item['rate'],
            'tax' => $item['tax'],
            'amount' => $item['amount'],
        ]);
    }
}

$sale_grand_total = $sale_amount_total + $sale['adjustment'];
?>
<div class="card-body">

        <?= !($site_id) ? '<div class="text-danger mb-4">* You are not assigned to any site. Please contact your Superviser.</div>' : '' ?>
        <div class="row">

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="saleid">Invoice No</label>
                <input class="form-control" type="text" id="saleid" value="<?= $saleid ?>" readonly>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="consultation_id">Consultation</label>
                <select class="form-control" id="consultation_id" name="consultation_id" <?= !($current_user_group == 1 || $current_user_group == 2) ? 'disabled' : '' ?>>
                    <option value="0">Please Select Consultation Id</option>
                    <?php
                    if (mysqli_num_rows($consultation_options) > 0) {

                        while ($row = mysqli_fetch_assoc($consultation_options)) {

                            $rpatient = getPatientById($row['patient_id']);
                            $rpatient = mysqli_fetch_assoc($rpatient);

                    ?>
                            <option value="<?= $row['id'] ?>" <?= ($consultation_id == $row['id']) ? 'selected' : '' ?>><?= 'CI-' . prefix_00($row['consultationid']) ?> (<?= 'PI-' . prefix_00($rpatient['patientid']) . ': ' . $rpatient['first_name'] . ' ' . $rpatient['last_name'] ?>), <?= date('d-m-Y', strtotime($row['created_at'])) ?></option>
                    <?php
                        }
                    } else {
                        echo '<option selected disabled>No States Available</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="patient_id">Patient</label>
                <select class="form-control" id="patient_id" name="patient_id" <?= !($current_user_group == 1 || $current_user_group == 2) ? 'disabled' : '' ?>>
                    <option value="0">Please Select Patient</option>
                    <?php
                    if (mysqli_num_rows($patient_options) > 0) {

                        while ($row = mysqli_fetch_assoc($patient_options)) {
                    ?>
                            <option value="<?= $row['id'] ?>" <?= $patient_id == $row['id'] ? 'selected' : '' ?>><?= 'PI-' . prefix_00($row['patientid']) . ' ' . $row['first_name'] . ' ' . $row['last_name'] ?> (UHID: <?= $row['uhid'] ?>)</option>
                    <?php
                        }
                    } else {
                        echo '<option selected disabled>No States Available</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="address">Bill To & Ship To</label>
                <input class="form-control" type="text" id="address" value="<?= $patient['first_name'] . "'s Address" ?>" placeholder="Patient's Address" readonly>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label" for="date">Invoice Date</label>
                <input class="form-control" type="date" id="date" name="date" value="<?= $sale['date'] ?>" placeholder="Invoice Date" readonly>
            </div>



            <div class="seo-maker sale-items">

                <h5>Items</h5>
                <table class="table mb-4" cellpadding="6" cellspacing="0" data-info="ignore-dt" id="sale-items">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Tax</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $SL = 1;
                        foreach ($sale_items as $item) {

                        ?>
                            <tr data-product-id="<?= $item['product_id'] ?>">
                                <td><?= $SL ?></td>
                                <td><?= $item['product_name'] ?> (<?= $item['category_name'] ?>)</td>
                                <td><?= $item['quantity'] ?></td>
                                <td><?= rupee($item['rate']) ?></td>
                                <td><?= $item['tax'] ?></td>
                                <td><?= rupee($item['amount']) ?></td>
                            </tr>
                        <?php
                            $SL++;
                        }

                        ?>
                    </tbody>
                </table>



                <hr>
                <div class="row mt-3">
                    <div class="col-6 col-md-8 mb-3"></div>
                    <div class="col-6 col-md-4 mb-3">
                        <label class="form-label" for="adjustment">Adjustment</label>
                        <input class="form-control" type="number" id="adjustment" placeholder="Adjustment" name="adjustment" value="<?= $sale['adjustment'] ?>" step="0.01" readonly>
                    </div>
                    <div class="col-12 text-end">
                        <h5>Grand Total: <span id="grand-total"><?= rupee($sale_grand_total) ?></span></h5>
                    </div>
                    <div class="col-12 text-end">
                        <h5>In Words: <span id="in-words"><?= in_words($sale_grand_total) ?></span></h5>
                    </div>
                </div>

            </div>




            <div class="col-12 mb-3">
                <label class="form-label" for="remarks">Remarks</label>
                <textarea class="form-control" id="remarks" placeholder="Enter Remarks" name="remarks" data-info="remarks" readonly><?= $sale['remarks'] ?></textarea>
            </div>
        </div>

        <div class="mt-2">
            <div class="row text-info my-2" style="width: 100%; margin-left: 5px;">
                Please Note: <br>
                1. Invoice can only be generated after generating Consent Form. <br>
                2. Once Invoice is generated, Sale details are locked and cannot be altered.
            </div>
            <!-- if consent file is already generated, show consent file button and generate invoice button -->
            <?php
            // show edit button only when the user has access
            if (checkPermissions('update', $user_permissions, $user_group_permissions) && !$sale['is_consent_done'] && $sale['user_id'] == userVariable('id')) {
            ?>

                <a href="./?id=<?= $sale_id?>" class="btn btn-info">Edit</a>
                <button type="button" id="consent-btn" class="btn btn-primary me-2" <?= !($site_id) ? 'disabled' : '' ?>>Get Consent</button>
            <?php
            }
            ?>
            <?php
            // show view button only when the user has access
            if (checkPermissions('view', $user_permissions, $user_group_permissions) && $sale['is_consent_done'] && !$sale['is_sale_finalized']) {
            ?>
                <!-- open pdf report file in another tab -->
                <a info="action-button" class="btn btn-info" target="_blank" href="<?= systemVariable('SITE_HOME') . 'system_generated/' . $sale['consent_file'] ?>">View Consent</a>
                <a href="./?id=<?= $sale_id?>" class="btn btn-info">Edit</a>
            <?php
            }
            ?>
            <?php
            // show view button only when the user has access
            if (checkPermissions('view', $user_permissions, $user_group_permissions) && $sale['is_sale_finalized']) {
            ?>
                <!-- open pdf report file in another tab -->
                <a info="action-button" class="btn btn-info" target="_blank" href="<?= systemVariable('SITE_HOME') . 'system_generated/' . $sale['consent_file'] ?>">View Consent</a>
                <a info="action-button" class="btn btn-info" target="_blank" href="<?= systemVariable('SITE_HOME') . 'system_generated/' . $sale['sale_file'] ?>">View Invoice</a>
            <?php
            }
            ?>

            <a class="btn btn-secondary me-2" href="./">Cancel</a>
        </div>


</div>

<!-- script related to form submits -->
<script>
    $('#consent-btn').on('click', function(e) {
        e.preventDefault();

        var patient_id = $('#patient_id').val();
        var saleid = $('#saleid').val();
        var consultation_id = $('#consultation_id').val();
        var site_id = "<?= $site_id ?>";
        var updated_by = "<?= $_SESSION[USER_AUTH] ?>";


        // Validate patient
        if (
            patient_id === null ||
            patient_id === undefined ||
            patient_id.trim() === "" ||
            patient_id.trim() === "0"
        ) {
            Toastify({
                text: "Please select a Patient!",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
            }).showToast();
            return; // Stop execution
        }

        // Validate site_id
        if (
            site_id === null ||
            site_id === undefined ||
            site_id.trim() === "" ||
            site_id.trim() === "0"
        ) {
            Toastify({
                text: "You are not associated to any Site! Please contact your Supervisor.",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
            }).showToast();
            return; // Stop execution
        }

        // Build form data
        var consent_form_data = "patient_id=" + encodeURIComponent(patient_id);
        consent_form_data += "&saleid=" + encodeURIComponent(saleid);
        consent_form_data += "&sale_id=<?= $sale_id ?>";
        consent_form_data += "&consultation_id=" + encodeURIComponent(consultation_id);
        consent_form_data += "&site_id=" + encodeURIComponent(site_id);
        consent_form_data += "&request_type=get_consent_form";
        consent_form_data += "&updated_by=" + encodeURIComponent(updated_by);

        // Send AJAX request
        ajax_request(consent_form_data).done(function(response) {

            if (response.status === 'success') {
                // Do something with the response
                window.location = './?id=<?= $sale_id ?>';
                // e.g., fill a form, redirect, show modal
            } else {
                Toastify({
                    text: response.message || 'Unable to fetch details of patient!',
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "red",
                }).showToast();
            }
        });
    });
</script>