<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>All Tickets</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../views/vendors/linericon/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../views/vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" type="text/css" href="../views/vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" type="text/css" href="../views/vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" type="text/css" href="../views/vendors/animate-css/animate.css">
        <!-- main css -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>responsive.css">
    </head>

    <body>
        <header class="header_area">
            <div class="main_menu">
                <nav class="navbar navbar-expand-lg navbar-light">
				    <div class="container box_1620">
					    <a class="navbar-brand logo_h" href="home.php"><img src="img/logo.png" alt=""></a>
					    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						    <span class="icon-bar"></span>
						    <span class="icon-bar"></span>
						    <span class="icon-bar"></span>
					    </button>
					    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						    <ul class="nav navbar-nav menu_nav m-auto">
							    <li class="nav-item active"><a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Index">Inicio</a></li> 
                                <?php
                                    $client = $_SESSION["client"];

                                    if($client->getRol() == 1)
                                    {?>
        							    <li class="nav-item submenu dropdown">
        								    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestion</a>
        								    <ul class="dropdown-menu">
        									    <li class="nav-item"><a class="nav-link" href="<?php echo FRONT_ROOT ?>Artist/ShowArtistView">Artistas</a>
        									    <li class="nav-item"><a class="nav-link" href="<?php echo FRONT_ROOT ?>Event/ShowEventView">Eventos</a>
        									    <li class="nav-item"><a class="nav-link" href="<?php echo FRONT_ROOT ?>Eventype/ShowEventTypeView">Tipo de eventos</a> 
        									    <li class="nav-item"><a class="nav-link" href="<?php echo FRONT_ROOT ?>EventPlace/ShowEventPlaceView">Lugar de eventos</a>
                                                <li class="nav-item"><a class="nav-link" href="<?php echo FRONT_ROOT ?>Category/ShowCategoryView">Categorias</a>
                                                <li class="nav-item"><a class="nav-link" href="<?php echo FRONT_ROOT ?>Calendary/ShowCalendaryView">Calendarios</a>
                                                <li class="nav-item"><a class="nav-link" href="<?php echo FRONT_ROOT ?>Client/ShowClientView">Clientes</a></li>
        									</ul>
                                        </li>
                                        <li class="nav-item active"><a class="nav-link" href="<?php echo FRONT_ROOT ?>Bought/ShowBoughList">Registro de compras</a></li>
                                        
                                        
                                    <?php } ?>
                                <?php if($client->getRol() != 1){ ?>
                                    <li class="nav-item active"><a class="nav-link" href="<?php echo FRONT_ROOT ?>Bought/ShowEventsAvailables">Eventos disponibles</a></li>
                                    <li class="nav-item active"><a class="nav-link" href="<?php echo FRONT_ROOT ?>Bought/MyVirtualCart">Mi carrito</a></li>
                                <?php }?>
                                
                                <li class="nav-item active"><a class="nav-link" href="<?php echo FRONT_ROOT ?>home/logout">Salir</a></li> 
						    </ul>
					    </div> 
				    </div>
                </nav>
            </div>
        </header>

        <script src="../views/js/jquery-3.2.1.min.js"></script>
        <script src="../views/js/popper.js"></script>
        <script src="../views/js/bootstrap.min.js"></script>
        <script src="../views/js/stellar.js"></script>
        <script src="../views/js/script.js"></script>
        <script src="../views/js/jquery.payform.min.js" charset="utf-8"></script>
        <script src="../views/vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="../views/vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="../views/vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="../views/vendors/isotope/isotope-min.js"></script>
        <script src="../views/vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="../views/js/jquery.ajaxchimp.min.js"></script>
        <script src="../views/vendors/flipclock/timer.js"></script>
        <script src="../views/vendors/counter-up/jquery.waypoints.min.js"></script>
        <script src="../views/vendors/counter-up/jquery.counterup.js"></script>
        <script src="../views/js/mail-script.js"></script>
    </body>
</html>