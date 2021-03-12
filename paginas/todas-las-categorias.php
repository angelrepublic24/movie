<?php
    $sql = "SELECT nombre,link,imagen FROM categoria ORDER BY nombre ASC";
  	$resultCatMenu=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
?>

<section class="accion">
	<div class="container contenedorPost">
		<div class="row my-3 py-2">
			<div class="col-md-6">
				<h3 class="text-left tituloContenedor">Todas las Categorias</h3>
			</div>	
			<div class="col-md-6">
			</div>
		</div>
		<div class="row my-3">
			<?php
				if ($resultCatMenu->num_rows > 0) {
					while($rowCatMenu =$resultCatMenu->fetch_assoc()) { ?>
			    		<div class='py-1 col-6 col-xs-6 col-sm-6 col-md-4 col-xl-3 stats-col cat-select' style='padding-right: 3px; padding-left: 3px;'>
				      		<a href="<?php echo SERVERURL,'categoria/',utf8_decode($rowCatMenu['link']); ?>" class="categoriaMenuIzq" title="<?php echo $rowCatMenu['nombre']; ?>">
					      		<div>
					        		<img style="width: 100%" class="d-flex mr-3" src="<?php echo $rowCatMenu['imagen']; ?>" alt="<?php echo $rowCatMenu['nombre']; ?>">
					      		</div>
				      			<div style="text-align: center;">
				        			<h2 style="font-size: 1.3rem;"><?php echo $rowCatMenu['nombre']; ?></h2>
				      			</div>
				      		</a>
				      	</div>
			    <?php }
				}
			?>
		</div>
	</div>
</section>