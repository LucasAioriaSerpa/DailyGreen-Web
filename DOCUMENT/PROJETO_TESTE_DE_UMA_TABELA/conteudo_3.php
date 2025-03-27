<?php
	echo "<h1> PAGINA 3 </h1>";
	
	$mysqli = conecta_db();
	$query = 'SELECT * FROM tb_teste';
	$result = $mysqli->query($query);	
	if ($result) {
        while($obj = $result->fetch_object()){
            debug($obj);
        }
    }
?>