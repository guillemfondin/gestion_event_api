<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Sport;
use App\Entity\Event;
use App\Entity\User;

class AppFixtures extends Fixture
{

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setEmail('admin@jury.fr')
              ->setPassword($this->encoder->encodePassword($admin, 'jury@'))
              ->setRoles(['ROLE_ADMIN'])
        ;
        $manager->persist($admin);

        $user = new User();
        $user->setEmail('user@jury.fr')
             ->setPassword($this->encoder->encodePassword($user, 'jury@'))
             ->setRoles(['ROLE_USER'])
        ;
        $manager->persist($user);

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
