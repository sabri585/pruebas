<?php
require 'Moto.php';
require 'Scooter.php';

//creamos una Scooter
$moto1 = new Scooter('Piaggio', 'City', 5, 75);

//el método trucar() es heredado de la clase Moto
$moto1->trucar(10);

//el método __toString() ha sido redefinido en la clase Scooter
echo "La moto es $moto1<br>";