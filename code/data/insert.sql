-- Insertion dans la table Classe
INSERT INTO
	Classe (nomClasse, nombreEleve, loginprofesseur)
VALUES
	('ClasseA', 25, 'professeur1');

-- Insertion dans la table Planete
INSERT INTO
	Planete (nom, nomClasse, loginProfesseur)
VALUES
	('Terre', 'ClasseA', 'professeur1');

-- Insertion dans la table Eleve
INSERT INTO
	Eleve (
		loginEleve,
		mdpEleve,
		dateConnexion,
		idPlanete,
		loginprofesseur,
		nomClasse
	)
VALUES
	(
		'eleve1',
		'motdepasse1',
		'2024-01-16',
		1,
		'professeur1',
		'ClasseA'
	);

-- Insertion dans la table Continent
INSERT INTO
	Continent (nomContinent, idPlanete)
VALUES
	('Asie', 1);

-- Insertion dans la table Epreuve
INSERT INTO
	Epreuve (
		scoreEleve,
		idCours,
		loginEleve,
		idContinent,
		scoreMaxPossible
	)
VALUES
	(90, 1, 'eleve1', 1, 100);

-- Insertion dans la table Cours
INSERT INTO
	Cours (nom, idContinent)
VALUES
	('nutrition des êtres vivant', 2);

-- Insertion dans la table Question
INSERT INTO
	Question (idQUEstion,Consigne, explication, type, idCours)
VALUES
	--nutrition des ête vivant
	(
		100,
		'Quels sont les organes présents dans le système digestif des insectivores?',
		'Les insectivore ont simplement un estomac, un intestin court et un anus',
		'QCM',
		2
	);
	(
		101,
		'Quels sont les organes présents dans le système digestif des Herbivore non végétarien?',
		'Les herbivore non végétarien ont un estomac simple, un intestin court, un cæcum et un anus',
		'QCM',
		2
	);
	(
		102,
		'Quels sont les organes présents dans le système digestif des Herbivore végétarien?',
		'Les herbivore végétarien ont un estomac à 4 chambres, un intestin grêle, un grand cæcum, un colon long et un anus',
		'QCM',
		2
	);
	(
		103,
		'Quels sont les organes présents dans le système digestif des Carnivore?',
		'Les carnivores ont un œsophage, un estomac court, un intestin grêle, un cæcum réduit un colon court et un anus',
		'QCM',
		2
	);
	(
		104,
		'Complétez les trous dans la phrase',
		'Le transport des nutriments se fait de 2 manières différentes: par l’hémolymphe pour les insectes et par le sang le sang pour les autre animaux',
		'drag and drop',
		2
	);
	(
		105,
		'Complétez les trous dans la phrase',
		'Les animaux sont des êtres hétérotrophes, tandis que la plupart des plantes sont des êtres autotrophes',
		'drag and drop',
		2
	);
	(
		106,
		'Complétez avec le mot corespondant',
		'Seul les ruminant correspondent à la définition car les omnivore est par définition pas Herbivore est le terme hétérotrophe correspond au fait de ne pas être capable de secréter ses propres nutriment',
		'drag and drop',
		5
	);
	(
		107,
		'Quel est le nom du procédé qui permet au plante verte d’absorber des nutriments grâce au soleil?',
		'Le procédé d’absorption de la lumière en nutriment s’appelle la photosynthèse.',
		'QCM',
		5
	);
	(
		108,
		'Lesquels de ces animaux n’est pas un omnivore?',
		'Le chien est carnivore et le cheval herbivore. Tous les autres sont omnivore',
		'QCM',
		5
	);
	(
		109,
		'Le ou lesquels de ces organes utilisent des nutriments?',
		'Les organes qui consommes les nutriment sont les muscles',
		'QCM',
		5
	);
	(
		110,
		'Quel est le nom de la molécule sécrétée par les plantes grâce à la photosynthèse.',
		'La chlorophylle est une molécule sécrétée par la photosynthèse. C’est cette molécule qui donne à certaine plante leur couleur verte',
		'QCM',
		5
	);
	(
		111,
		'Complétez avec le mot corespondant.',
		'Seul la symbiose est valide car la cozoe et l’alophagie ne sont pas de vrai mots et la polyphagie est un autre nom de la boulimie',
		'drag and drop',
		5
	);
	(
		112,
		'Complétez avec le mot corespondant.',
		'La sève élaboré est la sève riche en matière organique.Elle quitte les feuilles où elle est fabriquée pour aller vers les organes non chlorophylliens qui en ont besoin pour se nourrir et se développer (racines, tubercules, fleurs, jeunes bourgeons, etc.).',
		'drag and drop',
		5
	);
	(
		113,
		'Complétez avec le mot corespondant.',
		'La sève brute désigne le liquide riche en eau et en sels minéraux allant des racines aux feuilles. La sève brute transite à travers la plante par des vaisseaux qui sont connectés aux stomates.',
		'drag and drop',
		5
	);
	(
		114,
		'Qu’est ce que l’hyphe?',
		'L’hyphe est le nom du filmant blanc du champiqnon qui compose le miselium.',
		'QCM',
		5
	);
	(
		115,
		'Parmis la liste des éléments lesquels  sont sécrétés lors de la photosynthèse?',
		'La photosynthèse sécrète du dioxygène relâché dans l’air et du glucose pour nourrir la plante.',
		'QCM',
		5
	);
	(
		150,
		'Combien de paires de chromosomes y a t il dans le génome humain?',
		'Il y a 23 paires de chromosomes dans le génome humain.',
		'QCM',
		5
	);
	(
		151,
		'Quelle est la composition de la paire d’une femelle humaine?',
		'une femelle humaine a 2 chromosomes X.',
		'QCM',
		5
	);
	(
		152,
		'Quelle est la composition de la paire d’un mâle humain?',
		'Un mâle humain a 1 chromosome X et un chromosome Y.',
		'QCM',
		5
	);
	(
		153,
		'Complétez avec le mot corespondant.',
		'Le génotype est l’ensemble des allèles d’un individu.',
		'drag and drop',
		5
	);
	(
		154,
		'Complétez avec le mot corespondant.',
		'La Mitose est une division cellulaire qui forme deux cellules filles, génétiquement identiques entre elles, à partir d’une cellule mère. Les deux cellules filles sont génétiquement identiques à la cellule mère.',
		'drag and drop',
		5
	);
	(
		155,
		'Complétez avec le mot corespondant.',
		'Le phénotype désigne l’ensemble des caractères observables à une échelle donnée.',
		'drag and drop',
		5
	);
	(
		156,
		'Complétez avec le mot corespondant.',
		'Le génome est l’ensemble de l’information génétique d’un organisme contenu dans chaque cellule de l’organisme sous forme de chromosomes. Le support de l’information génétique est l’ADN.',
		'drag and drop',
		5
	);
	(
		157,
		'Complétez avec le mot corespondant.',
		'L’héritabilité est le caractère de ce qui se transmet de génération en génération.',
		'drag and drop',
		5
	);
	(
		158,
		'Complétez avec le mot corespondant.',
		'Un gène est une portion d’ADN responsable de l’expression et de la transmission d’un caractère.',
		'drag and drop',
		5
	);
	(
		159,
		'Complétez avec le mot corespondant.',
		'Un chromosome est constitué de longs filaments d’ADN pelotonnés.',
		'drag and drop',
		5
	);
	(
		160,
		'Complétez avec le mot corespondant.',
		'Le caryotype est une présentation organisée de l’ensemble des chromosomes d’une cellule.',
		'drag and drop',
		5
	);
	(
		161,
		'Complétez avec le mot corespondant.',
		'Un allèle est une version d’un gène.',
		'drag and drop',
		5
	);
	(
		162,
		'Comment s’appelle le résultat d’une division cellulaire donnant des gamètes ne possédant qu’un seul chromosome de chaque paire à partir d’une cellule possédant les paires de chromosomes?',
		'Le résultat d’une division cellulaire donnant des gamètes ne possédant qu’un seul chromosome de chaque paire à partir d’une cellule possédant les paires de chromosomes s’appelle la méiose.',
		'QCM',
		5
	);
	(
		163,
		'L’ADN est…',
		'L’ADN est un arbre de protéine unique pour chaque être vivant qui sert à coder le matériel génétique.',
		'QCM',
		5
	);
