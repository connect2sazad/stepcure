<?php

require_once __DIR__ . '/core/init.php';

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$theme = ACTIVE_THEME;
$page = $_GET['page'] ?? 'home';
$segments = explode('/', $page);

// Default page path
$page_file = "themes/$theme/$page.php";
$page_in_table = getPageBySlug($page);

require __DIR__ . '/core/signature.php';
include "themes/$theme/header.php";

// Check admin login or other session-related checks
load_admin_auth();

// 👉 Handle category URLs like /products/womens-footwear
// 👉 Handle product category or single product view
if ($segments[0] === 'products') {
    $category_slug = $segments[1] ?? null;
    $product_slug = $segments[2] ?? null;

    if ($category_slug) {
        $category = getProductCategoryBySlug($category_slug);

        if ($category) {
            // If product slug exists, try to load the single product
            if ($product_slug) {
                // $product = getProductBySlugAndCategory($product_slug, $category['id']); // <-- You’ll create this function
                $product = "baptisia";

                if ($product) {
                    include "themes/$theme/product_single.php";
                    include "themes/$theme/footer.php";
                    exit;
                } else {
                    include "themes/$theme/404.php";
                    include "themes/$theme/footer.php";
                    exit;
                }
            }

            // If no product slug, just show category page
            include "themes/$theme/product_category.php";
            include "themes/$theme/footer.php";
            exit;
        } else {
            include "themes/$theme/404.php";
            include "themes/$theme/footer.php";
            exit;
        }
    }
}


// 👉 Load static file if exists: themes/theme-name/page.php
if (file_exists($page_file)) {
    include $page_file;
}
// 👉 Or check CMS pages from DB
else if ($page_in_table && mysqli_num_rows($page_in_table) > 0) {
    include_once "themes/$theme/page.php";
}
// 👉 Otherwise show 404
else {
    include "themes/$theme/404.php";
}

include "themes/$theme/footer.php";

require __DIR__ . '/core/signature.php';
