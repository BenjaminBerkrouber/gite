DROP TABLE IF EXISTS reservations, Messages, PhotosGite, users, role, gites, owner, lock_time, travel_time;

CREATE TABLE role(
   id_role INT PRIMARY KEY AUTO_INCREMENT,
   libelle VARCHAR(50)
);

CREATE TABLE users(
   id_user INT PRIMARY KEY auto_increment,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   numero VARCHAR(20),
   adresse VARCHAR(255),
   mail VARCHAR(100),
   role INT,
   FOREIGN KEY(role) REFERENCES role(id_role)
);

CREATE TABLE gites(
   id_gite INT PRIMARY KEY AUTO_INCREMENT,
   nom VARCHAR(50),
   places INT,
   description TEXT,
   prix DECIMAL(8, 2)
);

CREATE TABLE PhotosGite (
   id_photo INT PRIMARY KEY AUTO_INCREMENT,
   id_gite INT,
   nom VARCHAR(100),
   chemin VARCHAR(255),
   utilite VARCHAR(50),
   FOREIGN KEY(id_gite) REFERENCES gites(id_gite)
);

CREATE TABLE Messages(
   id_message INT PRIMARY KEY AUTO_INCREMENT,
   message TEXT,
   date_message DATETIME,
   id_user_envoie INT,
   id_user_recepteur INT,
   FOREIGN KEY(id_user_envoie) REFERENCES users(id_user),
   FOREIGN KEY(id_user_recepteur) REFERENCES users(id_user)
);

CREATE TABLE reservations(
   id_reservation INT PRIMARY KEY AUTO_INCREMENT,
   id_user INT,
   id_gite INT,
   commentaire TEXT NULL,
   date_debut DATETIME,
   date_fin DATETIME,
   nb_personnes INT,
   FOREIGN KEY(id_user) REFERENCES users(id_user),
   FOREIGN KEY(id_gite) REFERENCES gites(id_gite),
   UNIQUE (id_gite, date_debut, date_fin)
);

CREATE TABLE lock_time(
    date_debut DATETIME,
    date_fin DATETIME,
    primary key (date_fin, date_debut)
);

CREATE TABLE travel_time(
    id_lock INT PRIMARY KEY AUTO_INCREMENT,
    date_debut DATETIME,
    date_fin DATETIME,
    id_gite int,
    FOREIGN KEY(id_gite) REFERENCES gites(id_gite)
);

CREATE TABLE cleaning_time(
    id_cleaning INT PRIMARY KEY AUTO_INCREMENT,
    date_debut DATETIME,
    date_fin DATETIME,
    id_gite INT,
    FOREIGN KEY(id_gite) REFERENCES gites(id_gite)
);

CREATE TABLE owner(
    id_admin INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255),
    password text
);
