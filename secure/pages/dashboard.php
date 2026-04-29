<?php include '../includes/auth.php'; check_login(); ?>

<h2>Welcome <?php echo htmlspecialchars($_SESSION['user']['username']); ?></h2>

<a href="profile.php">My Profile</a>

<?php if ($_SESSION['user']['role'] === 'admin'): ?>
    <a href="admin.php">Admin Panel</a>
<?php endif; ?>

<a href="../logout.php">Logout</a>