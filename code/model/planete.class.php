<?php

include_once(__DIR__.'/dao.class.php');
include_once(__DIR__.'/continent.class.php');
include_once(__DIR__.'/eleve.class.php');

class Planete
{
    private $idPlanete;
    private $name;

    private $listeEleve = [];

    public function __construct($idPlanete, $name)
    {
        $this->idPlanete = $idPlanete;
        $this->name = $name;
    }

    public function getIdPlanete()
    {
        return $this->idPlanete;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getListeEleve(): array
    {
        return $this->listeEleve;
    }

    public function getContinent(): array
    {
        // Accès au DAO
        $dao = DAO::get();

        $data = [];
        $data = [$this->getIdPlanete()];

        // Requête SQL pour récupérer les continents associés à la planète
        $query = "SELECT idContinent, nomContinent FROM Continent WHERE idPlanete = ?";

        // Utilisation d'une requête préparée pour éviter les injections SQL
        $result = $dao->query($query, $data);

        // Transformation des résultats en objets Continent
        foreach ($result as $continentData) {
            $continent = new Continent($continentData['nomContinent']);
            $continent->setId($continentData['idContinent']);
            $listeContinent[] = $continent;
        }

        return $listeContinent;
    }

}
