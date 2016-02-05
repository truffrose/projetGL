/* Data Base Version 1 */
/* Use to implement the function to the realisation of the project */
/* The project is use to manage project and client in the same system */

CREATE DATABASE IF NOT EXISTS projetGL;

GRANT SELECT, UPDATE, INSERT, DELETE ON projetGL.* TO 'glUser'@'localhost' IDENTIFIED BY '123' ;

/* Use to reset the database */
	/* drop the table */
DROP TABLE IF EXISTS projetGL_personne_role;
DROP TABLE IF EXISTS projetGL_user_parameters;
DROP TABLE IF EXISTS projetGL_alerte;
DROP TABLE IF EXISTS projetGL_tache;
DROP TABLE IF EXISTS projetGL_projet;
DROP TABLE IF EXISTS projetGL_contact;
DROP TABLE IF EXISTS projetGL_user;
DROP TABLE IF EXISTS projetGL_uniteTemps;
DROP TABLE IF EXISTS projetGL_client;
DROP TABLE IF EXISTS projetGL_personne;
DROP TABLE IF EXISTS projetGL_role;
DROP TABLE IF EXISTS projetGL_etat;

	/* create the table */
CREATE TABLE projetGL_etat (
	id int NOT NULL AUTO_INCREMENT,
	nom VARCHAR(255) NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT uc_etat_nom UNIQUE (nom)
);

CREATE TABLE projetGL_role (
	id int NOT NULL AUTO_INCREMENT,
	nom VARCHAR(255) NOT NULL,
	description TEXT NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT uc_role_nom UNIQUE (nom)
);