-- Insertion dans la table PropositionTypeQcm
INSERT INTO
	PropositionTypeQcm (texte, correction, idQuestion)
VALUES
	--La nutrition des etre vivants
	('Estomac', true, 100),
	('Intestin long', false, 100),
	('Cæcum', false, 100),
	('Anus', true, 100),
	('Estomac simple', true, 101),
	('Estomac à 4 chambre', false, 101),
	('Estomac à 2 chambre', false, 101),
	('Cæcum', true, 101),
	('Estomac simple', false, 102),
	('Estomac à 4 chambre', true, 102),
	('Estomac à 2 chambre', false, 102),
	('Cæcum', true, 102),
	('Intestin grêle', true, 103),
	('Œusophage', true, 103),
	('Cæcum', true, 103),
	('Colon court', true, 103),
	('La photosynthèse', true, 107),
	('La Chlorophane', false, 107),
	('La photobiose', false, 107),
	('La solimère', false, 107),
	('Le chien', true, 108),
	('La poule', false, 108),
	('L’ours', false, 108),
	('Le cochon', false, 108),
	('Le cheval', true, 108),
	('Les poumons', false, 109),
	('Le coeur', true, 109),
	('Les muscles', false, 109),
	('Les reins', true, 109),
	('La chlorophylle', true, 110),
	('La cellophane', false, 110),
	('la chlorophane', false, 110),
	('Une partie d’un champignon représenté sous la forme d’un filament très fin.', true, 114),
	('Le fluide qui draine les nutriments dans le corps des insectes.', false, 114),
	('La sève qui n’a pas encore été alimentée en nutriments.', false, 114),
	('Les canaux qui lient les stomates au flux séveux ', false, 114),
	('De l’eau', false, 115),
	('Du dioxyde', false, 115),
	('la sève', false, 115),
	('Du dioxygène', false, 115),
	('Du glucose', false, 115),
	('12', false, 150),
	('48', false, 150),
	('34', false, 150),
	('23', true, 150),
	('XX', true, 151),
	('YY', false, 151),
	('XY', false, 151),
	('XX', false, 152),
	('YY', false, 152),
	('XY', true, 152),
	('Le microcyte', true, 162),
	('La mitose', true, 162),
	('La méiose', true, 162),
	('Le microbiote', true, 162),
	('le code du matériel génétique', true, 163),
	('un arbre de protéine', true, 163),
	('le même pour chaque chromosome', true, 163),
	('unique pour chaque individu', true, 163),
	
