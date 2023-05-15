<?php
session_start();
require "../functions.php";

if(!isset($_SESSION["login"]) ) {
      header("Location: ../app/login.php");
      exit;
}

if($_SESSION['user']['level'] == 0){
      header("HTTP/1.1 403 Forbidden");
      exit;
}

$pesanan = mysqli_query($conn, "SELECT pesanan.*, user.username, product.nama, product.harga FROM pesanan
INNER JOIN user ON user.id=pesanan.id_user
INNER JOIN product ON product.id=pesanan.id_product
ORDER BY pesanan.id DESC");

if(isset($_POST["cari"])) {
      $pesanan = cari($_POST["keyword"]);
}

$totalHarga = 0;
$totalProduksi = 0;
$totalSalad = 0;
$totalVirgin = 0;
$totalRedcoco = 0;
$totalOrange = 0;
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
      <title>Konfirmasi Order</title>
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
            <h1 class="title-konfirmasi">Orders</h1>
            <!-- form pencarian -->
            <form method="post" class="form-konfirmasi">
                  <input type="text" name="keyword" id="keyword" placeholder="Lakukan pencarian disini...." required>
                  <button type="submit" class="cari" name="cari">
                        <img src="../img/search.png" class="img-cari" alt="Cari">
                  </button>
            </form>
            <!-- form pencarian end -->

            <!-- table pesanan start -->
            <div class="table">
                  <div class="tablenya">
                        <table>
                              <thead>
                                    <tr>
                                          <th>Nama</th>
                                          <th>Product</th>
                                          <th>Topping</th>
                                          <th>No. HP</th>
                                          <th>Alamat</th>
                                          <th>Tgl Pesanan</th>
                                          <th>Tgl Pengiriman</th>
                                          <th>Kuantitas</th>
                                          <th>Total</th>
                                          <th>Kondisi</th>
                                    </tr>
                              </thead>
                              <tbody>
                              <?php while($pesan = mysqli_fetch_assoc($pesanan)): ?>
                                    <tr>
                                          <td><?= $pesan["username"]; ?></td>
                                          <td><?= $pesan["nama"]; ?></td>
                                          <td><?php print($pesan["topping"] != null) ? $pesan['topping'] : '-'; ?></td>
                                          <td><?= $pesan["no_hp"] ?></td>
                                          <td><?= $pesan["alamat"]; ?></td>
                                          <td><?= date('d F Y h:s:i A', strtotime($pesan["tgl_pesanan"])); ?></td>
                                          <td><?= date('d F Y h:s:i A', strtotime($pesan["tgl_pengiriman"])); ?></td>
                                          <td><?= $pesan["kuantitas"]; ?></td>
                                          <td><?= $total = $pesan["harga"] * $pesan["kuantitas"]; ?></td>
                                          <td class="kondisi-order">
                                                <?php if($pesan["status"] == 1){ ?>
                                                <p class="order-berhasil" title="Order sudah diterima pembeli">Succes</p>
                                                <?php } ?>

                                                <?php if($pesan["status"] == 0) { ?>
                                                <a href="../app/konfirmasi.php?id=<?= $pesan["id"]; ?>"
                                                onclick="return confirm('Apakah anda ingin mengkonfirmasi product ini?')"><p class="order-belum" title="Klik untuk konfirmasi">Konfirmasi</p></a>
                                                <?php } ?>
                                          </td>
                                          <!-- total harga -->
                                          <?php $totalHarga+=$total; ?>
                                          <!-- total harga end -->
                                    </tr>
                              <?php endwhile; ?>
                              <!-- echo total harga -->
                                    <tr>
                                          <td class="total-harga">Total</td>
                                          <td colspan="10" class="total-harga">Rp. <?= $totalHarga; ?> </td>
                                    </tr>
                              <!-- echo total harga end -->
                              </tbody>
                        </table>
                  </div>
            </div>
            <!-- table pesanan end -->
      </div>
</body>
<script src="../js/menuProfile.js"></script>
</html>