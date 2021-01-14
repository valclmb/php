<?php
    // Ceci est une constante, une fois définie, elle ne peut être changée
    // Noter que, contrairement aux variables, elle n'a pas de $ en début du nom, elle est intégralement en majuscule et les différents mots sont séparés par un _.
    const PRODUCT_NAME = 'name';

    // Comme tous les produits vont avoir la même description, on peut se permettre de la mettre dans une variable pour s'en reservir plus tard.
    $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a leo diam. Quisque lorem orci, accumsan quis dolor sed, gravida.';

    // Ceci est un tableau, contenant des tableaux.
    // Pour facilité le travail (et parce qu'on veut toujours afficher la même information), tous les entrées des sous-tableaux ont les mêmes clés
    $mesProduits = [
        0 => [
            PRODUCT_NAME  => 'Bonnet en laine', // Ici, on utilise notre constante comme clé pour le nom du produit (ça n'est pas obligatoire du tout, c'est surtout là pour vous montrer que c'est possible ;) )
            'price'       => 10, // On évite d'indiquer la monnaie utilisée (€), afin de permettre de faire des calculs sur la valeur
            'description' => $description, // On appelle directement notre variable, plutôt que de copier-coller un texte
            'image'       => 'laine.webp', // Ici, je ne mets que le nom de l'image, pas son chemin. Si ce chemin venait à changer, je n'aurais ainsi pas à le modifier dans mes données, mais seulement là où elles sont appelées.
            'id'          => 42,
        ],
        1 => [
            PRODUCT_NAME  => 'Bonnet en laine bio',
            'price'       => 14,
            'description' => $description,
            'image'       => 'ours.jpg',
            'id'          => 44,
        ],
        2 => [
            PRODUCT_NAME  => 'Bonnet en laine et cachemire',
            'price'       => 20,
            'description' => $description,
            'image'       => 'angora.jpg',
            'id'          => 31,
        ],
        3 => [
            PRODUCT_NAME  => 'Bonnet arc-en-ciel',
            'price'       => 12,
            'description' => $description,
            'image'       => 'casquette.jpg',
            'id'          => 666,
        ],
    ];
    $password = 'toto';
    // Noter que ce fichier ne termine pas par ? > Ce n'est pas nécessaire lorsque le fichier se termine par du php.
