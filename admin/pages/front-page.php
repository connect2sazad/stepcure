<?php
$page = getPageBySlug('front_page');
$page = mysqli_fetch_assoc($page);
$featured_image = $page['featured_image'];

$metas = getMetaData($page['meta_unique_name']);
$meta_keywords = @getMetaSingle($page['meta_unique_name'], 'keywords')['content'];
$meta_description = @getMetaSingle($page['meta_unique_name'], 'description')['content'];

function new_meta_id(){
    return getRandomId(13, 'numeric');
}

?>
<div class="card-body">

    <form id="update_page" method="POST" onsubmit="return false">

        <div class="mb-3">
            <label class="form-label" for="page-title">Page Title</label>
            <input type="text" class="form-control" id="page-title" placeholder="Page Title" value="<?= $page['page_title'] ?>" name="page_title">
        </div>

        <?php

        if ($page['slug'] == 'about-us') {
            // do nothing
        } else {
            echo '
                <div class="mb-3">
                    <label class="form-label" for="new-page-slug">Slug</label>
                    <input type="text" class="form-control" id="new-page-slug" placeholder="Slug" value="' . $page['slug'] . '" readonly name="page_unique_name">
                </div>
                ';
        }
        ?>

        <div class="mb-3">
            <label class="form-label" for="featured_image">Featured Image</label>
            <img id="featured_image_display" src="<?= $featured_image ?>" alt="Featured Image" class="mb-3" style="height: 200px; width:100%; object-fit: cover;">
            <input type="url" class="form-control" id="featured_image" placeholder="Featured Image" value="<?= $featured_image ?>" name="featured_image" required>
        </div>

        <!-- <div class="mb-3">
            <label class="form-label" for="new-page-contents">Page contents</label>
            <textarea id="new-page-contents" placeholder="Page Contents" name="page_htmls"><?= $page['page_htmls'] ?></textarea>
        </div> -->

        <div class="seo-maker">
            <h1>SEO Maker 1.2 (for <?= $page['meta_unique_name'] ?>)</h1>
            <div class="mb-3">
                <label class="form-label" for="keywords">Keywords</label>
                <input type="text" class="form-control" id="keywords" placeholder="Keywords" name="meta-keywords" value="<?=$meta_keywords?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="meta-description">Meta Description</label>
                <input type="text" class="form-control" id="meta-description" placeholder="Meta Description" name="meta-description" value="<?=$meta_description?>" required>
            </div>

            <?php

                if(mysqli_num_rows($metas) > 0){
                    while ($row = mysqli_fetch_assoc($metas)) {
                        if($row['attr_value'] == 'keywords' || $row['attr_value'] == 'description'){
                            continue;
                        };
                        $new_id = new_meta_id();
                        $attr_type = $row['attr_type'];
                        echo '
                            <div class="row" id="meta-prop-'.$new_id.'">
                            <div class="remove" onclick="remove_meta_prop('.$new_id.')">&times;</div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" style="text-transform: uppercase;">'.$attr_type.' Type</label>
                                    <input type="text" class="form-control" placeholder="'.$attr_type.' Type" name="'.$attr_type.'-'.$new_id.'" value="'.$row['attr_value'].'" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="meta-description" style="text-transform: uppercase;">'.$attr_type.' Value</label>
                                    <input type="text" class="form-control" placeholder="'.$attr_type.' Value" name="'.$attr_type.'-content-'.$new_id.'" value="'.$row['content'].'" required>
                                </div>
                            </div>
                        ';
                    }
                }

            ?>

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
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <button type="reset" class="btn btn-dark me-2" onclick="fix_values()">Reset</button>
            <button type="reset" class="btn btn-outline-secondary me-2" onclick="window.location.href='./'">Go Back</button>
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
        $('#featured_image_display').attr('src', '<?= $page['featured_image'] ?>');
        $('#page-edit-title').html('<?= $page['page_title'] ?>');
    }

    $(document).ready(() => {

        $('#featured_image').on('change', function() {
            $('#featured_image_display').attr('src', $(this).val());
        });

        $('#update_page').on('submit', function(e) {
            e.preventDefault();


            var form_data = $('#update_page').serialize();
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=update_page";
            form_data += "&page_id=<?=$page['page_id']?>";
            // console.log(form_data);


            ajax_request(form_data).done(function(response) {
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

                    window.location = "<?= SITE_URL ?>admin/pages/?front_page";

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