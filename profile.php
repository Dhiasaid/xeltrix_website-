<?php
include 'config.php';

if (!isset($_GET['id'])) {
    die("Missing ID");
}

$id = $_GET['id'];

$result = $conn->query("SELECT name, email FROM users WHERE id = $id");

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "<h2>Profile of: " . htmlspecialchars($user['name']) . "</h2>";
    echo "<p>Email: " . htmlspecialchars($user['email']) . "</p>";
    if ($id == 2) {
        echo "<p style='color:red;'>flag{idor_profile_access}</p>";
    }
} else {
    echo "User not found.";
}
?>
