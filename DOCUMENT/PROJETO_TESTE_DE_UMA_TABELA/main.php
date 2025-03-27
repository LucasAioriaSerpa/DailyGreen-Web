<?php
	echo "<h1> PAGINA PRINCIPAL</h1>";
	if(isset($_GET['delete'])){
		$mysqli = conecta_db();
		$query = 'DELETE FROM tb_teste WHERE teste_id = '.$_GET['delete'];
		$result = $mysqli->query($query);
		debug($result);
	}
?>