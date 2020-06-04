<?php
class TIE_Fighter extends Caza_Estelar {
    function __construct($numero_serie, $fabricante, $vida_actual, $vida_max, $fuerza_ataque) {
        parent::__construct($numero_serie, $fabricante, $vida_actual, $vida_max, $fuerza_ataque);
    }
    function escoger_accion() {
        $rand = rand(0,1);
        return $rand;
    }
    function reparar(){
        $rest = 0;
        $result = $rest + $this->vida_actual;
        if ($result > $this->vida_max) {
            $result -= $this->vida_max;
            $this->vida_actual = $this->vida_max;
        } else {
            $this->vida_actual = $result;
        }
    }
}