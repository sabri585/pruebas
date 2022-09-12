<?php
class Ejemplare extends Model{
    
    //Método que recupera los prestamos de un ejemplar
    public function getPrestamos():array{
        $consulta = "SELECT * FROM prestamos WHERE idejemplar=$this->id";
        
        //retorna una lista de Prestamo
        return DB::selectAll($consulta, 'Prestamo');
    }
}