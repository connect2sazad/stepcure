<?php

$editable_files = array('robots', 'sitemap', 'manifest', 'htaccess', 'google-site-verification');

if (array_key_exists('file', $_GET)) {
    $file = $_GET['file'];
    if ($file == '' || !in_array($file, $editable_files)) {
        echo '<meta http-equiv="refresh" content="0; url=' . systemVariable('SITE_HOME') . 'admin/seo-maker/">';
    }
} else {
    echo '<meta http-equiv="refresh" content="0; url=' . systemVariable('SITE_HOME') . 'admin/seo-maker/">';
}

switch ($file) {
    case 'robots':
        $file_name = $file . ".txt";
        break;

    case 'sitemap':
        $file_name = $file . ".xml";
        break;

    case 'manifest':
        $file_name = $file . ".json";
        break;

    case 'htaccess':
        $file_name = "." . $file;
        break;

    case 'google-site-verification':
        $file_name = "google.html";
        break;
}

$file_path = __DIR__ . '/../../../../' . $file_name;

// echo $file_path;
$file_contents = file_get_contents($file_path);

?>

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="./">SEO Maker 1.2</a> / <a href="./">File Editor</a> /</span> <strong style="text-transform: capitalize;" id="page-edit-title"><?= $file ?></strong> </h4>

<div class="card mt-2">

    <div class="card-body">


        <form id="file_editor" method="post" onsubmit="return false">
            <div class="mb-3">
                <label class="form-label" for="file_contents">File Location</label>
                <input type="url" class="form-control" value="<?= SITE_DIR . $file_name ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label" for="file_contents">File Contents</label>
                <textarea class="form-control" rows="10" name="file_contents" required><?= $file_contents ?></textarea>
            </div>
            <button class="btn btn-primary mx-1" type="submit">Update</button>
            <button class="btn btn-secondary mx-1" type="reset">Reset</button>
            <a class="btn btn-info mx-1" href="./">Cancel</a>
        </form>

    </div>
</div>

<script>
    const seo_engine = {
        status: true,
        version: 2.6,
        code: '<?= base64_encode(base64_encode(systemVariable('meta_keywords_limit'))) ?>'
    };

    $(document).ready(() => {

        $('#file_editor').on('submit', async function(e) {
            e.preventDefault();

            const dialogTitle = "Confirm Your Action";
            const confirmMsg = "Are you sure you want to proceed with these changes? They are irreversible and may impact your website's uptime, downtime, and SEO performance.";

            // ✅ Ask confirmation
            let confirmed = await ConfirmDialogBox(confirmMsg, dialogTitle);
            if (!confirmed) return;




            var form_data = $('#file_editor').serialize();
            form_data += "&updated_by=<?= $_SESSION[USER_AUTH] ?>";
            form_data += "&request_type=file_editor";
            form_data += "&file_path=<?= base64_encode($file_path) ?>";
            form_data += "&file_name=<?= $file_name ?>";
            form_data += "&file_url=<?= SITE_DIR . $file_name ?>";


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