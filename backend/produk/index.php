<?php
require_once('../../config/koneksi.php');
$sql = "SELECT *, categories.name as category_name FROM products INNER JOIN categories ON products.category_id = categories.id";
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
    <title>E-Commerce | Produk</title>
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
                                        <i data-feather="shopping-bag"></i>
                                    </div>
                                    Produk
                                </h1>
                                <div class="page-header-subtitle">Produk
                                </div>
                            </div>
                            <div class="col-12 col-xl-auto mt-4">
                                <div class="btn-group">
                                    <a href="create.php" class="btn btn-white">Tambah Produk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-xl px-4 mt-n10">
                <div class="card mb-4">
                    <div class="card-header">List Produk</div>
                    <div class="card-body">
                        <table id="datatables" class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th></th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
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
                                        <td><img src="../../public/images/products/<?php echo $row['image']; ?>" width="100px"></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['category_name']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['stock']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">
                                                    <span class="symbol-btn-group me-2">
                                                        <i class="fa fa-pencil"></i>
                                                    </span>
                                                    Ubah
                                                </a>
                                                <a href="javascript:;" onclick="deleteData(<?php echo $row['id']; ?>)" class="btn btn-danger">
                                                    <span class="symbol-btn-group me-2">
                                                        <i class="fa fa-trash"></i>
                                                    </span>
                                                    Hapus
                                                </a>
                                            </div>
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
        function deleteData(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "function.php",
                        type: "POST",
                        data: {
                            id: id,
                            action: 'hapus'
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data telah dihapus.',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                location.reload();
                            });
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Batal',
                        'Data batal dihapus :)',
                        'error'
                    )
                }
            });
        }
    </script>
</body>

</html>