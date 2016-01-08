INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Lieu1',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'110 place doyen gosses',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Lieu2',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'4 rue des tulipes',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Lieu3',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'112 place doyen gosses',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Lieu4',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'12 cour berriat',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Lieu5',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'13 cour berriat',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Lieu6',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'14 cour berriat',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Lieu7',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'15 cour berriat',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Lieu8',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'16 cour berriat',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Lieu9',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'17 cour berriat',NULL,NULL);
INSERT INTO Lieu(noml, description, pays, region, ville, codePostal, adresse, latitude, longitude) VALUES('Lieu10',NULL,'FRANCE','Rhone-Alpes','Grenoble',38000,'18 cour berriat',NULL,NULL);


INSERT INTO Personne(type, nom, prenom, emailcontact, tel, adresse) VALUES(0,'Roger','Ivan','ivan.bob.emile@gmail.com','0607754241',1); -- 0 si booker
INSERT INTO Utilisateur VALUES(1,'ivan.bob.emile@gmail.com','325063010dee10b36a7956c75c13ad0c6ea9287aac9fc6b3a3cf03e55c04c23f'); --ploy!
INSERT INTO Booker VALUES(1);


INSERT INTO Personne(type, nom, prenom, emailcontact, tel, adresse) VALUES(0,'Dupuis','Marc','marc.dupuis@gmail.com','0675757575',2); -- 0 si booker
INSERT INTO Utilisateur VALUES(2,'marc.dupuis@gmail.com','f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9'); -- azerty
INSERT INTO Booker VALUES(2);

INSERT INTO Personne(type, nom, prenom, emailcontact, tel, adresse) VALUES(1,'Lopez','Patrick','patrick.lopez@gmail.com','0675757575',3); -- 1 si organ
INSERT INTO Utilisateur VALUES(3,'plopez@gmail.com','f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9'); --azerty
INSERT INTO Organisateur VALUES(3);

INSERT INTO Personne(type, nom, prenom, emailcontact, tel, adresse) VALUES(2,'Jean','Jack','jean.jack@gmail.com','0675757575',4); -- 2 si artiste
INSERT INTO Artiste VALUES(4,'06/12/2015',0,NULL,'JeanJack');

INSERT INTO Personne(type, nom, prenom, emailcontact, tel, adresse) VALUES(2,'Jules','Domartin','jules.domartin@gmail.com','0675757575',5); -- 2 si artiste
INSERT INTO Artiste VALUES(5,'06/12/2015',1,'AGSTBD154711744',NULL);



