<?php

$random_id = (int) getRandomId(5, 'numeric');
$random_id = $random_id + (int) getRandomId(5, 'numeric');

$blocks_list = getBlocksList();

?>
<div class="card-body">
    <form id="add_new_page_blocks_creator" method="POST" onsubmit="return false">
        <div class="mb-3">
            <label class="form-label" for="page-title">Page Title</label>
            <input type="text" class="form-control" id="page-title" placeholder="New Page #<?= $random_id ?>" value="New Page #<?= $random_id ?>" name="page_title">
        </div>
        <div class="mb-3">
            <label class="form-label" for="new-page-slug">Slug</label>
            <input type="text" class="form-control" id="new-page-slug" placeholder="Slug" value="new-page-<?= $random_id ?>" readonly name="page_unique_name">
        </div>
        <div id="blocks-adder">
            <div class="mb-3">
                <label for="block_type" class="form-label">Block Type</label>
                <select class="form-select" id="block_type" name="block_type" aria-label="Default select example" readonly>
                    <option value="image_with_content" selected>Image With Content — image_with_content</option>
                    <?php
                    // while ($row = mysqli_fetch_assoc($blocks_list)) {
                    //     echo '<option value="'.$row['block_id'] . '">'.$row['block_title'] . ' — ' . $row['block_unique_name'] .'</option>';
                    // }

                    ?>
                </select>
            </div>
            <section class="home-about">

                <div class="mb-3">
                    <label class="form-label" for="image-link">Image Link</label>
                    <input type="url" class="form-control" id="image-link" name="block_image_link" placeholder="Image Link">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="block-heading">Block Heading</label>
                    <input type="text" class="form-control" id="block-heading" name="block_heading" placeholder="Block Heading" value="Block Heading">
                </div>
                <div class="mb-3">
                    <label for="block-content" class="form-label">Block Content</label>
                    <textarea class="form-control" id="block-content" name="block_content" placeholder="Block Content">Block Content</textarea>
                </div>
                <a class="btn btn-primary" href="javascript:void(0)">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="block-heading" placeholder="Button Name" value="Button Name" name="block_button_name">
                    </div>
                    <div>
                        <input type="text" class="form-control" id="block-heading" placeholder="Button Link" value="#" name="block_button_link">
                    </div>
                </a>

            </section>
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Publish</button>
            <button type="reset" class="btn btn-secondary me-2">Reset</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(() => {


        $('#page-title').on('keyup', function() {
            var title = $(this).val();
            $('#new-page-slug').val(slug_creator(title));
        });

        $('#page-title').on('change', function() {
            var title = $(this).val();
            $('#new-page-slug').val(slug_creator(title));
        });
        $('#blocks-adder').css({
            'background-color': 'rgb(231,231,255)',
            'padding': '15px'
        });


        $('#add_new_page_blocks_creator').on('submit', function(e) {
            e.preventDefault();


            var form_data = $('#add_new_page_blocks_creator').serialize();
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=add_new_page_blocks_creator";


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

                    window.location = "<?= ___ADMIN_DIR___ ?>pages/?page_id=" + response.page_id;

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

