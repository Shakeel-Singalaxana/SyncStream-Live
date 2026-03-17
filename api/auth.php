<?php
// api/auth.php
session_start();

function checkAuth() {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header('Location: ../admin/login.html');
        exit;
    }
}
?>
