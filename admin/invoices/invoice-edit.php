<?php

$address_states_options = getAddressStatesOptions();

$central_hub = systemVariable('default_site_id');

$supply_place = $invoice['supply_place'];
$supply_place = getAddressStateById($supply_place);
$supply_place = $supply_place['gst_code'] . ' - ' . $supply_place['state_name'] . ' (' . $supply_place['state_code'] . ')';

$invoice_items_raw = getInvoiceItemsByInvoiceId($invoice_id);

$invoice_items = [];
if (mysqli_num_rows($invoice_items_raw)) {
    while ($item = mysqli_fetch_assoc($invoice_items_raw)) {

        $product = getProductById($item['product_id']);
        $product = mysqli_fetch_assoc($product);

        $category = getProductCategoryById($product['category_id']);
        $category = mysqli_fetch_assoc($category);

        array_push($invoice_items, [
            'product_id' => $product['id'],
            'product_name' => $product['product_name'],
            'category_name' => $category['category_name'],
            'quantity' => $item['quantity'],
            'rate' => $item['rate'],
            'cgst' => $item['cgst'],
            'sgst' => $item['sgst'],
            'igst' => $item['igst'],
            'amount' => $item['amount'],
        ]);
    }
}


// products list for the select dropdown
$product_list = getProductsList();

$product_options = [];
if (mysqli_num_rows($product_list) > 0) {
    while ($row = mysqli_fetch_assoc($product_list)) {
        $inventory = getInventoryByProductIdAndSiteId($row['id'], $central_hub);
        // pre($inventory);
        $category = getProductCategoryById($row['category_id']);
        $category = mysqli_fetch_assoc($category);

        if (mysqli_num_rows($inventory) > 0) {

            $inventory = mysqli_fetch_assoc($inventory);

            // You can customize which fields to include
            $product_options[] = [
                'id' => $row['id'],
                'name' => $row['product_name'],
                'rate' => $row['discounted_price'],
                'cgst' => $row['tax1_percent'],
                'sgst' => $row['tax2_percent'],
                'igst' => $row['igst_percent'],
                'stock' => $inventory['quantity'],
                'category' => $category['category_name'],
            ];
        }
    }
}

$json_encoded_products = json_encode($product_options);

