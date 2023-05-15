<?php
session_start();
require "functions.php";

if(!isset($_SESSION["login"]) ) {
      header("Location: login.php");
      exit;
}

$userId = $_GET["id"];
$vouchers = mysqli_query($conn, 
            "SELECT pesanan.*, product.harga, product.nama, product.gambar FROM pesanan 
            INNER JOIN product ON product.id=pesanan.id_product 
            WHERE id_user=$userId
            ORDER BY id DESC");
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
      <title>Pesanan</title>
      <link rel="stylesheet" href="style.css">
</head>
<body>
      <div id="pesanan">
            <a href="index.php"><img src="img/kembali.png" class="img-kembali" alt="Kembali"></a>
            <?php while($voucher = mysqli_fetch_assoc($vouchers)): ?>
            <div class="voucher">
                  <div class="content-voucher">
                        <div class="back-voucher"></div>
                        <div class="isi-voucher">
                              <p class="tgl-voucher"><?= $voucher["tgl_pesanan"]; ?></p>
                              <h2 class="nama-voucher"><?= $voucher["nama"]; ?></h2>
                              <p class="kuantitas-voucher">Jumlah : <?= $voucher["kuantitas"]; ?></p>
                              <h1 class="harga-voucher">Rp. <?= $voucher["harga"] * $voucher["kuantitas"]; ?></h1>
                        </div>
                        <a href="back/batalPesanan.php?id=<?php echo $voucher["id"]; ?>" class="batal-pesanan"
                              onclick="return confirm('Apakah anda yakin ingin membatalkan pesanan ini')">
                              <img src="img/hapus.png" class="img-batalPesanan" alt="batal">
                        </a>
                        <?php if($voucher["status"] == 1) { ?>
                        <img src="img/success.png" class="succes" alt="Succes">
                        <?php } ?>
                  </div>
                  <img src="img/<?= $voucher["gambar"]; ?>" class="img-voucher" alt="Gambar Voucher">
            </div>
            <?php endwhile; ?>
      </div>
</body>
</html>