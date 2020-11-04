
CREATE TABLE Users (
    idUser INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(250) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    isAdmin BIT NOT NULL,
    isBanned BIT NOT NULL DEFAULT 0
);

CREATE TABLE Posts (
    idPost INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(250) NOT NULL
);

CREATE TABLE Comments ( 
   idComment INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
   idPost INTEGER NOT NULL,
   idAuteur INTEGER NOT NULL,
   content TEXT NOT NULL,
   dateCreation DATETIME NOT NULL
);

ALTER TABLE Comments 
    ADD FOREIGN KEY(idPost) REFERENCES Posts(idPost);

ALTER TABLE Comments 
   ADD FOREIGN KEY(idAuteur) REFERENCES Users(idUser);

INSERT INTO `Users` (`idUser`, `username`, `password`, `isAdmin`, `isBanned`) VALUES
(1, 'CBinette', '$2y$10$Qi66rPa05Xw36.61OfKml.ETiStClqn45IYGPPtN8Bk/F.xvZGrM.', 1, 0),
(2, 'ORaude', '$2y$10$SSCbrOQ.I61Z7wpme91k6ugZBBw0hMajRtqdgcj49sBzX.EY.o3SW', 1, 0),
(3, 'GComeau', '$2y$10$ehWIxyG3.kcr3nk8PK/iNuCMa3i4s8ukSnr7OUukE8dO55xJQtoJe', 0, 0),
(4, 'GHarvey', '$2y$10$2rJ54IqvRsaUdv.kEutGHu7Mk9pZ46N7ll.Q2ItrYgCTYbKHjb/G.', 0, 1),
(5, 'RChoour', '$2y$10$U9AQ5Zl5pnDCCqSfiUh0FuJmx1KLCLIxtZUk3K0atC/kssDN9tn4q', 0, 0);

INSERT INTO `Posts` (`idPost`, `titre`) VALUES
(1, 'Marche climat 27 septembre'),
(2, 'Fin de session'),
(3, 'Gestion de communauté sur les forum');

INSERT INTO `Comments` (`idComment`, `idPost`, `idAuteur`, `content`, `dateCreation`) VALUES
(1, 1, 2, 'Un article sur la marche pour le climat du vendredi 27 septembre', '2017-06-17 10:34:09'),
(2, 2, 2, 'Un article sur la de session', '2018-05-18 11:34:09'),
(3, 3, 1, 'Un article sur la gestion de communauté sur les forum', '2018-12-19 04:34:09');