<?php
	require('assets/function/conexion.php');
  	include "assets/function/config.php";
  	$mysqli=call_mysqli();
  	// Aqui hacemos la verificacion de si tenemos los links existentes
    $vgVideoExiste=false;
    $vgTagExiste=false;
    $vgCategoriaExiste=false;
    if (isset($_GET['p'])){
        $views=explode("/", $_GET['p']);
        if (is_file('paginas/' . $views[0] . '.php')){
            if ($views[0]=="tag"){
                $sql="SELECT codigo FROM tag WHERE `tag`.`url` = '$views[1]'";
                $resultError = $mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
                $rowsError = $resultError->num_rows;
                if ($rowsError==0){
                    $vgTagExiste=false;
                }else{
                    $vgTagExiste=true;
                }
                //$vgTagExiste=false;
            }elseif ($views[0]=="categoria"){
                $sql="SELECT codigo FROM categoria WHERE `categoria`.`link` = '$views[1]'";
                $resultError = $mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
                $rowsError = $resultError->num_rows;
                if ($rowsError==0){
                    $vgCategoriaExiste=false;
                }else{
                    $vgCategoriaExiste=true;
                }
            }
        }else{
            $sql="SELECT codigo FROM post WHERE `post`.`url_post` = '$views[0]' AND publicado='true'";
            $resultError = $mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
            $rowsError = $resultError->num_rows;
            if ($rowsError==0){
                $vgVideoExiste=false;
            }else{
                $vgVideoExiste=true;
            }
        }
    }
	// Aqui empieza todo el proceso
    require_once 'paginas/header.php';
    // Pequeña lógica para capturar la pagina que queremos abrir
	if (isset($_GET['p'])){
        if (is_file('paginas/' . $views[0] . '.php')){
            if ($views[0]=="tag"){
                if ($vgTagExiste==true)
                {
                    require_once 'paginas/' . $views[0] . '.php';
                }else{
                    require_once 'paginas/error-no-encontrado.php';
                }
            }elseif ($views[0]=="categoria"){
                if ($vgCategoriaExiste==true)
                {
                    require_once 'paginas/' . $views[0] . '.php';
                }else{
                    require_once 'paginas/error-no-encontrado.php';
                }
            }elseif ($views[0]=="inicio"){
                require_once 'paginas/inicio.php';
            }elseif ($views[0]=="terminos-y-condiciones"){
                require_once 'paginas/terminos-y-condiciones.php';
            }elseif ($views[0]=="contacto"){
                require_once 'paginas/contacto.php';
            }elseif ($views[0]=="todas-las-categorias"){
                require_once 'paginas/todas-las-categorias.php';
            }elseif ($views[0]=="buscar"){
                require_once 'paginas/buscar.php';
            }elseif ($views[0]=="page"){
                require_once 'paginas/page.php';
            }else{
                require_once 'paginas/error-no-encontrado.php';
            }
        }elseif ($vgVideoExiste==true){
            require_once 'paginas/video.php';
        }else{
            require_once 'paginas/error-no-encontrado.php';
        }
    }else{
        require_once 'paginas/inicio.php';
    }
    $pagina = isset($_GET['p']) ? strtolower($_GET['p']) : 'inicio';
    require_once 'paginas/footer.php';