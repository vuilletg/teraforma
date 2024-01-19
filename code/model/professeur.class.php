<?php

include_once(__DIR__.'/dao.class.php');
include_once(__DIR__.'/classe.class.php');
include_once(__DIR__.'/eleve.class.php');

Class Professeur{

    private $login;
    private $mdp;
    private $mail;


    // Constructeur
    public function __construct($login, $mdp=null, $mail=null) {
        $this->login = $login;
        $this->mdp = $mdp;
        $this->mail = $mail;
    }

    // Méthode 
    public function getLogin() : string {
        return $this->login;
        
    }

    public function creeClasse($numClasse) : void {
        $this->class[] = $numClasse;
    }
    
    public function getDateConnexion() : string{
        $data=[$this->login];
        $dao = DAO::get();
        $query = "SELECT dateconnexion from Professeur WHERE login=?";

        $table = $dao->query($query, $data);

        return $table[0]['dateconnexion'];
    }

    public function setDateConnexion() : void{
        $data=[$this->login];
        $dao = DAO::get();
        $query = "UPDATE PROFESSEUR set dateconnexion = current_timestamp WHERE login=?";

        $dao->query($query, $data);
    }

    public function getEleveIdPlanete(string $loginEleve) : int {
        // Accès au DAO
        $dao = DAO::get();
        // Requete
        $query = "SELECT logineleve, idPlanete FROM ELEVE WHERE loginEleve = ? and loginProfesseur = ?";
        $data=[$loginEleve, $this->login];

        $table = $dao->query($query,$data);

        // Renvoie une erreur si l'éleve n'existe pas
        if (!$table || !$table[0][0]) {
            throw new Exception("Eleve non trouvé");
        }else{
            return $table[0][1];
        }
    }

    public function getClasses() : array {
        // Accès au DAO
        $dao = DAO::get();
        // Requete
        $query = "SELECT nomclasse, nombreeleve FROM classe c, Professeur p
        where c.loginprofesseur = p.login and c.loginprofesseur = ? ";

        $data=[$this->login];

        $table = $dao->query($query, $data);

        // On prépapre la liste résultat
        $resultat = [];
        if($table){
            foreach($table as $row){
                $resultat[$row[0]] = new Classe($row[0], $row[1]);
            }
        }
        return $resultat;
    }

    public function addClasse($nomClasse, $nombreEleve) : void {
        // Accès au DAO
        $dao = DAO::get();
        // Requete
        $querySelect = "SELECT nomclasse FROM classe c, Professeur p
        where c.loginprofesseur = p.login and c.loginprofesseur = ? and nomclasse = ";

        $data=[$this->login];
        $data=[$nomClasse];

        $table = $dao->query($querySelect, $data);

        // Si la classe existe déjà pour ce prof, alors on renvoie une erreur
        if ($table){
            throw new Exception("Professeuur existe déjà");
        }

        // Si la classe n'existe pas alors on peut l'insérer
        $data[] = 0;
        $queryInsert = "INSERT INTO classe (loginprofesseur, nomclasse, nombreeleve) VALUES (?,?,?)";
        $dao->exec($queryInsert, $data);

    }

    public function create(){
        // On recup le dao 
        $dao= DAO::get();

        // On verifie si le prof est déjà présent dans la BD
        $data = [];
        $data[] = $this->login;
        $querySelect = "Select login from professeur where login = ";
        $table = $dao->query($querySelect, $data);

        // Erreur jettée s'il existe déjà
        if ($table || $this->mdp==null){
            throw new Exception("Professeuur existe déjà ou mauvais mdp");
        }
        
        // Sinon on poursuit et on insère le nv prof
        $data[] = $this->mdp;
        $data[] = $this->mail;

        $query = "INSERT INTO professeur (login, mdp, mail, dateconnexion) VALUES (?,?,?,current_timestamp)";
        $dao->exec($query, $data);
    }
    
}
