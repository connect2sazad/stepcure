<!-- banner part start-->
<section class="banner_part">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-xl-5">
                <div class="banner_text">
                    <div class="banner_text_iner">
                        <h5>Expert Footcare, Designed for You</h5>
                        <h1>Advanced Solutions & Skilled Specialists</h1>
                        <p>Stepcure offers personalized treatments for every foot condition using advanced technology and compassionate medical expertise. Get relief, restore balance, and walk confidently with Stepcure's expert footcare.</p>
                        <a href="#" class="btn_2">Make an appointment</a>

                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner_img stepcure-hero-visual" id="stepcure-hero-visual">
                    <div class="stepcure-orbit stepcure-orbit-one" aria-hidden="true"></div>
                    <div class="stepcure-orbit stepcure-orbit-two" aria-hidden="true"></div>
                    <canvas id="stepcure-foot-canvas" aria-label="Interactive 3D foot pressure scan"></canvas>
                    <img class="stepcure-3d-fallback" src="<?= theme_url('assets/img/banner_img.png') ?>" alt="Footcare specialist examining a patient">
                    <div class="stepcure-scan-line" aria-hidden="true"></div>
                    <div class="stepcure-scan-card stepcure-scan-card-top">
                        <span class="stepcure-pulse"></span>
                        <div><strong>Live foot scan</strong><small>Biomechanical analysis</small></div>
                    </div>
                    <div class="stepcure-scan-card stepcure-scan-card-bottom">
                        <strong id="stepcure-scan-value">98%</strong><span>scan accuracy</span>
                    </div>
                    <p class="stepcure-drag-hint"><i class="ti-move"></i> Move to explore</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner part start-->

<!-- about us part start-->
<section class="about_us padding_top">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6 col-lg-6">
                <div class="about_us_img">
                    <img src="<?= theme_url('assets/img/top_service.png') ?>" alt="">
                </div>
            </div>
            <div class="col-md-6 col-lg-5">
                <div class="about_us_text">
                    <h2>About us</h2>
                    <p>Stepcure Healthcare specializes in personalized footcare using advanced scanning, expert diagnosis, and tailored treatments. We serve all age groups with solutions for diabetic foot, deformities, and more — restoring comfort, confidence, and mobility with care.</p>
                    <a class="btn_2 " href="./about">learn more</a>
                    <div class="banner_item">
                        <div class="single_item">
                            <img src="<?= theme_url('assets/img/icon/banner_1.svg') ?>" alt="">
                            <h5>Emergency</h5>
                        </div>
                        <div class="single_item">
                            <img src="<?= theme_url('assets/img/icon/banner_2.svg') ?>" alt="">
                            <h5>Appointment</h5>
                        </div>
                        <div class="single_item">
                            <img src="<?= theme_url('assets/img/icon/banner_3.svg') ?>" alt="">
                            <h5>Qualfied</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about us part end-->

<!-- interactive treatment journey start -->
<section class="stepcure-journey" id="how-it-works">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="stepcure-journey-copy">
                    <span class="stepcure-eyebrow">Precision in every step</span>
                    <h2>From digital scan to confident movement</h2>
                    <p>See how advanced assessment and clinical expertise become a solution designed around your feet.</p>
                    <div class="stepcure-journey-progress" aria-hidden="true"><span></span></div>
                    <div class="stepcure-journey-steps" role="list">
                        <button class="stepcure-journey-step is-active" type="button" data-step="0" role="listitem">
                            <span>01</span><div><strong>Scan</strong><small>Capture pressure and alignment</small></div>
                        </button>
                        <button class="stepcure-journey-step" type="button" data-step="1" role="listitem">
                            <span>02</span><div><strong>Diagnose</strong><small>Identify the cause, not just pain</small></div>
                        </button>
                        <button class="stepcure-journey-step" type="button" data-step="2" role="listitem">
                            <span>03</span><div><strong>Personalize</strong><small>Design your custom orthotic</small></div>
                        </button>
                        <button class="stepcure-journey-step" type="button" data-step="3" role="listitem">
                            <span>04</span><div><strong>Move</strong><small>Restore comfort and confidence</small></div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="stepcure-pressure-map" id="stepcure-pressure-map">
                    <div class="stepcure-map-grid" aria-hidden="true"></div>
                    <div class="stepcure-map-foot" aria-hidden="true">
                        <span class="stepcure-map-toe toe-1"></span><span class="stepcure-map-toe toe-2"></span>
                        <span class="stepcure-map-toe toe-3"></span><span class="stepcure-map-toe toe-4"></span>
                        <span class="stepcure-map-toe toe-5"></span><span class="stepcure-map-sole"></span>
                        <i class="stepcure-hotspot hotspot-heel"></i><i class="stepcure-hotspot hotspot-arch"></i><i class="stepcure-hotspot hotspot-forefoot"></i>
                    </div>
                    <div class="stepcure-map-label"><span>ANALYSIS</span><strong id="stepcure-map-title">Digital pressure scan</strong><small id="stepcure-map-copy">Mapping weight distribution across the foot</small></div>
                    <div class="stepcure-map-axis axis-x" aria-hidden="true"></div>
                    <div class="stepcure-map-axis axis-y" aria-hidden="true"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- interactive treatment journey end -->

