<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Order;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrdersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i <= 3; $i++) {
            $userId = $this->getReference('user_' . '0');

            $order = new Order();
            $order->setToken($faker->numberBetween(0, 3));
            $order->setStatus($faker->numberBetween(0, 3));
            $order->setSubTotal($faker->randomFloat(1, 20, 30));
            $order->setItemDiscount($faker->randomFloat(1, 20, 30));
            $order->setTax($faker->randomFloat(1, 20, 30));
            $order->setShipping($faker->randomFloat(1, 20, 30));
            $order->setTotal($faker->randomFloat(1, 20, 30));
            $order->setPromo($faker->randomFloat(1, 20, 30));
            $order->setDiscount($faker->randomFloat(1, 20, 30));
            $order->setGrandTotal($faker->randomFloat(1, 20, 30));
            $order->setFirstName($faker->firstName());
            $order->setMiddleName($faker->firstName());
            $order->setLastName($faker->lastName());
            $order->setMobile($faker->phoneNumber());
            $order->setEmail($faker->email());
            $order->setLine1($faker->address());
            $order->setLine2($faker->address());
            $order->setCity($faker->city());
            $order->setProvince($faker->state());
            $order->setCountry($faker->country());
            $order->setZip($faker->postcode());
            $order->setCreatedAt(new DateTimeImmutable());
            $order->setUpdatedAt(new DateTimeImmutable());
            $order->setContent($faker->sentence(1));
            $order->setUtilisateur($userId);

            $this->addReference('order_' . $i, $order);

            $manager->persist($order);
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