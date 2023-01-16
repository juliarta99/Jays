<?php
session_start();
require "../functions.php";

if($_SESSION['user']['level'] == 0){
      header('Location: ../index.php');
}

$idProduct = $_GET["id"];
mysqli_query($conn, "DELETE FROM komentar WHERE id_product=$idProduct");
$hapus = mysqli_query($conn, "DELETE FROM product WHERE id=$idProduct");

if($hapus > 0){
      echo  "<script>
                  alert('Product berhasil dihapus!!');
            </script>";
}else{
      echo mysqli_error($conn);
}
?>