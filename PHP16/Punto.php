<?php
//Definición de la clase Punto
class Punto {
    
    //PROPIEDADES
    public $x=0, $y=0;
    
    //CONSTRUCTOR
    public  function __construct(float $x=0, float $y=0){
        $this->x=$x;
        $this->y=$y;
    }
    
    //MÉTODOS
    function __toString():string {
        return "($this->x, $this->y)";
    }
} 