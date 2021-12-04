<?php

namespace App\DataFixtures;
use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($j=1; $j<=5; $j++){
            $episode = new Episode();
            $episode->setSeason($this->getReference('season_'.$j));
            $episode->setTitle('title'.$j);
            $episode->setNumber(2000);
            $episode->setSynopsis('Summary');
            
            }
            $manager->persist($episode);
            $manager->flush();
            }
            
            public function getDependencies()
            {
            
            return [
            SeasonFixtures::class,
            ];
            
    }
}



