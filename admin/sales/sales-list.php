<p><a class="btn btn-primary" href="../online-orders/">Online store orders</a></p>
<?php

$sales_list = admin_list_fetch(fn()=>getSalesList(), 'sales', 'sales_list');
$trashed_sales = admin_list_fetch(fn()=>getTrashedSalesList(), 'sales', 'trashed_sales');

// Column definitions
$columns = [
    [
        'key'   => 'saleid',
        'label' => 'Sale Id',
        'renderer' => function ($row) {
            $sid = 'SI-' . prefix_00($row['saleid']);
            $sale_link = '<a href="./?id='.$row['id'].'&view">'.$sid.'</a>';
            return $sale_link;
        }
    ],
    [
        'key'   => 'consultation_id',
        'label' => 'Consultation Id',
        'renderer' => function ($row) {
            $consultation_id = $row['consultation_id'];
            if ($consultation_id == null || $consultation_id == 0) {
                return '-';
            }
            $consultation = getConsultationById($consultation_id);
            $consultation = mysqli_fetch_assoc($consultation);
            $consultationid = 'CI-' . prefix_00($consultation['consultationid']);
            $consultation_link = '<a target="_blank" href="'.systemVariable('SITE_HOME').'admin/consultations/?id='.$consultation_id.'&view">'.$consultationid.'</a>';
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
        'key'   => 'consent',
        'label' => 'Consent',
        'renderer' => function ($row) {

            // get if consent is generated
            $is_consent_done = $row['is_consent_done'];



            // if the consent is already generated, user (any) will be unable to update sale
            if ($is_consent_done) {
                $consent_file_link = $row['consent_file'];
                $consent = '<a class="btn btn-sm btn-outline-dark" target="_blank" href=' . systemVariable('SITE_HOME') . 'system_generated/' . $consent_file_link . '>Show</a>';
            } else {

                // if user loggedin is different from user that created sale
                // $row['user_id] is the id of the user that created sale
                // show update button only when current user is the sale creator or is admin or superadmin
                if (userVariable('id') == $row['user_id'] || userVariable('user_group') == 2 || userVariable('user_group') == 1) {
                    $consent = '<a class="btn btn-sm btn-outline-info" href="./?id=' . $row['id'] . '">Generate</a>';
                } else {
                    $consent = '<span class="badge bg-label-warning">Pending</span>';
                }
            }

            return $consent;
        }
    ],
    [
        'key'   => 'sale',
        'label' => 'Invoice',
        'renderer' => function ($row) {

            // get if consent is generated
            $is_sale_finalized = $row['is_sale_finalized'];



            // if the invoice is already generated, user (any) will be unable to update sale
            if ($is_sale_finalized) {
                $sale_file_link = $row['sale_file']; // sale_file is the invoice
                $sale = '<a class="btn btn-sm btn-outline-dark" target="_blank" href=' . systemVariable('SITE_HOME') . 'system_generated/' . $sale_file_link . '>Show</a>';
            } else {

                // if user loggedin is different from user that created sale
                // $row['user_id] is the id of the user that created sale
                // show update button only when current user is the sale creator or is admin or superadmin
                if (userVariable('id') == $row['user_id'] || userVariable('user_group') == 2 || userVariable('user_group') == 1) {
                    $sale = '<a class="btn btn-sm btn-outline-info" href="./?id=' . $row['id'] . '">Generate</a>';
                } else {
                    $sale = '<span class="badge bg-label-warning">Pending</span>';
                }
            }

            return $sale;
        }
    ],
    [
        'key'   => 'created_at',
        'label' => 'DATE',
        'renderer' => function ($row) {
            return date('d M Y', strtotime($row['created_at']));
        }
    ]
];

// Counts
$activeCount = admin_list_total($sales_list, 'sales_list');
$trashedCount = admin_list_total($trashed_sales, 'trashed_sales');
?>

<div class="card-body" id="section-data">

    <?php renderModuleTabs('sale', $activeCount, $trashedCount); ?>

    <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">

        <!-- Active Sales -->
        <div class="tab-pane fade show active" id="tab-active" role="tabpanel">
            <?php renderPermissionAwareTable(
                'sale',
                $sales_list,
                $columns,
                ['view', 'edit', 'trash']  // allowed actions
            ); ?>
        </div>

        <!-- Trashed Sales -->
        <div class="tab-pane fade" id="tab-trash" role="tabpanel">
            <?php renderPermissionAwareTable(
                'sale',
                $trashed_sales,
                $columns,
                ['restore', 'delete_permanent'] // trashed actions
            ); ?>
        </div>
    </div>
</div>



<script>
    async function takeAction(action, sale_id) {
        let sale_name = $('#table-row-title-' + sale_id + ' strong').text() ||
            $('#table-row-title-' + sale_id + ' strong a').text();

        let confirmMsg = '';
        let apiRequestType = '';

        switch (action) {
            case 'trash':
                confirmMsg = `Are you sure you want to move '${sale_name}' to trash?`;
                apiRequestType = 'send_sale_to_trash';
                break;

            case 'restore':
                confirmMsg = `Are you sure you want to restore '${sale_name}'?`;
                apiRequestType = 'restore_sale_from_trash';
                break;

            case 'delete':
                confirmMsg = `Are you sure you want to permanently delete '${sale_name}'?`;
                apiRequestType = 'delete_sale';
                break;

            default:
                console.error("Unknown action:", action);
                return;
        }

        let confirmed = await ConfirmDialogBox(confirmMsg, "Confirm Action");
        if (!confirmed) return;

        let form_data = "request_type=" + apiRequestType + "&id=" + sale_id + "&updated_by=<?= $_SESSION[USER_AUTH] ?>";

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

                // ✅ Reload table dynamically
                $('#section-data').load(location.href + ' #section-data > *', function() {
                    // ✅ Re-init DataTables after reload
                    $('table:not([data-server-page="1"])').DataTable({
                        destroy: true,
                        select: true
                    });
                });
            } else {
                Toastify({
                    text: response.message || 'Action failed!',
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