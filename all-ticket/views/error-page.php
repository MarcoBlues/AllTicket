
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>404 HTML Template by Colorlib</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web:700,900" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="<?php echo CSS_PATH ?>style.css" />


</head>

<body>
<section class="home_banner_area">
    <div class="banner_inner">
    <div class="container">
        <div class="banner_content">
			<div id="notfound">
				<div class="notfound">
					<div class="notfound-404">
						<h1>ERROR <?=$ex->getCode();?></h1>
					</div>
					<h2>Oops! Esto es realmente embarazoso</h2>
					<h2><?=$message;?></h2>
					<p>Contacte con su administrador</p>
					<a style="font-size:25px;" href="<?php echo FRONT_ROOT?>home/Index" >Ir a la pagina principal</a>
				</div>
			</div>
		</div>
		</div>
	</div>
</section>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>

<?php require_once(VIEWS_PATH."footer.php") ?>
