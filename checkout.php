<?php
require_once('config/koneksi.php');
$sql = "SELECT carts.*, products.name, products.price, products.image FROM carts JOIN products ON carts.product_id = products.id";
$query = $con->prepare($sql);
$query->execute();
$carts = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodio - Cart Checkout</title>
    <link rel="icon" href="/img/logo-icon.png">
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="public/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="public/frontend/css/owl.theme.default.min.css">
    <!-- fancybox -->
    <link rel="stylesheet" href="public/frontend/css/jquery.fancybox.min.css">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="public/frontend/css/fontawesome.min.css">
    <!-- style -->
    <link rel="stylesheet" href="public/frontend/css/style.css">
    <!-- responsive -->
    <link rel="stylesheet" href="public/frontend/css/responsive.css">
    <!-- color -->
    <link rel="stylesheet" href="public/frontend/css/color.css">
    <link rel="stylesheet" href="public/backend/css/sweetalert.css" type="text/css" />
    <link rel="stylesheet" href="public/backend/css/toastr.css" type="text/css" />
    <!-- jQuery -->
    <script src="public/frontend/js/jquery-3.6.0.min.js"></script>
    <script src="public/frontend/js/preloader.js"></script>
</head>

<body>
    <!-- preloader -->
    <div class="preloader">
        <div class="container">
            <div class="dot dot-1"></div>
            <div class="dot dot-2"></div>
            <div class="dot dot-3"></div>
        </div>
    </div>
    <!-- end preloader -->
    <header class="one">
        <div class="top-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6">
                        <div class="d-flex align-items-center">
                            <div class="content-header me-5">
                                <i>
                                    <svg height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg">
                                        <g id="_16-Smartphone" data-name="16-Smartphone">
                                            <path d="m23 2h-14a3 3 0 0 0 -3 3v22a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-22a3 3 0 0 0 -3-3zm-5.39 2-.33 1h-2.56l-.33-1zm6.39 23a1 1 0 0 1 -1 1h-14a1 1 0 0 1 -1-1v-22a1 1 0 0 1 1-1h3.28l.54 1.63a2 2 0 0 0 1.9 1.37h2.56a2 2 0 0 0 1.9-1.37l.54-1.63h3.28a1 1 0 0 1 1 1z" />
                                            <path d="m17 24h-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2z" />
                                        </g>
                                    </svg>
                                </i>
                                <h4>Phone:<a href="callto:+1(850)344066">+1 (850) 344 0 66</a></h4>
                            </div>
                            <div class="content-header">
                                <i>
                                    <svg height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg">
                                        <g id="_01-Email" data-name="01-Email">
                                            <path d="m29.61 12.21-13-10a1 1 0 0 0 -1.22 0l-13 10a1 1 0 0 0 -.39.79v14a3 3 0 0 0 3 3h22a3 3 0 0 0 3-3v-14a1 1 0 0 0 -.39-.79zm-13.61-7.95 11.36 8.74-11.36 8.74-11.36-8.74zm11 23.74h-22a1 1 0 0 1 -1-1v-12l11.39 8.76a1 1 0 0 0 1.22 0l11.39-8.76v12a1 1 0 0 1 -1 1z" />
                                        </g>
                                    </svg>
                                </i>
                                <h4>Email:<a href="mailto:+1(850)344066">info@domain.com</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="d-flex align-items-center login">
                            <div class="header-social-media">
                                <a href="#">
                                    Facebook
                                </a>
                                <a href="#">
                                    Instagram
                                </a>
                                <a href="#">
                                    Youtube
                                </a>
                            </div>
                            <div class="register">
                                <i>
                                    <svg clip-rule="evenodd" fill-rule="evenodd" height="512" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg">
                                        <g id="Approved-User">
                                            <path d="m10.105 22.3c.21-.482.511-.926.89-1.305.797-.797 1.878-1.245 3.005-1.245h4c1.127 0 2.208.448 3.005 1.245.379.379.68.823.89 1.305.166.379.608.553.988.387.379-.165.553-.608.387-.987-.285-.653-.691-1.253-1.204-1.766-1.078-1.078-2.541-1.684-4.066-1.684-1.3 0-2.7 0-4 0-1.525 0-2.988.606-4.066 1.684-.513.513-.919 1.113-1.204 1.766-.166.379.008.822.387.987.38.166.822-.008.988-.387z" />
                                            <path d="m16 8.25c-3.174 0-5.75 2.576-5.75 5.75s2.576 5.75 5.75 5.75 5.75-2.576 5.75-5.75-2.576-5.75-5.75-5.75zm0 1.5c2.346 0 4.25 1.904 4.25 4.25s-1.904 4.25-4.25 4.25-4.25-1.904-4.25-4.25 1.904-4.25 4.25-4.25z" />
                                            <path d="m26.609 12.25c.415 1.173.641 2.435.641 3.75 0 6.209-5.041 11.25-11.25 11.25s-11.25-5.041-11.25-11.25 5.041-11.25 11.25-11.25c1.315 0 2.577.226 3.75.641.39.138.819-.067.957-.457s-.067-.819-.457-.957c-1.329-.471-2.76-.727-4.25-.727-7.037 0-12.75 5.713-12.75 12.75s5.713 12.75 12.75 12.75 12.75-5.713 12.75-12.75c0-1.49-.256-2.921-.727-4.25-.138-.39-.567-.595-.957-.457s-.595.567-.457.957z" />
                                            <path d="m21.47 8.53 2 2c.293.293.767.293 1.06 0l4-4c.293-.292.293-.768 0-1.06-.292-.293-.768-.293-1.06 0l-3.47 3.469s-1.47-1.469-1.47-1.469c-.292-.293-.768-.293-1.06 0-.293.292-.293.768 0 1.06z" />
                                        </g>
                                    </svg>
                                </i><a href="login.php">Login / Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-bar ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="logo">
                                <a href="index.php">
                                    <img alt="logo" src="public/frontend/img/logo.png">
                                </a>
                            </div>
                            <div class="d-flex cart-checkout">
                                <a href="checkout.php">
                                    <i>
                                        <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path d="m452 120h-60.946c-7.945-67.478-65.477-120-135.054-120s-127.109 52.522-135.054 120h-60.946c-11.046 0-20 8.954-20 20v352c0 11.046 8.954 20 20 20h392c11.046 0 20-8.954 20-20v-352c0-11.046-8.954-20-20-20zm-196-80c47.484 0 87.019 34.655 94.659 80h-189.318c7.64-45.345 47.175-80 94.659-80zm176 432h-352v-312h40v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h192v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h40z"></path>
                                            </g>
                                        </svg>
                                    </i>
                                </a>
                                <div class="bar-menu">
                                    <i class="fa-solid fa-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <nav class="navbar">
                            <ul class="navbar-links">
                                <li class="navbar-dropdown">
                                    <a href="index.php">home</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3">
                        <div class="hamburger-icon">
                            <div class="donation">

                                <a href="JavaScript:void(0)" class="pr-cart">

                                    <svg id="Shoping-bags" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path d="m452 120h-60.946c-7.945-67.478-65.477-120-135.054-120s-127.109 52.522-135.054 120h-60.946c-11.046 0-20 8.954-20 20v352c0 11.046 8.954 20 20 20h392c11.046 0 20-8.954 20-20v-352c0-11.046-8.954-20-20-20zm-196-80c47.484 0 87.019 34.655 94.659 80h-189.318c7.64-45.345 47.175-80 94.659-80zm176 432h-352v-312h40v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h192v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h40z"></path>
                                        </g>
                                    </svg>

                                </a>

                                <div class="cart-popup">
                                    <button type='button' class='close' onclick='$(this).parent().removeClass("show-cart");'>×</button>
                                    <ul>
                                        <?php
                                        $total_price = 0;
                                        $total_item = 0;
                                        foreach ($carts as $cart) :
                                            $total_price += $cart['quantity'] * $cart['price'];
                                            $total_item += $cart['quantity'];
                                        endforeach;
                                        ?>
                                        <?php foreach ($carts as $cart) : ?>
                                            <li class="d-flex align-items-center position-relative">
                                                <div class="p-img light-bg">
                                                    <img src="public/images/products/<?= $cart['image'] ?>" alt="Product Image" class="img-fluid">
                                                </div>
                                                <div class="p-data">
                                                    <h3 class="font-semi-bold"><?= $cart['name'] ?></h3>
                                                    <p class="theme-clr font-semi-bold"><?= $cart['quantity'] ?> x Rp. <?= number_format($cart['price'], 0, ',', '.') ?></p>
                                                </div>
                                                <a href="JavaScript:void(0)" id="crosss"></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>

                                    <div class="cart-total d-flex align-items-center justify-content-between">

                                        <span class="font-semi-bold">Total:</span>

                                        <span class="font-semi-bold">Rp. <?= number_format($total_price, 0, ',', '.') ?></span>

                                    </div>

                                    <div class="cart-btns d-flex align-items-center justify-content-between">

                                        <a class="font-bold" href="cart.php">View Cart</a>

                                        <a class="font-bold theme-bg-clr text-white checkout" href="checkout.php">Checkout</a>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-nav hmburger-menu" id="mobile-nav" style="display:block;">
            <div class="res-log">
                <a href="index.php">
                    <img src="public/frontend/img/logo.png" alt="Responsive Logo" class="white-logo">
                </a>
            </div>
            <ul>

                <li><a href="index.php">Home</a>
                </li>
            </ul>

            <a href="JavaScript:void(0)" id="res-cross"></a>
        </div>
    </header>
    <section class="banner" style="background-image:url(public/frontend//img/background.png)">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="title-area-data">
                        <h2>Cart Checkout</h2>
                        <p>A magical combination that sent aromas to the taste buds</p>
                    </div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index-2.html"><i class="fa-solid fa-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Shop Cart</li>
                        <li class="breadcrumb-item active" aria-current="page">Cart Checkout</li>
                    </ol>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-6">
                            <div class="title-area-img">
                                <img alt="title-area-img" src="public/frontend/img/title-area-img-1.jpg">
                                <img alt="pata" class="pata" src="public/frontend/img/pata.png">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="title-area-img two">
                                <img alt="title-area-img" src="public/frontend/img/title-area-img-2.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="gap">
        <div class="container">
            <form class="checkout-meta donate-page" id="form-checkout">
                <div class="row">
                    <div class="col-lg-8">
                        <h3 class="pb-3">Billing details</h3>
                        <div class="col-lg-12">
                            <input type="text" class="input-text " name="name" placeholder="Complete Name" />
                            <input type="email" class="input-text " name="email" placeholder="Email address" />
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Postal Code" name="postal_code" />
                                </div>
                                <div class="col-lg-6">
                                    <input type="tel" class="input-text " name="phone" placeholder="Phone">
                                </div>
                            </div>
                            <div class="woocommerce-additional-fields mt-0">
                                <textarea name="address" class="input-text " placeholder="Address"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart_totals-checkout" style="background-image: url(public/frontend/img/patron.jpg)">
                            <div class="cart_totals cart-Total">
                                <h4>Cart Total</h4>
                                <table class="shop_table_responsive">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal:</th>
                                            <td>
                                                <span class="woocommerce-Price-amount">
                                                    <bdi>
                                                        <span class="woocommerce-Price-currencySymbol">Rp. </span><?= number_format($total_price, 0, ',', '.') ?>
                                                    </bdi>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="Shipping">
                                            <th>Shipping:</th>
                                            <td>
                                                <span class="woocommerce-Price-amount amount">
                                                    free
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="Total">
                                            <th>Total:</th>
                                            <td>
                                                <span class="woocommerce-Price-amount">
                                                    <bdi>
                                                        <span>Rp. <?= number_format($total_price, 0, ',', '.') ?></span>
                                                    </bdi>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="checkout-side">
                                <h3>Payment Method</h3>
                                <ul>
                                    <li>
                                        <input type="radio" name="payment_method" value="bank">
                                        <label>
                                            Bank Payment
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" name="payment_method" value="OVO">
                                        <label>
                                            OVO
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" name="payment_method" value="DANA">
                                        <label>
                                            DANA
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" name="payment_method" value="cod">
                                        <label>
                                            Cash on Delivery
                                        </label>
                                    </li>
                                </ul>
                                <button type="submit" class="button"><span>Place Order</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- jQuery -->
    <footer style="background-image: url(public/frontend/img/footer.png);background-color: #f5f8fd;">
        <div class="container">
            <div class="footer-bootem">
                <h6><span>© 2023 Foodio</span> | Restaurant and BBQ.</h6>
                <div class="header-social-media">
                    <a href="#">Facebook</a>
                    <a href="#">Twitter</a>
                    <a href="#">Instagram</a>
                    <a href="#">Youtube</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- progress -->
    <div id="progress">
        <span id="progress-value"><i class="fa-solid fa-arrow-up"></i></span>
    </div>

    <!-- Bootstrap Js -->
    <script src="public/frontend/js/bootstrap.min.js"></script>
    <script src="public/frontend/js/owl.carousel.min.js"></script>
    <!-- fancybox -->
    <script src="public/frontend/js/jquery.fancybox.min.js"></script>
    <script src="public/frontend/js/custom.js"></script>
    <script src="public/backend/js/toastr.js"></script>
    <script src="public/backend/js/sweetalert.js"></script>
    <script>
        $(document).ready(function() {
            $('#form-checkout').submit(function(e) {
                e.preventDefault();
                var data = $(this).serialize();
                var btn = $(this).find('.button');
                $.ajax({
                    url: 'process-checkout.php',
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    beforeSend: function() {
                        btn.prop('disabled', true);
                        btn.html('<i class="fa fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            btn.prop('disabled', false);
                            btn.html('<span>Place Order</span>');
                            $('#form-checkout')[0].reset();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function() {
                                window.location.href = 'index.php';
                            }, 1000);
                        } else {
                            btn.prop('disabled', false);
                            btn.html('<span>Place Order</span>');
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>