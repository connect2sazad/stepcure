<?php

$site_id = userVariable('treatment_site');

$my_consultations = admin_list_fetch(fn()=>(getConsultationsByUserId()), 'consultations', 'my_consultations');
if ($site_id) {
    $site_consultations = admin_list_fetch(fn()=>getConsultationsListBySiteId($site_id), 'consultations', 'site_consultations');
} else {
    $site_consultations = admin_list_fetch(fn()=>getConsultationsList(), 'consultations', 'site_consultations');
}

// Fetch Active & Trashed
$active_consultations = admin_list_fetch(fn()=>getConsultationsList(), 'consultations', 'active_consultations');
$trashed_consultations = admin_list_fetch(fn()=>getTrashedConsultationsListBySiteId($site_id), 'consultations', 'trashed_consultations');

// Columns for the table
$columns = [
    [
        'key'   => 'id',
        'label' => 'CON. Id',
        'renderer' => function ($row) {
            $cid = 'CI-' . prefix_00($row['consultationid']);
            $consultation_link = '<a href="./?id=' . $row['id'] . '&view">' . $cid . '</a>';
            return $consultation_link;
        }
    ],
    [
        'key'   => 'first_name',
        'label' => 'Patient Name',
        'renderer' => function ($row) {

            $patient = getPatientById($row['patient_id']);
            $patient = mysqli_fetch_assoc($patient);
            $name = htmlspecialchars($patient['first_name'] . ' ' . $patient['last_name']);
            $uhid = $patient['uhid'];
            $patientid = 'PI-' . prefix_00($patient['patientid']);

            return '
                <div class="d-flex flex-column">
                    <a href="' . systemVariable('SITE_HOME') . 'admin/patients/?id=' . $row['patient_id'] . '&view" class="text-heading text-truncate"><span class="fw-medium" id="table-row-full-name-' . $row['id'] . '">' . $name . '</span></a>
                    <small>' . $patientid . '</small>
                    <small>' . $uhid . '</small>
                </div>
            ';
        }
    ],
    [
        'key'   => 'recomended_by_user_id',
        'label' => 'Recomemded By',
        'renderer' => function ($row) {
            if ($row['recomended_by_user_id']) {

                // get details of recomended by user
                $recomended_by = mysqli_fetch_assoc(getUserById($row['recomended_by_user_id']));
                $name = htmlspecialchars($recomended_by['first_name'] . ' ' . $recomended_by['last_name']);
                $userid = $recomended_by['userid'];

                // get the site details of the recomended user
                // if the recomended_by user has not been assigned any site, temporarily in code, assign the loggedin user's site
                if (!$recomended_by['treatment_site']) {
                    $recomended_by_site = userVariable('treatment_site');
                    $treatment_site = mysqli_fetch_assoc(getSiteById($recomended_by_site));
                }

                $current_user_group = userVariable('user_group');
                $treatment_site_name = '';
                $treatment_site_id = '';

                // if user is admin or super admin or recomended_user's site matches the logged in user's site, then hide the site details
                if ($current_user_group == 1 || $current_user_group == 2 || $recomended_by['treatment_site'] != userVariable('treatment_site')) {
                    $treatment_site_name = $treatment_site['site_name'] ?? '';
                    $treatment_site_id = $treatment_site['site_id'] ?? '';
                }

                $load_dp = getDP([
                    'full_name' => $name,
                    'file_name' => $recomended_by['profile_image'],
                    'class'     => 'rounded-circle',
                    'alt'       => 'Admin Profile Picture'
                ]);

                // get honorifics of the user
                $user_honorifics = mysqli_fetch_assoc(getUserDesignationById($recomended_by['user_designation']));
                $honorific = '';
                if ($user_honorifics) {
                    $honorific = $user_honorifics['default_honorifics'] . ' ';
                }

                return '
                    <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                            <div class="avatar avatar-sm me-4">
                                ' . $load_dp . '
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="' . systemVariable('SITE_HOME') . 'admin/profile/?userid=' . $userid . '" class="text-heading text-truncate">
                                <span class="fw-medium" id="table-row-full-name-' . $recomended_by['id'] . '">' . $honorific . $name . '</span>
                            </a>
                            <small>@' . $userid . '</small>
                            <small>' . $treatment_site_name . '</small>
                            <small>' . $treatment_site_id . '</small>
                        </div>
                    </div>
                ';
            }

            // if the recomended id is not present, show NA
            return 'NA';
        }
    ],
    [
        'key'   => 'doctor',
        'label' => 'Doctor',
        'renderer' => function ($row) {
            $treatment_site = mysqli_fetch_assoc(getSiteById($row['site_id']));

            $current_user_group = userVariable('user_group');
            $treatment_site_name = '';
            $treatment_site_id = '';

            $doctor = mysqli_fetch_assoc(getUserById($row['user_id']));
            if(!$doctor){
                return '';
            }
            $name = htmlspecialchars($doctor['first_name'] . ' ' . $doctor['last_name']);
            $userid = $doctor['userid'];

            if ($current_user_group == 1 || $current_user_group == 2 || $row['site_id'] != $doctor['treatment_site']) {
                $treatment_site_name = $treatment_site['site_name'];
                $treatment_site_id = $treatment_site['site_id'];
            }

            $load_dp = getDP([
                'full_name' => $name,
                'file_name' => $doctor['profile_image'],
                'class'     => 'rounded-circle',
                'alt'       => 'Admin Profile Picture'
            ]);

            $user_honorifics = mysqli_fetch_assoc(getUserDesignationById($doctor['user_designation']));
            $honorific = $user_honorifics['default_honorifics'];

            return '
            <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                    <div class="avatar avatar-sm me-4">
                        ' . $load_dp . '
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <a href="' . systemVariable('SITE_HOME') . 'admin/profile/?userid=' . $userid . '" class="text-heading text-truncate">
                        <span class="fw-medium" id="table-row-full-name-' . $doctor['id'] . '">' . $honorific . ' ' . $name . '</span>
                    </a>
                    <small>@' . $userid . '</small>
                    <small>' . $treatment_site_name . '</small>
                    <small>' . $treatment_site_id . '</small>
                </div>
            </div>
        ';
        }
    ],
    [
        'key'   => 'report',
        'label' => 'Report',
        'renderer' => function ($row) {

            // get if consent is generated
            $is_report_finalized = $row['is_report_finalized'];



            // if the report is already generated, user (any) will be unable to update consultation
            if ($is_report_finalized) {
                $report_file_link = $row['report_file'];
                $report = '<a class="btn btn-sm btn-outline-dark" target="_blank" href=' . systemVariable('SITE_HOME') . 'system_generated/' . $report_file_link . '>Show</a>';
            } else {

                // if user loggedin is different from user that created consultation
                // $row['user_id] is the id of the user that created consultation
                // show update button only when current user is the consultation creator or is admin or superadmin
                if (userVariable('id') == $row['user_id'] || userVariable('user_group') == 2 || userVariable('user_group') == 1) {
                    $report = '<a class="btn btn-sm btn-outline-info" href="./?id=' . $row['id'] . '">Finalize</a>';
                } else {
                    $report = '<span class="badge bg-label-warning">Pending</span>';
                }
            }

            return $report;
        }
    ]
];

