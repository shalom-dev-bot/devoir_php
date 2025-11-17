#  INDEX.HTML

    ##  <?php

        Rôle : Indique au serveur web que tout ce qui suit est du code PHP (et non du HTML).
        Obligatoire au début de chaque fichier PHP exécuté.

    ## session_start();

        Fonction : Crée ou reprend la session de l’utilisateur courant.
        Crée la superglobale $_SESSION (tableau qui persiste entre toutes les pages).
        Sans cette ligne → impossible de faire "rester connecté".


    // Protection contre l'attaque de fixation de session (Session Fixation Attack)
// Un attaquant pourrait forcer un utilisateur à utiliser un session_id qu’il connaît déjà.
// En régénérant l’ID dès la première visite, on casse cette attaque.
if (!isset($_SESSION['init'])) {
    session_regenerate_id(true);  // true = supprime immédiatement l’ancien ID sur le serveur
    $_SESSION['init'] = true;     // Marque la session comme "initialisée" pour ne le faire qu’une fois
}

session_regenerate_id(true) → génère un nouvel ID de session et détruit l’ancien immédiatement.
C’est une pratique de sécurité obligatoire en 2025.


-__DIR__ → constante magique = chemin absolu du dossier courant (/var/www/html/projet-php/public)
../autoload.php → on remonte d’un dossier pour charger l’autoloader à la racine.
require_once → charge le fichier une seule fois même s’il est appelé 10 fois.

_SERVER['REQUEST_URI'] → contient l’URL complète après le domaine
Exemple : /books/create?id=5&search=php
parse_url(..., PHP_URL_PATH) → ne garde que /books/create
On ne veut pas les paramètres GET ici, on les lira plus tard avec $_GET si besoin.


Chaque ligne = une route.
Le => require charge directement le fichier contrôleur correspondant.
default = page 404 si l’URL ne correspond à rien.
http_response_code(404) → envoie le vrai code HTTP 404 au navigateur (important pour Google, les API, la sécurité).

### public/index.php → Point d’entrée unique (Front Controller)

- Un seul fichier accessible publiquement → sécurité maximale
- Démarrage sécurisé de session + régénération d’ID (anti session fixation)
- Chargement automatique des classes via autoload.php
- Fonctions utilitaires globales disponibles partout
- Nettoyage de l’URL et routing centralisé avec `match` (PHP 8+)
- Toutes les requêtes passent par ce fichier grâce au .htaccess
- Architecture identique à Laravel/Symfony mais 100 % comprise et écrite à la main


# AUTOLOADER.PHP

    spl_autoload_register() → fonction native de PHP qui dit :
    "Quand PHP rencontre une classe inconnue (ex: new UserController()), exécute cette fonction anonyme"
    $class → contient le nom complet avec namespace, ex: App\Controllers\UserController

    $prefix = 'App\\';
        Tous nos fichiers utilisent le namespace App\...
        C’est la convention PSR-4 (standard officiel PHP)

    $len = strlen($prefix);
if (strncmp($prefix, $class, $len) !== 0) {
    return;
}           
    Vérifie que la classe commence bien par App\
    Si une classe externe (ex: DateTime) est utilisée → on ne touche pas, on laisse PHP gérer

    ### autoload.php → Autoloader PSR-4 maison (sans Composer)

- Permet d'utiliser `new App\Controllers\Truc()` partout sans require manuel
- Respecte la norme officielle PSR-4 (même système que Laravel/Symfony/Composer)
- Convertit automatiquement les namespaces en chemins de fichiers
- Sécurisé : ne charge que les classes du projet (préfixe App\)
- Indispensable pour un projet propre et scalable
- Fonctionne même sans Composer → parfait pour apprendre en profondeur


# Mini Bibliothèque PHP From Scratch (100 % sécurisée & expliquée)

Projet PHP vanilla (sans framework) construit pour **vraiment comprendre** le développement web moderne.

## Fonctionnalités
- Inscription / Connexion / Déconnexion sécurisée
- Ajout et suppression de livres (seulement les siens)
- Protection complète : XSS, CSRF, injections SQL, session fixation
- Architecture MVC claire + autoloading PSR-4 maison

## Sécurité implémentée (niveau pro)
- PDO + prepared statements réels (`emulate_prepares = false`)
- Hashage BCRYPT des mots de passe
- Tokens CSRF uniques par session
- Échappement HTML systématique (`e()`)
- Régénération d'ID de session
- Fichier config hors `/public`
- Vérification de propriété (ownership)

## Structure du projet