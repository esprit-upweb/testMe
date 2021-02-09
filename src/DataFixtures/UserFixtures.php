<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setEmail('foulen.benFoulen'.$i.'@esprit.tn');
            $password = $this->encoder->encodePassword($user, 'test');
            $user->setPassword($password);
            $user->setFisrtName('Foulen'.$i);
            $user->setLastName('Ben Foulen'.$i);
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
