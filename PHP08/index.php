<?php
function foo() {
    echo 'hola';
}

function foo2() {
    echo 'adiós';
}

$funcion = $_GET['funcion'];

//llama dinámicamente a una función si existe
if (function_exists($funcion)) {
    $funcion();
}else{
    echo "la función $funcion no existe";
}

// localhost/pruebas/PHP08/index.php?funcion=foo