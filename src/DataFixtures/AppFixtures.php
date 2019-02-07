<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Sport;
use App\Entity\Event;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $citys = ['Nantes', 'Paris', 'Tokyo', 'New York', 'Angoulème'];

        $sport = new Sport();
        $sport->setName('Judo');
        $manager->persist($sport);
        $sports[] = $sport;

        $sport = new Sport();
        $sport->setName('Foot');
        $manager->persist($sport);
        $sports[] = $sport;

        $sport = new Sport();
        $sport->setName('Rugby');
        $manager->persist($sport);
        $sports[] = $sport;

        $sport = new Sport();
        $sport->setName('Tennis');
        $manager->persist($sport);
        $sports[] = $sport;

        $sport = new Sport();
        $sport->setName('Basket');
        $manager->persist($sport);
        $sports[] = $sport;

        $sport = new Sport();
        $sport->setName('Hockey');
        $manager->persist($sport);
        $sports[] = $sport;

        for ($i = 1; $i <= 8; $i++) {
            $event = new Event();
            $event->setName($i.' - Lorem Ipsum '.$i)
                  ->setDate(new \DateTime())
                  ->setLocation($citys[mt_rand(0,4)])
                  ->setNbParticipants(mt_rand(3, 100))
                  ->setSport($sports[mt_rand(0,count($sports) - 1)])
            ;
            $manager->persist($event);
        }

        $manager->flush();
    }
}
