<?php

$address_states_options = getAddressStatesOptions();


$supply_place = $invoice['supply_place'];
$supply_place = getAddressStateById($supply_place);
$supply_place = $supply_place['gst_code'] . ' - ' . $supply_place['state_name'] . ' (' . $supply_place['state_code'] . ')';


$invoice_items_raw = getInvoiceItemsByInvoiceId($invoice_id);

$invoice_items = [];
// $invoice_amount_total = 0;
// $taxable_amount = 0;
// $invoice_tax = 0;
if (mysqli_num_rows($invoice_items_raw)) {
    while ($item = mysqli_fetch_assoc($invoice_items_raw)) {

        $product = getProductById($item['product_id']);
        $product = mysqli_fetch_assoc($product);

        $category = getProductCategoryById($product['category_id']);
        $category = mysqli_fetch_assoc($category);

        // $taxable_amount += $item['quantity'] * $item['rate'];
        // $cgst = $item['cgst'] / 100 * $item['quantity'] * $item['rate'];
        // $sgst = $item['sgst'] / 100 * $item['quantity'] * $item['rate'];
        // $igst = $item['igst'] / 100 * $item['quantity'] * $item['rate'];
        // $invoice_tax += $cgst + $sgst + $igst;
        // $invoice_amount_total += $item['amount'];

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

// default site
$central_hub = systemVariable('default_site_id');
$central_hub = getSiteById($central_hub);
$central_hub = mysqli_fetch_assoc($central_hub);
$central_hub_state = getAddressStateById($central_hub['address_state']);

?>
<div class="row">

    <!-- view details regarding the report/invoice -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row">

                    <div class="col-6 mb-3">
                        <label class="form-label" for="customer_name">Customer Name</label>
                        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="<?= $invoice['customer_name'] ?>" value="<?= $invoice['customer_name'] ?>" readonly>
                    </div>

                    <div class="col-6 mb-3">
                        <label class="form-label" for="gst_no">GST No</label>
                        <input type="text" class="form-control" name="gst" id="gst" placeholder="<?= $invoice['gst'] ?>" value="<?= $invoice['gst'] ?>" readonly>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label" for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="<?= $invoice['address'] ?>" value="<?= $invoice['address'] ?>" readonly>
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

                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label" for="address_city">City Location</label>
                        <input type="text" class="form-control" id="address_city" placeholder="<?= $invoice['address_city'] ?>" value="<?= $invoice['address_city'] ?>" name="address_city" disabled>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label" for="address_pin">PIN Code</label>
                        <input type="text" class="form-control" id="address_pin" placeholder="<?= $invoice['address_pin'] ?>" value="<?= $invoice['address_pin'] ?>" name="address_pin" disabled>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label" for="supply_place">Place of Supply</label>
                        <input class="form-control" type="text" id="supply_place" name="supply_place" value="<?= $supply_place ?>" placeholder="<?= $supply_place ?>" readonly>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label" for="invoice_date">Invoice Date</label>
                        <input class="form-control" type="date" id="invoice_date" name="invoice_date" value="<?= $invoice['invoice_date'] ?>" placeholder="Invoice Date" readonly>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label" for="due_date">Due Date</label>
                        <input class="form-control" type="date" id="due_date" name="due_date" value="<?= $invoice['due_date'] ?>" placeholder="Due Date" readonly>
                    </div>


                    <!-- Items List -->
                    <div class="seo-maker sale-items">

                        <h5>Items</h5>
                        <table class="table mb-4" cellpadding="6" cellspacing="0" data-info="ignore-dt" id="sale-items">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th>Taxable Amount</th>
                                    <?php
                                    if ($central_hub_state['id'] == $invoice['address_state']) {
                                        echo '
                                            <th>CGST</th>
                                            <th>SGST</th>
                                        ';
                                    } else {
                                        echo '<th>IGST</th>';
                                    }

                                    ?>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $SL = 1;
                                $total_taxable_amount = 0;
                                $total_tax = 0;
                                foreach ($invoice_items as $item):

                                    $taxableValue = $item['quantity'] * $item['rate'];
                                    $cgstAmount = ($item['cgst'] * $taxableValue) / 100;
                                    $sgstAmount = ($item['sgst'] * $taxableValue) / 100;
                                    $igstAmount = ($item['igst'] * $taxableValue) / 100;

                                    $total_taxable_amount += $taxableValue;
                                    $total_tax += $cgstAmount + $sgstAmount + $igstAmount;
                                ?>
                                    <tr data-product-id="<?= htmlspecialchars($item['product_id']) ?>">
                                        <td><?= $SL ?></td>
                                        <td><?= htmlspecialchars($item['product_name']) ?> (<?= htmlspecialchars($item['category_name']) ?>)</td>
                                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                                        <td><?= rupee($item['rate']) ?></td>
                                        <td><?= rupee($taxableValue) ?></td>
                                        <?php if ($central_hub_state['id'] == $invoice['address_state']): ?>
                                            <td><?= rupee($cgstAmount) ?> (<?= $item['cgst'] ?>%)</td>
                                            <td><?= rupee($sgstAmount) ?> (<?= $item['sgst'] ?>%)</td>
                                        <?php else: ?>
                                            <td><?= rupee($igstAmount) ?> (<?= $item['igst'] ?>%)</td>
                                        <?php endif; ?>

                                        <td><?= rupee($item['amount']) ?></td>
                                    </tr>
                                <?php
                                    $SL++;
                                endforeach;
                                ?>
                            </tbody>
                        </table>



                        <hr>
                        <div class="row mt-3">
                            <div class="col-6 col-md-8 mb-3"></div>
                            <div class="col-6 col-md-4 mb-3">
                                <label class="form-label" for="adjustment">Adjustment</label>
                                <input class="form-control" type="number" id="adjustment" placeholder="Adjustment" name="adjustment" value="<?= $invoice['adjustment'] ?>" step="0.01" readonly>
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
                        <textarea class="form-control" id="remarks" placeholder="Enter Remarks" name="remarks" data-info="remarks" readonly><?= $invoice['remarks'] ?></textarea>
                    </div>

                </div>


                <div class="mt-2 d-flex flex-wrap gap-2">
                    <?php
                    // show edit button only when the user has access or the user is a admin
                    if (checkPermissions('update', $user_permissions, $user_group_permissions) || userVariable('user_group') == 2) {
                    ?>
                        <button type="button" data-info="action-button" class="btn btn-primary" onclick="window.location.href='./?id=<?= $invoice_id ?>'">Update</button>
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

            </div>

        </div>
    </div>
</div>

<script>

</script>