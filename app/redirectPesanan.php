<?php 
session_start();
require "../functions.php";

$id = $_SESSION['user']['id'];
$url = "../pesanan.php?id=$id";
header("Location: $url")
?>