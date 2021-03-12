<?php
  if (isset($_GET{'v'}))
  {
    $veli=mysqli_real_escape_string($mysqli,$_GET['v'])+0;
    $sql = "DELETE FROM `categoria` WHERE codigo = '$veli'";
    $result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
    echo "<script language=\"javascript\">
          window.location.href=\"?p=categoria\";
        </script>";
  }
  $sql = "SELECT * FROM categoria";
  $result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
  <script>
      function showDetailsScroll(){
          var cadena=document.getElementById("txtBuscar").value;
          var parametros = {
          "cadena" : cadena
          };
          $.ajax({
                  data:  parametros, //datos que se envian a traves de ajax
                  url:   'paginas/categoria-data.php', //archivo que recibe la peticion
                  type:  'post', //método de envio
                  success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                          $("#example2").html(response);
                  }
          });
      }
  </script>
  <style>
    .cod{
      width: 80px;
    }
    .btn-op{
      width: 110px;
    }
    .buscar{
      width: 95%;
      padding: 3px 5px;
      border: none;
      margin-left: 5px;
    }
  </style>
  <section class="container-fluid py-2">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de categorias</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <section>
              <div class="header-block header-block-search hidden-sm-down py-1">
                <div class="input-container dv-buscar"><i class="fa fa-search"></i><input class="buscar" type="search" placeholder="Buscar" name="txtBuscar" id="txtBuscar" onkeyup="showDetailsScroll()" autofocus><a href="" class="btn  p-2 buscar"></a>
                </div>
              </div>
            </section>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th class="cod">Codigo</th>
                <th class="catName">Nombre</th>
                <th class="btn-op"></th>
              </tr>
              </thead>
              <tbody>
              <?php
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row =$result->fetch_assoc()) {
                    echo "<tr>
                            <td>
                                ".$row['codigo']."
                            </td>
                            <td>
                              <a href='?p=categoria-v&v=".utf8_decode($row['codigo'])."'>".$row['nombre']."
                              </a>
                            </td>
                            <td class='d-flex justify-content-center '>
                              <a class='btn btn-danger text-mobile align-self-end' href='?p=categoria&v=".utf8_decode($row['codigo'])."'><i class='fa fa-trash ' aria-hidden='true'></i>
                              </a>
                            </td>
                        </tr>";
                  }
                }
              ?>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
</form>