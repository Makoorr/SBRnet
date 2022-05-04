CREATE TABLE `produits` (
  `idproduits` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prix` int(11) NOT NULL,
  `disponibilite` int(1) DEFAULT NULL,
  `categorie` varchar(25) DEFAULT NULL,
  `nom_categorie` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idproduits`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;
INSERT INTO `produits` VALUES (38, 'Huile Essentielle Tea Tree', 10, 1, 'huilesess', 'Huiles Essentielles'),(39, 'Huile Essentielle Eucalyptus', 10, 1, 'huilesess', 'Huiles Essentielles');

CREATE TABLE `commande` (
  `idcommande` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `phone` int(11) NOT NULL,
  `ville` varchar(25) DEFAULT NULL,
  `address` varchar(25) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `cartquantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `etat` int(1) DEFAULT 1,
  PRIMARY KEY (`idcommande`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `achat` (
  `idproduits` int(11) NOT NULL,
  `idcommande` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` varchar(45) NOT NULL,
  PRIMARY KEY (`idproduits`,`idcommande`),
  KEY `idcommande_idx` (`idcommande`),
  CONSTRAINT `idcommande` FOREIGN KEY (`idcommande`) REFERENCES `commande` (`idcommande`) ON DELETE CASCADE ON UPDATE CASCADE,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `users` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
INSERT INTO `users` VALUES (1,'test@gmail.com','CRxt4lD5xEMnU');

CREATE TABLE `newsletter` (
  `idnewsletter` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`idnewsletter`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;