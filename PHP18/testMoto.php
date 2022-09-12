<?php
require 'Moto.php';

$moto1 = new Moto('Honda', 'NTC', 100);
echo '<p>'.$moto1.'</p>';

$moto2 = new Moto('Yamaha', 'RSX', 120);

echo $moto1->masPotente($moto2).'<br>'; //Yamaha
// echo $moto1->masPotente(new stdClass()).'<br>'; //Error

// $moto1->marca = 'Suzuki';
echo '<p>'.$moto1->getMarca().'</p>';

$moto1->setCaballos($moto1->getCaballos()+50);
echo '<p>'.$moto1.'</p>';