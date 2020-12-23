<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
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

        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->setTitle('Post'.$i);
            $post->setDescription("lorem");
            $manager->persist($post);
        }
        $manager->flush();
    }
}
