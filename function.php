<?php
require_once('config/koneksi.php');
header('Content-Type: application/json');
$nama_pemesan = htmlspecialchars($_POST['nama_pemesan']);
$alamat_pemesan = htmlspecialchars($_POST['alamat_pemesan']);
$nama_produk = htmlspecialchars($_POST['nama_produk']);
$quantity = htmlspecialchars($_POST['quantity']);
$total_harga = htmlspecialchars($_POST['total_harga']);
if (empty($nama_pemesan)) {
    $response = array(
        'status' => 'error',
        'message' => 'Nama tidak boleh kosong'
    );
    echo json_encode($response);
    return false;
}
if (empty($alamat_pemesan)) {
    $response = array(
        'status' => 'error',
        'message' => 'Alamat tidak boleh kosong'
    );
    echo json_encode($response);
    return false;
}

if (empty($quantity)) {
    $response = array(
        'status' => 'error',
        'message' => 'Jumlah tidak boleh kosong'
    );
    echo json_encode($response);
    return false;
}

//   insert data using PDO
$tanggal = date('Y-m-d');
$sql = "INSERT INTO pesanan (nama_pemesan, alamat_pemesan, nama_produk, quantity, total_harga, tanggal) VALUES ('$nama_pemesan', '$alamat_pemesan', '$nama_produk', '$quantity', '$total_harga', '$tanggal')";
$query = $con->prepare($sql);
$query->execute();
if ($query) {
    $response = array(
        'status' => 'success',
        'message' => 'Pesanan berhasil ditambahkan',
        'id' => $con->lastInsertId(),
    );
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Pesanan gagal ditambahkan'
    );
    echo json_encode($response);
}
