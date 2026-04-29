<?php 
include '../includes/auth.php'; 
check_login(); 
require_role('admin');
?>

<h2>Admin Panel</h2>

<a href="update_role.php?id=1&role=admin">Make User Admin</a>