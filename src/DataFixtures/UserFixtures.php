<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder) 
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ( $i = 0; $i <= 20; $i++) {

            $IsVerified = rand(0,1);

            $user = new User();
            $user->setEmail( $faker->email() );
            $user->setPassword( $this->encoder->hashPassword( $user, '123456789' ) );
            $user->setIsVerified( $IsVerified );
            $user->setRoles( array('ROLE_USER') );

            if ( $IsVerified == 1 ) {
                $user->setFirstName( $faker->firstName() );
                $user->setLastName( $faker->lastName() );
                $user->setMobile( $faker->e164PhoneNumber() );
                $user->setVendor( $IsVerified );

            }
        }

        $manager->flush();
    }
}
