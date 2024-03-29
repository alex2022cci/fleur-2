<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Pictures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PictureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i <= 10000; $i++) {
            
            $img = rand(1, 37);
            if ($img < 12) {
                $img = $img . '.jpg';
            }  else {
                $img = 'so'. $img . '.jpg';
            }

            $Pictures = new Pictures();
            $Pictures->setAlt($faker->sentence(3));
            $Pictures->setImageName($img);
            $Pictures->setImageSize($i);
            $Pictures->setProduct($this->getReference('product_' . rand(0, 500)));

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
