<?php
require_once '../config/config.php';
require_once '../libraries/autoload.php';

//PRIMERA PRUEBA: RECUPERAR UN LIBRO Y SUS TEMAS
echo "<h2>Recuperando el tema 3</h2>";
$tema = Tema::getById(3);
echo "<p>$tema</p>";

echo "<h2>Recuperando libros del tema 3</h2>";
$libros = $tema->getLibros();

echo "<ul>";
foreach ($libros as $l) {
    echo "<li>$l</li>";
}
echo "</ul>";