<?php
require "../functions.php";

$idPesanan = $_GET["id"];
$batal = mysqli_query($conn, "DELETE FROM pesanan WHERE id=$idPesanan");
if($batal > 0){
      echo  "<script>
                  alert('Pesanan berhasil dibatalkan');
                  window.location.href='redirectPesanan.php';
            </script>";
}else{
      echo mysqli_error($conn);
}
?>