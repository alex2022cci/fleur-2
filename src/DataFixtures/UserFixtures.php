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

        // je vais utiliser la librairie Faker pour générer des données aléatoires
        $faker = Faker\Factory::create();

        // je vais créer un utilisateur de test en ROLE_ADMIN
        $user = new User();
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

        // je vais créer une référence pour pouvoir l'utiliser dans d'autres fixtures
        $this->addReference('user_' . '0', $user);

        $manager->persist($user);

        for ( $i = 0; $i <= 20; $i++) {

            // DatetimeImmutable est une classe qui permet de manipuler des dates
            $date = new DateTimeImmutable;
            // je reduit de $i jours la date actuelle
            $date = $date->modify('-' . $i . ' day');

            $user = new User();

            $IsVerified = rand(0,1);
            $user->setEmail( $faker->email() );
            $user->setPassword( $this->encoder->hashPassword( $user, '123456789' ) );
            $user->setIsVerified( $IsVerified );
            $user->setRoles( array('ROLE_USER') );
            $user->setFirstName( $faker->firstName() );
            $user->setMiddleName( $faker->firstName() );
            $user->setLastName( $faker->lastName() );
            $user->setRegistredAt( $date );

            // Sachan que le User dois avoir un profile valide je met une condition a 1
            if ($IsVerified == 1) {
                // un utilisateur peut avoir valider sont profile et ne pas remplir le profile
                // par defaut je decide que le profile remplis est a 1
                $profile = rand(0,1);
                if ($profile == 1) {
                    $user->setMobile( $faker->e164PhoneNumber() );
                    $user->setVendor( $IsVerified );
                    $user->setLastLogin(new \DateTimeImmutable);
                    $user->setIntro('1');
                    $user->setProfile('88');
                }

            }

            $manager->persist($user);
        }


        $manager->flush();
    }
}
