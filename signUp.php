<?php
require "functions.php";

if( isset($_POST["submit"])){
      if(signUp($_POST) > 0){
            echo  '<script>
                        alert("User berhasil dibuat!!");
                        window.location.href="login.php";
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
      <title>Sign Up</title>
      <link rel="stylesheet" href="style.css">
</head>
<body>
      <div id="sign-up">
            <form action="" method="post" class="form-login">
                  <h1>SIGN UP</h1>
                  <div class="underline-login"></div>
                  <input type="text" name="username" id="username" class="input-login" placeholder="Username"required>
                  <input type="password" name="password" id="password" class="input-login" placeholder="Password" required>
                  <input type="password" name="password2" id="password2" class="input-login" placeholder="Konfirmasi password" required>
                  <button name="submit" id="submit" type="submit">SIGN UP</button>
                  <a href="login.php" class="sign-in">Sudah punya akun?</a>
            </form>
            <img src="img/backgroundMojito.png" class="img-login" alt="background">
      </div>
</body>
</html>