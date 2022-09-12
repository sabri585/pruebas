<?php
class Socio extends Model{
    
    //Método que recupera los prestamos de un socio
    public function getPrestamos():array{
        $consulta = "SELECT * FROM prestamos WHERE idsocio=$this->id";
        
        //retorna una lista de Prestamo
        return DB::selectAll($consulta, 'Prestamo');
    }
}