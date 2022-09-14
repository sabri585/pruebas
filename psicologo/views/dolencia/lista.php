<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Lista de dolencias - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Dolencias del Psicólogo</h1>
		<?php include '../views/components/menu.php';?>
		
		<h2>Lista de dolencias</h2>
		
		<table border="1">
			<tr>
				<th>Nombre</th>
				<th>Descripci�n</th>
				<th>Tratamiento</th>
			</tr>
			<?php foreach ($dolencias as $dolencia){
			    echo "<tr>";
			    echo "<td>$dolencia->nombre</td>";
			    echo "<td>$dolencia->descripcion</td>";
			    echo "<td>$dolencia->tratamiento</td>";
			    echo "<td>";
			    echo " <a href='index.php?c=dolencia&m=show&p=$dolencia->id'>Ver</a>";
			    echo " <a href='index.php?c=dolencia&m=edit&p=$dolencia->id'>Editar</a>";
			    echo " <a href='index.php?c=dolencia&m=delete&p=$dolencia->id'>Borrar</a>";
			    echo "</td>";
			    echo "</tr>";
			}?>
		</table>
	</body>
</html>