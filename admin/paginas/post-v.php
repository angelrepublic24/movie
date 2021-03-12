<?php
	$bandera=false;
	$alerta=false;
	$modificado=false;
	$fecha=date("Y-m-d");
	if (!empty($_POST))
	{
		$codigo=controlCadena($_POST['txtCodigo'],false);
		$fecha=controlCadena($_POST['txtFecha'],false);
		$visualizacion=controlCadena($_POST['txtVisualizacion'],false);
		$meGusta=controlCadena($_POST['txtMeGusta'],false);
		$noMegusta=controlCadena($_POST['txtNoMeGusta'],false);
		$titulo=controlCadena($_POST['txtTitulo'],false);
		$tituloOriginal=controlCadena($_POST['txtTituloOriginal'],false);
		$descripcion=controlCadena($_POST['editor1'],false);
		$trailer=controlCadena($_POST['txtTrailer'],false);
		$escritor=controlCadena($_POST['txtEscritor'],false);
		$idiomas=controlCadena($_POST['txtIdioma'],false);
		$valoracion=controlCadena($_POST['txtValoracion'],false);
		$urlImagen=controlCadena($_POST['txtUrlImagen'],false);
		$duracion=controlCadena($_POST['txtDuracion'],false);
		$ano=controlCadena($_POST['txtAno'],false);
		$repartos=controlCadena($_POST['txtReparto'],false);
		$etiquetas=controlCadena($_POST['txtEtiquetas'],false);
		$publicado=controlCadena($_POST['cboPublicado'],false);
		$videoHD=controlCadena($_POST['cboHD'],false);
		$fuente=controlCadena($_POST['cboFuente'],false);
		$urlPeliInfo=controlCadena($_POST['txtUrlFuente'],false);
		$opcion1=controlCadena($_POST['txtOpcion1'],false);
		$opcion2=controlCadena($_POST['txtOpcion2'],false);
		$opcion3=controlCadena($_POST['txtOpcion3'],false);
		$director=controlCadena($_POST['txtDirector'],false);
		$repartosUrl=controlCadena($_POST['txtRepartoUrl'],false);

		//$titulo=trim(mysqli_real_escape_string($mysqli,$_POST['txtTitulo']));
		//$titulo=html_entity_decode($titulo, ENT_QUOTES | ENT_HTML401, "UTF-8");
		$etiquetaLink="";
		$etiqueta=explode(",", $etiquetas);
		$error="";

		$url_imagen="";
		$url_imagen_mini="";
		if (!empty($_FILES))
		{
			echo "entro";
			$files=$_FILES;
		 	$imagenes=$files["imagenes"]["name"];
		 	$errorimg =$files["imagenes"]["error"];
		 	@$tempimg = $files["imagenes"]["tmp_name"];
		 	$typeimg =$files["imagenes"]["type"];

			$j=0;
			$tipos=array("image/jpg","image/jpeg","image/png","image/gif");
	 	
			for ($t=0; $t <count($imagenes) ; $t++) { 
				if($errorimg[$t] == 0)
			 	{
			 		if(in_array($typeimg[$t], $tipos))
			 		{
			 			$k=generateRandomString();
			 			// $k=$j++;
			 			$solonom= str_replace(".jpg", "", $imagenes[$t]);
			 			// $b=rand(20,30);
			 			$se_subio_imagen=subir_imagenes($typeimg[$t],$tempimg[$t],$k,"../subida/",182);
			 		
			 		    // echo $se_subio_imagen."<br>";
			 		    $url_imagen_mini='subida/'.$se_subio_imagen;
			 		}
			 	
			 	}
			 	
			}
		}else{
			echo "Entropooooooo";
		}

		if (!$url_imagen_mini==""){
			$urlImagenMini=$url_imagen_mini;
		}else{
			$urlImagenMini="";
		}
		// if ($url_imagen==""){
		// 	if (!$urlImagen == ""){
		// 		$url_imagen=$urlImagen;
		// 	}
		// }

		if ($titulo == '' && !isset($_GET{'v'}))
		{
			$alerta=true;
			goto a;
		}

		$i=0;
		$sql = "SELECT codigo,nombre FROM categoria";
		$vpBusCategoriaResult=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
		$items[]= array();
		while($vpBusCategoriaRow =$vpBusCategoriaResult->fetch_assoc()) {
			$nombreUnido=str_replace(' ', '', $vpBusCategoriaRow['nombre']);
			$nombreNormal=$vpBusCategoriaRow['nombre'];
			if (isset($_POST[$nombreUnido]))
			{
				$items[$i][0]=$nombreNormal;
				$items[$i][1]='true';
			}else{
				$items[$i][0]=$nombreNormal;
				$items[$i][1]='false';
			}
			$i+=1;
		}

		$urlPost=urls_amigables($titulo);
		$sql = "SELECT * FROM post WHERE `post`.`url_post` = '$urlPost'";
		$resultUrl=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
		$rowUrl =$resultUrl->num_rows;
		if ($rowUrl>0)
		{
			$cont=$rowUrl+$rowUrl;
			$urlPost=$urlPost. '-'. $cont;
		}

		if ($codigo == 0)
		{
			$sql = "INSERT INTO `post`(`codigo`, `fecha`, `titulo`, `url_post`, `tituolo_original`, `descripcion`, `ano`, `escritor`, `trailer`, `duracion`, `valoracion`, `idiomas`, `repartos`, `etiquetas`, `url_peli_info`, `fuente`, `opcion1`, `opcion2`, `opcion3`, `categorias`, `etiqueta_url`, `me_gusta`, `no_me_gusta`, `visualizacion`, `url_imagen`, `director`, `repartos_url`) VALUES (NULL,'$fecha','$titulo','$urlPost','$tituloOriginal','$descripcion','$ano','$escritor','$trailer','$duracion','$valoracion','$idiomas','$repartos','$etiquetas','$urlPeliInfo','$fuente','$opcion1','$opcion2','$opcion3','','','$meGusta','$noMegusta','$visualizacion','$urlImagenMini','$director','$repartosUrl');";
			$result = $mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
			$id_ultimo=$mysqli->insert_id;
		}else{
			if ($urlImagenMini=="")
			{
				$sql = "UPDATE `post` SET `fecha`='$fecha',`titulo`='$titulo',`tituolo_original`='$tituloOriginal',`descripcion`='$descripcion',`ano`='$ano',`escritor`='$escritor',`trailer`='$trailer',`duracion`='$duracion',`valoracion`='$valoracion',`idiomas`='$idiomas',`repartos`='$repartos',`etiquetas`='$etiquetas',`url_peli_info`='$urlPeliInfo',`fuente`='$fuente',`opcion1`='$opcion1',`opcion2`='$opcion2',`opcion3`='$opcion3',`me_gusta`='$meGusta',`no_me_gusta`='$noMegusta',`visualizacion`='$visualizacion',`director`='$director',`repartos_url`='$repartosUrl' WHERE codigo='$codigo'";
			}else{
				$sql = "UPDATE `post` SET `fecha`='$fecha',`titulo`='$titulo',`tituolo_original`='$tituloOriginal',`descripcion`='$descripcion',`ano`='$ano',`escritor`='$escritor',`trailer`='$trailer',`duracion`='$duracion',`valoracion`='$valoracion',`idiomas`='$idiomas',`repartos`='$repartos',`etiquetas`='$etiquetas',`url_peli_info`='$urlPeliInfo',`fuente`='$fuente',`opcion1`='$opcion1',`opcion2`='$opcion2',`opcion3`='$opcion3',url_imagen='$urlImagenMini',`me_gusta`='$meGusta',`no_me_gusta`='$noMegusta',`visualizacion`='$visualizacion',`director`='$director',`repartos_url`='$repartosUrl' WHERE codigo='$codigo'";
			}
			$result = $mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
		}
		// Actualiza las Tags
		if (isset($_GET{'v'})){
			$veli=$_GET['v']+0;
			$sql = "DELETE FROM `tag` WHERE `tag`.`cod_post` = '$veli'";
			$resultTag=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
			$id_ultimo=$veli;
		}
		foreach($etiqueta as $tags) {
			$tags=trim($tags);
			$ulrTag=urls_amigables($tags);
			$sql = "INSERT INTO `tag` (`codigo`, `cod_post`, `nombre`, `url`) VALUES (NULL, '$id_ultimo', '$tags', '$ulrTag')";
			$resultTag = $mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
			if ($etiquetaLink==""){
				$etiquetaLink=$ulrTag;
			}else{
				$etiquetaLink=$etiquetaLink." ".$ulrTag;
			}
		}
		// Actualiza las Categrorias
		if (isset($_GET{'v'}))
		{
			$veli=$_GET['v']+0;
			$sql = "DELETE FROM `post_categoria` WHERE `post_categoria`.`cod_post` = '$veli'";
			$result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
			$id_ultimo=$veli;
		}
		$categoriaTodas="";
		foreach ($items as list($a, $b)) {
			# code...
			$sql = "INSERT INTO `post_categoria` (`codigo`, `cod_post`, `nombre`, `seleccionado`) VALUES (NULL, '$id_ultimo', '$a', '$b')";
			$result = $mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
			if ($categoriaTodas==""){
				$categoriaTodas=$a;
			}else{
				$categoriaTodas=$categoriaTodas.', '.$a;
			}
		}
		$categoriaTodas=trim($categoriaTodas);
		$sql ="UPDATE post SET categorias='$categoriaTodas',etiqueta_url='$etiquetaLink' WHERE codigo='$id_ultimo'";
		$result = $mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
		// Generando el SITEMAP
		sitemap();
		// Esto es para controlar el error que da despues de guardar los datos
		if ($codigo>0) {
			$veli=$_GET['v']+0;
			$sql = "SELECT * FROM post WHERE `post`.`codigo` = '$veli'";
			$result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
			$vrow =$result->fetch_assoc();
			$bandera=true;
			goto a;
		}
		if ($result>0) {
			$bandera=true;
		}else {
			$error="Error al registrar!";
		}
		a:
	}elseif (isset($_GET{'v'}))
	{
		$veli=$_GET['v']+0;
		$sql = "SELECT * FROM post WHERE `post`.`codigo` = '$veli'";
		$result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
		$vrow =$result->fetch_assoc();
	}
	// $sql = "SELECT codigo,nombre FROM paginas";
	// $paginasResult=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");

	$sql = "SELECT codigo,nombre FROM categoria ORDER BY nombre";
	$vpCategoriaResult=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
	// $sql = "SELECT codigo,CONCAT(nombre,  ' ', apellido) as nombre FROM user_admin WHERE tipo_user='2'";
	// $usresult=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
