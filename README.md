# ESP News Platform

Ce repository GitHub regroupe tout le projet **ESP News**, décliné en plusieurs applications, chacune gérée dans une branche dédiée.

##  Branches du projet

| Branche              | Description |
|----------------------|-------------|
| `main`               |  Site Web ESP News en **PHP MVC** (gestion des actualités, interface publique, admin & editor) |
| `web_services`       |  **Web services SOAP & REST** pour exposer les données du site (articles, utilisateurs, catégories) |
| `app_client_console` |  **Application console Python** qui consomme les web services (authentification, listing, gestion) |
| `app_client_desktop` |  **Application Desktop PyQt5** pour gérer les actualités et utilisateurs via GUI en Python |


##  Détails des projets

###  `main` — ESP News MVC
- Implémenté en **PHP** avec un pattern **MVC** (Model - View - Controller)
- Gestion :
  - des articles (CRUD)
  - des catégories
  - des rôles (`admin`, `editor`, `visitor`)
- Authentification sécurisée
- Base de données MySQL (ex : `mglsi_news`)
- Design responsive inspiré des sites d’actualités (France24, etc.)

➡ Accès principal : `http://localhost/esp_news_mvc`

---

###  `web_services` — SOAP & REST
- Fournit des **Web Services** pour exposer les données du site :
  - SOAP (ex : `authenticate`, `listUsers`, `addUser`, etc.)
  - REST (ex : `GET /articles`, `GET /categories`)
- Utilisé par les clients Python pour récupérer ou manipuler les données.

➡ Accès : `http://localhost/esp_news_webservices`

---

###  `app_client_console` — Client Console Python
- Petite application en **Python** qui consomme les web services via `requests`.
- Fonctionnalités :
  - Authentification
  - Listing des utilisateurs, articles, catégories
  - Gestion CRUD pour admin via SOAP
- Exécution :
```bash
python client.py

---

### `app_client_desktop` — Application Desktop PyQt

Interface Graphique (GUI) réalisée avec **PyQt5**.

Permet de :
- Se connecter (login)
- Voir un dashboard admin
- Gérer utilisateurs et articles
- Consomme les mêmes web services SOAP & REST.

---

#### Exécution
```bash
python app.py

