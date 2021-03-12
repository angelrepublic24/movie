<script>
    var flag=20;

    function showDetailsScroll(){
    	flag +=20;
        var offset=0;
        var parametros = {
        "offset" : offset,
        "limit" : flag
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'paginas/details.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#details").html(response);
                }
        });
        return false;
    }
</script>
<form method="post">
<div id="details">
	<?php
        $limit=20;
        $offset=0;
        $articulo_x_paginas=20;
        $listado_Post=0;
        $sql = "SELECT * FROM post WHERE `post`.`publicado`='true' ORDER BY codigo DESC LIMIT {$limit} OFFSET {$offset}";
        //$sql = "SELECT * FROM post WHERE `post`.`publicado`='true' ORDER BY codigo DESC LIMIT {$limit} OFFSET {$offset}";
        $resultPost=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
        //$listado_Post=$resultPost->num_rows;


        $sql = "SELECT COUNT(*) AS cantidad FROM post WHERE `post`.`publicado`='true' ORDER BY codigo DESC";
        $resultCant=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
        $rowCant=$resultCant->fetch_assoc();
        $paginas=ceil($rowCant['cantidad']/$articulo_x_paginas);
        $paginas=10;
    ?>
	<section class="accion">
		<div class="container contenedorPost">
			<div class="row my-3 py-2">
				<div class="col-md-6">
					<h3 class="text-left tituloContenedor">Ultimas peliculas subidas</h3>
				</div>	
				<div class="col-md-6">
					<!-- <div class="offset-11">
						<a href="#" class="verMas btn btn-outline-light" alt="Ver mas">+</a>
					</div> -->
				</div>
			</div>
			<div class="row my-3">
				<?php
					if ($resultPost->num_rows > 0) {
						while($rowPost =$resultPost->fetch_assoc()) {
							miniatura($rowPost['titulo'],$rowPost['descripcion'],SERVERURL.$rowPost['url_imagen'],SERVERURL.$rowPost['url_post']);
						}
					}
				?>
			</div>
		</div>
	</section>
	<section class="sig container">
		<nav aria-label="Page navigation example">
	        <ul class="pagination justify-content-center">
	            <?php
	                $i=0;
	                while ($i < $paginas) {
	                    if ($i!=0){
	                        $link='href="'.SERVERURL.'page/'.strval($i+1).'"';
	                    }elseif ($i==0){
	                        $link='href="'.SERVERURL.'"';
	                    }
	            ?>
	            <li class="page-item <?php echo($i==0)? 'active' : ''; ?>"><a class="page-link paginas"  <?php echo $link; ?>><?php echo $i+1; ?></a></li>
	            <?php $i++; } ?>

	            <li class="page-item">
	                <a class="page-link paginas" href="<?php echo SERVERURL,'page/'; ?>2" aria-label="Next">
	                    <span aria-hidden="true">&raquo;</span>
	                </a>
	            </li>
	        </ul>
	    </nav>
	</section>
</div>
</form>