<?php
include_once('../model/professeur.class.php');

$mdp = password_hash("bidiboupbdidbadoup", PASSWORD_DEFAULT);
// Création d'un professeur de login 'benhamin'
$prof = new Professeur('benhamin', $mdp, 'benhamin@gmail.com');

// On vérifie sa dernière date de connexion
$date = $prof->getDateConnexion();
// Verif de la date
var_dump($date);

// On update sa date de connexion à la date d'ajd
$prof->setDateConnexion();
// On vérifie sa dernière date de connexion actualisée
$date = $prof->getDateConnexion();
// Verif de la date insérée
var_dump($date);


// On récupère une liste classe vide 
$classes = $prof->getClasses();
var_dump($classes);
?>