// Counts
$my_consultationsCount  = admin_list_total($my_consultations, 'my_consultations');
$site_consultationsCount  = admin_list_total($site_consultations, 'site_consultations');
$activeCount  = admin_list_total($active_consultations, 'active_consultations');
$trashedCount = admin_list_total($trashed_consultations, 'trashed_consultations');
?>
<div class="card">
    <div class="card-body" id="section-data">

        <?php

        $customTabs = [
            [
                'label' => 'My Consultations (' . $my_consultationsCount . ')',
                'permission' => 'view',
                'target' => '#tab-my-consultations',
                'index' => 0,
                "active" => true
            ],
            [
                'label' => 'Site Consultations (' . $site_consultationsCount . ')',
                'permission' => 'view',
                'target' => '#tab-site-consultations',
                'index' => 1,
                "active" => true
            ],
            // [
            //     'label' => 'Drafts (3)',
            //     'permission' => 'view',
            //     'target' => '#tab-drafts'
            //     // No index: will go after everything else
            // ]
        ];

        // ✅ Generic Tabs (Active, Trash, +New) with custom tabs
        renderModuleTabs('consultation', $activeCount, $trashedCount, $customTabs);
        ?>

        <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">

            <!-- my consultations here -->
            <div class="tab-pane fade show active" id="tab-my-consultations" role="tabpanel">
                <?php
                renderPermissionAwareTable(
                    'consultation',   // module name
                    $my_consultations,
                    $columns,
                    ['view', 'edit', 'trash'],   // allowed actions for active list
                    'id'  // rowIdKey
                );
                ?>
            </div>

            <div class="tab-pane fade" id="tab-site-consultations" role="tabpanel">
                <?php
                renderPermissionAwareTable(
                    'consultation',   // module name
                    $site_consultations,
                    $columns,
                    ['view', 'edit', 'trash'],   // allowed actions for active list
                    'id'  // rowIdKey
                );
                ?>
            </div>

            <!-- ✅ Active -->
            <div class="tab-pane fade" id="tab-active" role="tabpanel">
                <?php
                renderPermissionAwareTable(
                    'consultation',   // module name
                    $active_consultations,
                    $columns,
                    ['view', 'edit', 'trash'],   // allowed actions for active list
                    'id'  // rowIdKey
                );
                ?>
            </div>


            <div class="tab-pane fade" id="tab-trash" role="tabpanel">
                <?php
                renderPermissionAwareTable(
                    'consultation',   // module name
                    $trashed_consultations,
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
                confirmMsg = `Are you sure you want to trash/deactivate the Consultation for ${display_name}?`;
                dialogTitle = "Trash/Deactivate Consultation";
                requestType = "send_consultation_to_trash";
                break;
            case "restore":
                confirmMsg = `Are you sure you want to restore the Consultation for '${display_name}'?`;
                dialogTitle = "Restore Consultation";
                requestType = "restore_consultation_from_trash";
                break;
            case "delete":
                confirmMsg = `Are you sure you want to permanently delete the Consultation for '${display_name}'?`;
                dialogTitle = "Permanently Delete Consultation";
                requestType = "delete_consultation";
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

//     console.log($('table thead th').length);
// $('table tbody tr').each((i, row) => {
//   console.log(i, $(row).find('td').length);
// });
</script>