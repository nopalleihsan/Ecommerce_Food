<?php
require_once('../../config/koneksi.php');
global $con;
header('Content-Type: application/json');
if ($_POST['action'] == 'tambah') {
    $name = htmlspecialchars($_POST['name']);
    $price = htmlspecialchars($_POST['price']);
    $stock = htmlspecialchars($_POST['stock']);
    $description = htmlspecialchars($_POST['description']);
    $category_id = htmlspecialchars($_POST['category_id']);
    $image = $_FILES['image']['name'];
    if (empty($name)) {
        $response = array(
            'status' => 'error',
            'message' => 'Nama tidak boleh kosong'
        );
        echo json_encode($response);
        return false;
    }
    if (empty($price)) {
        $response = array(
            'status' => 'error',
            'message' => 'Harga tidak boleh kosong'
        );
        echo json_encode($response);
        return false;
    }
    if (empty($stock)) {
        $response = array(
            'status' => 'error',
            'message' => 'Stok tidak boleh kosong'
        );
        echo json_encode($response);
        return false;
    }
    if (empty($description)) {
        $response = array(
            'status' => 'error',
            'message' => 'Deskripsi tidak boleh kosong'
        );
        echo json_encode($response);
        return false;
    }
    if (empty($category_id)) {
        $response = array(
            'status' => 'error',
            'message' => 'Kategori tidak boleh kosong'
        );
        echo json_encode($response);
        return false;
    }
    if (empty($image)) {
        $response = array(
            'status' => 'error',
            'message' => 'Gambar tidak boleh kosong'
        );
        echo json_encode($response);
        return false;
    }
    $ekstensi_diperbolehkan    = array('png', 'jpg');
    $x = explode('.', $image);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['image']['tmp_name'];
    $angka_acak     = rand(1, 999);
    $nama_gambar_baru = $angka_acak . '-' . $image;
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, '../../public/images/products/' . $nama_gambar_baru);
        $sql = "INSERT INTO products (name, price, stock, description, category_id, image) VALUES ('$name', '$price', '$stock', '$description', '$category_id', '$nama_gambar_baru')";
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
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ekstensi gambar yang boleh hanya jpg atau png'
        );
        echo json_encode($response);
    }
} elseif ($_POST['action'] == 'edit') {
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $price = htmlspecialchars($_POST['price']);
    $stock = htmlspecialchars($_POST['stock']);
    $description = htmlspecialchars($_POST['description']);
    $category_id = htmlspecialchars($_POST['category_id']);
    $image = $_FILES['image']['name'];
    if (empty($name)) {
        $response = array(
            'status' => 'error',
            'message' => 'Nama tidak boleh kosong'
        );
        echo json_encode($response);
        return false;
    }
    if (empty($price)) {
        $response = array(
            'status' => 'error',
            'message' => 'Harga tidak boleh kosong'
        );
        echo json_encode($response);
        return false;
    }
    if (empty($stock)) {
        $response = array(
            'status' => 'error',
            'message' => 'Stok tidak boleh kosong'
        );
        echo json_encode($response);
        return false;
    }
    if (empty($description)) {
        $response = array(
            'status' => 'error',
            'message' => 'Deskripsi tidak boleh kosong'
        );
        echo json_encode($response);
        return false;
    }
    if (empty($category_id)) {
        $response = array(
            'status' => 'error',
            'message' => 'Kategori tidak boleh kosong'
        );
        echo json_encode($response);
        return false;
    }
    if (!empty($image)) {

        $ekstensi_diperbolehkan    = array('png', 'jpg');
        $x = explode('.', $image);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['image']['tmp_name'];
        $angka_acak     = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $image;
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../../public/images/products/' . $nama_gambar_baru);
            $sql = "UPDATE products SET name = '$name', price = '$price', stock = '$stock', description = '$description', category_id = '$category_id', image = '$nama_gambar_baru' WHERE id = '$id'";
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
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Ekstensi gambar yang boleh hanya jpg atau png'
            );
            echo json_encode($response);
        }
    } else {
        $sql = "UPDATE products SET name = '$name', price = '$price', stock = '$stock', description = '$description', category_id = '$category_id' WHERE id = '$id'";
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
    }
} elseif ($_POST['action'] == 'hapus') {
    $id = htmlspecialchars($_POST['id']);
    //   Delete data using PDO
    $sql = "DELETE FROM products WHERE id = '$id'";
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
