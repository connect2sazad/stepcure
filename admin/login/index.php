<?php

require_once __DIR__ . '/../admin.php';


?>
<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

<head>

  <!-- Admin Meta Data -->
  <?= loadAdminMetaData() ?>

  <!-- Title & Favion -->
  <?= loadAdminTitleAndFavicon('Login') ?>

  <!-- Core CSS & Fonts -->
  <?= loadAdminStyleSheets() ?>

  <!-- Page CSS -->
  <link rel="stylesheet" href="<?= systemVariable('SITE_DIR') ?>assets/vendor/css/pages/page-auth.css" />

  <!-- JS & JQuery -->
  <?= loadAdminScripts() ?>

  <?= getAjaxRequester() ?>

  <script>
    // toaster('success', "hii")
  </script>

</head>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                <img src="<?= systemVariable('SITE_DIR') ?>assets/img/icons/brands/logo.png" alt="" srcset="">
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Welcome to <?= systemVariable('SITE_NAME') ?> Admin! 👋</h4>
            <p class="mb-4">Please sign-in to your account and start the adventure</p>

            <form id="admin_login" class="mb-3" method="POST">
              <div class="mb-3">
                <label for="userid" class="form-label">User ID</label>
                <input type="text" class="form-control" id="userid" name="userid"
                  placeholder="Enter your User ID" autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <a href="auth-forgot-password-basic.html">
                    <small>Forgot Password?</small>
                  </a>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
              </div>
            </form>

            <!-- <p class="text-center">
              <span>New on our platform?</span>
              <a href="auth-register-basic.html">
                <span>Create an account</span>
              </a>
            </p> -->
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->

  <script>
    const ref_url = "<?= isset($_GET['ref']) && $_GET['ref'] !== '' ? $_GET['ref'] : '.' ?>";
  </script>


  <script>
    const seo_engine = {
      status: true,
      version: 1.2,
      code: '<?= base64_encode(base64_encode(systemVariable('meta_keywords_limit'))) ?>'
    };
  </script>

  <!-- Core JS -->
  <?= loadAdminFooterScripts() ?>

</body>

</html>