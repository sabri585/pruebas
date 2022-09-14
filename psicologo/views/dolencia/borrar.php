<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Confirmar borrado - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Confirmar borrado</h1>
		<?php include '../views/components/menu.php';?>
		
		<h2>Formulario de confirmación</h2>
		
		<form method="post" action="index.php?c=dolencia&m=destroy">
			<p>Confirmar el borrado de la dolencia <?=$dolencia->nombre?>.</p>
			
			<input type="hidden" name="id" value="<?=$dolencia->id?>">
			<input type="submit" name="borrar" value="Borrar">
		</form>
		
		<a href='index.php?c=dolencia&m=list'>Volver al listado</a>
	</body>
</html>
