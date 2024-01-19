<?php
include(__DIR__ . './dao.class.php');
include(__DIR__ . 'Cours.class.php');

class Question
{

    private int $idQuestion;

    private string $Consigne;

    private string $Explication;

    private string $typeQuestion;

    private array $propositions;

    public function __construct($idQuestion, $Consigne, $Explication, $typeQuestion, $cours)
    {
        $this->idQuestion = $idQuestion;
        $this->Consigne = $Consigne;
        $this->Explication = $Explication;
        $this->typeQuestion = $typeQuestion;
        $this->cours = $cours;
    }


    public function __get($attribut) {
        return $this->$attribut;
    }   

    public function getAllProposition() : array{
        $dao = DAO::get();
        $liste = $dao->querry("select * from propositionqcm where idQuestion = $this->idQuestion;");
        foreach ($liste as $key => $value) {
            $proposition = new PropositionQcm($value['idProposition'],$value['texte'],$value['idQuestion']);
            $this->propositions[]=$proposition;
        }
        return $this->propositions;
    }

}