?>
<!-- <div class="alert alert-warning" role="alert">
	<strong>Atención!</strong> Debes llenar el Título.
</div> -->
<script>
  function Scraping(){
        var urlPagina=document.getElementById("txtUrlFuente").value;
        var pagina=document.getElementById("cboFuente").value;
        var parametros = {
        "urlPagina" : urlPagina,
        "pagina" : pagina
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'paginas/postf.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#infoPeli").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#infoPeli").html(response);
                }
        });
    }
</script>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<div class="container-fluid py-2">
	<div class="card card-dark">
	    <div class="card-header">
	      	<h3 class="card-title">Fuente de los Metadatos</h3>
	    </div>
	    <!-- /.card-header -->
	    <!-- form start -->
	    <div class="card-body row">
	        <div class="col-12 stats-col">
	          	<div class="form-group">
	            	<label for="exampleInputEmail1">Url de la pagina</label>
	            	<input type="text" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['url_peli_info']) : ''; ?>" class="form-control" id="txtUrlFuente" name="txtUrlFuente" placeholder="Fuente del Scraping">
	          	</div>
	        </div>
	        <div class="col col-xs-12 col-sm-8 col-md-9 col-xl-9 stats-col">
	          	<div class="form-group">
	            	<label for="formGroupExampleInput5">Fuente</label>
	            	<select id="cboFuente" name="cboFuente" class="form-control">
		              	<option value="https://www.imdb.com/">IMDB</option>
		              	<?php
		              	//   if ($paginasResult->num_rows > 0) {
		              	//     // output data of each row
		              	//     while($paginasRow =$paginasResult->fetch_assoc()) {
		              	//       if (utf8_decode($vrow['pagina'])==utf8_decode($paginasRow['nombre']))
		              	//       {
		              	//         echo "<option value='".utf8_decode($paginasRow['codigo'])."' selected>".utf8_decode($paginasRow['nombre'])."</option>";
		              	//       }else{
		              	//         echo "<option value='".utf8_decode($paginasRow['codigo'])."'>".utf8_decode($paginasRow['nombre'])."</option>";
		              	//       }
		              	//     }
		              	// }
		            	?>
	            	</select>
	          	</div>
	        </div>
	        <div class="col col-xs-12 col-sm-4 col-md-3 col-xl-3 stats-col">
	          	<div class="form-group">
	            	<label for="formGroupExampleInput2"></label>
	            	<button onclick="Scraping();" type="button" name="btoVideo" class="btn btn-primary btn-block"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Buscar Pelicula</button>
	          	</div>
	        </div>
	    </div>
	</div>

	<div class="card card-dark">
	    <div class="card-body row">
	      	<div class="col col-xs-12 col-sm-12 col-md-9 col-xl-9 stats-col row">
	        	<div class="col col-xs-12 col-sm-4 col-md-4 col-xl-4 stats-col">
	          		<div class="form-group">
	            		<label for="exampleInputEmail1">Código</label>
	            		<input type="number" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['codigo']) : ''; ?>" class="form-control" id="txtCodigo" name="txtCodigo" readonly>
	          		</div>
	        	</div>
	        	<div class="col col-xs-12 col-sm-4 col-md-4 col-xl-4 stats-col">
	          		<div class="form-group">
	            		<label for="formGroupExampleInput2">Fecha</label>
	            		<input class="form-control" name="txtFecha" type="date" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['fecha']) : $fecha; ?>" id="txtFecha" style="font-size: 15px;">
	          		</div>
	        	</div>
	        	<div class="col col-xs-12 col-sm-4 col-md-4 col-xl-4 stats-col">
	          		<div class="form-group">
	            		<label for="exampleInputEmail1">Visualización</label>
	            		<input type="number" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['visualizacion']) : ''; ?>" class="form-control" id="txtVisualizacion" name="txtVisualizacion">
	          		</div>
	        	</div>
	        	<div class="col col-xs-6 col-sm-6 col-md-6 col-xl-6 stats-col">
			        <div class="form-group">
			          	<label for="formGroupExampleInput3" class='fa fa-thumbs-up' aria-hidden='true'> Me Gustas</label>
			          	<input type="text" class="form-control" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['me_gusta']) : ''; ?>" id="txtMeGusta" name="txtMeGusta" placeholder="Cantidad de Me Gusta">
			        </div>
			    </div>
	        	<div class="col col-xs-6 col-sm-6 col-md-6 col-xl-6 stats-col">
			        <div class="form-group">
			          	<label for="formGroupExampleInput3" class='fa fa-thumbs-down' aria-hidden='true'> No Me Gustas</label>
			          	<input type="text" class="form-control" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['no_me_gusta']) : ''; ?>" id="txtNoMeGusta" name="txtNoMeGusta" placeholder="Cantidad de No Me Gusta">
			        </div>
			    </div>
			    <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col">
			        <div class="form-group">
				    	<label for="formGroupExampleInput3">Url de la imagen</label>
				    	<input type="text" class="form-control" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['url_imagen']) : ''; ?>" name="txtUrlImagen" placeholder="Url de la imagina">
				  	</div>
			    </div>
			    <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col">
			        <div class="form-group">
			          	<label for="formGroupExampleInput3">Título</label>
			          	<input type="text" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['titulo']) : ''; ?>" class="form-control" id="txtTitulo" name="txtTitulo">
			        </div>
			    </div>
	    	</div>
	  		<div class="col col-xs-12 col-sm-12 col-md-3 col-xl-3 stats-col row" style="text-align: center;">
	    		<div class="form-group" style="margin:0px auto;">
	    			<img src="<?php echo (isset($_GET{'v'})) ? '../'.$vrow['url_imagen'] : ''; ?>" alt="..." class="img-thumbnail">
	    		</div>
		    	<div class="form-group">
		      		<label for="">Seleccione Imagen Destacada</label>
		      		<input type="file" name="imagenes[]" class="form-control" id="" placeholder="Input field" multiple>
		    	</div>
	  		</div>
		    <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col">
		        <div class="form-group">
		          	<label for="exampleInputEmail1">Url Post</label>
		          	<input type="number" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['url_post']) : ''; ?>" class="form-control" id="txtUrlPost" name="txtUrlPost" readonly>
		        </div>
		    </div>
		    <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col">
		        <div class="form-group">
		          	<textarea name="editor1" id="editor1" rows="10" cols="80">
		            <?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['descripcion']) : ''; ?>
		          	</textarea>
		          	<script>
		            	// Replace the <textarea id="editor1"> with a CKEditor
		            	// instance, using default configuration.
		            	CKEDITOR.replace( 'editor1' );
		          	</script>
		        </div>
		    </div>
		    <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col">
		        <div class="form-group">
		          	<label for="exampleInputEmail1">Url Trailer YouTube</label>
		          	<input type="text" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['trailer']) : ''; ?>" class="form-control" id="txtTrailer" name="txtTrailer">
		        </div>
		    </div>
		    <div id="infoPeli" class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col row">
		    	<div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col">
			        <div class="form-group">
			          	<label for="exampleInputEmail1">Título Original</label>
			          	<input type="text" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['tituolo_original']) : ''; ?>" class="form-control" id="txtTituloOriginal" name="txtTituloOriginal">
			        </div>
			    </div>
			    <div class="col col-xs-12 col-sm-12 col-md-4 col-xl-4 stats-col">
			        <div class="form-group">
			          	<label for="exampleInputEmail1">Escritor</label>
			          	<input type="text" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['escritor']) : ''; ?>" class="form-control" id="txtEscritor" name="txtEscritor">
			        </div>
			    </div>
			    <div class="col col-xs-12 col-sm-12 col-md-4 col-xl-4 stats-col">
			        <div class="form-group">
			          	<label for="exampleInputEmail1">Idiomas</label>
			          	<input type="text" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['idiomas']) : ''; ?>" class="form-control" id="txtIdioma" name="txtIdioma">
			        </div>
			    </div>
			    <div class="col col-xs-12 col-sm-12 col-md-4 col-xl-4 stats-col">
			        <div class="form-group">
			          	<label for="exampleInputEmail1">Valoración ★★★★★</label>
			          	<input type="text" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['valoracion']) : ''; ?>" class="form-control" id="txtValoracion" name="txtValoracion">
			        </div>
			    </div>
			    <div class="col col-xs-6 col-sm-4 col-md-4 col-xl-4 stats-col">
		      		<div class="form-group">
		        		<label for="exampleInputEmail1">Duración</label>
		        		<input type="text" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['duracion']) : ''; ?>" class="form-control" id="txtDuracion" name="txtDuracion">
		      		</div>
		    	</div>
			    <div class="col col-xs-6 col-sm-4 col-md-4 col-xl-4 stats-col">
		          	<div class="form-group">
		            	<label for="exampleInputEmail1">Año</label>
		            	<input type="number" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['ano']) : ''; ?>" class="form-control" id="txtAno" name="txtAno">
		          	</div>
		        </div>
		        <div class="col col-xs-12 col-sm-4 col-md-4 col-xl-4 stats-col">
			        <div class="form-group">
			          	<label for="exampleInputEmail1">Director</label>
			          	<input type="text" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['director']) : ''; ?>" class="form-control" id="txtDirector" name="txtDirector">
			        </div>
			    </div>
		        <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col">
			        <div class="form-group">
			          	<label for="exampleInputEmail1">Reparto</label>
			          	<input type="text" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['repartos']) : ''; ?>" class="form-control" id="txtReparto" name="txtReparto">
			        </div>
			    </div>
			    <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col" style="display: none">
				    <div class="form-group">
				        <label>Reparto Url</label>
				        <textarea name="txtRepartoUrl" class="form-control" rows="5" id="txtRepartoUrl"><?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['reparto_url']) : ''; ?></textarea>
				    </div>
				</div>
		    </div>
		    
	    <div class="col col-xs-12 col-sm-6 col-md-6 col-xl-6 stats-col">
	        <div class="form-group">
	          	<label for="casa">Categoría</label>
	          	<div class="px-2" style="overflow-y: scroll; height: 197px; -webkit-border-radius: 5px 10px; -moz-border-radius: 5px 10px; background-color: #EAEDED;">
	            <?php
	              if ($vpCategoriaResult->num_rows > 0) {
	                // output data of each row
	                if (isset($_GET{'v'}))
	                {
	                  $sql = "SELECT codigo,nombre,seleccionado FROM post_categoria WHERE cod_post = '$veli' UNION SELECT codigo,nombre,'false' as seleccionado FROM categoria WHERE not exists (select 1 from post_categoria where post_categoria.nombre = categoria.nombre AND post_categoria.cod_post = '$veli')";
	                    //$sql = "SELECT codigo,nombre,seleccionado FROM post_categoria WHERE cod_post = '$veli'";
	                $PostCategoriaResult=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
	                while($vpPostCategoriaRow =$PostCategoriaResult->fetch_assoc()) { ?>
	                	<div class="form-group">
		                    <label class="form-check-label list-tag">
		                      <?php
		                        $nombreUnido=str_replace(' ', '', $vpPostCategoriaRow['nombre']);
		                        if ($vpPostCategoriaRow['seleccionado']=="true"){
		                          echo "<input name='".$nombreUnido."' value='".$nombreUnido."' type='checkbox' class='form-check-input chk-tag' checked='checked'>";
		                          echo " ",$vpPostCategoriaRow['nombre'];
		                        }else{
		                          echo "<input name='".$nombreUnido."' value='".$nombreUnido."' type='checkbox' class='form-check-input chk-tag'>";
		                          echo " ",$vpPostCategoriaRow['nombre'];
		                        }
		                        
		                      ?>
		                    </label>
	                	</div>
	                <?php }
	                }else{
	                  while($vpCategoriaRow =$vpCategoriaResult->fetch_assoc()) { ?>
	                    <div class="form-group">
	                      <label style="width: 100%;" class="form-check-label list-tag">
	                        <?php
	                          $nombreUnido=str_replace(' ', '', $vpCategoriaRow['nombre']);
	                          echo "<input name='".$nombreUnido."' value='".$nombreUnido."' type='checkbox' class='form-check-input chk-tag'>";
	                          echo " ",$vpCategoriaRow['nombre'];
	                        ?>
	                      </label>
	                    </div>
	                  <?php }
	                } 
	            }
	          ?>
	          </div>
	        </div>
	    </div>
	    <?php
	        // SESSION DE TAGS
	        $codPostTag="";
	        if (isset($_GET{'v'})){
	          	$codPostTag=$_GET['v']+0;
	        }else{
	          	$codPostTag=0;
	        }
	        $sql = "SELECT * FROM tag WHERE `tag`.`cod_post` = '$codPostTag'";
	        $resultEtiSelect=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
	        $tagSelec="";
	        if ($resultEtiSelect->num_rows > 0) {
	          	// output data of each row
	          	while($rowEtiSelect =$resultEtiSelect->fetch_assoc()) {
	            	if ($tagSelec==""){
	              		$tagSelec .=$rowEtiSelect['nombre'];
	            	}else{
	              		$tagSelec .=",".$rowEtiSelect['nombre'];
	            	}
	              
	          	}
	        }
	    ?>
		    <div class="col col-xs-12 col-sm-6 col-md-6 col-xl-6 stats-col">
		        <div class="form-group">
		          	<label for="comment">Etiqueta</label>
		          	<textarea name="txtEtiquetas" id="txtEtiquetas" class="form-control" rows="8"><?php echo $tagSelec; ?></textarea>
		        </div>
		    </div>
		    <div class="col col-xs-12 col-sm-6 col-md-6 col-xl-6 stats-col">
		        <div class="form-group">
		          	<label for="formGroupExampleInput5">Estado del Post</label>
		          	<select name="cboPublicado" id="cboPublicado" class="form-control">
		            <?php
		              if (isset($_GET{'v'})){
		                if (utf8_decode($vrow['publicado'])=="true"){ ?>
		                  <option value="true" selected>Publicado</option>
		                  <option value="false">Borrador</option>
		                <?php }else{ ?>
		                  <option value="true">Publicado</option>
		                  <option value="false" selected>Borrador</option>
		                <?php }
		              }else{ ?>
		                <option value="true">Publicado</option>
		                <option value="false">Borrador</option>
		              <?php }
		            ?>
		          </select>
		        </div>
		    </div>
		    <div class="col col-xs-12 col-sm-6 col-md-6 col-xl-6 stats-col">
		        <div class="form-group">
		          	<label for="formGroupExampleInput5">¿Vídeo en HD?</label>
		          	<select name="cboHD" id="cboHD" class="form-control">
			            <?php
			              if (isset($_GET{'v'})){
			                if (utf8_decode($vrow['video_hd'])=="true"){ ?>
			                  	<option value="false">No</option>
			                  	<option value="true" selected>Si</option>
			                <?php }else{ ?>
			                  	<option value="false" selected>No</option>
			                  	<option value="true">Si</option>
			                <?php }
			              	}else{ ?>
			                	<option value="false">No</option>
			                	<option value="true">Si</option>
			              	<?php }
			            ?>
		          	</select>
		        </div>
		    </div>
		    <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col">
		        <div class="form-group">
		          	<label for="exampleInputEmail1">Opción 1</label>
		          	<input type="text" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['opcion1']) : ''; ?>" class="form-control" id="txtOpcion1" name="txtOpcion1">
		        </div>
		    </div>
		    <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col">
		        <div class="form-group">
		          	<label for="exampleInputEmail1">Opción 2</label>
		          	<input type="text" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['opcion2']) : ''; ?>" class="form-control" id="txtOpcion2" name="txtOpcion2">
		        </div>
		    </div>
		    <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col">
		        <div class="form-group">
		          	<label for="exampleInputEmail1">Opción 3</label>
		          	<input type="text" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($vrow['opcion3']) : ''; ?>" class="form-control" id="txtOpcion3" name="txtOpcion3">
		        </div>
		    </div>
		</div>
		<div class="card-footer">
		  	<button type="button" onclick="window.location.href='?p=post'" class="btn btn-dark">Atras</button>
		  	<button type="button" onclick="window.location.href='?p=post-v'" class="btn btn-dark">Nuevo</button>
		  	<button type="submit" class="btn btn-dark">Guardar</button>
		</div>
	</div>
</div>
</form>
<?php 
if ($bandera) { 
     // echo "<script language=\"javascript\">
     //   	window.location.href=\"?p=post-v&v=".$codigo."\";
     // </script>";
}
else { ?>
  <br/>
  <div style="font-size: 16px; color: #cc0000;">
      	<?php 
          	if (isset($error))
          	{
            	echo "$error";
          	}else{
             	echo "";
          	}
      	?> 
  </div>
<?php } ?>