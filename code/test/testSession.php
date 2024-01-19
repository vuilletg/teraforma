<?php
session_start();
$_SESSION['test'] = "ce texte est dans la session";

$test = $_SESSION['test'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Test de la session </h1>

    <h2><?= $test?></h2>

    <form action="test2.php" method="post">
        <input type="submit" name="" id="">
    </form>
</body>
</html>