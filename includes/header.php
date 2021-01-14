<?php
    session_start();
    require_once 'autoload.php';

    // Si aucun titre de page n'est défini avant l'include de ce fichier, on met un titre par défaut (voir l'utilisation de cette variable un peu plus bas, dans la balise <title>)
    if (!isset($pageTitle)) {
        $pageTitle = 'Les beaux bonnets !';
    }

    // On peut inclure les fichiers php que l'on souhaite où l'on veut,
    // s'ils n'affichent rien directement (sinon, il faut les inclure là où l'on souhaite afficher leur contenu ;) )
    // L'important est que leur contenu soit inclu avant qu'on en ait besoin dans ce fichier (par exemple, on doit avoir inclu la variable $mesProduits avant de nous en servir dans cette page)
    // Par habitude, on importe d'abord les variables (qui pourraient être utilisées par les fonctions), puis les fonctions.
    require_once('vars.php');
    require_once('functions.php');

    /**
     * Section pour gérer la connexion
     */

    $login = null;
    // On garde en mémoire si une erreur se trouve dans le formulaire
    $loginError = false;
    // On va mettre les différents messages dans un tableau (il peut y en avoir un pour le login, un pour le mot de passe)
    $loginMessages = [];

    // Si un champ "login" a été posté dans un formulaire et n'est pas vide, alors on peut vérifier le mot de passe
    if (!empty($_POST['login'])) {
        // Si un champ "password" a été posté dans un formulaire, mais est vide ou ne correspond pas à celui attendu
        if (isset($_POST['password'])) {
            // S'il est vide, ou ne correspond pas à celui attendu, on affichera une erreur
            if (empty($_POST['password'])
                || (
                    !empty($_POST['password'])
                    && $_POST['password'] != $password
                )
            ) {
                $loginError = true; // On sait qu'il y a eu une erreur lors d'une tentative de connexion
                $loginMessages[] = 'Mot de passe incorrect'; // On ajoute un message
            }
        }
    } elseif (isset($_POST['login'])) { // Si un champ "login" a été posté dans un formulaire, mais est vide
        $loginMessages[] = 'Veuillez saisir un identifiant'; // On ajoute un message
        $loginError = true; // On sait qu'il y a eu une erreur lors d'une tentative de connexion
    }

    // On a vérifié que le login existe, que le mot de passe est bon, maintenant il faut mettre à jour la session
    if (isset($_POST['login']) && isset($_POST['password']) && !$loginError) {
        $_SESSION['login'] = $_POST['login'];
        // Ici nous pourrions rediriger l'utilisateur fraîchement connecté en ajoutant :
        // header('Location: index.php');
        // Mais notre gestion des messages ne servirait plus ;) (on ne les afficherait jamais à cause de la redirection)
        $loginMessages[] = 'Vous êtes maintenant connecté.e';
        $loginError = false;
    }

    // Si la session est définie et qu'on a un login, on met ce dernier dans une variable qu'on pourra utiliser dans le menu et dans la page de connexion (login.php)
    if (!empty($_SESSION['login'])) {
        $login = $_SESSION['login'];
    }

    $cart = new Cart();
?>
<html lang="fr">

<head>
    <!-- On ajoute le style de Boostrap ici -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Ici, le style dédié au formulaire de connexion. Notez le chemin : même si on est dans un fichier inclu (qui est dans le dossier includes), ce qui compte, c'est le chemin depuis le script qui l'appelle (c'est aussi pour ça que l'on met toutes nos pages à la racine de notre projet) -->
    <link rel="stylesheet" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>
        <?php
                // Ici, on appelle le titre de notre page, défini soit au début de ce fichier, soit avant l'appel du include
                echo $pageTitle;
            ?>
    </title>
</head>

<body>
    <!-- Menu (navbar) tiré tout droit de la doc de Bootstrap. On l'adapte simplement à notre besoin. -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Les beaux bonnets</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <!-- Notez le chemin : même si on est dans un fichier inclu (qui est dans le dossier includes), ce qui compte, c'est le chemin depuis le script qui l'appelle (c'est aussi pour ça que l'on met toutes nos pages à la racine de notre projet) -->
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <!-- Notez le chemin : même si on est dans un fichier inclu (qui est dans le dossier includes), ce qui compte, c'est le chemin depuis le script qui l'appelle (c'est aussi pour ça que l'on met toutes nos pages à la racine de notre projet) -->
                    <a class="nav-link" href="list.php">Liste</a>
                </li>
                <?php if (empty($login)) {//Si l'utilisateur n'est pas connecté, on lui indique la page de connexion
                ?>
                <li class="nav-item">
                    <!-- Notez le chemin : même si on est dans un fichier inclu (qui est dans le dossier includes), ce qui compte, c'est le chemin depuis le script qui l'appelle (c'est aussi pour ça que l'on met toutes nos pages à la racine de notre projet) -->
                    <a class="nav-link" href="login.php">Connexion</a>
                </li>
                <?php
            } else { // Sinon, celle pour se déconnecter
                ?>
                <li class="nav-item">
                    <!-- Notez le chemin : même si on est dans un fichier inclu (qui est dans le dossier includes), ce qui compte, c'est le chemin depuis le script qui l'appelle (c'est aussi pour ça que l'on met toutes nos pages à la racine de notre projet) -->
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                </li>
                <?php
            }
            ?>
            </ul>
            <?php if (!empty($login)) {
                ?>
            <span class="my-2">
                <?php echo $login; ?>
            </span>
            <?php
            }
            ?>
        </div>
    </nav>
