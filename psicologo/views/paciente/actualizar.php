<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Actualizar paciente <?=$paciente->nombre?> - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Actualizar paciente</h1>
		<h2><?=$paciente->nombre, $paciente->apellidos?></h2>
		<?php include '../views/components/menu.php';?>
		
		<h2>Formulario de edición</h2>
		<!-- Muestra los mensajes con los detalles de la operación "update" -->
		<?=empty($GLOBALS['success'])? "" : "<p style='color:#060'>". $GLOBALS['success']."</p>"?>
		<?=empty($GLOBALS['error'])? "" : "<p style='color:#600'>". $GLOBALS['error']."</p>"?>
		
		<form method="post" action="index.php?c=paciente&m=update">
		
			<!-- input oculto que contiene el ID del libro a actualizar -->
			<input type="hidden" name="id" value="<?=$paciente->id?>">
			
			<!-- resto del formulario -->
			<label>DNI</label>
			<input type="text" name="dni" value="<?=$paciente->dni?>"><br>
			<label>Nombre</label>
			<input type="text" name="nombre" value="<?=$paciente->nombre?>"><br>
			<label>Apellidos</label>
			<input type="text" name="apellidos" value="<?=$paciente->apellidos?>"><br>
			<label>Población</label>
			<input type="text" name="poblacion" value="<?=$paciente->poblacion?>"><br>
			
			<input type="submit" name="actualizar" value="Actualizar">
		</form>
		
		<a href='index.php?c=paciente&m=show&p=<?=$paciente->id?>'>Detalles</a> -
		<a href='index.php?c=paciente'>Volver al listado</a>
	</body>
</html>
