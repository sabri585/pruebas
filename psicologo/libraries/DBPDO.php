<?php
/* Clase DBPDO que trabaja con PDO
 *
 * Simplifica la tarea de conexi�n y realizaci�n de consultas con la BDD
 *
 * autor: Robert Sallent
 * �ltima revisi�n: 04/09/2022
 *
 */

class DBPDO{
    
    // propiedad que guardar� la conexi�n con BDD (objeto PDO)
    private static $conexion = null;
    
    // m�todo que conecta o recupera la conexi�n con la BDD
    public static function get():PDO{
        
        // si no est�bamos conectados a la base de datos...
        if(!self::$conexion){
            
            //conecta con la BDD, si no puede lanzar� una PDOException
            $dsn=SGDB.':host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET;
            self::$conexion = new PDO($dsn, DB_USER, DB_PASS);
            
        }
        return self::$conexion; // retorna la conexi�n
    }
    
    
    // m�todo que realiza la consulta a la BDD y eval�a si se produjeron errores
    public static function query(string $consulta){
        try{
            // recupera la conexi�n y realiza la consulta
            $resultado = self::get()->query($consulta);
            
            // lanza excepci�n si algo falla
            if($resultado === false) throw new Exception();
            
            return $resultado; // si todo fue bien, retorna el resultado de la consulta
            
            // si algo falla, pillamos la excepci�n y lanzamos otra con info personalizada
        }catch(Exception $e){
            if(DEBUG){
                // error detallado (muestra la consulta y el mensaje que viene de la BDD)
                $mensaje = "ERROR EN LA OPERACI�N: ";
                $mensaje .= "<b>$consulta</b> ";    // mostrar� la consulta
                $mensaje .= self::get()->errorInfo()[2];  // mostrar� el mensaje de error
                throw new Exception($mensaje);
            }else
                // muestra un error gen�rico (para no mostrar detalles en producci�n)
                throw new Exception('ERROR al realizar la operaci�n.');
        }
    }
    
    // M�todo para realizar consultas SELECT de un solo resultado
    public static function select(string $consulta, string $class='stdClass'){
        $resultado = self::query($consulta); // lanza la consulta
        
        $objeto = $resultado->fetchObject($class); // convertir el resultado a objeto
        return $objeto === false ? null : $objeto; // retorna el objeto (o null)
    }
    
    // M�todo para realizar consultas SELECT de m�ltiples resultados
    public static function selectAll(string $consulta, string $class='stdClass'):array{
        $resultados = self::query($consulta); // lanza la consulta
        $objetos = []; // preparamos un array
        
        // convertimos cada resultado a un objeto y lo metemos en el array
        while($r = $resultados->fetchObject($class))
            $objetos[] = $r;
            
            return $objetos;     // retornamos el resultado
    }
    
    // M�todo para realizar consultas INSERT
    // retorna el valor del ID autonum�rico asignado en la BDD
    public static function insert(string $consulta):int{
        self::query($consulta);         // ejecuta la consulta
        return self::get()->lastInsertId(); // retorna el id
    }
    
    // M�todo para realizar consultas UPDATE
    // retorna el n�mero de filas afectadas
    public static function update(string $consulta):int{
        $statement = self::query($consulta);              // ejecuta la consulta
        return $statement->rowCount();   // retorna el n�mero de filas afectadas
    }
    
    // M�todo para realizar consultas DELETE
    // retorna el n�mero de filas afectadas
    public static function delete(string $consulta):int{
        $statement = self::query($consulta);             // ejecuta la consulta
        return $statement->rowCount();  // retorna el n�mero de filas afectadas
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
}
