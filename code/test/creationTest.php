<?php
    include_once ('../model/dao.class.php');
    $success = 0;
    if($success == 0){
        $msg[] = "utilisateur entré en bd";
    
        $dao = DAO::get();
        $select = "SELECT * FROM professeur WHERE login = ?";
        $dataSelect = [];
        $dataSelect[] = $login;
        $table = $dao->query($select, $dataSelect);
    
        echo "la query est bien passé";

        echo $table;
        
        if($table){
            $date = date('j F Y');
            //$password = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
            //$password2 = password_hash($_POST['mdp2'], PASSWORD_DEFAULT);
            # insertion du compte dans la base de donnée
            
            echo "if passé";

            $dataInsert = [];
            $dataInsert[] = $login;
            $dataInsert[] = $password;
            $dataInsert[] = $mail;
            #$dataInsert[] = $date;
    
            $query = "INSERT INTO professeur (login, mdp, mail) VALUES (?, pgp_sym_encrypt(?, 'passphrase', 'cipher-algo=aes256'), pgp_sym_encrypt(?, 'passphrase', 'cipher-algo=aes256'))";
            $dao->exec($query,$dataInsert);
            echo "utilisateur entré";
            
            $msg[] = "l'utilisateur est inscrit";
        }else{
            $msg[] = "Impossible de creer le compte : l'utilisateur existe deja veuillez choisir un autre login";
        }
    }


        
    echo json_encode($msg);