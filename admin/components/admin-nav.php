<link rel="stylesheet" href="<?= SITE_DIR ?>/assets/css/admin-nav.css" />
<div class="admin-navbar" id="admin-navbar">
    <div class="logo">
        <img src="https://lyncdigit.com/assets/images/logo.png" alt="Lyncdigit Logo">
    </div>

    <div class="hamburger" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="menu" id="menu">
        <a href="<?= systemVariable('SITE_HOME') ?>admin/dashboard/">Dashboard</a>
        <a href="<?= systemVariable('SITE_HOME') ?>admin/products/">Products</a>
        <a href="<?= systemVariable('SITE_HOME') ?>admin/media/">Media</a>
        <a href="<?= systemVariable('SITE_HOME') ?>admin/pages/">Pages</a>
        <a href="<?= systemVariable('SITE_HOME') ?>admin/settings/">Settings</a>
    </div>

    <div class="right" id="right">
        <a href="<?= systemVariable('SITE_DIR') ?>admin" target="_blank">View Admin Panel</a>
        <span class="username">Howdy, <?= userVariable('first_name') ?></span>
        <a href="<?= systemVariable('SITE_DIR') ?>admin/logout/">Log Out</a>
    </div>

    <script>
        // Function to toggle menu visibility
        function toggleMenu() {

            console.log("Toggle menu function called");
            

            const menu = document.getElementById("menu");
            const right = document.getElementById("right");

            if (menu && right) {
                menu.classList.toggle("show");
                right.classList.toggle("show");
            }
        }
    </script>
</div>