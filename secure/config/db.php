<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "authlab_secure";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed.");
}

// Enable strict error reporting (optional for dev)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>