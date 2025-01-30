# Tech Horizons

Tech Horizons est une plateforme numérique innovante dédiée à l’exploration des dernières avancées technologiques comme l'intelligence artificielle, Internet des objets, cybersécurité, blockchain et bien plus encore. Conçu comme un magazine en ligne interactif, il permet aux utilisateurs de découvrir, partager et approfondir leurs connaissances sur les tendances qui façonnent le futur.

---

## 🚀 Fonctionnalités

- **Authentification & Gestion des utilisateurs 👔**
   - Différents rôles : Invités, Abonnés, Responsables de thème, Éditeurs.
   - Système de permissions basé sur les rôles.
- **Gestion des articles 📝**
   - CRUD dynamique pour les articles (Création, Lecture, Mise à jour, Suppression).
- **Modération 🔐**
   - Modération des conversations et des articles par les responsables de thème et les éditeurs.
- **Historique de navigation 📃**
   - Filtrage avancé pour retrouver des articles consultés précédemment.
- **Statistiques avancées 📊**
   - Statistiques sur les abonnés, thèmes, articles ...
- **Interaction communautaire 💬**
   - Système de notation (1 à 5) pour les articles.
   - Chat lié aux articles pour discussions et échanges.
- **Expérience interactive optimisée pour mobile 📱**
   - Design responsive assurant une navigation fluide sur smartphones et tablettes

---

## 🏆 Expérience utilisateur personnalisée

L’application propose une navigation intuitive et adaptée à quatre profils d’utilisateurs :

- **👤 Invités** :
  - Consultation libre des informations sur les thèmes.
  - Accès aux numéros publics.
  - Possibilité de déposer une demande d’inscription au magazine.
- **📖 Abonnés** :
  - Espace personnalisé pour gérer les abonnements aux thèmes.
  - Historique de navigation avec filtres.
  - Proposition d'articles avec suivi de l'état.
  - Attribution de notes et participation aux discussions (Chat).
- **✍ Responsables de thème** :
  - Gestion des abonnements et des articles liés à leur thème.
  - Validation des propositions d'articles.
  - Modération des conversations liées aux articles de leur thème.
  - Consultation des statistiques sur les articles et les abonnés.
- **🛠 Éditeurs** :
  - Gestion complète des utilisateurs (ajout, modification, blocage, suppression).
  - Publication et gestion des numéros (activation/désactivation).
  - Supervision globale des statistiques.

---

## 🎨 Technologies utilisées

- 🛠 Framework PHP moderne  : Laravel
- 🛠 Base de données relationnelle  : MySQL
- 🛠 Styles et scripts personnalisés  : CSS et JavaScript

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

4️⃣ *Dans votre SGBD créez une base de données nommée :*

```
tech_horizons 
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

Nous tenons à remercier les membres de l'équipe et les encadrants pour leur soutien et leur contribution à ce projet. 

- **Encadrants**:
    - Prof. M’hamed AIT KBIR
    - Prof. Yasyn EL YUSUFI

- **Membres de l'équipe**:
    - Taki eddine EL ATTARI
    - Fatima Ezzahra CHAYEB
    - Rabab ZITI
