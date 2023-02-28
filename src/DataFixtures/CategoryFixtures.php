<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = [
            1 => [
                'nom' => 'Bouquets',
                'slug' => 'bouquets',
                'description' => 'Livraison de bouquet de fleurs en 4h à Paris et en 24h en France',  
                'hn' => 'Bouquets de fleurs',
                'titre' => 'Livraison de fleurs en 4H',
            ],
            2 => [
                'nom' => 'Roses',
                'slug' => 'Roses',
                'description' => 'Livraison de Roses en 4h à Paris et en 24h en France',  
                'hn' => 'Bouquets de Roses',
                'titre' => 'Livraison de Roses en 4H',
            ],
            3 => [
                'nom' => 'Plantes',
                'slug' => 'Plantes',
                'description' => 'Livraison de Plantes en 4h à Paris et en 24h en France',  
                'hn' => 'Plantes',
                'titre' => 'Livraison de Plantes en 4H',
            ],
            4 => [
                'nom' => 'Chocolats',
                'slug' => 'Chocolats',
                'description' => 'Livraison de Chocolats en 4h à Paris et en 24h en France',  
                'hn' => 'Chocolats',
                'titre' => 'Livraison de Chocolats en 4H',
            ],
            5 => [
                'nom' => 'Bonnes Affaires',
                'slug' => 'Bonnes-affaires',
                'description' => 'Bonnes Affaires de fleurs en 4h à Paris et en 24h en France',  
                'hn' => 'Bonnes Affaires de fleurs',
                'titre' => 'Bonnes Affaires de fleurs en 4H',
            ],
        ];

        foreach ($category as $key => $value) {
            $cat = new Category();
            $cat->setName($value['nom']);
            $cat->setSlug($value['slug']);
            $cat->setMetaDescription($value['description']);
            $cat->setHn($value['hn']);
            $cat->setTitle($value['titre']);
            $manager->persist($cat);
        }
        $manager->flush();
    }
}
