<?php

// get id from userid
$id = getIdFromUserid($_SESSION[USER_AUTH]);

// get user group
$user_group_id = userVariable('user_group');
$user_group_res = getUserGroupById($user_group_id);
$user_group_data = mysqli_fetch_assoc($user_group_res);

if ($user_group_data) {
    $user_group_name  = $user_group_data['group_name'];
    $user_group_color = $user_group_data['color_code'] ?? '#ccc';
} else {
    $user_group_name  = 'Group NA';
    $user_group_color = '#ccc';
}

// get user treatment site
$treatment_site_id = userVariable('treatment_site');
$treatment_site_res = getSiteById($treatment_site_id);
$treatment_site_data = mysqli_fetch_assoc($treatment_site_res);

if ($treatment_site_data) {
    $treatment_site_name  = $treatment_site_data['site_id'] . ' (' . $treatment_site_data['site_name'] . ')';
    $treatment_site_color = $treatment_site_data['color_code'] ?? '#999';
} else {
    $treatment_site_name  = '';
    $treatment_site_color = '#999';
}

// get user designation
$user_designation_id = userVariable('user_designation');
$user_designation_res = getUserDesignationById($user_designation_id);
$user_designation_data = mysqli_fetch_assoc($user_designation_res);

if ($user_designation_data) {
    $user_designation_color = $user_designation_data['color_code'] ?? '#666';
} else {
    $user_designation_color = '#666';
}

// Now safely build the gradient
$avatar_border_gradient = "conic-gradient($treatment_site_color 0deg 120deg, $user_designation_color 120deg 240deg, $user_group_color 240deg 360deg)";

?>

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="search" class="form-control border-0 shadow-none" placeholder="Search..." name="admin_global_search" aria-label="Search..." />
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <div class="nav-item m-2">
                <span class="badge bg-label-dark"><?= $treatment_site_name ?></span>
            </div>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar-border" style="background: <?= $avatar_border_gradient ?>;">
                        <!-- <img id="nav-bar-admin-pic-1" src="< ?= systemVariable('SITE_HOME') . 'uploads/' . userVariable('profile_image') ?>" alt="User Avatar"> -->
                        <?php echo getDP([
                            'full_name' => userVariable('first_name') . ' ' . userVariable('last_name'),
                            'file_name' => userVariable('profile_image'),
                            'id'        => 'nav-bar-admin-pic-1',
                            'class'     => 'avatar-circle',
                            'alt'       => 'Admin Profile Picture'
                        ]); ?>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="<?= admin_dir() ?>profile">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-border" style="background: <?= $avatar_border_gradient ?>;">
                                        <!-- <img id="nav-bar-admin-pic-2" src="< ?= systemVariable('SITE_HOME') . 'uploads/' . userVariable('profile_image') ?>" alt="User Avatar"> -->
                                        <?php echo getDP([
                                            'full_name' => userVariable('first_name') . ' ' . userVariable('last_name'),
                                            'file_name' => userVariable('profile_image'),
                                            'id'        => 'nav-bar-admin-pic-2',
                                            'class'     => 'rounded-circle',
                                            'alt'       => 'Admin Profile Picture'
                                        ]); ?>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block"><?= $user_group_name ?></span>
                                    <small class="text-muted"><?= userVariable('first_name') ?> (<?= $_SESSION[USER_AUTH] ?>)</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?= SITE_URL ?>admin/profile">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?= SITE_URL ?>admin/settings">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?= SITE_URL ?>admin/logout">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>