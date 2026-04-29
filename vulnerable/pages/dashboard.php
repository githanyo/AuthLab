
<?php include '../includes/auth.php'; check_login(); ?>
<h2>Welcome <?php echo $_SESSION['user']['username']; ?></h2>
<a href="profile.php?id=<?php echo $_SESSION['user']['id']; ?>">My Profile</a>
<a href="admin.php">Admin Panel</a>
<a href="../logout.php">Logout</a>
