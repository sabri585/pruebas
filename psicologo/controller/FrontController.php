<?php
// CONTROLADOR FRONTAL
class FrontController{
    
    // método principal del controlador frontal
    public static function main(){
        try{
            // GESTIÓN DE PETICIONES
            
            // recupera el controlador de la petición
            // si no llega el parámetro c, el controlador es Welcome (el indicado config.php)
            // si llega c=libro o c=LIBRO, el controlador es LibroController
            $c = empty($_GET['c']) ?
            DEFAULT_CONTROLLER :  ucfirst(strtolower($_GET['c'])).'Controller';
            
            // recuperar el método de la petición
            // si no llega el parámetro m, el método es index (config.php)
            // si llega m=create o m=CREATE, el método es create()
            $m = empty($_GET['m']) ?
            DEFAULT_METHOD :  strtolower($_GET['m']);
            
            // recuperar el parámetro de la petición
            $p = $_GET['p'] ?? false;
            
            // cargar el controlador correspondiente
            $controlador = new $c();
            
            // comprobar si existe el método
            if(!is_callable([$controlador, $m]))
                throw new Exception("No existe la operación $m");
                
                // llama al método del controlador, pasando el parámetro
                $controlador->$m($p);
                
                // si se produce algún error...
        }catch(Throwable $e){
            $mensaje = $e->getMessage();   // recupera el mensaje del error
            
            if(DEBUG){  // si estamos en modo debug muestra info adicional
                $mensaje .= "<br>En fichero: <b>".$e->getFile()."</b>";
                $mensaje .= "<br>En la línea: <b>".$e->getLine()."</b>";
            }
            include '../views/error.php';    // carga la vista de error
        }
    }
}