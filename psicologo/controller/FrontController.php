<?php
// CONTROLADOR FRONTAL
class FrontController{
    
    // m�todo principal del controlador frontal
    public static function main(){
        try{
            // GESTI�N DE PETICIONES
            
            // recupera el controlador de la petici�n
            // si no llega el par�metro c, el controlador es Welcome (el indicado config.php)
            // si llega c=libro o c=LIBRO, el controlador es LibroController
            $c = empty($_GET['c']) ?
            DEFAULT_CONTROLLER :  ucfirst(strtolower($_GET['c'])).'Controller';
            
            // recuperar el m�todo de la petici�n
            // si no llega el par�metro m, el m�todo es index (config.php)
            // si llega m=create o m=CREATE, el m�todo es create()
            $m = empty($_GET['m']) ?
            DEFAULT_METHOD :  strtolower($_GET['m']);
            
            // recuperar el par�metro de la petici�n
            $p = $_GET['p'] ?? false;
            
            // cargar el controlador correspondiente
            $controlador = new $c();
            
            // comprobar si existe el m�todo
            if(!is_callable([$controlador, $m]))
                throw new Exception("No existe la operaci�n $m");
                
                // llama al m�todo del controlador, pasando el par�metro
                $controlador->$m($p);
                
                // si se produce alg�n error...
        }catch(Throwable $e){
            $mensaje = $e->getMessage();   // recupera el mensaje del error
            
            if(DEBUG){  // si estamos en modo debug muestra info adicional
                $mensaje .= "<br>En fichero: <b>".$e->getFile()."</b>";
                $mensaje .= "<br>En la l�nea: <b>".$e->getLine()."</b>";
            }
            include '../views/error.php';    // carga la vista de error
        }
    }
}