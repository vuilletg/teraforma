<?php
session_start();
include_once(__DIR__.'/../../model/dao.class.php');
$success = 0;
$msg = [];


/*$_POST['mdp'] = "Testtest88!!";
$_POST['login'] = "prof";*/

$loginProfesseur = $_SESSION['loginProfesseur'];
$nomclasse = $_SESSION['classe'];

if(!empty($_POST['login']) AND !empty($_POST['mdp'])){
    $login = htmlspecialchars(strip_tags($_POST['login']));
    $mdp = $_POST['mdp'];

    if (strlen($mdp) >= 12){
        // Au moins une lettre majuscule
        if(preg_match('/[A-Z]/', $mdp)){

            // Au moins une lettre minuscule
            if(preg_match('/[a-z]/', $mdp)){

                // Au moins un chiffre
                if(preg_match('/[0-9]/', $mdp)){

                    // Au moins un caractère spécial
                    if(preg_match('/[^a-zA-Z0-9]/', $mdp)){
                        $bMdp = true;
                    } else {
                        $msg[] = "Le mot de passe doit contenir au moin un charactere spécial";
                        $success = 2;
                    }
                } else{
                    $msg[] = "Le mot de passe doit contenir au moin un chiffre";
                    $success = 2;
                }
            } else{
                $msg[] = "Le mot de passe doit contenir au moin une minuscule";
                $success = 2;
            }
        } else {
            $msg[] = "Le mot de passe doit contenir au moin une majuscule";
            $success = 2;
        }
    } else{
        $msg[] = "Le mot de passe doit contenir au minimum 12 characteres";
        $success = 2;
    }
   
    if (strlen($login)>=20){
        if($success===2){
            $success = 23;
            $msg[] = "Le pseudo de l'eleve ne doit pas avoir plus de 20 charactères";
        }else{
            $success = 3;
            $msg[] = "Le pseudo de l'eleve ne doit pas avoir plus de 20 charactères";
        }
    }
}else{
    $msg[] = "Veuillez entrer tous les champs";
    $success = 1;
}

if($success === 0){
    $dao = DAO::get();
    $select = "SELECT * FROM eleve WHERE logineleve = ?";
    $dataSelect = [];
    $dataSelect[] = $login;
    $table = $dao->query($select, $dataSelect);

    if(!$table){
        # insertion du compte dans la base de donnée
        $dataInsert = [];
        $dataInsert[] = $login;
        $dataInsert[] = password_hash($mdp,PASSWORD_BCRYPT);
        $dataInsert[] = $loginProfesseur;
        $dataInsert[] = $nomclasse;

        try{
        $query = "INSERT INTO eleve (logineleve,mdpeleve,dateconnexion, loginprofesseur,nomclasse) VALUES (?,?,current_timestamp, ?, ?)";
        $dao->exec($query,$dataInsert);
        }catch (PDOException $e){
            $success = 10;
        }
        
        $msg[] = "L'eleve a ete creer";
        $success = 0;

    }else{
        $success = 4;
        $msg[] = "Impossible de creer l'eleve : un eleve du meme nom existe deja, veuillez choisir un autre nom";
    }
}

header('Content-Type: application/json');
$res = ["success" => $success, "msg" => $msg];
echo json_encode($res);

?>