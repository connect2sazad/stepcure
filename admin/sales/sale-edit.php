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

    <form id="update_sale" method="POST" onsubmit="return false">
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
                <input class="form-control" type="date" id="date" name="date" value="<?= $sale['date'] ?>" placeholder="Invoice Date" required>
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
                            <th>Actions</th>
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
                                <td>
                                    <button type="button" class="btn btn-xs btn-danger remove-sale-item ms-md-2">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php
                            $SL++;
                        }

                        ?>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-6 col-md-3 mb-3">
                        <label class="form-label" for="sale-item">Item</label>
                        <select class="form-control sale-item-select" id="sale-item" onchange="update_amount()">
                            <option value="0">Please Select Item</option>
                            <?php

                            if (!empty($product_options) && count($product_options) > 0) {
                                foreach ($product_options as $product) {
                                    $disabled = $product['stock'] ? '' : 'disabled';
                                    $stock = $product['stock'] ? ' (' . $product['stock'] . ' left)' : ' (Out of Stock)';
                                    echo '<option value="' . $product['id'] . '" ' . $disabled . '>' . $product['name'] . ' - ' . $product['category'] . $stock . '</option>';
                                }
                            }

                            ?>
                        </select>
                    </div>
                    <div class="col-6 col-md-2 mb-3">
                        <label class="form-label" for="sale-quantity">Quantity</label>
                        <input class="form-control" type="number" id="sale-quantity" placeholder="Quantity" name="quantity">
                    </div>
                    <div class="col-6 col-md-2 mb-3">
                        <label class="form-label" for="sale-rate">Rate</label>
                        <input class="form-control" type="number" id="sale-rate" placeholder="Rate" name="rate" step="0.01">
                    </div>
                    <div class="col-6 col-md-2 mb-3">
                        <label class="form-label" for="sale-tax">Tax</label>
                        <input class="form-control" type="text" id="sale-tax" placeholder="Tax" name="tax" readonly>
                    </div>
                    <div class="col-6 col-md-2 mb-3">
                        <label class="form-label" for="sale-amount">Amount</label>
                        <input class="form-control" type="number" id="sale-amount" placeholder="Amount" name="amount" readonly>
                    </div>
                    <div class="col-12 col-md-1 mt-2 d-flex align-items-center justify-content-center">
                        <button type="button" class="btn btn-info ms-md-2" onclick="add_item()">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                </div>

                <hr>
                <div class="row mt-3">
                    <div class="col-6 col-md-8 mb-3"></div>
                    <div class="col-6 col-md-4 mb-3">
                        <label class="form-label" for="adjustment">Adjustment</label>
                        <input class="form-control" type="number" id="adjustment" placeholder="Adjustment" name="adjustment" value="<?= $sale['adjustment'] ?>" step="0.01">
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
                <textarea class="form-control" id="remarks" placeholder="Enter Remarks" name="remarks" data-info="remarks"><?= $sale['remarks'] ?></textarea>
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

                <button type="button" class="btn btn-info me-2 save-draft-btn" <?= !($site_id) ? 'disabled' : '' ?>>Save Draft</button>
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
                <button type="button" class="btn btn-info me-2 save-draft-btn" <?= !($site_id) ? 'disabled' : '' ?>>Save Draft</button>
                <button type="button" id="invoice-btn" class="btn btn-primary me-2 finalize-btn" <?= !($site_id) ? 'disabled' : '' ?>>Generate Invoice</button>
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

    </form>

</div>

