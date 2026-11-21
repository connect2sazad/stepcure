<?php

$page_slug = isset($_GET['page']) ? $_GET['page'] : '';
$page = getPageBySlug($page_slug);
$page = mysqli_fetch_assoc($page);

?>

<!-- breadcrumb start-->
<section class="breadcrumb_part breadcrumb_bg" style="background-image: url(<?= $page['featured_image'] ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2><?= $page['page_title'] ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<div class="p-5">
    <?php

    echo $page['page_htmls'];

    ?>
</div>