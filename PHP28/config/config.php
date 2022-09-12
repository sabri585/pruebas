<?php

// FICHERO config.php

// PAR�METROS DE CONFIGURACI�N DEL AUTOLOAD

// Lista de directorios donde buscar las clases.
// Ser� la ruta respecto a la ubicaci�n de los ficheros de Test,
// cuando hagamos bien el MVC ser� la ruta desde el index.php.
$classmap = ['../model', '../libraries'];

// PAR�METROS DE CONFIGURACION DE LA BDD

define('DB_HOST','localhost');  // host
define('DB_USER','root');       // usuario
define('DB_PASS','');           // password
define('DB_NAME','biblioteca'); // base de datos
define('DB_CHARSET','utf8');    // codificaci�n

define('DB_CLASS','DB'); // clase que usar� el modelo (DB o DBPDO)
define('SGDB','mysql');     // driver que debe usar PDO (solo para DBPDO)

// OTROS PARAMETROS
define('DEBUG', true); // para depuraci�n




