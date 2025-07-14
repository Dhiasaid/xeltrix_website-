<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($user === "admin" && $pass === "1234") {
        $_SESSION['admin'] = true;
        header("Location: admin_panel.php");
        exit();
    } else {
        echo "<p style='color:red;'>Login failed</p>";
    }
}
?>

<h2>Admin Login</h2>
<form method="POST">
  <input type="text" name="username" placeholder="Username" required><br><br>
  <input type="password" name="password" placeholder="Password" required><br><br>
  <button type="submit">Login</button>
</form>
