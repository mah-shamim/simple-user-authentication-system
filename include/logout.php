<?php
require_once 'db.php';
/**
 * @return void
 */
function logout_user() {
    session_start();
    $_SESSION = array();
    session_destroy();
    header("location: ../backend/index.php");
    exit;
}
