<?php
require_once('config/koneksi.php');
header('Content-Type: application/json');
// add to cart
$product_id = htmlspecialchars($_POST['product_id']);
$quantity = htmlspecialchars($_POST['quantity']);
if (empty($product_id)) {
    $response = array(
        'status' => 'error',
        'message' => 'Product tidak boleh kosong'
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
// check product
$sql = "SELECT * FROM products WHERE id = '$product_id'";
$query = $con->prepare($sql);
$query->execute();
$product = $query->fetch(PDO::FETCH_ASSOC);
if (empty($product)) {
    $response = array(
        'status' => 'error',
        'message' => 'Product tidak ditemukan'
    );
    echo json_encode($response);
    return false;
}
// check stock
if ($quantity > $product['stock']) {
    $response = array(
        'status' => 'error',
        'message' => 'Stock tidak mencukupi'
    );
    echo json_encode($response);
    return false;
}
// check cart
$sql = "SELECT * FROM carts WHERE product_id = '$product_id'";
$query = $con->prepare($sql);
$query->execute();
$cart = $query->fetch(PDO::FETCH_ASSOC);
if (empty($cart)) {
    // insert data using PDO
    $sql = "INSERT INTO carts (product_id, quantity) VALUES ('$product_id', '$quantity')";
    $query = $con->prepare($sql);
    $query->execute();
    if ($query) {
        $response = array(
            'status' => 'success',
            'message' => 'Product berhasil ditambahkan ke keranjang',
            'id' => $con->lastInsertId(),
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Product gagal ditambahkan ke keranjang'
        );
        echo json_encode($response);
    }
} else {
    // update data using PDO
    $quantity = $cart['quantity'] + $quantity;
    $sql = "UPDATE carts SET quantity = '$quantity' WHERE product_id = '$product_id'";
    $query = $con->prepare($sql);
    $query->execute();
    if ($query) {
        $response = array(
            'status' => 'success',
            'message' => 'Product berhasil ditambahkan ke keranjang',
            'id' => $con->lastInsertId(),
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Product gagal ditambahkan ke keranjang'
        );
        echo json_encode($response);
    }
}
