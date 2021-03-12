<?php
  session_start();
  require('../assets/function/conexion.php');
  $mysqli = call_mysqli();
  $Cadena=mysqli_real_escape_string($mysqli,$_POST['cadena']);
  $sql = "SELECT * FROM categoria WHERE nombre LIKE '%$Cadena%' ORDER BY nombre ASC";
  $result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
?>
<thead>
<tr>
  <th>Codigo</th>
  <th>Nombre</th>
  <th></th>
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
              <td>
                <a class='btn btn-danger text-mobile' href='?p=categoria&v=".utf8_decode($row['codigo'])."'><i class='fa fa-trash' aria-hidden='true'></i>
                </a>
              </td>
          </tr>";
    }
  }
?>