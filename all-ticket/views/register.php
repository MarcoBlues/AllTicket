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
        <link rel="stylesheet" type="text/css" href="vendors/linericon/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" type="text/css" href="vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" type="text/css" href="vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" type="text/css" href="vendors/animate-css/animate.css">
        <!-- main css -->
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
                    <a><p><strong>¡Creando mi cuenta!</strong></p></a>
               </header>
               <form class="login-form bg-dark-alpha p-5 text-white" method="POST" action="<?php echo FRONT_ROOT ?>Client/AddClient">
                    <div class="form-group">
                        <label for="">Nombre de usuario</label>
                        <input type="text" name="userName" class="form-control form-control-lg" min="4" max="25" placeholder="Ingresar usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="">Contraseña</label>
                        <input type="password" name="password" class="form-control form-control-lg" min="6" max="35" placeholder="Ingresar constraseña" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email" required>
                    </div>
                    <strong><?php if(isset($message)) { echo $message."<br><br>"; } ?></strong>
                    <button class="btn btn-dark btn-block btn-lg" type="submit">
                        Registrarse
                    </button>
                    <button class="btn btn-dark btn-block btn-lg" type="reset">
                        Limpiar campos
                    </button>
                    <button class="btn btn-dark btn-block btn-lg" type="button" onclick="loginPage(this);">
                        Volver
                    </button>
                    <script>
                        function loginPage(target) {
                            location.href = '<?php echo FRONT_ROOT?>home/login';
                        }
                    </script>
               </form>
          </div>
     </main>
                    </div>
                </div>
            </div>
        </section>
         
		</form>
    </body>
</html>

<?php require_once(VIEWS_PATH."footer.php") ?>