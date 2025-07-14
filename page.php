<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home.php';

// Local File Inclusion vulnerability
include($page);
?>
