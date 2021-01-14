<?php
    //on change le titre de notre page. La variable $pageTitle est appelée dans header.php. 
    $pageTitle = 'Liste des bonnets'; 
    include 'includes/header.php';
?>
    <!-- La balise table défini le cadre du table, tr une ligne et th des cellules de titre (affiché en gras et avec du texte centré par défaut) -->
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
            foreach($mesProduits as $produit) {
                // On appelle la fonction afficheProduit, en passant en paramètre le produit en cours
                afficheProduit($produit);
            }
        ?>
    </table>

<?php include 'includes/footer.php'; ?>
