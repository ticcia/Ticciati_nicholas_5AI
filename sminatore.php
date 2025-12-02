<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sminatore matematico</title>
</head>
<body>
<h2>Sminatore Matematico</h2>
<form action="sminatore.php" method="get">

    divisore: <input type="text" name="numero" value="">
    <button name="cancella">Cancella</button>
    <button name="reset">Nuova partita</button>
</form>
</body>
</html>

<?php
session_start();

$numeri_iniziali=[30,35,60,13,5,77];

if (!isset($_SESSION['numeri']) || isset($_GET['reset'])) {

    $_SESSION['numeri'] = [];
    foreach ($numeri_iniziali as $n) {
        $_SESSION['numeri'][$n] = "valido";
    }

    $_SESSION['mosse'] = 0;
}

if (isset($_GET['numero'])) {
    $numero = $_GET['numero'];
} else {
    $numero = 0;
}

if(isset($_GET['cancella']) && $numero !=0){
    $_SESSION['mosse'] ++;
    foreach ($_SESSION['numeri'] as $val => $stato) {
        if ($stato == "valido" && $numero != 0 && ($val % $numero) == 0) {
            $_SESSION['numeri'][$val] = "cancellato";
        }
    }
}

echo "Numeri:";

$valori_validi=[];
foreach ($_SESSION['numeri'] as $n => $stato) {
    if ($stato == "valido") {
        echo $n."   ";
        $valori_validi[] = $n;
    }
}
echo "<br>";

echo "Numero mosse effuttaute:".$_SESSION['mosse'];

echo "<br>";

if (count($valori_validi) == 0) {
    echo "Hai vinto effettuando ".$_SESSION['mosse']." mosse!";
}