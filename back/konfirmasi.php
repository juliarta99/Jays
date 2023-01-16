<?php 
session_start();
require "../functions.php";

if($_SESSION['user']['level'] == 0){
      header('Location: ../index.php');
}

$idPesanan = $_GET["id"];
$konfirmasi = mysqli_query($conn, "UPDATE pesanan SET
                                    kondisi=1
                                    WHERE id=$idPesanan");

if($konfirmasi > 0){
      echo  "<script>
                  alert('Pesanan berhasil dikonfirmasi!!'); 
                  window.location.href='../konfirmasiOrder.php';
            </script>";
}else{
      echo mysqli_error($conn);
}
?>