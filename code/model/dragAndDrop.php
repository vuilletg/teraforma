<?php
 
 include_once(__DIR__.'./dao.class.php');
  
  // Acces au DAO
  $dao = DAO::get();
  $data = [];
  $data[] = 6;
  $query = "SELECT * FROM question WHERE id = ?";
  $table = $dao->query($query, $data);

  // Tests si pas trouvé
  if (count($table) == 0) {
    throw new Exception("Question non trouvé id=$id");
  }
  
  // Transformation en un objet de la première ligne
  $row = $table[0];
  $reponse = array($row['enonceQuestion'], $row['listePropositions'], $row['reponseCorrecte']);
  echo json_encode($reponse);
  // fin méthode read
?>
