<?php
$host    = "localhost";
$user    = "muha22302si";
$pass    = "21540110122302";
$db    = "db_muha22302si";
$con = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
try {
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Koneksi Gagal: " . $e->getMessage();
}
date_default_timezone_set('Asia/Jakarta');