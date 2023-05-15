<?php
require_once('../../config/koneksi.php');
$id = $_GET['id'];
$sql = "SELECT * FROM orders WHERE id = '$id'";
$query = $con->prepare($sql);
$query->execute();
$order = $query->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce | Detail Pesanan</title>
    <link rel="icon" type="image/x-icon" href="../../public/backend/img/favicon.png" />
    <?php
    require_once('../include/head.php');
    ?>

</head>

<body>
    <?php
    require_once('../include/header.php');
    require_once('../include/sidebar.php');
    ?>
    <div id="layoutSidenav_content">
        <main>
            <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                <div class="container-xl px-4">
                    <div class="page-header-content pt-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mt-4">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon">
                                        <i data-feather="shopping-cart"></i>
                                    </div>
                                    Pesanan
                                </h1>
                                <div class="page-header-subtitle">Pesanan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-xl px-4 mt-n10">
                <div class="card mb-4">
                    <div class="card-header">List Pesanan</div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th width="200">Nama</th>
                                <td width="10">:</td>
                                <td><?= $order['name'] ?></td>
                            </tr>
                            <tr>
                                <th width="200">Email</th>
                                <td width="10">:</td>
                                <td><?= $order['email'] ?></td>
                            </tr>
                            <tr>
                                <th width="200">No. Telepon</th>
                                <td width="10">:</td>
                                <td><?= $order['phone'] ?></td>
                            </tr>
                            <tr>
                                <th width="200">Kode Pos</th>
                                <td width="10">:</td>
                                <td><?= $order['postal_code'] ?></td>
                            </tr>
                            <tr>
                                <th width="200">Alamat</th>
                                <td width="10">:</td>
                                <td><?= $order['address'] ?></td>
                            </tr>
                            <tr>
                                <th width="200">Total</th>
                                <td width="10">:</td>
                                <td>Rp. <?= number_format($order['total']) ?></td>
                            </tr>
                        </table>
                        <table class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM order_items WHERE order_id = '$id'";
                                $query = $con->prepare($sql);
                                $query->execute();
                                $no = 1;
                                $order_items = $query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($order_items as $order_item) {
                                    $product_id = $order_item['product_id'];
                                    $sql = "SELECT * FROM products WHERE id = '$product_id'";
                                    $query = $con->prepare($sql);
                                    $query->execute();
                                    $product = $query->fetch(PDO::FETCH_ASSOC);
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <span class="symbol symbol-50px me-3">
                                                <img src="../../public/images/products/<?= $product['image'] ?>" alt="" width="50">
                                            </span>
                                            <?= $product['name'] ?>
                                        </td>
                                        <td>Rp. <?= number_format($product['price']) ?></td>
                                        <td><?= $order_item['quantity'] ?></td>
                                        <td>Rp. <?= number_format($order_item['total']) ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">Total</th>
                                    <th>Rp. <?= number_format($order['total']) ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <?php
        require_once('../include/footer.php');
        ?>
    </div>
    <?php
    require_once('../include/modal.php');
    require_once('../include/script.php');
    ?>
    <script>
    </script>
</body>

</html>