<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "xeltrix_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully with PDO"; 
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
