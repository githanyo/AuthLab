
<?php
session_start();
function check_login() {
    if (!isset($_SESSION['user'])) {
        header("Location: /authlab/pages/login.php");
        exit();
    }
}
?>
