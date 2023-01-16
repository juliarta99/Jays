<?php 
session_start();
require "../functions.php";

$id = $_SESSION['user']['id'];
$url = "../app/pesanan.php?id=$id";
header("Location: $url")
?>