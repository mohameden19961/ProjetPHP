# 🏥 Gestion de Cabinet Médical

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?logo=mysql)](https://mysql.com)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?logo=docker)](https://docker.com)
[![License](https://img.shields.io/badge/Licence-MIT-green)](LICENSE)
[![PRs](https://img.shields.io/badge/PRs-Bienvenue-brightgreen)]()

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
├── config/          # Configuration (DB, app)
├── securite/        # 🔒 Sécurité (session, hash, sanitize)
├── controllers/     # 🎯 Endpoints HTTP (entrée/sortie uniquement)
├── services/        # ⚙️ Logique métier
├── models/          # 🗄️ Accès base de données (SQL)
├── views/           # 🎨 Templates (auth, admin, medecin, patient, assistant)
├── public/          # 🌐 Point d'entrée, assets (CSS/JS/images)
│   ├── assets/
│   │   ├── css/     #   Styles composants (variables, base, navbar, sidebar, cards, tables, forms, utilities)
│   │   └── js/      #   Scripts (dashboard, auth, admin)
│   └── *.php        #   Dispatchers (index, connection, dashboard_*, medecin, patient, assistant)
└── database/        # 🗃️ SQL (schema + seed)
```

### Flux de requête

```
Navigateur → public/*.php → controllers/*Controller.php → services/*Service.php → models/*.php → MySQL
```

---

## 🚀 Installation

### Prérequis

- PHP 8.0+
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
MYSQLUSER=root
MYSQLPASSWORD=votre_mot_de_passe
MYSQLDATABASE=gestion_cabinet_medical
MYSQLPORT=3306
```

> ⚠️ Le fichier `.env` contient vos identifiants — il est **exclu de Git** par `.gitignore`.

### 3. Initialiser la base de données

```bash
mysql -u root -p < database/schema.sql
mysql -u root -p < database/seed.sql
```

### 4. Lancer l'application

**Avec PHP built-in server :**

```bash
php -S localhost:8000 -t public
```

**Avec Docker :**

```bash
docker compose up -d
```

Accédez à [http://localhost:8000](http://localhost:8000).

---

## 🔐 Comptes de démonstration

| Rôle         | Email                       | Mot de passe     |
|-------------|-----------------------------|------------------|
| 🛡️ Admin    | `admin@cabinet.com`         | `admin123`       |
| 👨‍⚕️ Médecin  | `amadou.diallo@cabinet.com` | `medecin123`     |
| 🧑‍⚕️ Assistant | `aicha.sow@cabinet.com`    | `assistant123`   |
| 👤 Patient   | `mariam.sy@email.com`       | `patient123`     |

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
| PHP 8.x       | Langage procédural pur           |
| MySQL 8.x     | Base de données relationnelle    |
| Docker        | Conteneurisation                 |
| Chart.js      | Graphiques statistiques (admin)  |
| SweetAlert2   | Notifications utilisateur        |
| Font Awesome  | Icônes                           |
| Aucun framework | Architecture MVC maison        |

---

## 📁 Structure détaillée

```
ProjetPHP/
├── config/
│   ├── app.php           # Session, auth wrappers, alerts
│   └── database.php      # Connexion MySQL via .env
├── securite/
│   ├── Session.php       # Gestion session, auth, rôles
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
│   └── Traitement.php
├── views/
│   ├── auth/             # Login / Inscription
│   ├── admin/            # Dashboard, users, stats, settings
│   ├── medecin/          # Agenda, patients, prescriptions
│   ├── patient/          # Profil, rdv, ordonnances
│   ├── assistant/        # Gestion patients, rdv, examens
│   └── shared/           # Head, header, scripts
├── public/
│   ├── index.php         # Routeur racine
│   ├── connection.php    # Login / Register
│   ├── medecin.php       # Espace médecin
│   ├── patient.php       # Espace patient
│   ├── assistant.php     # Espace assistant
│   └── assets/           # CSS, JS, images
├── database/
│   ├── schema.sql        # Structure complète
│   └── seed.sql          # Données de démonstration
├── .env.example          # Exemple de configuration
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
