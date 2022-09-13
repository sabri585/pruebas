<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Lista de pacientes - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Pacientes del Psic�logo</h1>
		<?php include '../views/components/menu.php';?>
		
		<h2>Lista de pacientes</h2>
		
		<table border="1">
			<tr>
				<th>DNI</th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Poblaci�n</th>
			</tr>
			<?php foreach ($pacientes as $paciente){
			    echo "<tr>";
			    echo "<td>$paciente->dni</td>";
			    echo "<td>$paciente->nombre</td>";
			    echo "<td>$paciente->apellidos</td>";
			    echo "<td>$paciente->poblacion</td>";
			    echo "<td>";
			    echo " <a href='index.php?c=paciente&m=show&p=$paciente->id'>Ver</a>";
			    echo " <a href='index.php?c=paciente&m=edit&p=$paciente->id'>Editar</a>";
			    echo " <a href='index.php?c=paciente&m=delete&p=$paciente->id'>Borrar</a>";
			    echo "</td>";
			    echo "</tr>";
			}?>
		</table>
	</body>
</html>