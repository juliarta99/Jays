<?php
session_start();
require "../functions.php";

if(!isset($_SESSION["login"])){
      header("Location: login.php");
      exit;
}

// get id product
$idProduct = $_GET["id"];
// setalah klik tombol submit
if(isset($_POST["submit"])){
      if(komentar($_POST) > 0 ){
            echo  '<script>
                        alert("Komentar anda berhasil ditambahkan!!");
                  </script>';
      }else{
            mysqli_error($conn);
      }
}

$product = mysqli_query($conn, "SELECT * FROM product WHERE id = '$idProduct'");
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
      <title>Chechk Out</title>
      <link rel="stylesheet" href="../style.css">
</head>
<body>
      <!-- content start -->
      <div id="isi-product">
            <div class="left-pesan">
                  <div class="header-leftPesan">
                        <div class="kembali">
                              <a href="../product.php"><img src="../img/kembali.png" class="img-kembali" alt="Kembali"></a>
                        </div>
                        <?php while($isiProduct = mysqli_fetch_assoc($product)): ?>
                        <?php if($_SESSION['user']['level'] == 1){ ?>
                        <div class="kondisi-leftPesan">
                              <a href="editProduct.php?id=<?= $isiProduct["id"]; ?>">
                                    <img src="../img/ubah.png" class="edit-product" alt="edit">
                              </a>
                              <a href="../back/hapusProduct.php?id=<?= $isiProduct["id"]; ?>"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus product ini?')">
                                    <img src="../img/hapus.png" class="hapus-product" alt="hapus">
                              </a>
                        </div>
                        <?php } ?>
                  </div>
                  <div class="namaHarga-pesan">
                        <img src="../img/<?= $isiProduct["gambar"]; ?>" class="img-pesan" alt="Salad Buah">
                        <h3 class="nama-pesan"><?= $isiProduct["nama"]; ?></h3>
                        <h5 class="harga-pesan">Rp. <?=$isiProduct["harga"]; ?></h5>
                        <a href="pesan.php?id=<?= $idProduct; ?>" class="chechk-out">Checkout</a>
                  </div>
            </div>
            <div class="right-pesan">
                  <div class="deskripsi-pesan">
                        <p><?= $isiProduct["deskripsi"]; ?></p>
                  </div>
                  <?php endwhile; ?>
                  <form action="" class="form-komentar" method="post">
                        <div class="komentar">
                              <h1>Review</h1>
                              <div class="komentarnya">
                                    <?php $komentars = mysqli_query($conn, 
                                    "SELECT komentar.*, user.username, user.email, user.id FROM komentar 
                                    INNER JOIN user ON user.id=komentar.id_user
                                    WHERE id_product=$idProduct 
                                    ORDER BY komentar.id_komentar DESC");
                                    
                                    while($komen = mysqli_fetch_assoc($komentars)): ?>
                                    <div class="komen">
                                          <img src="//www.gravatar.com/avatar/<?php echo  md5(strtolower( trim( $komen["email"] ) ) ); ?>?s=48&d=monsterid" class="img-avatar" alt="avatar">
                                          <div class="content-komentar">
                                                <div class="nama-tanggal-komen">
                                                      <h5 class="nama-komentar"><?= $komen["username"]; ?></h5>
                                                      <p class="tanggal-komentar"><?= $komen["tgl_komentar"]; ?></p>
                                                </div>
                                                <div class="deskripsi-komentar">
                                                      <p class="isi-komentar"><?= $komen["isi_komentar"]; ?></p>
                                                      <?php if($_SESSION['user']['id'] == $komen["id"] ){ ?>
                                                      <a href="../back/hapusKomentar.php?id=<?= $komen["id_komentar"]; ?>"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus komentar ini?');">
                                                            <img src="../img/hapus.png" class="img-hapusKomentar" alt="Hapus">
                                                      </a>
                                                      <?php }; ?>
                                                </div>
                                          </div>
                                    </div>
                                    <?php endwhile; ?>
                              </div>
                        </div>
                        <div class="tulis-komentar">
                              <input type="text" name="komentar" id="komentar" required placeholder="semuanya enak banget">
                              <button name="submit" type="submit" id="kirim"><img src="../img/kirim.png" class="img-kirim" alt="Kirim"></button>
                        </div>
                  </form>
            </div>
      </div>
      <!-- content end -->
</body>
</html>