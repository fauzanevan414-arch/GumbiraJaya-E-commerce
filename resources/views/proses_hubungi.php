<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gumbirajaya";

$koneksi = new mysqli($servername, $username, $password, $dbname);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$nama = $_POST['nama'];
$email = $_POST['email'];
$pesan = $_POST['pesan'];

if (empty($nama)) {
    echo "<script> alert('Nama tidak boleh kosong, harap isi semua dengan benar.'); history.back();</script>";
} elseif (empty($email)) {
    echo "<script> alert('Email tidak boleh kosong, harap isi semua dengan benar.'); history.back();</script>";
} elseif (empty($pesan)) {
    echo "<script> alert('Pesan tidak boleh kosong, tulis saran atau kritikmu ya.'); history.back();</script>";
} elseif (empty($nama) || empty($email) || empty($pesan)) {
    echo "<script> alert('Harap lengkapi Nama, Email, dan Pesan sebelum mengirim.'); history.back();</script>";
}

$sql = "INSERT INTO pesan_user (nama,email,pesan) VALUES ('$nama','$email','$pesan')";

if ($koneksi->query($sql) === TRUE) {
    echo "<script> alert('Pesan Berhasil Dikirim!'); history.back() </script>";
} else {
    echo "<script> alert('Terjadi Kesalahan Saat Menyimpan Data!'); history.back();
    </script>";
}

$koneksi->close();
