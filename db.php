
<?php
$host = "localhost";
$user = "root";
$pass = ""; // Ganti jika password MySQL Anda tidak kosong
$db   = "siap";

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
