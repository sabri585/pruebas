<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Nueva cita - <?=APP_TITLE?></title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1>Nueva cita</h1>
		<?php include '../views/components/menu.php';?>
		
		<h2>Nueva cita</h2>
		<form method="post" action="/cita/store">
			<label>Fecha</label>
			<input type="date" name="fecha"><br>
			<label>Hora</label>
			<input type="time" name="hora"><br>
			<label>Duracion</label>
			<input type="number" name="duracion"><br>
			<label>Paciente</label>
			<select name="idpaciente"> 
        		<option value="">Seleccione..</option>
        		<?php foreach ($pacientes as $paciente) {
        		    echo "<option value='$paciente->id'>$paciente->nombre</option>";
        		 } ?>
        	</select>
        	<br>
			<input type="submit" name="guardar" value="Guardar">
		</form>
		
		<a href='/cita/list'>Volver al listado</a>
	</body>
</html>
