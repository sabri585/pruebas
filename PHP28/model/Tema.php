<?php
class Tema extends Model{
    
    //Método que recupera los libros de un tema
    public function getLibros():array{
        $consulta = "SELECT l.* FROM libros l
                        INNER JOIN temas_libros tl ON l.id=tl.idlibro
                     WHERE tl.idtema=$this->id";
        
        //retorna una lista de Libro
        return DB::selectAll($consulta, 'Libro');
    }
}