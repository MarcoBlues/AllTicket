<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>All Tickets</title>

        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>bootstrap.css">
        <link rel="stylesheet" type="text/css" href="vendors/linericon/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" type="text/css" href="vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" type="text/css" href="vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" type="text/css" href="vendors/animate-css/animate.css">
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>responsive.css">
    </head>
    <body>
        <section class="home_banner_area" >
            <div class="banner_inner">
                <div class="container">
					<div class="banner_content">
                        <main class="d-flex align-items-center justify-content-center height-100">
                            <div class="content">
                                <header class="text-center">
                                    <h2>Bienvenido a All-Ticket</h2>
                                    <a><p><strong>Ingresa tus datos</strong></p></a>
                                </header>
                                <form class="login-form bg-dark-alpha p-5 text-white" method="POST" action="<?php echo FRONT_ROOT ?>client/authentication">
                                    <div class="form-group">
                                        <label for="">Usuario</label>
                                        <input type="text" name="userName" class="form-control form-control-lg" placeholder="Ingresar usuario" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Contraseña</label>
                                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
                                    </div>
                                    <strong><?php if(isset($message)) { echo $message."<br><br>"; } ?> </strong>
                                    <button class="btn btn-dark btn-block btn-lg" type="submit">Iniciar sesión</button>
                                    <button class="btn btn-dark btn-block btn-lg" type="button" onclick="registerPage(this);">Registrarse</button>
                                    
                                    <script>
                                        function registerPage(target) {
                                            location.href = '<?php echo FRONT_ROOT?>home/register';
                                        }
                                    </script>
                                </form>
                            </div>
                        </main>
                    </div>
				</div>
            </div>
        </section>
        
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/stellar.js"></script>
        <script src="vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="vendors/isotope/isotope-min.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="js/jquery.ajaxchimp.min.js"></script>
        <script src="vendors/flipclock/timer.js"></script>
        <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
        <script src="vendors/counter-up/jquery.counterup.js"></script>
        <script src="js/mail-script.js"></script>        
    </body>
</html>

<?php require_once(VIEWS_PATH."footer.php") ?>