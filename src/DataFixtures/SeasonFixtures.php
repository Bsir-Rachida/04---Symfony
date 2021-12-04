<?php

namespace App\DataFixtures;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
    for($i=1; $i<=5; $i++){
    $season = new Season();
    $season->setProgram($this->getReference('program_'.$i));
    $season->setNumber($i);
    $season->setNumber(2000);
    $season->setDescription('Description');
    $manager->persist($season);
    $this->setReference('season_'. $i, $season);
    $manager->flush();
    }
    
    }
    
    public function getDependencies()
    {
    
    return [
    SeasonFixtures::class,
    ];
    }
    
}
