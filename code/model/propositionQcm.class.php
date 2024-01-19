<?php

    private int $idProposition;
    private string $texte;
    private int $idQuestion;

    public function __construct($idProposition, $texte, $idQuestion) {
        $this->idProposition = $idProposition;
        $this->texte = $texte;
        $this->idQuestion = $idQuestion;
    }
    public function __get($attribut){
        return $this->$attribut;
    }
?>