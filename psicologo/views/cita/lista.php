<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Lista de citas - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Agenda del Psicólogo</h1>
		<?php include '../views/components/menu.php';?>
		
		<h2>Lista de citas</h2>
		
		<table border="1">
			<tr>
				<th>Idpaciente</th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Duración</th>
				<th>Dolencia</th>
				<th>Tratamiento</th>
			</tr>
			<?php foreach ($citas as $cita){
			    echo "<tr>";
			    echo "<td>$cita->idpaciente</td>";
			    echo "<td>$cita->nombre</td>";
			    echo "<td>$cita->apellidos</td>";
			    echo "<td>$cita->fecha</td>";
			    echo "<td>$cita->hora</td>";
			    echo "<td>$cita->duracion</td>";
			    echo "<td>$cita->dolencia</td>";
			    echo "<td>$cita->tratamiento</td>";
			    echo "<td>";
			    echo " <a href='/cita/show/$cita->id'>Ver</a>";
			    echo " <a href='/cita/edit/$cita->id'>Editar</a>";
			    echo " <a href='/cita/delete/$cita->id'>Borrar</a>";
			    echo "</td>";
			    echo "</tr>";
			}?>
		</table>
	</body>
</html>