<?php
require_once('../../config/koneksi.php');
global $con;
header('Content-Type: application/json');
if ($_POST['action'] == 'tambah') {
    $name = htmlspecialchars($_POST['name']);
    if (empty($name)) {
        $response = array(
            'status' => 'error',
            'message' => 'Nama tidak boleh kosong'
        );
        echo json_encode($response);
        return false;
    }
    //   insert data using PDO
    $sql = "INSERT INTO categories (name) VALUES ('$name')";
    $query = $con->prepare($sql);
    $query->execute();
    if ($query) {
        $response = array(
            'status' => 'success',
            'message' => 'Berhasil menambahkan data',
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Gagal menambahkan data'
        );
        echo json_encode($response);
    }
} elseif ($_POST['action'] == 'edit') {
    $name = htmlspecialchars($_POST['name']);
    $id = htmlspecialchars($_POST['id']);
    if (empty($name)) {
        $response = array(
            'status' => 'error',
            'message' => 'Nama tidak boleh kosong'
        );
        echo json_encode($response);
    }
    $sql = "UPDATE categories SET nama = '$name' WHERE id = '$id'";
    $query = $con->prepare($sql);
    $query->execute();
    if ($query) {
        $response = array(
            'status' => 'success',
            'message' => 'Berhasil mengubah data',
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Gagal mengubah data'
        );
        echo json_encode($response);
    }
} elseif ($_POST['action'] == 'hapus') {
    $id = htmlspecialchars($_POST['id']);
    //   Delete data using PDO
    $sql = "DELETE FROM categories WHERE id = '$id'";
    $query = $con->prepare($sql);
    $query->execute();
    if ($query) {
        $response = array(
            'status' => 'success',
            'message' => 'Berhasil menghapus data',
            'url' =>  'index.php'
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Gagal menghapus data'
        );
        echo json_encode($response);
    }
}
