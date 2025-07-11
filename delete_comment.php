<?php
session_start();
include 'config.php'
if(!isset($_SESSION['user_id'])){
    die("you must be logged in.");
}
if(isset($_GET['id']))
{
    $id =intval($_GET['id']); //trying to avoid some sort of sql injection
    $conn->query("DELETE FROM comments WHERE id = $id");
    echo "comment deleted!";
}else {
    echo "no comment id provided"
}

?>