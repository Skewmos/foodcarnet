<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        
        $user = new User();
        $user->setEmail("admin@gmail.com");
        $user->setRoles(["ROLE_ADMIN"]);
         $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'test'
         ));
        $user2 = new User();
        $user2->setEmail("jeremie@gmail.com");
        $user2->setRoles(["ROLE_MODO"]);
         $user2->setPassword($this->passwordEncoder->encodePassword(
            $user2,
            'test'
         ));
        $manager->persist($user);
        $manager->persist($user2);

        $manager->flush();
    }
}
