<?php
  $vgPost="video";

  	if (isset($_GET['p'])){
  		$luPagina=explode("/", $_GET['p']);
    	$lugarPaginaN =$luPagina[0];
  	}else{
    	$lugarPaginaN="";
  	}
  	if ($vgVideoExiste==true){
    	$urlVideoCompleta=explode("/", $_GET['p']);
    	$veli =$urlVideoCompleta[0];
    	$sql = "SELECT * FROM post WHERE `post`.`url_post` = '$veli' AND `post`.`publicado`='true' LIMIT 1";
    	$resultHead=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
    	$rowHead =$resultHead->fetch_assoc();
  	}elseif ($vgCategoriaExiste==true){
    	$urlVideoCompleta=explode("/", $_GET['p']);
    	$veli =$urlVideoCompleta[1];
    	$sql = "SELECT * FROM categoria WHERE `categoria`.`link` = '$veli' LIMIT 1";
    	$resultCatHead=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
    	$rowCatHead =$resultCatHead->fetch_assoc();
  	}elseif ($vgTagExiste==true){
    	$urlVideoCompleta=explode("/", $_GET['p']);
    	$veli =$urlVideoCompleta[1];
    	$sql = "SELECT * FROM tag WHERE `tag`.`url` = '$veli' LIMIT 1";
    	$resultTagHead=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
    	$rowTagHead =$resultTagHead->fetch_assoc();
  	}
?>
<!DOCTYPE html>
<html lang="es-ES" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
    if ($vgVideoExiste==true){ 
    	// $ogSegundos=explode(":", utf8_decode($rowHead['duracion']));
    	// $ogDuracion=$ogSegundos[0] * 60;
    	// $ogDuracion=$ogDuracion+$ogSegundos[1];
    ?>
    <title><?php echo $rowHead['titulo'].' - PelisUp'; ?></title>
    <meta name="keywords" content="<?php echo $rowHead['etiquetas']; ?>" />
    <meta name="description" content="<?php echo strip_tags($rowHead['descripcion']); ?>">
    <link rel="canonical" href="<?php echo SERVERURL,utf8_decode($rowHead['url_post']); ?>">
    <meta property="og:title" content="<?php echo $rowHead['titulo'].' - PelisUp'; ?>">
    <meta property="og:type" content="video.movie">
    <meta property="og:url" content="<?php echo SERVERURL,utf8_decode($rowHead['url_post']); ?>">
    <!-- <meta property="og:duration" content="<?php echo $ogDuracion; ?>" /> -->
    <meta property="og:image" content="<?php echo $rowHead['url_imagen']; ?>" />
    <meta property="og:video" content="<?php echo $rowHead['trailer']; ?>" />
    <meta property="og:video:type" content="application/x-shockwave-flash" />
    <meta property="og:video:width" content="510" />
    <meta property="og:video:height" content="400" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="<?php echo strip_tags($rowHead['descripcion']); ?>" />
    <meta name="twitter:title" content="<?php echo $rowHead['titulo'].' - PelisUp'; ?>" />
    <meta name="twitter:image" content="<?php echo utf8_decode($rowHead['url_imagen']); ?>" />
    <?php }elseif ($vgCategoriaExiste==true){ ?>
    <title><?php echo $rowCatHead['titulo_goo'].' - PelisUp'; ?></title>
    <meta name="keywords" content="peliculas en español,peliculas en hd,peliculas en español latino,pelicula,trailer,peliculas de accion,peliculas de comedias" />
    <meta name="description" content="<?php echo strip_tags($rowCatHead['descripcion']); ?>">
    <link rel="canonical" href="<?php echo SERVERURL,'categoria/',$veli; ?>">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="<?php echo strip_tags($rowCatHead['descripcion']); ?>" />
    <meta name="twitter:title" content="<?php echo $rowCatHead['titulo_goo'].' - PelisUp'; ?>" />
    <meta name="twitter:image" content="<?php echo $rowCatHead['imagen']; ?>" />
    <?php }elseif ($vgTagExiste==true){ ?>
    <title><?php echo 'Películas en español ',$rowTagHead['nombre'].' - PelisUp'; ?></title>
    <meta name="keywords" content="Ver pelicula enlinea,pelicula online en español,peliculas de accion,peliculas,ver pelicula de accion,ver pelicula de comedia" />
    <meta name="description" content="<?php echo 'Las mejores películas para ver enlinea en español, acción, comedia, terror, horror, las mejores en buena calidad.'; ?>">
    <link rel="canonical" href="<?php echo SERVERURL,'tag/',$veli; ?>">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="<?php echo 'En PelisUp podrás ver las mejores películass de ',$rowTagHead['nombre'],' gratis en HD, podras ver las peliculas sin publicidad molesta.'; ?>" />
    <meta name="twitter:title" content="<?php echo 'Películas de ',$rowTagHead['nombre'].' - PelisUp'; ?>" />
    <?php }else { ?>
    <title>Mejores Películas enlinea en español - PelisUp</title>
    <meta name="keywords" content="pelicula en español,pelicula en hd,pelicula de accion,pelicula de comedia,pelicula,ver pelicula enlinea" />
    <meta name="description" content="Si esta buscando peliculas en español para ver en buena calidad has llegado al sitio ideal.">
    <?php
    if (isset($_GET['p'])){
      $numeroPaginaVer=explode("/", $_GET['p']);
      if ($numeroPaginaVer[0]=="page"){
        $veliPage="page/".$numeroPaginaVer[1];
      }elseif ($numeroPaginaVer[0]=="todas-las-categorias"){
        $veliPage="todas-las-categorias";
      }elseif ($numeroPaginaVer[0]=="terminos-y-condiciones"){
        $veliPage="terminos-y-condiciones";
      }elseif ($numeroPaginaVer[0]=="buscar"){
        $veliPage="buscar";
      }elseif ($numeroPaginaVer[0]=="contacto"){
        $veliPage="contacto";
      }else{
        $veliPage="";
      }
    }else{
      $veliPage="";
    }
    ?>
    <link rel="canonical" href="<?php echo SERVERURL,$veliPage; ?>">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="Las mejores películas para ver enlinea en español, acción, comedia, terror, horror, las mejores en buena calidad." />
    <meta name="twitter:title" content="Ver película en español." />
    <?php } ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo SERVERURL; ?>apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo SERVERURL; ?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo SERVERURL; ?>favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SERVERURL; ?>favicon.ico" />

	<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>assets/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600i,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>assets/css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>assets/css/owl.theme.default.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>assets/css/estilos.css">
	<title>PelisUp</title>
</head>
<body>
	<header>
		<nav class="navbar menu navbar-expand-lg fixed-top navbar-dark border-bottom border-light" id="menu">
			<div class="container">
				<a href="<?php echo SERVERURL; ?>" class="navbar-brand">PelisUp</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuBar" aria-controls="navbar" aria-expanded="false" aria-label="Menu de navegacion">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-between mx-3" id="menuBar">
					<ul class="navbar-nav">
						<li class="nav-item pr-4">
							<a href="#" class="nav-link">Inicio</a>
						</li>
						<li class="nav-item pr-4">
							<a href="?p=todas-las-categorias"  class="nav-link">Categorias</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link"></a>
						</li>
					</ul>
					<form class="buscar form-inline my-2 my-lg-0 w-100">
						<input class="form-control mr-2 buscarText" type="search" placeholder="Buscar" aria-label="buscar">
					</form>
				</div>
			</div>
		</nav>		
	</header>
	
	<div class="main">