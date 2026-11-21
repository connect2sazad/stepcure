<?php
$pages = getPagesList();
?>
<div class="card-body">

    <form id="update_menu" method="POST" onsubmit="return false">

        <div class="mb-3">
            <label class="form-label" for="menu-title">Menu Name</label>
            <input type="text" class="form-control" id="menu-title" placeholder="<?= $menu['menu_name'] ?>" value="<?= $menu['menu_name'] ?>" name="menu_name" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="primary_secondary">Menu Location</label>
            <select name="primary_secondary" id="primary_secondary" class="form-control" required>
                <option value="primary" <?= $menu['primary_secondary'] == 'primary' ? 'selected' : '' ?>>Header</option>
                <option value="secondary" <?= $menu['primary_secondary'] == 'secondary' ? 'selected' : '' ?>>Footer</option>
                <option value="primary_secondary" <?= $menu['primary_secondary'] == 'primary_secondary' ? 'selected' : '' ?>>Both</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" for="link_to">Link To</label>
            <select name="link_to" id="link_to" class="form-control" required>
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
                <option value="external_link" <?=$is_external_link?>>External Link</option>
            </select>
        </div>

        <div class="mb-3" id="url" <?= $is_external_link ? '' : 'style="display: none;"'?>>
            <label class="form-label" for="external_link">External Link</label>
            <input type="url" class="form-control" id="external_link" placeholder="External Link or URL" <?= $is_external_link ? 'value="'.$menu['link_to'].'"' : ''?> >
        </div>

        <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <button type="reset" class="btn btn-dark me-2">Reset</button>
            <button type="button" class="btn btn-secondary me-2" onclick="window.location.href='./'">Go Back</button>
            <button type="button" onclick="send_to_trash(<?= $menu['menu_id'] ?>)" class="btn btn-danger me-2">Trash</button>
        </div>
    </form>
</div>


<script>

    function send_to_trash(menu_id) {

        var delete_confirmation = confirm("Are you sure you want to trash '<?= $menu['menu_name'] ?>'?");

        if (!delete_confirmation) {
            return;
        }

        var form_data = "request_type=send_menu_to_trash&menu_id=" + menu_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

        ajax_request(form_data, false).done(function(response) {
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
                window.location.href = './';
            } else {
                Toastify({
                    text: 'failed',
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "red",
                }).showToast();
            }
        });
    }

    $(document).ready(() => {

        $('#menu-title').on('keyup', function() {
            var title = $(this).val();
            $('#menu-edit-title').html(title);
        });

        $('#menu-title').on('change', function() {
            var title = $(this).val();
            $('#menu-edit-title').html(title);
        });

        $('#link_to').on('change', function(){
            var link_to = $(this).val();
            if(link_to == 'external_link'){
                $('#url').show();
            } else {
                $('#url').hide();
            }
        });


        $('#update_menu').on('submit', function(e) {
            e.preventDefault();

            var form_data = $('#update_menu').serialize();
            form_data += "&menu_id=<?= $menu['menu_id'] ?>";
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=update_menu";


            ajax_request(form_data).done(function(response) {
                // console.log(response);
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