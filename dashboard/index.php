<?php
session_start();
require "../functions.php";

if(!isset($_SESSION["login"]) ) {
      header("Location: ../login.php");
      exit;
}

if($_SESSION['user']['level'] == 0){
    header("HTTP/1.1 403 Forbidden");
    exit;
}

$produks = mysqli_query($conn, "SELECT * FROM product ORDER BY product.id DESC");
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
      <title>Dashboard Product</title>
      <link rel="stylesheet" href="../style.css">
</head>
<body>
         <!-- navbar Start -->
         <nav>
            <div class="hero">
                  <a href="index.php" class="logo">Dashboard Jays</a>
            <div class="menu">
                  <ul>
                        <li><a href="index.php" class="nav-link">Home</a></li>
                        <li><a href="konfirmasiOrder.php" class="nav-link">Order</a></li>
                        <li><a href="contact.php" class="nav-link">Contact</a></li>
                  </ul>
                  <li class="li-profile">
                              <div class="show-profile">
                                    <img src="../img/iconProfile.png" class="img-showProfile" alt="Icon Profile">
                                    <div class="menu-profile">
                                    <a href="../app/logout.php" class="list-menu-profile"
                                          onclick="return confirm('Apakah anda yakin ingin logout?')";>
                                          <img src="../img/logout.png" alt="Logout" class="img-menuProfile">
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
      <script src="../js/humberger.js"></script>
      <!-- navbar End -->

      <div id="konfirmasi">
            <!-- table pesanan start -->
            <h1 class="ml-1">Produk</h1>
            <a href="tambahProduct.php">
                <button class="beli-now ml-1">Tambah Produk</button>
            </a>
            <div class="table">
                  <div class="tablenya">
                        <table>
                              <thead>
                                    <tr>
                                          <th>Gambar</th>
                                          <th>Nama</th>
                                          <th>Harga</th>
                                          <th>Aksi</th>
                                    </tr>
                              </thead>
                              <tbody>
                                <?php while($produk = mysqli_fetch_assoc($produks)): ?>
                                    <tr>
                                        <td>
                                            <img src="../img/<?= $produk['gambar']; ?>" class="img-produk" alt="">
                                        </td>
                                        <td><?= $produk['nama']; ?></td>
                                        <td>Rp. <?= $produk['harga']; ?></td>
                                        <td>
                                            <div class="kondisi-leftPesan">
                                                <a href="editProduct.php?id=<?= $produk["id"]; ?>">
                                                        <img src="../img/ubah.png" class="edit-product" alt="edit">
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                              </tbody>
                        </table>
                  </div>
            </div>
            <!-- table pesanan end -->
      </div>
</body>
<script src="../js/menuProfile.js"></script>
</html>