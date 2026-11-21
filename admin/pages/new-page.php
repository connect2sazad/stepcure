<?php

$random_id = (int) getRandomId(5, 'numeric');
$random_id = $random_id + (int) getRandomId(5, 'numeric');

$blocks_list = getBlocksList();

$featured_image = systemVariable('default_featured_image');

?>
<div class="card-body">
    <form id="add_new_page" method="POST" onsubmit="return false">
        <div class="mb-3">
            <label class="form-label" for="page-title">Page Title</label>
            <input type="text" class="form-control" id="page-title" placeholder="New Page #<?= $random_id ?>" value="New Page #<?= $random_id ?>" name="page_title">
        </div>
        
        <div class="mb-3">
            <label class="form-label" for="new-page-slug">Slug</label>
            <input type="text" class="form-control" id="new-page-slug" placeholder="Slug" value="new-page-<?= $random_id ?>" readonly name="page_unique_name">
        </div>

        <div class="mb-3">
            <label class="form-label" for="featured_image">Featured Image</label>
            <img id="featured_image_display" src="<?= $featured_image ?>" alt="Featured Image" class="mb-3" style="height: 200px; width:100%; object-fit: cover;">
            <input type="url" class="form-control" id="featured_image" placeholder="Featured Image" value="<?= $featured_image ?>" name="featured_image" required>
        </div>

        <div class="mb-3">
            <label class="form-label" for="new-page-contents">Page contents</label>
            <textarea id="new-page-contents" placeholder="Page Contents" name="page_htmls"></textarea>
        </div>

        <div class="seo-maker">
            <h1>SEO Maker 1.2</h1>
            <div class="mb-3">
                <label class="form-label" for="keywords">Keywords</label>
                <input type="text" class="form-control" id="keywords" placeholder="Keywords" name="meta-keywords">
            </div>
            <div class="mb-3">
                <label class="form-label" for="meta-description">Meta Description</label>
                <input type="text" class="form-control" id="meta-description" placeholder="Meta Description" name="meta-description">
            </div>
            <div class="btn-group" id="seo-meta-property-add-btn">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Add New Meta
                </button>
                <ul class="dropdown-menu">
                    <li onclick="new_seo_meta('name')"><a class="dropdown-item" href="javascript:void(0);">Name</a></li>
                    <li onclick="new_seo_meta('property')"><a class="dropdown-item" href="javascript:void(0);">Property</a></li>
                </ul>
            </div>
        </div>


        <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Publish</button>
            <button type="reset" class="btn btn-secondary me-2" onclick="fix_values()">Reset</button>
        </div>
    </form>
</div>

<script>
    const seo_engine = {
        status: true,
        version: 1.2,
        code: '<?= base64_encode(base64_encode(systemVariable('meta_keywords_limit'))) ?>'
    };

    function fix_values() {
        $('#featured_image_display').attr('src', '<?= $featured_image ?>');
    }

    $(document).ready(() => {


        $('#page-title').on('keyup', function() {
            var title = $(this).val();
            $('#new-page-slug').val(slug_creator(title));
        });

        $('#page-title').on('change', function() {
            var title = $(this).val();
            $('#new-page-slug').val(slug_creator(title));
        });

        $('#featured_image').on('change', function() {
            $('#featured_image_display').attr('src', $(this).val());
        });

        $('#add_new_page').on('submit', function(e) {
            e.preventDefault();


            var form_data = $('#add_new_page').serialize();
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=add_new_page";


            ajax_request(form_data).done(function(response) {
                
                console.log(response);
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

                    window.location = "<?= SITE_URL ?>admin/pages/?page_id=" + response.page_id;

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