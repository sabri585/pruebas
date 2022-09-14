<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Detalles de la dolencia <?=$dolencia->nombre?> - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Detalles</h1>
		<?php include '../views/components/menu.php';?>
		
		<h2>Detalles de la dolencia</h2>
		<h3><?=$dolencia->nombre?></h3>
		
		<p><b>Nombre:</b> <?=$dolencia->nombre?></p>
		<p><b>Descripción:</b> <?=$dolencia->descripcion?></p>
		<p><b>Tratamiento:</b> <?=$dolencia->tratamiento?></p>
		
		<a href='index.php?c=dolencia&m=edit&p=<?=$dolencia->id?>'>Editar dolencia</a> -
		<a href="index.php?c=dolencia&m=delete&p=<?=$dolencia->id?>">Borrar dolencia</a> -
		<a href='index.php?c=dolencia&m=list'>Lista de dolencias</a>
	</body>
</html>
