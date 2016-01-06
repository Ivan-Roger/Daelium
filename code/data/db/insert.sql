INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Maison',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'110 place doyen gosses',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Mairie de Grenoble',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'4 rue des tulipes',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Maison',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'111 place doyen gosses',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Maison',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'112 place doyen gosses',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Maison',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'113 place doyen gosses',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Maison',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'113 place doyen gosses',NULL,NULL);


INSERT INTO Personne(type, nom, prenom, emailcontact, tel, adresse, description) VALUES(0,'Roger','Ivan','ivan.bob.emile@gmail.com','0607754241',3); -- 0 si booker
INSERT INTO Utilisateur VALUES(0,'ivan.bob.emile@gmail.com','ploy!');
INSERT INTO Booker VALUES(0);


INSERT INTO Personne(type, nom, prenom, emailcontact, tel, adresse, description) VALUES(0,'Dupuis','Marc','marc.dupuis@gmail.com','0675757575',1); -- 0 si booker
INSERT INTO Utilisateur VALUES(1,'marc.dupuis@gmail.com','azerty');
INSERT INTO Booker VALUES(1);

INSERT INTO Personne(type, nom, prenom, emailcontact, tel, adresse, description) VALUES(1,'Lopez','Patrick','patrick.lopez@gmail.com','0675757575',4); -- 1 si organ
INSERT INTO Utilisateur VALUES(2,'plopez@gmail.com','azerty');
INSERT INTO Organisateur VALUES(2);

INSERT INTO Personne(type, nom, prenom, emailcontact, tel, adresse, description) VALUES(2,'Jean','Jack','jean.jack@gmail.com','0675757575',5); -- 2 si artiste
INSERT INTO Artiste VALUES(3,'06/12/2015',0,NULL,'JeanJack');

INSERT INTO Personne(type, nom, prenom, emailcontact, tel, adresse, description) VALUES(2,'Jules','Domartin','jules.domartin@gmail.com','0675757575',0); -- 2 si artiste
INSERT INTO Artiste VALUES(4,'06/12/2015',1,'AGSTBD154711744',NULL);



INSERT INTO Groupe(nomg, email, lienImageOfficiel, facebook,  google, twitter,soundcloud,description, lecteur, ficheCom,adresse) VALUES('Les beaux gosses','lbg@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO Groupe_Artiste VALUES(0,3);
INSERT INTO Groupe_Artiste VALUES(0,4);

INSERT INTO Groupe(nomg, email, lienImageOfficiel, facebook,  google, twitter,soundcloud,description, lecteur, ficheCom,adresse) VALUES('Le Solo','ls@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO Groupe_Artiste VALUES(1,4);

INSERT INTO Booker_Groupe VALUES(1,0);
INSERT INTO Booker_Groupe VALUES(1,1);

INSERT INTO Groupe_Genre VALUES(0,'Rock');
INSERT INTO Groupe_Genre VALUES(0,'Pop');
INSERT INTO Groupe_Genre VALUES(1,'Jazz');

INSERT INTO Manifestation(nom, type, description, dateDebut, dateFin, lienImageOfficiel, facebook, google, twitter, ficheCom, createur, lieu) VALUES('Concert pour la lutte contre le sida','Concert','Concert pour la lutte contre le sida','01/01/2016','03/01/2016',NULL,NULL,NULL,NULL,NULL,2,NULL);
INSERT INTO Manifestation(nom, type, description, dateDebut, dateFin, lienImageOfficiel, facebook, google, twitter, ficheCom, createur, lieu) VALUES('Mariage de Sandra et Kevin','Mariage','Mariage de Sandra et Kevin','01/07/2016','01/07/2016',NULL,NULL,NULL,NULL,NULL,2,2);
INSERT INTO Manifestation_Genre VALUES(1,'Rock');


INSERT INTO Creneau VALUES(1,1,'Petite scene','01/01/2016','20:00','22:00','16:00','16:30');
INSERT INTO Creneau VALUES(2,1,'Grande scene','01/07/2016','22:00','23:00',NULL,NULL);


INSERT INTO Evenement(nom, datedebut, datefin, journee, heuredebut, heurefin, description, plus, lieu, createur) VALUES('Rendez vous chez Marc','12/02/2016','12/02/2016','non','15:12','15:30','','',NULL,1);
INSERT INTO Evenement(nom, datedebut, datefin, journee, heuredebut, heurefin, description, plus, lieu, createur) VALUES('Noël','25/12/2015','25/12/2015','day',NULL,NULL,'','',NULL,1);
INSERT INTO Evenement(nom, datedebut, datefin, journee, heuredebut, heurefin, description, plus, lieu, createur) VALUES('En scène','24/07/2016','26/07/2016','non','10:00','20:30','','',NULL,1);
INSERT INTO Evenement(nom, datedebut, datefin, journee, heuredebut, heurefin, description, plus, lieu, createur) VALUES('Debut Paris Live','15/01/2016','17/01/2016','non','15:00','19:45','','',NULL,1);


-- INSERT INTO Contact VALUES(1,1,'Pas tres Cool');
-- INSERT INTO Contact VALUES(1,2,'Sympa');
-- INSERT INTO Contact VALUES(1,3,NULL);
-- INSERT INTO Contact_System VALUES(1,1,3);
-- INSERT INTO Contact_System VALUES(1,2,4);
-- INSERT INTO Contact_exterieur VALUES(1,3,'Pierre','pierrecroce@gmail.com','0601010101');
--
--
-- INSERT INTO Contact_Tag VALUES('Groupe 1',1,1);
-- INSERT INTO Contact_Tag VALUES('Amis',1,3);


INSERT INTO Message(expediteur, destinataire, etat, contenu, dateenvoi) VALUES(2,10,'Salut tu vas bien ? On se fait une bouffe ?','2015-10-19 10:23:54');
INSERT INTO Message_Tag VALUES('Amis',0);
INSERT INTO Conversation(idPremierMessage, nom) VALUES(1,'Rencontre');
INSERT INTO Conversation_Message VALUES(0,1);


INSERT INTO Message(expediteur, destinataire, etat, contenu, dateenvoi) VALUES(2,1,10,'Oui','2015-10-19 10:23:54');
INSERT INTO Conversation_Message VALUES(1,1);


INSERT INTO Message(expediteur, destinataire, etat, contenu, dateenvoi) VALUES(1,2,10,'On fait ça quand, t''es dispo mardi ?','2015-10-19 17:36:21');
INSERT INTO Conversation_Message VALUES(2,1);

INSERT INTO Message(expediteur, destinataire, etat, contenu, dateenvoi) VALUES(2,1,10,'Je crois bien, oui','2015-10-19 20:37:14');
INSERT INTO Conversation_Message VALUES(3,1);

INSERT INTO Message(expediteur, destinataire, etat, contenu, dateenvoi) VALUES(1,2,5,'Parfait, a mardi alors.','2015-10-20 07:08:12');
INSERT INTO Conversation_Message VALUES(4,1);


INSERT INTO Negociation(idBooker, idManif, idGroupe, idOrganisateur, etat) VALUES(1,1,2,2,0);



INSERT INTO notification(etat, destinataire, type, Message) VALUES(0,5,1,'Nouveau message de .....');
INSERT INTO notification(etat, destinataire, type, Message) VALUES(0,5,0,'Machin veux votre groupe pour');
INSERT INTO notification(etat, destinataire, type, Message) VALUES(1,5,1,'Nouveau message de .....');
