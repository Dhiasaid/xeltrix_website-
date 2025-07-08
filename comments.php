<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escape special characters to prevent SQL syntax errors
    $name = $conn->real_escape_string($_POST['name']);
    $comment = $conn->real_escape_string($_POST['comment']);

    // Build the query safely (still vulnerable to XSS because output is not escaped)
    $sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$comment')";

    if ($conn->query($sql) === TRUE) {
        header('Location: about.php');  // Redirect after success
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>