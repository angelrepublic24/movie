<?php
    $urlVideoCompleta=explode("/", $_GET['p']);
    $veli =$urlVideoCompleta[1];
    if ($veli==""){
        echo "<script language=\"javascript\">
                    window.location.href='".SERVERURL."';
                </script>";
    }
    $urlVideoCompleta=explode("/", $_GET['p']);
    $veli =$urlVideoCompleta[1];
?>
<form method="post">
<div id="details">
<?php
    $limit=18;
    $offset=0;
    $urlCategoria=explode("/", $_GET['p']);
    $veli=$urlCategoria[1];

    // AQUI VERIFICAMOS LA INFORMACION DE LA ETIQUETA
    
    // HASTA AQUI TERMINA ESTE CODIGO
    $sql = "SELECT `post`.* FROM `post` WHERE `post`.`etiqueta_url` LIKE '%$veli%' AND `post`.`publicado`='true' ORDER BY codigo DESC LIMIT {$limit} OFFSET {$offset}";
    $resultRelecionados=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
    $totalResul = $resultRelecionados->num_rows;
    if ($resultRelecionados->num_rows > 0) {
        // ASIGNAMOS EL TOTAL DE RESULTADOS
        $countTagTitulo = $totalResul;
?>
<section class="accion">
    <div class="container contenedorPost">
        <div class="row my-3 py-2">
            <div class="col-md-6">
                <h3 class="text-left tituloContenedor"><strong><?php echo $rowTagHead['nombre']; ?></strong> - <?php echo $countTagTitulo; ?> resultados</h3>
            </div>  
            <div class="col-md-6">
                <!-- <div class="offset-11">
                    <a href="#" class="verMas btn btn-outline-light" alt="Ver mas">+</a>
                </div> -->
            </div>
        </div>
        <div class="row my-3">
            <?php
                while($rowRelacionados =$resultRelecionados->fetch_assoc()) {
                    miniatura($rowRelacionados['titulo'],$rowRelacionados['descripcion'],SERVERURL.$rowRelacionados['url_imagen'],SERVERURL.$rowRelacionados['url_post']);
                }
            ?>
        </div>
    </div>
</section>
<?php } ?>
</div>
</form>