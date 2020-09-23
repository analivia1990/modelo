<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= SITE_NAME ?> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="src/img/favicon.ico">
    

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>


    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">
                <div class="header-top top-bg d-none d-lg-block">
                    <div class="container-fluid">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left d-flex">
                                    <!--<div class="flag">
                                        <img src="assets/img/icon/header_icon.png" alt="">
                                    </div>
                                    <div class="select-this">
                                        <form action="#">
                                            <div class="select-itms">
                                                <select name="select" id="select1">
                                                    <option value="">USA</option>
                                                    <option value="">SPN</option>
                                                    <option value="">CDA</option>
                                                    <option value="">USD</option>
                                                </select> 
                                            </div>
                                        </form>
                                    </div>-->
                                    <ul class="contact-now">
                                        <li>+55 11 97102-6167</li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul>
                                        <li><a href="login.php">Minha Conta </a></li>
                                        <li><a href="lista_desejos.php">Lista de Desejos </a></li>
                                        <li><a href="carrinho.php">Carrinho</a></li>
                                        <li><a href="carrinho.php">Cart</a></li>
                                        <li><a href="checkout.php">Checkout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                    <a href="index.php"><img src="src/img/logo/logo.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="categoria.php">Catagoria</a>

                                                <ul class="submenu">
                                                    <li><a href="login.php">Óculos</a></li>
                                                    <li><a href="carrinho.php">Alianças</a></li>
                                                    
                                                </ul>

                                            </li>
                                            <li><a href="#">Recente</a> <!-- li = class="hot"-->
                                                <ul class="submenu">
                                                    <li><a href="lista_desejos.php"> Lista de Produtos</a></li>
                                                    <li><a href="detalhes_produto"> Detalhes Produtos</a></li>
                                                </ul>
                                            </li>
                                            <!--<li><a href="blog.html">Blog</a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="single-blog.html">Blog Details</a></li>
                                                </ul>
                                            </li> -->
                                            <li><a href="#">Paginas</a>
                                                <ul class="submenu">
                                                    <li><a href="login.php">Login</a></li>
                                                    <li><a href="carrinho.php">Card</a></li>
                                                    <li><a href="elementos.php">Element</a></li>
                                                    <li><a href="sobre.php">Sobre</a></li>
                                                    <li><a href="confirmacao.php">Confirmation</a></li>
                                                    <li><a href="carrinho.php">Carrinho
                                                    <li><a href="checkout.php">Checkout</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contato.php">Contato</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
                                <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">
                                    <li class="d-none d-xl-block">
                                        <div class="form-box f-right ">
                                            <input type="text" name="Search" placeholder="Search products">
                                            <div class="search-icon">
                                                <i class="fas fa-search special-tag"></i>
                                            </div>
                                        </div>
                                     </li>
                                    <li class=" d-none d-xl-block">
                                        <div class="favorit-items">
                                            <i class="far fa-heart"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="shopping-card">
                                            <a href="cart.html"><i class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </li>
                                   <li class="d-none d-lg-block"> <a href="#" class="btn header-btn">Sign in</a></li>
                                </ul>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>