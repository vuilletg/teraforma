<?php


include_once(__DIR__.'/eleve.class.php');
include_once(__DIR__.'/dao.class.php');
include_once(__DIR__.'/professeur.class.php');
include_once(__DIR__.'/planete.class.php');

Class Classe {

    
    private string $nomClasse;
    private string $nombreEleve;
    private string  $loginProf;

    // Constructeur
    public function __construct($nomClasse, $numEleve, $loginProf) {
        $this->nombreEleve = $numEleve;
        $this->nomClasse = $nomClasse;
        $this->loginProf = $loginProf;
    }

    public function getNomClasse() {
        return $this->nomClasse;
    }

    public function ajouterEleve(string $login, string $password, int $idPlanete = null) : void {
        // Accès au DAO
        $dao = DAO::get();
        // Req prep
        $query="INSERT INTO Eleve (logineleve, mdpeleve, dateconnexion, idplanete, loginprofesseur, nomclasse) VALUES (?,?,current_timestamp, ?, ?, ?";
        // Remplissage data
        $data = [$login, $password, $idPlanete, $this->loginProf, $this->nomClasse];
        // On fait la req sur la BD 
        $dao->exec($query, $data);
    }

    public function create() : void {
        // Accès au DAO
        $dao = DAO::get();
        // On verif si 
        $dao->query('');
        $data = [$this->nomClasse, $this->nombreEleve, $this->loginProf];
        $query = "INSERT INTO Classe (nomClasse, nombreEleve, loginProfesseur) VALUES (?,?,?)";
        $dao->exec($query, $data);
    }

    public function getPlanetes() : array {
        // Accès au DAO
        $dao = DAO::get();
        // Préparation de la req
        $data = [];
        $data[] = $this->nomClasse;
        $data[] = $this->loginProf;

        $query = "SELECT idPlanete, nom
        From Planete 
        WHERE nomClasse = ? AND loginProfesseur = ?";

        $table = $dao->query($query, $data);

        // On prépapre la liste résultat
        $resultat = [];
        if($table){
            foreach($table as $row){
                $resultat[] = new Planete($row[0], $row[1]);
            }
        }
        return $resultat;
    }

    public function getEleves() : array {
        // Accès au DAO
        $dao = DAO::get();
        // Préparation de la req
        $data = [];
        $data[] = $this->nomClasse;
        $data[] = $this->loginProf;

        $query = "SELECT logineleve, mdpeleve, idPlanete
        From Eleve 
        WHERE nomClasse = ? AND loginProfesseur = ?";

        $table = $dao->query($query, $data);

        // On prépapre la liste résultat
        $resultat = [];
        if($table){
            foreach($table as $row){
                $resultat[$row[0]] = new Eleve($row[0], $row[1], $this->loginProf);
            }
        }
        return $resultat;
    }

    

}

?>