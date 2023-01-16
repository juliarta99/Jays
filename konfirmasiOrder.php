<?php
session_start();
require "functions.php";

if(!isset($_SESSION["login"]) ) {
      header("Location: app/login.php");
      exit;
}

if($_SESSION['user']['level'] == 0){
      header('Location: index.php');
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

      <div id="konfirmasi">
            <h1 class="title-konfirmasi">Orders</h1>
            <!-- form pencarian -->
            <form method="post" class="form-konfirmasi">
                  <input type="text" name="keyword" id="keyword" placeholder="Lakukan pencarian disini...." required>
                  <button type="submit" class="cari" name="cari">
                        <img src="img/search.png" class="img-cari" alt="Cari">
                  </button>
            </form>
            <!-- form pencarian end -->

            <!-- jumlah produk dibeli start -->
            <table class="jumlah-produk-dibeli">
                  <tr>
                        <?php $saladBuah = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_product=1"); 
                        while($salad = mysqli_fetch_assoc($saladBuah)):
                              $totalSalad+=$salad["kuantitas"];
                        endwhile;?>
                        <th class="table-salad">Salad Buah : <?= $totalSalad; ?></th>

                        <?php $virginSquash = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_product=2");
                        while($virgin = mysqli_fetch_assoc($virginSquash)):
                              $totalVirgin+=$virgin["kuantitas"]; 
                        endwhile;?>
                        <th class="table-virgin">Virgin Squash : <?= $totalVirgin; ?></th>

                        <?php $redcoco = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_product=3"); 
                        while($red = mysqli_fetch_assoc($redcoco)):
                              $totalRedcoco+=$red["kuantitas"];
                        endwhile;?>
                        <th class="table-redcoco">Redcoco : <?= $totalRedcoco; ?></th>

                        <?php $orangeSquash = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_product=4");
                        while($orange = mysqli_fetch_assoc($orangeSquash)):
                              $totalOrange+=$orange["kuantitas"]; 
                        endwhile;?>
                        <th class="table-orange">Orange Squash : <?= $totalOrange; ?></th>
                  </tr>
            </table>
            <!-- jumlah produk dibeli end -->

            <!-- table pesanan start -->
            <div class="table">
                  <div class="tablenya">
                        <table>
                              <thead>
                                    <tr>
                                          <th>id</th>
                                          <th>Nama</th>
                                          <th>Product</th>
                                          <th>Topping</th>
                                          <th>No. HP</th>
                                          <th>Alamat</th>
                                          <th>Kelas</th>
                                          <th>Tanggal</th>
                                          <th>Kuantitas</th>
                                          <th>Total</th>
                                          <th>Kondisi</th>
                                    </tr>
                              </thead>
                              <tbody>
                              <?php while($pesan = mysqli_fetch_assoc($pesanan)): ?>
                                    <tr>
                                          <td><?= $pesan["id"]; ?></td>
                                          <td><?= $pesan["username"]; ?></td>
                                          <td><?= $pesan["nama"]; ?></td>
                                          <td><?= $pesan["topping"]; ?></td>
                                          <td><?= $pesan["no_hp"] ?></td>
                                          <td><?= $pesan["alamat"]; ?></td>
                                          <td><?= $pesan["kelas"]; ?></td>
                                          <td><?= $pesan["tgl_pesanan"]; ?></td>
                                          <td><?= $pesan["kuantitas"]; ?></td>
                                          <td><?= $total = $pesan["harga"] * $pesan["kuantitas"]; ?></td>
                                          <td class="kondisi-order">
                                                <?php if($pesan["kondisi"] == 1){ ?>
                                                <p class="order-berhasil" title="Order sudah diterima pembeli">Succes</p>
                                                <?php } ?>

                                                <?php if($pesan["kondisi"] == 0) { ?>
                                                <a href="back/konfirmasi.php?id=<?= $pesan["id"]; ?>"
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

            <!-- form keuntungan -->
            <button class="tampil-form-laba">Lihat biaya produksi dan keuntungan</button>
            <div class="keuntungan">
                  <form method="POST" class="form-laba">
                  <?php 
                  $hargaProduksi = mysqli_query($conn, "SELECT * FROM harga_produksi");
                  while ($hProduksi = mysqli_fetch_assoc($hargaProduksi)) :
                  ?>
                        <label for="<?= $hProduksi["name"]; ?>" class="label-laba"><?= $hProduksi["produk"]; ?></label>
                        <input type="number" class="input-laba" name="<?= $nameHarga = $hProduksi["name"]; ?>" id="<?= $hProduksi["name"]; ?>" value="<?= $hargaProduk = $hProduksi["harga"]; ?>">
                        <?php $totalProduksi+=$hargaProduk; ?>
                        <?php
                        if(isset($_POST["submit"])){
                              $hargaP = $_POST["$nameHarga"];
                              $idP = $hProduksi["id"];

                              mysqli_query($conn, "UPDATE harga_produksi SET
                                                harga=$hargaP
                                                WHERE id=$idP");
                              if(($_POST) > 0 ){
                                    echo  "<script>
                                                alert('Harga berhasil diubah!');
                                                window.location.href='konfirmasiOrder.php';
                                          </script>";
                              }else{
                                    echo mysqli_error($conn);
                              }
                        }
                        ?>
                  <?php endwhile; ?>
                  <button type="submit" class="hitung-total-produksi" name="submit">Ubah harga</button>
                  </form>
                  <table class="table-laba">
                        <tr>
                              <th class="total-produksi">Total Harga Produksi : </th>
                              <td>Rp <?= $totalProduksi;?></td>
                        </tr>
                        <tr>
                              <th class="laba">Laba :</th>
                              <td class="laba">Rp <?= $laba = $totalHarga - $totalProduksi; ?> 
                                    <i class="persentase-laba"><?= $persentase = $laba/$totalProduksi*100; ?>%</i>
                              </td>
                        </tr>
                  </table>
            </div>
            <!-- form keuntungan end -->
      </div>
</body>
<script src="js/keuntungan.js"></script>
<script src="js/menuProfile.js"></script>
</html>