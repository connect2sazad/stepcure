<form id="add_stock" method="POST" onsubmit="return false;" enctype="multipart/form-data"><?= sc_token() ?>
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="product_name">Product Name</label>
            <input class="form-control" type="text" id="product_name" value="<?= $product['product_name'] ?>" readonly>
            <input type="hidden" id="product_id" name="product_id" value="<?= $product['id'] ?>" readonly>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="site_id">Site</label>
            <select class="form-control" onchange="updateSiteIdValue()" id="site_id_select" <?= ($current_user_group == 1 || $current_user_group == 2) ? '' : 'disabled' ?>>
                <?php
                if (mysqli_num_rows($sites_options) > 0) {

                    echo '<option ' . (($current_user_group == 1 || $current_user_group == 2) ? 'selected' : '') . ' disabled>Select a Site</option>';

                    while ($row = mysqli_fetch_assoc($sites_options)) {
                ?>
                        <option data-quantity="<?= (int)sc_query('SELECT COALESCE(SUM(quantity),0) AS n FROM inventory WHERE product_id=? AND site_id=?','ii',[$product['id'],$row['id']])->get_result()->fetch_assoc()['n'] ?>" value="<?= $row['id'] ?>" <?= $user_site == $row['id'] ? 'selected' : '' ?>><?= $row['site_name'] ?> (<?= $row['site_id'] ?>)</option>
                <?php
                    }
                } else {
                    echo '<option selected disabled>No States Available</option>';
                }
                ?>
            </select>
            <input type="hidden" name="site_id" value="<?= $user_site ?>" id="site_id_value">
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="current_quantity">Current Quantity</label>
            <input class="form-control" type="text" id="current_quantity" value="<?= $inventory['quantity'] ?>" readonly>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="change_quantity">Increase Quantity By</label>
            <input class="form-control" type="number" onchange="updateStock()" step="1" id="change_quantity" name="change_quantity" value="1" min="1" required>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="quantity">New Quantity</label>
            <input class="form-control" type="text" id="quantity" value="<?= $inventory['quantity']+1 ?>" readonly>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <input type="hidden" id="discounted_price" value="<?= sc_price($product)/100 ?>">
            <label class="form-label" for="amount">Change Amount</label>
            <div class="input-group">
                <span class="input-group-text" id="price-symbol1">₹</span>
                <input type="number" class="form-control" step="0.01" id="amount" placeholder="Amount" name="Amount" value="<?= sc_price($product)/100 ?>" readonly>
            </div>
            <span id="price_display"></span>
        </div>
        <div class="col-12 col-md-12 mb-3">
            <label class="form-label" for="invoice">File Upload</label>
            <input class="form-control" type="file" id="invoice" name="invoice" accept="image/*,.pdf" data-info="invoice">
            <span class="text-muted">* Max File Size: 1MB</span><br>
            <span class="text-muted">* Accepted File Types: Images/PDFs</span>
        </div>
        <div class="col-12 mb-3">
            <label class="form-label" for="remarks">Remarks</label>
            <textarea class="form-control" id="remarks" placeholder="Enter Remarks" name="remarks" data-info="remarks"></textarea>
        </div>
        <div class="col-12 mb-3">
            <button type="submit" class="btn btn-primary" onclick="add_stock_submit('<?= $_SESSION[USER_AUTH] ?>', <?= $inventory_id ?>)" id="add_stock_btn">Add Stock</button>
            <button type="reset" class="btn btn-secondary" id="reset_btn">Reset</button>
        </div>
    </div>
</form>