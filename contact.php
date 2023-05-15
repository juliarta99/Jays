<?php
session_start();
require "functions.php";

if(!isset($_SESSION["login"])){
      header("Location: login.php");
      exit;
}

if(isset($_POST["submit"])) {
      if(contact($_POST) > 0){
            echo  '<script>
                        alert("Pesan berhasil terkirim\nSilahkan tunggu balasannya pada email anda!!");      
                  </script>';
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
      <title>Contact</title>
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
      <div id="contact">
            <form action="" method="post" class="form-contact">
                  <h1>Contact Me</h1>
                  <label for="email" class="label-contact">Email:</label>
                  <input type="email" name="email" id="email" class="input-contact" placeholder="Email" required>

                  <label for="pesan-contact" class="label-contact">Pesan:</label>
                  <textarea name="pesan" id="pesan-contact" cols="30" rows="10" class="input-contact" placeholder="Masukkan pesan anda disini..." required></textarea>
                  <button name="submit" type="submit" id="pesan">Kirim</button>
            </form>
            <ul class="sosmed">
                  <li class="social_content" title="Youtube">
                        <a href="https://youtube.com/channel/UCsgZ6lKleRwgFRJsu3DghNw">
                              <img src="img/youtube.png" class="img_social" alt="youtube">
                        </a>
                  </li>
                  <li class="social_content" title="TikTok">
                        <a href="https://www.tiktok.com/@badaigamer09?_t=8VrdRlvjbiz&_r=1">
                              <img src="img/tiktok.png" class="img_social" alt="tik-tok">
                        </a>
                  </li>
                  <li class="social_content" title="Instagram">
                        <a href="https://instagram.com/n.juliarta?igshid=YmMyMTA2M2Y=">
                              <img src="img/instagram.png" class="img_social" alt="instagram">
                        </a>
                  </li>
                  <li class="social_content" title="Whatsapp">
                        <a href="https://api.whatsapp.com/send?phone=+6289605880609&text=Kak%20saya%20mau%20pesan%20Salad%20Buah">
                              <img src="img/whatsapp.png" class="img_social" alt="whatsapp">
                        </a>
                  </li>
            </ul>
      </div>
      <!-- content End -->
</body>
<script src="js/menuProfile.js"></script>
</html>