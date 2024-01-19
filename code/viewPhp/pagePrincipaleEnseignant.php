<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/burgerMenu.css">
    <link rel="stylesheet" href="../style/styleEnseignant.css">
    <title>TerraForma</title>
</head>
<body>
    <header>
        <h1>TerraForma</h1>
        <h2><?=$login?></h2>
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
                    <a href="pagePrincipaleEnseignant(new).html">Retour page principale</a>
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
    <nav id="filDArianne">Exemple nom professeur</nav>
    <main>
        <aside>
            <a href="creerClasse(new).html"><img src="../img/iconeClasseBlanc.png" alt="">Créer classe</a>
        </aside>
        <article>
            <h2>Vos classes :</h2>
            <a href="gererClasse(new).html">
                <p>Exemple nom classe / nombre d'élèves</p>
                <hr>
                <button class="modifier"><img src="../img/iconeModif.png" alt=""></button>
                <button class="supprimer"><img src="../img/iconeSuppr.png" alt=""></button>
            </a>
            <a href="gererClasse(new).html">
                <p>Exemple nom classe / nombre d'élèves</p>
                <hr>
                <button class="modifier"><img src="../img/iconeModif.png" alt=""></button>
                <button class="supprimer"><img src="../img/iconeSuppr.png" alt=""></button>
            </a>
            <a href="gererClasse(new).html">
                <p>Exemple nom classe / nombre d'élèves</p>
                <hr>
                <button class="modifier"><img src="../img/iconeModif.png" alt=""></button>
                <button class="supprimer"><img src="../img/iconeSuppr.png" alt=""></button>
            </a>
            <a href="gererClasse(new).html">
                <p>Exemple nom classe / nombre d'élèves</p>
                <hr>
                <button class="modifier"><img src="../img/iconeModif.png" alt=""></button>
                <button class="supprimer"><img src="../img/iconeSuppr.png" alt=""></button>
            </a>
            <a href="gererClasse(new).html">
                <p>Exemple nom classe / nombre d'élèves</p>
                <hr>
                <button class="modifier"><img src="../img/iconeModif.png" alt=""></button>
                <button class="supprimer"><img src="../img/iconeSuppr.png" alt=""></button>
            </a>
            <nav>
                <a href="" id="pageCourante">1<hr></a>
                <a href="">2<hr></a>
                <a href="">3<hr></a>
            </nav>
        </article>
    </main>
    <script src="../js/menuBurger.js"></script>
</body>
</html>