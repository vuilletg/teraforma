<?php
session_start();
include_once(__DIR__.'/../../model/dao.class.php');
$success = 0;
$msg = [];
$bMdp = false;

/*$_POST['login'] = "test";
$_POST['mdp'] = "Testtest88!!";*/

if(!empty($_POST['login']) AND !empty($_POST['mdp'])){
    $login = htmlspecialchars(strip_tags($_POST['login']));
    $mdp = $_POST['mdp'];

    if(strlen($mdp) >= 12 && strlen($login)<=20){
        $dao = DAO::get();
        $select = "SELECT * FROM professeur WHERE login = ?";
        $dataSelect = [];
        $dataSelect[] = $login;
        $table = $dao->query($select, $dataSelect);

        if ($table!=null){

            $selectLogin = "SELECT login, mdp  FROM professeur WHERE login = ?";
            $dataLogin = [];
            $dataLogin[] = $login;
            $passwordFind = $dao->query($selectLogin, $dataLogin);
            if($passwordFind[0] != null && password_verify($mdp,$passwordFind[0][1])){
                
                $success = 1;
                $msg[] = "professeur connecté";
                $_SESSION['loginProfesseur'] = $login;
                
            }
        }
    }
}else{
    $success = 2;
    $msg[] = "Veuillez entrer tous les champs";
}
if($success === 0){
    $msg[] = "Votre login / mot de passe est incorrect";
}
header('Content-Type: application/json');
$res = ["success" => $success, "msg" => $msg];
echo json_encode($res);
