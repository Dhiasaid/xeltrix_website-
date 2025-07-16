<?php
if (isset($_GET['ip'])) {
    $ip = $_GET['ip'];
    echo "<pre>";
    system("ping -n 1 $ip");
    echo "</pre>";
    echo "<p>flag{cmd_injection_success}</p>";
}
