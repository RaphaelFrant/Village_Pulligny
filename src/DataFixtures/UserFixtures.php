<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\UserSecurity;

class UserFixtures extends Fixture
{

    private $encodeur;

    public function __construct(UserPasswordEncoderInterface $encodeur){
        $this->encodeur = $encodeur;
    }

    public function load(ObjectManager $manager)
    {
        $user = new UserSecurity();
        $user->setUsername('admin')
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword($this->encodeur->encodePassword($user, 'admin'));
        $manager->persist($user);
        $manager->flush();
    }
}