<!-- feature_part start-->
<section class="feature_part">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section_tittle text-center">
                    <h2>Our services</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-3 col-sm-12">
                <div class="single_feature">
                    <div class="single_feature_part">
                        <!-- <span class="single_feature_icon"><img src="< ?= theme_url('assets/img/icon/feature_1.svg') ?>" alt=""></span> -->
                        <h4>Diabetic Foot Care</h4>
                        <p>Prevent foot ulcers and infections with early diagnosis, regular assessments, and customized orthotics that promote healing, reduce pressure, and support long-term foot health and mobility.</p>
                    </div>
                </div>
                <div class="single_feature">
                    <div class="single_feature_part">
                        <!-- <span class="single_feature_icon"><img src="< ?= theme_url('assets/img/icon/feature_2.svg') ?>" alt=""></span> -->
                        <h4>Flat Feet & High Arches</h4>
                        <p>We assess your arch structure and create precision-fit insoles to relieve discomfort, correct alignment, and improve posture—helping you walk pain-free with confidence daily.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="single_feature_img">
                    <img src="<?= theme_url('assets/img/service.png') ?>" alt="">
                </div>
            </div>
            <div class="col-lg-3 col-sm-12">
                <div class="single_feature">
                    <div class="single_feature_part">
                        <!-- <span class="single_feature_icon"><img src="< ?= theme_url('assets/img/icon/feature_1.svg') ?>" alt=""></span> -->
                        <h4>Clubfoot (CTEV) Treatment</h4>
                        <p>Our non-invasive splints and pediatric-friendly orthotics help realign the foot over time, supporting natural development and mobility from infancy through early childhood stages.</p>
                    </div>
                </div>
                <div class="single_feature">
                    <div class="single_feature_part">
                        <!-- <span class="single_feature_icon"><img src="< ?= theme_url('assets/img/icon/feature_2.svg') ?>" alt=""></span> -->
                        <h4>Custom Footwear & Orthotics</h4>
                        <p>Stylish, supportive, and medically engineered footwear designed just for your feet. Improve comfort, posture, and balance with devices crafted using 3D scanning technology.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- feature_part start-->

<!-- our depertment part start-->
<section class="our_depertment section_padding">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-xl-12">
                <div class="depertment_content">
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                            <h2>Our Depertment</h2>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="single_our_depertment">
                                        <span class="our_depertment_icon"><img src="<?= theme_url('assets/img/icon/feature_2.svg') ?>"
                                                alt=""></span>
                                        <h4>Diabetic Foot Department</h4>
                                        <p>Focused on prevention and management of diabetic foot complications, we offer wound care, protective footwear, and orthotic solutions tailored to each patient's unique needs.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="single_our_depertment">
                                        <span class="our_depertment_icon"><img src="<?= theme_url('assets/img/icon/feature_2.svg') ?>"
                                                alt=""></span>
                                        <h4>Pediatric Orthotics</h4>
                                        <p>Specializing in clubfoot (CTEV), flat feet, and growth-related issues. Our team provides custom splints, braces, and early-stage interventions for lasting correction and mobility.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="single_our_depertment">
                                        <span class="our_depertment_icon"><img src="<?= theme_url('assets/img/icon/feature_2.svg') ?>"
                                                alt=""></span>
                                        <h4>Foot Deformity Correction</h4>
                                        <p>From bunions to high arches and limb length issues, this department uses scanning, orthotics, and minimally invasive approaches to restore alignment and function.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="single_our_depertment">
                                        <span class="our_depertment_icon"><img src="<?= theme_url('assets/img/icon/feature_2.svg') ?>"
                                                alt=""></span>
                                        <h4>Custom Footwear & Aesthetics</h4>
                                        <p>Where medical care meets design. Our footwear lab creates aesthetic, orthopedic shoes that combine comfort, support, and style — especially for long-term wearers.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- our depertment part end-->

