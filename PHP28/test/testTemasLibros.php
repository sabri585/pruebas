<?php
require_once '../config/config.php';
require_once '../libraries/autoload.php';

//PRIMERA PRUEBA: RECUPERAR UN LIBRO Y SUS TEMAS
echo "<h2>Recuperando el libro 10</h2>";
$libro = Libro::getById(10);
echo "<p>$libro</p>";

echo "<h2>Recuperando temas del libro 10</h2>";
$temas = $libro->getTemas();

echo "<ul>";
foreach ($temas as $t) {
    echo "<li>$t</li>";
}
echo "</ul>";