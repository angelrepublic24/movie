<?php
    $urlVideoCompleta=explode("/", $_GET['p']);
    $veli =$urlVideoCompleta[0];
    
    $etiquetas=explode(",", utf8_decode($rowHead['etiquetas']));

    // CODIGO EMBED A TODOS
    $cadenaLink=str_replace("https://www.youtube.com/watch?v=","",$rowHead['trailer']);
    $cadenaLink=str_replace("video","",$cadenaLink);
    $codEmbe="";
    for($i=0;$i<strlen($cadenaLink);$i++){
        $codEmbeTemp = substr($cadenaLink,$i,1); 
        if ($codEmbeTemp=="/"){
            break;
        }
        $codEmbe =$codEmbe.substr($cadenaLink,$i,1);
    }
    $embed="<iframe width='100%' height='315' src='https://www.youtube.com/embed/".$codEmbe."' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
?>
<div class="movies-posted">
    <div class="container contenedorPost py-3">
        <div class="row my-3">
            <div class="col-md-3">
                <img class="img_miniatura" src="<?php echo $rowHead['url_imagen']; ?>">
                <!-- <a href="" class=" offset-4 btn btn-outline-warning my-3 justify-content-center">Ver Trailer</a> -->
            </div>
            <div class="col peliDescripcion">
                <h3 style="color: burlywood;" class="title"><?php echo $rowHead['titulo']; ?></h3>
                <p class="year">Año: <?php echo $rowHead['ano']; ?></p>
                <p class="genero">Genero: <?php echo $rowHead['categorias']; ?></p>
                <p class="peliDescripcion"><?php echo $rowHead['descripcion']; ?></p>
                <p class="author">Escritor: <?php echo $rowHead['escritor']; ?></p>
                <div class="social-media">
                    <p>Compartir:</p>
                </div>

            </div>
        </div>

    </div>
</div>
<div class="post-pelicula my-4">
    <div class="container">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
             <li class="nav-item">
                <a class="nav-link active btn btn-outline-warning" id="pills-info-tab" data-toggle="pill" href="#pills-info" role="tab" aria-controls="pills-info" aria-selected="true">Info</a>
             </li>
             <li class="nav-item">
              <a class="nav-link btn btn-outline-warning" id="pills-opcion1-tab" data-toggle="pill" href="#pills-opcion1" role="tab" aria-controls="pills-opcion1" aria-selected="false">Trailer</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link btn btn-outline-warning" id="pills-opcion2-tab" data-toggle="pill" href="#pills-opcion2" role="tab" aria-controls="pills-opcion2" aria-selected="false">Opcion 1</a>
            </li>
            <li class="nav-item">
                 <a class="nav-link btn btn-outline-warning" id="pills-opcion3-tab" data-toggle="pill" href="#pills-opcion3" role="tab" aria-controls="pills-opcion3" aria-selected="false">Opcion 2</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
                 <div class="tab-pane fade show active" id="pills-info" role="tabpanel" aria-labelledby="pills-info-tab">
                        <p>Titulo original: <span><?php echo $rowHead['tituolo_original']; ?></span></p>
                        <p>Duracion: <span><?php echo $rowHead['duracion']; ?></span></p>
                        <p>Año: <span><?php echo $rowHead['ano']; ?></span></p>
                        <p>Genero: <span><?php echo $rowHead['categorias']; ?></span></p>
                        <p>Valoracion: <span><?php echo $rowHead['valoracion']; ?></span></p>
                        <p>Idioma: <span><?php echo $rowHead['idiomas']; ?></span></p>
                        <p>Reparto: <span><?php echo $rowHead['repartos']; ?></span></p>
                 </div>
                 <div class="tab-pane fade" id="pills-opcion1" role="tabpanel" aria-labelledby="pills-opcion1-tab">
                    <div class="p-5">
                        <?php echo $embed; ?>
                    </div>
                 </div>
                 <div class="tab-pane fade" id="pills-opcion2" role="tabpanel" aria-labelledby="pills-opcion2-tab">...</div>
        </div>
    </div>
</div>
<div class="comment"></div>