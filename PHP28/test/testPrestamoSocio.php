<?php
require_once '../config/config.php';
require_once '../libraries/autoload.php';

//PRIMERA PRUEBA: RECUPERAR UN SOCIO Y SUS PRÉSTAMOS
echo "<h2>Recuperando el socio 5</h2>";
$socio = Socio::getById(5); //recupera el socio 5

echo "<p>$socio</p>";

echo "<h2>Recuperando ejemplares del socio 5</h2>";
$prestamos = $socio->getPrestamos();

echo "<ul>";
foreach ($prestamos as $p) {
    echo "<li>$p</li>";
}
echo "</ul>";