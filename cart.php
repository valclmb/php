<?php
include 'includes/header.php';

// Par défaut, que ce soit pour ajouter ou supprimer, on ne va ajouter / enlever qu'un élément
$quantity = 1;

// On peut prévoir dans l'url de pouvoir en ajouter plus (ne serait-ce que pour tester par exemple).
if (isset($_GET['quantity'])) {
    $quantity = intval($_GET['quantity']); // intval() va convertir une chaine de caractère en un entier
}

//Par exemple, on peut appeler le lien : cart.php?add=666 pour ajouter le bonnet ayant pour id 666.
if (isset($_GET['add'])) {
    // On passe l'id de notre objet, puisque (pour le moment), c'est la seule information que l'on utilise
    // Pour gérer l'ajout et la suppression sur la même page, on va nommer nos paramètres différemment
    $cart->add($_GET['add'], $quantity);

    // On redirige vers la page du panier (sans paramètres), afin de nettoyer l'url et éviter des manipulations non désirées (le rechargement du panier qui ré-ajouterait des produits au panier par exemple)
    header('Location: cart.php');
}

//Par exemple, on peut appeler le lien : cart.php?remove=666 pour enlever un bonnet ayant pour id 666.
if (isset($_GET['remove'])) {
    // On passe l'id de notre objet, puisque (pour le moment), c'est la seule information que l'on utilise
    // Pour gérer l'ajout et la suppression sur la même page, on va nommer nos paramètres différemment
    $cart->remove($_GET['remove'], $quantity);

    // On redirige vers la page du panier (sans paramètres), afin de nettoyer l'url et éviter des manipulations non désirées (le rechargement du panier qui re-supprimerait des produits du panier par exemple)
    header('Location: cart.php');
}

//Par exemple, on peut appeler le lien : cart.php?empty pour vider le panier complètement.
if (isset($_GET['empty'])) {
    // On appelle simplement la méthode chargée de vider le panier
    $cart->empty();

    // On redirige vers la page du panier (sans paramètres), afin de nettoyer l'url et éviter des manipulations non désirées (le rechargement du panier qui re-viderait le panier par exemple)
    header('Location: cart.php');
}

$productsInCart = $cart->getContent();
?>

<table class="table table-striped">
    <tr>
        <th scope="col">Produit</th>
        <th scope="col">Prix unitaire</th>
        <th scope="col">Quantité</th>
        <th scope="col">Prix</th>
    </tr>
    <?php
        // On va noter le total du panier dans cette variable et le calculer au fur et à mesure qu'on avance dans l'affichage du tableau. On pourrait également faire une fonction qui se chargerait du calcul.
        $totalCart = 0.0;
        // Nous n'avons que des id et des quantités, on va donc chercher notre produit à chaque itération de la boucle.
        foreach ($productsInCart as $id => $quantity) {
            $product = findInProducts($mesProduits, $id);

            // Dans mon cas, j'ai un id vide en session, dû à une erreur de saisie.
            if (empty($id) || empty($product)) {
                continue; // J'en profite pour vous montrer que vous pouvez sauter une itération d'une boucle avec le mot-clé continue (qui dit littéralement de passer à l'itération suivante).
            }

            $totalCart += $product->price * $quantity;

            // On affiche ensuite les différentes entrées du panier?>
    <tr>
        <td>
            <?= $product->name; ?>
        </td>
        <td>
            <?= number_format($product->price, 2, ',', ' '); ?>€
        </td>
        <td>
            <a href="cart.php?remove=<?php echo $product->id; ?>">
                <i class="fa fa-minus"></i>
            </a>
            <?php echo $quantity; ?>
            <a href="cart.php?add=<?php echo $product->id; ?>">
                <i class="fa fa-plus"></i>
            </a>
        </td>
        <td>
            <?php echo number_format($product->price * $quantity, 2, ',', ' '); ?>€
        </td>
    </tr>
    <?php
        }

        // On affiche ensuite le montant total du panier
        $cart->setTotal($totalCart);
    ?>
    <tr>
        <td colspan="3" align="right">Total :</td>
        <td><?php echo number_format($cart->total, 2, ',', ' '); ?>€
        </td>
    </tr>
</table>

<!-- Ajout d'un bouton de vidage du panier -->
<a href="cart-empty.php">Vider le panier</a>

<?php include 'includes/footer.php';
