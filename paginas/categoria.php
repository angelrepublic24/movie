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
<script>
    var flag=18;
    
    function showDetailsScroll() {
        flag +=18;
        var link="<?php echo $veli; ?>";
        $.ajax({
            type : 'POST',
            url : '<?php echo SERVERURL; ?>'+'paginas/categoria-data.php?offset=0'+'&categoria='+link+'&limit='+flag,
            data : flag,
            
            success : function(resp) {
                $("#details").html(resp);
            },
        });
        return false;
    }
</script>
<?php
    $limit=18;
    $offset=0;
    $urlCategoria=explode("/", $_GET['p']);
    $veli=$urlCategoria[1];
    //$urlCategoria=explode("/", $_GET['p']);
    //$veli =$urlCategoria;

    $sql = "SELECT codigo,nombre,descripcion FROM categoria WHERE `categoria`.`link` = '$veli'";
    $result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
    $row =$result->fetch_assoc();
    $Categoria=$row['nombre'];

    $sql = "SELECT
      `post`.*, `post_categoria`.`nombre` AS nombre_categoria,
      `post_categoria`.`seleccionado`
    FROM
      `post` INNER JOIN
      `post_categoria` ON `post`.`codigo` = `post_categoria`.`cod_post` WHERE `post_categoria`.`seleccionado`='true' AND `post_categoria`.`nombre`='$Categoria' AND `post`.`publicado`='true' ORDER BY codigo DESC LIMIT {$limit} OFFSET {$offset}";
    $resultRelecionados=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");

    if ($resultRelecionados->num_rows > 0) {
        $sql = "SELECT nombre FROM categoria WHERE `categoria`.`link` = '$veli'";
        $resultTagTitulo=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
        $rowTagTitulo =$resultTagTitulo->fetch_assoc();
        $countTagTitulo = $resultRelecionados->num_rows;
?>
<section class="accion">
    <div class="container contenedorPost">
        <div class="row my-3 py-2">
            <div class="col-md-6">
                <h3 class="text-left tituloContenedor"><strong><?php echo $rowTagTitulo['nombre']; ?></strong> - <?php echo $countTagTitulo; ?> resultados</h3>
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