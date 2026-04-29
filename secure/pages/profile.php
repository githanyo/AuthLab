<?php 
include '../config/db.php'; 
include '../includes/auth.php'; 
check_login(); 

$user_id = $_SESSION['user']['id'];

$stmt = $conn->prepare("SELECT username, role FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<h3>Profile</h3>
<p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
<p>Role: <?php echo htmlspecialchars($user['role']); ?></p>