<!-- script related to consulation and patient -->
<script>
    $(document).ready(function() {
        var consultation_id_input = $('#consultation_id');
        var patient_id_input = $('#patient_id');
        var address_input = $('#address');


        function update_patient_by_consultation() {

            var consultation_id = consultation_id_input.val();

            if (consultation_id == 0) {
                patient_id_input.val(0).trigger('change');
                patient_id_input.prop('disabled', false);
                address_input.val('');
                return;
            }

            var form_data = "consultation_id=" + consultation_id;
            form_data += "&request_type=get_patient_by_consultation_id";


            ajax_request(form_data).done(function(response) {

                if (response.status == 'success') {

                    // console.log(response);

                    patient_id_input.val(response.data.id).trigger('change');
                    patient_id_input.prop('disabled', true);
                    address_input.val(response.data.first_name + "'s Address");


                } else {
                    Toastify({
                        // text: response.message,
                        text: 'Unable to fetch details of patient from consultation!',
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "red",
                    }).showToast();
                }
                // console.log(response);
            });
        }

        function update_patient() {

            var patient_id = patient_id_input.val();

            if (patient_id == 0) {
                // to ignore if no patient is selected
                return;
            }

            var form_data = "patient_id=" + patient_id;
            form_data += "&request_type=get_patient_by_id";


            ajax_request(form_data).done(function(response) {

                if (response.status == 'success') {

                    // console.log(response);

                    address_input.val(response.data.first_name + "'s Address");


                } else {
                    Toastify({
                        // text: response.message,
                        text: 'Unable to fetch details of patient!',
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "red",
                    }).showToast();
                }
                // console.log(response);
            });
        }

        consultation_id_input.on("change", update_patient_by_consultation);
        patient_id_input.on("change", update_patient);
    });
</script>

<!-- script related to grand total calculation -->
<script>
    var table_data = <?= json_encode($sale_items) ?>;

    const product_options = <?= $json_encoded_products ?>;

    var sale_item_input = $('#sale-item');
    var sale_quantity_input = $('#sale-quantity');
    var sale_rate_input = $('#sale-rate');
    var sale_tax_input = $('#sale-tax');
    var sale_amount_input = $('#sale-amount');
    var adjustment_input = $('#adjustment');

    function add_item() {

        var sale_item = sale_item_input.val();
        var sale_quantity = sale_quantity_input.val();
        var sale_rate = sale_rate_input.val();
        var sale_tax = sale_tax_input.val();
        var sale_amount = sale_amount_input.val();

        if (!sale_item || sale_item == "0") {
            Toastify({
                text: 'Please select an item first!',
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
            }).showToast();
            return;
        }

        // Find product name from list
        var item_name = '';
        var category_name = '';
        var stock = 0;
        product_options.forEach(element => {
            if (element.id == sale_item) {
                item_name = element.name;
                category_name = element.category;
                stock = element.stock;
            }
        });

        if ($('#sale-items tbody tr[data-product-id="' + sale_item + '"]').length) {
            Toastify({
                text: 'This item is already added!',
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "orange",
            }).showToast();
            return;
        }

        // Calculate SL number dynamically
        var tbody = $('#sale-items tbody');
        var rowCount = tbody.find('tr').length + 1;

        // Build row
        var html = '<tr data-product-id="' + sale_item + '">';
        html += '<td>' + rowCount + '</td>';
        html += '<td>' + item_name + ' (' + category_name + ')' + '</td>';
        html += '<td>' + sale_quantity + '</td>';
        html += '<td>' + indianRupee(sale_rate) + '</td>';
        html += '<td>' + sale_tax + '</td>';
        html += '<td>' + indianRupee(sale_amount) + '</td>';
        html += '<td>';
        html += '<button type="button" class="btn btn-xs btn-danger remove-sale-item ms-md-2">';
        html += '<i class="fas fa-times"></i>';
        html += '</button>';
        html += '</td>';
        html += '</tr>';

        tbody.append(html);

        // Optionally push to JS array (if you want to submit via AJAX)
        table_data.push({
            product_id: sale_item,
            name: item_name,
            quantity: sale_quantity,
            rate: sale_rate,
            tax: sale_tax,
            amount: sale_amount
        });

        // console.log(table_data);

        // Reset form inputs
        $('#sale-item').val("0").trigger('change'); // Reset select2 dropdown
        $('#sale-quantity').val("");
        $('#sale-rate').val("");
        $('#sale-tax').val("");
        $('#sale-amount').val("");
    }

    function update_amount(triggeredBy = "") {

        var sale_item = sale_item_input.val();
        var quantity = parseFloat(sale_quantity_input.val()) || 0;

        // Check raw input values before parsing
        var rawRate = sale_rate_input.val().trim();
        var rawTax = sale_tax_input.val().trim();

        var rate = rawRate ? parseFloat(rawRate) : 0;
        var taxString = rawTax || "";
        var stock = 0;

        if (sale_item && sale_item !== "0") {
            product_options.forEach(element => {
                if (element.id == sale_item) {

                    rate = parseFloat(element.rate) || 0;
                    var t1 = parseFloat(element.tax1) || 0;
                    var t2 = parseFloat(element.tax2) || 0;
                    taxString = t1 + "," + t2; // e.g. "5,5"

                    stock = parseInt(element.stock) || 0;
                }
            });

            // Default quantity = 1 if empty
            if (!quantity && stock > 0) {
                quantity = 1;
            }

            // Prevent exceeding stock
            if (quantity > stock) {
                quantity = stock;
            }
        }

        // Parse tax string into array
        var taxArray = taxString.split(",").map(t => parseFloat(t) || 0);

        // Base calculation
        var baseAmount = quantity * rate;
        var taxAmount = 0;

        taxArray.forEach(t => {
            taxAmount += baseAmount * (t / 100);
        });

        var finalAmount = baseAmount + taxAmount;

        sale_quantity_input.val(quantity);
        sale_rate_input.val(rate.toFixed(2));
        sale_tax_input.val(taxArray.join(","));
        sale_amount_input.val(finalAmount.toFixed(2));

        let grandTotal = 0;

        table_data.forEach(item => {
            grandTotal += parseFloat(item.amount.replace(',', ''));
        });

        grandTotal += parseFloat(adjustment_input.val());

        $('#grand-total').text(indianRupee(grandTotal));
        $('#in-words').text(inWords(grandTotal));
    }

    // Attach events
    sale_item_input.on("change", update_amount);
    sale_quantity_input.on("input", update_amount);
    sale_rate_input.on("input", update_amount);
    sale_tax_input.on("input", update_amount);
    adjustment_input.on("input", update_amount);


    // Example remove handler
    $(document).on("click", ".remove-sale-item", function() {
        // Get the closest table row
        const row = $(this).closest("tr");

        // Get the product_id from the row's data attribute
        const productId = row.data("product-id");

        // Remove the row from the UI
        row.remove();

        // Remove the item from table_data by product_id
        table_data = table_data.filter(item => item.product_id != productId);

        // Optionally re-index SL column
        $('#sale-items tbody tr').each(function(i, tr) {
            $(tr).find("td:first").text(i + 1);
        });

    });
