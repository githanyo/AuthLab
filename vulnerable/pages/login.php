
<?php include '../config/db.php'; session_start(); ?>
<form method="POST">
<input name="username" placeholder="Username">
<input name="password" placeholder="Password">
<button type="submit">Login</button>
</form>

<?php
if ($_POST) {
    $u = $_POST['username'];
    $p = $_POST['password'];

    // INTENTIONALLY NO PASSWORD HASHING
    $sql = "SELECT * FROM users WHERE username='$u' AND password='$p'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $_SESSION['user'] = $res->fetch_assoc();
        header("Location: dashboard.php");
    } else {
        echo "Invalid login";
    }
}
?>
