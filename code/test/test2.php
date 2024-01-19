<?php
session_start();
$recup = $_SESSION['test'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Voici la page test 2
    <div> la valeur dans session est : <?=$recup?></div>
</body>
</html>