<p align="center"><a href="https://test.alexandrebourlier.fr" target="_blank"><img src="https://zupimages.net/up/23/24/h2eb.png" width="400" alt="bcj Logo"></a></p>

## Environnement

* **Framework** : Laravel Framework 10.48.22
* **Base de données** : phpMyAdmin 5.2.0
* **Encodage** : UTF-8 Unicode (utf8mb4)
* **Version PHP** : 8.1.0

## Plugins front-end

* **@tailwindcss/forms**: ^0.5.9
* **alpinejs**: ^3.14.3
* **autoprefixer**: ^10.4.20
* **axios**: ^1.6.4
* **laravel-vite-plugin**: ^1.0.0
* **postcss**: ^8.4.47
* **tailwindcss**: ^3.4.14
* **vite**: ^5.0.0

## Installation

### Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- PHP >= 8.1
- Composer
- Node.js >= 16.x (et npm ou yarn)

### Étapes

1. Clonez le dépôt :
   ```bash
   git clone https://github.com/username/votre-projet.git
   cd votre-projet
   ```

* Installez les dépendances backend :

  `composer install`
* Installez les dépendances front-end :

    `npm install`

* Configurer votre environnement :
  * Dupliquez le fichier .env.example et renommez-le en .env
  * Modifier les variables d'environnement dans le fichier .env (ex. DB_DATABASE, DB_USERNAME, DB_PASSWORD)
* Lancez les migrations pour mettre à jour la base de données :

    `<php artisan migrate>`

* Générer les clés de chiffrement Laravel :

    `<php artisan key:generate>`

* Lancez le serveur de développement backend :

    `<php artisan serve>`

* Lancez le serveur de dévoloppement front-end :

    `<npm run dev>`

## License

Réaliser par Alexandre Bourlier (2023/2024)
