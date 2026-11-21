<?php
if (isset($_SESSION[CLIENT_USER_AUTH]) && !empty($_SESSION[CLIENT_USER_AUTH])) {
    echo "<script>window.location.href='" . systemVariable('SITE_HOME') . "';</script>";
    exit;
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup']) && $_POST['signup'] === 'Register') {

    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['pass'] ?? '');
    $re_password = trim($_POST['re_pass'] ?? '');

    if ($first_name !== '' && $email !== '' && $password !== '' && $re_password !== '') {

        if ($password == $re_password) {

            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => $password
            ];

            $response = onlineUserRegister($data);


            if ($response['status'] === 'success') {
                // echo "<script>alert('Login successful!');</script>";
                // echo "<script>window.location.href='" . systemVariable('SITE_HOME') . "';</script>";
                pre($response);
                // exit;
            } else {
                $error_message = $response['message'] ?? 'Login failed. Please try again.';
            }

        } else {
            $error_message = "Password & Confirm Password doesn't match!";
        }
    }
}

?>
<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign up</h2>

                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger" id="errorAlert" style="position: relative; padding-right: 40px;">
                        <?= htmlspecialchars($error_message) ?>
                        <i class="ti-close"
                            id="closeError"
                            style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                        </i>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" class="register-form" id="register-form">
                    <div class="form-group">
                        <label for="first_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="first_name" id="first_name" placeholder="Your First Name" value="<?= $first_name ?? "" ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="last_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="last_name" id="last_name" placeholder="Your Last Name" value="<?= $last_name ?? "" ?>" />
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Your Email" value="<?= $email ?? "" ?>" required />
                    </div>

                    <!-- Password field -->
                    <div class="form-group password-group" style="position: relative;">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="pass" id="pass" placeholder="Password" required />
                        <i id="togglePass" class="ti-arrow-circle-down"
                            style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer; font-size:18px;"></i>
                    </div>

                    <!-- Confirm password field -->
                    <div class="form-group password-group" style="position: relative;">
                        <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" required />
                        <i id="toggleRePass" class="ti-arrow-circle-down"
                            style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer; font-size:18px;"></i>
                    </div>

                    <div class="form-group">
                        <label for="agree-term" class="label-agree-term">
                            <span><span></span></span>
                            By Signing Up, I agree all statements in
                            <a href="#" class="term-service">Terms of service</a>
                        </label>
                    </div>
                    <div class="form-group form-button text-center">
                        <input type="submit" name="signup" id="signup" class="btn_2 d-none d-lg-block" value="Register" />
                        <br>or <br><br>
                        <a href="<?php echo systemVariable('SITE_HOME'); ?>signin" class="mt-1 btn_2 d-none d-lg-block">Log in</a>
                    </div>
                </form>

                <!-- <div class="social-login mt-4">
                    <span class="social-label">Or login with</span>
                    <ul class="socials">
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-google ti-google"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook ti-facebook"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter ti-twitter"></i></a></li>
                    </ul>
                </div> -->
            </div>

            <div class="signup-image">
                <figure><img src="<?= theme_url('assets/img/signup-image.png') ?>" alt="sign up image"></figure>
                <!-- <a href="<?= systemVariable('SITE_HOME') ?>signin" class="signup-image-link">I am already member</a> -->
            </div>
        </div>
    </div>
</section>

<script>
    // Toggle Password Field
    const togglePass = document.getElementById('togglePass');
    const passField = document.getElementById('pass');
    togglePass.addEventListener('click', function() {
        const type = passField.getAttribute('type') === 'password' ? 'text' : 'password';
        passField.setAttribute('type', type);
        this.classList.toggle('ti-arrow-circle-down');
        this.classList.toggle('ti-arrow-circle-up');
    });

    // Toggle Confirm Password Field
    const toggleRePass = document.getElementById('toggleRePass');
    const rePassField = document.getElementById('re_pass');
    toggleRePass.addEventListener('click', function() {
        const type = rePassField.getAttribute('type') === 'password' ? 'text' : 'password';
        rePassField.setAttribute('type', type);
        this.classList.toggle('ti-arrow-circle-down');
        this.classList.toggle('ti-arrow-circle-up');
    });

    // Close error message
    const closeError = document.getElementById('closeError');
    if (closeError) {
        closeError.addEventListener('click', function () {
            const errorAlert = document.getElementById('errorAlert');
            errorAlert.style.opacity = '0';
            setTimeout(() => errorAlert.remove(), 300);
        });
    }   

</script>