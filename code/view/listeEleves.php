<?php
$loginProf = $_SESSION['loginProfesseur'];
$classe = $_SESSION['classe'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/burgerMenu.css">
    <link rel="stylesheet" href="../../style/styleEnseignant.css">
    <title>TerraForma</title>
</head>
<body id="listeEleves">
    <header>
        <h1>TerraForma</h1>
        <a href="creerClasse.html" id="retour">Retour</a>
        <div id="root">
            <div id="topnav" class="topnav">    
                <a id="topnav_hamburger_icon" href="javascript:void(0);" onclick="showResponsiveMenu()">
                  <!-- Some spans to act as a hamburger -->
                  <span></span>
                  <span></span>
                  <span></span>
                </a>
            
                <!-- Responsive Menu -->
                <nav role="navigation" id="topnav_responsive_menu">
                    <ul>
                    <a href="pagePrincipaleEnseignant.html">Retour page principale</a>
                    <hr>
                    <a href="">Mentions légales</a>
                    <a href="">Aide</a>
                    <a href="">Nous contacter</a>
                    <hr>
                    <a href="">Gérer mon compte</a>
                    <a href="index.html">Déconnexion</a>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <nav id="filDArianne"><a href="pagePrincipaleEnseignant.html"><?=$loginProf?></a> / Créer classe : <?=$classe?></nav>
    <main>
        <aside>
            <p>Ajouter un élève :</p>
            <form method="post" id="creerEleve" class="form" >
                <input type="text" placeholder="Login" name="login" id="login">
                <div id="erreurLogin" class="erreur"></div>
                <input type="text" placeholder="Mot de passe" name="mdp" id="mdp">
                <div id="erreurMdp" class="erreur"></div>
                <input type="submit" value="Créer l'élève">
            </form>
            <button onclick="supprimerEleve()">Supprimer un élève </button>
            <p>Ajouter un groupe :</p>
            <form method="post" id="creerGroupe" class="form">
                <input type="text" placeholder="Nom du groupe" id="nomGroupe" name="groupe">
                <div id="erreurName"></div>
                <input type="submit" value="Créer le groupe">
            </form>
        </aside>        
        <article>
            
            <h2>Disposition des groupes</h2>
            <div id="groupe2" draggable="true" ondragstart="drag(event)">
                <h3>Exemple nom groupe</h3>
                <hr>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
            </div>
            <div id="groupe3" draggable="true" ondragstart="drag(event)">
                <h3>Exemple nom groupe</h3>
                <hr>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
            </div>
            <div id="groupe4" draggable="true" ondragstart="drag(event)">
                <h3>Exemple nom groupe</h3>
                <hr>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
            </div>
            <div id="groupe5" draggable="true" ondragstart="drag(event)">
                <h3>Exemple nom groupe</h3>
                <hr>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
            </div>
            <?php foreach ($planetes as $planete): ?>
                <div id=<?=$planete->getName()?> draggable="true" ondragstart="drag(event)">
                    <h3><?=$planete->getName()?></h3>
                    <hr>
                    <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                    <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                    <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                    <span class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></span>
                </div> 
            <?php endforeach; ?>
            <div id="liste">
                <h3>Veuillez faire glisser les élèves dans les groupes correspondant :</h3>
                
                <div id="eleve1" draggable="true" ondragstart="drag(event)">Elève 1 <button>X</button></div>
                <div id="eleve2" draggable="true" ondragstart="drag(event)">Elève 2 <button>X</button></div>
                <div id="eleve3" draggable="true" ondragstart="drag(event)">Elève 3 <button>X</button></div>
                <div id="eleve4" draggable="true" ondragstart="drag(event)">Elève 4 <button>X</button></div>
                <div id="eleve5" draggable="true" ondragstart="drag(event)">Elève 5 <button>X</button></div>
                <div id="eleve6" draggable="true" ondragstart="drag(event)">Elève 6 <button>X</button></div>
                <div id="eleve7" draggable="true" ondragstart="drag(event)">Elève 7 <button>X</button></div>
                <div id="eleve8" draggable="true" ondragstart="drag(event)">Elève 8 <button>X</button></div>
                <div id="eleve9" draggable="true" ondragstart="drag(event)">Elève 9 <button>X</button></div>
                <?php foreach ($eleves as $eleve): ?>
                    <div id=<?=$eleve->getLoginEleve()?> draggable="true" ondragstart="drag(event)"><?=$eleve->getLoginEleve()?> <button>X</button></div>
                <?php endforeach; ?>
            </div>
            <div id="poubelle" class="blank" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
      </div>
        </article>
        <aside>
            <h2>Liste des élèves</h2>
            <h3>Veuillez saisir les données avec le formulaire "Ajouter un élève"</h3>
            <table>
                <thead>
                    <tr>
                        <th>Pseudos élèves</th>
                        <th>Mot de passe élèves</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Exemple pseudo 1</td>
                        <td>Exemple mot de passe 1</td>
                    </tr>
                    <tr>
                        <td>Exemple pseudo 2</td>
                        <td>Exemple mot de passe 2</td>
                    </tr>
                </tbody>
            </table>
            <a href="creerClasse.html"><img src="../../img/exportBlanc.png" alt="" id="export">Exporter la liste</a>
            <a href="creerClasse.html"><img src="../../img/verifierBlanc.png" alt="" id="export">Valider la classe</a>
        </aside>
    </main>
    <script>
        function supprimerEleve(){
            var eleves = document.querySelectorAll('[id^="eleve"]');
            if (eleves[0].classList.contains('suppr')){
                eleves.forEach(item => { item.classList.remove('suppr')});
            } else {
                eleves.forEach(item => { item.classList.add('suppr')});
            }
        }
    </script>
    <script src="../../js/menuBurger.js"></script>
    <script src="../../js/Drag&Drop.js"></script>
    <script src="../../js/creerEleve.js"></script>
    <script src="../../js/creerGroupe.js"></script>
</body>
</html>