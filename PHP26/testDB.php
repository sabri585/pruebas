<?php
require_once 'config.php';
require_once 'DB.php';

//pruebas de select()
echo "<h2>Recuperando el socio 5</h2>";
echo "<pre>";
var_dump(DB::select("SELECT * FROM socios WHERE id=5"));
echo "</pre>";

echo "<h2>Recuperando el socio 5000 (no existe)</h2>";
echo "<pre>";
var_dump(DB::select("SELECT * FROM socios WHERE id=5000"));
echo "</pre>";

//pruebas de selectAll()
echo "<h2>Recuperando los temas</h2>";
echo "<pre>";
var_dump(DB::selectAll("SELECT * FROM temas"));
echo "</pre>";

echo "<h2>Recuperando libros de Stephen King (no hay)</h2>";
echo "<pre>";
var_dump(DB::selectAll("SELECT * FROM libros WHERE autor='Stephen King'"));
echo "</pre>";

//prueba de insert()
echo "<h2>Guardando un tema</h2>";

$consulta = "INSERT INTO temas(tema, descripcion)
            VALUES('Viajes', 'Viaje con nosotros si quiere jugar')";

$id = DB::insert($consulta);

echo "<p>El ID del nuevo tema es $id</p>";

//prueba de update()
echo "<h2>Actualizando un tema</h2>";

$consulta = "UPDATE temas SET tema='Test de Tema' WHERE id=10";
$filas = DB::update($consulta);

echo "<p>Filas afectadas $filas</p>";

//comprobación de que se ha actualizado correctamente
echo "<pre>";
var_dump(DB::select("SELECT * FROM temas WHERE id=10"));
echo "</pre>";

//prueba de delete()
echo "<h2>Borrando un tema</h2>";

$filas = DB::delete("DELETE FROM temas WHERE id=5");
echo "<p>Filas afectadas $filas</p>";

//comprobación de que se ha borrado correctamente
echo "<pre>";
var_dump(DB::select("SELECT * FROM temas WHERE id=5"));
echo "</pre>";

//pruebas de totales
echo "<h2>Totales</h2>";

echo "<p>Total de socios: ".DB::total('socios')."</p>";
echo "<p>Fecha de alta del último socio: ".DB::total('socios','MAX','alta')."</p>";
echo "<p>Nacimiento del socio mayor: ".DB::total('socios','MIN','nacimiento')."</p>";
echo "<p>Precio medio de ejemplares: ".DB::total('ejemplares','AVG','precio')."</p>";