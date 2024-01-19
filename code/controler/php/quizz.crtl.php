<?php
include_once(__DIR__ . './../model/Epreuve.class.php');
include_once(__DIR__ . './../framework/view.class.php');

class EpreuveController {
    public function getEpreuveQuestions($idEpreuve) {
        // Créer une instance de la classe Epreuve
        $epreuve = new Epreuve($idEpreuve);
        // Appeler la méthode pour obtenir toutes les questions
        $questions = $epreuve->getQuiz();
        // Créer une instance de la classe View
        $view = new View();
        // Utiliser la méthode assign pour passer les questions à la vue
        $view->assign('questions', $questions);
        // Afficher la vue
        $view->display('chemin/vers/votre/vue.php');
    }
}
?>


