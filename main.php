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

$filmak_bistaratu=$filmak;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // 1. Kasua: Izena eta ISAN hutsik
    if (empty($izena_post) && empty($isan_post)){
        $warning= "Kontuz: izena eta ISAN eremuak ezin dira biak hutsik egon";
    }
    else{
        $isan_existitzen_da=array_key_exists($isan_post, $filmak);

        //5.Kasua: ISANa jarri eta izena hutsa =ezabatu

        if(!empty($isan_post) && empty($izena_post)){
            if($isan_existitzen_da){
                unset($filmak[$isan_post]);
                $filmak_bistaratu=$filmak;

                $isan_post = '';
                $urtea_post = '';
                $puntuazioa_post = '0';
            }
            else{
                $warning= "ISAN-a ez da existitzen zerrendan!";
            }
        }
        //3.Kasua ISAN hutsa badago eta izena beteta, bilatu filma
        else if(empty($isan_post) && !empty($izena_post)){
            $emaitzak=[];
            $bilatu= strtolower($izena_post);

            foreach($filmak as $isan => $film){
                if(strpos(strtolower($film['izena']), $bilatu) !==false){
                    $emaitzak[$isan]=$film;
                }
            }
            if (empty($emaitzak)){
                $warning="Ez da aurkitu '$izena_post' izeneko filmerik";
            }
            else{
                $filmak_bistaratu=$emaitzak;
            }
        }

    // 4. Kasua: ISANa eguneratu existitzen bada

        else if($isan_existitzen_da && !empty($izena_post) && !empty($urtea_post)){
            $filmak[$isan_post]['izena'] = $izena_post;
            $filmak[$isan_post]['puntuazioa'] = $puntuazioa_post;
            $filmak_bistaratu=$filmak;

            // Formularioa garbitu
            $izena_post = '';
            $isan_post = '';
            $urtea_post = '';
            $puntuazioa_post = '0';

        }
        //2. ISAN berria gehitu formulariora
        else if(!$isan_existitzen_da && strlen($isan_post) == 8 && !empty($izena_post) && !empty($urtea_post)){

            $filmak[$isan_post]=[
                'izena' => $izena_post,
                'urtea' => $urtea_post,
                'puntuazioa' => $puntuazioa_post
            ];

            $filmak_bistaratu=$filmak;
            $izena_post="";
            $isan_post="";
            $urtea_post="";
            $puntuazioa_post="0";
        }
        else if (!$isan_existitzen_da){
            $warning="Kontuz: eremu guztiak bete behar dira eta ISAN-ak 8 digitu izan behar ditu!";
        }
    
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
    <nav style="background: #f0f0f0; padding: 10px; margin-bottom: 15px;">
    <strong>Aldatu bertsioa:</strong>
    <a href="main.php">Main (Hidden)</a> | 
    <a href="cookies.php">Cookies</a> | 
    <a href="session.php">Session</a>
</nav>
    <h1>Erabiltzailearen filmak</h1>
    <div id="zerrenda">
        <?php if (empty($filmak)): ?>
            <p>Filmerik ez dago erregistratuta oraindik</p>
        <?php else: ?>
            <table border="1" style="border-collapse: collapse; padding: 5px;">
                <thead>
                    <tr>
                        <th>ISAN</th>
                        <th>Izena</th>
                        <th>Urtea</th>
                        <th>Puntuazioa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($filmak_bistaratu as $isan => $film): ?>
                        <tr>
                            <td><?= htmlspecialchars($isan) ?></td>
                            <td><?= htmlspecialchars($film['izena']) ?></td>
                            <td><?= htmlspecialchars($film['urtea']) ?></td>
                            <td><?= htmlspecialchars($film['puntuazioa']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <hr>
    <?php if (!empty($warning)):?>
    <p style="color:red; font-weight:bold;"><?=$warning?></p>
    <?php endif; ?>    
    <h2>Filmen Formularioa</h2>
    <form action="main.php" method="POST">
        <!-- Ezkutuko eremua array-a orriz orri mantentzeko -->
        <input type="hidden" name="filmak_hidden" value="<?= htmlspecialchars(json_encode($filmak)) ?>">

        <div>
            <label for="izena">Filmaren izena:</label><br>
            <input type="text" id="izena" name="izena" value="<?= htmlspecialchars($izena_post) ?>">
        </div>
        <br>

        <div>
            <label for="isan">ISAN (8 digitu):</label><br>
            <input type="text" id="isan" name="isan" value="<?= htmlspecialchars($isan_post) ?>">
        </div>
        <br>

        <div>
            <label for="urtea">Urtea:</label><br>
            <input type="text" id="urtea" name="urtea" value="<?= htmlspecialchars($urtea_post) ?>">
        </div>
        <br>
        <div>
            <label for="puntuazioa">Puntuazioa:</label><br>
            <select id="puntuazioa" name="puntuazioa">
                <?php for ($i = 0; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>" <?= ($puntuazioa_post == (string)$i) ? 'selected' : '' ?>>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>
        <br>
        <button type="submit">Bidali</button>
    </form>
</body>
</html>