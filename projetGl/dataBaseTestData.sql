/* ajout des personnes pour le teste */
    /* utilisateur du system */
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('admin', 'admin', 'admin', '0000000000', 'admin@gmail.com');
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('rousseau', 'aurelien', '9 sentier Eugene Bregeard 94230 Cachan', '0608544087', 'ta.rousseau@gmail.com');
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('da Silva', 'thomas', '15 rue des bois 91400 Saclay', '0658644587', 't.dasilva@gmail.com');
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('castelain', 'florian', '5 rue des paumes 74400 Talloires', '0638224087', '.castelain@gmail.com');
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('djian', 'thomas', '5 rue des damnes 91 800 Velizy', '0677444065', 't.djian@gmail.com');
    /* contact du system */
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('morroy', 'pierre', '9 sentier Eugene Bregeard 94230 Cachan', '0145467645', 'pierre.morroy@desjoyaux.com');
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('marlay', 'damien', '14 avenue Charles 94500 Gentilly', '0154468645', 'damien.marley@interflora.com');
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('richard', 'benoit', '7 avenue De Gaulle 75 000 Paris', '0145467645', 'benoit.richard@interflora.com');

/* add value use to test the data base */
INSERT INTO projetGL_user(mail, password, personne, etat) VALUES('admin', md5('admin'), 1, 1);
INSERT INTO projetGL_user(mail, password, personne, etat) VALUES('a.rousseau', md5('arousse'), 2, 1);
INSERT INTO projetGL_user(mail, password, personne, etat) VALUES('t.dasilva', md5('tdasilv'), 3, 1);
INSERT INTO projetGL_user(mail, password, personne, etat) VALUES('f.castelain', md5('fcastel'), 4, 1);
INSERT INTO projetGL_user(mail, password, personne, etat) VALUES('t.djian', md5('tdjian'), 5, 1);
	
	/* add the default parameters */
	INSERT INTO projetGL_user_parameters(userId, autoAlert, receiveMail, receiveAlert, defaultRole) VALUES(2, false, false, false, 4);
	INSERT INTO projetGL_user_parameters(userId, autoAlert, receiveMail, receiveAlert, defaultRole) VALUES(3, false, false, false, 4);
	INSERT INTO projetGL_user_parameters(userId, autoAlert, receiveMail, receiveAlert, defaultRole) VALUES(4, false, false, false, 4);
	INSERT INTO projetGL_user_parameters(userId, autoAlert, receiveMail, receiveAlert, defaultRole) VALUES(5, false, false, false, 4);
	
	/* add the default role to account */
	INSERT INTO projetGL_personne_role(personne, role) VALUES (1, 1);
	INSERT INTO projetGL_personne_role(personne, role) VALUES (2, 2);
	INSERT INTO projetGL_personne_role(personne, role) VALUES (2, 4);
	INSERT INTO projetGL_personne_role(personne, role) VALUES (3, 3);
	INSERT INTO projetGL_personne_role(personne, role) VALUES (3, 4);
	INSERT INTO projetGL_personne_role(personne, role) VALUES (4, 2);
	INSERT INTO projetGL_personne_role(personne, role) VALUES (4, 4);
	INSERT INTO projetGL_personne_role(personne, role) VALUES (5, 3);
	INSERT INTO projetGL_personne_role(personne, role) VALUES (5, 4);

/* ajout de client à la base */
INSERT INTO projetGL_client(nom, adresse, etat) VALUES("InterFlora", "15 rue des Amandiers 94230 Cachan", 1);
INSERT INTO projetGL_client(nom, adresse, etat) VALUES("Piscine DesJoyaux", "4 rue des fleuristes 91 400 Saclay", 1);

/* ajout des information pour créer des contact */
INSERT INTO projetGL_contact(client, personne, etat) VALUES (2, 6, 1);
INSERT INTO projetGL_contact(client, personne, etat) VALUES (1, 7, 1);
INSERT INTO projetGL_contact(client, personne, etat) VALUES (1, 8, 1);

/* ajout des projets */
INSERT INTO projetGL_projet(nom, description, uniteTemps, avancement, client, responsable, etat) VALUES("Bouquet de fleur", "Creation d’un bouquet de fleur", 1, 35, 1, 3, 1);
    /* ajout des taches */
    INSERT INTO projetGL_tache(nom, description, dateDebut, dateFinTot, dateFinTard, charge, avancement, tempsPasse, tempsRestant, detruitALaCompletion, niveau, tacheMere, predecesseur, projet, responsable, contact, etat)
    VALUES("Ceuillir les fleurs", "il faut ceuillir les fleurs", now(), ADDDATE(now(), 5), ADDDATE(now(), 7), 5, 50, 3, 2, true, 0, null, null, 1, 4, 7, 1);
    INSERT INTO projetGL_tache(nom, description, dateDebut, dateFinTot, dateFinTard, charge, avancement, tempsPasse, tempsRestant, detruitALaCompletion, niveau, tacheMere, predecesseur, projet, responsable, contact, etat)
    VALUES("Couper les fleurs", "il faut couper les fleurs", ADDDATE(now(), 5), ADDDATE(now(), 10), ADDDATE(now(), 12), 5, 0, 0, 5, true, 0, null, 1, 1, 5, 8, 1);
    INSERT INTO projetGL_tache(nom, description, dateDebut, dateFinTot, dateFinTard, charge, avancement, tempsPasse, tempsRestant, detruitALaCompletion, niveau, tacheMere, predecesseur, projet, responsable, contact, etat)
    VALUES("Assembler les fleurs", "il faut assembler les fleurs", ADDDATE(now(), 15), ADDDATE(now(), 20), ADDDATE(now(), 22), 5, 0, 0, 5, true, 0, null, 2, 1, 4, 8, 1);
    
    
    
    
    