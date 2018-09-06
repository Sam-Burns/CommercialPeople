<?php
namespace App\DataFixtures;

use App\Entity\League;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $teams = [];

        $teams[0] = new Team();
        $teams[0]->setName('Manchester United');
        $teams[0]->setStrip('Red football strip');

        $teams[1] = new Team();
        $teams[1]->setName('Sheffield Wednesday');
        $teams[1]->setStrip('I really dont know');

        $manager->persist($teams[0]);
        $manager->persist($teams[1]);

        $league = new League();
        $league->setName('Premier League');

        $manager->persist($league);

        $manager->flush();
    }
}
