<?php
// On utilise la fonction mise à disposition par PHP pour enregistrer automatiquement nos classes
// Sans cette fonction, il faudrait ajouter require_once 'classes/nomDeLaClasse.php' pour chacune de nos classes.
// Voir la documentation : https://www.php.net/manual/fr/function.spl-autoload-register
spl_autoload_register(function ($class) {
    require_once "classes/$class.php";
});
