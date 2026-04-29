<?php
session_start();

function check_login() {
    if (!isset($_SESSION['user'])) {
        header("Location: /authLab_vulnerable_vs_secure/secure_version/pages/login.php");
        exit();
    }
}

function require_role($role) {
    if ($_SESSION['user']['role'] !== $role) {
        die("Access denied: insufficient privileges.");
    }
}
?>