<?php

    // Comme tous les produits vont avoir la même description, on peut se permettre de la mettre dans une variable pour s'en reservir plus tard.
    $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a leo diam. Quisque lorem orci, accumsan ';
    // Ceci est un tableau, contenant des tableaux.
    // Pour facilité le travail (et parce qu'on veut toujours afficher la même information), tous les entrées des sous-tableaux ont les mêmes clés

    $beanie0 = new Beanie();
    $beanie0->name = 'Bonnet en laine';
    $beanie0->price = 10;
    $beanie0->description = $description;
    $beanie0->image = 'laine.webp';
    $beanie0->id = 42;
    $beanie0->sizes = ['S','M'];
    $beanie0->materials =['Wool','Cashmere'];
   
    

    

    $beanie1 = new Beanie();
    $beanie1->name = 'Bonnet en laine bio';
    $beanie1->price = 14;
    $beanie1->description = $description;
    $beanie1->image = 'ours.jpg';
    $beanie1->id = 44;
    $beanie1->sizes = [
        'S', 'M', 'L', 'XL'
    ];
    $beanie1->materials =['Cotton','Silk'];


    $beanie2 = new Beanie();
    $beanie2->name = 'Bonnet en laine et cachemire';
    $beanie2->price = 20;
    $beanie2->description = $description;
    $beanie2->image = 'angora.jpg';
    $beanie2->id = 31;
    $beanie2->sizes = [
        'L', 'XL'
    ];
    $beanie2->materials = ['Wool','Cotton'];



    $beanie3 = new Beanie();
    $beanie3->name = 'Bonnet arc-en-ciel';
    $beanie3->price = 12;
    $beanie3->description = $description;
    $beanie3->image = 'casquette.jpg';
    $beanie3->id = 666;
     $beanie3->sizes = [
        'S', 'M', 'XL'
    ];
    $beanie3->materials = ['Silk'];



    $mesProduits = [
        0 => $beanie0,
        1 => $beanie1,
        2 => $beanie2,
        3 => $beanie3,
    ];
    $password = 'toto';
    // Noter que ce fichier ne termine pas par ? > Ce n'est pas nécessaire lorsque le fichier se termine par du php.
