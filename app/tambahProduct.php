<?php
session_start();
require "../functions.php";

if($_SESSION['user']['level'] == 0){
      header('Location: ../index.php');
}

if(isset($_POST["submit"])) {
      if(tambah($_POST) > 0){
            echo  "<script>
                        alert('Product berhasil diubah!!');
                        window.location.href='../product.php';
                  </script>";
      }else{
            echo mysqli_error($conn);
      }
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
      <title>Edit Product</title>
      <link rel="stylesheet" href="../style.css">
</head>
<body class="tambahEditProduct">
      <form method="POST" class="form-edit" enctype="multipart/form-data">
            <label for="nama" class="label-edit">Nama :</label>
            <input type="text" name="nama" class="input-edit" id="nama" placeholder="Masukkan nama product" required>

            <label for="harga" class="label-edit">Harga :</label>
            <input type="number" name="harga" class="input-edit" id="harga" placeholder="Masukkan harga product" required>

            <label for="gambar" class="label-edit">Gambar:</label>
            <input type="file" name="gambar" class="input-edit" id="gambar" required>

            <label for="deskripsi" class="label-edit">Deskripsi :</label>
            <textarea name="deskripsi" class="input-edit" id="deskripsi" placeholder="Silahkan deskripsikan productmu" cols="30" rows="10" required></textarea>

            <div class="kondisi-edit">
                  <a href="../product.php" class="batal-product">Batal</a>
                  <button type="submit" class="submit-product" name="submit">Ubah</button>
            </div>
      </form>
</body>
</html>