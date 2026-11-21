<?php

// Fetch Active & Trashed
$active_patients = admin_list_fetch(fn()=>getPatientsList(), 'patients', 'active_patients');
$trashed_patients = admin_list_fetch(fn()=>getTrashedPatientsList(), 'patients', 'trashed_patients');

// Columns for the table
$columns = [
    [
        'key'   => 'id',
        'label' => 'Patient Id',
        'renderer' => function ($row) {
            $pid = 'PI-' . prefix_00($row['patientid']);
            return $pid;
        }
    ],
    [
        'key'   => 'first_name',
        'label' => 'Patient',
        'renderer' => function ($row) {
            $name = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
            $uhid = $row['uhid'];

            return '
                <div class="d-flex flex-column">
                    <a href="./?id=' . $row['id'] . '&view" class="text-heading text-truncate"><span class="fw-medium" id="table-row-full-name-' . $row['id'] . '">' . $name . '</span></a>
                    <small>' . $uhid . '</small>
                </div>
            ';
        }
    ],
    [
        'key'   => 'age',
        'label' => 'Age',
    ],
    [
        'key'   => 'gender',
        'label' => 'Gender',
        'renderer' => function ($row) {

            $gender = $row['gender'];

            switch ($gender) {
                case 'm':
                    $gender = 'Male';
                    break;
                case 'f':
                    $gender = 'Female';
                    break;
                default:
                    $gender = 'Others';
                    break;
            }


            return $gender;
        }
    ],
    [
        'key'   => 'address_state',
        'label' => 'State',
        'renderer' => function ($row) {
            if(empty($row['address_state'])) {
                return '-';
            }
            $state = getAddressStateById($row['address_state']);
            return $state['state_name'];
        }
    ],
    [
        'key'   => 'is_foot_examination_done',
        'label' => 'Foot Examination',
        'renderer' => function ($row) {

            $foot_examination = $row['is_foot_examination_done'];

            $foot_examination_status = '<span class="badge bg-label-dark">Pending</span>';
            if ($foot_examination) {
                $foot_examination_status = '<span class="badge bg-label-primary">Completed</span>';
            }

            return $foot_examination_status;
        }
    ],
];

// Counts
$activeCount  = admin_list_total($active_patients, 'active_patients');
$trashedCount = admin_list_total($trashed_patients, 'trashed_patients');
?>
<div class="card">
    <div class="card-body" id="section-data">

        <?php
        // ✅ Generic Tabs (Active, Trash, +New)
        renderModuleTabs('patient', $activeCount, $trashedCount);
        ?>

        <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">

            <!-- ✅ Active -->
            <div class="tab-pane fade show active" id="tab-active" role="tabpanel">
                <?php
                renderPermissionAwareTable(
                    'patient',   // module name
                    $active_patients,
                    $columns,
                    ['view', 'edit', 'trash'],   // allowed actions for active list
                    'id'  // rowIdKey
                );
                ?>
            </div>


            <div class="tab-pane fade" id="tab-trash" role="tabpanel">
                <?php
                renderPermissionAwareTable(
                    'patient',   // module name
                    $trashed_patients,
                    $columns,
                    ['restore', 'delete_permanent'], // trashed actions
                    'id'  // rowIdKey
                );
                ?>
            </div>
        </div>

    </div>
</div>



<script>
    async function takeAction(action, id) {
        let display_name = $('#table-row-full-name-' + id).text().trim();

        let confirmMsg = "";
        let dialogTitle = "";
        let requestType = "";

        switch (action) {
            case "trash":
                confirmMsg = `Are you sure you want to trash/deactivate the Patient ${display_name}?`;
                dialogTitle = "Trash/Deactivate Patient";
                requestType = "send_patient_to_trash";
                break;
            case "restore":
                confirmMsg = `Are you sure you want to restore the Patient '${display_name}'?`;
                dialogTitle = "Restore Patient";
                requestType = "restore_patient_from_trash";
                break;
            case "delete":
                confirmMsg = `Are you sure you want to permanently delete the Patient '${display_name}'?`;
                dialogTitle = "Permanently Delete Patient";
                requestType = "delete_patient";
                break;
            default:
                console.warn("Unknown action:", action);
                return;
        }

        // ✅ Ask confirmation
        let confirmed = await ConfirmDialogBox(confirmMsg, dialogTitle);
        if (!confirmed) return;

        let form_data = `request_type=${requestType}&id=${id}&updated_by=<?= $_SESSION[USER_AUTH] ?>`;

        ajax_request(form_data, false).done(function(response) {
            try {
                response = JSON.parse(response);
                if (response.status === "success") {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    // ✅ Reload table section only
                    // ✅ Reload table dynamically + re-init DataTables
                    $('#section-data').load(location.href + ' #section-data > *', function() {
                        $('table:not([data-server-page="1"])').DataTable({
                            destroy: true,
                            select: true
                        });
                    });

                } else {
                    showErrorToast("Failed to process request!");
                }
            } catch (e) {
                console.error("Invalid JSON:", response);
                showErrorToast("Unexpected response!");
            }
        }).fail(function(err) {
            console.error("AJAX Error:", err);
            showErrorToast("Request failed!");
        });
    }

    function showErrorToast(msg) {
        Toastify({
            text: msg,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "red",
        }).showToast();
    }
</script>