<?php
session_start();

include_once('../../model/dao.class.php');

$success = 0;
$msg = [];

/*$_SESSION['loginProfesseur'] = 'test';
$_POST['nbEleve'] = 15;
$_POST['nomClasse'] = "tessst";
$_POST['login'] = "prof";*/



if(!empty($_POST['nomClasse']) AND !empty($_POST['nbEleve'])){
    $nom = htmlspecialchars(strip_tags($_POST['nomClasse']));
    $nb = $_POST['nbEleve'];
    if (!isset($_SESSION['loginProfesseur'])) {
        $success = 5; 
        $msg[] = "Session not set";
    } else {
        $login = htmlspecialchars(strip_tags($_SESSION['loginProfesseur']));
    }

    if (filter_var($nb, FILTER_VALIDATE_INT) !== false) {
        // La saisie de l'utilisateur est un nombre entier
        $nb = intval($nb); // Convertir la saisie en entier
    } else {
        // La saisie de l'utilisateur n'est pas un nombre entier
        $success = 2;
        $msg[] = "Veuillez entrer un nombre valide";
    }
    if (strlen($nom)>=20){
        if($success===2){
            $success = 23;
            $msg[] = "Le nom de votre classe ne doit pas avoir plus de 20 charactères";
        }else{
            $success = 3;
            $msg[] = "Le nom de votre classe ne doit pas avoir plus de 20 charactères";
        }
    }
}else{
    $msg[] = "Veuillez entrer tous les champs";
    $success = 1;
}

if($success === 0){
    try{
    $dao = DAO::get();
    $select = "SELECT * FROM classe WHERE nomclasse = ? and loginprofesseur = ?";
    $dataSelect = [];
    $dataSelect[] = $nom;
    $dataSelect[] = $login;
    $table = $dao->query($select, $dataSelect);
    

    if(!$table){
        # insertion du compte dans la base de donnée
        $dataInsert = [];
        $dataInsert[] = $nom;
        $dataInsert[] = $nb;
        $dataInsert[] = $login;

        $query = "INSERT INTO classe (nomclasse,nombreeleve,loginprofesseur) VALUES (?,?,?)";
        $dao->exec($query,$dataInsert);

        $_SESSION['classe'] = $nom;
        $_SESSION['nbEleve'] = $nb;
        
        $msg[] = "La classe a ete creer";
        $success = 0;
    
    }else{
        $success = 4;
        $msg[] = "Impossible de creer la classe : la classe existe deja veuillez choisir un autre nom";
    }}catch (Exception $e){
        $msg[] = $e->getMessage(); 
    }
}

header('Content-Type: application/json');
$res = ["success" => $success, "msg" => $msg];
echo json_encode($res);

?>