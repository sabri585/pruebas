<?php
function foo() {
    echo 'hola';
}

function foo2() {
    echo 'adi�s';
}

$funcion = $_GET['funcion'];

//llama din�micamente a una funci�n si existe
if (function_exists($funcion)) {
    $funcion();
}else{
    echo "la funci�n $funcion no existe";
}

// localhost/pruebas/PHP08/index.php?funcion=foo