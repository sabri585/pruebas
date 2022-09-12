<?php
class Moto{
    //propiedades
    private string $marca, $modelo;
    private int $caballos;
    
    
    //constructor
    public function __construct(
        string $marca,
        string $modelo,
        int $caballos = 0
    ){
       $this->setMarca($marca);
       $this->setModelo($modelo);
       $this->setCaballos($caballos); //utilizamos setters para propiedades privadas
    }
    
    //SETTERS
    public function setMarca(string $marca){
        $this->marca = $marca;
    }
    
    public function setModelo(string $modelo){
        $this->modelo = $modelo;
    }
    
    public function setCaballos(int $caballos){
        if ($caballos<0) {
            throw new Exception('ERROR: caballos < 0');
        }
        $this->caballos = $caballos;
    }
    
    //GETTERS
    public function getMarca():string{
        return $this->marca;
    }
    
    public function getModelo():string{
        return $this->modelo;
    }
    
    public function getCaballos():int{
        return $this->caballos;
    }
    
    //métodos
    //método de objeto compara motos y retorna la más potente
    public function masPotente(Moto $m2):Moto{
        return $this->caballos > $m2->caballos ? $this : $m2;
    }
    
    //método que modifica los caballos de una moto
    public function trucarUnPoco(int $hp=0){
        $this->setCaballos($this->caballos+$hp);
    }
    
    public function trucarMucho(){
        $this->caballos=1000;
    }
    
    public function __call(string $metodo, array $argumentos){
        switch (TRUE){
            case $metodo=='trucar' && sizeof($argumentos)==1:
                $this->trucarUnPoco($argumentos[0]);
                break;
            case $metodo=='trucar' && sizeof($argumentos)==0:
                $this->trucarMucho();
                break;
            default: throw new Exception("Operación $metodo no válida");
        }
    }
    
    //método toString()
    public  function __toString():string{
        return "$this->marca $this->modelo, $this->caballos HP";
    }
}