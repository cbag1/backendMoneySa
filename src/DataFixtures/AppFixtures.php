<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $password;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->password = $encoder;
    }

    public const PROFIL_ADMIN_SYSTEME = "ADMIN";
    public const PROFIL_ADMIN_AGENCE = "ADMIN_AGENCE";
    public const PROFIL_CAISSIER = "CAISSIER";
    public const PROFIL_CLIENT = "CLIENT";

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        // Fixtures Pour PROFIL
        $profiladmin = new Profil();
        $profiladmin->setLibelle(self::PROFIL_ADMIN_SYSTEME);

        $profilagence = new Profil();
        $profilagence->setLibelle(self::PROFIL_ADMIN_AGENCE);

        $profilcaissier = new Profil();
        $profilcaissier->setLibelle(self::PROFIL_CAISSIER);

        $profilclient = new Profil();
        $profilclient->setLibelle(self::PROFIL_CLIENT);


        $manager->persist($profiladmin);
        $manager->persist($profilagence);
        $manager->persist($profilcaissier);
        $manager->persist($profilclient);

        //  Fixtures pour les USERS
        $faker = Factory::create('fr_FR');

        $profil = [$profiladmin, $profilagence, $profilcaissier, $profilclient];
        foreach ($profil as $key => $value) {
            $user = new User();
            $user->setPrenom($faker->firstName);
            $user->setNom($faker->lastName);
            $user->setUsername("cbag_".strtolower($value->getLibelle()));
            $user->setEmail($faker->email);
            $user->setProfil($value);
            $user->setTelephone($faker->phoneNumber);
            $pass  = $this->password->encodePassword($user, "cbag");
            $user->setPassword($pass);

            $manager->persist($user);
        }




        $manager->flush();
    }
}
