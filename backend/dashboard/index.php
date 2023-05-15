<?php
require_once('../../config/koneksi.php');
$sql = "SELECT * FROM categories";
$query = $con->prepare($sql);
$query->execute();
$categories = $query->rowCount();
$sql = "SELECT * FROM products";
$query = $con->prepare($sql);
$query->execute();
$products = $query->rowCount();
$sql = "SELECT * FROM orders";
$query = $con->prepare($sql);
$query->execute();
$orders = $query->rowCount();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce | Dashboard</title>
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
                                        <i data-feather="home"></i>
                                    </div>
                                    Dashboard
                                </h1>
                                <div class="page-header-subtitle">Selamat Datang di E-Commerce
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-xl px-4 mt-n10">
                <!-- Example Colored Cards for Dashboard Demo-->
                <div class="row">
                    <div class="col-lg-4 col-xl-4 mb-4">
                        <div class="card bg-primary text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="me-3">
                                        <div class="text-white-75 small">Total Kategori</div>
                                        <div class="text-lg fw-bold"><?= $categories ?></div>
                                    </div>
                                    <i class="feather-xl text-white-50" data-feather="list"></i>
                                </div>
                            </div>
                            <div class=" card-footer d-flex align-items-center justify-content-between small">
                                <div class="text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4 mb-4">
                        <div class="card bg-warning text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="me-3">
                                        <div class="text-white-75 small">Total Produk</div>
                                        <div class="text-lg fw-bold"><?= $products ?></div>
                                    </div>
                                    <i class="feather-xl text-white-50" data-feather="shopping-bag"></i>
                                </div>
                            </div>
                            <div class=" card-footer d-flex align-items-center justify-content-between small">
                                <div class="text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4 mb-4">
                        <div class="card bg-success text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="me-3">
                                        <div class="text-white-75 small">Total Pesanan</div>
                                        <div class="text-lg fw-bold"><?= $orders ?></div>
                                    </div>
                                    <i class="feather-xl text-white-50" data-feather="shopping-cart"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between small">
                                <div class="text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
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
</body>

</html>