<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Product;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ( $i = 0; $i <= 150; $i++)
        {
            $userId = $this->getReference('user_' . '0' );

            $randomType = rand(0,3);
            $randomPrice = rand(100,1000);
            $randomDiscount = rand(0,100);
            $randomQuantity = rand(0,100);

            $product = new Product();
            $product->setTitle( $faker->sentence(3) );
            $product->setMetaTitle( $faker->sentence(3) );
            $product->setSlug( $faker->slug() );
            $product->setSummary( $faker->sentence(10) );
            $product->setType( $randomType );
            $product->setSku( $faker->ean13() );
            $product->setPrice( $randomPrice );
            $product->setQuantity( $randomQuantity );
            $product->setShop( '1' );
            $product->setCreatedAt( new DateTimeImmutable );
            $product->setUpdatedAt( new DateTimeImmutable );


            if ( $randomType == 1) {
                $product->setDiscount( $randomDiscount );
                $product->setPublishedAt( new DateTimeImmutable );
                $product->setStartsAt( new DateTimeImmutable );
                $product->setEndAt( new DateTimeImmutable );
            }

            $product->setUserId( $userId );

            $manager->persist($product);
        }

        $manager->flush();
    }
}