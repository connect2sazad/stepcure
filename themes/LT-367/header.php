<?php
$online_user = false;
if (isset($_SESSION[CLIENT_USER_AUTH]) && !empty($_SESSION[CLIENT_USER_AUTH])) {
    $online_user = $_SESSION[CLIENT_USER_AUTH];
    $online_user = getOnlineUserByEmail($online_user);

    $online_user_name = $online_user['first_name'] ?? 'User';
    // Get substring till first whitespace
    $firstPart = strtok($online_user_name, ' ');
    // Trim to 10 characters if it's too long
    if (strlen($firstPart) > 10) {
        $firstPart = substr($firstPart, 0, 10);
    }
    $online_user_first_name = htmlspecialchars($firstPart);
}
?>
<!DOCTYPE html>

<html lang="en">
<!-- stepcurehealthcare@gmail.com -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= systemVariable('SITE_NAME') ?></title>
    <link rel="manifest" href="./manifest.json">
    <link rel="icon" href="<?= systemVariable('SITE_HOME') . 'uploads/' . systemVariable('SITE_ICON') ?>" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= theme_url('assets/css/bootstrap.min.css') ?>">
    <!-- animate CSS -->
    <link rel="stylesheet" href="<?= theme_url('assets/css/animate.css') ?>">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="<?= theme_url('assets/css/owl.carousel.min.css') ?>">
    <!-- themify CSS -->
    <link rel="stylesheet" href="<?= theme_url('assets/css/themify-icons.css') ?>">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="<?= theme_url('assets/css/flaticon.css') ?>">
    <!-- magnific popup CSS -->
    <link rel="stylesheet" href="<?= theme_url('assets/css/magnific-popup.css') ?>">
    <!-- nice select CSS -->
    <link rel="stylesheet" href="<?= theme_url('assets/css/nice-select.css') ?>">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="<?= theme_url('assets/css/slick.css') ?>">
    <!-- style CSS -->
    <link rel="stylesheet" href="<?= theme_url('assets/css/style.css') ?>">
    

    <?php if (url_contains('signin') || url_contains('signup')): ?>
        <!-- signin CSS -->
        <link rel="stylesheet" href="<?= theme_url('assets/css/signup-style.css') ?>">
    <?php endif; ?>

    <!-- custom CSS -->
    <link rel="stylesheet" href="<?= theme_url('assets/css/custom.css') ?>">

    <!-- Fireworks.js CDN -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/fireworks-js@2.10.8/dist/index.umd.min.js"></script>
    <style>
        #fireworks-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            /* So it doesn't block clicking */
            z-index: 9999;
            /* So it appears on top of everything */
        }
    </style>
    <style>
        #diwali-text {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            user-select: none;
        }

        #diwali-text img {
            width: 150px;
            height: auto;
        }

        .diwali-message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #0e0c0cc4;
            text-shadow: 0 0 10px #ce8923ff, 0 0 20px #8a3a05ff;
            animation: blink 1s infinite alternate;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }


        @keyframes blink {
            0% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }

            50% {
                opacity: 0.5;
                transform: translate(-50%, -50%) scale(1.1);
            }

            100% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }
    </style> -->
</head>

<body>
    <!-- <div id="fireworks-container"></div>
    <div id="diwali-text">
        <div class="diwali-message">Happy Diwali!</div>
        <img src="https://i.pinimg.com/originals/22/e4/4d/22e44d9f632020cbad8ebf3593327e1b.gif" alt="">
    </div>
    <script>
        const container = document.getElementById('fireworks-container');
        const fireworks = new Fireworks.default(container, {
            autoresize: true,
            opacity: 0.5,
            acceleration: 1.05,
            friction: 0.97,
            gravity: 1.5,
            particles: 35,
            trace: 3,
            explosion: 5,
            intensity: 25,
            flickering: 50,
            hue: {
                min: 0,
                max: 360
            },
            delay: {
                min: 15,
                max: 30
            },
        });
        fireworks.start();
    </script> -->




    <!--::header part start::-->
    <header class="main_menu <?= $page == 'home' ? 'home_menu' : '' ?>">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="<?= systemVariable('SITE_HOME') ?>"> <img src="<?= systemVariable('SITE_HOME') . 'uploads/' . systemVariable('SITE_LOGO') ?>" alt="logo">
                            <div class="brand-name"> <?= systemVariable('SITE_NAME') ?> </div>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-center"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?= systemVariable('SITE_HOME') ?>">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= systemVariable('SITE_HOME') ?>about">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= systemVariable('SITE_HOME') ?>services">Services</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= systemVariable('SITE_HOME') ?>products">Products</a>
                                </li>

                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link" href="< ?= systemVariable('SITE_HOME') ?>products">Products</a>-->
                                <!--</li>-->
                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link" href="< ?= systemVariable('SITE_HOME') ?>products">Products</a>-->
                                <!--</li>-->
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="#Doctor.html">Doctors</a>
                                </li> -->

                                <!-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#blog.html" id="navbarDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Pages
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#services.html">services</a>
                                        <a class="dropdown-item" href="#dep.html">depertments</a>
                                        <a class="dropdown-item" href="#elements.html">Elements</a>
                                    </div>
                                </li> -->
                                <!-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#blog.html" id="navbarDropdown_1"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        blog
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                        <a class="dropdown-item" href="#blog.html">blog</a>
                                        <a class="dropdown-item" href="#single-blog.html">Single blog</a>
                                    </div>
                                </li> -->

                                <li class="nav-item">
                                    <a class="nav-link" href="<?= systemVariable('SITE_HOME') ?>contact">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <?php if (!$online_user): ?>
                            <a class="btn_2 d-none d-lg-block" href="<?= systemVariable('SITE_HOME') ?>signin">Login / Signup</a>
                        <?php else: ?>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn_2 p-2 px-4 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= $online_user_first_name ?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="<?= systemVariable('SITE_HOME') ?>cart">Cart</a>
                                    <a class="dropdown-item" href="<?= systemVariable('SITE_HOME') ?>members">Members</a>
                                    <a class="dropdown-item" href="<?= systemVariable('SITE_HOME') ?>settings">Settings</a>
                                    <a class="dropdown-item" href="<?= systemVariable('SITE_HOME') ?>logout">Logout</a>
                                </div>
                            </div>
                            <!-- <a class="btn_2 d-none d-lg-block" href="<?= systemVariable('SITE_HOME') ?>logout">Logout</a> -->
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->