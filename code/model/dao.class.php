<?php

function authentificationData($filename) : array{

  $tab = array();
  $delimiter = '|';

  $AuthentificationData = fopen($filename, 'r');

  if ($AuthentificationData == false) {
      exit("Cannot read $filename");
  }

  // Tant que l'on a pu lire une ligne
  while (!feof($AuthentificationData)) {
      // Récupère tous les élements d'une ligne
      $line = rtrim(fgets($AuthentificationData));
      
      // Ignore les lignes vides
      if (!empty($line)) {
          // Sépare les données en utilisant le délimiteur
          $data = explode($delimiter, $line);
          // Stocke ces éléments dans le tableau
          $tab[] = $data;
      }
  }

  fclose($AuthentificationData);

  //var_dump($tab);

  return $tab;
}






class DAO
{
  // le singleton de la classe : l'unique objet
  private static $instance = null;

  // L'objet local PDO de la base de donnée
  private $db;

  // Le type, port, le chemin et le nom de la base de donnée
  private $database;

  #Constructeur chargé d'ouvrir la BD
  private function __construct()
  {
    $this->database = authentificationData(__DIR__.'/../../noGit/texteMDP.txt');

    $host = $this->database[0][0];
    $port = $this->database[0][1];
    $dbname = $this->database[0][2];
    $user = $this->database[0][3];
    $password = $this->database[0][4];
    try {
        $this->db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
        if (!$this->db) {
            throw new Exception("Impossible d'ouvrir " . $this->database);
        }
        // Positionne PDO pour lancer les erreurs sous forme d'exceptions
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Attrape l'exception pour y ajouter la requête
        throw new PDOException(__METHOD__ . " at " . __LINE__ . ": " . $e->getMessage() . " DataBase=\" POSTGRESQL");
    }
    //echo 'Connexion à la BD ==> SUCCESS'."\n";
  }

  // Méthode statique pour acceder au singleton
  public static function get(): DAO
  {
    // Si l'objet n'a pas encore été crée, le crée
    if (is_null(self::$instance)) {
      self::$instance = new DAO();
    }
    return self::$instance;
  }

  // Lance une requête sur la BD, et retourne une table
  // C'est une requête préparée avec des '?' à la place des données
  // Les données sont à passer séparément dans le même ordre dans $data
  public function query(string $query, array $data=[]): array
  {
    try {
      // Compile la requête, produit un PDOStatement
      $s = $this->db->prepare($query);
      // Exécute la requête avec les données
      $s->execute($data);
    } catch (Exception $e) {
      // Attrape l'exception pour y ajouter la requête
      throw new PDOException(__METHOD__ . " at " . __LINE__ . ": " . $e->getMessage() . " Query=\"" . $query . '"');
    }

    // Affiche en clair l'erreur PDO si la requête ne peut pas s'exécuter
    if ($s === false) {
      throw new PDOException(__METHOD__ . " at " . __LINE__ . ": " . implode('|', $this->db->errorInfo()) . " Query=\"" . $query . '"');
    }
    $table = $s->fetchAll();
    return $table;
  }


  // Exécute une requête sur la BD. Pas de retour
  public function exec(string $query, array $data=[]): void
  {
    // 
    try {
      // Compile la requête, produit un PDOStatement
      $s = $this->db->prepare($query);
      // Verif si prepare est passé.
      if ($s === false) {
        throw new PDOException(
            __METHOD__ . " at " . __LINE__ . ": " . "Query: \"" . $query . "\", Failed to prepare statement."
        );
      }

      // Exécute la requête avec les données
      $r = $s->execute($data);
      // Affiche en clair l'erreur PDO si la requête ne peut pas s'exécuter
      if ($r === false) {
        $errorInfo = $this->db->errorInfo();
        $errorMessage = implode('|', $errorInfo);
        throw new PDOException(
          __METHOD__ . " at " . __LINE__ . ": " . "Query: \"" . $query . "\", Data: " . implode(', ', $data) . ", Error: " . $errorMessage
        );
      }

    } catch (Exception $e) {
      // Attrape l'exception pour y ajouter la requête
      throw new PDOException(__METHOD__ . " at " . __LINE__ . ": " . $e->getMessage() . " Query=\"" . $query . '"');
    }

    // Affiche en clair l'erreur PDO si la requête ne peut pas s'exécuter
    if ($r === false) {
      throw new PDOException(__METHOD__ . " at " . __LINE__ . ": ".implode('|', $this->db->errorInfo()) . " Query: \"" . $query . '"');
    }
    // 
  }


}
?>
