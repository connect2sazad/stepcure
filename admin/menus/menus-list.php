<?php
    $menus_list = getMenusList();
    $menus_list_trashed = getTrashedMenusList();
?>
<div class="card-body" id="section-data">

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-menus" aria-controls="navs-top-menus" aria-selected="true">
                Published Menus(<?= mysqli_num_rows($menus_list) ?>)
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-deleted-menus" aria-controls="navs-top-deleted-menus" aria-selected="false">
                Trashed Menus(<?= mysqli_num_rows($menus_list_trashed) ?>)
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" aria-selected="false" onclick="window.location.href='./?new_menu'">
                New Menu
            </button>
        </li>
    </ul>
    <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">
        <div class="tab-pane fade show active" id="navs-top-menus" role="tabpanel">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Menu name</th>
                        <th>Primary/Secondary</th>
                        <th>Updated By</th>
                        <th>Last Update</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php


                    if (mysqli_num_rows($menus_list) > 0) {
                        while ($row = mysqli_fetch_assoc($menus_list)) {
                            echo '
                               <tr>
                                    <td>' . $row['menu_id'] . '</td>
                                    <td id="table-row-title-' . $row['menu_id'] . '"> <strong><a href="./?menu_id=' . $row['menu_id'] . '&view">' . $row['menu_name'] . '</a></strong></td>
                                    <td>' . ($row['primary_secondary'] == 'primary_secondary' ? "Both" : ucwords($row['primary_secondary'])) . '</td>
                                    <td>' . $row['updated_by'] . '</td>
                                    <td>' . formatDateTime($row['updated_at']) . '</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="./?menu_id=' . $row['menu_id'] . '&view"><i class="fas fa-eye me-1"></i> View</a>
                                                <a class="dropdown-item" href="./?menu_id=' . $row['menu_id'] . '"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="send_to_trash(' . $row['menu_id'] . ')"><i class="fas fa-trash me-1"></i> Trash</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                               
                               ';
                        }
                    } else {
                        echo '<tr><td colspan="5">No Menus Found!</td></tr>';
                    }

                    ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="navs-top-deleted-menus" role="tabpanel">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Menu name</th>
                        <th>Primary/Secondary</th>
                        <th>Updated By</th>
                        <th>Last Update</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php


                    if (mysqli_num_rows($menus_list_trashed) > 0) {
                        while ($row = mysqli_fetch_assoc($menus_list_trashed)) {
                            echo '
                                <tr>
                                    <td>' . $row['menu_id'] . '</td>
                                    <td id="table-row-title-' . $row['menu_id'] . '"> <strong>' . $row['menu_name'] . '</strong></td>
                                    <td>' . ($row['primary_secondary'] == 'primary_secondary' ? "Both" : ucwords($row['primary_secondary'])) . '</td>
                                    <td>' . $row['updated_by'] . '</td>
                                    <td>' . formatDateTime($row['updated_at']) . '</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="restore_from_trash(' . $row['menu_id'] . ')"><i class="fas fa-trash-restore me-1"></i> Restore</a>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="delete_menu(' . $row['menu_id'] . ')"><i class="fas fa-times me-1"></i> Delete Permanently</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                ';
                        }
                    } else {
                        echo '<tr><td colspan="5">No Trashed Menus Found!</td></tr>';
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>


<script>

    function send_to_trash(menu_id) {
        var menu_name = $('#table-row-title-' + menu_id + ' strong a').text();

            var delete_confirmation = confirm("Are you sure you want to delete '" + menu_name + "'?");

            if (!delete_confirmation) {
                return;
            }

            var form_data = "request_type=send_menu_to_trash&menu_id=" + menu_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

            ajax_request(form_data, false).done(function(response) {
                response = JSON.parse(response);
                console.log(response);
                
                if (response.status == 'success') {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();
                    $('#section-data').load(location.href+' #section-data');
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
    
    function restore_from_trash(menu_id) {
        var menu_name = $('#table-row-title-' + menu_id + ' strong').text();

            var delete_confirmation = confirm("Are you sure you want to restore '" + menu_name + "'?");

            if (!delete_confirmation) {
                return;
            }

            var form_data = "request_type=restore_menu_from_trash&menu_id=" + menu_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

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
                    $('#section-data').load(location.href+' #section-data');
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
    
    function delete_menu(menu_id) {
        var menu_name = $('#table-row-title-' + menu_id + ' strong').text();

            var delete_confirmation = confirm("Are you sure you want to permanently delete '" + menu_name + "'?");

            if (!delete_confirmation) {
                return;
            }

            var form_data = "request_type=delete_menu&menu_id=" + menu_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

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
                    $('#section-data').load(location.href+' #section-data');
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

</script>