<?php
require_once '../config/config.php';
require_once '../libraries/autoload.php';

//PRIMERA PRUEBA: RECUPERAR TODOS LOS LIBROS
echo "<h2>Recuperando los libros</h2>";
$libros = Libro::get(); //recupera todos los libros en un array

//muestra una lista HTML con los datos
echo "<ul>";

foreach ($libros as $libro) {
    echo "<li>$libro</li>"; //usará el toString()
}

echo "</ul>";

//SEGUNDA PRUEBA: RECUPERAR UN LIBRO QUE EXISTE
echo "<h2>Recuperando el libro 8</h2>";

$libro = Libro::getById(8); //recupera un objeto Libro (o NULL)
echo "<p>$libro</p>" ?? "<p>Libro inexistente</p>";

//TERCERA PRUEBA: RECUPERAR UN LIBRO QUE NO EXISTE
echo "<h2>Recuperando el libro 1000</h2>";

$libro = Libro::getById(1000); //recupera un objeto Libro (o NULL)
echo $libro? "<p>$libro</p>" : "<p>Libro inexistente</p>";

//CUARTA PRUEBA: GUARDAR UN LIBRO 
echo "<h2>Guardando el libro 'Misterios del lago Nes</h2>";

$libro = new Libro(); //crea un nuevo objeto Libro

//pone los valores a las propiedades
$libro->isbn = '198-45-654-7410-8';
$libro->titulo = 'Misterios del lago Nes';
$libro->editorial = 'Santillana';
$libro->idioma = 'Castellano';
$libro->autor = 'Desconocido';
$libro->ediciones = 10;
$libro->edadrecomendada = 6;

//guarda el libro (y se actualiza su ID) si no puede guardar se lanza excepción
$libro->guardar();

echo "<p>Guardado correctamente con ID: $libro->id</p>";

//prueba a recuperar el libro de la BDD para ver si realmente se guardó
echo Libro::getById($libro->id);

//QUINTA PRUEBA: ACTUALIZAR UN LIBRO
echo "<h2>Actualizando el libro 6</h2>";

echo Libro::getById(41);
echo "<p>$libro</p>";

//cambiamos algunos datos
$libro->isbn = '291-1023-457-8520';
$libro->titulo = 'To Kill a Mockingbird2';
$libro->autor = 'Harper Lee';

//actualizamos, en caso de fallo lanzaría una excepción
$numeroFilasActualizadas = $libro->actualizar();

echo "<p>Actualización correcta de $numeroFilasActualizadas registros.</p>";

//recuperamos de nuevo el libro y lo imprimimos para comprobar los cambios
echo Libro::getById(6);

//SEXTA PRUEBA: BORRAR UN LIBRO
echo "<h2>Borrando el libro 19</h2>";

//borra el libro, si falla lanzará una excepción
$numeroFilasBorradas = $libro->borrar(19);

echo "<p>Borrado correcto de $numeroFilasBorradas registros.</p>";

//intento recuperar el libro de la BDD para comprobar que ya no está
echo Libro::getById(19) ?? "<p>Libro 19 inexistente</p>";











