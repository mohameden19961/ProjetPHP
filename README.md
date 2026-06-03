# Cabinet Médical — Gestion de cabinet médical

Application web de gestion complète d'un cabinet médical avec
authentification par rôles, gestion des rendez-vous, dossiers patients,
ordonnances, examens et hospitalisations.

## Fonctionnalités

- **Administrateur** — gestion des utilisateurs, statistiques, paramètres
- **Médecin** — agenda, dossiers patients, prescriptions, annulation RDV
- **Assistant** — gestion des patients, RDV, examens, hospitalisations
- **Patient** — tableau de bord, dossier médical, prise de RDV

## Prérequis

- **PHP** 8.0 ou supérieur (utilise `match()`, `str_starts_with()`, `json_encode()`)
- **MySQL** 8.x (avec `utf8mb4`)
- **Serveur** WampServer / XAMPP / Laragon / PHP built-in server
- **Extensions** PHP : `mysqli`, `mbstring`, `json`, `fileinfo`

## Installation

1. **Cloner le dépôt**

   ```bash
   git clone <url-du-depot> cabinet-medical
   cd cabinet-medical
   ```

2. **Configurer la base de données**

   Créer une base MySQL nommée `gestion_cabinet_medical` :

   ```bash
   mysql -u root -p < database/schema.sql
   mysql -u root -p < database/seed.sql
   ```

3. **Configurer l'environnement**

   Copier `.env.example` en `.env` et renseigner vos accès MySQL :

   ```bash
   cp .env.example .env
   ```

   Contenu du `.env` :

   ```
   MYSQLHOST=127.0.0.1
   MYSQLUSER=root
   MYSQLPASSWORD=
   MYSQLDATABASE=gestion_cabinet_medical
   MYSQLPORT=3306
   ```

4. **Lancer l'application**

   Avec le serveur PHP intégré (recommandé) :

   ```bash
   php -S localhost:8000 router.php
   ```

   Accéder à `http://localhost:8000`.

   > **Note :** Le fichier `router.php` sert de point d'entrée.
   > Il gère le routage des fichiers statiques et la sécurité
   > (protection anti-path-traversal). Ne pas utiliser le
   > document root standard.

   Avec WampServer / XAMPP :
   - Placer le dossier dans `www/` ou `htdocs/`
   - Configurer le virtual host pour pointer sur le dossier racine
   - Ajouter une réécriture vers `router.php` ou utiliser le fichier
     `index.php` comme point d'entrée direct

## Rôles et identifiants de test

| Rôle       | Email                          | Mot de passe    |
|------------|--------------------------------|-----------------|
| Admin      | admin@cabinet.com              | admin123        |
| Médecin    | amadou.diallo@cabinet.com      | medecin123      |
| Médecin    | fatou.ndiaye@cabinet.com       | medecin123      |
| Médecin    | moussa.ba@cabinet.com          | medecin123      |
| Assistant  | aicha.sow@cabinet.com          | assistant123    |
| Assistant  | oumar.fall@cabinet.com         | assistant123    |
| Patient    | mariam.sy@email.com            | patient123      |
| Patient    | ibrahima.kane@email.com        | patient123      |
| Patient    | aminata.thiam@email.com        | patient123      |
| Patient    | mamadou.diop@email.com         | patient123      |
| Patient    | awa.gueye@email.com            | patient123      |

## API REST

Des endpoints API sont disponibles sous `/api/` (JSON).
Nécessitent une session active (authentification préalable via le web).

| Méthode | Endpoint              | Rôles autorisés                  |
|---------|-----------------------|----------------------------------|
| GET     | /api/patients.php     | Authentifié (liste : admin/médecin/assistant) |
| POST    | /api/patients.php     | Admin, médecin, assistant        |
| PUT     | /api/patients.php?id=X | Admin, médecin, assistant       |
| DELETE  | /api/patients.php?id=X | Admin                           |
| GET     | /api/medecins.php     | Authentifié (liste : admin/médecin/assistant) |
| POST    | /api/medecins.php     | Admin                           |
| GET     | /api/rendezvous.php   | Authentifié (liste : admin/médecin/assistant) |
| POST    | /api/rendezvous.php   | Admin, médecin, assistant, patient |
| GET     | /api/ordonnances.php  | Authentifié (liste : admin/médecin) |
| GET     | /api/examens.php      | Authentifié (liste : admin/médecin/assistant) |
| GET     | /api/hospitalisations.php | Authentifié (liste : admin/médecin/assistant) |
| GET/POST/PUT/DELETE | /api/utilisateurs.php | Admin uniquement               |
| GET/POST/PUT/DELETE | /api/assistants.php   | Admin uniquement               |

## Structure du projet

```
├── config/          — Configuration (base de données, constantes)
├── controllers/     — Logique métier des pages
├── database/        — Schéma SQL et données de test
├── models/          — Accès aux données (requêtes préparées)
├── public/          — Point d'entrée web (fichiers publics)
│   ├── api/         — Endpoints API REST
│   ├── assets/      — CSS, JS, images
│   └── uploads/     — Fichiers uploadés (photos de profil)
├── securite/        — Session, hash, sanitisation
├── services/        — Couche service entre contrôleurs et modèles
├── views/           — Templates HTML par rôle
├── index.php        — Redirection racine
└── router.php       — Routeur pour le serveur PHP intégré
```

## Sécurité

- **SQLi** : toutes les requêtes utilisent des requêtes préparées
- **XSS** : les sorties utilisateur sont échappées avec `htmlspecialchars()`
  ou `json_encode()` dans les contextes JavaScript
- **CSRF** : jetons générés par `random_bytes(32)`, vérifiés par `hash_equals()`
- **Session** : régénération d'ID après connexion, cookie avec `httponly` et `samesite`
- **Upload** : validation côté serveur de l'extension (image) et du type MIME
  (via `finfo_file()`), nom de fichier aléatoire (`bin2hex(random_bytes(8))`)
- **Timing attack** : comparaison de mot de passe via `hash_equals()`,
  comparaison factice si l'email n'existe pas
- **Open redirect** : whitelist des URLs autorisées dans `redirect()`
- **IDOR** : vérification d'appartenance via la table `traitement` pour les médecins

## Limites connues

- Les photos de profil uploadées sont stockées dans `/public/uploads/profiles/`
  (accessibles via le routeur) — déploiement Apache/Nginx nécessite
  une règle de réécriture supplémentaire
- L'API REST ne vérifie pas l'appartenance des ressources par ID
  (un patient authentifié peut lire les données d'un autre patient via
  l'API si son ID est connu)
- Les notifications par email ne sont pas implémentées
- L'application utilise SHA-256 pour le hachage des mots de passe
  (non recommandé pour la production — bcrypt/argon2 serait préférable)
