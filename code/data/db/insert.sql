INSERT INTO Lieu VALUES(1,'Maison',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'110 place doyen gosses',NULL,NULL);
INSERT INTO Lieu VALUES(2,'Mairie de Grenoble',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'4 rue des tulipes',NULL,NULL);

INSERT INTO Personne VALUES(1,'Dupuis','Marc','marc.dupuis@gmail.com','0675757575',1);
INSERT INTO Utilisateur VALUES(1,'marc.dupuis@gmail.com','azerty');
INSERT INTO Booker VALUES(1);

INSERT INTO Personne VALUES(5,'Roger','Ivan','ivan.bob.emile@gmail.com','0607754241',1);
INSERT INTO Utilisateur VALUES(5,'ivan.bob.emile@gmail.com','ploy!');
INSERT INTO Booker VALUES(5);

INSERT INTO Personne VALUES(2,'Lopez','Patrick','patrick.lopez@gmail.com','0675757575',NULL);
INSERT INTO Utilisateur VALUES(2,'plopez@gmail.com','azerty');
INSERT INTO Organisateur VALUES(2);

INSERT INTO Personne VALUES(3,'Jean','Jack','jean.jack@gmail.com','0675757575',NULL);
INSERT INTO Artiste VALUES(3,'06/12/2015',0,NULL,'JeanJack');
INSERT INTO Personne VALUES(4,'Jules','Domartin','jules.domartin@gmail.com','0675757575',NULL);
INSERT INTO Artiste VALUES(4,'06/12/2015',1,'AGSTBD154711744',NULL);

INSERT INTO Groupe VALUES(1,'Les beaux gosses',2,'lbg@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO Groupe_Artiste VALUES(1,3);
INSERT INTO Groupe_Artiste VALUES(1,4);

INSERT INTO Groupe VALUES(2,'Le Solo',1,'ls@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO Groupe_Artiste VALUES(2,4);

INSERT INTO Booker_Groupe VALUES(1,1);
INSERT INTO Booker_Groupe VALUES(1,2);

INSERT INTO Groupe_Genre VALUES(1,'Rock');
INSERT INTO Groupe_Genre VALUES(1,'Pop');
INSERT INTO Groupe_Genre VALUES(2,'Jazz');

INSERT INTO Manifestation VALUES(1,'Concert','Concert pour la lutte contre le sida','01/01/2016','03/01/2016',15,NULL,NULL,NULL,NULL,NULL,2,NULL);
INSERT INTO Manifestation VALUES(2,'Mariage','Mariage de Sandra et Kevin','01/07/2016','01/07/2016',15,NULL,NULL,NULL,NULL,NULL,2,2);
INSERT INTO Manifestation_Genre VALUES(1,'Rock');


INSERT INTO Creneau VALUES(1,1,'01/01/2016','20:00','22:00','16:00','16:30');
INSERT INTO Creneau VALUES(2,1,'01/07/2016','22:00','23:00',NULL,NULL);


INSERT INTO Evenement VALUES(1,'Rendez vous chez Marc','12/02/2016','12/02/2016','15:12','15:30',NULL,NULL,1);

INSERT INTO Contact VALUES(1,1,'Pas tres Cool');
INSERT INTO Contact VALUES(1,2,'Sympa');
INSERT INTO Contact VALUES(1,3,NULL);
INSERT INTO Contact_System VALUES(1,1,3);
INSERT INTO Contact_System VALUES(1,2,4);
INSERT INTO Contact_exterieur VALUES(1,3,'Pierre','pierrecroce@gmail.com','0601010101');


INSERT INTO Contact_Tag VALUES('Groupe 1',1,1);
INSERT INTO Contact_Tag VALUES('Amis',1,3);


INSERT INTO Message VALUES(1,1,2,0,'rencontre','Salut tu vas bien ? On se fait une bouffe ?',0,'10/12/2016');
INSERT INTO Message VALUES(2,2,1,0,'rencontre','Oui',1,'10/12/2016');
INSERT INTO Message_Tag VALUES('Amis',1);

INSERT INTO Document VALUES(1,1,'Fiche Artiste','01/01/1970',NULL,'home/ficheartiste.pdf');
INSERT INTO Document VALUES(2,1,'Fiche Groupe','01/01/1970',NULL,'home/fichegroupe.pdf');

INSERT INTO Negociation VALUES(1,1,1,2,2,0);

INSERT INTO Negociation_Documents VALUES(1,2);

INSERT INTO Negociation_Messages VALUES(1,1);
INSERT INTO Negociation_Messages VALUES(1,2);
