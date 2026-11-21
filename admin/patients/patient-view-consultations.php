<?php

// Fetch Active & Trashed
$active_patients = fetchAsArray(getConsultationsListByPatientId($patient_id));

// Columns for the table
$columns = [
    [
        'key'   => 'id',
        'label' => 'Consultation Id',
        'renderer' => function ($row) {
            $pid = 'CI-' . prefix_00($row['consultationid']);
            $consultation_link = '<a href="' . systemVariable('SITE_HOME') . 'admin/consultations?id=' . $row['id'] . '&view">' . $pid . '</a>';
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
        'key'   => 'recommended_by_user_id',
        'label' => 'Recommended By',
        'renderer' => function ($row) {
            if (!empty($row['recommended_by_user_id'])) {

                // Get user who recommended
                $recommended_by = mysqli_fetch_assoc(getUserById($row['recommended_by_user_id']));
                if (!$recommended_by) return 'NA';

                $name   = htmlspecialchars(trim($recommended_by['first_name'] . ' ' . $recommended_by['last_name']));
                $userid = htmlspecialchars($recommended_by['userid']);

                // Determine treatment site
                $recommended_by_site_id = $recommended_by['treatment_site'] ?: userVariable('treatment_site');
                $treatment_site = mysqli_fetch_assoc(getSiteById($recommended_by_site_id));

                $treatment_site_name = '';
                $treatment_site_id   = '';
                $current_user_group  = userVariable('user_group');

                if ($treatment_site && (
                    $current_user_group == 1 ||
                    $current_user_group == 2 ||
                    $recommended_by_site_id != userVariable('treatment_site')
                )) {
                    $treatment_site_name = htmlspecialchars($treatment_site['site_name'] ?? '');
                    $treatment_site_id   = htmlspecialchars($treatment_site['site_id'] ?? '');
                }

                // Profile image / DP
                $load_dp = getDP([
                    'full_name' => $name,
                    'file_name' => $recommended_by['profile_image'] ?? '',
                    'class'     => 'rounded-circle',
                    'alt'       => 'Admin Profile Picture'
                ]);

                // Get honorifics
                $honorific = '';
                $user_honorifics = mysqli_fetch_assoc(getUserDesignationById($recommended_by['user_designation']));
                if (!empty($user_honorifics)) {
                    $honorific = htmlspecialchars($user_honorifics['default_honorifics']) . ' ';
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
                            <span class="fw-medium" id="table-row-full-name-' . htmlspecialchars($recommended_by['id']) . '">' . $honorific . $name . '</span>
                        </a>
                        <small>@' . $userid . '</small>
                        <small>' . $treatment_site_name . '</small>
                        <small>' . $treatment_site_id . '</small>
                    </div>
                </div>
            ';
            }

            // If no recommended_by_user_id found
            return 'NA';
        }
    ],

    [
        'key'   => 'gender',
        'label' => 'Doctor',
        'renderer' => function ($row) {

            $doctor = $row['user_id'];
            $doctor = getUserById($doctor);
            $doctor = mysqli_fetch_assoc($doctor);

            $name = htmlspecialchars($doctor['first_name'] . ' ' . $doctor['last_name']);
            $userid = $doctor['userid'];

            // get initials if dp image not found
            $load_dp = getDP([
                'full_name' => $name,
                'file_name' => $doctor['profile_image'],
                'class'     => 'rounded-circle',
                'alt'       => 'Admin Profile Picture'
            ]);


            $user_honorifics = getUserDesignationById($doctor['user_designation']);
            $user_honorifics = mysqli_fetch_assoc($user_honorifics);
            $user_honorifics = $user_honorifics['default_honorifics'];

            return '
                <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper"><div class="avatar avatar-sm me-4">
                        ' . $load_dp . '
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <a href="' . systemVariable('SITE_HOME') . 'admin/profile/?userid=' . $userid . '" class="text-heading text-truncate"><span class="fw-medium" id="table-row-full-name-' . $doctor['id'] . '">' . $user_honorifics . ' ' . $name . '</span></a>
                    <small id="table-row-userid-' . $doctor['id'] . '">@' . $doctor['userid'] . '</small>
                </div>
            ';

            return $doctor_details;
        }
    ],
    [
        'key'   => 'report',
        'label' => 'Report',
        'renderer' => function ($row) {

            // get if consent is generated
            $is_report_finalized = $row['is_report_finalized'];



            // if the consent is already generated, user (any) will be unable to update consultation/report
            if ($is_report_finalized) {
                $report_file_link = $row['report_file'];
                $report = '<a class="btn btn-sm btn-outline-dark" target="_blank" href=' . systemVariable('SITE_HOME') . 'system_generated/' . $report_file_link . '>Show</a>';
            } else {

                // if user loggedin is different from user that created consultation
                // $row['user_id] is the id of the user that created consultation
                // show update button only when current user is the conultation creator or is admin or superadmin
                if (userVariable('id') == $row['user_id'] || userVariable('user_group') == 2 || userVariable('user_group') == 1) {
                    $report = '<a class="btn btn-sm btn-outline-info" href="./">Update</a>';
                } else {
                    $report = '<span class="badge bg-label-warning">Pending</span>';
                }
            }

            return $report;
        }
    ]
];

// Counts
$activeCount  = count($active_patients);
?>
<?php
renderPermissionAwareTable(
    'patient',   // module name
    $active_patients,
    $columns,
    ['view'],   // allowed actions for active list
    'id'  // rowIdKey
);
