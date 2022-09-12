<?php
// Clase Libro, forma parte del MODELO
// se encarga de gestionar la información de los libros en la BDD

class Libro{
    // PROPIEDADES
    public $id=0, $isbn='', $titulo='', $editorial='', $idioma='',
    $autor='', $ediciones=0, $edadrecomendada=0;
    
    // método para recuperar un array con todos los libros.
    public static function get():array{
        $consulta = "SELECT * FROM libros";
        return DB::selectAll($consulta, self::class);
    }
    
    // método para recuperar un libro a partir de su ID (null si no lo encuentra)
    public static function getById(int $id):?Libro{
        $consulta = "SELECT * FROM libros WHERE id=$id";
        return DB::select($consulta, self::class);
    }
    
    
    
    // método para guardar un nuevo libro en la BDD
    public function guardar(){
        
        // prepara la consulta de inserción (ojo con las comillas y comas...)
        $consulta="INSERT INTO libros(isbn, titulo, editorial,
                                         idioma, autor, ediciones,
                                         edadrecomendada)
                        VALUES('$this->isbn','$this->titulo','$this->editorial',
                               '$this->idioma', '$this->autor', $this->ediciones,
                                $this->edadrecomendada)";
                                
                                // guarda el nuevo libro en la BDD y actualiza el ID con el autonumérico
                                // que se le ha asignado en la base de datos
                                $this->id = DB::insert($consulta);
                                
                                // retorna el id del nuevo libro (o false si falló la inserción)
                                return $this->id;
    }
    
    
    
    // método que actualiza un libro en la base de datos
    public function actualizar(){
        // prepara la consulta (ojo con las comillas y las comas)
        $consulta="UPDATE libros SET
                          isbn='$this->isbn',
                          titulo='$this->titulo',
                          editorial='$this->editorial',
                          idioma='$this->idioma',
                          autor='$this->autor',
                          ediciones=$this->ediciones,
                          edadrecomendada=$this->edadrecomendada
                       WHERE id=$this->id";
        
        // lanza la consulta y retorna el número de filas afectadas
        // o false si hubo algún problema
        return DB::update($consulta);
    }
    
    
    //recuperar libros con un filtro por el título
    public static function getPorTitulo(string $titulo=''):array{
        $consulta="SELECT *
                   FROM libros
                   WHERE titulo LIKE '%$titulo%'";
        
        return DB::selectAll($consulta, self::class);
    }
    
    // recuperar libros con un filtro avanzado
    public static function getFiltered(string $campo='titulo', string $valor='',
        string $orden='id', string $sentido='ASC'):array{
            
            $consulta="SELECT *
                   FROM libros
                   WHERE $campo LIKE '%$valor%'
                   ORDER BY $orden $sentido";
            
            return DB::selectAll($consulta, self::class);
    }
    
    // método que borra un libro de la base de datos
    public static function borrar(int $id){
        // prepara la consulta
        $consulta="DELETE FROM libros WHERE id=$id";
        
        // lanza la consulta y retorna el número de filas afectadas
        // o false si hubo algún problema
        return DB::delete($consulta);
    }
    
    // método que realiza consultas de totales
    public static function total(
        string $operacion = 'COUNT',
        string $campo = '*'
        ){
            return DB::total('libros', $operacion, $campo);
    }
    
    // el método __toString(), lo usaremos principalmente en test
    public function __toString():string{
        return "LIBRO $this->id: $this->isbn - $this->titulo, de $this->autor";
    }
}