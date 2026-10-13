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
</body>
</html>