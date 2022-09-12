<?php
class Scooter extends Moto{
    
    //propiedades no heredadas
    public $cilindrada;
    
    //constructor
    public function __construct(string $marca='', string $modelo='',
                                int $caballos=0, int $cilindrada=50){
        
       //usa el contructor de la clase padre
       parent::__construct($marca, $modelo, $caballos);
       
       //solamente inicializa las propiedades no heredadas
       $this->cilindrada=$cilindrada;
    }
    
    //métodos
    public function __toString():string{
        return parent::__toString()." cilindrada: $this->cilindrada cc";
    }
}