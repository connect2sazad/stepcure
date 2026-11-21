<?php
$pages = getPagesList();
?>
<div class="card-body">


    <div class="mb-3">
        <label class="form-label" for="menu-title">Menu Name</label>
        <input type="text" class="form-control" id="menu-title" placeholder="<?= $menu['menu_name'] ?>" value="<?= $menu['menu_name'] ?>" name="menu_name" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label" for="primary_secondary">Menu Location</label>
        <input type="text" class="form-control" id="menu-title" value="<?= $menu['primary_secondary'] == 'primary_secondary' ? 'Both' : ($menu['primary_secondary'] == 'primary' ? 'Primary' : 'Secondary') ?>" name="primary_secondary" readonly>
    </div>

    <div class="mb-3">
        <label class="form-label" for="link_to">Link To</label>
        <select name="link_to" id="link_to" class="form-control" disabled>
            <option disabled></option>
            <?php
            if (mysqli_num_rows($pages) > 0) {
                while ($row = mysqli_fetch_assoc($pages)) {
                    $selected_page = $menu['link_to'] == $row['page_unique_name'] ? 'selected' : '';
                    echo '<option value="' . $row['page_unique_name'] . '">' . $row['page_title'] . '</option>';
                }
            } else {
                echo '<option disabled>No Pages Available</option>';
            }

            $is_external_link = filter_var($menu['link_to'], FILTER_VALIDATE_URL) ? 'selected' : false;

            ?>
            <option value="external_link" <?= $is_external_link ?>>External Link</option>
        </select>
    </div>

    <div class="mb-3" id="url" <?= $is_external_link ? '' : 'style="display: none;"' ?>>
        <label class="form-label" for="external_link">External Link</label>
        <input type="url" class="form-control" id="external_link" placeholder="External Link or URL" <?= $is_external_link ? 'value="' . $menu['link_to'] . '"' : '' ?> readonly>
    </div>

    <div class="mt-2">
        <button type="button" class="btn btn-secondary me-2" onclick="window.location.href='./?id=<?=$menu_id?>'">Edit</button>
        <button type="button" class="btn btn-info me-2" onclick="window.location.href='./'">Go Back</button>
    </div>

</div>