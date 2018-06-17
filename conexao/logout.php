<?php

	session_start();

	## DESTROI A SESSAO
	$_SESSION = array();
	session_destroy();

	## RETORNA TRUE
	echo json_encode(true);

?>