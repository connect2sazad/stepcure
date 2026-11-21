<footer class="footer-area">
        <div class="footer section_padding">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-2 col-md-4 col-sm-6 single-footer-widget">
                        <a href="#" class="footer_logo"> <img src="<?= theme_url('assets/img/logo.png') ?>" alt="Stepcure Logo"> </a>
                        <p>Expert footcare, diabetic foot solutions, custom orthotics, and advanced treatments for healthier, pain-free steps.</p>
                        <div class="social_logo">
                            <a href="#"><i class="ti-facebook"></i></a>
                            <a href="#"> <i class="ti-twitter"></i> </a>
                            <a href="#"><i class="ti-instagram"></i></a>
                            <a href="#"><i class="ti-skype"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6 col-md-4 single-footer-widget">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href=".">Home</a></li>
                            <li><a href="./about">About us</a></li>
                            <li><a href="./services">Our Services</a></li>
                            <li><a href="./products">Our Products</a></li>
                            <li><a href="./contact">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-2 col-sm-6 col-md-4 single-footer-widget">
                        <h4>Explore</h4>
                        <ul>
                            <li><a href="#">Diabetic Foot Care</a></li>
                            <li><a href="#">CTEV Treatment</a></li>
                            <li><a href="#">Flat Feet & High Arches</a></li>
                            <li><a href="#">Custom Footwear & Orthotics</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-2 col-sm-6 col-md-6 single-footer-widget">
                        <h4>Products</h4>
                        <ul>
                            <li><a href="#">Women's Footwear</a></li>
                            <li><a href="#">Men's Footwear</a></li>
                            <li><a href="#">Foot Orthotics</a></li>
                            <li><a href="#">Custom Footwear</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-md-6 single-footer-widget">
                        <h4>Newsletter</h4>
                        <p>Stay updated with footcare tips, expert advice, and the latest treatment innovations.</p>
                        <div class="form-wrap" id="mc_embed_signup">
                            <form target="_blank"
                                action="#"
                                method="get" class="form-inline">
                                <input class="form-control" name="EMAIL" placeholder="Your Email Address"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '"
                                    required="" type="email">
                                <button class="click-btn btn btn-default text-uppercase"> <i class="ti-angle-right"></i>
                                </button>
                                <div style="position: absolute; left: -5000px;">
                                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value=""
                                        type="text">
                                </div>

                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright_part">
            <div class="container">
                <div class="row align-items-center">
                    <p class="footer-text m-0 col-lg-8 col-md-12">
                        Copyright &copy; <?= date('Y') ?> <?= systemVariable('SITE_NAME') ?> | All Rights Reserved | Proudly Powered by <i class="ti-heart" aria-hidden="true"></i> by <a href="https://www.lyncdigit.com"
                            target="_blank">Lyncdigit</a>
                    </p>
                    <div class="col-lg-4 col-md-12 text-center text-lg-right footer-social">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"> <i class="ti-twitter"></i> </a>
                        <a href="#"><i class="ti-instagram"></i></a>
                        <a href="#"><i class="ti-skype"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

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
        <script type="module" src="<?= theme_url('assets/js/stepcure-3d.js') ?>"></script>
    <?php endif; ?>
    <?php if (in_array(($page ?? ''), ['about', 'services', 'products'], true)): ?>
        <script type="module" src="<?= theme_url('assets/js/stepcure-pages-3d.js') ?>"></script>
    <?php endif; ?>
</body>

</html>
