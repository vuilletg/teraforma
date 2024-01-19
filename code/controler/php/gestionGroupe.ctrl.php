<?php
session_start();
// 
// Inclusion du framework
include_once(__DIR__.'/../../framework/view.class.php');
// Inclusion du modèle
include_once(__DIR__.'/../../model/classe.class.php');
include_once(__DIR__.'/../../model/eleve.class.php');

////////////////////////////////////////////////////////////////////////////
// Récupération des données
////////////////////////////////////////////////////////////////////////////

// Ouverture de la sessions pour récupérer le pattern s'il existe
$loginProf = $_SESSION['loginProfesseur'] ??'';
$nomClasse = $_SESSION['classe'] ?? '';
$nbEleve = $_SESSION['nbEleve'] ?? '';

////////////////////////////////////////////////////////////////////////////
// Activation du modèle
////////////////////////////////////////////////////////////////////////////

// Est-ce qu'il y a des données à ajouter ?
// Il faut soit un nom soit un prénom
if ($loginProf != '' && $nomClasse != '' && $nbEleve != '') {
    $classe = new Classe($nomClasse,$nbEleve,$loginProf);
    $planetes = $classe->getPlanetes();
    $eleves = $classe->getEleves();
} 
////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

// Conserve l'information du pattern
$view->assign('planetes', $planetes);
$view->assign('eleves',$eleves);

$view->display(__DIR__.'/../../view/listeEleves.php');
?>
