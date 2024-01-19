<?php
include_once (__DIR__.'/../model/dao.class.php');

session_start();

/*$_POST['login'] = "potatoes1045";
$_POST['mdp'] = "Testtest88!!";
$_POST['mdp2'] = "Testtest88!!";
$_POST['confirm'] = "ok";
$_POST['mail'] = "test@gmail.com";*/

$success = 1;
$msg = array();

$bLogin = false;
$bMdp = false;
$bMail = false;

if(!empty($_POST['login']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['mail']) AND !empty($_POST['checkbox'])){
    $login = htmlspecialchars(strip_tags($_POST['login']));
    $password = $_POST['mdp'];
    $password2 = $_POST['mdp2'];
    $mail = $_POST['mail'];

    if (strlen($password) >= 12){
        // Au moins une lettre majuscule
        if(preg_match('/[A-Z]/', $password)){

            // Au moins une lettre minuscule
            if(preg_match('/[a-z]/', $password)){

                // Au moins un chiffre
                if(preg_match('/[0-9]/', $password)){

                    // Au moins un caractère spécial
                    if(preg_match('/[^a-zA-Z0-9]/', $password)){
                        if($password == $password2){
                            $bMdp = true;
                        } else{
                            $msg[] = "Les deux mots de passe ne correspondent pas";
                            $success = 2;
                        }
                    } else {
                        $msg[] = "Votre mot de passe doit contenir au moin un charactere spécial";
                        $success = 2;
                    }
                } else{
                    $msg[] = "Votre mot de passe doit contenir au moin un chiffre";
                    $success = 2;
                }
            } else{
                $msg[] = "Votre mot de passe doit contenir au moin une minuscule";
                $success = 2;
            }
        } else {
            $msg[] = "Votre mot de passe doit contenir au moin une majuscule";
            $success = 2;
        }
    } else{
        $msg[] = "Votre mot de passe doit contenir au minimum 12 characteres";
        $success = 2;
    }

    if(strlen($login) < 20){
        $bLogin = true;
    } elseif($success == 2){
        $msg[] = "Votre login doit contenir moins de 20 charactères";
        $success = 23;
    }else{
        $msg[] = "Votre login doit contenir moins de 20 charactères";
        $success = 3;
    }

    
    if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $bMail = true;
    }elseif($success == 23){
        $msg[] = "Votre mail n'est pas valide";
        $success = 234;
    }elseif($success == 2){
        $msg[] = "Votre mail n'est pas valide";
        $success = 24;
    }elseif($success == 3){
        $msg[] = "Votre mail n'est pas valide";
        $success = 34;
    }else{
        $msg[] = "Votre mail n'est pas valide";
        $success = 4;
    }
    
    
    
} else{
    $msg[] = "Veuillez entrer tous les champs";
}

if($bLogin & $bMail & $bMdp){

    $dao = DAO::get();
    $select = "SELECT * FROM professeur WHERE login = ?";
    $dataSelect = [];
    $dataSelect[] = $login;
    $table = $dao->query($select, $dataSelect);

    if(!$table){
        $date = date('j F Y');


        $dataInsert = [];
        $dataInsert[] = $login;
        $dataInsert[] = password_hash($password,PASSWORD_BCRYPT);
        $dataInsert[] = password_hash($mail,PASSWORD_BCRYPT);
        #$dataInsert[] = $date;

        try{
        $query = "INSERT INTO professeur (login, mdp, mail,dateConnexion) VALUES (?,?,?,current_timestamp)";
        $dao->exec($query,$dataInsert);
        }catch (PDOException $e){

        }
        
        $msg[] = "l'utilisateur est inscrit";
        $success = 0;

        $_SESSION['loginProfesseur'] = $login;

        $msg[] = $_SESSION['loginProfesseur']; 

    }else{
        $success = 5;
        $msg[] = "Impossible de creer le compte : l'utilisateur existe deja veuillez choisir un autre login";
    }
}

header('Content-Type: application/json');
$res = ["success" => $success, "msg" => $msg];
echo json_encode($res);

?>