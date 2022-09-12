<?php
require_once '../config/config.php';
require_once '../libraries/autoload.php';

//PRIMERA PRUEBA: RECUPERAR UN EJEMPLAR Y SUS PRÉSTAMOS
echo "<h2>Recuperando el libro 5</h2>";
$libro = Libro::getById(5);
echo "<p>$libro</p>";

echo "<h2>Recuperando el ejemplares del libro 5</h2>";
$ejemplares = $libro->getEjempalres();

echo "<ul>";
foreach ($ejemplares as $e) {
    echo "<li>$e</li>";
}
echo "</ul>";

echo "<h2>Recuperando prestamos del 1er ejemplar del libro 5</h2>";
echo "<p>$ejemplares[0]</p>";
$prestamos = $ejemplares[0]->getPrestamos();

echo "<ul>";
foreach ($prestamos as $p) {
    echo "<li>$p</li>";
}
echo "</ul>";