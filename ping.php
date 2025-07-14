<?php
if (isset($_GET['ip'])) {
    $ip = $_GET['ip'];
    
    echo "<h3>Pinging $ip...</h3><pre>";
    
    // Vulnerable: unsanitized input passed to system()
    system("ping -c 1 " . $ip);

    // Trigger flag if common payload used
    if (strpos($ip, '&&') !== false || strpos($ip, ';') !== false) {
        echo "\n\nflag{cmd_injection_success}";
    }

    echo "</pre>";
} else {
?>
    <form method="GET" action="">
        <label>Enter IP address to ping:</label><br>
        <input type="text" name="ip" placeholder="e.g. 8.8.8.8" required />
        <button type="submit">Ping</button>
    </form>
<?php
}
?>
