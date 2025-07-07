<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    // Not logged in or not admin — redirect to login
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin Dashboard - Xeltrix</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <h1>Admin Dashboard</h1>
    <nav>
      <a href="admin_dashboard.php">Dashboard</a> |
      <a href="logout.php">Logout</a>
    </nav>
  </header>
  <main>
    <h2>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?> (Admin)</h2>
    <p>Manage your site here.</p>

    <h3>Contact Messages</h3>
    <?php
    include 'config.php';

    $result = $conn->query("SELECT id, name, email, message, submitted_at FROM contacts ORDER BY submitted_at DESC");

    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='8' cellspacing='0'>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Submitted At</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>". $row['id'] ."</td>";
            echo "<td>". htmlspecialchars($row['name']) ."</td>";
            echo "<td>". htmlspecialchars($row['email']) ."</td>";
            echo "<td>". nl2br(htmlspecialchars($row['message'])) ."</td>";
            echo "<td>". $row['submitted_at'] ."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No contact messages found.</p>";
    }

    $conn->close();
    ?>
  </main>
  <footer>
    <p>&copy; <?= date("Y") ?> Xeltrix</p>
  </footer>
</body>
</html>
