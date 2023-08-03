DROP TABLE IF EXISTS reservations, Messages, PhotosGite, users, role, gites, owner, lock_time;

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
   id_gite INT PRIMARY KEY AUTO_IN-- Insertion dans la table Role
INSERT INTO role (id_role, libelle) VALUES (2, 'Admin');
INSERT INTO role (id_role, libelle) VALUES (1, 'Utilisateur');

-- Insertion dans la table Users
INSERT INTO users (nom, prenom, numero, adresse, mail, role) VALUES ('Smith', 'Alice', '0678901234', '456 Rue de Paris', 'alice@gmail.com', 2);
INSERT INTO users (nom, prenom, numero, adresse, mail, role) VALUES ('Johnson', 'Bob', '0778905678', '789 Rue de Lyon', 'bob@gmail.com', 1);
INSERT INTO users (nom, prenom, numero, adresse, mail, role) VALUES ('Doe', 'John', '0888101122', '123 Avenue de Versailles', 'john@gmail.com', 2);

INSERT INTO gites (nom, places, description, prix)
VALUES ('Petit Gîte', 2, 'Ceci est un petit gîte avec 2 places. Parfait pour un couple ou deux amis.', 110.00);

INSERT INTO gites (nom, places, description, prix)
VALUES ('Gîte de la Vallée', 5, 'Un charmant gîte situé au cœur de la vallée, idéal pour des vacances en famille.', 120.00);

-- Insertion dans la table Messages
INSERT INTO Messages (id_message, message, date_message, id_user_envoie, id_user_recepteur) VALUES (1, 'Bonjour, comment puis-je vous aider?', '2023-06-01 10:00:00', 1, 1);

INSERT INTO PhotosGite (id_gite, nom, chemin, utilite) VALUES
(1, 'illustration.jpg', '/public/images/gites/gite-1/illustrator.jpg', 'illustration'),
(1, 'slide-gite-1-0.jpg', '/public/images/gites/gite-1/slide-gite-1-0.jpg', 'slider'),
(1, 'slide-gite-1-1.jpg', '/public/images/gites/gite-1/slide-gite-1-1.jpg', 'slider'),
(1, 'slide-gite-1-2.jpg', '/public/images/gites/gite-1/slide-gite-1-2.jpg', 'slider'),

(2, 'illustration.jpg', '/public/images/gites/gite-2/illustrator.jpg', 'illustration'),
(2, 'slide_gite-2-0.jpg', '/public/images/gites/gite-2/slide-gite-2-0.jpg', 'slider'),
(2, 'slide_gite-2-1.jpg', '/public/images/gites/gite-1/slide-gite-2-1.jpg', 'slider'),
(2, 'slide-gite-2-2.jpg', '/public/images/gites/gite-1/slide-gite-2-2.jpg', 'slider');

-- Insertions supplémentaires dans la table Reservations
INSERT INTO reservations (id_user, id_gite, date_debut, date_fin, nb_personnes, commentaire)
VALUES (1, 2, '2023-06-10 10:00:00', '2023-06-20 18:00:00', 3, 'Rien'),
       (2, 1, '2023-06-15 10:00:00', '2023-06-25 18:00:00', 2, 'Hebergement long ?'),
       (1, 2, '2023-06-26 10:00:00', '2023-07-01 18:00:00', 4, 'Voiture + 2 enfant'),
       (1, 2, '2023-07-26 10:00:00', '2023-07-30 18:00:00', 4, 'chien');


INSERT INTO owner(name, password) VALUES ('root', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2');
CREMENT,
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

