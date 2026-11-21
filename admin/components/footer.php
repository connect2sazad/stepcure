<footer class="content-footer footer bg-footer-theme">
  <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
    <div class="mb-2 mb-md-0">
      Copyright &copy; <?= date('Y') ?> <?= systemVariable('SITE_NAME') ?> | All Rights Reserved. | Powered By <a href="https://connect2sazad.github.io/" target="_blank">connect2sazad</a>
    </div>
    <div>
      <a href="https://connect2sazad.github.io/" class="footer-link me-4" target="_blank">License</a>
      <!-- <a href="https://connect2sazad.github.io/" target="_blank" class="footer-link me-4">More Themes</a> -->

      <!-- <a href="https://connect2sazad.github.io/" target="_blank" class="footer-link me-4">Documentation</a> -->

      <a href="<?=SITE_HOME?>admin/support" target="_blank" class="footer-link me-4">Support</a>
    </div>
  </div>
</footer>

<?php
include_once __DIR__."/confirmDialogBox.php";
include_once __DIR__."/detailsDialogBox.php";

?>