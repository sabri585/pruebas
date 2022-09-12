<?php
/* Clase DB que trabaja con mysqli
 *
 * Simplifica la tarea de conexi�n y realizaci�n de consultas con la BDD
 *
 * autor: Robert Sallent
 * �ltima revisi�n: 11/05/2022 (v.22.05)
 *
 */

class DB{
    // Propiedad que guardar� la conexi�n con BDD (objeto mysqli)
    private static $conexion = null;
    
    // M�todo que conecta o recupera la conexi�n con la BDD
    public static function get():mysqli{
        
        // si no est�bamos conectados a la base de datos...
        if(!self::$conexion){
            // conecta a la BDD. En PHP>=8.1 si algo falla se lanza una excepci�n
            self::$conexion = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            // por compatibilidad con versiones PHP<8.1, que no lanzan excepciones
            if(self::$conexion->connect_errno)
                throw new Exception("Conexi�n fallida: ".$conexion->connect_error);
                
                // si todo fue bien, establece el charset
                self::$conexion->set_charset(DB_CHARSET);
        }
        return self::$conexion; // retorna la conexi�n
    }
    
    
    // m�todo que realiza la consulta a la BDD y eval�a si se produjeron errores
    // en PHP>=8.1, mysqli::query() tambi�n lanza excepciones si algo falla
    public static function query(string $consulta){
        try{
            // recupera la conexi�n y realiza la consulta
            $resultado = self::get()->query($consulta);
            
            // por compatibilidad con PHP<8.1 que no lanza excepciones si algo falla
            if($resultado === false) throw new Exception();
            
            return $resultado; // si todo fue bien, retorna el resultado de la consulta
            
            // si algo falla, pillamos la excepci�n y lanzamos otra con info personalizada
        }catch(Exception $e){
            if(DEBUG){
                // error detallado (muestra la consulta y el mensaje que viene de la BDD)
                $mensaje = "ERROR EN LA OPERACI�N: ";
                $mensaje .= "<b>$consulta</b> ";    // mostrar� la consulta
                $mensaje .= self::get()->error;     // mostrar� el error mysqli
                throw new Exception($mensaje);
            }else
                // muestra un error gen�rico (para no mostrar detalles en producci�n)
                throw new Exception('ERROR al realizar la operaci�n.');
        }
    }
    
    // M�todo para realizar consultas SELECT de un solo resultado
    public static function select(string $consulta, string $class='stdClass'){
        
        $resultado = self::query($consulta); // lanza la consulta
        
        // si todo fue bien...
        $objeto = $resultado->fetch_object($class); // convertir el resultado a objeto
        $resultado->free();                         // liberar memoria
        return $objeto;                             // retorna el objeto recuperado (o null)
    }
    
    
    // M�todo para realizar consultas SELECT de m�ltiples resultados
    public static function selectAll(string $consulta, string $class='stdClass'):array{
        
        // lanza la consulta
        $resultados = self::query($consulta);
        
        // si todo fue bien...
        $objetos = []; // preparamos un array
        
        // convertimos cada resultado a un objeto y lo metemos en el array
        while($r = $resultados->fetch_object($class))
            $objetos[] = $r;
            
            $resultados->free(); // liberamos memoria
            return $objetos;     // retornamos el resultado
    }
    
    // M�todo para realizar consultas INSERT
    // retorna el valor del ID autonum�rico asignado en la BDD
    public static function insert(string $consulta):int{
        self::query($consulta);         // ejecuta la consulta
        return self::get()->insert_id;  // retorna el insert_id
    }
    
    // M�todo para realizar consultas UPDATE
    // retorna el n�mero de filas afectadas
    public static function update(string $consulta):int{
        self::query($consulta);              // ejecuta la consulta
        return self::get()->affected_rows;   // retorna el n�mero de filas afectadas
    }
    
    // M�todo para realizar consultas DELETE
    // retorna el n�mero de filas afectadas
    public static function delete(string $consulta):int{
        self::query($consulta);             // ejecuta la consulta
        return self::get()->affected_rows;  // retorna el n�mero de filas afectadas
    }
    
    // M�todo que ejecuta una consulta de totales sobre la tabla deseada
    public static function total(
        string $tabla,
        string $operacion='COUNT',
        string $campo='*'
        ){
            $consulta = "SELECT $operacion($campo) AS total FROM $tabla";
            return self::select($consulta)->total;
    }
    
    // M�todo para escapar caracteres especiales
    // evitar� ataques mediante SQLInjections (no todos) e inyecci�n de scripts
    // si entities es true, se convertir�n los caracteres especiales a entidades
    public static function escape(string $texto, bool $entities = true):string{
        $texto = self::get()->real_escape_string($texto);
        return $entities? htmlspecialchars($texto) : $texto;
    }
}