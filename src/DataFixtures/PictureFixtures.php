<?php

namespace App\DataFixtures;

use Faker;
use DateTimeImmutable;
use App\Entity\Product;
use App\Entity\Pictures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PictureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i <= 150; $i++) {

            $CreationDate = rand(1,365);
            $UpdatedAt  = new DateTimeImmutable;
            $UpdatedAt = $UpdatedAt->modify('-' . $CreationDate . ' day');
            
            $img = rand(1, 12) . '.png';

            $Pictures = new Pictures();
            $Pictures->setAlt($faker->sentence(3));
            $Pictures->setImageName($img);
            $Pictures->setImageSize($i);
            $Pictures->setProduct($this->getReference('product_' . rand(0, 50)));

            $manager->persist($Pictures);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}
