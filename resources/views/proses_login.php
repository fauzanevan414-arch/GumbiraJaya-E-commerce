<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gumbirajaya";

$koneksi = new mysqli($servername, $username, $password, $dbname);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$email = $_POST['email'];
$passwordakun = $_POST['password'];

$sql = "SELECT * FROM daftar_user WHERE email='$email' AND `password`='$passwordakun'";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    header("Location: ../indexsudahlog.php");
} else {
    echo "<script> alert('Email atau Password salah!'); history.back();
    </script>";
}

$koneksi->close();
