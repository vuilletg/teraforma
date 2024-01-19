var numQuestion = 1; // Initialiser la valeur à 1

function toggleButtons() {
  var verifierButton = document.getElementById("Vérifier");
  var suivantButton = document.getElementById("Suivant");
  var resultDiv = document.getElementById("result");
  

  // Vérifiez si le résultat est déjà affiché
  if (resultDiv.innerHTML.trim() !== "") {
    // Si le résultat est affiché, masquez le bouton "Vérifier" et affichez le bouton "Suivant"
    verifierButton.style.display = "none";
    suivantButton.style.display = "block";

  } else {
    // Si le résultat n'est pas affiché, masquez le bouton "Suivant" et affichez le bouton "Vérifier"
    verifierButton.style.display = "none";
    suivantButton.style.display = "block";
  }
}

function checkAnswers() {
  // Votre logique pour vérifier les réponses ici

  // Après avoir vérifié les réponses, vous pouvez appeler la fonction toggleButtons
  toggleButtons();
}

function functionSuivant() {
  // Logique pour la fonction suivante ici
  // Vous pouvez personnaliser cette fonction en fonction de vos besoins
  var numQuestionParagraph = document.getElementById("NumQuestion");
  numQuestion++;
  numQuestionParagraph.innerText = numQuestion;
}

/*xhr.onreadystatechange = function () {
  // Fonction pour charger une question spécifique sur la page
  function loadQuestion(question) {
    const questionDiv = document.getElementById("question"); // Sélection de l'élément HTML avec l'ID 'question'
    const answersDiv = document.getElementById("answers"); // Sélection de l'élément HTML avec l'ID 'answers'

    // Affichage du libellé de la question dans la div 'question'
    questionDiv.innerHTML = `<p>${question.enonceQuestion}</p>`;

    // Séparation des propositions en utilisant le séparateur " / " et création des cases à cocher correspondantes
    const propositions = question.listePropositions.split(" / ");
    const checkboxesHTML = propositions.map((proposition, index) => {
      const id = `answer${index + 1}`; // Création d'un ID unique pour chaque case à cocher
      const isChecked = question.reponseCorrecte.includes(proposition); // Vérification si la proposition est une réponse correcte
      return `<label>
              <input type="checkbox" id="${id}" data-idposition="${
        index + 1
      }" data-correct="${isChecked}" />
              ${proposition}
            </label>`;
    });

    // Affichage des cases à cocher dans la div 'answers'
    answersDiv.innerHTML = checkboxesHTML.join("");
  }

  // Fonction pour charger la question suivante
  function loadNextQuestion() {
    currentQuestionIndex = (currentQuestionIndex + 1) % questions.length; // Incrémentation de l'index de la question actuelle (et retour à zéro si nécessaire)
    loadQuestion(questions[currentQuestionIndex]); // Chargement de la question suivante sur la page
  }

  // Événement déclenché lorsque le contenu DOM est entièrement chargé
  document.addEventListener("DOMContentLoaded", function () {
    loadQuestion(questions[currentQuestionIndex]); // Au chargement de la page, la première question est affichée
  });

  xhr.open("POST", "../controler/php/quizz.crtl.php", true);
  xhr.responseType = "json";
  xhr.send(data);
  return false;
};*/
