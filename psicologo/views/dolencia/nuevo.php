<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Nueva dolencia - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Nueva dolencia</h1>
		<?php include '../views/components/menu.php';?>
		
		<h2>Nueva dolencia</h2>
		<form method="post" action="index.php?c=dolencia&m=store">
			<label>Nombre</label>
			<input type="text" name="nombre"><br>
			<label>Descripción</label>
			<input type="text" name="descripcion"><br>
			<label>Tratamiento</label>
			<input type="text" name="tratamiento"><br>
			<input type="submit" name="guardar" value="Guardar">
		</form>
		
		<a href='index.php?c=dolencia&m=list'>Volver al listado</a>
	</body>
</html>
