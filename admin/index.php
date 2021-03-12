<?php
	session_start();
	require_once "paginas/header.php";

	if (isset($_GET["p"])) {
		if (is_file("paginas/".$_GET["p"].".php")) {
			require_once("paginas/".$_GET["p"].".php");
		}else{
			require_once("paginas/inicio.php");
		}
	}else{
		require_once("paginas/inicio.php");
	}
	require_once("paginas/footer.php");
 ?>