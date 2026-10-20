<?php
session_start();

$error="";

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $izena=isset($_POST['erabiltzailea']) ? trim($_POST['erabiltzailea']) : '';
    if (!empty($izena)){
        $_SESSION['erabiltzailea'] = $izena;
        header("Location: main.php");
        exit();
    }
    else{
        $error="Mesedez, sartu zure izena jarraitzeko.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Movies</title>
</head>
<body>
    
    <h1>Ongi etorri TOP Movies aplikaziora</h1>
    <?php if(!empty($error)):?>
        <p style="color:red;font-weight:bold;"><?= htmlspecialchars($error)?></p>
    <?php endif;?>

    <form action="index.php" method="POST">
        <div>
            <label for="erabiltzailea">Sartu zure izena:</label><br>
            <input type="text" id="erabiltzailea" name="erabiltzailea" required>
        </div>
        <br>
        <button type="submit">Sartu</button>
    </form>
</body>
</html>