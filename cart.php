<?php
include 'includes/header.php';

$productsInCart = getCartContent();
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

            // Dans mon cas, j'ai un id vide en session, dû à une erreur de saisie. J'en profite pour vous montrer que vous pouvez sauter une itération d'une boucle avec le mot-clé continue (qui dit littéralement de passer à l'itération suivante).
            if (empty($id) || empty($product)) {
                continue;
            }

            $totalCart += $product['price'] * $quantity;

            // On affiche ensuite les différentes entrées du panier?>
    <tr>
        <td>
            <?= $product['name']; ?>
        </td>
        <td>
            <?= number_format($product['price'], 2, ',', ' '); ?>€
        </td>
        <td>
            <a
                href="cart-remove.php?id=<?php echo $product['id']; ?>">
                <i class="fa fa-minus"></i>
            </a>
            <?php echo $quantity; ?>
            <a
                href="cart-add.php?id=<?php echo $product['id']; ?>">
                <i class="fa fa-plus"></i>
            </a>
        </td>
        <td>
            <?php echo number_format($product['price'] * $quantity, 2, ',', ' '); ?>€
        </td>
    </tr>
    <?php
        }

        // On affiche ensuite le montant total du panier
    ?>
    <tr>
        <td colspan="3" align="right">Total :</td>
        <td><?php echo number_format($totalCart, 2, ',', ' '); ?>€
        </td>
    </tr>
</table>

<!-- Ajout d'un bouton de vidage du panier -->
<a href="cart-empty.php">Vider le panier</a>

<?php include 'includes/footer.php';
