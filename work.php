<?php
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    if (strpos($url, 'facebook.com') !== false) {
        echo "<p style='color:red;'>flag{open_redirect_worked}</p>";
        echo "<p>Redirecting in 3 seconds...</p>";
        echo "<meta http-equiv='refresh' content='3;url=" . htmlspecialchars($url) . "'>";
        exit();
    }
    header("Location: " . $url);
    exit();
}
?>
    <form method="GET" action="">
        <label>Enter a URL to visit:</label><br>
        <input type="text" name="url" placeholder="https://example.com" required />
        <button type="submit">Go</button>
    </form>

