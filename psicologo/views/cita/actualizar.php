<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Actualizar cita <?=$cita->fecha?> - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Actualizar cita</h1>
		<h2><?=$cita->fecha.' / '.$cita->idpaciente?></h2>
		<?php include '../views/components/menu.php';?>
		
		<h2>Formulario de edición</h2>
		<!-- Muestra los mensajes con los detalles de la operación "update" -->
		<?=empty($GLOBALS['success'])? "" : "<p style='color:#060'>". $GLOBALS['success']."</p>"?>
		<?=empty($GLOBALS['error'])? "" : "<p style='color:#600'>". $GLOBALS['error']."</p>"?>
		
		<form method="post" action="/cita/update">
		
			<!-- input oculto que contiene el ID de la cita a actualizar -->
			<input type="hidden" name="id" value="<?=$cita->id?>">
			
			<!-- resto del formulario -->
			<label>Fecha</label>
			<input type="date" name="fecha" value="<?=$cita->fecha?>"><br>
			<label>Hora</label>
			<input type="time" name="hora" value="<?=$cita->hora?>"><br>
			<label>Duración</label>
			<input type="number" name="duracion" value="<?=$cita->duracion?>"><br>
			
			<input type="submit" name="actualizar" value="Actualizar">
		</form>
		
		<a href='/cita/show/<?=$cita->id?>'>Detalles</a> -
		<a href='/cita'>Volver al listado</a>
	</body>
</html>
