<?php
require_once '../model/Libro.php'; //necesitamos la clase Libro

//conecta y establece el charset
$conexion = new mysqli('localhost', 'root', '', 'biblioteca');
$conexion->set_charset('utf8');

$resultado = $conexion->query("SELECT * FROM libros"); //lanza la consulta
$libros = []; //prepara una lista de libros

//convierte cada fila del resultado en un objeto Libro
while ($libro = $resultado->fetch_object('Libro')) {
    $libros[] = $libro; //lo mete en la lista
}

$resultado->free(); //libera memoria

//carga la vista que mostrará el listado de libros
include '../views/lista.php';