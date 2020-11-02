<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $encoder;

    private $em;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager)
    {
        $this->encoder = $encoder;
        $this->em = $entityManager;
    }

    public function load(ObjectManager $manager)
    {
        $usersData = [
            0 => [
                'name' => 'user',
                'email' => 'user@example.com',
                'role' => ['ROLE_USER'],
                'password' => '123456',
                'phone' => '465465465'
            ],
            1 => [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'role' => ['ROLE_ADMIN'],
                'password' => '123456',
                'phone' => '465465465'
            ]
        ];

        foreach ($usersData as $user) {
            $newUser = new User();
            $newUser->setEmail($user['email']);
            $newUser->setLogin($user['email']);
            $newUser->setName($user['name']);
            $newUser->setPhone($user['phone']);
            $newUser->setActive(true);
            $newUser->setPassword($this->encoder->encodePassword($newUser, $user['password']));
            $newUser->setRoles($user['role']);
            $this->em->persist($newUser);
        }

        $this->em->flush();
    }
}
