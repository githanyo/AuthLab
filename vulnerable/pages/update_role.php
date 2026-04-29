
<?php include '../config/db.php'; include '../includes/auth.php'; check_login(); ?>

<?php
$id = $_GET['id'];
$role = $_GET['role'];

$sql = "UPDATE users SET role='$role' WHERE id=$id";
$conn->query($sql);

echo "Role updated";
?>

