<?php

$category = mysqli_fetch_assoc($category);

if(!$category) {
    // If category not found, redirect to 404 page
    include "themes/$theme/404.php";
    include "themes/$theme/footer.php";
    exit;
}

?>

<!-- breadcrumb start-->
<section class="breadcrumb_part breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2><?= $category['category_name'] ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<?php
// You can access $category_slug here
// echo "<h1>Category: " . htmlspecialchars($category_slug) . "</h1>";

// Fetch products by category and display
// $products = getProductsByCategorySlug($category_slug); // implement this
// foreach ($products as $product) {
//     echo "<div>{$product['name']}</div>";
// }
?>



<section class="product-listing container my-4">
    <div class="row">

        <!-- Sidebar Filters -->
        <div class="col-12 col-lg-3 mb-4">
            <div class="filters-wrapper h-100">
                <h5>Filters</h5>

                <!-- Category -->
                <div class="form-group">
                    <label for="filter-category">Category</label>
                    <select class="form-control" id="filter-category">
                        <option>All</option>
                        <option>Sandals</option>
                        <option>Running Shoes</option>
                        <option>Boots</option>
                    </select>
                </div>

                <!-- Price -->
                <div class="form-group mt-5rem">
                    <label for="price-range">Price Range</label>
                    <input type="range" class="custom-range" id="price-range" min="0" max="100" step="10">
                    <div class="d-flex justify-content-between text-muted small mt-1">
                        <span>$0</span>
                        <span>$100+</span>
                    </div>
                </div>

                <!-- Size -->
                <div class="form-group">
                    <label>Size</label>
                    <div class="checkbox-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="size7">
                            <label class="form-check-label" for="size7">7</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="size8">
                            <label class="form-check-label" for="size8">8</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="size9">
                            <label class="form-check-label" for="size9">9</label>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Sort -->
                <h5>Sort</h5>
                <div class="form-group">
                    <label for="sort-by">Sort By</label>
                    <select class="form-control" id="sort-by">
                        <option value="price-low-high">Price: Low to High</option>
                        <option value="price-high-low">Price: High to Low</option>
                        <option value="rating">Rating</option>
                        <option value="newest">Newest</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="col-12 col-lg-9">

            <!-- Product Cards -->
            <div class="row gy-4">


                <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4">
                    <div class="product-tile card h-100 text-center p-3">
                        <div class="image-wrapper position-relative">
                            <img
                                src="https://www.orthofeet.com/cdn/shop/files/80023-Nira-Black-Angle_1242x1674.jpg?v=1707508684"
                                data-src-hover="https://www.orthofeet.com/cdn/shop/files/Lifestyle_1500x1060_Nira_Black_1242x1674.jpg?v=1713453741"
                                class="product-img img-fluid"
                                alt="Product 1">
                        </div>
                        <div class="card-body">
                            <a class="product-title card-title text-break fw-bold" href="<?= rtrim(systemVariable('SITE_HOME'), '/') ?>/products/women-s-footwear/baptisia">Baptisia</a>

                            <!-- ⭐ Rating -->
                            <div class="product-rating mb-2">
                                <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                                <small class="text-muted">(84 reviews)</small>
                            </div>

                            <!-- 💸 Price -->
                            <div class="product-price mb-3">
                                <span class="text-success fw-bold h5">$29.99</span>
                                <span class="text-muted ms-2 text-decoration-line-through">$49.99</span><br>
                                <span class="text-info ms-2">40% off</span>
                            </div>

                            <button class="btn btn-primary add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4">
                    <div class="product-tile card h-100 text-center p-3">
                        <div class="image-wrapper position-relative">
                            <img
                                src="https://www.orthofeet.com/cdn/shop/files/80023-Nira-Black-Angle_1242x1674.jpg?v=1707508684"
                                data-src-hover="https://www.orthofeet.com/cdn/shop/files/Lifestyle_1500x1060_Nira_Black_1242x1674.jpg?v=1713453741"
                                class="product-img img-fluid"
                                alt="Product 1">
                        </div>
                        <div class="card-body">
                            <h5 class="product-title card-title text-break fw-bold">Product 1 Name</h5>

                            <!-- ⭐ Rating -->
                            <div class="product-rating mb-2">
                                <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                                <small class="text-muted">(84 reviews)</small>
                            </div>

                            <!-- 💸 Price -->
                            <div class="product-price mb-3">
                                <span class="text-success fw-bold h5">$29.99</span>
                                <span class="text-muted ms-2 text-decoration-line-through">$49.99</span><br>
                                <span class="text-info ms-2">40% off</span>
                            </div>

                            <button class="btn btn-primary add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4">
                    <div class="product-tile card h-100 text-center p-3">
                        <div class="image-wrapper position-relative">
                            <img
                                src="https://www.orthofeet.com/cdn/shop/files/80023-Nira-Black-Angle_1242x1674.jpg?v=1707508684"
                                data-src-hover="https://www.orthofeet.com/cdn/shop/files/Lifestyle_1500x1060_Nira_Black_1242x1674.jpg?v=1713453741"
                                class="product-img img-fluid"
                                alt="Product 1">
                        </div>
                        <div class="card-body">
                            <h5 class="product-title card-title text-break fw-bold">Product 1 Name</h5>

                            <!-- ⭐ Rating -->
                            <div class="product-rating mb-2">
                                <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                                <small class="text-muted">(84 reviews)</small>
                            </div>

                            <!-- 💸 Price -->
                            <div class="product-price mb-3">
                                <span class="text-success fw-bold h5">$29.99</span>
                                <span class="text-muted ms-2 text-decoration-line-through">$49.99</span><br>
                                <span class="text-info ms-2">40% off</span>
                            </div>

                            <button class="btn btn-primary add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4">
                    <div class="product-tile card h-100 text-center p-3">
                        <div class="image-wrapper position-relative">
                            <img
                                src="https://www.orthofeet.com/cdn/shop/files/80023-Nira-Black-Angle_1242x1674.jpg?v=1707508684"
                                data-src-hover="https://www.orthofeet.com/cdn/shop/files/Lifestyle_1500x1060_Nira_Black_1242x1674.jpg?v=1713453741"
                                class="product-img img-fluid"
                                alt="Product 1">
                        </div>
                        <div class="card-body">
                            <h5 class="product-title card-title text-break fw-bold">Product 1 Name</h5>

                            <!-- ⭐ Rating -->
                            <div class="product-rating mb-2">
                                <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                                <small class="text-muted">(84 reviews)</small>
                            </div>

                            <!-- 💸 Price -->
                            <div class="product-price mb-3">
                                <span class="text-success fw-bold h5">$29.99</span>
                                <span class="text-muted ms-2 text-decoration-line-through">$49.99</span><br>
                                <span class="text-info ms-2">40% off</span>
                            </div>

                            <button class="btn btn-primary add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4">
                    <div class="product-tile card h-100 text-center p-3">
                        <div class="image-wrapper position-relative">
                            <img
                                src="https://www.orthofeet.com/cdn/shop/files/80023-Nira-Black-Angle_1242x1674.jpg?v=1707508684"
                                data-src-hover="https://www.orthofeet.com/cdn/shop/files/Lifestyle_1500x1060_Nira_Black_1242x1674.jpg?v=1713453741"
                                class="product-img img-fluid"
                                alt="Product 1">
                        </div>
                        <div class="card-body">
                            <h5 class="product-title card-title text-break fw-bold">Product 1 Name</h5>

                            <!-- ⭐ Rating -->
                            <div class="product-rating mb-2">
                                <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                                <small class="text-muted">(84 reviews)</small>
                            </div>

                            <!-- 💸 Price -->
                            <div class="product-price mb-3">
                                <span class="text-success fw-bold h5">$29.99</span>
                                <span class="text-muted ms-2 text-decoration-line-through">$49.99</span><br>
                                <span class="text-info ms-2">40% off</span>
                            </div>

                            <button class="btn btn-primary add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4">
                    <div class="product-tile card h-100 text-center p-3">
                        <div class="image-wrapper position-relative">
                            <img
                                src="https://www.orthofeet.com/cdn/shop/files/80023-Nira-Black-Angle_1242x1674.jpg?v=1707508684"
                                data-src-hover="https://www.orthofeet.com/cdn/shop/files/Lifestyle_1500x1060_Nira_Black_1242x1674.jpg?v=1713453741"
                                class="product-img img-fluid"
                                alt="Product 1">
                        </div>
                        <div class="card-body">
                            <h5 class="product-title card-title text-break fw-bold">Product 1 Name</h5>

                            <!-- ⭐ Rating -->
                            <div class="product-rating mb-2">
                                <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                                <small class="text-muted">(84 reviews)</small>
                            </div>

                            <!-- 💸 Price -->
                            <div class="product-price mb-3">
                                <span class="text-success fw-bold h5">$29.99</span>
                                <span class="text-muted ms-2 text-decoration-line-through">$49.99</span><br>
                                <span class="text-info ms-2">40% off</span>
                            </div>

                            <button class="btn btn-primary add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <!-- Duplicate for more products... -->

            </div>





        </div>
    </div>
</section>