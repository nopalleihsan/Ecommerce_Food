<?php
require_once('config/koneksi.php');
header('Content-Type: application/json');
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$postal_code = htmlspecialchars($_POST['postal_code']);
$address = htmlspecialchars($_POST['address']);
if (empty($name)) {
    $response = array(
        'status' => 'error',
        'message' => 'Nama tidak boleh kosong'
    );
    echo json_encode($response);
    return false;
}
if (empty($email)) {
    $response = array(
        'status' => 'error',
        'message' => 'Email tidak boleh kosong'
    );
    echo json_encode($response);
    return false;
}
if (empty($phone)) {
    $response = array(
        'status' => 'error',
        'message' => 'Nomor telepon tidak boleh kosong'
    );
    echo json_encode($response);
    return false;
}
if (empty($postal_code)) {
    $response = array(
        'status' => 'error',
        'message' => 'Kode pos tidak boleh kosong'
    );
    echo json_encode($response);
    return false;
}
if (empty($address)) {
    $response = array(
        'status' => 'error',
        'message' => 'Alamat tidak boleh kosong'
    );
    echo json_encode($response);
    return false;
}
// get data from carts
$sql = "SELECT * FROM carts";
$query = $con->prepare($sql);
$query->execute();
$carts = $query->fetchAll(PDO::FETCH_ASSOC);
if (empty($carts)) {
    $response = array(
        'status' => 'error',
        'message' => 'Keranjang tidak boleh kosong'
    );
    echo json_encode($response);
    return false;
}
// insert data using PDO
$total = 0;
foreach ($carts as $cart) {
    $product_id = $cart['product_id'];
    $quantity = $cart['quantity'];
    $sql = "SELECT * FROM products WHERE id = '$product_id'";
    $query = $con->prepare($sql);
    $query->execute();
    $product = $query->fetch(PDO::FETCH_ASSOC);
    $total += $product['price'] * $quantity;
}
$sql = "INSERT INTO orders (name, email, phone, postal_code, address, total) VALUES ('$name', '$email', '$phone', '$postal_code', '$address', '$total')";
$query = $con->prepare($sql);
$query->execute();
if ($query) {
    $order_id = $con->lastInsertId();
    foreach ($carts as $cart) {
        $product_id = $cart['product_id'];
        $quantity = $cart['quantity'];
        $sql = "SELECT * FROM products WHERE id = '$product_id'";
        $query = $con->prepare($sql);
        $query->execute();
        $product = $query->fetch(PDO::FETCH_ASSOC);
        $total = $product['price'] * $quantity;
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, total) VALUES ('$order_id', '$product_id', '$quantity', '$total')";
        $query = $con->prepare($sql);
        $query->execute();
        $sql = "UPDATE products SET stock = stock - '$quantity' WHERE id = '$product_id'";
        $query = $con->prepare($sql);
        $query->execute();
    }
    $sql = "DELETE FROM carts";
    $query = $con->prepare($sql);
    $query->execute();
    $response = array(
        'status' => 'success',
        'message' => 'Pesanan berhasil ditambahkan',
        'id' => $order_id,
    );
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Pesanan gagal ditambahkan'
    );
    echo json_encode($response);
}
