<?php
session_start();
require "functions.php";

if(!isset($_SESSION["login"])){
      header("Location: login.php");
      exit;
}

$idProduct = $_GET["id"];

if(isset($_POST["submit"])){
      if(pesan($_POST) > 0 ){
            echo  '<script>
                        alert("Pesanan berhasil dibuat!"); 
                        window.location.href="app/redirectPesanan.php";
                  </script>';
      }else{
           echo mysqli_error($conn);
      }
}

$namaProduct = mysqli_query($conn, "SELECT nama FROM product WHERE id = '$idProduct'");
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
      <!-- nama product start -->
      <?php while($nama = mysqli_fetch_assoc($namaProduct)): ?>
      <title>Pesan <?= $nama["nama"]; ?></title>
      <link rel="stylesheet" href="style.css">
</head>
<body>
      <div id="memesan">
            <form action="" class="form-pesan" method="post">
                  <h1>Pesan <?= $nama["nama"]; ?></h1>
                  <?php endwhile; ?>
                  <!-- nama product end -->

                  <label for="noHP" class="label-pesan">No Handphone:</label>
                  <input type="tel" name="noHP" id="noHP" class="input-pesan" required placeholder="+628********09">

                  <label for="alamat" class="label-pesan">Alamat:</label>
                  <input type="text" name="alamat" id="alamat" class="input-pesan" required placeholder="Jln.,Keluharan,Kabupaten">

                  <label for="kuantitas" class="label-pesan">Kuantitas</label>
                  <input type="number" name="kuantitas" id="kuantitas" class="input-pesan" required placeholder="1">

                  <label for="tgl_pengiriman" class="label-pesan">Tanggal Pengiriman</label>
                  <input type="datetime-local" name="tgl_pengiriman" id="tgl_pengiriman" class="input-pesan" required>
                  
                  <?php if($idProduct == 1) { ?>
                  <label for="topping" class="label-pesan">Topping</label>
                  <select name="topping" id="topping">
                        <option value="Cheese">Cheese</option>
                        <option value="Choco">Choco</option>
                        <option value="Choco & Cheese">Choco & Cheese</option>
                        <option value="Cheese & Fruit">Cheese & Fruit</option>
                  </select>
                  <?php } ?>
                  <div class="kondisi">
                        <a href="product.php" name="batal" id="batal"
                              onclick="return confirm('Apakah anda yakin ingin membatalkan orderan ini?')";>Batal</a>
                        <button name="submit" type="submit" id="pesan">Pesan</button>
                  </div>
            </form>
      </div>
</body>
</html>