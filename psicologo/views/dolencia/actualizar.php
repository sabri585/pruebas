<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Actualizar dolencia <?=$dolencia->nombre?> - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Actualizar dolencia</h1>
		<h2><?=$dolencia->nombre?></h2>
		<?php include '../views/components/menu.php';?>
		
		<h2>Formulario de edición</h2>
		<!-- Muestra los mensajes con los detalles de la operación "update" -->
		<?=empty($GLOBALS['success'])? "" : "<p style='color:#060'>". $GLOBALS['success']."</p>"?>
		<?=empty($GLOBALS['error'])? "" : "<p style='color:#600'>". $GLOBALS['error']."</p>"?>
		
		<form method="post" action="/dolencia/update">
		
			<!-- input oculto que contiene el ID de la dolencia a actualizar -->
			<input type="hidden" name="id" value="<?=$dolencia->id?>">
			
			<!-- resto del formulario -->
			<label>Nombre</label>
			<input type="text" name="nombre" value="<?=$dolencia->nombre?>"><br>
			<label>Descripción</label>
			<input type="text" name="descripcion" value="<?=$dolencia->descripcion?>"><br>
			<label>Tratamiento</label>
			<input type="text" name="tratamiento" value="<?=$dolencia->tratamiento?>"><br>
			
			<input type="submit" name="actualizar" value="Actualizar">
		</form>
		
		<a href='/dolencia/show/<?=$dolencia->id?>'>Detalles</a> -
		<a href='/dolencia'>Volver al listado</a>
	</body>
</html>
