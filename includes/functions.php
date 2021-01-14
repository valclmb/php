<?php
declare(strict_types=1);

/**
 * Pour calculer un prix HT à partir du prix TTC, le calcul est :
 * $prix / (1 + (20/100)) si la TVA est de 20%. On peut le simplifier en $prix / 1.2
 *
 * Les deux commentaires ci-dessous sont standards. Ils indiquent les types des paramètres attendus par la fonction et son type de retour. Ils ne sont pas obligatoires, mais peuvent aider à la relecture du code
 *
 * @var float $prix
 *
 * @return float
 */
function prixHT($prix)
{
    $prixHt = $prix / 1.2;

    return number_format($prixHt, 2, ',', ' '); // number_format() permet de formatter le nombre pour qu'il ait toujours 2 chiffres après la virgule (et force que ce soit une virgule ;) ). Dans ce cas, on ajoute aussi un espace pour séparer les milliers
}
// prixHT(12.5);

/**
 * Ici, on fait un affichage purement en PHP.
 * On affiche une ligne du tableau HTML, à partir d'une ligne du tableau PHP principal.
 *
 * @var Beanie $produit
 * @var string|int $key
 *
 * @return void Ce void indique qu'il s'agit d'une procédure, et non d'une fonction. void indique qu'elle ne retourne rien, même pas null !
 */
function afficheProduit(Beanie $produit)
{
    // Si le prix est inférieur ou égale à douze, la couleur (du prix) va être verte, bleue sinon
    if ($produit->price <= 12) {
        $color = "green";
    } else {
        $color = "blue";
    }
    // Ici, le but est d'écrire une grande chaîne de caractère en php avec echo.
    // On peut également écrire plusieurs chaînes plus courtes, les unes après les autres, pour éviter de concaténer à tout va.
    echo '
    <tr>
        <td>
            '.$produit->name.
        '</td>
        <td>
            '.prixHT($produit->price).'€
        </td>
        <td style="color:'.$color.'">
            '.$produit->price.'€
        </td>
        <td>
            '.$produit->description.'
        </td>
        <td>
            <a href="cart.php?add='.$produit->id.'">Ajouter au panier</a>
        </td>
    </tr>';
}

/**
 * Comme précédemment, nous affichons un produit, mais cette fois en utilisant
 * les cards de Bootstrap
 * @param Beanie $produit
 *
 * @return void
 */
function cardProduit(Beanie $produit): void
{
    echo '<div class="card col-md-4 col-sm-12">
        <img src="images/'.$produit->image.'" class="card-img-top" style="max-width: 10rem;" alt="'.$produit->name.'">
        <div class="card-body">
            <h2 class="card-title">'.$produit->name.'</h2>
            <p class="card-text">'.$produit->description.'</p>
        </div>
    </div>';
}

/**
 * Cette fonction cherche le produit avec l'id $id dans notre liste de produits.
 * Notez que 2 méthodes (au moins) sont possibles et notez l'écriture de la fonction array_filter, vous en verrez d'autres avec de fonctionnements similaires.
 *
 * @var array $products
 * @var int|string $id
 *
 * @return array
 */
function findInProducts(array $products, ?string $id): ?Beanie
{
    foreach ($products as $product) {
        if ($product->id == $id) {
            return $product;
        }
    }

    return null;

    // Doc de la fonction : https://www.php.net/manual/fr/function.array-filter.php
    // Notez l'utilisation d'une fonction anonyme (ou fonction de callback) pour filtrer les éléments du tableau. Cette méthode et celle au dessus (utilisant foreach) sont strictement identiques.
    // Pour utiliser le paramètre $id dans la fonction anonyme, il faut utiliser le mot clé use (sans cela, $id n'est pas défini dans la fonction : tout ce qui existe dans une fonction sont ses paramètres ou ce qui a été explicitement défini comme disponible)
    // $results = array_filter($products, function (Beanie $element) use ($id) {
    //     return $element->id == $id;
    // });

    // // Pour récupérer la première entrée du tableau, quel que soit son index, on utilise la fonction current
    // // Doc de la fonction : https://www.php.net/manual/fr/function.current.php
    // return current($results); // $results[0]
}
