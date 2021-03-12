<?php
    $urlVideoCompleta=explode("/", $_GET['p']);
    $veli =$urlVideoCompleta[1];
    if ($veli==""){
        echo "<script language=\"javascript\">
                    window.location.href='".SERVERURL."';
                </script>";
        exit();
    }
    $urlVideoCompleta=explode("/", $_GET['p']);
    $veli =$urlVideoCompleta[1];
?>
<script>
    var flag=20;
    
    function showDetailsScroll() {
        flag +=20;
        $.ajax({
            type : 'POST',
            url : '<?php echo SERVERURL; ?>'+'paginas/get_data.php?offset=0&limit='+flag,
            data : flag,
            
            success : function(resp) {
                $("#details").html(resp);
            },
        });
        return false;
    }
</script>
<form method="post">
<div id="details">
    <?php
        $limit=20;
        $listado_Post=0;

        $sql = "SELECT COUNT(*) AS cantidad FROM post WHERE `post`.`publicado`='true' ORDER BY codigo DESC";
        $resultCant=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
        $rowCant=$resultCant->fetch_assoc();
        $paginas=ceil($rowCant['cantidad']/$limit);
        //$paginas=10;
        $paginasFinal=$veli+8;
        if ($veli>$paginas){
             echo "<script language=\"javascript\">
                    window.location.href='".SERVERURL."';
                </script>";
            exit();
        }
        if ($veli+8>$paginas){
            $paginasFinal=$paginas;
        }
        $articuloInicio=($veli-1)*$limit;
        $articuloFinal=$veli*$limit;
         $sql = "SELECT * FROM post WHERE `post`.`publicado`='true' ORDER BY codigo DESC LIMIT $articuloInicio,$limit";
        $resultPost=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
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
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php
                if ($veli==2){ ?>
                    <li class="page-item">
                        <a class="page-link paginas" href="<?php echo SERVERURL; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
            <?php    }else{ ?>
                    <li class="page-item disable <?php echo($veli<=1) ? 'disable' : ''; ?>">
                        <a class="page-link paginas" href="<?php echo SERVERURL.'page/'.strval($veli-1); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
            <?php   }
            ?>
            
            <?php
                $i=$veli-1;
                while ($i < $paginasFinal) {
                    if ($i!=0){
                        $link='href="'.SERVERURL.'page/'.strval($i+1).'"';
                    }elseif ($i==0){
                        $link='href="'.SERVERURL.'"';
                    }
            ?>
            <li class="page-item <?php echo($i+1==$veli) ? 'active' : ''; ?>"><a class="page-link paginas" <?php echo $link; ?>><?php echo $i+1; ?></a></li>
            <?php $i++; } ?>

            <li class="page-item <?php echo($veli>=$paginasFinal) ? 'disabled' : ''; ?>">
                <a class="page-link paginas" href="<?php echo SERVERURL,'page/',$veli+1; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
</form>