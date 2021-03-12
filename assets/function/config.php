<?php
	$miDominio=$_SERVER["HTTP_HOST"];
	$posMiDominio = strpos($miDominio, "www");
	if ($posMiDominio === false) {
    	define('SERVERURL', "http://localhost/pelis-1/");
	} else {
	    define('SERVERURL', "https://www.pelisup.com/");
	}