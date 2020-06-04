<?php
session_start();
$welcomeMessage = isset($_SESSION['TIE']) && isset($_SESSION['X_Wing']) ? '' : '¡Welcome to the Star Wars Battle 2!';
$deadTIEMessage = isset($_SESSION['DTM']) ? $_SESSION['DTM'] : '';
$gameOverMessage = isset($_SESSION['GameOverMessage']) ? $_SESSION['GameOverMessage'] : '';
$xwingCreatedMessage = isset($_SESSION['X_WingCreatedMessage']) ? $_SESSION['X_WingCreatedMessage'] : '';
$serialNumberError = isset($_SESSION['SNE']) ? $_SESSION['SNE'] : '';
$liveTIEMessage = isset($_SESSION['LTM']) ? $_SESSION['LTM'] : '';
$X_Wing = isset($_SESSION['X_Wing']) ? unserialize($_SESSION['X_Wing']) : '';
$TIE = isset($_SESSION['TIE']) ? unserialize($_SESSION['TIE']) : '';
$notSessionStarted = isset($_SESSION['NSS']) ? $_SESSION['NSS'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Corben" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nobile" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stylesheet.css">
    <title>StarWarsBattle2</title>
</head>
<body>
    <div class="content">
        <h1 class="h1-center">Star Wars Battle 2</h1>
        <div class="row">
            <div class="col-sm">
                <form action="./play.php" method="POST">
                    Serial Number <span><?php echo $serialNumberError; ?></span>
                    <input type="text" name="numero_serie" id="numero_serie" placeholder="Introduce serial number...">
                    R2D2
                    <label class="container">
                        <input type="checkbox" name="r2d2" id="r2d2">
                        <span class="checkmark"></span>
                    </label>
                    <button name="play" id="play">PLAY</button>
                </form>
            </div>
            <div class="col-sm">
                <form action="./action.php" method="POST">
                    Choose Action
                    <div style="display: flex; justify-content: center;">
                        <button name="disparar" id="disparar" class="action">ATTACK</button>
                        <button name="reparar" id="reparar" class="action">REPAIR</button>
                    </div>
                </form>
                <span><?php echo $notSessionStarted; ?></span>
                <textarea name="welcome" id="welcome" cols="80" rows="10" disabled value=""><?php echo $welcomeMessage."\n".$xwingCreatedMessage."\n".$liveTIEMessage."\n".$deadTIEMessage."\n".$gameOverMessage."\n";?>
                </textarea>
            </div>
        </div>
    </div>
</body>
</html>