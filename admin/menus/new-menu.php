<?php

$random_id = (int) getRandomId(5, 'numeric');

$pages = getPagesList();

?>
<div class="card-body">
    <form id="add_new_menu" method="POST" onsubmit="return false">
        <div class="mb-3">
            <label class="form-label" for="menu-title">Menu Name</label>
            <input type="text" class="form-control" id="menu-title" placeholder="New Menu #<?= $random_id ?>" value="New Menu #<?= $random_id ?>" name="menu_name" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="primary_secondary">Menu Location</label>
            <select name="primary_secondary" id="primary_secondary" class="form-control" required>
                <option value="primary">Header</option>
                <option value="secondary">Footer</option>
                <option value="primary_secondary">Both</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" for="link_to">Link To</label>
            <select name="link_to" id="link_to" class="form-control" required>
                <?php
                    if(mysqli_num_rows($pages) > 0){
                        echo '<option selected disabled></option>';
                        while ($row = mysqli_fetch_assoc($pages)) {
                            echo '<option value="'.$row['page_unique_name'].'">'.$row['page_title'].'</option>';
                        }
                    } else {
                        echo '<option disabled>No Pages Available</option>';
                    }
                ?>
                <option value="external_link">External Link</option>
            </select>
        </div>

        <div class="mb-3" id="url" style="display: none;">
            <label class="form-label" for="external_link">External Link</label>
            <input type="url" class="form-control" id="external_link" placeholder="External Link or URL" >
        </div>

        <div class="mb-3">
            <label class="form-label" for="order">Order</label>
            <input type="number" class="form-control" id="order" placeholder="0" min="0" value="0" name="order" disabled>
        </div>
        
        <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Publish</button>
            <button type="reset" class="btn btn-secondary me-2">Reset</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(() => {

        $('#link_to').on('change', function(){
            var link_to = $(this).val();
            if(link_to == 'external_link'){
                $('#url').show();
            } else {
                $('#url').hide();
            }
        });


        $('#add_new_menu').on('submit', function(e) {
            e.preventDefault();

            var form_data = $('#add_new_menu').serialize();
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=add_new_menu";


            ajax_request(form_data).done(function(response) {
                if (response.status == 'success') {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    window.location = "<?= ___ADMIN_DIR___ ?>menus/?menu_id=" + response.menu_id;

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
            });
        });
    });
</script>

