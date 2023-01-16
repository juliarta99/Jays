<?php
session_start();
require "functions.php";

if(!isset($_SESSION["login"])){
      header("Location: app/login.php");
      exit;
}

$products = mysqli_query($conn, "SELECT * FROM product");
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
      <title>Product</title>
      <link rel="stylesheet" href="style.css">
</head>
<body>
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
                        <?php if($_SESSION['user']['level'] == 1) {?>
                        <li><a href="konfirmasiOrder.php" class="nav-link">Orders</a></li>
                        <?php } ?>
                  </ul>
                  <li class="li-profile">
                              <div class="show-profile">
                                    <img src="img/iconProfile.png" class="img-showProfile" alt="Icon Profile">
                                    <div class="menu-profile">
                                    <a href="app/pesanan.php?id=<?= $_SESSION['user']['id']; ?>" class="list-menu-profile">
                                          <img src="img/orders.png" class="img-menuProfile" alt="Profile">
                                          Pesanan
                                    </a>
                                    <a href="back/logout.php" class="list-menu-profile"
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
      <div id="product">
            <h1>Product</h1>
            <div class="content-product">
            <?php if($_SESSION['user']['level'] == 1 ){ ?>
                  <a href="app/tambahProduct.php" class="tambah-product">
                        <img src="img/tambah.png" class="img-tambah" alt="tambah product">
                  </a>
            <?php } ?>
            <?php while($product = mysqli_fetch_assoc($products)): ?>
                  <div class="product">
                        <img src="img/<?php echo $product["gambar"]; ?>" class="img-product" alt="Salad Buah">
                        <span class="nama-product"><?= $product["nama"]; ?></span>
                        <span class="harga-product">Rp. <?= $product["harga"]; ?></span>
                        <a href="app/chechkOut.php?id=<?= $product["id"]; ?>" class="beli">Beli</a>
                  </div>
            <?php endwhile; ?>
            </div>
      </div>
      <!-- content End -->
</body>
<script src="js/menuProfile.js"></script>
</html>