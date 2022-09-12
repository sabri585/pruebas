<?php

// FICHERO config.php

// PARÁMETROS DE CONFIGURACIÓN DEL AUTOLOAD

// Lista de directorios donde buscar las clases.
// Será la ruta respecto a la ubicación de los ficheros de Test,
// cuando hagamos bien el MVC será la ruta desde el index.php.
$classmap = ['../model', '../libraries'];

// PARÁMETROS DE CONFIGURACION DE LA BDD

define('DB_HOST','localhost');  // host
define('DB_USER','root');       // usuario
define('DB_PASS','');           // password
define('DB_NAME','biblioteca'); // base de datos
define('DB_CHARSET','utf8');    // codificación

define('DB_CLASS','DB'); // clase que usará el modelo (DB o DBPDO)
define('SGDB','mysql');     // driver que debe usar PDO (solo para DBPDO)

// OTROS PARAMETROS
define('DEBUG', true); // para depuración




