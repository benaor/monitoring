<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Website;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Fixtures Admin
        $admin = new Admin();
        $admin->setEmail('admin@admin.com')
            ->setPassword('azerty');
        $encoded = $this->encoder->encodePassword($admin, $admin->getPassword());
        $admin->setPassword($encoded);
        $manager->persist($admin);

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