CREATE TABLE projetGL_personne (
	id int NOT NULL AUTO_INCREMENT,
	nom VARCHAR(255) NOT NULL,
	prenom VARCHAR(255) NOT NULL,
	adresse TEXT NOT NULL,
	telephone VARCHAR(10) NOT NULL,
	mail VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE projetGL_personne_role (
	personne int NOT NULL,
	role int NOT NULL,
	PRIMARY KEY (personne, role),
	CONSTRAINT fk_personne_role_personne FOREIGN KEY(personne) REFERENCES projetGL_personne(id),
	CONSTRAINT fk_personne_role_role FOREIGN KEY(role) REFERENCES projetGL_role(id)
);

CREATE TABLE projetGL_user (
	id int NOT NULL AUTO_INCREMENT,
	mail VARCHAR(255) NOT NULL,
	password VARCHAR(32) NOT NULL,
	personne int NOT NULL,
	etat int NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT uc_user_mail UNIQUE (mail),
	CONSTRAINT fk_user_etat FOREIGN KEY(etat) REFERENCES projetGL_etat(id),
	CONSTRAINT fk_user_personne FOREIGN KEY(personne) REFERENCES projetGL_personne(id)
);

-- in an other table (in case of the evolution of the parameters)
CREATE TABLE projetGL_user_parameters (
	userId int NOT NULL ,
	autoAlert boolean NOT NULL,
	receiveMail boolean NOT NULL,
	receiveAlert boolean NOT NULL,
	defaultRole int NOT NULL,
	PRIMARY KEY (userId),
	CONSTRAINT fk_user_parameters_role FOREIGN KEY(defaultRole) REFERENCES projetGL_role(id),
	CONSTRAINT fk_user_parameters_user FOREIGN KEY(userId) REFERENCES projetGL_user(id)
);

CREATE TABLE projetGL_uniteTemps (
	id int NOT NULL AUTO_INCREMENT,
	typeUnite VARCHAR(255) NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT uc_uniteTemps_typeUnite UNIQUE (typeUnite)
);

CREATE TABLE projetGL_client (
	id int NOT NULL AUTO_INCREMENT,
	nom VARCHAR(255) NOT NULL,
	prenom VARCHAR(255) NOT NULL,
	adresse TEXT NOT NULL,
	etat int NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT fk_client_etat FOREIGN KEY(etat) REFERENCES projetGL_etat(id)
);

CREATE TABLE projetGL_projet (
	id int NOT NULL AUTO_INCREMENT,
	nom VARCHAR(255) NOT NULL,
	description TEXT NOT NULL,
	uniteTemps int NOT NULL,
	avancement int NOT NULL,
	client int NOT NULL,
	etat int NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT uc_projet_nom UNIQUE (nom),
	CONSTRAINT fk_projet_uniteTemps FOREIGN KEY(uniteTemps) REFERENCES projetGL_uniteTemps(id),
	CONSTRAINT fk_projet_client FOREIGN KEY(client) REFERENCES projetGL_client(id),
	CONSTRAINT fk_projet_etat FOREIGN KEY(etat) REFERENCES projetGL_etat(id)
);

CREATE TABLE projetGL_contact (
	id int NOT NULL AUTO_INCREMENT,
	client int NOT NULL,
	personne int NOT NULL,
	PRIMARY KEY (id),
	etat int NOT NULL,
	CONSTRAINT fk_contact_client FOREIGN KEY(client) REFERENCES projetGL_client(id),
	CONSTRAINT fk_contact_personne FOREIGN KEY(personne) REFERENCES projetGL_personne(id),
	CONSTRAINT fk_contact_etat FOREIGN KEY(etat) REFERENCES projetGL_etat(id)
);

CREATE TABLE projetGL_tache (
	id int NOT NULL AUTO_INCREMENT,
	nom VARCHAR(255) NOT NULL,
	description TEXT NOT NULL,
	dateDebut DATE NOT NULL,
	dateFinTot DATE NOT NULL,
	dateFinTard DATE NOT NULL,
	charge FLOAT(10, 2) NOT NULL,
	avancement FLOAT (4,2) NOT NULL,
	tempsPasse FLOAT(10, 2) NOT NULL,
	tempsRestant FLOAT(10, 2) NOT NULL,
	detruitALaCompletion boolean NOT NULL,
	niveau int NOT NULL,
	tacheMere int,
	predecesseur int,
	projet int NOT NULL,
	responssable int NOT NULL,
	contact int NOT NULL,
	etat int NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT fk_tache_tacheMere FOREIGN KEY(tacheMere) REFERENCES projetGL_tache(id),
	CONSTRAINT fk_tache_predecesseur FOREIGN KEY(predecesseur) REFERENCES projetGL_tache(id),
	CONSTRAINT fk_tache_projet FOREIGN KEY(projet) REFERENCES projetGL_projet(id),
	CONSTRAINT fk_tache_responssable FOREIGN KEY(responssable) REFERENCES projetGL_personne(id),
	CONSTRAINT fk_tache_contact FOREIGN KEY(contact) REFERENCES projetGL_contact(id),
	CONSTRAINT fk_tache_etat FOREIGN KEY(etat) REFERENCES projetGL_etat(id)
);

CREATE TABLE projetGL_alerte (
	id int NOT NULL AUTO_INCREMENT,
	tache int NOT NULL,
	emition DATETIME NOT NULL,
	contenue TEXT NOT NULL,
	titre VARCHAR(255) NOT NULL,
	etat int NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT fk_alerte_tache FOREIGN KEY(tache) REFERENCES projetGL_tache(id),
	CONSTRAINT fk_alert_etat FOREIGN KEY(etat) REFERENCES projetGL_etat(id)
);


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

/* add fake personne */
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('admin', 'admin', 'admin', '0000000000', 'admin@gmail.com');
INSERT INTO projetGL_personne(nom, prenom, adresse, telephone, mail) VALUES ('castelain', 'florian', '2 verel dessous', '0642644490', 'truffrose@gmail.com');

/* add value use to test the data base */
INSERT INTO projetGL_user(mail, password, personne, etat) VALUES('admin@gmail.com', md5('admin'), 1, 1);
INSERT INTO projetGL_user(mail, password, personne, etat) VALUES('truffrose@gmail.com', md5('123'), 2, 1);
	
	/* add the default parameters */
	INSERT INTO projetGL_user_parameters(userId, autoAlert, receiveMail, receiveAlert, defaultRole) VALUES(2, false, false, false, 4);
	
	/* add the default role to account */
	INSERT INTO projetGL_personne_role(personne, role) VALUES (1, 1);
	INSERT INTO projetGL_personne_role(personne, role) VALUES (2, 4);
	INSERT INTO projetGL_personne_role(personne, role) VALUES (2, 3);
	