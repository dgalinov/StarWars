<?php
class Caza_Estelar{
    var $numero_serie;
    var $fabricante;
    var $vida_actual;
    var $vida_max;
    var $fuerza_ataque;
    function __construct($numero_serie, $fabricante, $vida_actual, $vida_max, $fuerza_ataque) {
        $this->numero_serie = $numero_serie;
        $this->fabricante = $fabricante;
        $this->vida_actual = $vida_actual;
        $this->vida_max = $vida_max;
        $this->fuerza_ataque = $fuerza_ataque;
    }
    function disparar($caza_estelar) {
        $rand = rand(1, 10);
        $daño = $this->fuerza_ataque + $rand;
        if ($caza_estelar->fabricante == 'Republica') {
            if ($daño > $caza_estelar->escudo_actual) {
                $sobrante = $daño - $caza_estelar->escudo_actual;
                $caza_estelar->vida_actual -= $sobrante;
            } else {
                $caza_estelar->vida_actual -= $daño;
            }
        } else {
            $caza_estelar->vida_actual -= $daño;
        }
    }
}