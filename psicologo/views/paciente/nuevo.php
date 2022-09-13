<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Nuevo paciente - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Nuevo paciente</h1>
		<?php include '../views/components/menu.php';?>
		
		<h2>Nuevo paciente</h2>
		<form method="post" action="index.php?c=paciente&m=store">
			<label>DNI</label>
			<input type="text" name="dni"><br>
			<label>Nombre</label>
			<input type="text" name="nombre"><br>
			<label>Apellidos</label>
			<input type="text" name="apellidos"><br>
			<label>Población</label>
			<input type="text" name="poblacion"><br>
			<input type="submit" name="guardar" value="Guardar">
		</form>
		
		<a href='index.php?c=paciente&m=list'>Volver al listado</a>
	</body>
</html>
