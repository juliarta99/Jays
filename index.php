<?php
session_start();
require "functions.php";

if(!isset($_SESSION["login"]) ) {
      header("Location: login.php");
      exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
      <title>Jays's</title>
      <link rel="stylesheet" href="style.css">
</head>
<body class="index">
      <!-- navbar Start -->
      <nav>
            <div class="hero">
                  <a href="index.php" class="logo">Jays's</a>
            <div class="menu">
                  <ul>
                        <li><a href="index.php" class="nav-link">Home</a></li>
                        <li><a href="product.php" class="nav-link">Product</a></li>
                        <li><a href="about.php" class="nav-link">About</a></li>
                        <li><a href="contact.php" class="nav-link">Contact</a></li>
                  </ul>
                  <li class="li-profile">
                              <div class="show-profile">
                                    <img src="img/iconProfile.png" class="img-showProfile" alt="Icon Profile">
                                    <div class="menu-profile">
                                    <a href="pesanan.php?id=<?= $_SESSION['user']['id']; ?>" class="list-menu-profile">
                                          <img src="img/orders.png" class="img-menuProfile" alt="Profile">
                                          Pesanan
                                    </a>
                                    <a href="app/logout.php" class="list-menu-profile"
                                          onclick="return confirm('Apakah anda yakin ingin logout?')";>
                                          <img src="img/logout.png" alt="Logout" class="img-menuProfile">
                                          Logout
                                    </a>
                                    </div>
                              </div>      
                        </li>
            </div>
            <div class="humberger">
                <span></span>
                <span></span>
                <span></span>   
            </div>
            </div>
      </nav>
      <script src="js/humberger.js"></script>
      <!-- navbar End -->

      <!-- content Start -->
      <div id="home">
            <div class="deskripsi">
                  <h1>Rasakan Kesegarannya Hanya di <b class="jays">Jays's</b></h1>
                  <p>Mulailah harimu dengan hal yang sehat.</p>
                  <a href="product.php" class="beli-now">Beli Sekarang</a>
            </div>
            <div class="img-deskripsi">
            <img src="img/saladBuah.png" class="img-home" alt="Salad Buah">
            </div>
      </div>
      <!-- content End -->
</body>
<script src="js/menuProfile.js"></script>
</html>