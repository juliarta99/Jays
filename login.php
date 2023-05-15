<?php
session_start();
if( isset($_SESSION["login"])) {
      header("Location: index.php");
      exit;
}

require "functions.php";
if(isset($_POST["login"])){
      $username = $_POST["username"];
      $password = $_POST["password"];

      // cek username
      $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

      if(mysqli_num_rows($query) === 1) {

            // cek password
            $row = mysqli_fetch_assoc($query);
            if(password_verify($password, $row["password"])){
                  // set session
                  $_SESSION["login"] = true;
                  $_SESSION['user'] = array(
                        'id' => $row["id"],
                        'username' => $row["username"],
                        'email' => $row["email"],
                        'level' => $row["level"],
                  );

                  if($_SESSION['user']['level'] == 0) {
                        header("Location: index.php");
                        exit;
                  } elseif($_SESSION['user']['level'] == 1) {
                        header("Location: dashboard/index.php");
                        exit;
                  }

            }
      }
      $error = true;
}

if( isset($error)):
      echo  "<script>
                  alert('USERNAME ATAU PASSWORD SALAH!');
            </script>";
endif;
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
      <title>Sign In</title>
      <link rel="stylesheet" href="style.css">
</head>
<body>
      <div id="login">
            <img src="img/backgroundMojito.png" class="img-login" alt="background">
            <form action="" method="post" class="form-login">
                  <h1>LOGIN</h1>
                  <div class="underline-login"></div>
                  <input type="text" name="username" id="username" class="input-login" placeholder="Username"required>
                  <input type="password" name="password" id="password" class="input-login" placeholder="Password" required>
                  <button name="login" id="submit" type="submit">SIGN IN</button>
                  <a href="signUp.php" class="sign-up">Belum punya akun?</a>
            </form>
      </div>
</body>
</html>