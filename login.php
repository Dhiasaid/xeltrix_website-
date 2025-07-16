<?php
session_start();
$_SESSION['admin'] = true;
echo "Raw email input: " . $_POST['email'] . "<br>";
echo "Raw password input: " . $_POST['password'] . "<br><br>";
include 'config.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT id, name, email, role FROM users WHERE email = '$email' AND password_hash = '$password'";
    echo "<pre>$sql</pre>";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_role'] = $row['role'];


        if ($row['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        echo "Login failed.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
