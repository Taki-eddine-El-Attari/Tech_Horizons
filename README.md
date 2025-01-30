# Tech Horizons

Tech Horizons est une plateforme numérique innovante dédiée à l’exploration des dernières avancées technologiques comme l'intelligence artificielle, Internet des objets, cybersécurité, blockchain et bien plus encore. Conçu comme un magazine en ligne interactif, il permet aux utilisateurs de découvrir, partager et approfondir leurs connaissances sur les tendances qui façonnent le futur.

---

## 🚀 Fonctionnalités

- **Authentification & Gestion des utilisateurs**
- **CRUD dynamique pour les articles**
- **Panneau d'administration intuitif**
- **Gestion des rôles et permissions 🔐**
- **Statistiques avancées 📊**
- **Interaction communautaire et système de notation💬**
- **Autres fonctionnalités à découvrir ...**

---

## 🏆 Une expérience personnalisée et collaborative

L’application propose une navigation intuitive et adaptée à quatre profils d’utilisateurs :

- 👤 Invités : Consultation libre des descriptions des thèmes et découverte des tendances technologiques.
- 📖 Abonnés : Accès à un espace personnalisé, abonnement aux thématiques favorites et participation aux discussions.
- ✍ Responsables de thème : Gestion des publications, validation des propositions des articles pour son thème.
- 🛠 Éditeurs : Gestion des utilisateurs, modération des conversations et administration de la plateforme.

---

## 🎨 Technologies utilisées

- 🛠 Laravel / Framework PHP moderne
- 🛠 MySQL / Base de données relationnelle
- 🛠 CSS et Javascript / les styles et les scripts

---

## 📌 Prérequis

**Avant de commencer, assurez-vous d'avoir les éléments suivants installés :**

- ✔ PHP ≥ 8.0
- ✔ Composer
- ✔ Node.js & npm
- ✔ MySQL ou un autre SGBD compatible
- ✔ Laravel (installé globalement ou via Composer)

---

## 🔧 Installation

1️⃣ *Cloner le dépôt*

```
git clone https://github.com/Taki-eddine-El-Attari/Tech_Horizons.git
cd Tech_Horizons
```

2️⃣ *Installer les dépendances*

```
npm install
```

3️⃣ *Configurer l’environnement*

```
cp .env.example .env
php artisan key:generate
```
✍ Modifier .env avec vos paramètres de base de données.

4️⃣ *Dans votre SGBD créer une base de données avec le nom du projet*

```
tech_horizons  #ce nom exactement
```

5️⃣ *Exécuter les migrations & seeders*

```
php artisan migrate --seed
```

6️⃣ *Compiler les assets*

```
npm run dev
```

🚀 *Lancer le serveur*

```
php artisan serve
```

Votre application est maintenant accessible sur http://localhost:8000 ! 🎉

---

## 🌟 Remerciements

- **Membres de l'équipe**:
    - Taki eddine El attari
    - Fatima Ezzahra Chayeb
    - Rabab Ziti
- **Encadrants**:
    - Prof. M’hamed AIT KBIR
    - Prof. Yasyn EL YUSUFI
