<?php include __DIR__ . '/experience-footer.php'; ?>

    <!-- footer part end-->

    <!-- jquery plugins here-->

    <script src="<?= theme_url('assets/js/jquery-1.12.1.min.js') ?>"></script>
    <!-- popper js -->
    <script src="<?= theme_url('assets/js/popper.min.js') ?>"></script>
    <!-- bootstrap js -->
    <script src="<?= theme_url('assets/js/bootstrap.min.js') ?>"></script>
    <!-- owl carousel js -->
    <script src="<?= theme_url('assets/js/owl.carousel.min.js') ?>"></script>
    <script src="<?= theme_url('assets/js/jquery.nice-select.min.js') ?>"></script>
    <!-- contact js -->
    <script src="<?= theme_url('assets/js/jquery.ajaxchimp.min.js') ?>"></script>
    <script src="<?= theme_url('assets/js/jquery.form.js') ?>"></script>
    <script src="<?= theme_url('assets/js/jquery.validate.min.js') ?>"></script>
    <script src="<?= theme_url('assets/js/mail-script.js') ?>"></script>
    <script src="<?= theme_url('assets/js/contact.js') ?>"></script>
    <!-- custom js -->
    <script src="<?= theme_url('assets/js/custom.js') ?>"></script>
    <?php if (($page ?? '') === 'home'): ?>
        <script defer src="<?= theme_url('assets/js/movement.js') ?>"></script>
    <?php endif; ?>
    <?php if (in_array(($page ?? ''), ['about', 'services', 'products'], true)): ?>
        <script type="module" src="<?= theme_url('assets/js/stepcure-pages-3d.js') ?>"></script>
    <?php endif; ?>
<?php if (($page ?? '') === 'home') include __DIR__ . '/festival-overlay.php'; ?>
</body>

</html>
