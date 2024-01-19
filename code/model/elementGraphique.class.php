<?php
include_once(__DIR__.'./dao.class.php');

class ElementGraphique
{
    private int $idElement;
    private array $position;
    private string $nomCheminElement;

    // Constructeur
    public function __construct(array $position, string $nomCheminElement)
    {
        $this->position = $position;
        $this->nomCheminElement = $nomCheminElement;
    }

    // Getters et Setters
    public function getIdElement(): int
    {
        return $this->idElement;
    }

    public function getPosition(): array
    {
        return $this->position;
    }


    public function setIdElement(int $idElement): ElementGraphique
    {
        $this->idElement = $idElement;
        return $this;
    }

    public function setPosition(array $position): ElementGraphique
    {
        $this->position = $position;
        return $this;
    }
}