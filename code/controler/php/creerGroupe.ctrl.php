<?php
session_start();

include_once("../../model/dao.class.php");

$success = 0;
$msg = [];

$nomClasse = $_SESSION['classe'];
$loginProfesseur = $_SESSION['loginProfesseur'];
/*$nomClasse = "tessst";
$loginProfesseur = "test";
$_POST['groupe'] = "ceciestungroupe";*/


if(!empty($_POST['groupe'])){
    $groupe = htmlspecialchars(strip_tags($_POST['groupe']));

    if (strlen($groupe)>=20){
        $success = 1;
        $msg[] = "Le nom du groupe ne doit pas avoir plus de 20 charactères";
    }

}else{
    $msg[] = "Veuillez entrer tous les champs";
    $success = 1;
}

if($success === 0){
    $dao = DAO::get();
    $select = "SELECT * FROM planete WHERE nom = ? and nomClasse = ? and loginprofesseur = ?";
    $dataSelect = [];
    $dataSelect[] = $groupe;
    $dataSelect[] = $nomClasse;
    $dataSelect[] = $loginProfesseur;
    $table = $dao->query($select, $dataSelect);

    if(!$table){
        # insertion du compte dans la base de donnée
        $dataInsert = [];
        $dataInsert[] = $groupe;
        $dataInsert[] = $nomClasse;
        $dataInsert[] = $loginProfesseur;

        
        $query = "INSERT INTO planete (nom,nomclasse, loginprofesseur) VALUES (?,?,?)";
        $dao->exec($query,$dataInsert);
        
        
        $msg[] = "Le groupe a ete créer";
        $success = 0;
    }else{
        $success = 1;
        $msg[] = "Impossible de creer le goupe : un groupe du meme nom existe deja, veuillez choisir un autre nom";
    }
}

header('Content-Type: application/json');
$res = ["success" => $success, "msg" => $msg];
echo json_encode($res);

?>