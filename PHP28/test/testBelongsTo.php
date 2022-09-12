<?php
require_once '../config/config.php';
require_once '../libraries/autoload.php';

echo "<h2>Recuperando libro del ejemplar 18</h2>";
//como la relaci�n va de id a idlibro, no hace falta indicar tres par�metros
$libro = Ejemplare::getById(18)->belongsTo('Libro');
echo "<p>$libro</p>";

echo "<h2>Recuperando ejemplar del pr�stamo 100</h2>";
//como la clave for�nea no se llama idejemplare, hay que indicarla
$ejemplar = Prestamo::getById(100)->belongsTo('Ejemplare', 'id', 'idejemplar');
echo "<p>$ejemplar</p>";

echo "<h2>Recuperando socio del pr�stamo 100</h2>";
//como la clave for�nea se llama idsocio, no hace falta indicarla
$socio = Prestamo::getById(100)->belongsTo('Socio');
echo "<p>$socio</p>";