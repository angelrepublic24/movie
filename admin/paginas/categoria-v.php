<?php
  if (!empty($_POST)){
    $codigo=mysqli_real_escape_string($mysqli,$_POST['txtCodigo']);
    $nombre=mysqli_real_escape_string($mysqli,$_POST['txtNombre']);
    $link=urls_amigables(mysqli_real_escape_string($mysqli,$_POST['txtNombre']));
    $tituloGoo=mysqli_real_escape_string($mysqli,$_POST['txtTituloGoo']);
    $descripcion=mysqli_real_escape_string($mysqli,$_POST['editor1']);
    $imagen=trim(mysqli_real_escape_string($mysqli,$_POST['txtImagen']));

    if ($codigo == 0){
      $sql = "INSERT INTO `categoria` (`codigo`, `nombre`, `titulo_goo`, `link`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$tituloGoo', '$link', '$imagen', '$descripcion')";
    }else{
      $sql = "UPDATE categoria SET nombre='$nombre',titulo_goo='$tituloGoo',link='$link',imagen='$imagen',descripcion='$descripcion' WHERE codigo='$codigo'";
    }
    $result = $mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
    $id_ultimo=0;
    if ($codigo == 0){
      $id_ultimo=$mysqli->insert_id;
    }else{
      $id_ultimo=$codigo;
    }
    echo "<script language=\"javascript\">
          window.location.href=\"?p=categoria-v&v=".$id_ultimo."\";
        </script>";
  }elseif (isset($_GET{'v'})){
    $veli=mysqli_real_escape_string($mysqli,$_GET['v']);
    $sql = "SELECT * FROM categoria WHERE codigo = '$veli'";
    $result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
    $row =$result->fetch_assoc();
  }
?>
<div class="container-fluid py-2">
 <div class="card card-dark">
    <div class="card-header">
      <h3 class="card-title">Añadir Categoria</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Codigo</label>
          <input type="number" value="<?php echo (isset($_GET{'v'})) ? $row['codigo'] : ''; ?>" class="form-control" id="txtCodigo" name="txtCodigo" readonly>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Nombre</label>
          <input type="text" value="<?php echo (isset($_GET{'v'})) ? $row['nombre'] : ''; ?>" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre de la categoria" autofocus>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput2">Título de Organico</label>
          <input type="text" class="form-control" value="<?php echo (isset($_GET{'v'})) ? $row['titulo_goo'] : ''; ?>" name="txtTituloGoo" placeholder="Título de busquedas organicas">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Url amigable</label>
          <input type="text" class="form-control" value="<?php echo (isset($_GET{'v'})) ? $row['link'] : ''; ?>" id="txtUrl" name="txtUrl" readonly>
        </div>
        <div class="form-group">
          <textarea name="editor1" id="editor1" rows="10" cols="80">
                  <?php echo (isset($_GET{'v'})) ? utf8_decode($row['descripcion']) : ''; ?>
          </textarea>
          <script>
                  // Replace the <textarea id="editor1"> with a CKEditor
                  // instance, using default configuration.
                  CKEDITOR.replace( 'editor1' );
          </script>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Imagen Destacada</label>
          <input type="text" class="form-control" value="<?php echo (isset($_GET{'v'})) ? utf8_decode($row['imagen']) : ''; ?>" name="txtImagen" placeholder="Pega la url de la imagen destacada">
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="button" onclick="window.location.href='?p=categoria'" class="btn btn-dark">Atras</button>
        <button type="button" onclick="window.location.href='?p=categoria-v'" class="btn btn-dark">Nuevo</button>
        <button type="submit" class="btn btn-dark">Guardar</button>
      </div>
    </form>
  </div>
</div>
<!-- /.card -->