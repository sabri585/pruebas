<?php
//crea una conexi�n con la BDD biblioteca
$conexion = new mysqli('localhost', 'root', '', 'biblioteca');

//establece la codificaci�n de caracteres a UTF-8
$conexion->set_charset('utf8');

echo "<p>La conexi�n se ha establecido correctamente<p>";