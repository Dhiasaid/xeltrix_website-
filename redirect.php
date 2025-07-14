<?php
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    if (strpos($url, 'evil.com') !== false) {
        echo "<p style='color:red;'>flag{open_redirect_worked}</p>";
    }
    header("Location: " . $url);
    exit();
} else {
?>
    <form method="GET" action="">
        <label>Enter a URL to visit:</label><br>
        <input type="text" name="url" placeholder="https://example.com" required />
        <button type="submit">Go</button>
    </form>
<?php
}
?>
