<?php
//clase Libro
class Libro{
    
    //propiedades
    public $id, $isbn, $titulo, $editorial, $idioma, 
            $autor, $ediciones, $edadrecomendada;
    
    //m�todo toString
            public function __toString(){
                return "LIBRO: $this->titulo, de $this->autor";
            }
}