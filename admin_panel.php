<?php
session_start();

if (!isset($_SESSION['admin'])) {
    die("Access denied.");
}

$flag = file_exists("admin_flag.txt") ? file_get_contents("admin_flag.txt") : "Flag file missing.";

echo "<h2>Welcome to the Admin Panel</h2>";
echo "<p style='color: green;'>$flag</p>";
?>