<!--::doctor_part start::-->
<section class="doctor_part section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section_tittle text-center">
                    <h2> Experienced Doctors</h2>
                    <p>Trusted specialists with years of expertise in footcare, offering personalized treatment with compassion & precision.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="single_blog_item">
                    <div class="single_blog_img">
                        <img src="<?= theme_url('assets/img/doctor/doctor_1.png') ?>" alt="doctor">
                        <div class="social_icon">
                            <ul>
                                <li><a href="#"> <i class="ti-facebook"></i> </a></li>
                                <li><a href="#"> <i class="ti-twitter-alt"></i> </a></li>
                                <li><a href="#"> <i class="ti-instagram"></i> </a></li>
                                <li><a href="#"> <i class="ti-skype"></i> </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single_text">
                        <div class="single_blog_text">
                            <h3>Dr. Subhransu Sekhar Das</h3>
                            <p>Diabetic Foot Care & Wound Management</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="single_blog_item">
                    <div class="single_blog_img">
                        <img src="<?= theme_url('assets/img/doctor/doctor_4.png') ?>" alt="doctor">
                        <div class="social_icon">
                            <ul>
                                <li><a href="#"> <i class="ti-facebook"></i> </a></li>
                                <li><a href="#"> <i class="ti-twitter-alt"></i> </a></li>
                                <li><a href="#"> <i class="ti-instagram"></i> </a></li>
                                <li><a href="#"> <i class="ti-skype"></i> </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single_text">
                        <div class="single_blog_text">
                            <h3>Dr. Debasis Mohanty</h3>
                            <p>Pediatric Orthotics & Clubfoot (CTEV) Treatment</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="single_blog_item">
                    <div class="single_blog_img">
                        <img src="<?= theme_url('assets/img/doctor/doctor_2.png') ?>" alt="doctor">
                        <div class="social_icon">
                            <ul>
                                <li><a href="#"> <i class="ti-facebook"></i> </a></li>
                                <li><a href="#"> <i class="ti-twitter-alt"></i> </a></li>
                                <li><a href="#"> <i class="ti-instagram"></i> </a></li>
                                <li><a href="#"> <i class="ti-skype"></i> </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single_text">
                        <div class="single_blog_text">
                            <h3>Dr. Rakesh Kumar Nayak</h3>
                            <p>Foot & Ankle Biomechanics, Custom Orthotics</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="single_blog_item">
                    <div class="single_blog_img">
                        <img src="<?= theme_url('assets/img/doctor/doctor_3.png') ?>" alt="doctor">
                        <div class="social_icon">
                            <ul>
                                <li><a href="#"> <i class="ti-facebook"></i> </a></li>
                                <li><a href="#"> <i class="ti-twitter-alt"></i> </a></li>
                                <li><a href="#"> <i class="ti-instagram"></i> </a></li>
                                <li><a href="#"> <i class="ti-skype"></i> </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single_text">
                        <div class="single_blog_text">
                            <h3>Dr. Anupam Pradhan</h3>
                            <p>Aesthetic & Reconstructive Foot Surgery</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--::doctor_part end::-->

<!--::regervation_part start::-->
<section class="regervation_part section_padding">
    <div class="container">
        <div class="row align-items-center regervation_content">
            <div class="col-lg-7">
                <div class="regervation_part_iner">
                    <form>
                        <h2>Make an Appointment</h2>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" id="inputEmail4" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="password" class="form-control" id="inputPassword4"
                                    placeholder="Email address">
                            </div>
                            <div class="form-group col-md-6">
                                <select class="form-control" id="Select">
                                    <option value="1" selected>Select service</option>
                                    <option value="2">Name of service</option>
                                    <option value="3">Name of service</option>
                                    <option value="4">Name of service</option>
                                    <option value="5">Name of service</option>
                                </select>
                            </div>
                            <div class="form-group time_icon col-md-6">
                                <select class="form-control" id="Select2">
                                    <option value="" selected>Time</option>
                                    <option value="1">8 AM TO 10AM</option>
                                    <option value="1">10 AM TO 12PM</option>
                                    <option value="1">12PM TO 2PM</option>
                                    <option value="1">2PM TO 4PM</option>
                                    <option value="1">4PM TO 6PM</option>
                                    <option value="1">6PM TO 8PM</option>
                                    <option value="1">4PM TO 10PM</option>
                                    <option value="1">10PM TO 12PM</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <textarea class="form-control" id="Textarea" rows="4"
                                    placeholder="Your Note "></textarea>
                            </div>
                        </div>
                        <div class="regerv_btn">
                            <a href="#" class="btn_2">Make an Appointment</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="reservation_img">
                    <img src="<?= theme_url('assets/img/reservation.png') ?>" alt="" class="reservation_img_iner">
                </div>
            </div>
        </div>
    </div>
</section>
<!--::regervation_part end::-->

<!--::blog_part start::-->
<!-- <section class="blog_part section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section_tittle text-center">
                    <h2>Our Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="single-home-blog">
                    <div class="card">
                        <img src="< ?= theme_url('assets/img/blog/blog_2.png') ?>" class="card-img-top" alt="blog">
                        <div class="card-body">
                            <a href="#blog.html">
                                <h5 class="card-title">First cattle which earth unto let health for
                                    can get and see what you </h5>
                            </a>
                            <ul>
                                <li> <span class="ti-user"></span>Jhon mike</li>
                                <li> <span class="ti-bookmark"></span>Clinic, doctors</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="single-home-blog">
                    <div class="card">
                        <img src="< ?= theme_url('assets/img/blog/blog_3.png') ?>" class="card-img-top" alt="blog">
                        <div class="card-body">
                            <a href="#blog.html">
                                <h5 class="card-title">First cattle which earth unto let health for
                                    can get and see what you </h5>
                            </a>
                            <ul>
                                <li> <span class="ti-user"></span>Jhon mike</li>
                                <li> <span class="ti-bookmark"></span>Clinic, doctors</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!--::blog_part end::-->
