<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Detalles de la cita <?=$cita->fecha?> - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Detalles</h1>
		<?php include '../views/components/menu.php';?>
		
		<h2>Detalles de la cita</h2>
		<h3><?=$cita->fecha, $cita->nombre?></h3>
		
		<p><b>Nombre:</b> <?=$cita->nombre?></p>
		<p><b>Apellidos:</b> <?=$cita->apellidos?></p>
		<p><b>Fecha:</b> <?=$cita->fecha?></p>
		<p><b>Hora:</b> <?=$cita->hora?></p>
		<p><b>Duracion:</b> <?=$cita->duracion?></p>
		<p><b>Dolencia:</b> <?=$cita->dolencia?></p>
		<p><b>Tratamiento:</b> <?=$cita->tratamiento?></p>
		
		<a href='/cita/edit/<?=$cita->id?>'>Editar cita</a> -
		<a href="/cita/delete/<?=$cita->id?>">Borrar cita</a> -
		<a href='/cita/list'>Lista de citas</a>
	</body>
</html>
