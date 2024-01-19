<?php

include_once(__DIR__.'/dao.class.php');

class Eleve{
    private $loginEleve;
    private $mdpEleve;
    private $idPlanete;


    public function __construct($loginEleve, $mdpEleve,$idPlanete){
        $this->loginEleve = $loginEleve;
        $this->idPlanete = $idPlanete;
        $this->mdpEleve = $mdpEleve;
    }
    public function getIdPlanete(){
        return $this->idPlanete;
    }

    public function getLoginEleve(){
        return $this->loginEleve;
    }

    public function getMdpEleve(){
        return $this->mdpEleve;
    }

}
?>