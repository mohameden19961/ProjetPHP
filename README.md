# 🏥 Gestion de Cabinet Médical — Application de Gestion des dossiers des patients

> **Projet Intégrateur** — 1ʳᵉ Année Licence — **Institut Supérieur du Numérique (SUPNUM)**

[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?logo=php)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql)](https://mysql.com)
[![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?logo=docker)](https://docker.com)
[![License](https://img.shields.io/badge/Licence-MIT-green)](LICENSE)

### 👥 Réalisé par

| Nom | Matricule |
|-----|-----------|
| Ahmed Med Lemine Bahan | 24120 |
| Saadbouh Sidi Mahmoud | 24212 |
| Abdy Mohameden | 24068 |
| Zaineb Sidi Maouloud Jakiri | 24206 |
| Oum Elkheyri Meillid | 24208 |

---

> **Application web de gestion complète pour cabinet médical** — rendez-vous, dossier patients, ordonnances, hospitalisations, examens. Architecture MVC procédurale, pile PHP/MySQL.

---

## ✨ Aperçu

| Rôle         | Fonctionnalités clés                                      |
|-------------|-----------------------------------------------------------|
| 🛡️ Admin    | Dashboard, gestion utilisateurs, statistiques, paramètres |
| 👨‍⚕️ Médecin  | Agenda, patients, ordonnances, dossiers médicaux           |
| 🧑‍⚕️ Assistant | Patients, rendez-vous, examens, hospitalisations          |
| 👤 Patient   | Profil, rendez-vous, ordonnances, examens, hospitalisation |

---

## 🏗️ Architecture

```
ProjetPHP/
├── config/          # Configuration (DB, constantes, app)
├── securite/        # 🔒 Sécurité (session, hash, sanitize)
├── controllers/     # 🎯 Endpoints HTTP (entrée/sortie uniquement)
├── services/        # ⚙️ Logique métier
├── models/          # 🗄️ Accès base de données (SQL)
├── views/           # 🎨 Templates (auth, admin, medecin, patient, assistant, shared/)
├── public/          # 🌐 Assets statiques (CSS, JS, images)
│   ├── assets/css/  #   Styles (base, layout, composants)
│   ├── assets/js/   #   Scripts dashboard, auth
│   └── api/         #   📡 Endpoints JSON (avec _helpers.php)
├── database/        # 🗃️ SQL (schema + seed)
├── router.php       # 🚦 Routeur unique (statique + PHP)
└── index.php        # 🏠 Point d'entrée racine
```

### Flux de requête

```
Navigateur → router.php → index.php (ou public/*.php)
  → controllers/*Controller.php → services/*Service.php → models/*.php → MySQL
```

---

## 🚀 Installation

### Prérequis

- PHP 8.4+
- MySQL 8.x
- [Docker](https://docker.com) (optionnel)

### 1. Cloner le projet

```bash
git clone https://github.com/mohameden19961/ProjetPHP.git
cd ProjetPHP
```

### 2. Configurer l'environnement

```bash
cp .env.example .env
# Éditer .env avec vos accès MySQL
nano .env
```

**Fichier `.env` :**

```env
MYSQLHOST=localhost
MYSQLUSER=gcm_user
MYSQLPASSWORD=gcm_pass
MYSQLDATABASE=gestion_cabinet_medical
MYSQLPORT=3306
```

> ⚠️ Le fichier `.env` contient vos identifiants — il est **exclu de Git** par `.gitignore`.
> En Docker, `MYSQLHOST=db` (nom du service dans `docker-compose.yml`).

### 3. Initialiser la base de données

```bash
mysql -u root -p < database/schema.sql
mysql -u root -p < database/seed.sql
```

### 4. Lancer l'application

**Avec PHP built-in server (développement) :**

```bash
php -S 0.0.0.0:8001 router.php
```

Accédez à [http://localhost:8001](http://localhost:8001).

**Avec Docker (production locale) :**

```bash
docker compose up -d
# Base de données initialisée automatiquement (schema.sql + seed.sql)
```

Accédez à [http://localhost:8001](http://localhost:8001).

---

## 🔐 Comptes de démonstration

| Rôle         | Identifiant                  | Mot de passe     |
|-------------|------------------------------|------------------|
| 🛡️ Admin    | `24068@supnum.mr`            | `admin123`       |
| 👨‍⚕️ Médecin  | `test.doctor@gmail.com`      | `medecin123`     |
| 🧑‍⚕️ Assistant | `test.assistant@gmail.com`  | `assistant123`   |
| 👤 Patient   | `login_pat1`                 | `patient123`     |

> ℹ️ Les patients se connectent avec leur **login** (pas email). Les autres rôles utilisent leur **email**.

### Codes d'inscription

| Rôle       | Code               |
|-----------|--------------------|
| Médecin   | `medecin456`       |
| Assistant | `assistant789`     |

---

## 🗃️ Base de données

### Tables

| Table           | Description                                |
|----------------|--------------------------------------------|
| `utilisateur`  | Comptes utilisateurs (admin, medecin, assistant, patient) |
| `connexion`    | Authentification (email + SHA-256)         |
| `patient`      | Fiche patient (nom, date naissance, dossier médical) |
| `medecin`      | Fiche médecin (nom, spécialité)            |
| `assistant`    | Fiche assistant (département)              |
| `traitement`   | Liaison patient-médecin                    |
| `rendezvous`   | Rendez-vous (date, heure, statut)          |
| `ordonnance`   | Prescriptions médicales                    |
| `hospitalisation` | Séjours hospitaliers                    |
| `examen`       | Examens complémentaires                    |

### Diagramme ER simplifié

```
utilisateur ──┬── connexion
              ├── patient ─┬── traitement ──┬── rendezvous
              ├── medecin ──┘               ├── ordonnance
              └── assistant                 ├── hospitalisation
                                            └── examen
```

---

## 🧪 Tests

```bash
php -l config/*.php controllers/*.php services/*.php models/*.php
```

---

## 🧰 Stack technique

| Technologie    | Usage                            |
|---------------|----------------------------------|
| PHP 8.4       | Langage procédural pur           |
| MySQL 8.0     | Base de données relationnelle    |
| Docker Compose| Conteneurisation (app + db)      |
| Chart.js      | Graphiques statistiques (admin)  |
| SweetAlert2   | Notifications utilisateur        |
| Font Awesome 6| Icônes                           |
| Aucun framework | Architecture MVC maison        |

---

## 📁 Structure détaillée

```
ProjetPHP/
├── config/
│   ├── app.php           # Session, constantes, auth wrappers, alerts
│   └── database.php      # Connexion MySQL via .env
├── securite/
│   ├── Session.php       # Gestion session, auth, rôles, redirect
│   ├── Hash.php          # Hachage SHA-256 centralisé
│   └── Sanitizer.php     # Nettoyage entrées
├── controllers/
│   ├── AuthController.php
│   ├── AdminController.php
│   ├── MedecinController.php
│   ├── PatientController.php
│   └── AssistantController.php
├── services/
│   ├── AuthService.php
│   ├── AdminService.php
│   ├── MedecinService.php
│   ├── PatientService.php
│   └── AssistantService.php
├── models/
│   ├── User.php          # CRUD utilisateur
│   ├── Patient.php       # CRUD patient
│   ├── Medecin.php       # CRUD médecin
│   ├── Assistant.php     # CRUD assistant
│   ├── Rendezvous.php    # CRUD rendez-vous
│   ├── Ordonnance.php    # CRUD ordonnance
│   ├── Hospitalisation.php
│   ├── Examen.php
│   └── Traitement.php    # findOrCreate liaison patient-médecin
├── views/
│   ├── auth/             # Login / Inscription
│   ├── admin/            # Dashboard, users, stats, settings
│   ├── medecin/          # Agenda, patients, prescriptions
│   ├── patient/          # Profil, rdv, ordonnances
│   ├── assistant/        # Gestion patients, rdv, examens
│   └── shared/           # Head, header, scripts, base_layout
├── public/
│   ├── api/              # 📡 Endpoints JSON (boilerplate mutualisé via _helpers.php)
│   │   ├── _helpers.php  #   Méthode, ID, api_success(), api_error()
│   │   ├── patients.php
│   │   ├── medecins.php
│   │   ├── assistants.php
│   │   ├── utilisateurs.php
│   │   ├── examens.php
│   │   ├── ordonnances.php
│   │   ├── rendezvous.php
│   │   └── hospitalisations.php
│   ├── index.php         # Point d'entrée unique
│   ├── connection.php    # Login / Register
│   ├── medecin.php       # Espace médecin
│   ├── patient.php       # Espace patient
│   ├── assistant.php     # Espace assistant
│   └── assets/           # CSS, JS, images
├── database/
│   ├── schema.sql        # Structure complète
│   └── seed.sql          # Données de démonstration
├── router.php            # 🚦 Routeur (statique → readfile, PHP → require)
├── index.php             # 🏠 Redirection vers public/
├── .env.example          # Exemple de configuration
├── Dockerfile            # 🐳 PHP 8.4-cli + router.php
├── docker-compose.yml    # 🐳 App + MySQL 8.0 (init auto)
└── .gitignore
```

---

## 🤝 Contribution

1. Fork le projet
2. Créez une branche (`git checkout -b feature/ma-feature`)
3. Commitez (`git commit -m 'Ajout de ma feature'`)
4. Pushez (`git push origin feature/ma-feature`)
5. Ouvrez une Pull Request

---

## 📄 Licence

Projet sous licence MIT. Libre d'utilisation, de modification et de distribution.

---

<div align="center">
  <sub>Construit avec ❤️ par <a href="https://github.com/mohameden19961">mohameden19961</a></sub>
</div>
