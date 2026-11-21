<?php

if(isset($_SESSION[CLIENT_USER_AUTH]) && !empty($_SESSION[CLIENT_USER_AUTH])) {
    echo "<script>window.location.href='" . systemVariable('SITE_HOME') . "';</script>";
    exit;
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin']) && $_POST['signin'] === 'Log in') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email !== '' && $password !== '') {

        $data = [
            'email' => $email,
            'password' => $password
        ];

        $response = onlineUserLogin($data);


        if ($response['status'] === 'success') {
            // echo "<script>alert('Login successful!');</script>";
            echo "<script>window.location.href='" . systemVariable('SITE_HOME') . "';</script>";
            // pre($response['data']);
            // exit;
        } else {
            $error_message = $response['message'] ?? 'Login failed. Please try again.';
        }
    }
}
?>

<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="<?php echo theme_url('assets/img/signin-image.png'); ?>" alt="sign in image"></figure>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Log in</h2>
                
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger" id="errorAlert" style="position: relative; padding-right: 40px;">
                        <?= htmlspecialchars($error_message) ?>
                        <i class="ti-close" 
                           id="closeError" 
                           style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                        </i>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" class="register-form" id="login-form">
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="email" id="email" placeholder="Your Email"/>
                    </div>
                    <div class="form-group password-group" style="position: relative;">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="password" placeholder="Password"/>
                        <i id="togglePassword" class="ti-arrow-circle-down" 
                           style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer;"></i>
                    </div>

                    <div class="form-group form-button text-center">
                        <input type="submit" name="signin" id="signin" class="btn_2 d-none d-lg-block" value="Log in"/>
                        <br>or <br><br>
                        <a href="<?php echo systemVariable('SITE_HOME'); ?>signup" class="mt-1 btn_2 d-none d-lg-block">Register</a>
                    </div>
                </form>

                <!-- <div class="social-login">
                    <span class="social-label">Or login with</span>
                    <ul class="socials">
                        <li><a href="<?php echo systemVariable('SITE_HOME'); ?>google-login.php"><i class="display-flex-center zmdi zmdi-google ti-google"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook ti-facebook"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter ti-twitter"></i></a></li>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
</section>

<script>
    // Password show/hide
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
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
