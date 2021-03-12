<?php
	session_start();
    //$vgEmail=$_SESSION['email'];
    require('../assets/function/conexion.php');
    include_once '../assets/function/imdb.class.php';
    $mysqli = call_mysqli();
	//error_reporting(0);
    $urlPagina=controlCadena($_POST['urlPagina'],false);
    $pagina=controlCadena($_POST['pagina'],false);
	$oIMDB = new IMDB($urlPagina);
	if ($oIMDB->isReady) {
    	$encontrado=true;
	} else {
	    $encontrado=false;
	}

?>
<div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col">
    <div class="form-group">
      	<label for="exampleInputEmail1">Título Original</label>
      	<input type="text" value="<?php echo ($encontrado==true) ? $oIMDB->getTitle() : ''; ?>" class="form-control" id="txtTituloOriginal" name="txtTituloOriginal">
    </div>
</div>
<div class="col col-xs-12 col-sm-12 col-md-4 col-xl-4 stats-col">
    <div class="form-group">
      	<label for="exampleInputEmail1">Escritor</label>
      	<input type="text" value="<?php echo ($encontrado==true) ? $oIMDB->getWriter() : ''; ?>" class="form-control" id="txtEscritor" name="txtEscritor">
    </div>
</div>
<div class="col col-xs-12 col-sm-12 col-md-4 col-xl-4 stats-col">
    <div class="form-group">
      	<label for="exampleInputEmail1">Idiomas</label>
      	<input type="text" value="<?php echo ($encontrado==true) ? $oIMDB->getLanguage() : ''; ?>" class="form-control" id="txtIdioma" name="txtIdioma">
    </div>
</div>
<div class="col col-xs-12 col-sm-12 col-md-4 col-xl-4 stats-col">
    <div class="form-group">
      	<label for="exampleInputEmail1">Valoración ★★★★★</label>
      	<input type="text" value="<?php echo ($encontrado==true) ? $oIMDB->getVotes() : ''; ?>" class="form-control" id="txtValoracion" name="txtValoracion">
    </div>
</div>
<div class="col col-xs-6 col-sm-4 col-md-4 col-xl-4 stats-col">
		<div class="form-group">
		<label for="exampleInputEmail1">Duración</label>
		<input type="text" value="<?php echo ($encontrado==true) ? $oIMDB->getRuntime() : ''; ?>" class="form-control" id="txtDuracion" name="txtDuracion">
		</div>
</div>
<div class="col col-xs-6 col-sm-4 col-md-4 col-xl-4 stats-col">
  	<div class="form-group">
    	<label for="exampleInputEmail1">Año</label>
    	<input type="number" value="<?php echo ($encontrado==true) ? $oIMDB->getYear() : ''; ?>" class="form-control" id="txtAno" name="txtAno">
  	</div>
</div>
<div class="col col-xs-12 col-sm-4 col-md-4 col-xl-4 stats-col">
    <div class="form-group">
      	<label for="exampleInputEmail1">Director</label>
      	<input type="text" value="<?php echo ($encontrado==true) ? $oIMDB->getWriter() : ''; ?>" class="form-control" id="txtDirector" name="txtDirector">
    </div>
</div>
<div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col">
    <div class="form-group">
      	<label for="exampleInputEmail1">Reparto</label>
      	<input type="text" value="<?php echo ($encontrado==true) ? $oIMDB->getCast() : ''; ?>" class="form-control" id="txtReparto" name="txtReparto">
    </div>
</div>
<div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col" style="display: none">
    <div class="form-group">
        <label>Reparto Url</label>
        <textarea name="txtRepartoUrl" class="form-control" rows="5" id="txtRepartoUrl"><?php echo ($encontrado==true) ? $oIMDB->getCastAsUrl() : ''; ?></textarea>
    </div>
</div>