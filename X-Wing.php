<?php
include_once 'Caza_estelar.php';
class X_Wing extends Caza_Estelar {
    var $R2D2_incorporado;
    var $escudo_maximo;
    var $escudo_actual;
    function __construct($numero_serie, $fabricante, $vida_actual, $vida_max, $fuerza_ataque, $R2D2_incorporado, $escudo_maximo, $escudo_actual) {
        parent::__construct($numero_serie, $fabricante, $vida_actual, $vida_max, $fuerza_ataque);
        $this->R2D2_incorporado = $R2D2_incorporado;
        $this->escudo_maximo = $escudo_maximo;
        $this->escudo_actual = $escudo_actual;
    }
    function reparar() {
        $rest = 5;
        if ($this->R2D2_incorporado == true) {
            $result = $rest + $this->vida_actual;
            if ($result > $this->vida_max) {
                $result -= $this->vida_max;
                $this->vida_actual = $this->vida_max;
                $result += $this->escudo_actual;
                if ($result > $this->escudo_maximo) {
                    $this->escudo_actual = $this->escudo_maximo;
                } else{
                    $this->escudo_actual = $result;
                }
            } else {
                $this->vida_actual = $result;
            }
        } else {
            $result = $rest + $this->vida_actual;
            if ($result > $this->vida_max) {
                $this->vida_actual = $this->vida_max;
            } else {
                $this->vida_actual = $result;
            }
        }
    }
}