<?php

include_once(__DIR__ .'/dao.class.php');

class Continent
{
    private $idContinent;
    private $nomcontinent;
    private $scoreContinent;
    private $listIdCours = [];

    // Constructeur
    public function __construct(string $nomcontinent)
    {
        $this->nomcontinent = $nomcontinent;
    }

    // Méthode 
    public function getId(): string
    {
        return $this->idContinent;
    }

    public function getNom(): string
    {
        return $this->nomcontinent;
    }

    public function getEpreuves(): array
    {
        // Accès au DAO
        $dao = DAO::get();
        // Requete
        $query = "SELECT scoreEleve, idCours FROM Epreuve WHERE idContinent=?";

        $data = [$this->idContinent];

        return $dao->query($query, $data);
    }

    public function getCours(): array
    {
        // Accès au DAO
        $dao = DAO::get();
        // Requete
        $query = "SELECT * FROM Cours WHERE idContinent=?";

        $data = [$this->idContinent];

        return $dao->query($query, $data);
    }

    public function setId($idContinent): void
    {
        $this->idContinent = $idContinent;
    }

    public function setScore(): void
    {
        $listeEpreuves = Continent::getEpreuves();
        $nbCours = 0;
        foreach ($this->listIdCours as $id) {
            $moygen = 0;
            $moyCours = 0;
            $nbCours++;
            $nbep = 0;
            foreach ($listeEpreuves as $epreuve) {
                if ($epreuve->getIdCours() == $id) {
                    $nbep++;
                    $moyCours += $epreuve->getScoreEleve();
                }
                if ($nbep > 0) {
                    $moygen += $moyCours;
                }
            }

        }

        $this->$scoreContinent = $moygen / $nbCours;

    }

    
    /*public function getElementsGraphique(): array
    {
        // Accès au DAO
        $dao = DAO::get();


        // Requete
        $query = "SELECT * FROM ElementGraphique WHERE idContinent=?";

        $data = [$this->idContinent];

        return $dao->query($query, $data);
    }*/





}
