<?php

namespace App\DataFixtures;

use App\Entity\Sortie;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Types\TextType;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
         $userAdmin = new User();
         $userAdmin->setNom('admin');
         $userAdmin->setPrenom('admin');
         $userAdmin->setEmail('admin@admin.com');
         $userAdmin->setRoles(['ROLE_ADMIN']);
         $password = $this->userPasswordHasher->hashPassword($userAdmin, '123456azerty');
         $userAdmin->setPassword($password);
         $manager->persist($userAdmin);

         for ($i = 0; $i < 10; $i++) {
             $user = new User();
             $user->setNom('nom'.$i);
             $user->setPrenom('prenom'.$i);
             $user->setEmail('email'.$i.'@campus-eni.fr');
             $user->setRoles(['ROLE_USER']);
             $password=$this->userPasswordHasher->hashPassword($user, '123456azerty');
             $user->setPassword($password);
             $manager->persist($user);
         }

         $sortie = new Sortie();
         $sortie->setNom('nom');
         $sortie->setDateHeureDebut(dateHeureDebut: new \DateTimeImmutable("now"));
         $sortie->setDuree(10);
         $sortie->setDateLimiteInscription(dateLimiteInscription: new \DateTimeImmutable("now"));
         $sortie->setNbInscriptionsMax(10);
         $sortie->setInfosSortie('Infos Sortie');

        for ($i = 0; $i < 7; $i++) {
            $sortie = new Sortie();
            $sortie->setNom('nom'.$i);
            $sortie->setDateHeureDebut(dateHeureDebut: new \DateTimeImmutable("now"));
            $sortie->setDuree(10);
            $sortie->setDateLimiteInscription(dateLimiteInscription: new \DateTimeImmutable("now"));
            $sortie->setNbInscriptionsMax(10);
            $sortie->setInfosSortie('Infos Sortie');
            $manager->persist($sortie);
        }

        $manager->flush();
    }
}


//('now', new \DateTimeZone('Europe/Paris'))
//('d-m-Y H:i:s', '01-01-2024 00:00:00')