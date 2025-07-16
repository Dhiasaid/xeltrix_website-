<!-- admin.php -->
<?php
session_start();
$_SESSION['admin'] = true;

if (!isset($_SESSION['admin'])) {
    die("Access denied.");
}

$flag = file_exists("admin_flag.txt") ? file_get_contents("admin_flag.txt") : "Flag file missing.";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <script src="scripts/admin.js"></script>
</head>
<body>
    <h2>Welcome to the Admin Panel</h2>
    <p style='color: green;'><?php echo htmlspecialchars($flag); ?></p>
</body>
</html>
