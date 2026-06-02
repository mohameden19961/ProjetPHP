-- ============================================================
-- Cabinet Médical — Données de démonstration
-- ============================================================

USE gestion_cabinet_medical;

-- -----------------------------------------------------------
-- Admin (mot de passe: admin123)
-- -----------------------------------------------------------
INSERT INTO utilisateur (nom, prenom, email, telephone, rôle) VALUES
('Admin', 'Super', 'admin@cabinet.com', '0123456789', 'admin');

INSERT INTO connexion (id_utilisateur, login, mot_de_passe) VALUES
(1, 'admin@cabinet.com', SHA2('admin123', 256));

-- -----------------------------------------------------------
-- Médecins (mot de passe: medecin123)
-- -----------------------------------------------------------
INSERT INTO utilisateur (nom, prenom, email, telephone, rôle) VALUES
('Diallo', 'Amadou', 'amadou.diallo@cabinet.com', '0611111111', 'medecin'),
('Ndiaye', 'Fatou', 'fatou.ndiaye@cabinet.com', '0622222222', 'medecin'),
('Ba', 'Moussa', 'moussa.ba@cabinet.com', '0633333333', 'medecin');

INSERT INTO medecin (id_medecin, nom, prenom, spécialité, email, telephone) VALUES
(2, 'Diallo', 'Amadou', 'Cardiologue', 'amadou.diallo@cabinet.com', '0611111111'),
(3, 'Ndiaye', 'Fatou', 'Pédiatre', 'fatou.ndiaye@cabinet.com', '0622222222'),
(4, 'Ba', 'Moussa', 'Généraliste', 'moussa.ba@cabinet.com', '0633333333');

INSERT INTO connexion (id_utilisateur, login, mot_de_passe) VALUES
(2, 'amadou.diallo@cabinet.com', SHA2('medecin123', 256)),
(3, 'fatou.ndiaye@cabinet.com', SHA2('medecin123', 256)),
(4, 'moussa.ba@cabinet.com', SHA2('medecin123', 256));

-- -----------------------------------------------------------
-- Assistants (mot de passe: assistant123)
-- -----------------------------------------------------------
INSERT INTO utilisateur (nom, prenom, email, telephone, rôle) VALUES
('Sow', 'Aïcha', 'aicha.sow@cabinet.com', '0644444444', 'assistant'),
('Fall', 'Oumar', 'oumar.fall@cabinet.com', '0655555555', 'assistant');

INSERT INTO assistant (id_utilisateur, departement) VALUES
(5, 'Accueil'),
(6, 'Administration');

INSERT INTO connexion (id_utilisateur, login, mot_de_passe) VALUES
(5, 'aicha.sow@cabinet.com', SHA2('assistant123', 256)),
(6, 'oumar.fall@cabinet.com', SHA2('assistant123', 256));

-- -----------------------------------------------------------
-- Patients (mot de passe: patient123)
-- -----------------------------------------------------------
INSERT INTO utilisateur (nom, prenom, email, telephone, rôle) VALUES
('Sy', 'Mariam', 'mariam.sy@email.com', '0666666666', 'patient'),
('Kane', 'Ibrahima', 'ibrahima.kane@email.com', '0677777777', 'patient'),
('Thiam', 'Aminata', 'aminata.thiam@email.com', '0688888888', 'patient'),
('Diop', 'Mamadou', 'mamadou.diop@email.com', '0699999999', 'patient'),
('Gueye', 'Awa', 'awa.gueye@email.com', '0610101010', 'patient');

