<?php

// Clase padre para todos los modelos
// implementa las operaciones gen�ricas del CRUD y el __toString()

/* Clase de la que pueden heredar los modelos
 *
 * Automatiza las tareas del CRUD, permitiendo que los modelos est�n vac�os
 *
 * autor: Robert Sallent
 * �ltima revisi�n: 03/09/2022
 *
 */

class Model{
    
    // m�todo para recuperar un array con todos los objetos.
    public static function get():array{
        // calcula el nombre de la tabla (Libro --> libros)
        // ojo, que el modelo Ejemplar deber� llamarse Ejemplare
        $tabla = strtolower(get_called_class()).'s';
        
        // prepara la consulta y la ejecuta
        $consulta = "SELECT * FROM $tabla";
        return (DB_CLASS)::selectAll($consulta, get_called_class());
    }
    
    // m�todo para recuperar un objeto a partir de su ID (null si no lo encuentra)
    public static function getById(int $id){
        // calcula el nombre de la tabla (Libro --> libros)
        $tabla = strtolower(get_called_class()).'s';
        
        $consulta = "SELECT * FROM $tabla WHERE id=$id";
        return (DB_CLASS)::select($consulta, get_called_class());
    }
    
    // m�todo para guardar un nuevo objeto en la BDD
    public function guardar(){
        $tabla = strtolower(get_called_class()).'s'; // nombre de la tabla
        
        // prepara la consulta de inserci�n (esta es m�s compleja)
        $consulta="INSERT INTO $tabla (";
        
        // nombres de los campos
        foreach($this as $propiedad=>$valor)
            $consulta .= "$propiedad, ";
            
            $consulta = rtrim($consulta, ', '); // quita la �ltima coma
            $consulta .= ") VALUES (";
            
            // valores
            foreach($this as $valor)
                // pone comillas en el SQL solo para los string
                // tambi�n controla los valores nulos
                switch(gettype($valor)){
                    case "string" : $consulta .= "'$valor', "; break;
                    case "NULL"   : $consulta .= "NULL, "; break;
                    default       : $consulta .= "$valor, ";
            }
            
            $consulta = rtrim($consulta, ', '); // quita la �ltima coma
            $consulta .= ")";
            
            $this->id = (DB_CLASS)::insert($consulta); // guarda el nuevo objeto
            
            // retorna el id del nuevo objeto (o false si fall� la inserci�n)
            return $this->id;
    }
    
    // m�todo que actualiza un objeto en la base de datos
    public function actualizar(){
        $tabla = strtolower(get_called_class()).'s'; // nombre de la tabla
        
        // prepara la consulta
        $consulta="UPDATE $tabla SET ";
        
        // pone comillas en el SQL solo para los string
        foreach($this as $propiedad=>$valor)
            switch(gettype($valor)){
                case "string" : $consulta .= "$propiedad='$valor', "; break;
                case "NULL"   : $consulta .= "$propiedad=NULL, "; break;
                default       : $consulta .= "$propiedad=$valor, ";
        }
        
        $consulta = rtrim($consulta, ', '); // quita la �ltima coma
        $consulta .= " WHERE id=$this->id";
        
        // lanza la consulta y retorna el n�mero de filas afectadas
        // o false si hubo alg�n problema
        return (DB_CLASS)::update($consulta);
    }
    
    // recuperar objetos con un filtro avanzado
    public static function getFiltered(string $campo='id', string $valor='',
        string $orden='id', string $sentido='ASC'):array{
            
            $tabla = strtolower(get_called_class()).'s'; // nombre de la tabla
            
            $consulta="SELECT *
               FROM $tabla
               WHERE $campo LIKE '%$valor%'
               ORDER BY $orden $sentido";
            
            return (DB_CLASS)::selectAll($consulta, get_called_class());
    }
    
    // m�todo que borra un objeto de la base de datos
    public static function borrar(int $id){
        $tabla = strtolower(get_called_class()).'s'; // nombre de la tabla
        $consulta="DELETE FROM $tabla WHERE id=$id";
        return (DB_CLASS)::delete($consulta);
    }
    
    // m�todo que realiza consultas de totales
    public static function total(
        string $operacion = 'COUNT',
        string $campo = '*'
        ){
            $tabla = strtolower(get_called_class()).'s'; // nombre de la tabla
            return (DB_CLASS)::total($tabla, $operacion, $campo);
    }
    
    
    
    // m�todo que recupera objetos relacionados en relaci�n 1 a N
    
    // por ejemplo para recuperar pr�stamos de un socio ser�a
    // $socio->hasMany('Prestamo', 'id', 'idsocio')
    
    // - si la clave primaria se llama 'id', no hace falta indicarla
    // - si la clave foranea respeta el nombre 'id' + entidad, no hace falta indicarla
    // el ejemplo anterior tambi�n funcionar� como $socio->hasMany('Prestamo');
    
    public function hasMany(
        string $relatedClass,   // clase relacionada
        string $primary = 'id', // campo por el que se relacionan las tablas
        string $foreign = null  // nombre de la clave for�nea (si no respeta el convenio)
        ):array{
            
            $tabla = strtolower($relatedClass).'s';                 // nombre de la tabla
            $foreign = $foreign ?? 'id'.strtolower(get_called_class());  // c�lculo de la clave foranea
            
            $consulta="SELECT * FROM $tabla WHERE $foreign = ".$this->$primary;
            
            return (DB_CLASS)::selectAll($consulta, $relatedClass);
    }
    
    // m�todo que recupera objetos relacionados en relaci�n N a 1
    
    // por ejemplo para recuperar el socio de un pr�stamo ser�a
    // $prestamo->belongsTo('Socio', 'id', 'idsocio')
    
    // - si la clave primaria se llama 'id', no hace falta indicarla
    // - si la clave foranea respeta el nombre 'id' + entidad, no hace falta indicarla
    // el ejemplo anterior tambi�n funciona como $prestamo->belongsTo('Socio');
    
    public function belongsTo(
        string $relatedClass,
        string $primary = 'id',
        string $foreign = null
        ){
            $tabla = strtolower($relatedClass).'s';                 // nombre de la tabla
            $foreign = $foreign ?? 'id'.strtolower($relatedClass);  // c�lculo de la clave foranea
            
            $consulta="SELECT * FROM $tabla WHERE $primary = ".$this->$foreign;
            
            return (DB_CLASS)::select($consulta, $relatedClass);
    }
    
    
    // el m�todo __toString(), lo usaremos principalmente en test
    public function __toString():string{
        $texto = '';
        
        foreach($this as $propiedad=>$valor)
            $texto .= "$propiedad: <b>$valor</b>, ";
            
            return rtrim($texto, ', '); // quita la �ltima coma
    }
}