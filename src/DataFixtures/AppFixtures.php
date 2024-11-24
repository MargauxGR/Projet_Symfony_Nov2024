<?php

namespace App\DataFixtures;

use App\Entity\Outing;
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
         $userAdmin->setLastname('admin');
         $userAdmin->setFirstname('admin');
         $userAdmin->setEmail('admin@admin.com');
         $userAdmin->setRoles(['ROLE_ADMIN']);
         $password = $this->userPasswordHasher->hashPassword($userAdmin, '123456azerty');
         $userAdmin->setPassword($password);
         $manager->persist($userAdmin);

         for ($i = 0; $i < 10; $i++) {
             $user = new User();
             $user->setLastname('lastname'.$i);
             $user->setFirstname('firstname'.$i);
             $user->setEmail('email'.$i.'@campus-eni.fr');
             $user->setRoles(['ROLE_USER']);
             $password=$this->userPasswordHasher->hashPassword($user, '123456azerty');
             $user->setPassword($password);
             $manager->persist($user);
         }

         $outing = new Outing();
         $outing->setName('name');
         $outing->setStartDateTime(startDateTime: new \DateTimeImmutable("now"));
         $outing->setDuration(10);
         $outing->setRegistrationDeadline(registrationDeadline: new \DateTimeImmutable("now"));
         $outing->setMaxNbRegistration(10);
         $outing->setOutingDetails('Outing Details');

        for ($i = 0; $i < 7; $i++) {
            $outing = new Outing();
            $outing->setName('name'.$i);
            $outing->setStartDateTime(startDateTime: new \DateTimeImmutable("now"));
            $outing->setDuration(10);
            $outing->setRegistrationDeadline(registrationDeadline: new \DateTimeImmutable("now"));
            $outing->setMaxNbRegistration(10);
            $outing->setOutingDetails('Outing Details');
            $manager->persist($outing);
        }

        $manager->flush();
    }
}