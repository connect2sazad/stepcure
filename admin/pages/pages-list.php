<?php
$pages_list = getPagesList();
$pages_list_trashed = getTrashedPagesList();
?>
<div class="card-body" id="section-data">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-pages" aria-controls="navs-top-pages" aria-selected="true">
                Published Pages(<?= mysqli_num_rows($pages_list) ?>)
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-deleted-pages" aria-controls="navs-top-deleted-pages" aria-selected="false">
                Trashed Pages(<?= mysqli_num_rows($pages_list_trashed) ?>)
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" aria-selected="false" onclick="window.location.href='./?new_page'">
                New Page
            </button>
        </li>
    </ul>

    <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">
        <div class="tab-pane fade show active" id="navs-top-pages" role="tabpanel">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Page</th>
                        <th>Updated By</th>
                        <th>Last Update</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="published-pages-tbody">
                    <?php
                    if (mysqli_num_rows($pages_list) > 0) {
                        while ($row = mysqli_fetch_assoc($pages_list)) {
                            echo '
                            <tr>
                                <td>' . $row['page_id'] . '</td>
                                <td id="table-row-title-' . $row['page_id'] . '"> <strong><a href="./?page_id=' . $row['page_id'] . '">' . $row['page_title'] . '</a></strong></td>
                                <td>' . $row['updated_by'] . '</td>
                                <td>' . formatDateTime($row['updated_at']) . '</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="' . SITE_DIR . $row['page_unique_name'] . '" target="_blank"><i class="fa fa-eye me-1"></i>View</a>
                                            <a class="dropdown-item" href="./?page_id=' . $row['page_id'] . '"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="send_to_trash(' . $row['page_id'] . ')"><i class="fas fa-trash me-1"></i> Trash</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">No Pages Found!</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="navs-top-deleted-pages" role="tabpanel">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Page</th>
                        <th>Updated By</th>
                        <th>Last Update</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="trashed-pages-tbody">
                    <?php
                    if (mysqli_num_rows($pages_list_trashed) > 0) {
                        while ($row = mysqli_fetch_assoc($pages_list_trashed)) {
                            echo '
                            <tr>
                                <td>' . $row['page_id'] . '</td>
                                <td id="table-row-title-' . $row['page_id'] . '"> <strong>' . $row['page_title'] . '</strong></td>
                                <td>' . $row['updated_by'] . '</td>
                                <td>' . formatDateTime($row['updated_at']) . '</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="restore_from_trash(' . $row['page_id'] . ')"><i class="fas fa-trash-restore me-1"></i> Restore</a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="delete_page(' . $row['page_id'] . ')"><i class="fas fa-times me-1"></i> Delete Permanently</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">No Trashed Pages Found!</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const seo_engine = {
        status: true,
        version: 1.2,
        code: '<?= base64_encode(base64_encode(systemVariable("meta_keywords_limit"))) ?>'
    };

    function send_to_trash(page_id) {
        const page_title = $('#table-row-title-' + page_id + ' strong a').text();
        if (!confirm("Are you sure you want to delete '" + page_title + "'?")) return;

        const form_data = "request_type=send_page_to_trash&page_id=" + page_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

        ajax_request(form_data, false).done(function(response) {
            response = JSON.parse(response);
            if (response.status === 'success') {
                Toastify({
                    text: response.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
                $('#published-pages-tbody').load(location.href + ' #published-pages-tbody > *');
                $('#trashed-pages-tbody').load(location.href + ' #trashed-pages-tbody > *');
            } else {
                showErrorToast();
            }
        });
    }

    function restore_from_trash(page_id) {
        const page_title = $('#table-row-title-' + page_id + ' strong').text();
        if (!confirm("Are you sure you want to restore '" + page_title + "'?")) return;

        const form_data = "request_type=restore_page_from_trash&page_id=" + page_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

        ajax_request(form_data, false).done(function(response) {
            response = JSON.parse(response);
            if (response.status === 'success') {
                Toastify({
                    text: response.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
                $('#published-pages-tbody').load(location.href + ' #published-pages-tbody > *');
                $('#trashed-pages-tbody').load(location.href + ' #trashed-pages-tbody > *');
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
    }

    function delete_page(page_id) {
        const page_title = $('#table-row-title-' + page_id + ' strong').text();
        if (!confirm("Are you sure you want to permanently delete '" + page_title + "'?")) return;

        const form_data = "request_type=delete_page&page_id=" + page_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

        ajax_request(form_data, false).done(function(response) {
            response = JSON.parse(response);
            if (response.status === 'success') {
                Toastify({
                    text: response.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
                $('#trashed-pages-tbody').load(location.href + ' #trashed-pages-tbody > *');
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
    }
</script>