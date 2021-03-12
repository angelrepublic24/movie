<?php
	require('../assets/funs/conexion.php');

	$Cadena=str_replace(" ", "%", $_GET['cadena']);
	$sql = "SELECT codigo, titulo,fecha FROM post WHERE titulo like '%$Cadena%' ORDER BY `post`.`titulo` DESC";
	$result=$mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");
?>
<table class="table table-sm table-striped table-hover">
	<thead>
	    <tr>
	      	<th>Título</th>
	      	<th style="width:15%">Fecha</th>
	      	<th style="width:15%"></th>
	    </tr>
	</thead>
  	<tbody>
  	<?php
  		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row =$result->fetch_assoc()) {
		        echo "<tr><td><a class='lista_buscar' href='?p=post-v&v=".utf8_decode($row['codigo'])."'>".$row['titulo']."</a></td><td><a>".utf8_decode($row['fecha'])."</a></td><td><a class='btn btn-danger' href='?p=post&v=".utf8_decode($row['codigo'])."'>Borrar</a></td></tr>";
		    }
		}
  	?>
	</tbody>
</table>