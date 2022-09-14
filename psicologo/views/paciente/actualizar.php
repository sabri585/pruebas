<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Actualizar paciente <?=$paciente->nombre?> - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Actualizar paciente</h1>
		<h2><?=$paciente->nombre.' '.$paciente->apellidos?></h2>
		<?php include '../views/components/menu.php';?>
		
		<h2>Formulario de edición</h2>
		<!-- Muestra los mensajes con los detalles de la operación "update" -->
		<?=empty($GLOBALS['success'])? "" : "<p style='color:#060'>". $GLOBALS['success']."</p>"?>
		<?=empty($GLOBALS['error'])? "" : "<p style='color:#600'>". $GLOBALS['error']."</p>"?>
		
		<form method="post" action="/paciente/update">
		
			<!-- input oculto que contiene el ID del paciente a actualizar -->
			<input type="hidden" name="id" value="<?=$paciente->id?>">
			
			<!-- resto del formulario -->
			<h2>Información del paciente</h2>
			<label>DNI</label>
			<input type="text" name="dni" value="<?=$paciente->dni?>"><br>
			<label>Nombre</label>
			<input type="text" name="nombre" value="<?=$paciente->nombre?>"><br>
			<label>Apellidos</label>
			<input type="text" name="apellidos" value="<?=$paciente->apellidos?>"><br>
			<label>Población</label>
			<input type="text" name="poblacion" value="<?=$paciente->poblacion?>"><br>
			
			<h2>Información de las dolencias del paciente</h2>
			<label>Grado</label>
			<input type="text" name="grado" value="<?=$paciente->grado?>"><br>
			<label>Dolencia</label>
			<input type="text" name="dolencia" value="<?=$paciente->dolencia?>"><br>
			<label>Estado</label>
			<input type="text" name="poblacion" value="<?=$paciente->estado?>"><br>
			<label>Tratamiento</label>
			<input type="text" name="poblacion" value="<?=$paciente->tratamiento?>"><br>
			
			<input type="submit" name="actualizar" value="Actualizar">
		</form>
		
		<a href='/paciente/show/<?=$paciente->id?>'>Detalles</a> -
		<a href='/paciente'>Volver al listado</a>
	</body>
</html>
