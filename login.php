<?php
session_start();
include 'config.php';  // Your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Prepare statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT id, name, password_hash, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Bind result variables
        $stmt->bind_result($id, $name, $password_hash, $role);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $password_hash)) {
            // Password correct, set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_role'] = $role;

            // Redirect based on role
            if ($role === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Email not registered.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
