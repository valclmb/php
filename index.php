<?php
    // Sur chacune des pages, on inclue le header et le footer, et on met le code spécifique à la page entre les deux.
    include 'includes/header.php';
?>
<div class="row">
<?php
    // Nous avons ici 4 méthodes possibles (il y en a sûrement d'autres)
    // pour récupérer les 3 premiers éléments de notre tableau.

    // Cette méthode (tout comme la suivante), se base sur le fait que les index
    // de notre tableau $mesProduits sont générés automatiquement et seront forcément
    // de 0 à 4 (ou plus si l'on ajoute de nouvelles entrées

    // On récupère ici l'index de chaque entrée du tableau et on vérifie
    // que le troisième n'est pas atteint
    // foreach($mesProduits as $key => $produit) {
    //     if ($key <= 2) {
    //         // var_dump($produit);
    //     } else {
    //         break; // j'ajoute ce break pour indiquer à foreach de s'arrêter si la clé est > 2
    //         // Nous n'avons alors plus besoin de continuer à parcourir le tableau et lui demandons de s'arrêter
    //     }
    // }

    // Ici, on parcourt simplement le tableau et ses index 0, 1 et 2
    // for ($i = 0; $i <= 2; $i++) {
    //     // var_dump($mesProduits[$i]);
    // }

    // On demande à PHP de nous renvoyer un tableau contenant seulement les 3 premiers éléments du tableau
    // Voir : https://www.php.net/manual/fr/function.array-slice.php
    // $produits = array_slice($mesProduits, 0, 3);
    // foreach($produits as $produit) {
    //     // ...
    // }

    // Une méthode plus complexe, mais pouvant servir pour faire une pagination :
    // On utilise la méthode array_chunk() pour créer un tableau contenant des groupes de 3 éléments
    // Voir : https://www.php.net/manual/fr/function.array-chunk.php
    // $produits = array_chunk($mesProduits, 3);
    // $produits = $produits[0];
    // foreach($produits as $produit) {
    //     // ...
    // }

    // array_slice() est la méthode prenant le moins de lignes et la plus sûre (pas besoin de se soucier des index)
    $produits = array_slice($mesProduits, 0, 3);
    foreach ($produits as $key => $produit) {
        cardProduit($produit);
    }
?>
</div>

<?php include 'includes/footer.php'; ?>