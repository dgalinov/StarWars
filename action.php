<?php
include_once 'X-Wing.php';
include_once 'TIE_figther.php';
session_start();

function clearData() {
    $_SESSION['TIE'] = '';
    $_SESSION['DTM'] = '';
    $_SESSION['GameOverMessage'] = '';
    $_SESSION['X_WingCreatedMessage'] = '';
    $_SESSION['SNE'] = '';
    $_SESSION['LTM'] = '';
    $_SESSION['X_Wing'] = '';
}

if ((isset($_SESSION['TIE'])) && !empty($_SESSION['TIE'])) {
    if ((isset($_SESSION['X_Wing'])) && !empty($_SESSION['X_Wing'])) {
        $TIE = unserialize($_SESSION['TIE']);
        $X_Wing = unserialize($_SESSION['X_Wing']);
        $DeathList = [];
        foreach ($TIE as $key => $value) {
            if ($X_Wing->vida_actual>0) {
                if(isset($_POST['disparar'])){
                    $X_Wing->disparar($value);
                    if($value->vida_actual>0){
                        $action = $value->escoger_accion();
                        if ($action == 1) {
                            $value->disparar($X_Wing);
                        } else {
                            $value->reparar();
                        }
                    }else{
                        $_SESSION['DTM'] = 'TIE Nº'.$value->numero_serie.' ha sido eliminado';
                        array_push($DeathList, $key);
                    }
                }else{
                    $X_Wing->reparar();
                    $action = $value->escoger_accion($X_Wing);
                    if ($action == 1) {
                        $value->disparar($X_Wing);
                    } else {
                        $value->reparar();
                    }
                }
            } else {
                session_destroy();
                session_start();
                clearData();
                $_SESSION['GameOverMessage']='¡GAME OVER!';
            }
        break;
        }
        foreach ($DeathList as $key){
            unset($TIE[$key]);
        }
        $_SESSION['X_WingCreatedMessage'] = 'X-Wing Nº'.$X_Wing->numero_serie."\n".'HP - '.$X_Wing->vida_actual."\n".'Shield - '.$X_Wing->escudo_actual."\nVS";
        $_SESSION['X_Wing'] = serialize($X_Wing);
        $_SESSION['TIE'] = serialize($TIE);
        if (count($TIE)==0){
            session_destroy();
            session_start();
            clearData();
            $_SESSION['GameOverMessage']='¡Victoria!';
        }
    } else {
        $_SESSION['NSS'] = 'No session registered';
    }
} else {
    $_SESSION['NSS'] = 'No session registered';
}
$TIEList = isset($_SESSION['TIE']) ? unserialize($_SESSION['TIE']) : '';
foreach ($TIEList as $key => $value) {
    $_SESSION['LTM'] = 'TIE Fighter Nº'.$value->numero_serie."\n".'HP - '.$value->vida_actual;
    break;
}
header('Location: index.php');