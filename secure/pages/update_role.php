<?php 
include '../config/db.php'; 
include '../includes/auth.php'; 

check_login();
require_role('admin');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$role = $_GET['role'] ?? '';

$allowed_roles = ['user', 'admin'];

if (!$id || !in_array($role, $allowed_roles)) {
    die("Invalid input.");
}

$stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
$stmt->bind_param("si", $role, $id);
$stmt->execute();

echo "Role updated securely.";
?>