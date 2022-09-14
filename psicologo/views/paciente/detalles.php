<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Detalles del paciente <?=$paciente->nombre?> - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Detalles</h1>
		<?php include '../views/components/menu.php';?>
		
		<h2>Detalles del paciente</h2>
		<h3><?=$paciente->nombre, $paciente->apellidos?></h3>
		
		<p><b>DNI:</b> <?=$paciente->dni?></p>
		<p><b>Nombre:</b> <?=$paciente->nombre?></p>
		<p><b>Apellidos:</b> <?=$paciente->apellidos?></p>
		<p><b>Población:</b> <?=$paciente->poblacion?></p>
		
		<h2>Detalles de las dolencias del paciente</h2>
		<p><b>Dolencia:</b> <?=$paciente->dolencia?></p>
		<p><b>Grado:</b> <?=$paciente->grado?></p>
		<p><b>Estado:</b> <?=$paciente->estado?></p>
		<p><b>Tratamiento:</b> <?=$paciente->tratamiento?></p>
		
		
		<a href='index.php?c=paciente&m=edit&p=<?=$paciente->id?>'>Editar paciente</a> -
		<a href="index.php?c=paciente&m=delete&p=<?=$paciente->id?>">Borrar paciente</a> -
		<a href='index.php?c=paciente&m=list'>Lista de pacientes</a>
	</body>
</html>
