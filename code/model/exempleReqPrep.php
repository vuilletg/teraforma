<?php
// Accès à l'instance du DAO
$dao = DAO::get();


// Ajouter dans l'ordre les données que l'on veut insérer : VALUES (X,X,X)
$data = [];
$data[] = 'login';

// Faire la requete : ? sera remplacé l'élement dans data[] dans l'ordre d'apparition
$query = "Select * from Professeur where login = ?";

// Appelle de la méthode de la classe DAO dont on a besoin : exec pour les insertions ; query pour les select
// Cette fonction retourne une table de table
$table = $dao->query($query,$data);

//________________________________________________________________________________________
//                  CHIFFREMENT DES DONNÉES



// HASHAGE avec PASSWORD_HASH($mdp, PASSWORD_DEFAULT); ou PASSWORD_BCRYPT
// AVEC DU HASHAGE, ON NE PEUT PAS REVENIR EN ARRIÈRE.


$data = [];
$data[] = password_hash('login', PASSWORD_BCRYPT); 
$data[] = password_hash('Login1234!',PASSWORD_BCRYPT);
$data[] = password_hash('login@mail.com',PASSWORD_BCRYPT);

$query = "INSERT INTO professeur VALUES (login, mdp, mail,dateinscription) (?,?,?,current_timestamp)";
$dao->exec($query,$data); // Exec ne retourne rien


// Pour VÉRIFIER les données :

$data = [];

$data[] = 'login'; // Ne sera pas chiffré car on n'utilisera pas pgp_sym_encrypt sur le premier '?'
// Cette fois 'login' est en dernier car il s'agit du dernier '?'
// Vaut mieux prédéfinir les colonne que l'on veut en mettant le nom de la colonne

$query = "SELECT Dateinscription
From professeur
WHERE login = ?";
$table = $dao->query($query,$data);




// Le mot de passe Ã  hacher
$motDePasse = "votre_mot_de_passe";

// GÃ©nÃ©rer le hachage du mot de passe
$hashMotDePasse = password_hash($motDePasse, PASSWORD_BCRYPT);

// Afficher le hachage du mot de passe
echo "Mot de passe hachee : " . $hashMotDePasse;

//////////////////////////////////////////////////////////////////////////////////////////
// Pour vérifier SI C'EST GOOD
//////////////////////////////////////////////////////////////////////////////////////////

// Mot de passe saisi par l'utilisateur lors de la connexion, par exemple
$motDePasseSaisi = "JeSappelleGrout8!";

// Hachage stocké dans la base de données (remplacez ceci par le hachage réel stocké)
$hashStocke = "";

// Vérifier si le mot de passe saisi correspond au hachage stocké
if (password_verify($motDePasseSaisi, $hashStocke)) {
    echo "Mot de passe valide!";
} else {
    echo "Mot de passe invalide!";
}


?>
