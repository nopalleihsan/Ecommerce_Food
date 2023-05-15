<?php
require_once('../../config/koneksi.php');
$sql = "SELECT * FROM orders";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce | Pesanan</title>
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
                            <!-- <div class="col-12 col-xl-auto mt-4">
                                <div class="btn-group">
                                    <a href="javascript:;" class="btn btn-white">Tambah Produk</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-xl px-4 mt-n10">
                <div class="card mb-4">
                    <div class="card-header">List Pesanan</div>
                    <div class="card-body">
                        <table id="datatables" class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemesan</th>
                                    <th>Email Pemesan</th>
                                    <th>No Telepon</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($result as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['total']; ?></td>
                                        <td>
                                            <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
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