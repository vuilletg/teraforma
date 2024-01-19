<?php
include_once(__DIR__ . './dao.class.php');
include_once(__DIR__ . 'Cours.class.php');

// Définition de la classe Epreuve
class Epreuve
{
    // Déclaration des attributs privés de la classe
    private $scoreEleve; // Score de l'élève pour cette épreuve
    private $scoreMaxPossible; // Score maximum possible pour cette épreuve
    private Cours $cours;
    private $listRetenuQuestions = [];
    private Continent $continent;

    // Constructeur de la classe qui prend un objet Eleve et un objet Cours en paramètres
    public function __construct(Eleve $eleve, Cours $cours)
    {
        $this->cours = $cours;
        
    }
    public function __get($attribut) {
        return $this->$attribut;
    }
    public function setscoreEleve($scoreEleve){
        $this->scoreEleve = $scoreEleve;
        $dao = DAO::get();
        $dao->update("update epreuve set scoreEleve = $this->scoreEleve where idCours = $this->cours->idCours and idEleve = $this->eleve->idEleve;");
    }
    public function getQuiz() {
        $listeQuestion = $cours->getAllQuestions();
        shuffle($listeQuestion);
        $listeQuestionsQuiz = [];
        for ($i=0; $i < 10; $i++) { 
            $listeQuestionsQuiz[] = $listeQuestion[$i];
        }
        return $listeQuestionsQuiz;
    }
}
?>
