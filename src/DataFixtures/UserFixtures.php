<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\UserSecurity;

/**
 * Classe permettant de créer des utilisateurs dans la base de données
 */
class UserFixtures extends Fixture
{

    //VARIABLE
    private $encodeur;

    /**
     * Méthode de construction pour avoir un mot de passe encodé
     */
    public function __construct(UserPasswordEncoderInterface $encodeur){
        $this->encodeur = $encodeur;
    }

    /**
     * Méthode de création d'objet User dans la base de données
     * @param ObjectManager $manager
     */
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
