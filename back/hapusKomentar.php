<?php 
require "../functions.php";

$idKomentar = $_GET["id"];
$hapus = mysqli_query($conn, "DELETE FROM komentar WHERE id_komentar=$idKomentar");
if($hapus > 0 ){
      echo  '<script>
                  alert("Komentar berhasil dihapus!!");
                  window.location.href="../product.php";
            </script>';
}else{
      echo mysqli_error($conn);
}
?>