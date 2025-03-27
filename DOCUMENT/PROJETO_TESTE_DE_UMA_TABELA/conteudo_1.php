<?php
	include "conecta_db.php";
	
	if(isset($_POST["descricao"])){
		$mysqli = conecta_db();
		$query = 'INSERT INTO tb_teste (descricao) VALUES ("'.$_POST["descricao"].'")';
		$result = $mysqli->query($query);	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col">
				<h1>Formulario</h1>
			</div>
		</div>
		<div class="row">
			<div class="col">
			
				<form method="POST" action="conteudo_1.php">
				<input type="text" name="descricao" class="form-control" placeholder="Digite a descricao aqui">
				<button type="submit" class="mt-2 btn btn-primary">Enviar</button>
				</form>
			
			</div>
		</div>
		
	</div>
</body>
</html>
