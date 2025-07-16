<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$comment')";
 

    
    $sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$comment')";

    if ($conn->query($sql) === TRUE) {
        header('Location: about.php');  
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Xeltrix - About Us</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <header>
    <h1>Xeltrix</h1>
    <nav>
      <a href="index.html">Home</a>
      <a href="about.php">About</a>
      <a href="services.html">Services</a>
      <a href="contact.php">Contact</a>
      <a href="login.html">Login</a>
    </nav>
  </header>

  <section class="section">
    <h2>About Xeltrix</h2>
    <p>Xeltrix was founded with a simple mission: to bridge the gap between technology and business. We are a team of software engineers, security experts, and cloud architects focused on building reliable, innovative, and secure systems for our clients.</p>
  </section>

  <section class="section">
    <h2>Leave a comment</h2>
    <form action="about.php" method="POST">
      <input type="text" name="name" placeholder="Your Name" required /><br><br>
      <textarea name="comment" placeholder="Your comment" required></textarea><br><br>
      <button type="submit">Submit Comment</button>
    </form>

    <h2>All Comments:</h2>
    <div id="comments">
      <?php
      $result = $conn->query("SELECT name, comment FROM comments ORDER BY id DESC");
      while ($row = $result->fetch_assoc()) {
         
          echo "<p><strong>" . $row['name'] . ":</strong> " . $row['comment'] . "</p>";
          echo "<a href='delete_comment.php?id=" . $row['id'] . "'>Delete</a>";
      }
      ?>
    </div>
  </section>

  <footer>
    &copy; 2025 Xeltrix. All rights reserved.
  </footer>

</body>
</html>
