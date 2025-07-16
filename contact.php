<?php
include 'config.php';

$name = $email = $message = "";
$upload_status = "";
$uploaded_file_path = "";
$submit_status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "uploads/";
        
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $original_name = basename($_FILES['attachment']['name']);
        $target_path = $upload_dir . $original_name;

        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_path)) {
            $upload_status = "File uploaded successfully: $original_name";
            $uploaded_file_path = $target_path;
        } else {
            $upload_status = "Failed to upload file.";
        }
    }

    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        $submit_status = "Thank you for contacting us!";
    } else {
        $submit_status = "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Contact Submission</title>
</head>
<body>

<h2>Contact Submission Result</h2>

<p><?php echo $submit_status; ?></p>
<?php if ($upload_status): ?>
    <p><?php echo $upload_status; ?></p>
<?php endif; ?>

<h3>Your submitted message (XSS vulnerable output):</h3>
<div style="border:1px solid #ccc; padding:10px;">
    <?php
    echo "<strong>Name:</strong> $name<br>";
    echo "<strong>Email:</strong> $email<br>";
    echo "<strong>Message:</strong><br>" . $message;
    ?>
</div>

<p><a href="contact.html">Back to Contact Form</a></p>

</body>
</html>
