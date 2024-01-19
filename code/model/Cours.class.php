<?php
include_once(__DIR__.'./dao.class.php');

// Définition de la classe Cours
class Cours
{
    // Déclaration des attributs privés de la classe
    private int $idCours; // Identifiant du cours
    private string $nom; // Nom du cours
    private array $questions;

    // Constructeur de la classe qui prend un identifiant de cours et un nom en paramètres
    public function __construct(int $idCours, string $nom)
    {
        $this->idCours = $idCours; // Initialise l'identifiant du cours
        $this->nom = $nom; // Initialise le nom du cours
    }

    public function __get($attribut) {
        return $this->$attribut;
    }   

    public function getAllQuestions(): array{
        $dao = DAO::get();
        $liste = $dao->querry("select * from questions where idCours = $this->idCours;");
        foreach ($liste as $key => $value) {
            if($value['type']== "QCM"){
                $question = new Question($value['idQuestion'],$value['Consigne'],$value['explication'],$value['type'],$value['idCours']);
            }else if ($value['type']== "drag and drop"){
                # code...
            }else {
                # code...
            }
            $this->questions[]=$question;
        }
    }
    
}
?>
