<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Not logged in, redirect to login page
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard - Xeltrix</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<header>
  <h1>Welcome to Xeltrix Dashboard</h1>
  <nav>
    <a href="dashboard.php">Dashboard</a> |
    <a href="logout.php">Logout</a>
  </nav>
</header>

<main>
  <h2>Hello, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h2>
  <p>You have successfully logged in.</p>
  <!-- You can add more content here like user info, stats, links, etc. -->
</main>

<footer>
  <p>&copy; <?= date("Y") ?> Xeltrix. All rights reserved.</p>
</footer>

</body>
</html>
