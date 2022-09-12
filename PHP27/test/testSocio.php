<?php
require_once '../config/config.php';
require_once '../libraries/autoload.php';

//PRIMERA PRUEBA: RECUPERAR TODOS LOS SOCIOS
echo "<h2>Recuperando los socios</h2>";
$socios = Socio::get(); //recupera todos los socios en un array

//muestra una lista HTML con los datos
echo "<ul>";

foreach ($socios as $socio) {
    echo "<li>$socio</li>"; //usará el toString()
}

echo "</ul>";

//SEGUNDA PRUEBA: RECUPERAR UN SOCIO QUE EXISTE
echo "<h2>Recuperando el socio 8</h2>";

$socio = Socio::getById(8); //recupera un objeto Socio (o NULL)
echo "<p>$socio</p>" ?? "<p>Socio inexistente</p>";

//TERCERA PRUEBA: RECUPERAR UN SOCIO QUE NO EXISTE
echo "<h2>Recuperando el socio 1000</h2>";

$socio = Socio::getById(1000); //recupera un objeto Socio (o NULL)
echo $socio? "<p>$socio</p>" : "<p>Socio inexistente</p>";

//CUARTA PRUEBA: GUARDAR UN SOCIO
echo "<h2>Guardando el socio 'Juan Motos</h2>";

$socio = new Socio(); //crea un nuevo objeto Socio

//pone los valores a las propiedades
$socio->dni= '19784565G';
$socio->nombre = 'Juan';
$socio->apellidos = 'Motos';
$socio->nacimiento = '2000-05-12';
$socio->email = 'juan@motos.com';
$socio->direccion = 'C. Faisanes 45';
$socio->cp = '08201';
$socio->poblacion = 'Sabadell';
$socio->provincia = 'Barcelona';
$socio->telefono = '987 124 456';

//guarda el socio (y se actualiza su ID) si no puede guardar se lanza excepción
$socio->guardar();

echo "<p>Guardado correctamente con ID: $socio->id</p>";

//prueba a recuperar el socio de la BDD para ver si realmente se guardó
echo Socio::getById($socio->id);

//QUINTA PRUEBA: ACTUALIZAR UN SOCIO
echo "<h2>Actualizando el socio 6</h2>";

echo Socio::getById(22);
echo "<p>$socio</p>";

//cambiamos algunos datos
$socio->dni = '78451256Y';
$socio->apellidos = 'Melgarejo';
$socio->email = 'juanmelgarejo@gmail.com';

//actualizamos, en caso de fallo lanzaría una excepción
$numeroFilasActualizadas = $socio->actualizar();

echo "<p>Actualización correcta de $numeroFilasActualizadas registros.</p>";

//recuperamos de nuevo el socio y lo imprimimos para comprobar los cambios
echo Socio::getById(22);

//SEXTA PRUEBA: BORRAR UN SOCIO
echo "<h2>Borrando el socio 19</h2>";

//borra el libro, si falla lanzará una excepción
$numeroFilasBorradas = $socio->borrar(19);

echo "<p>Borrado correcto de $numeroFilasBorradas registros.</p>";

//intento recuperar el socio de la BDD para comprobar que ya no está
echo Socio::getById(19) ?? "<p>Libro 19 inexistente</p>";