INSERT INTO Groupe(nomg, email, lienImageOfficiel, facebook,  google, twitter,soundcloud,description, lecteur, ficheCom,adresse) VALUES('Les beaux gosses','lbg@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'<p>Alii nullo quaerente vultus severitate adsimulata patrimonia sua in inmensum extollunt, cultorum ut puta feracium multiplicantes annuos fructus, quae a primo ad ultimum solem se abunde iactitant possidere, ignorantes profecto maiores suos, per quos ita magnitudo Romana porrigitur, non divitiis eluxisse sed per bella saevissima, nec opibus nec victu nec indumentorum vilitate gregariis militibus discrepantes opposita cuncta superasse virtute.</p>

<p>Et Epigonus quidem amictu tenus philosophus, ut apparuit, prece frustra temptata, sulcatis lateribus mortisque metu admoto turpi confessione cogitatorum socium, quae nulla erant, fuisse firmavit cum nec vidisset quicquam nec audisset penitus expers forensium rerum; Eusebius vero obiecta fidentius negans, suspensus in eodem gradu constantiae stetit latrocinium illud esse, non iudicium clamans.</p>

<p>Sed ut tum ad senem senex de senectute, sic hoc libro ad amicum amicissimus scripsi de amicitia. Tum est Cato locutus, quo erat nemo fere senior temporibus illis, nemo prudentior; nunc Laelius et sapiens (sic enim est habitus) et amicitiae gloria excellens de amicitia loquetur. Tu velim a me animum parumper avertas, Laelium loqui ipsum putes. C. Fannius et Q. Mucius ad socerum veniunt post mortem Africani; ab his sermo oritur, respondet Laelius, cuius tota disputatio est de amicitia, quam legens te ipse cognosces.</p>

<p>Novitates autem si spem adferunt, ut tamquam in herbis non fallacibus fructus appareat, non sunt illae quidem repudiandae, vetustas tamen suo loco conservanda; maxima est enim vis vetustatis et consuetudinis. Quin in ipso equo, cuius modo feci mentionem, si nulla res impediat, nemo est, quin eo, quo consuevit, libentius utatur quam intractato et novo. Nec vero in hoc quod est animal, sed in iis etiam quae sunt inanima, consuetudo valet, cum locis ipsis delectemur, montuosis etiam et silvestribus, in quibus diutius commorati sumus.</p>

<p>Et hanc quidem praeter oppida multa duae civitates exornant Seleucia opus Seleuci regis, et Claudiopolis quam deduxit coloniam Claudius Caesar. Isaura enim antehac nimium potens, olim subversa ut rebellatrix interneciva aegre vestigia claritudinis pristinae monstrat admodum pauca.</p>

<p>&nbsp;</p>

<p><iframe allowfullscreen="" frameborder="0" height="360" src="//www.youtube.com/embed/1KOaT1vdLmc" width="640"></iframe></p>

<p>&nbsp;</p>

<p>Alii nullo quaerente vultus severitate adsimulata patrimonia sua in inmensum extollunt, cultorum ut puta feracium multiplicantes annuos fructus, quae a primo ad ultimum solem se abunde iactitant possidere, ignorantes profecto maiores suos, per quos ita magnitudo Romana porrigitur, non divitiis eluxisse sed per bella saevissima, nec opibus nec victu nec indumentorum vilitate gregariis militibus discrepantes opposita cuncta superasse virtute.</p>

<p>Et Epigonus quidem amictu tenus philosophus, ut apparuit, prece frustra temptata, sulcatis lateribus mortisque metu admoto turpi confessione cogitatorum socium, quae nulla erant, fuisse firmavit cum nec vidisset quicquam nec audisset penitus expers forensium rerum; Eusebius vero obiecta fidentius negans, suspensus in eodem gradu constantiae stetit latrocinium illud esse, non iudicium clamans.</p>

<div style="position:relative;padding-bottom:56.25%;padding-top:30px;height:0;overflow:hidden;">&nbsp;</div>

<p>Novitates autem si spem adferunt, ut tamquam in herbis non fallacibus fructus appareat, non sunt illae quidem repudiandae, vetustas tamen suo loco conservanda; maxima est enim vis vetustatis et consuetudinis. Quin in ipso equo, cuius modo feci mentionem, si nulla res impediat, nemo est, quin eo, quo consuevit, libentius utatur quam intractato et novo. Nec vero in hoc quod est animal, sed in iis etiam quae sunt inanima, consuetudo valet, cum locis ipsis delectemur, montuosis etiam et silvestribus, in quibus diutius commorati sumus.</p>

<p>Et hanc quidem praeter oppida multa duae civitates exornant Seleucia opus Seleuci regis, et Claudiopolis quam deduxit coloniam Claudius Caesar. Isaura enim antehac nimium potens, olim subversa ut rebellatrix interneciva aegre vestigia claritudinis pristinae monstrat admodum pauca.</p>
',6);
INSERT INTO Groupe_Artiste VALUES(1,4);
INSERT INTO Groupe_Artiste VALUES(1,5);

INSERT INTO Groupe(nomg, email, lienImageOfficiel, facebook,  google, twitter,soundcloud,description, lecteur, ficheCom,adresse) VALUES('Le Solo','ls@gmail.com',NULL,'https://www.facebook.com/djramdom/?fref=ts','https://plus.google.com/u/0/110161786381104641409/posts','https://twitter.com/rihanna?lang=fr',NULL,NULL,NULL,'<p>Alii nullo quaerente vultus severitate adsimulata patrimonia sua in inmensum extollunt, cultorum ut puta feracium multiplicantes annuos fructus, quae a primo ad ultimum solem se abunde iactitant possidere, ignorantes profecto maiores suos, per quos ita magnitudo Romana porrigitur, non divitiis eluxisse sed per bella saevissima, nec opibus nec victu nec indumentorum vilitate gregariis militibus discrepantes opposita cuncta superasse virtute.</p>

<p>Et Epigonus quidem amictu tenus philosophus, ut apparuit, prece frustra temptata, sulcatis lateribus mortisque metu admoto turpi confessione cogitatorum socium, quae nulla erant, fuisse firmavit cum nec vidisset quicquam nec audisset penitus expers forensium rerum; Eusebius vero obiecta fidentius negans, suspensus in eodem gradu constantiae stetit latrocinium illud esse, non iudicium clamans.</p>

<p>Sed ut tum ad senem senex de senectute, sic hoc libro ad amicum amicissimus scripsi de amicitia. Tum est Cato locutus, quo erat nemo fere senior temporibus illis, nemo prudentior; nunc Laelius et sapiens (sic enim est habitus) et amicitiae gloria excellens de amicitia loquetur. Tu velim a me animum parumper avertas, Laelium loqui ipsum putes. C. Fannius et Q. Mucius ad socerum veniunt post mortem Africani; ab his sermo oritur, respondet Laelius, cuius tota disputatio est de amicitia, quam legens te ipse cognosces.</p>

<p>Novitates autem si spem adferunt, ut tamquam in herbis non fallacibus fructus appareat, non sunt illae quidem repudiandae, vetustas tamen suo loco conservanda; maxima est enim vis vetustatis et consuetudinis. Quin in ipso equo, cuius modo feci mentionem, si nulla res impediat, nemo est, quin eo, quo consuevit, libentius utatur quam intractato et novo. Nec vero in hoc quod est animal, sed in iis etiam quae sunt inanima, consuetudo valet, cum locis ipsis delectemur, montuosis etiam et silvestribus, in quibus diutius commorati sumus.</p>

<p>Et hanc quidem praeter oppida multa duae civitates exornant Seleucia opus Seleuci regis, et Claudiopolis quam deduxit coloniam Claudius Caesar. Isaura enim antehac nimium potens, olim subversa ut rebellatrix interneciva aegre vestigia claritudinis pristinae monstrat admodum pauca.</p>

<p>&nbsp;</p>

<p><iframe allowfullscreen="" frameborder="0" height="360" src="//www.youtube.com/embed/GhCXAiNz9Jo" width="640"></iframe></p>

<p>&nbsp;</p>

<p>Alii nullo quaerente vultus severitate adsimulata patrimonia sua in inmensum extollunt, cultorum ut puta feracium multiplicantes annuos fructus, quae a primo ad ultimum solem se abunde iactitant possidere, ignorantes profecto maiores suos, per quos ita magnitudo Romana porrigitur, non divitiis eluxisse sed per bella saevissima, nec opibus nec victu nec indumentorum vilitate gregariis militibus discrepantes opposita cuncta superasse virtute.</p>

<p>Et Epigonus quidem amictu tenus philosophus, ut apparuit, prece frustra temptata, sulcatis lateribus mortisque metu admoto turpi confessione cogitatorum socium, quae nulla erant, fuisse firmavit cum nec vidisset quicquam nec audisset penitus expers forensium rerum; Eusebius vero obiecta fidentius negans, suspensus in eodem gradu constantiae stetit latrocinium illud esse, non iudicium clamans.</p>

<div style="position:relative;padding-bottom:56.25%;padding-top:30px;height:0;overflow:hidden;">&nbsp;</div>

<p>Novitates autem si spem adferunt, ut tamquam in herbis non fallacibus fructus appareat, non sunt illae quidem repudiandae, vetustas tamen suo loco conservanda; maxima est enim vis vetustatis et consuetudinis. Quin in ipso equo, cuius modo feci mentionem, si nulla res impediat, nemo est, quin eo, quo consuevit, libentius utatur quam intractato et novo. Nec vero in hoc quod est animal, sed in iis etiam quae sunt inanima, consuetudo valet, cum locis ipsis delectemur, montuosis etiam et silvestribus, in quibus diutius commorati sumus.</p>

<p>Et hanc quidem praeter oppida multa duae civitates exornant Seleucia opus Seleuci regis, et Claudiopolis quam deduxit coloniam Claudius Caesar. Isaura enim antehac nimium potens, olim subversa ut rebellatrix interneciva aegre vestigia claritudinis pristinae monstrat admodum pauca.</p>
',7);
INSERT INTO Groupe_Artiste VALUES(2,4);

INSERT INTO Booker_Groupe VALUES(2,1);
INSERT INTO Booker_Groupe VALUES(2,2);

INSERT INTO Groupe_Genre VALUES(1,'Rock');
INSERT INTO Groupe_Genre VALUES(1,'Pop');
INSERT INTO Groupe_Genre VALUES(2,'Jazz');

INSERT INTO Manifestation(nom, type, description, dateDebut, dateFin, lienImageOfficiel, facebook, google, twitter, ficheCom, createur, lieu) VALUES('Concert pour la lutte contre le sida','Concert','Concert pour la lutte contre le sida','01/01/2016','03/01/2016',NULL,'https://www.facebook.com/bilbaobbkliveoficial/',NULL,NULL,'<p>Alii nullo quaerente vultus severitate adsimulata patrimonia sua in inmensum extollunt, cultorum ut puta feracium multiplicantes annuos fructus, quae a primo ad ultimum solem se abunde iactitant possidere, ignorantes profecto maiores suos, per quos ita magnitudo Romana porrigitur, non divitiis eluxisse sed per bella saevissima, nec opibus nec victu nec indumentorum vilitate gregariis militibus discrepantes opposita cuncta superasse virtute.</p>

<p>Et Epigonus quidem amictu tenus philosophus, ut apparuit, prece frustra temptata, sulcatis lateribus mortisque metu admoto turpi confessione cogitatorum socium, quae nulla erant, fuisse firmavit cum nec vidisset quicquam nec audisset penitus expers forensium rerum; Eusebius vero obiecta fidentius negans, suspensus in eodem gradu constantiae stetit latrocinium illud esse, non iudicium clamans.</p>

<p>Sed ut tum ad senem senex de senectute, sic hoc libro ad amicum amicissimus scripsi de amicitia. Tum est Cato locutus, quo erat nemo fere senior temporibus illis, nemo prudentior; nunc Laelius et sapiens (sic enim est habitus) et amicitiae gloria excellens de amicitia loquetur. Tu velim a me animum parumper avertas, Laelium loqui ipsum putes. C. Fannius et Q. Mucius ad socerum veniunt post mortem Africani; ab his sermo oritur, respondet Laelius, cuius tota disputatio est de amicitia, quam legens te ipse cognosces.</p>

<p>Novitates autem si spem adferunt, ut tamquam in herbis non fallacibus fructus appareat, non sunt illae quidem repudiandae, vetustas tamen suo loco conservanda; maxima est enim vis vetustatis et consuetudinis. Quin in ipso equo, cuius modo feci mentionem, si nulla res impediat, nemo est, quin eo, quo consuevit, libentius utatur quam intractato et novo. Nec vero in hoc quod est animal, sed in iis etiam quae sunt inanima, consuetudo valet, cum locis ipsis delectemur, montuosis etiam et silvestribus, in quibus diutius commorati sumus.</p>

<p>Et hanc quidem praeter oppida multa duae civitates exornant Seleucia opus Seleuci regis, et Claudiopolis quam deduxit coloniam Claudius Caesar. Isaura enim antehac nimium potens, olim subversa ut rebellatrix interneciva aegre vestigia claritudinis pristinae monstrat admodum pauca.</p>

<p>&nbsp;</p>

<p><iframe allowfullscreen="" frameborder="0" height="360" src="//www.youtube.com/embed/SyJDY7cIQ7c" width="640"></iframe></p>

<p>&nbsp;</p>

<p>Alii nullo quaerente vultus severitate adsimulata patrimonia sua in inmensum extollunt, cultorum ut puta feracium multiplicantes annuos fructus, quae a primo ad ultimum solem se abunde iactitant possidere, ignorantes profecto maiores suos, per quos ita magnitudo Romana porrigitur, non divitiis eluxisse sed per bella saevissima, nec opibus nec victu nec indumentorum vilitate gregariis militibus discrepantes opposita cuncta superasse virtute.</p>

<p>Et Epigonus quidem amictu tenus philosophus, ut apparuit, prece frustra temptata, sulcatis lateribus mortisque metu admoto turpi confessione cogitatorum socium, quae nulla erant, fuisse firmavit cum nec vidisset quicquam nec audisset penitus expers forensium rerum; Eusebius vero obiecta fidentius negans, suspensus in eodem gradu constantiae stetit latrocinium illud esse, non iudicium clamans.</p>

<div style="position:relative;padding-bottom:56.25%;padding-top:30px;height:0;overflow:hidden;">&nbsp;</div>

<p>Novitates autem si spem adferunt, ut tamquam in herbis non fallacibus fructus appareat, non sunt illae quidem repudiandae, vetustas tamen suo loco conservanda; maxima est enim vis vetustatis et consuetudinis. Quin in ipso equo, cuius modo feci mentionem, si nulla res impediat, nemo est, quin eo, quo consuevit, libentius utatur quam intractato et novo. Nec vero in hoc quod est animal, sed in iis etiam quae sunt inanima, consuetudo valet, cum locis ipsis delectemur, montuosis etiam et silvestribus, in quibus diutius commorati sumus.</p>

<p>Et hanc quidem praeter oppida multa duae civitates exornant Seleucia opus Seleuci regis, et Claudiopolis quam deduxit coloniam Claudius Caesar. Isaura enim antehac nimium potens, olim subversa ut rebellatrix interneciva aegre vestigia claritudinis pristinae monstrat admodum pauca.</p>
',3,8);
INSERT INTO Manifestation(nom, type, description, dateDebut, dateFin, lienImageOfficiel, facebook, google, twitter, ficheCom, createur, lieu) VALUES('Mariage de Sandra et Kevin','Mariage','Mariage de Sandra et Kevin','01/07/2016','01/07/2016',NULL,NULL,NULL,NULL,'<p>Alii nullo quaerente vultus severitate adsimulata patrimonia sua in inmensum extollunt, cultorum ut puta feracium multiplicantes annuos fructus, quae a primo ad ultimum solem se abunde iactitant possidere, ignorantes profecto maiores suos, per quos ita magnitudo Romana porrigitur, non divitiis eluxisse sed per bella saevissima, nec opibus nec victu nec indumentorum vilitate gregariis militibus discrepantes opposita cuncta superasse virtute.</p>

<p>Et Epigonus quidem amictu tenus philosophus, ut apparuit, prece frustra temptata, sulcatis lateribus mortisque metu admoto turpi confessione cogitatorum socium, quae nulla erant, fuisse firmavit cum nec vidisset quicquam nec audisset penitus expers forensium rerum; Eusebius vero obiecta fidentius negans, suspensus in eodem gradu constantiae stetit latrocinium illud esse, non iudicium clamans.</p>

<p>Sed ut tum ad senem senex de senectute, sic hoc libro ad amicum amicissimus scripsi de amicitia. Tum est Cato locutus, quo erat nemo fere senior temporibus illis, nemo prudentior; nunc Laelius et sapiens (sic enim est habitus) et amicitiae gloria excellens de amicitia loquetur. Tu velim a me animum parumper avertas, Laelium loqui ipsum putes. C. Fannius et Q. Mucius ad socerum veniunt post mortem Africani; ab his sermo oritur, respondet Laelius, cuius tota disputatio est de amicitia, quam legens te ipse cognosces.</p>

<p>Novitates autem si spem adferunt, ut tamquam in herbis non fallacibus fructus appareat, non sunt illae quidem repudiandae, vetustas tamen suo loco conservanda; maxima est enim vis vetustatis et consuetudinis. Quin in ipso equo, cuius modo feci mentionem, si nulla res impediat, nemo est, quin eo, quo consuevit, libentius utatur quam intractato et novo. Nec vero in hoc quod est animal, sed in iis etiam quae sunt inanima, consuetudo valet, cum locis ipsis delectemur, montuosis etiam et silvestribus, in quibus diutius commorati sumus.</p>

<p>Et hanc quidem praeter oppida multa duae civitates exornant Seleucia opus Seleuci regis, et Claudiopolis quam deduxit coloniam Claudius Caesar. Isaura enim antehac nimium potens, olim subversa ut rebellatrix interneciva aegre vestigia claritudinis pristinae monstrat admodum pauca.</p>

<p>&nbsp;</p>

<p><iframe allowfullscreen="" frameborder="0" height="360" src="//www.youtube.com/embed/HuAxVfZasUk" width="640"></iframe></p>

<p>&nbsp;</p>

<p>Alii nullo quaerente vultus severitate adsimulata patrimonia sua in inmensum extollunt, cultorum ut puta feracium multiplicantes annuos fructus, quae a primo ad ultimum solem se abunde iactitant possidere, ignorantes profecto maiores suos, per quos ita magnitudo Romana porrigitur, non divitiis eluxisse sed per bella saevissima, nec opibus nec victu nec indumentorum vilitate gregariis militibus discrepantes opposita cuncta superasse virtute.</p>

<p>Et Epigonus quidem amictu tenus philosophus, ut apparuit, prece frustra temptata, sulcatis lateribus mortisque metu admoto turpi confessione cogitatorum socium, quae nulla erant, fuisse firmavit cum nec vidisset quicquam nec audisset penitus expers forensium rerum; Eusebius vero obiecta fidentius negans, suspensus in eodem gradu constantiae stetit latrocinium illud esse, non iudicium clamans.</p>

<div style="position:relative;padding-bottom:56.25%;padding-top:30px;height:0;overflow:hidden;">&nbsp;</div>

<p>Novitates autem si spem adferunt, ut tamquam in herbis non fallacibus fructus appareat, non sunt illae quidem repudiandae, vetustas tamen suo loco conservanda; maxima est enim vis vetustatis et consuetudinis. Quin in ipso equo, cuius modo feci mentionem, si nulla res impediat, nemo est, quin eo, quo consuevit, libentius utatur quam intractato et novo. Nec vero in hoc quod est animal, sed in iis etiam quae sunt inanima, consuetudo valet, cum locis ipsis delectemur, montuosis etiam et silvestribus, in quibus diutius commorati sumus.</p>

<p>Et hanc quidem praeter oppida multa duae civitates exornant Seleucia opus Seleuci regis, et Claudiopolis quam deduxit coloniam Claudius Caesar. Isaura enim antehac nimium potens, olim subversa ut rebellatrix interneciva aegre vestigia claritudinis pristinae monstrat admodum pauca.</p>
',3,9);
INSERT INTO Manifestation_Genre VALUES(2,'Rock');

INSERT INTO Negociation(idBooker, idManif, idGroupe, idOrganisateur, etat) VALUES(2,1,2,3,3);
INSERT INTO Negociation(idBooker, idManif, idGroupe, idOrganisateur, etat) VALUES(2,2,1,3,0);

INSERT INTO Creneau VALUES(1,2,'Grande scene','01/07/2016','22:00','23:00',NULL,NULL);


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


INSERT INTO Message(expediteur, destinataire, etat, contenu, dateenvoi) VALUES(1,2,10,'Salut tu vas bien ? On se fait une bouffe ?','2015-10-19 10:23:54');
INSERT INTO Message_Tag VALUES('Amis',1);
INSERT INTO Conversation(idPremierMessage, nom) VALUES(1,'Rencontre');
INSERT INTO Conversation_Message VALUES(1,1);


INSERT INTO Message(expediteur, destinataire, etat, contenu, dateenvoi) VALUES(2,1,10,'Oui','2015-10-19 10:23:54');
INSERT INTO Conversation_Message VALUES(2,1);


INSERT INTO Message(expediteur, destinataire, etat, contenu, dateenvoi) VALUES(1,2,10,'On fait ça quand, t''es dispo mardi ?','2015-10-19 17:36:21');
INSERT INTO Conversation_Message VALUES(3,1);

INSERT INTO Message(expediteur, destinataire, etat, contenu, dateenvoi) VALUES(2,1,10,'Je crois bien, oui','2015-10-19 20:37:14');
INSERT INTO Conversation_Message VALUES(4,1);

INSERT INTO Message(expediteur, destinataire, etat, contenu, dateenvoi) VALUES(1,2,5,'Parfait, a mardi alors.','2015-10-20 07:08:12');
INSERT INTO Conversation_Message VALUES(5,1);






INSERT INTO notification(etat, destinataire, type, Message) VALUES(0,1,1,'Nouveau message de .....');
INSERT INTO notification(etat, destinataire, type, Message) VALUES(0,1,0,'Machin veux votre groupe pour');
INSERT INTO notification(etat, destinataire, type, Message) VALUES(1,1,1,'Nouveau message de .....');
