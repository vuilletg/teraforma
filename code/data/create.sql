CREATE TABLE Classe(
nomClasse varchar \s classe,
nombreEleve integer,
loginprofesseur varchar,
foreign key (loginProfesseur) references professeur(login),
primary key (loginProfesseur, nomClasse));

CREATE TABLE Planete(
idPlanete SERIAL primary key,
nom varchar,
nomClasse varchar,
loginProfesseur varchar,
FOREIGN KEY (nomClasse,loginProfesseur) REFERENCES Classe(nomclasse,loginProfesseur)
);

CREATE TABLE ELEVE(
loginEleve varchar primary key,
mdpEleve varchar, 
dateConnexion date,
idPlanete integer,
Foreign key (idPlanete) references  planete(idPlanete)
);

ALTER TABLE Eleve 
ADD COLUMN loginprofesseur varchar;
ALTER TABLE Eleve 
ADD COLUMN nomClasse varchar;
ALTER TABLE Eleve 
ADD Constraint reference_Classe
foreign key (loginprofesseur, nomClasse) references Classe(loginProfesseur, nomclasse);

CREATE TABLE Continent(
idContinent integer primary key,
nomContinent varchar,
idPlanete integer,
foreign key (idPlanete) references planete(idPlanete)
);

CREATE TABLE Epreuve(
scoreEleve integer,
idCours integer,
loginEleve varchar,
idContinent integer,
scoreMaxPossible integer,
foreign key (idCours) references Cours(idCours),
foreign key (loginEleve) references Eleve(loginEleve),
foreign key (idContinent) references Continent(idContinent),
primary key(idCours, loginEleve));

Create TABLE Cours(
idCours integer primary key,
nom varchar, 
idContinent integer,
foreign key (idContinent) references Continent(idContinent));

CREATE TABLE Question(
idQUEstion integer primary key,
Consigne varchar, 
explication varchar, 
type varchar,
idCours integer,
foreign key (idCours) references Cours(idCours));


CREATE TABLE PropositionTypeQcm (
idProposition integer primary key,
texte varchar, 
correction boolean,
idQuestion integer,
foreign key(idQuestion) references Question(idQuestion)
);


CREATE TABLE QuestionTypeClickAndDrop(
idQuestion integer,
texte varchar, 
foreign key(idQuestion) references Question(idQuestion),
primary key (idQuestion)
);

CREATE TABLE PropositionTypeClickAndDrop(
idProposition integer primary key, 
texte varchar,
numeroEmplacementJuste integer, 
idQuestion integer,
foreign key(idQuestion) references Question(idQuestion)
);


CREATE TABLE PropositionTypeClickAndDropImg(
idProposition integer primary key,
texte varchar,
nomCheminImageJuste varchar,
idQuestion integer,
foreign key(idQuestion) references Question(idQuestion)
);


/*
Pour auto-incrémentation

CREATE TABLE nom_table (
	id SERIAL PRIMARY KEY,
	autre_colonne type_de_donnee,
	-- Ajoutez d'autres colonnes selon vos besoins
);


ALTER TABLE
*/