?>
<div class="row">

    <!-- view details regarding the report/invoice -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="update_invoice" method="POST" onsubmit="return false">

                    <div class="row">

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="customerinvoiceuid">Invoice No</label>
                            <input class="form-control" type="text" id="customerinvoiceuid" value="CSI-<?= prefix_00($invoice['customerinvoiceuid']) ?>" readonly>
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label" for="customer_name">Customer Name</label>
                            <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="<?= $invoice['customer_name'] ?>" value="<?= $invoice['customer_name'] ?>">
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label" for="gst">GST No</label>
                            <input type="text" class="form-control" name="gst" id="gst" placeholder="<?= $invoice['gst'] ?>" value="<?= $invoice['gst'] ?>">
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="address_state">State Location</label>
                            <select class="form-control" name="address_state" id="address_state" disabled>
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

                        <div class="col-12 mb-3">
                            <label class="form-label" for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address" autocomplete="off" placeholder="<?= $invoice['address'] ?>" value="<?= $invoice['address'] ?>">
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="address_city">City Location</label>
                            <input type="text" class="form-control" id="address_city" placeholder="<?= $invoice['address_city'] ?>" value="<?= $invoice['address_city'] ?>" name="address_city">
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="address_pin">PIN Code</label>
                            <input type="text" class="form-control" id="address_pin" placeholder="<?= $invoice['address_pin'] ?>" value="<?= $invoice['address_pin'] ?>" name="address_pin">
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="supply_place">Place of Supply</label>
                            <input class="form-control" type="text" id="supply_place" name="supply_place" value="<?= $supply_place ?>" placeholder="<?= $supply_place ?>" disabled>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="invoice_date">Invoice Date</label>
                            <input class="form-control" type="date" id="invoice_date" name="invoice_date" value="<?= $invoice['invoice_date'] ?>" placeholder="Invoice Date">
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="due_date">Due Date</label>
                            <input class="form-control" type="date" id="due_date" name="due_date" value="<?= $invoice['due_date'] ?>" placeholder="Due Date">
                        </div>


                        <!-- Items List -->
                        <div class="seo-maker invoice-items">

                            <h5>Items</h5>
                            <table class="table mb-4" cellpadding="6" cellspacing="0" data-info="ignore-dt" id="invoice-items">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Taxable Amount</th>
                                        <?php

                                        if ($invoice['is_igst'] == 0) {
                                            echo '
                                            <th>CGST</th>
                                            <th>SGST</th>
                                        ';
                                        } else {
                                            echo '<th>IGST</th>';
                                        }

                                        ?>
                                        <th>Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SL = 1;
                                    $total_taxable_amount = 0;
                                    $total_tax = 0;
                                    foreach ($invoice_items as $item) {

                                        $taxableValue = $item['quantity'] * $item['rate'];
                                        $cgstAmount = ($item['cgst'] * $taxableValue) / 100;
                                        $sgstAmount = ($item['sgst'] * $taxableValue) / 100;
                                        $igstAmount = ($item['igst'] * $taxableValue) / 100;

                                        $total_taxable_amount += $taxableValue;
                                        $total_tax += $cgstAmount + $sgstAmount + $igstAmount;

                                    ?>
                                        <tr data-product-id="<?= $item['product_id'] ?>">
                                            <td><?= $SL ?></td>
                                            <td><?= $item['product_name'] ?> (<?= $item['category_name'] ?>)</td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td><?= rupee($item['rate']) ?></td>
                                            <td><?= rupee($taxableValue) ?></td>
                                            <?php if ($item['igst'] == 0): ?>
                                                <td><?= rupee($cgstAmount) ?> (<?= $item['cgst'] ?>%)</td>
                                                <td><?= rupee($sgstAmount) ?> (<?= $item['sgst'] ?>%)</td>
                                            <?php else: ?>
                                                <td><?= rupee($igstAmount) ?> (<?= $item['igst'] ?>%)</td>
                                            <?php endif; ?>
                                            <td><?= rupee($item['amount']) ?></td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-danger remove-invoice-item ms-md-2">
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
                                <div class="col-6 col-md-6 mb-3">
                                    <label class="form-label" for="invoice-item">Item</label>
                                    <select class="form-control invoice-item-select" id="invoice-item" onchange="update_amount()">
                                        <option value="0">Please Select Item</option>
                                        <?php

                                        pre($product_options);

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
                                <div class="col-6 col-md-3 mb-3">
                                    <label class="form-label" for="invoice-quantity">Quantity</label>
                                    <input class="form-control" type="number" id="invoice-quantity" placeholder="Quantity" name="quantity">
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <label class="form-label" for="invoice-rate">Rate</label>
                                    <input class="form-control" type="number" id="invoice-rate" placeholder="Rate" name="rate" step="0.01">
                                </div>
                                <?php

                                if ($invoice['is_igst'] == 0) {
                                ?>
                                    <div class="col-6 col-md-2 mb-3">
                                        <label class="form-label" for="invoice-cgst">CGST</label>
                                        <input class="form-control" type="text" id="invoice-cgst" placeholder="CGST" name="cgst" readonly>
                                    </div>
                                    <div class="col-6 col-md-2 mb-3">
                                        <label class="form-label" for="invoice-sgst">SGST</label>
                                        <input class="form-control" type="text" id="invoice-sgst" placeholder="SGST" name="sgst" readonly>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-6 col-md-3 mb-3">
                                        <label class="form-label" for="invoice-igst">IGST</label>
                                        <input class="form-control" type="text" id="invoice-igst" placeholder="IGST" name="igst" readonly>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="col-6 col-md-4 mb-3">
                                    <label class="form-label" for="invoice-amount">Amount</label>
                                    <input class="form-control" type="number" id="invoice-amount" placeholder="Amount" name="amount" readonly>
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
                                    <input class="form-control" type="number" id="adjustment" placeholder="Adjustment" name="adjustment" value="<?= $invoice['adjustment'] ?>" step="0.01">
                                </div>
                                <div class="col-12 text-end">
                                    <h5>Taxable Amount: <span id="grand-taxable-amount"><?= rupee($total_taxable_amount) ?></span></h5>
                                </div>
                                <div class="col-12 text-end">
                                    <h5>Tax: <span id="grand-total-tax"><?= rupee($total_tax) ?></span></h5>
                                </div>
                                <div class="col-12 text-end">
                                    <h5>Grand Total: <span id="grand-total"><?= rupee($invoice['grand_total']) ?></span></h5>
                                </div>
                                <div class="col-12 text-end">
                                    <h5>In Words: <span id="in-words"><?= in_words($invoice['grand_total']) ?></span></h5>
                                </div>
                            </div>

                        </div>


                        <div class="col-12 mb-3">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea class="form-control" id="remarks" placeholder="Enter Remarks" name="remarks" data-info="remarks"><?= $invoice['remarks'] ?></textarea>
                        </div>

                    </div>


                    <div class="mt-2 d-flex flex-wrap gap-2">
                        <?php
                        // show edit button only when the user has access or the user is a admin
                        if (checkPermissions('update', $user_permissions, $user_group_permissions) || userVariable('user_group') == 2) {
                        ?>
                            <button type="button" data-info="action-button" class="btn btn-primary" id="save-draft-btn">Save As Draft</button>
                            <button type="button" data-info="action-button" class="btn btn-primary" id="finalize-btn">Generate New Invoice</button>
                        <?php
                        }
                        ?>
                        <?php
                        // show view button only when the user has access
                        if (checkPermissions('view', $user_permissions, $user_group_permissions) && $invoice['is_invoice_generated'] == 1) {
                        ?>
                            <!-- open pdf invoice file in another tab -->
                            <a info="action-button" class="btn btn-info" target="_blank" href="<?= systemVariable('SITE_HOME') . 'system_generated/' . $invoice['invoice_file'] ?>">View Invoice</a>
                        <?php
                        }
                        ?>
                        <?php
                        // show cancel button only when the user has access or the user is a admin
                        if (checkPermissions('delete', $user_permissions, $user_group_permissions) && $invoice['is_invoice_generated'] == 1 || userVariable('user_group') == 2) {
                        ?>
                            <!-- <button type="button" data-info="action-button" class="btn btn-danger" onclick="cancelInvoice(<?= $invoice_id ?>)">Cancel Invoice</button> -->
                        <?php
                        }
                        ?>
                        <button type="button" data-info="action-button" class="btn btn-secondary" onclick="window.location.href='./'">Go Back</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

<!-- amount calc, product add, del, etc -->
<script>
    var table_data = <?= json_encode($invoice_items) ?>;
    // console.log(table_data);


    const product_options = <?= $json_encoded_products ?>;
    // console.log(product_options);

    var invoice_item_input = $('#invoice-item');
    var invoice_quantity_input = $('#invoice-quantity');
    var invoice_rate_input = $('#invoice-rate');
    var invoice_cgst_input = $('#invoice-cgst');
    var invoice_sgst_input = $('#invoice-sgst');
    var invoice_igst_input = $('#invoice-igst');
    var invoice_amount_input = $('#invoice-amount');
    var adjustment_input = $('#adjustment');

    function add_item() {
        const invoice_item = invoice_item_input.val();
        const quantity = parseFloat(invoice_quantity_input.val()) || 0;
        const rate = parseFloat(invoice_rate_input.val()) || 0;
        const cgst = parseFloat(invoice_cgst_input.val()) || 0;
        const sgst = parseFloat(invoice_sgst_input.val()) || 0;
        const igst = parseFloat(invoice_igst_input.val()) || 0;
        const amount = parseFloat(invoice_amount_input.val()) || 0;

        // Validate item selection
        if (!invoice_item || invoice_item === "0") {
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

        // Validate quantity
        if (quantity <= 0) {
            Toastify({
                text: 'Quantity must be greater than 0!',
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
            }).showToast();
            return;
        }

        // Check if item already exists in table
        if ($('#invoice-items tbody tr[data-product-id="' + invoice_item + '"]').length) {
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

        // Find product name and category from list
        const selected = product_options.find(p => p.id == invoice_item);
        if (!selected) return;

        const item_name = selected.name;
        const category_name = selected.category;

        // Calculate amounts
        const taxable_amount = quantity * rate;
        const cgst_amount = taxable_amount * (cgst / 100);
        const sgst_amount = taxable_amount * (sgst / 100);
        const igst_amount = taxable_amount * (igst / 100);

        const rowCount = $('#invoice-items tbody tr').length + 1;
        let html = `<tr data-product-id="${invoice_item}">`;
        html += `<td>${rowCount}</td>`;
        html += `<td>${item_name} (${category_name})</td>`;
        html += `<td>${quantity}</td>`;
        html += `<td>${indianRupee(rate)}</td>`;
        html += `<td>${indianRupee(taxable_amount)}</td>`;

        if (<?= $invoice['is_igst'] ? 'true' : 'false' ?>) {
            html += `<td>${indianRupee(igst_amount)} (${igst}%)</td>`;
        } else {
            html += `<td>${indianRupee(cgst_amount)} (${cgst}%)</td>`;
            html += `<td>${indianRupee(sgst_amount)} (${sgst}%)</td>`;
        }

        html += `<td>${indianRupee(amount)}</td>`;
        html += `<td><button type="button" class="btn btn-xs btn-danger remove-invoice-item ms-md-2"><i class="fas fa-times"></i></button></td>`;
        html += `</tr>`;

        $('#invoice-items tbody').append(html);

        // Push to table_data array
        table_data.push({
            product_id: invoice_item,
            product_name: item_name,
            category_name: category_name,
            quantity: quantity,
            rate: rate,
            cgst: cgst,
            sgst: sgst,
            igst: igst,
            amount: amount
        });

        // Recalculate grand total properly
        recalculateGrandTotal();

        // Reset inputs
        invoice_item_input.val("0").trigger('change');
        invoice_quantity_input.val("");
        invoice_rate_input.val("");
        invoice_cgst_input.val("");
        invoice_sgst_input.val("");
        invoice_igst_input.val("");
        invoice_amount_input.val("");
    }


    function update_amount(triggeredBy = "") {
        const invoice_item = invoice_item_input.val();
        let quantity = parseFloat(invoice_quantity_input.val()) || 0;

        // Reset tax fields
        invoice_cgst_input.val('');
        invoice_sgst_input.val('');
        invoice_igst_input.val('');

        let rate = 0;
        let cgst = 0;
        let sgst = 0;
        let igst = 0;
        let stock = 0;

        // If an item is selected, fetch its details
        if (invoice_item && invoice_item !== "0") {
            const selected = product_options.find(p => p.id == invoice_item);
            if (selected) {
                rate = parseFloat(selected.rate) || 0;
                cgst = parseFloat(selected.cgst) || 0;
                sgst = parseFloat(selected.sgst) || 0;
                igst = parseFloat(selected.igst) || 0;
                stock = parseInt(selected.stock) || 0;
            }

            // If no quantity entered, set default 1 (if stock available)
            if (!quantity && stock > 0) quantity = 1;

            // Prevent exceeding available stock
            if (quantity > stock) quantity = stock;
        }

        // Update inputs with correct values
        invoice_quantity_input.val(quantity);
        invoice_rate_input.val(rate.toFixed(2));

        // If IGST is applicable, apply IGST only; otherwise CGST+SGST
        if (<?= $invoice['is_igst'] ? 'true' : 'false' ?>) {
            invoice_igst_input.val(igst);
        } else {
            invoice_cgst_input.val(cgst);
            invoice_sgst_input.val(sgst);
        }

        // Base & tax calculation
        const baseAmount = quantity * rate;
        const totalTaxPercent = <?= $invoice['is_igst'] ? 'igst' : '(cgst + sgst)' ?>;
        const taxAmount = baseAmount * (totalTaxPercent / 100);
        const finalAmount = baseAmount + taxAmount;

        // Update amount input
        invoice_amount_input.val(finalAmount.toFixed(2));

        // Recalculate Grand Total
        let grandTotal = 0;
        table_data.forEach(item => {
            grandTotal += parseFloat(item.amount.toString().replace(/,/g, '')) || 0;
        });

        grandTotal += parseFloat(adjustment_input.val()) || 0;
        grandTotal += finalAmount; // include current item being added

        $('#grand-total').text(indianRupee(grandTotal));
        $('#in-words').text(inWords(grandTotal));
    }

    function recalculateGrandTotal() {
        let grandTotal = 0;
        let taxableTotal = 0;
        let totalTax = 0;

        table_data.forEach(item => {
            const taxable = item.quantity * item.rate;
            const tax = taxable * ((item.cgst + item.sgst + item.igst) / 100);
            taxableTotal += taxable;
            totalTax += tax;
            grandTotal += parseFloat(item.amount) || 0;
        });

        grandTotal += parseFloat(adjustment_input.val()) || 0;
        console.log(grandTotal);
        

        $('#grand-taxable-amount').text(indianRupee(taxableTotal));
        $('#grand-total-tax').text(indianRupee(totalTax));
        $('#grand-total').text(indianRupee(grandTotal));
        $('#in-words').text(inWords(grandTotal));
    }


    // Attach events
    invoice_item_input.on("change", update_amount);
    invoice_quantity_input.on("input", update_amount);
    invoice_rate_input.on("input", update_amount);
    invoice_cgst_input.on("input", update_amount);
    invoice_sgst_input.on("input", update_amount);
    invoice_igst_input.on("input", update_amount);
    adjustment_input.on("input", update_amount);


    // remove handler
    $(document).on('click', '.remove-invoice-item', function() {
        const row = $(this).closest('tr');
        const productId = row.data('product-id');

        // Remove from table_data array
        table_data = table_data.filter(item => item.product_id != productId);

        // Remove row from table
        row.remove();

        // Re-index row numbers
        $('#invoice-items tbody tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });

        // Recalculate totals
        recalculateGrandTotal();
    });
</script>


<!-- script related to form submits -->
<script>
    $(document).ready(() => {

        const invoiceForm = enableUnsavedChangesWarning('#update_invoice');


        function submitSale(isFinalized) {

            const formElem = document.getElementById('update_invoice');

            let form_data;

            // accumulate form data
            form_data = $(formElem).serialize();
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&items=" + JSON.stringify(table_data);
            form_data += "&invoice_id=<?= $invoice_id ?>";
            form_data += "&is_invoice_finalized=" + (isFinalized ? 1 : 0);
            form_data += "&is_igst=" + (<?= $invoice['is_igst'] ? 1 : 0 ?>);
            form_data += "&customerinvoiceuid=<?= $invoice['customerinvoiceuid'] ?>";
            form_data += "&address_state=<?= $invoice['address_state'] ?>";
            form_data += "&request_type=update_invoice";

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

                    invoiceForm?.markFormClean?.(); // only if defined

                    if (isFinalized) {
                        window.location = "<?= systemVariable('SITE_HOME') ?>admin/invoices/?id=<?= $invoice_id ?>&view";
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
        $(document).on('click', '#save-draft-btn', function() {
            submitSale(false); // is_invoice_finalized = 0
        });

        // Finalize
        $(document).on('click', '#finalize-btn', async function() {

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

            const dialogTitle = "Generate Invoice";
            const confirmMsg = "This action will generate the Invoice. Once this form is submitted, invoice details will be locked & cannot be altered!";
            let confirmed = await ConfirmDialogBox(confirmMsg, dialogTitle);
            if (!confirmed) return;
            submitSale(true); // is_invoice_finalized = 1
        });
    });
</script>