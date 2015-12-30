INSERT INTO Lieu VALUES(1,'Maison',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'110 place doyen gosses',NULL,NULL);
INSERT INTO Lieu VALUES(3,'Maison',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'111 place doyen gosses',NULL,NULL);
INSERT INTO Lieu VALUES(4,'Maison',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'112 place doyen gosses',NULL,NULL);
INSERT INTO Lieu VALUES(5,'Maison',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'113 place doyen gosses',NULL,NULL);
INSERT INTO Lieu VALUES(6,'Maison',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'113 place doyen gosses',NULL,NULL);

INSERT INTO Lieu VALUES(2,'Mairie de Grenoble',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'4 rue des tulipes',NULL,NULL);

INSERT INTO Personne VALUES(1,0,'Dupuis','Marc','marc.dupuis@gmail.com','0675757575',1); -- 0 si booker
INSERT INTO Utilisateur VALUES(1,'marc.dupuis@gmail.com','azerty');
INSERT INTO Booker VALUES(1);

INSERT INTO Personne VALUES(5,0,'Roger','Ivan','ivan.bob.emile@gmail.com','0607754241',3); -- 0 si booker
INSERT INTO Utilisateur VALUES(5,'ivan.bob.emile@gmail.com','ploy!');
INSERT INTO Booker VALUES(5);

INSERT INTO Personne VALUES(2,1,'Lopez','Patrick','patrick.lopez@gmail.com','0675757575',4); -- 1 si organ
INSERT INTO Utilisateur VALUES(2,'plopez@gmail.com','azerty');
INSERT INTO Organisateur VALUES(2);

INSERT INTO Personne VALUES(3,2,'Jean','Jack','jean.jack@gmail.com','0675757575',5); -- 2 si artiste
INSERT INTO Artiste VALUES(3,'06/12/2015',0,NULL,'JeanJack');
INSERT INTO Personne VALUES(4,2,'Jules','Domartin','jules.domartin@gmail.com','0675757575',6); -- 2 si artiste
INSERT INTO Artiste VALUES(4,'06/12/2015',1,'AGSTBD154711744',NULL);

INSERT INTO Groupe VALUES(1,'Les beaux gosses','lbg@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO Groupe_Artiste VALUES(1,3);
INSERT INTO Groupe_Artiste VALUES(1,4);

INSERT INTO Groupe VALUES(2,'Le Solo','ls@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO Groupe_Artiste VALUES(2,4);

INSERT INTO Booker_Groupe VALUES(1,1);
INSERT INTO Booker_Groupe VALUES(1,2);

INSERT INTO Groupe_Genre VALUES(1,'Rock');
INSERT INTO Groupe_Genre VALUES(1,'Pop');
INSERT INTO Groupe_Genre VALUES(2,'Jazz');

INSERT INTO Manifestation VALUES(1,'Concert pour la lutte contre le sida','Concert','Concert pour la lutte contre le sida','01/01/2016','03/01/2016',NULL,NULL,NULL,NULL,NULL,2,NULL);
INSERT INTO Manifestation VALUES(2,'Mariage de Sandra et Kevin','Mariage','Mariage de Sandra et Kevin','01/07/2016','01/07/2016',NULL,NULL,NULL,NULL,NULL,2,2);
INSERT INTO Manifestation_Genre VALUES(1,'Rock');


INSERT INTO Creneau VALUES(1,1,'Petite scene','01/01/2016','20:00','22:00','16:00','16:30');
INSERT INTO Creneau VALUES(2,1,'Grande scene','01/07/2016','22:00','23:00',NULL,NULL);


INSERT INTO Evenement VALUES(1,'Rendez vous chez Marc','12/02/2016','12/02/2016','non','15:12','15:30','','',NULL,1);
INSERT INTO Evenement VALUES(2,'Noël','25/12/2015','25/12/2015','day',NULL,NULL,'','',NULL,1);
INSERT INTO Evenement VALUES(3,'En scène','24/07/2016','26/07/2016','non','10:00','20:30','','',NULL,1);
INSERT INTO Evenement VALUES(4,'Debut Paris Live','15/01/2016','17/01/2016','non','15:00','19:45','','',NULL,1);


INSERT INTO Contact VALUES(1,1,'Pas tres Cool');
INSERT INTO Contact VALUES(1,2,'Sympa');
INSERT INTO Contact VALUES(1,3,NULL);
INSERT INTO Contact_System VALUES(1,1,3);
INSERT INTO Contact_System VALUES(1,2,4);
INSERT INTO Contact_exterieur VALUES(1,3,'Pierre','pierrecroce@gmail.com','0601010101');


INSERT INTO Contact_Tag VALUES('Groupe 1',1,1);
INSERT INTO Contact_Tag VALUES('Amis',1,3);


INSERT INTO Message VALUES(1,1,2,10,'Salut tu vas bien ? On se fait une bouffe ?','2015-10-19 10:23:54');
INSERT INTO Message_Tag VALUES('Amis',1);
INSERT INTO Conversation VALUES(1,1,'Rencontre');
INSERT INTO Conversation_Message VALUES(1,1);
INSERT INTO Message VALUES(2,2,1,10,'Oui','2015-10-19 10:23:54');
INSERT INTO Conversation_Message VALUES(2,1);
INSERT INTO Message VALUES(3,1,2,10,'On fait ça quand, t''es dispo mardi ?','2015-10-19 17:36:21');
INSERT INTO Conversation_Message VALUES(3,1);
INSERT INTO Message VALUES(4,2,1,10,'Je crois bien, oui','2015-10-19 20:37:14');
INSERT INTO Conversation_Message VALUES(4,1);
INSERT INTO Message VALUES(5,1,2,5,'Parfait, a mardi alors.','2015-10-20 07:08:12');
INSERT INTO Conversation_Message VALUES(5,1);


INSERT INTO Document VALUES(1,1,'Fiche Artiste','01/01/1970',NULL,'home/ficheartiste.pdf');
INSERT INTO Document VALUES(2,1,'Fiche Groupe','01/01/1970',NULL,'home/fichegroupe.pdf');

INSERT INTO Negociation VALUES(1,1,1,2,2,0);

INSERT INTO Negociation_Documents VALUES(1,2);

INSERT INTO Negociation_Messages VALUES(1,1);
INSERT INTO Negociation_Messages VALUES(1,2);
