-- ============================================================
-- Cabinet Médical — Schema de la base de données
-- MySQL 8.x+
-- ============================================================

CREATE DATABASE IF NOT EXISTS gestion_cabinet_medical
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE gestion_cabinet_medical;

-- -----------------------------------------------------------
-- 1. Utilisateurs (admin, medecin, assistant, patient)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS utilisateur (
  id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
  nom            VARCHAR(100) NOT NULL,
  prenom         VARCHAR(100) NOT NULL,
  email          VARCHAR(255) NOT NULL UNIQUE,
  telephone      VARCHAR(20)  DEFAULT NULL,
  rôle           ENUM('admin','medecin','assistant','patient') NOT NULL DEFAULT 'patient',
  photo_profil   VARCHAR(500) DEFAULT NULL,
  date_creation  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------------
-- 2. Connexion (authentification)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS connexion (
  id_connexion   INT AUTO_INCREMENT PRIMARY KEY,
  id_utilisateur INT NOT NULL,
  login          VARCHAR(255) NOT NULL UNIQUE,
  mot_de_passe   VARCHAR(64)  NOT NULL,  -- SHA-256 hex
  FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------------
-- 3. Patient
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS patient (
  id_patient     INT PRIMARY KEY,
  nom            VARCHAR(100) NOT NULL,
  prenom         VARCHAR(100) NOT NULL,
  date_naissance DATE         DEFAULT NULL,
  sexe           ENUM('M','F','Autre') DEFAULT NULL,
  adresse        TEXT         DEFAULT NULL,
  telephone      VARCHAR(20)  DEFAULT NULL,
  email          VARCHAR(255) DEFAULT NULL UNIQUE,
  dossier_medical TEXT        DEFAULT NULL,
  FOREIGN KEY (id_patient) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------------
-- 4. Médecin
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS medecin (
  id_medecin  INT PRIMARY KEY,
  nom         VARCHAR(100) NOT NULL,
  prenom      VARCHAR(100) NOT NULL,
  spécialité  VARCHAR(150) DEFAULT 'Généraliste',
  email       VARCHAR(255) DEFAULT NULL,
  telephone   VARCHAR(20)  DEFAULT NULL,
  FOREIGN KEY (id_medecin) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------------
-- 5. Assistant
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS assistant (
  id_assistant   INT AUTO_INCREMENT PRIMARY KEY,
  id_utilisateur INT NOT NULL UNIQUE,
  departement    VARCHAR(150) DEFAULT 'Accueil',
  FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------------
-- 6. Traitement (liaison patient-médecin)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS traitement (
  id_traitement INT AUTO_INCREMENT PRIMARY KEY,
  id_patient    INT NOT NULL,
  id_medecin    INT NOT NULL,
  date_debut    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_patient) REFERENCES patient(id_patient) ON DELETE CASCADE,
  FOREIGN KEY (id_medecin) REFERENCES medecin(id_medecin) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------------
-- 7. Rendez-vous
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS rendezvous (
  id_rdv         INT AUTO_INCREMENT PRIMARY KEY,
  id_traitement  INT NOT NULL,
  date_rdv       DATE        NOT NULL,
  heure          TIME        DEFAULT NULL,
  lieu           VARCHAR(255) DEFAULT 'Clinique',
  motif          TEXT        DEFAULT NULL,
  statut         ENUM('en_attente','confirme','annule') NOT NULL DEFAULT 'en_attente',
  FOREIGN KEY (id_traitement) REFERENCES traitement(id_traitement) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------------
-- 8. Ordonnance
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS ordonnance (
  id_ordonnance    INT AUTO_INCREMENT PRIMARY KEY,
  id_traitement    INT NOT NULL,
  date_ordonnance  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  médicaments      TEXT NOT NULL,
  FOREIGN KEY (id_traitement) REFERENCES traitement(id_traitement) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------------
-- 9. Hospitalisation
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS hospitalisation (
  id_hospitalisation INT AUTO_INCREMENT PRIMARY KEY,
  id_traitement      INT NOT NULL,
  date_entree        DATE NOT NULL,
  date_sortie        DATE DEFAULT NULL,
  service            VARCHAR(200) DEFAULT NULL,
  FOREIGN KEY (id_traitement) REFERENCES traitement(id_traitement) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------------
-- 10. Examen
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS examen (
  id_examen    INT AUTO_INCREMENT PRIMARY KEY,
  id_traitement INT NOT NULL,
  date_examen  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  type_examen  VARCHAR(200) NOT NULL,
  résultat     TEXT DEFAULT NULL,
  FOREIGN KEY (id_traitement) REFERENCES traitement(id_traitement) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------------
-- Indexes
-- -----------------------------------------------------------
CREATE INDEX idx_utilisateur_role ON utilisateur(rôle);
CREATE INDEX idx_rdv_date ON rendezvous(date_rdv);
CREATE INDEX idx_rdv_statut ON rendezvous(statut);
CREATE INDEX idx_traitement_patient ON traitement(id_patient);
CREATE INDEX idx_traitement_medecin ON traitement(id_medecin);
