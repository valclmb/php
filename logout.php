<?php
// Pour pouvoir détruire la session, il faut la créer (un peu contre-intuitif, mais on s'habitue ;) )
session_start();
// On détruit la session, ce qui rend la variable $_SESSION inutilisable
session_destroy();

//  Ici, contrairement à l'énoncé, je redirige vers la page d'accueil (comme ça, vous avez un exemple de redirection)
header('Location: index.php');
?>