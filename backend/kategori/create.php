<?php
require_once('../../config/koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce | Kategori</title>
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
            <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                <div class="container-xl px-4">
                    <div class="page-header-content">
                        <div class="row align-items-center justify-content-between pt-3">
                            <div class="col-auto mb-3">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon">
                                        <i data-feather="list"></i>
                                    </div>
                                    Tambah Kategori
                                </h1>
                            </div>
                            <div class="col-12 col-xl-auto mb-3">
                                <a class="btn btn-sm btn-light text-primary" href="../kategori/index.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left me-1">
                                        <line x1="19" y1="12" x2="5" y2="12"></line>
                                        <polyline points="12 19 5 12 12 5"></polyline>
                                    </svg>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-xl px-4 mt-4">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Tambah Kategori</div>
                    <div class="card-body">
                        <form id="form" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (nama)-->
                                <div class="col-md-12">
                                    <label class="small mb-1" for="nama">Nama</label>
                                    <input class="form-control" id="nama" name="name" type="text" placeholder="Nama" />
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit" id="tombol_submit">Simpan</button>
                        </form>
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
        $('#form').submit(function(e) {
            e.preventDefault();
            var data = $('#form').serialize();
            data += '&action=tambah';
            $.ajax({
                type: 'POST',
                url: 'function.php',
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    $('#tombol_submit').prop("disabled", true);
                    $('#tombol_submit').text('Please wait...');
                },
                success: function(response) {
                    if (response.status == "success") {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: "success",
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = "index.php";
                            $(form)[0].reset();
                            setTimeout(function() {
                                $('#tombol_submit').prop("disabled", false);
                                $('#tombol_submit').html('Simpan');
                                back();
                            }, 2000);
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: "error",
                            confirmButtonText: 'OK'
                        });
                        setTimeout(function() {
                            $('#tombol_submit').prop("disabled", false);
                            $('#tombol_submit').html('Simpan');
                        }, 2000);
                    }
                }
            });
        });
    </script>
</body>

</html>