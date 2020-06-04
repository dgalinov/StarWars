<?php
include_once 'X-Wing.php';
include_once 'TIE_figther.php';

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['play'])) {
    $numero_serie = isset($_POST['numero_serie']) ? $_POST['numero_serie'] : '';
    $shield = '';
    if ((!empty($numero_serie)) && (is_numeric($numero_serie))) {
        $numero_serie = test_input($numero_serie);
        session_start();
        if (!isset($_SESSION['X_Wing'])) {
            session_destroy();
            session_start();
            $X_Wing = isset($_SESSION['X_Wing']) ? unserialize($_SESSION['X_Wing']) : '';
            $arrayTIE = isset($_SESSION['arrayTIE']) ? $_SESSION['arrayTIE'] : array();
            if(empty($_POST['r2d2'])) {
                $R2D2_incorporado = false;
                $shield = 0;
            } else {
                $R2D2_incorporado = true;
                $shield = 10;
            }
            $arrayTIE = array(
                new TIE_Fighter(1, 'Imperio', 10, 10, 2),
                new TIE_Fighter(2, 'Imperio', 10, 10, 2),
                new TIE_Fighter(3, 'Imperio', 10, 10, 2),
                new TIE_Fighter(4, 'Imperio', 10, 10, 2),
                new TIE_Fighter(5, 'Imperio', 10, 10, 2)
            );
            $X_Wing = new X_Wing($numero_serie, 'Republica', 20, 20, 4, $R2D2_incorporado, $shield, $shield);
            foreach ($arrayTIE as $key => $value) {
                $_SESSION['LTM'] = 'TIE Fighter Nº'.$value->numero_serie."\n".'HP - '.$value->vida_actual;
                break;
            }
            $_SESSION['X_Wing'] = serialize($X_Wing);
            $_SESSION['TIE'] = serialize($arrayTIE);
            $_SESSION['X_WingCreatedMessage'] = 'X-Wing Nº'.$X_Wing->numero_serie."\n".'HP - '.$X_Wing->vida_actual."\n".'Shield - '.$X_Wing->escudo_actual."\nVS";
            header('Location: index.php');
        } else {
            $X_Wing = isset($_SESSION['X_Wing']) ? unserialize($_SESSION['X_Wing']) : '';
            $arrayTIE = isset($_SESSION['TIE']) ? $_SESSION['TIE'] : array();
            $_SESSION['X_WingCreatedMessage'] = 'Finish the last game'."\n".'X-Wing Nº'.$X_Wing->numero_serie."\n".'HP - '.$X_Wing->vida_actual."\n".'Shield - '.$X_Wing->escudo_actual."\nVS";
            header('Location: index.php');
        }
    } else {
        session_start();
        $_SESSION['SNE'] = ' - This must be a integer';
        header('Location: index.php');
    }
}
