<?php
	function &call_mysqli(){
		static $_mysqli=null;
		if (is_null($_mysqli)){
			$_mysqli = new mysqli("localhost","root","","pelisdb");

			if (mysqli_connect_errno()){
				printf("No se pudo conectar a la base de datos. Errorcode: %s\n",mysqli_connect_error());
				exit();
			}
		}
		return $_mysqli;
	}

	function urls_amigables($url=NULL) {
		//Rememplazamos caracteres especiales latinos
	  	$find1 = array('á', 'é', 'í', 'ó', 'ú', 'ñ','Á','É','Í','Ó','Ú','Ñ');
	  	$repl1 = array('a', 'e', 'i', 'o', 'u', 'n','a','e','i','o','u','n');
	  	$url   = str_replace($find1, $repl1, $url);
	  
	  	//Añadimos los guiones
	  	$find2 = array(' ', '  ', '&', '\r\n', '\n', '+');
	  	$url   = str_replace($find2, '-', $url);
	  
	  	//Eliminamos y Reemplazamos demás caracteres especiales
	  	$find3 = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
	  	$repl3 = array('', '-', '');
	  	$url   = str_replace($find3, $repl3, $url);

	  	//Si el último caracter es un guión lo quitamos 
	  	if(!is_array($url) && substr($url, -1) == '-'){
	    	$url = substr($url, 0, -1);
	  	}
	  	$url = strtolower($url);
  		return $url;
	}

	// function urls_amigables($url) {

	// 	// Tranformamos todo a minusculas

	// 	$url = strtolower($url);

	// 	//Rememplazamos caracteres especiales latinos

	// 	$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ','Á','É','Í','Ó','Ú','Ñ');

	// 	$repl = array('a', 'e', 'i', 'o', 'u', 'n','a','e','i','o','u','n');

	// 	$url = str_replace ($find, $repl, $url);

	// 	// Añaadimos los guiones

	// 	$find = array(' ', '&', '\r\n', '\n', '+'); 
	// 	$url = str_replace ($find, '-', $url);

	// 	// Eliminamos y Reemplazamos demás caracteres especiales

	// 	$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

	// 	$repl = array('', '-', '');

	// 	$url = preg_replace ($find, $repl, $url);

	// 	return $url;

	// }

