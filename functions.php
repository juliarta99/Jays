<?php
// konenksi ke database
$conn = mysqli_connect("localhost", "root", "", "jays");

// signUp
function signUp($data){
      global $conn;

      // deklarasi variabel
      $username = stripslashes($data["username"]);
      $password = mysqli_real_escape_string($conn, $data["password"]);
      $password2 = mysqli_real_escape_string($conn, $data["password2"]);

      // cek konfirmasi password
      if($password !== $password2){
            echo  "<script>
                        alert('Konfirmasi password yang anda masukkan tidak sesuai');
                  </script>";

            return false;
      }

      // cek apakah username sudah terdaftar
      $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
      if(mysqli_fetch_assoc($query)){
            echo  "<script>
                        alert('Username yang anda masukkan sudah ada!!');
                  </script>";

            return false;
      }

      // enkripsi password
      $password = password_hash($password, PASSWORD_DEFAULT);

      // lalukan insert data
      mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password', '$username@example.com', '')");

      return mysqli_affected_rows($conn);
}

function komentar($komentar){
      global $conn;

      $idProduct = $_GET["id"];
      $komentar = $komentar["komentar"];
      $tglKomentar = date("y-m-d");
      $idUser = $_SESSION['user']['id'];
      // lalukan insert data
      mysqli_query($conn, "INSERT INTO komentar VALUES('', '$idUser', '$idProduct', '$komentar', '$tglKomentar')");

      return mysqli_affected_rows($conn);
}

function pesan($order){
      global $conn;

      $idProduct = $_GET["id"];
      $idUser = $_SESSION['user']['id'];
      $topping = $order["topping"];
      $tgl_pengiriman = $order["tgl_pengiriman"];
      $noHP = $order["noHP"];
      $alamat = $order["alamat"];
      $kuantitas = $order["kuantitas"];

      mysqli_query($conn, "INSERT INTO pesanan(id_user, id_product, topping, tgl_pengiriman, no_hp, alamat, kuantitas) VALUES('$idUser', '$idProduct', '$topping', '$tgl_pengiriman', '$noHP', '$alamat', '$kuantitas')");

      return mysqli_affected_rows($conn);
}

function contact($contact){
      global $conn;

      $email = $contact["email"];
      $pesan = $contact["pesan"];

      mysqli_query($conn, "INSERT INTO contact 
      VALUES('', '$email', '$pesan')");

      return mysqli_affected_rows($conn);
}

function upload(){
      $namaFile = $_FILES['gambar']['name'];
      $ukuranFile = $_FILES['gambar']['size'];
      $tmpName = $_FILES['gambar']['tmp_name'];

      // cek ekstensi file
      $ektensiGambarValid = array('jpg', 'jpeg', 'png', 'webp');
      $ekstensiGambar = explode('.', $namaFile);
      $ekstensiGambar = strtolower(end($ekstensiGambar));
      if( !in_array($ekstensiGambar, $ektensiGambarValid)) {
            echo "<script>
                        alert('Ekstensi gambar salah Ektensi gambar = png');
                  </script>";
            return false;
      }

      // cek ukuran file
      if($ukuranFile > 1000000){
            echo  "<script>
                        alert('Ukuran file terlalu besar!! Ukuran max 1 MB');
                  </script>";
            return false;
      }
      
      // ubah naama file ke nama random
      $namaFileBaru = uniqid();
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensiGambar;
      move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

      return $namaFileBaru;
}

function tambah($tambah){
      global $conn;

      $nama = $tambah["nama"];
      $harga = $tambah["harga"];
      $deskripsi = $tambah["deskripsi"];

      $gambar = upload();
      if(!$gambar){
            return false;
      }

      // query update product
      mysqli_query($conn, "INSERT INTO product 
      VALUES('', '$nama', '$harga', '$gambar', '$deskripsi')");
      
      return mysqli_affected_rows($conn);
}

function edit($edit){
      global $conn;

      $idProduct = $_GET["id"];
      $nama = $edit["nama"];
      $harga = $edit["harga"];
      $deskripsi = $edit["deskripsi"];
      $gambarLama = $edit["gambarLama"];

      if($_FILES['gambar']['error'] === 4){
            // jika tidak ada foto yang diupload
            mysqli_query($conn, "UPDATE product SET
                        id='$idProduct',
                        nama='$nama',
                        harga='$harga',
                        deskripsi='$deskripsi'
                        WHERE id=$idProduct");
      }else{
            $gambar = upload();
            unlink('../img/'.$gambarLama);
            // jika ada foto yang diupload
            mysqli_query($conn, "UPDATE product SET
                        id='$idProduct',
                        nama='$nama',
                        harga='$harga',
                        gambar='$gambar',
                        deskripsi='$deskripsi'
                        WHERE id=$idProduct");
      }
      
      return mysqli_affected_rows($conn);
}

function cari($keyword){
      global $conn;
      $query = "SELECT pesanan.*, user.username, product.nama, product.harga FROM pesanan
                        INNER JOIN user ON user.id=pesanan.id_user
                        INNER JOIN product ON product.id=pesanan.id_product
                        WHERE product.id LIKE '%$keyword%' OR
                        user.username LIKE '%$keyword%' OR
                        product.nama LIKE '%$keyword%' OR
                        no_hp LIKE '%$keyword%' OR
                        alamat LIKE '%$keyword%' OR
                        tgl_pesanan LIKE '%$keyword%' OR
                        kuantitas LIKE '%$keyword%' OR
                        kondisi LIKE '%$keyword%'";
      
      return mysqli_query($conn, "$query");
}
?>