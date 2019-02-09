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
        $sports = ['Judo', 'Foot', 'Rugby', 'Basket', 'Hockey', 'Karaté'];

        foreach ($sports as $value) {
            $sport = new Sport();
            $sport->setName($value);
            $manager->persist($sport);
            $sportsEntity[] = $sport;
        }

        for ($i = 1; $i <= 8; $i++) {
            $event = new Event();
            $event->setName($i.' - Lorem Ipsum '.$i)
                  ->setDate(new \DateTime())
                  ->setLocation($citys[mt_rand(0,4)])
                  ->setNbParticipants(mt_rand(3, 100))
                  ->setSport($sportsEntity[mt_rand(0, count($sportsEntity) - 1)])
            ;
            $manager->persist($event);
        }

        $manager->flush();
    }
}
