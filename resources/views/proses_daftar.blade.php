<?php
include 'koneksi.blade.php';

if(isset($_POST['daftar'])){

  $nama_user = $_POST['nama_user'];
  $email     = $_POST['email'];
  $password  = md5 ($_POST['password']);

  $cek = mysqli_query($koneksi, "SELECT email FROM daftar_user WHERE email='$email'");

  if(mysqli_num_rows($cek) > 0){
  echo "Email sudah terdaftar pada akun lain.";
  exit;
  }

  $sql = mysqli_query($koneksi, "INSERT INTO daftar_user (nama_user, email, `password`) VALUES ('$nama_user, '$email', '$password')");
  if($sql){
    echo "Berhasil Login";
    exit;
  } else {
    echo "<script> alert('Terjadi Kesalahan Saat Menyimpan Data!'); history.back();
    </script>";
  }
  
}
?>