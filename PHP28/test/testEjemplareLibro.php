<?php
require_once '../config/config.php';
require_once '../libraries/autoload.php';

//PRIMERA PRUEBA: RECUPERAR UN LIBRO Y SUS EJEMPLARES
echo "<h2>Recuperando el libro 5</h2>";
$libro = Libro::getById(5); //recupera el libro 5

echo "<p>$libro</p>";

echo "<h2>Recuperando ejemplares del libro 5</h2>";
$ejemplares = $libro->getEjempalres();

echo "<ul>";
foreach ($ejemplares as $e) {
    echo "<li>$e</li>";
}
echo "</ul>";