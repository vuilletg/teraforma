<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Vos balises meta, title, etc. -->
    <link rel="stylesheet" href="../style/quizz.css" />
  </head>
  <body>
    <div id="quiz-container">
      <?php foreach ($questions as $question) : ?>
        <div id="question">
          <?= $question->Consigne; // Remplacez 'texteQuestion' par l'attribut de votre classe Question qui contient le texte de la question ?>
        </div>
        <div id="answers">
          <?php foreach ($question->propositions as $reponse) : // Remplacez 'reponses' par l'attribut de votre classe Question qui contient les réponses ?>
            <label class="answer">
              <input type="radio" name="answer" value="<?= $reponse->idProposition; // Remplacez 'id' par l'attribut de votre classe Reponse qui contient l'ID de la réponse ?>" />
              <span id="answer<?= $reponse->idProposition; // Remplacez 'id' par l'attribut de votre classe Reponse qui contient l'ID de la réponse ?>">
                <?= $reponse->texte; // Remplacez 'texte' par l'attribut de votre classe Reponse qui contient le texte de la réponse ?>
              </span>
            </label>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
      <button id="Vérifier" onclick="checkAnswers()">Vérifier</button>
      <p id="NumQuestion">1</p>
      <div id="result"></div>
      <div id="explanation">
        <button id="Suivant" onclick="functionSuivant()" style="display: none;">Suivant</button>
      </div>
    </div>
    <script src="../js/quizz.js"></script>
    <!-- <script src="../controler/php/quizz.crtl.php"></script>-->
  </body>
</html>