INSERT INTO patient (id_patient, nom, prenom, date_naissance, sexe, adresse, telephone, email, dossier_medical) VALUES
(7,  'Sy', 'Mariam',   '1990-05-15', 'F', 'Dakar, Sicap',     '0666666666', 'mariam.sy@email.com',     'Hypertension artérielle sous traitement.'),
(8,  'Kane', 'Ibrahima', '1985-11-02', 'M', 'Thiès, Escale',    '0677777777', 'ibrahima.kane@email.com', 'Diabète de type 2. Suivi trimestriel.'),
(9,  'Thiam', 'Aminata', '2000-03-22', 'F', 'Saint-Louis',      '0688888888', 'aminata.thiam@email.com', 'Asthme léger. Aucune hospitalisation.'),
(10, 'Diop', 'Mamadou',  '1975-09-10', 'M', 'Dakar, Mermoz',    '0699999999', 'mamadou.diop@email.com', 'Antécédent chirurgical (appendicite 2020).'),
(11, 'Gueye', 'Awa',     '1995-07-30', 'F', 'Rufisque',         '0610101010', 'awa.gueye@email.com',     'Suivi grossesse — 2e trimestre.');

INSERT INTO connexion (id_utilisateur, login, mot_de_passe) VALUES
(7,  'mariam.sy@email.com',     SHA2('patient123', 256)),
(8,  'ibrahima.kane@email.com', SHA2('patient123', 256)),
(9,  'aminata.thiam@email.com', SHA2('patient123', 256)),
(10, 'mamadou.diop@email.com',  SHA2('patient123', 256)),
(11, 'awa.gueye@email.com',     SHA2('patient123', 256));

-- -----------------------------------------------------------
-- Traitements (liaisons patient-médecin)
-- -----------------------------------------------------------
INSERT INTO traitement (id_patient, id_medecin) VALUES
(7, 2), (8, 4), (9, 3), (10, 2), (11, 3),
(7, 4), (10, 4);

-- -----------------------------------------------------------
-- Rendez-vous
-- -----------------------------------------------------------
INSERT INTO rendezvous (id_traitement, date_rdv, heure, lieu, motif, statut) VALUES
(1,  CURDATE() + INTERVAL 1 DAY,  '09:00:00', 'Cabinet Principal', 'Consultation de contrôle', 'confirme'),
(2,  CURDATE() + INTERVAL 2 DAY,  '10:30:00', 'Salle 3',           'Suivi diabète',           'en_attente'),
(3,  CURDATE() - INTERVAL 3 DAY,  '14:00:00', 'Cabinet Pédiatrie', 'Examen de routine',       'confirme'),
(4,  CURDATE() + INTERVAL 5 DAY,  '11:00:00', 'Cabinet Principal', 'Douleurs thoraciques',    'en_attente'),
(5,  CURDATE() + INTERVAL 7 DAY,  '15:30:00', 'Salle 2',           'Consultation prénatale',  'en_attente');

-- -----------------------------------------------------------
-- Ordonnances
-- -----------------------------------------------------------
INSERT INTO ordonnance (id_traitement, médicaments) VALUES
(1, 'Amlodipine 5mg — 1 comprimé/jour\nAténolol 50mg — 1 comprimé/jour'),
(2, 'Metformine 850mg — 2 comprimés/jour\nSitagliptine 100mg — 1 comprimé/jour'),
(4, 'Paracétamol 500mg — si douleur\nOméprazole 20mg — 1 gélule/jour');

-- -----------------------------------------------------------
-- Hospitalisations
-- -----------------------------------------------------------
INSERT INTO hospitalisation (id_traitement, date_entree, date_sortie, service) VALUES
(4, '2025-10-15', '2025-10-20', 'Cardiologie'),
(5, '2026-01-10', NULL, 'Maternité');

-- -----------------------------------------------------------
-- Examens
-- -----------------------------------------------------------
INSERT INTO examen (id_traitement, type_examen, résultat) VALUES
(1, 'Prise de sang', 'Glycémie : 1.05 g/L — Cholestérol total : 2.10 g/L — TG : 0.85 g/L'),
(2, 'HbA1c', '7.2 % — Contrôle glycémique modéré'),
(4, 'Électrocardiogramme', 'Rythme sinusal régulier à 72 bpm. Pas de trouble de repolarisation.');
