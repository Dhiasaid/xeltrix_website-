<?php
if (!isset($_GET['page'])) {
    die("Missing 'page' parameter.");
}

$page = $_GET['page']; // ❗ No sanitization = LFI

// Try to include the specified file
include($page);
?>
