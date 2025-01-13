CREATE DATABASE Youdemy;
USE Youdemy;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role INT NOT NULL, 
    statut ENUM('Actif', 'Suspendu'),
    statut_enseignant ENUM('En_attente', 'Valide', 'Refuse'),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role) REFERENCES roles(id)
);

CREATE TABLE cours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    contenu TEXT, 
    enseignant_id INT,
    categorie_id INT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (enseignant_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE SET NULL
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT
);

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE cours_tags (
    cours_id INT,
    tag_id INT,
    PRIMARY KEY (cours_id, tag_id),
    FOREIGN KEY (cours_id) REFERENCES cours(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

CREATE TABLE inscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etudiant_id INT,
    cours_id INT,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (etudiant_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (cours_id) REFERENCES cours(id) ON DELETE CASCADE
);

CREATE TABLE statistiques_cours (
    cours_id INT PRIMARY KEY,
    nombre_etudiants INT DEFAULT 0,
    nombre_cours INT DEFAULT 0,
    FOREIGN KEY (cours_id) REFERENCES cours(id) ON DELETE CASCADE
);

CREATE TABLE validation_enseignants (
    enseignant_id INT PRIMARY KEY,
    statut_validation ENUM('En_attente', 'Valide', 'Refuse') DEFAULT 'en_attente',
    date_validation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (enseignant_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE logs_admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT,
    action VARCHAR(255) NOT NULL,
    cible_type ENUM('Utilisateur', 'Cours', 'Categorie', 'Tag', 'Validation') NOT NULL,
    cible_id INT NOT NULL,
    date_action TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO roles (role_name) VALUES ('Admin');
INSERT INTO roles (role_name) VALUES ('Etudiant');
INSERT INTO roles (role_name) VALUES ('Enseignant');