<?php
// Clase Libro, forma parte del MODELO
// se encarga de gestionar la informaci�n de los libros en la BDD

class Libro extends Model{
   
    //M�todo que recupera los ejemplares de un libro
    public function getEjempalres():array{
        $consulta = "SELECT * FROM ejemplares WHERE idlibro=$this->id";
        
        //retorna una lista de Ejemplare
        return DB::selectAll($consulta, 'Ejemplare');
    }
    
    //M�todo que recupera los temas de un libro
    public function getTemas():array{
        $consulta = "SELECT t.* FROM temas t
                        INNER JOIN temas_libros tl ON t.id=tl.idtema
                     WHERE tl.idlibro=$this->id";
        
        //retorna una lista de Tema
        return DB::selectAll($consulta, 'Tema');
    }
}