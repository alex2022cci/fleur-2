<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Product;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i <= 500; $i++) {
            $userId = $this->getReference('user_' . '0');
            $category = $this->getReference('category_' . rand(1, 5));

            // Je dchoisie des chiffre au hasard pour les date de création de produit
            $CreationDate = rand(1,365);
            $CreatedAt  = new DateTimeImmutable;
            $CreatedAt = $CreatedAt->modify('-' . $CreationDate . ' day');

            // pour des raison d'affichage de veux un produit qui a un discount avec un discount entre deus date
            $DiscountDateStart = rand(1,5);
            $DiscountAtStart  = new DateTimeImmutable;
            $DiscountAtStart = $DiscountAtStart->modify('+' . $DiscountDateStart . ' day');

            $DiscountDateEnd = rand(6,10);
            $DiscountAtEnd  = new DateTimeImmutable;
            $DiscountAtEnd = $DiscountAtEnd->modify('+' . $DiscountDateEnd . ' day');

            $product = new Product();
            $product->setTitle($faker->sentence(3));
            $product->setMetaTitle($faker->sentence(3));
            $product->setSlug($faker->slug());
            $product->setSummary($faker->sentence(10));
            $product->setType($faker->numberBetween(0, 3));
            $product->setSku($faker->ean13());
            $product->setPrice($faker->randomFloat(2, 20, 30));
            $product->setQuantity($faker->numberBetween(100, 1000));
            $product->setShop('1');
            $product->setCreatedAt($CreatedAt);
            $product->setUpdatedAt($CreatedAt);
            $product->setPublishedAt(new DateTimeImmutable);
            $product->setContent($faker->paragraph(rand(20,50), false));

            if (rand(0, 3) == 1) {
                $product->setDiscount($faker->numberBetween(10, 50));
                $product->setStartsAt($DiscountAtStart);
                $product->setEndAt($DiscountAtEnd);
            }

            $product->setUserId($userId);
            $product->setCategory($category);

            $this->addReference('product_' . $i, $product);
            
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}

