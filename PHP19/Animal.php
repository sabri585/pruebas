<?php
//CLASE Animal
class Animal {
    //PROPIEDADES
    protected $nombre, $fechaNacimiento;
    
    //constructor
    public function __construct(string $n, DateTime $f){
        $this->nombre = $n;
        $this->fechaNacimiento = $f;
    }
    
    //toString
    public function __toString():string{
        return $this->nombre.' ('.$this->fechaNacimiento->format('d/m/Y').')';
    }
}