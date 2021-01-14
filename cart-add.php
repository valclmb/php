<?php
    include 'includes/header.php';

    //Par exemple, on peut appeler le lien : cart-add.php?id=666 pour ajouter le bonnet ayant pour id 666.
    if (isset($_GET['id'])) {
        $product = findInProducts($mesProduits, $_GET['id']);
        // Ici, je choisis de passer un produit tout entier, mais j'aurais aussi bien pu me contenter de passer l'id, vu que c'est le seul attribut que j'utilise.
        addToCart($product);
    }

    header('Location: cart.php');
