<?php include '../config/db.php'; session_start(); ?>

<form method="POST">
<input name="username" placeholder="Username" required>
<input name="password" type="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>

<?php
if ($_POST) {
    $u = $_POST['username'];
    $p = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $u);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($p, $user['password'])) {
        session_regenerate_id(true); // prevent session fixation
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
    } else {
        echo "Invalid login";
    }
}
?>