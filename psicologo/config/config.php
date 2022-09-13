<?php
// FICHERO config.php

// PAR�METROS DE CONFIGURACI�N DEL AUTOLOAD
$classmap = ['../controller','../model', '../libraries'];

// T�TULO DE LA APP
define('APP_TITLE','Gesti�n Psic�logo');

// PAR�METROS DE CONFIGURACION DE LA BDD
define('DB_HOST','localhost');  // host
define('DB_USER','root');       // usuario
define('DB_PASS','');           // password
define('DB_NAME','psicologo'); // base de datos
define('DB_CHARSET','utf8');    // codificaci�n

// conector que debe usar PDO,solamente si hemos visto PDO adem�s de mysqli
// (depender� del curso)
define('DB_CLASS','DBPDO'); // clase que usar� el modelo (DB o DBPDO)
define('SGDB','mysql');     // driver que debe usar PDO (solo para DBPDO)

// CONTROLADOR Y METODO POR DEFECTO
define('DEFAULT_CONTROLLER', 'Welcome');
define('DEFAULT_METHOD', 'index');

// OTROS PARAMETROS
define('DEBUG', true); // para depuraci�n