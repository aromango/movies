<?php
$warning="";

 // Filmen datuak berreskuratzeko array asoziatiboa
$filmak = [];
if (isset($_POST['filmak_hidden']) && !empty($_POST['filmak_hidden'])){
    $filmak= json_decode($_POST['filmak_hidden'], true);
}

// Formularioaren datuak hartu

$izena_post = isset($_POST['izena']) ? trim($_POST['izena']) : '';
$isan_post= isset($_POST['isan']) ? trim($_POST['isan']) : '';
$urtea_post = isset($_POST['urtea']) ? trim($_POST['urtea']) : '';
$puntuazioa_post= isset($_POST['puntuazioa']) ? trim($_POST['puntuazioa']) : '0';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // 1. Kasua: Izena eta ISAN hutsik
    if (empty($izena_post) && empty($isan_post)){
        $warning= "Kontuz: izena eta ISAN eremuak ezin dira biak hutsik egon";
    }
    // 2. Kasua: Filma gehitu
    else{
        $isan_existitzen_da=array_key_exists($isan_post, $filmak);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Erabiltzailearen filmak</h1>
    <div id="zerrenda">
        <p>Filmerik ez dago erregistratuta oraindik</p>
    </div>
    <hr>
    <?php if (!empty($warning)):?>
    <p style="color:red; font-weight:bold;"><?=$warning?></p>
    <?php endif; ?>    
    <h2>Filmen Formularioa</h2>
    <form action="main.php" method="POST">
        <div>
            <label>Filmaren izena:</label><br>
            <input type="text" id="izena" name="izena">
        </div>
        <br>

        <div>
            <label>ISAN</label><br>
            <input type="text" id="isan" name="isan">
        </div>
        <br>

        <div>
            <label>Urtea</label><br>
            <input type="text" id="urtea" name="urtea">
        </div>
        <br>
        <div>
            <label>Puntuazioa:</label><br>
            <select id="puntuazioa" name="puntuazioa">
                <option value="0">0</option>
                <option value="0">1</option> 
                <option value="0">2</option> 
                <option value="0">3</option> 
                <option value="0">4</option> 
                <option value="0">5</option>
            </select>
        </div>
        <br>
        <button type="submit">Bidali</button>
</form>
<?php









?>
</body>
</html>