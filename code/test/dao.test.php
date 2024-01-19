<?php

include_once('../model/dao.class.php');
// REELLEMENT : toute données sensible ne doit pas apparaitre en clair.
// Passphrase : prise à partir d'un fichier
// Test



// PB AES256
try{

echo "<br>";
$dao = DAO::get();



// Ajoute l'article à la BD
echo "<br><p>Ajout element dans BD</p>";
echo "<br><p>Login : Gerard</p>";

echo "<br><p>Verif de l'ajout element dans BD<p>";

$select ="SELECT login, pgp_sym_decrypt(mdp, 'passphrase', 'cipher-algo=aes256'), pgp_sym_decrypt(mail, 'passphrase', 'cipher-algo=aes256'), dateinscription
From professeur
WHERE login = ?";

$selectData = [];
$selectData[] = "Gerardez";
$table = $dao->query($select, $selectData);


// On verifie si la ligne n'est pas déjà présente 
if(!$table){
    $data = [];
    $data[] = 'Gerardez';
    $data[] = 'bip';
    $data[] = 'boup@gmail.com';

    //$query = "INSERT INTO professeur (login, mdp, mail, dateinscription) VALUES (?, ?, ?, ?)";
    //$query = "INSERT INTO professeur (login, mdp, mail, dateinscription) VALUES (?, ?, ?, ?)";
    $query = "INSERT INTO professeur (login, mdp, mail, dateinscription) VALUES (?, pgp_sym_encrypt(?, 'passphrase', 'cipher-algo=aes256'), pgp_sym_encrypt(?, 'passphrase', 'cipher-algo=aes256'), current_timestamp)";
    // INSERT INTO professeur (login, mdp, mail, dateinscription) VALUES (pgp_sym_encrypt('boup', 'passphrase', 'cipher-algo=aes256'), pgp_sym_encrypt('boup', 'passphrase', 'cipher-algo=aes256'), pgp_sym_encrypt('bip@gmail.com', 'passphrase', 'cipher-algo=aes256'), current_timestamp);
    echo "Definition de la query est passée !";
    $dao->exec($query,$data);
    echo "Exec de la query est passée !";

}
//Verif insertion 
echo "<br><p>Verif de l'ajout element dans BD<p>";

$select ="SELECT login, pgp_sym_decrypt(mdp, 'passphrase', 'cipher-algo=aes256'), pgp_sym_decrypt(mail, 'passphrase', 'cipher-algo=aes256'), dateinscription
From professeur
WHERE login = ?";

$selectData = [];
$selectData[] = "Gerardez";
$table = $dao->query($select, $selectData);
var_dump($table);
echo "<br> Requete réussie ! ";
    
}catch(PDOException $e){
    echo "Pb detecté !!!!";
}

// Create une temp table
$create = "Create or replace temporary table tempTable as select * from professeur ";
$dao->exec($create);
echo "Create temp table effectué";

/*
// Récupère à partir de la BD.
echo "<br><p>Recup element dans BD<p>";

$select = "SELECT * FROM professeur WHERE login = ?";

$selectData = [];
$selectData[] = "Gerard";
$table = $dao->query($select, $selectData);
var_dump($table);
echo "<br> Requete réussie ! ";
*/
?>