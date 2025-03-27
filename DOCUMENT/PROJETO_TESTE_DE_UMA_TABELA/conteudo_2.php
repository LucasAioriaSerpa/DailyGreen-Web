<?php
	echo "<h1> PAGINA 2</h1>";
	
	$mysqli = conecta_db();
	$query = 'INSERT INTO tb_teste (descricao) VALUES ("teste_update")';
	$result = $mysqli->query($query);
	debug($result);
?>