<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION[CLIENT_USER_AUTH])) {
    unset($_SESSION[CLIENT_USER_AUTH]);
}
echo "<script>window.location.href='" . systemVariable('SITE_HOME') . "';</script>";
exit;
