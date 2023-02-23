<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use DateTimeImmutable;
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
            $user = new User();
            if ( $i == 0) {
                $user->setEmail( 'guillaume@gmail.com' );
                $user->setPassword( $this->encoder->hashPassword( $user, '123456789' ) );
                $user->setIsVerified( '1' );
                $user->setRoles( array('ROLE_ADMIN') );
                $user->setFirstName( 'Guillaume' );
                $user->setMiddleName( 'Auxioma' );
                $user->setLastName( 'DEVAUX' );
                $user->setMobile( '0766068003' );
                $user->setVendor( '1' );
                $user->setRegistredAt(new \DateTimeImmutable);
                $user->setLastLogin(new \DateTimeImmutable);
                $user->setIntro('1');
                $user->setProfile('Je suis le créateur de ce site');
            }
            $IsVerified = rand(0,1);
            $user->setEmail( $faker->email() );
            $user->setPassword( $this->encoder->hashPassword( $user, '123456789' ) );
            $user->setIsVerified( $IsVerified );
            $user->setRoles( array('ROLE_USER') );

            $user->setFirstName( $faker->firstName() );
            $user->setMiddleName( $faker->firstName() );
            $user->setLastName( $faker->lastName() );
            $user->setMobile( $faker->e164PhoneNumber() );
            $user->setVendor( $IsVerified );
            $user->setRegistredAt(new \DateTimeImmutable);
            $user->setLastLogin(new \DateTimeImmutable);
            $user->setIntro('1');
            $user->setProfile('88');


            // je vais enregister de maniere aléatoire des utilisateurs.
            $this->addReference('user_' . $i, $user);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
