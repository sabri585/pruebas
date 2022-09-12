<?php
require_once 'Punto.php';

echo "<h2>Creando puntos</h2>";

$punto1 = new Punto(); //crea un nuevo punto
echo $punto1.'<br>';

echo "<h2>Accediendo a las propiedades</h2>";

$punto1 = new Punto();
echo $punto1.'<br>';

$punto1->x = 100;
$punto1->y += 50;

echo "La coordenada X es: $punto1->x <br>";
echo "La coordenada Y es: $punto1->y <br>";

echo "<h2>Construyendo puntos</h2>";

echo "<h2>Creando puntos</h2>";

$punto1 = new Punto(); //crea un nuevo punto
echo $punto1.'<br>';

$punto2 = new Punto(36); //crea un nuevo punto
echo $punto2.'<br>';

$punto3 = new Punto(3, 89); //crea un nuevo punto
echo $punto3.'<br>';

echo "<h2>Referencias</h2>";

$punto4 = new Punto(450, 620); //crea un nuevo punto
echo $punto4.'<br>';

$punto5 = $punto4; 
$punto5->x +=50;
$punto5->y +=50;

unset($punto5);

echo $punto4.'<br>';

echo "<h2>Comparaciones</h2>";

$punto6 = new Punto(420, 680); //crea un nuevo punto


echo $punto6.'<br>';
