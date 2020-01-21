<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $adminUser = new User;

        $adminUser->setFirstName('Bruce')
                ->setLastName('Wayne')
                ->setEmail('brucewayne@gotham.com')
                ->setPicture('http://placehold.it/300x00')
                ->setPassword($this->passwordEncoder->encodePassword($adminUser, 'password'))
                ->setRoles(['ROLE_ADMIN']);

        $manager->persist($adminUser);

        $manager->flush();
    }
}
