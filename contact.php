<?php
include 'config.php'; // Connect to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // OPTIONAL: validate or sanitize fields here

    // === File Upload Handling ===
    $upload_status = "";
    $uploaded_file_path = "";

    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "uploads/";  // make sure this folder exists and is writable
        $original_name = basename($_FILES['attachment']['name']);
        $target_path = $upload_dir . $original_name;

        // Move uploaded file
        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_path)) {
            $upload_status = "File uploaded successfully.";
            $uploaded_file_path = $target_path;
        } else {
            $upload_status = "Failed to upload file.";
        }
    }

    // === Insert contact form into DB ===
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<p>Thank you for contacting us!</p>";
        if ($upload_status) {
            echo "<p>$upload_status</p>";
        }
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
