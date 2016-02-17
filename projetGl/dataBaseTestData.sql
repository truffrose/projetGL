/* add the default unite of time */
INSERT INTO projetGL_uniteTemps(typeUnite) VALUES('jour homme');
INSERT INTO projetGL_uniteTemps(typeUnite) VALUES('heure');

/* add the different role */
INSERT INTO projetGL_role(nom, description) VALUES('SuperAdmin', 'Ne peut pas être supprimé de la base de donné.');
INSERT INTO projetGL_role(nom, description) VALUES('Administrateur', 'A un droit de vision sur l integralié des projets. Il peeut aussi modifier des droit utilisateurs.');
INSERT INTO projetGL_role(nom, description) VALUES('Chef projet', 'A le droit d interragir sur un projet');
INSERT INTO projetGL_role(nom, description) VALUES('Collaborateur', 'Peut uniquement travailler sur ces projets');

/* add the default etat */
INSERT INTO projetGL_etat(nom) VALUES ('actif');
INSERT INTO projetGL_etat(nom) VALUES ('delete');
INSERT INTO projetGL_etat(nom) VALUES ('termines');
INSERT INTO projetGL_etat(nom) VALUES ('archives');

/* add fake personne */
    /* utilisateur du system */
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('admin', 'admin', 'admin', '0000000000', 'admin@gmail.com');
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('castelain', 'florian', '2 verel dessous', '0642644490', 'truffrose@gmail.com');
    /* contact du system */
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('castelain', 'florian', '2 avenue de paris, 74000 Annecy', '0156324895', 'florian.castelain@altec.com');
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('duchamps', 'albert', '16 rue de france, 94000 Creteil', '0125698745', 'albert@altec.com');
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('djian', 'thomas', '3 impasse des inconue, 14000 Perdu', '0123458965', 'thomas@gmail.com');

/* add value use to test the data base */
INSERT INTO projetGL_user(mail, password, personne, etat) VALUES('admin@gmail.com', md5('admin'), 1, 1);
INSERT INTO projetGL_user(mail, password, personne, etat) VALUES('truffrose@gmail.com', md5('123'), 2, 1);
	
	/* add the default parameters */
	INSERT INTO projetGL_user_parameters(userId, autoAlert, receiveMail, receiveAlert, defaultRole) VALUES(2, false, false, false, 4);
	
	/* add the default role to account */
	INSERT INTO projetGL_personne_role(personne, role) VALUES (1, 1);
	INSERT INTO projetGL_personne_role(personne, role) VALUES (2, 4);
	INSERT INTO projetGL_personne_role(personne, role) VALUES (2, 3);

/* ajout de client à la base */
INSERT INTO projetGL_client(nom, adresse, etat) VALUES("altec", "7 rue de france, 94000 Créteil", 1);
INSERT INTO projetGL_client(nom, adresse, etat) VALUES("thales", "25 route des champs, 91000 Cachan", 1);

/* ajout des information pour créer des contact */
INSERT INTO projetGL_contact(client, personne, etat) VALUES (1, 3, 1);
INSERT INTO projetGL_contact(client, personne, etat) VALUES (1, 4, 1);
INSERT INTO projetGL_contact(client, personne, etat) VALUES (1, 5, 1);

/* ajout des projets */
    /* 2 projet altec */
INSERT INTO projetGL_projet(nom, description, uniteTemps, avancement, client, etat) VALUES("azure", "projet asure du client altec", 1, 12, 1, 1);
INSERT INTO projetGL_projet(nom, description, uniteTemps, avancement, client, etat) VALUES("projetGL", "projet pour la GL", 2, 30, 1, 1);
    /* 1 projet thales */
INSERT INTO projetGL_projet(nom, description, uniteTemps, avancement, client, etat) VALUES("deleteProjet", "supprimer de la base (du moins pas actif)", 1, 85, 2, 2);