
<?php include '../config/db.php'; include '../includes/auth.php'; check_login(); ?>

<?php
$id = $_GET['id']; // NO VALIDATION

$sql = "SELECT * FROM users WHERE id=$id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<h3>Profile</h3>
<p>Username: <?php echo $user['username']; ?></p>
<p>Role: <?php echo $user['role']; ?></p>
