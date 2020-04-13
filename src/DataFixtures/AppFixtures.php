<?php

namespace App\DataFixtures;

use App\Entity\Website;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // fixtures youtube
        $website = new Website();
        $website->setName('Youtube')
            ->setUrl('http://www.youtube.com/');
        $manager->persist($website);

        // fixtures google
        $website = new Website();
        $website->setName('Google')
            ->setUrl('http://www.google.com/');
        $manager->persist($website);

        // fixtures facebook
        $website = new Website();
        $website->setName('facebook')
            ->setUrl('http://www.facebook.com/');
        $manager->persist($website);

        // fixtures github
        $website = new Website();
        $website->setName('Github')
            ->setUrl('http://github.com/');
        $manager->persist($website);

        // fixtures github not found
        $website = new Website();
        $website->setName('GithubTest')
            ->setUrl('http://github.com/duhsrmdnb');
        $manager->persist($website);

        // fixtures fake URL
        $website = new Website();
        $website->setName('Fake')
            ->setUrl('http://fakewebsitetilhj.com');
        $manager->persist($website);

        // flush fixtures
        $manager->flush();
    }
}