function borrar_imagenes($ruta,$extension)
		{
			
			switch ($extension) {
				case '.jpg':
					if(file_exists($ruta.".png"))
						unlink($ruta.".png");
					if(file_exists($ruta.".gif"))
						unlink($ruta.".gif");
					break;
				case '.gif':
					if(file_exists($ruta.".png"))
						unlink($ruta.".png");
					if(file_exists($ruta.".jpg"))
						unlink($ruta.".jpg");
					break;
				case '.png':
					if(file_exists($ruta.".jpg"))
						unlink($ruta.".jpg");
					if(file_exists($ruta.".gif"))
						unlink($ruta.".gif");
					break;		
				
				
			}
		}
	//funcion para subir imagenes en php
	function subir_imagenes($tipo,$imagen,$mail,$ruta,$size)
	{
		//strstr($cadena1,$cadena2) sirve para evaluar si en la primer cadena de texto
			//existe la segunda cadena de texto 
			//si dentro del tipo del archivo se encuentra la palabra  image significa que el
			//archivo es una imagen
			if(strstr($tipo,"image"))
			{
				//El archivo si es una imagen ahora valido que tipo de imagen es tomo la extension
				//del archivo
				if(strstr($tipo,"jpeg"))
					$extension=".jpg";
				else if(strstr($tipo,"gif"))
					$extension=".gif";
				else if(strstr($tipo,"png"))
					$extension=".png";
				//para saber si la imagen tiene el ancho correcto es de 420px
				$tam_img=getimagesize($imagen);
				$ancho_img=$tam_img[0];
				$alto_img =$tam_img[1];
				$ancho_img_deseado=$size;

				//sii la imagen es maor en su ancho a 420px reajusto su tamaño
					if($ancho_img > $ancho_img_deseado)
					{
						//reajustamos
					//por una regla de tres obtengo el alto de la imagen de manera 
					//proporciaonal  el ancho  nuevo  que sera 420
					$nuevo_ancho_img = $ancho_img_deseado;
					$nuevo_alto_img=($alto_img*$nuevo_ancho_img)/$ancho_img;
					//CREO UNA IMAGEN EN COLOR REAL CON LA NUEVAS DIMENSIONES
					
					$img_reajustada=imagecreatetruecolor($nuevo_ancho_img, $nuevo_alto_img);
					//CREO UNA IMAGEN BASADA EN LA ORIGINAL DEPENDIENDO DE SU EXTENSION ES EL TIPO QUE CREARE
					switch ($extension) {
						case '.jpg':

					
							 $img_original=imagecreatefromjpeg($imagen);
							 //REAJUSTO LA IMAGEN NUEVA CON RESPETO ALA ORIGINAL 
							 imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $nuevo_ancho_img, $nuevo_alto_img, 
							 	$ancho_img, $alto_img);
							 //Guardo la imagen  reescalada en el servidor 
							 $nombre_img_ext=$ruta.$mail.$extension;
							 $nombre_img=$ruta.$mail;
							 imagejpeg($img_reajustada,$nombre_img_ext,70);
							 //ejecuto la funcion para borrar posibles imagenes dobles del perfil
							 borrar_imagenes($nombre_img,".jpg");
							break;
						case '.gif':

					
							  $img_original=imagecreatefromgif($imagen);
							 //REAJUSTO LA IMAGEN NUEVA CON RESPETO ALA ORIGINAL 
							 imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $nuevo_ancho_img, $nuevo_alto_img, 
							 	$ancho_img, $alto_img);
							 //Guardo la imagen  reescalada en el servidor 
							 $nombre_img_ext=$ruta.$mail.$extension;
							 $nombre_img=$ruta.$mail;
							 imagegif($img_reajustada,$nombre_img_ext,100);
							 //ejecuto la funcion para borrar posibles imagenes dobles del perfil
							 borrar_imagenes($nombre_img,".gif");
							break;
						case '.png':

							
							   $img_original=imagecreatefrompng($imagen);
							 //REAJUSTO LA IMAGEN NUEVA CON RESPETO ALA ORIGINAL 
							 
        						imagesavealpha($img_reajustada, true);
        						imagealphablending($img_reajustada, false);	
							 imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $nuevo_ancho_img, $nuevo_alto_img, 
							 	$ancho_img, $alto_img);
							 imagecolortransparent($img_reajustada);
							 //Guardo la imagen  reescalada en el servidor 
							 $nombre_img_ext=$ruta.$mail.$extension;
							 $nombre_img=$ruta.$mail;
							 imagepng($img_reajustada,$nombre_img_ext,0);
							 //ejecuto la funcion para borrar posibles imagenes dobles del perfil
							 borrar_imagenes($nombre_img,".png");
							break;
					}
					
					}
					else
					{
						//no se reajusta y se sube
					$destino=$ruta.$mail.$extension;

					//Se sube la foto
					move_uploaded_file($imagen,$destino) /*or die("No se pudo subir la imagen")*/;

					//ejecuto la funcion para borrar posibles imagenes dobles para el perfil
					$nombre_img=$ruta.$mail;
					borrar_imagenes($nombre_img,$extension);
					}
					//Asigno el nombre que el que se guardara en la base de datos
					$imagen=$mail.$extension;
					return $imagen;
			}
			else
			{
				return "La imagen".$imagen." No se subio";
			}

	}

	function generateRandomString($length = 10) { 
    	return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
	} 
	function caracteres_especiales($titulo) {

		// Tranformamos todo a minusculas

		$titulo = strtolower($titulo);

		//Rememplazamos caracteres especiales latinos

		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');

		$repl = array('&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;', '&ntilde');

		$titulo = str_replace ($find, $repl, $titulo);

		return $titulo;
	}

	function generarSitemap(){
		//$fecha=date('Y-m-dTH:i:s+00:00');
		$fecha=date("Y-m-d");
		$anoActual=date("Y");
		$sitemapIndiceIni='<?xml version="1.0" encoding="UTF-8"?>
		<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		$sitemapIndiceFin='
			<sitemap>
			    <loc>'.SERVERURL.'sitemap-categoria.xml</loc>
			    <lastmod>'.$fecha.'</lastmod>
			</sitemap>
			<sitemap>
			    <loc>'.SERVERURL.'sitemap-tag.xml</loc>
			    <lastmod>'.$fecha.'</lastmod>
			</sitemap>
		</sitemapindex>';
		$siteCuerpo="";
		for ($i = 2018; $i <= $anoActual; $i++) {
		    $siteCuerpo.='
			<sitemap>
			    <loc>'.SERVERURL.'sitemap-post-'.$i.'.xml</loc>
			    <lastmod>'.$fecha.'</lastmod>
			</sitemap>
			';
		}
		$sitemapIndice=$sitemapIndiceIni.$siteCuerpo.$sitemapIndiceFin;
		$path = "../sitemap.xml";
		$modo = "w+";

		// $nuevoarchivo = fopen('sitemap.xml', "w+");
		// fwrite($nuevoarchivo,$sitemaps);
		// fclose($nuevoarchivo);
		
		if ($fp=fopen($path,$modo))
		{
		   fwrite ($fp,$sitemapIndice);
		   echo "<p><b>Sitemap Indice fue creado correctamente</b>";
		}
		else{ 
		   echo "<p><b>Ocurrió un problema enviando el sitemap</b>";
		}
		/* CREANDO EL SITEMAP POST */
		for ($i = 2018; $i <= $anoActual; $i++) {
		    sitemapPost($i);
		}
		sitemapCategoria();
		sitemapTag();
	}

	function sitemapPost($year){
		$mysqli = call_mysqli();
		/* CREANDO EL SITEMAP POST */
		$sitePostHead='<?xml version="1.0" encoding="UTF-8"?>
		<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		';
		$sql = "SELECT codigo,titulo,url_post,fecha FROM post WHERE YEAR(fecha)='$year' AND publicado='true' ORDER BY codigo";
		$result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
		$sitePostBody="";
		if ($result->num_rows > 0) {
			while($row =$result->fetch_assoc()) {
				$sitePostBody.='
				<url>
					<loc>'.SERVERURL.$row['url_post'].'</loc>
					<lastmod>'.$row['fecha'].'</lastmod>
					<priority>0.8</priority>
				</url>
				';
			}
		}
		$sitePostFooter='</urlset>';
		$sitemapPost=$sitePostHead.$sitePostBody.$sitePostFooter;
		$path = "../sitemap-post-".$year.".xml";
		$modo = "w+";
		if ($fp=fopen($path,$modo))
		{
		   fwrite ($fp,$sitemapPost);
		   echo "<p><b>Sitemap Post fue creado correctamente</b>";
		}
		else{ 
		   echo "<p><b>Ocurrió un problema enviando el sitemap</b>";
		}
	}

	function sitemapCategoria(){
		$mysqli = call_mysqli();
		/* CREANDO EL SITEMAP POST */
		$fecha=date("Y-m-d");
		$siteHead='<?xml version="1.0" encoding="UTF-8"?>
		<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		';
		$sql = "SELECT link FROM categoria ORDER BY `categoria`.`nombre` ASC";
		$result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
		$siteBody="";
		if ($result->num_rows > 0) {
			while($row =$result->fetch_assoc()) {
				$siteBody.='
				<url>
					<loc>'.SERVERURL.'categoria/'.$row['link'].'</loc>
					<lastmod>'.$fecha.'</lastmod>
					<priority>0.6</priority>
				</url>
				';
			}
		}
		$siteFooter='</urlset>';
		$sitemap=$siteHead.$siteBody.$siteFooter;
		$path = "../sitemap-categoria.xml";
		$modo = "w+";
		if ($fp=fopen($path,$modo))
		{
		   fwrite ($fp,$sitemap);
		   echo "<p><b>Sitemap Categoria fue creado correctamente</b>";
		}
		else{ 
		   echo "<p><b>Ocurrió un problema enviando el sitemap</b>";
		}
	}

	function sitemapTag(){
		$mysqli = call_mysqli();
		/* CREANDO EL SITEMAP POST */
		$fecha=date("Y-m-d");
		$siteHead='<?xml version="1.0" encoding="UTF-8"?>
		<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		';
		$sql = "SELECT distinct url FROM tag";
		$result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
		$siteBody="";
		if ($result->num_rows > 0) {
			while($row =$result->fetch_assoc()) {
				$siteBody.='
				<url>
					<loc>'.SERVERURL.'tag/'.$row['url'].'</loc>
					<priority>0.5</priority>
				</url>
				';
			}
		}
		$siteFooter='</urlset>';
		$sitemap=$siteHead.$siteBody.$siteFooter;
		$path = "../sitemap-tag.xml";
		$modo = "w+";
		if ($fp=fopen($path,$modo))
		{
		   fwrite ($fp,$sitemap);
		   echo "<p><b>Sitemap Tag fue creado correctamente</b>";
		}
		else{ 
		   echo "<p><b>Ocurrió un problema enviando el sitemap</b>";
		}
	}

	function sitemap(){
		$mysqli = call_mysqli();
		$fecha=date("Y-m-d");
		/* CREANDO EL SITEMAP POST */
		$sitePostHead='<?xml version="1.0" encoding="UTF-8"?>
		<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		';
		$sql = "SELECT codigo,titulo,url_post,fecha FROM post WHERE publicado='true' ORDER BY codigo DESC";
		$result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
		$siteBody="";
		if ($result->num_rows > 0) {
			while($row =$result->fetch_assoc()) {
				$siteBody.='
				<url>
					<loc>'.SERVERURL.$row['url_post'].'</loc>
					<lastmod>'.$row['fecha'].'</lastmod>
					<priority>0.8</priority>
				</url>
				';
			}
		}
		// Categoria
		$sql = "SELECT link FROM categoria ORDER BY `categoria`.`nombre` ASC";
		$result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
		// $siteBody="";
		if ($result->num_rows > 0) {
			while($row =$result->fetch_assoc()) {
				$siteBody.='
				<url>
					<loc>'.SERVERURL.'categoria/'.$row['link'].'</loc>
					<lastmod>'.$fecha.'</lastmod>
					<priority>0.6</priority>
				</url>
				';
			}
		}
		// Etiquetas
		$sql = "SELECT distinct url FROM tag";
		$result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
		// $siteBody="";
		if ($result->num_rows > 0) {
			while($row =$result->fetch_assoc()) {
				$siteBody.='
				<url>
					<loc>'.SERVERURL.'tag/'.$row['url'].'</loc>
					<priority>0.5</priority>
				</url>
				';
			}
		}
		$sitePostFooter='</urlset>';
		$sitemapPost=$sitePostHead.$siteBody.$sitePostFooter;
		$path = "../sitemap.xml";
		$modo = "w+";
		if ($fp=fopen($path,$modo))
		{
		   fwrite ($fp,$sitemapPost);
		   echo "<p><b>Sitemap Post fue creado correctamente</b>";
		}
		else{ 
		   echo "<p><b>Ocurrió un problema enviando el sitemap</b>";
		}
	}

	function controlCadena($cadena,$filtrando){
		// LIMPIA LA VARIABLE DE POSIBLES INYECIONES SQL
		$mysqli = call_mysqli();
		if ($filtrando==true){
			return str_replace(" ", "%", trim(mysqli_real_escape_string($mysqli,$cadena)));
		}else{
			return trim(mysqli_real_escape_string($mysqli,$cadena));
		}
	}
?>