-- Insertion dans la table QuestionTypeClickAndDrop
INSERT INTO
	QuestionTypeClickAndDrop (idQuestion, texte)
VALUES
	(104, 'Le transport des nutriments se fait de 2 manières différentes: par [...] pour les insectes et par [...] pour les autre animaux');
	(105, 'Les animaux sont des êtres [...], tandis que la plupart des plantes sont des êtres [...].');
	(106, '[...] est un mammifère herbivore qui renvoie ses aliments dans sa bouche afin de les mastiquer à nouveau après qu''ils ont été déjà partiellement digérés.');
	(111, '[...] est une relation entre deux espèces différentes, chacune étant bénéfique à l’autre.');
	(112, '[...] est la sève riche en matière organique. Elle quitte les feuilles où elle est fabriquée pour aller vers les organes non chlorophylliens qui en ont besoin pour se nourrir et se développer (racines, tubercules, fleurs, jeunes bourgeons, etc.).');
	(113, '[...] désigne le liquide riche en eau et en sels minéraux allant des racines aux feuilles. La sève brute transite à travers la plante par des vaisseaux qui sont connectés aux stomates.');
	(153, '[...] est l’ensemble des allèles d’un individu.');
	(154, '[...] est une division cellulaire qui forme deux cellules filles, génétiquement identiques entre elles, à partir d’une cellule mère. Les deux cellules filles sont génétiquement identiques à la cellule mère.');
	(155, '[...] désigne l’ensemble des caractères observables à une échelle donnée.');
	(156, '[...] est l’ensemble de l’information génétique d’un organisme contenu dans chaque cellule de l’organisme sous forme de chromosomes. Le support de l’information génétique est l’ADN.');
	(157, '[...] est le caractère de ce qui se transmet de génération en génération.');
	(158, '[...] est une portion d’ADN responsable de l’expression et de la transmission d’un caractère.');
	(159, '[...] est constitué de longs filaments d’ADN pelotonnés.');
	(160, '[...] est une présentation organisée de l’ensemble des chromosomes d’une cellule.');
	(160, '[...] est une version d’un gène.');

	
-- Insertion dans la table PropositionTypeClickAndDrop
INSERT INTO
	PropositionTypeClickAndDrop (texte, numeroEmplacementJuste, idQuestion)
VALUES
	('l’hémolymphe',1,104),
	('le sang',2,104),
	('autotrophes',2,105),
	('hétérotrophes',1,105),
	('Un ruminant',1,106),
	('Un omnivore',0,106),
	('Un hétérotrophe',0,106),
	('La sève élaborée',1,112),
	('La sève brute',0,112),
	('La sève pure',0,112),
	('La sève grasse',0,112),
	('La sève pauvre',0,112),
	('La sève élaborée',0,113),
	('La sève brute',1,113),
	('La sève pure',0,113),
	('La sève grasse',0,113),
	('La sève pauvre',0,113),
	('Le génome',0,153),
	('Le génotype',1,153),
	('Le phénotype',0,153),
	('La Mitose',0,153),
	('Le génome',0,154),
	('Le génotype',0,154),
	('Le phénotype',0,154),
	('La Mitose',1,154),
	('Le génome',0,155),
	('Le génotype',0,155),
	('Le phénotype',1,155),
	('La Mitose',0,155),
	('Le génome',1,156),
	('Le génotype',0,156),
	('Le phénotype',0,156),
	('L’héritabilité',1,157),
	('La parentalité',0,157),
	('L’hérédité',0,157),
	('L’Héritage',0,157),
	('Un gène',1,158),
	('Un chromosome',0,158),
	('Le caryotype',0,158),
	('Un allèle',0,158),
	('Un gène',0,159),
	('Un chromosome',1,159),
	('Le caryotype',0,159),
	('Un allèle',0,159),
	('Un gène',0,160),
	('Un chromosome',0,160),
	('Le caryotype',1,160),
	('Un allèle',0,160),
	('Un gène',0,161),
	('Un chromosome',0,161),
	('Le caryotype',0,161),
	('Un allèle',1,161),
-- Insertion dans la table PropositionTypeClickAndDropImg
INSERT INTO
	PropositionTypeClickAndDropImg (texte, nomCheminImageJuste, idQuestion)
VALUES
	('Asie', 'chemin_image_asie.png', 2),
	('Europe', 'chemin_image_europe.png', 2),
	('Amérique', 'chemin_image_amerique.png', 2);