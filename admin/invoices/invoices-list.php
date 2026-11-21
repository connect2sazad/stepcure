<?php

$site_id = userVariable('treatment_site');

$system_generated_invoices = admin_list_fetch(fn()=>getSystemGeneratedInvoices(), 'sales', 'system_generated_invoices');

$invoices = admin_list_fetch(fn()=>(getInvoices()), 'customer_invoices', 'invoices');

// Fetch Active & Trashed
$active_invoices = admin_list_fetch(fn()=>getInvoicesList(), 'customer_invoices', 'active_invoices');
$trashed_invoices = admin_list_fetch(fn()=>getTrashedInvoicesList(), 'customer_invoices', 'trashed_invoices');

// columns for system generated invoices table
$system_generated_invoices_columns = [
    [
        'key'   => 'saleid',
        'label' => 'Sale Id',
        'renderer' => function ($row) {
            $sid = 'SI-' . prefix_00($row['saleid']);
            $sale_link = '<a href="./?id=' . $row['id'] . '&view">' . $sid . '</a>';
            return $sale_link;
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
        'key'   => 'created_at',
        'label' => 'DATE',
        'renderer' => function ($row) {
            return date('d M Y', strtotime($row['created_at']));
        }
    ]
];

// Columns for the customer invoices table
$columns = [
    [
        'key'   => 'invoiceno',
        'label' => 'Invoice No',
        'renderer' => function ($row) {
            $sid = 'CSI-' . prefix_00($row['customerinvoiceuid']);
            $sale_link = '<a href="./?id=' . $row['id'] . '&view">' . $sid . '</a>';
            return $sale_link;
        }
    ],
    [
        'key'   => 'customer',
        'label' => 'Customer',
        'renderer' => function ($row) {
            $customer_name = $row['customer_name'];
            $sale_link = '<a href="./?id=' . $row['id'] . '&view">' . $customer_name . '</a>';
            return $sale_link;
        }
    ],
    [
        'key'   => 'updated_by',
        'label' => 'Updated By'
    ],
    [
        'key'   => 'total_value',
        'label' => 'Value',
        'renderer' => function ($row) {;

            $total = $row['grand_total'];
            return rupee($total);
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
$invoicesCount  = admin_list_total($invoices, 'invoices');
$trashedCount = admin_list_total($trashed_invoices, 'trashed_invoices');
$systemGeneratedinvoicesCount = admin_list_total($system_generated_invoices, 'system_generated_invoices');
?>
<div class="card">
    <div class="card-body" id="section-data">

        <?php

        $customTabs = [
            [
                'label' => 'System Generated Invoices (' . $systemGeneratedinvoicesCount . ')',
                'permission' => 'view',
                'target' => '#tab-system-invoices',
                'index' => 201,
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
        renderModuleTabs('invoice', $invoicesCount, $trashedCount, $customTabs);
        ?>

        <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">

            <!-- my invoices here -->
            <div class="tab-pane fade show active" id="tab-my-invoices" role="tabpanel">
                <?php
                renderPermissionAwareTable(
                    'invoice',   // module name
                    $invoices,
                    $columns,
                    ['view', 'edit', 'trash'],   // allowed actions for active list
                    'id'  // rowIdKey
                );
                ?>
            </div>

            <div class="tab-pane fade" id="tab-system-invoices" role="tabpanel">
                <?php
                renderPermissionAwareTable(
                    'invoice',   // module name
                    $system_generated_invoices,
                    $system_generated_invoices_columns,
                    ['view'],   // allowed actions for active list
                    'id'  // rowIdKey
                );
                ?>
            </div>

            <!-- ✅ Active -->
            <div class="tab-pane fade" id="tab-active" role="tabpanel">
                <?php
                renderPermissionAwareTable(
                    'invoice',   // module name
                    $active_invoices,
                    $columns,
                    ['view', 'edit', 'trash'],   // allowed actions for active list
                    'id'  // rowIdKey
                );
                ?>
            </div>


            <div class="tab-pane fade" id="tab-trash" role="tabpanel">
                <?php
                renderPermissionAwareTable(
                    'invoice',   // module name
                    $trashed_invoices,
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
                confirmMsg = `Are you sure you want to trash/deactivate the Invoice for ${display_name}?`;
                dialogTitle = "Trash/Deactivate Invoice";
                requestType = "send_invoice_to_trash";
                break;
            case "restore":
                confirmMsg = `Are you sure you want to restore the Invoice for '${display_name}'?`;
                dialogTitle = "Restore Invoice";
                requestType = "restore_invoice_from_trash";
                break;
            case "delete":
                confirmMsg = `Are you sure you want to permanently delete the Invoice for '${display_name}'?`;
                dialogTitle = "Permanently Delete Invoice";
                requestType = "delete_invoice";
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