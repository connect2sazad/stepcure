<?php

$active_menu = isset($active_menu[0]) ? $active_menu[0] : '';

// get current id of user
$user = getUserByUserid($_SESSION[USER_AUTH]);
$user = mysqli_fetch_assoc($user);
$user_id = $user['id'];
$user_group = $user['user_group']; // <= will check this

$user_allowed_permissions = getUserAllEffectivePermissions($user_id);

// ✅ Pass super admin flag
$is_super_admin = ($user_group == 1);

sideBar___init($active_menu, $user_allowed_permissions, $is_super_admin);

function sideBar___init($active_page, $allowed_permissions, $is_super_admin)
{
    $menus = [
        [
            'title' => 'Dashboard',
            'icon'  => 'menu-icon tf-icons bx bx-home-circle',
            'link'  => SITE_URL . 'admin/',
            'permission' => 'dashboard'
        ],
        [
            'title' => 'Pages',
            'icon'  => 'menu-icon tf-icons bx bx-file-blank',
            'link'  => SITE_URL . 'admin/pages',
            'permission' => 'pages'
        ],
        [
            'title' => 'Blocks',
            'icon'  => 'menu-icon tf-icons bx bx-code-block',
            'link'  => SITE_URL . 'admin/#blocks',
            'permission' => 'blocks'
        ],
        [
            'title' => 'Menus',
            'icon'  => 'menu-icon tf-icons bx bx-menu',
            'link'  => SITE_URL . 'admin/menus',
            'permission' => 'menus'
        ],
        [
            'title' => 'Footer',
            'icon'  => 'menu-icon tf-icons far fa-file-alt',
            'link'  => SITE_URL . 'admin/#footer',
            'permission' => 'footer'
        ],
        [
            'title' => 'Product Categories',
            'icon'  => 'menu-icon tf-icons fas fa-boxes',
            'link'  => SITE_URL . 'admin/product-categories',
            'permission' => 'product_category'
        ],
        [
            'title' => 'Products',
            'icon'  => 'menu-icon tf-icons fas fa-box',
            'link'  => SITE_URL . 'admin/products',
            'permission' => 'product'
        ],
        [
            'title' => 'Inventory',
            'icon'  => 'menu-icon tf-icons fas fa-warehouse',
            'link'  => SITE_URL . 'admin/inventory',
            'permission' => 'inventory'
        ],
        [
            'title' => 'Sales',
            'icon'  => 'menu-icon tf-icons fas fa-tags',
            'link'  => SITE_URL . 'admin/sales',
            'permission' => 'sale'
        ],
        [
            'title' => 'Invoices',
            'icon'  => 'menu-icon tf-icons fas fa-file-invoice',
            'link'  => SITE_URL . 'admin/invoices',
            'permission' => 'invoice'
        ],
        [
            'title' => 'Treatment Sites',
            'icon'  => 'menu-icon tf-icons fas fa-clinic-medical',
            'link'  => SITE_URL . 'admin/treatment-sites',
            'permission' => 'treatment_site'
        ],
        [
            'title' => 'Patients',
            'icon'  => 'menu-icon tf-icons fas fa-user-injured',
            'link'  => SITE_URL . 'admin/patients',
            'permission' => 'patient'
        ],
        [
            'title' => 'Consultations',
            'icon'  => 'menu-icon tf-icons fas fa-user-md',
            'link'  => SITE_URL . 'admin/consultations',
            'permission' => 'consultation'
        ],
        [
            'title' => 'User Groups',
            'icon'  => 'menu-icon tf-icons fas fa-users',
            'link'  => SITE_URL . 'admin/user-groups',
            'permission' => 'user_group'
        ],
        [
            'title' => 'User Designations',
            'icon'  => 'menu-icon tf-icons fas fa-id-badge',
            'link'  => SITE_URL . 'admin/user-designations',
            'permission' => 'user_designation'
        ],

        [
            'title' => 'Users',
            'icon'  => 'menu-icon tf-icons fas fa-user-tie',
            'link'  => SITE_URL . 'admin/users',
            'permission' => 'user'
        ],
        [
            'title' => 'Address States',
            'icon'  => 'menu-icon tf-icons fas fa-compass',
            'link'  => SITE_URL . 'admin/address_states',
            'permission' => 'address_state'
        ],
        [
            'title' => 'Support',
            'icon'  => 'menu-icon tf-icons bx bx-support',
            'link'  => SITE_URL . 'admin/support',
            'permission' => 'support'
        ],
        [
            'title' => 'SEO Maker',
            'icon'  => 'menu-icon tf-icons bx bx-arrow-to-top',
            'link'  => SITE_URL . 'admin/seo-maker',
            'permission' => 'seo_maker_settings'
        ],
        [
            'title' => 'Settings',
            'icon'  => 'menu-icon tf-icons bx bx-cog',
            'link'  => SITE_URL . 'admin/settings',
            'permission' => 'app_settings'
        ],
        [
            'title' => 'Admin Logs',
            'icon'  => 'menu-icon tf-icons fas fa-box',
            'link'  => SITE_URL . 'admin/logs',
            'target' => 'blank',
            'permission' => 'logs'
        ]
    ];

    sideBar($menus, $active_page, $allowed_permissions, $is_super_admin);
}

function sideBar($menus, $active_page, $allowed_permissions, $is_super_admin)
{
    echo '
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="https://www.lyncdigit.com" target="_blank" class="app-brand-link mt-3 mb-3">
                    <img src="https://lyncdigit.com/lyncdigit.png" alt="Lyncdigit">
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">';

    // ✅ Only filter if NOT super admin
    if (!$is_super_admin) {
        $menus = array_filter($menus, function ($menu) use ($allowed_permissions) {
            // Always allow Dashboard
            if ($menu['permission'] === 'dashboard') {
                return true;
            }
            // Show if user has permission for this menu
            return in_array($menu['permission'], $allowed_permissions);
        });
    }

    foreach ($menus as $menu) {

        $is_active = ($active_page == $menu['title']) ? ' active' : '';

        $target = '';
        if (array_key_exists('target', $menu)) {
            $target = 'target="' . $menu['target'] . '"';
        }

        echo '
            <li class="menu-item' . $is_active . '">
                <a href="' . $menu['link'] . '" class="menu-link" ' . $target . '>
                    <i class="' . $menu['icon'] . '"></i>
                    <div data-i18n="' . $menu['title'] . '">' . $menu['title'] . '</div>
                </a>
            </li>';
    }

    echo '</ul></aside>';
}
