<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Lista de libros</title>
	</head>
	<body>
		<h1>Lista de libros</h1>
		<?php
		  echo "<ul>";
		  
		  foreach ($libros as $lib)
		      echo "<li><b>$lib->isbn</b>: $lib->titulo, de $lib->autor</li>";
		  
	      echo "</ul>";
		?>
	</body>
</html>