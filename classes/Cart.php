<?php
declare(strict_types=1);

class Cart
{
    /**
     * @var array
     */
    protected $content = [];

    /**
     * @var float
     */
    public $total = 0.0;

    /**
     * Quand on fait $cart = new Cart();
     * on s'assure de récupérer l'information depuis la session (sans ça, notre panier est vide)
     */
    public function __construct()
    {
        $this->content = $_SESSION['cart'];
    }

    /**
     * Ajoute $quantity exemplaires d'un produit au panier, identifié par son id $id
     *
     * @param int $id
     * @param int $quantity
     */
    public function add(int $id, int $quantity = 1): int
    {
        if (!isset($this->content[$id])) {
            // On n'a aucun exemplaire de ce produit dans le tableau, on crée une nouvelle entrée et on ajoute $quantity produits
            $this->content[$id] = $quantity;
        } else {
            // On a déjà ce produit, on en ajoute juste la quantité demandée
            $this->content[$id] += $quantity; // équivalent à $this->content[$id] = $this->content[$id] + $quantity;
        }

        // Si on n'a aucun exemplaire de ce produit dans le panier, s'assure que l'entrée existe dans le tableau.
        // On ajoute ensuite la quantité demandée quoiqu'il arrive.
        // if (!isset($this->content[$id])) {
        //     // On met à 0 ici pour ajouter ensuite la quantité $quantity
        //     $this->content[$id] = 0;
        // }
        // $this->content[$id] += $quantity;

        $this->saveCart();

        return $this->content[$id];
    }

    /**
     * Enlève $quantity exemplaires d'un produit au panier, identifié par son id $id
     *
     * @param int $id
     * @param int $quantity
     */
    public function remove(int $id, int $quantity = 1): int
    {
        if (!isset($this->content[$id])) {
            return 0; // Return arrête la fonction / méthode. Le reste du code n'est alors pas exécuté.
        }
        $this->content[$id] -= $quantity;// équivalent à $this->content[$id] = $this->content[$id] - $quantity;

        // Si on a maintenant 0 (ou moins) produits dans notre panier, on va supprimer l'entrée de notre tableau
        // On fait ça pour optimiser notre tableau, surtout pour l'affichage du panier (on n'a pas à filtrer les entrées en fonction de leur quantité)
        if ($this->content[$id] <= 0) {
            unset($this->content[$id]);
        }

        $this->saveCart();

        if (isset($this->content[$id])) {
            return $this->content[$id];
        }

        return 0;

        // Ici, je peux utiliser un opérateur ternaire pour faire la même chose qu'au dessus
        // C'est bien plus court à écrire, mais plus difficile à relire
        // La documentation sur le ternaire : https://www.php.net/manual/fr/language.operators.comparison.php#language.operators.comparison.ternary
        // return isset($this->content[$id]) ? $this->content[$id] : 0;
    }

    /**
     * Vide le panier et le sauvegarde
     *
     * @return void
     */
    public function empty(): void
    {
        $this->content = [];

        $this->saveCart();
    }

    /**
     * Renvoie le contenu du panier
     *
     * @return array
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * Met à jour le montant total du panier et le sauvegarde en session
     *
     * @return void
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;

        $_SESSION['totalcart'] = $total;
    }

    /**
     * Enregistre le contenu du panier dans la session
     *
     * @return void
     */
    protected function saveCart(): void
    {
        $_SESSION['cart'] = $this->content;
    }

    // Ici, on a tenté de récupérer le montant total du panier.
    // Cette méthode fonctionne, mais est affreusement compliqué (boucles imbriquées),
    // et on ne va donc pas garder ce code.
    // public function computeTotal(array $beanies)
    // {
    //     foreach ($this->getContent() as $id => $quantity) {
    //         $beanie = null;

    //         foreach ($products as $product) {
    //             if ($product->id == $id) {
    //                 $beanie = $product;
    //                 break;
    //             }
    //         }
    //         if (!empty($beanie)) {
    //             $this->total += $beanie->price;
    //         }
    //     }

    //     return $this->total;
    // }
}
