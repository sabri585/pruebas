<?php
//CLASE Pajaro
class Pajaro extends Animal{
    private $tropical; //propiedades
    
    //constructor
    public function __construct(string $n, DateTime $f, bool $t=FALSE){
        parent::__construct($n, $f);
        $this->tropical=$t;
    }
    
    //métodos
    public function piar(){
        return "PIO PIO";
    }
    
    //toString
    public function __toString():string{
        return parent::__toString().' '.($this->tropical? 'TROPICAL':'NO TROPICAL');
    }
}