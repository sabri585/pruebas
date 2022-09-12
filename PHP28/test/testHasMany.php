<?php
require_once '../config/config.php';
require_once '../libraries/autoload.php';

echo "<h2>Recuperando ejemplares del libro 3</h2>";
//como la relaci�n va de id a idlibro, no hace falta indicar tres par�metros
$ejemplares = Libro::getById(3)->hasMany('Ejemplare');

echo "<ul>";
foreach ($ejemplares as $e) {
    echo "<li>$e</li>";
}
echo "</ul>";

echo "<h2>Recuperando pr�stamos del ejemplar 2</h2>";
//como la clave for�nea no se llama idejemplare, hay que indicar la buena
$prestamos = Ejemplare::getById(2)->hasMany('Prestamo', 'id', 'idejemplar');

echo "<ul>";
foreach ($prestamos as $p) {
    echo "<li>$p</li>";
}
echo "</ul>";