</script>

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

    function submitSale(isFinalized) {
        const saleForm = enableUnsavedChangesWarning('#update_sale');

        var site_id = "<?= $site_id ?>";
        var patient_id = $('#patient_id').val();

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

        if (
            patient_id === null ||
            patient_id === undefined ||
            patient_id.trim() === "" ||
            patient_id.trim() === "0"
        ) {
            Toastify({
                text: "Please select a patient or a consultation.",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
            }).showToast();
            return; // Stop execution
        }

        if (table_data.length < 1) {
            Toastify({
                text: "Please add items to the list!",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
            }).showToast();
            return; // Stop execution
        }

        const formElem = document.getElementById('update_sale');

        let form_data;

        // accumulate form data
        form_data = $(formElem).serialize();
        form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
        form_data += "&items=" + JSON.stringify(table_data);
        form_data += "&site_id=" + encodeURIComponent(site_id);
        form_data += "&sale_id=<?= $sale_id ?>";
        form_data += "&is_sale_finalized=" + (isFinalized ? 1 : 0);
        form_data += "&request_type=update_sale";

        if (!form_data.includes('consultation_id=')) {
            form_data += "&consultation_id=" + $('#consultation_id').val();
        }

        if (!form_data.includes('patient_id=')) {
            form_data += "&patient_id=" + $('#patient_id').val();
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

                saleForm?.markFormClean?.(); // only if defined

                if (isFinalized) {
                    window.location = "<?= systemVariable('SITE_HOME') ?>admin/sales/?id=<?= $sale_id ?>&view";
                }

                // 

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

        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error(jqXHR.responseText);
            Toastify({
                text: jqXHR.responseText,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
            }).showToast();
        });
    }

    // Save Draft
    $(document).on('click', '.save-draft-btn', function() {
        submitSale(false); // is_sale_finalized = 0
    });

    // Finalize
    $(document).on('click', '.finalize-btn', async function() {
        const dialogTitle = "Generate Invoice";
        const confirmMsg = "This action will generate the Invoice. Once this form is submitted, sale details will be locked & cannot be altered!";
        let confirmed = await ConfirmDialogBox(confirmMsg, dialogTitle);
        if (!confirmed) return;
        submitSale(true); // is_sale_finalized = 1
    });
</script>