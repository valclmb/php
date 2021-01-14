<?php
    //on change le titre de notre page. La variable $pageTitle est appelée dans header.php.
    $pageTitle = 'Liste des bonnets';
    include 'includes/header.php';

     $products = $mesProduits;
    if (!empty($_GET['size'])) {
        $size = $_GET['size'];
        $products = array_filter(
            $products,
            function (Beanie $product) use ($size) {
                return $product->hasSize($size);
            }
        );
    }

    if (!empty($_GET['material'])) {
        $material = $_GET['material'];
        $products = array_filter(
            $products,
            function (Beanie $product) use ($material) {
                return $product->hasMaterial($material);
            }
        );
    }

    if (!empty($_GET['minPrice'])) {
        $minPrice = $_GET['minPrice'];
        $products = array_filter(
            $products,
            function (Beanie $product) use ($minPrice) {
                return $product->price >= $minPrice;
            }
        );
    }

    if (!empty($_GET['maxPrice'])) {
        $maxPrice = $_GET['maxPrice'];
        $products = array_filter(
            $products,
            function (Beanie $product) use ($maxPrice) {
                return $product->price <= $maxPrice;
            }
        );
    }







?>
<!-- La balise table défini le cadre du table, tr une ligne et th des cellules de titre (affiché en gras et avec du texte centré par défaut) -->


<form method="GET" class="text-center  py-2">

<select name="size" id="size-select" >
<option value="" >Taille</option>
    <?php
    foreach (Beanie::AVALAIBLE_SIZES as $option) {
        echo "<option value='$option'>$option</option>";
    }
    
    ?>
</select>


<select name="material" id="material-select">
<option value="">Matériaux</option>
    <?php
    
    foreach (Beanie::AVALAIBLE_MATERIALS as $option) {
        echo "<option value='$option'>$option</option>";
    }
    ?>
</select>
<input type="number" name="minPrice" placeholder="prix minimum">
<input type="number" name="maxPrice" placeholder="prix maximum" >

<button type="submit" class="btn btn-dark">Valider</button>



</form>

<table>
    <tr>
        <th>
            Nom du produit
        </th>
        <th>
            Prix HT
        </th>
        <th>
            Prix TTC
        </th>
        <th>
            Description
        </th>
    </tr>
    <!-- n'importe où dans notre html, on peut faire appel à php pour ajouter du texte, faire des calculs, etc. -->
    <?php
            // pour appeler les différentes lignes de notre tableau, on parcourt le tableau $mesProduits,
            // défini dans le fichier vars.php (disponible dans ce fichier grâce à l'import en début de fichier)
            foreach ($products as $produit) {
                // On appelle la fonction afficheProduit, en passant en paramètre le produit en cours
                afficheProduit($produit);
            }
        ?>
</table>

<?php include 'includes/footer.php';
