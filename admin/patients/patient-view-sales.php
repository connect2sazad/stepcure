<?php

// Fetch Active & Trashed
$active_sales = fetchAsArray(getSalesListByPatientId($patient_id));

// Columns for the table
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
        'key'   => 'site_id',
        'label' => 'Treatment Site',
        'renderer' => function ($row) {

            $treatment_site = $row['site_id'];
            $treatment_site = getSiteById($treatment_site);
            $treatment_site = mysqli_fetch_assoc($treatment_site);
            $treatment_site_name = $treatment_site['site_name'];
            $treatment_site_id = $treatment_site['site_id'];

            $site_details = '
                <div class="d-flex flex-column">
                    <a href="' . systemVariable('SITE_HOME') . 'admin/treatment-sites?id=' . $row['site_id'] . '&view" class="text-heading text-truncate"><span class="fw-medium">' . $treatment_site_id . '</span></a>
                    <small>' . $treatment_site_name . '</small>
                </div>
            ';

            return $site_details;
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
$activeCount  = count($active_patients);
?>
<?php
renderPermissionAwareTable(
    'patient',   // module name
    $active_sales,
    $columns,
    ['view'],   // allowed actions for active list
    'id'  // rowIdKey
);
