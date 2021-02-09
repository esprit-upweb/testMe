<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->setTitle('Post'.$i);
            $post->setDescription("lorem");
            $manager->persist($post);
        }
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
