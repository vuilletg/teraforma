// ouverture
async function ouvrirJeu(idCours) {
    var popup = window.open("../view/menuEvaluation.html","nomFenetre", "width=800px, height=600px, top=" + (screen.height / 2 - 300) + "px, left=" + (screen.width - 850) + "px");
    // récupération du contenu du fichier
    existingContent = '\`' + await lireContenuFichier('../view/menuEvaluation.html') + '\`';
    // récupération du nom du cours (pour le titre de la page)
    var nomCours = recupNomCours(idCours);
    // modification dans le fichier
    existingContent = existingContent.replace('<h1>titre</h1>', '<h1>' + nomCours + '</h1>');
    popup.document.write(existingContent);
}

// boutons
async function questionSuivante(){
    // remplacer le num de question
    // modifier la progression
    // si dernière question alors remplacer bouton question suivante
    // remplacer contenu de question
}
function finEvaluation(){

}
function fermerEvaluation(){
    if (confirm('Souhaitez vous vraiment quitter le jeu ? Les réponses pour ce jeu ne seront pas sauvegardées.')){
        window.close();
    }
}

function lireContenuFichier(cheminDuFichier) {
    return fetch(cheminDuFichier)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP, statut : ${response.status}`);
            }
            return response.text();
        })
        .catch(erreur => {
            console.error("Erreur lors de la récupération du fichier :", erreur);
            return null;
        });
}

function recupNomCours(idCours) {
    var nomCours;
    switch (idCours) {
        case 1: nomCours = "La dynamique de la Terre et ses conséquences"; break;
        case 2: nomCours = "Les changements climatiques et l'être humain"; break;
        case 3: nomCours = "La prévision et la prévention des risques planétaires"; break;
        case 4: nomCours = "Les ressources naturelles des écosystèmes et les activités humaines"; break;
        case 5: nomCours = "La nutrition des êtres vivants"; break;
        case 6: nomCours = "La dynamique des populations"; break;
        case 7: nomCours = "La diversité génétique des individus"; break;
        case 8: nomCours = "Les classifications et les facteurs influençant l’évolution"; break;
        case 9: nomCours = "Les perturbations du système nerveux"; break;
        case 10: nomCours = "L'alimentation humaine et la santé"; break;
        case 11: nomCours = "La lutte contre les micro-organismes pathogènes"; break;
        case 12: nomCours = "Des comportements responsables vis-à-vis de la sexualité"; break;
    }
    return nomCours;
}

