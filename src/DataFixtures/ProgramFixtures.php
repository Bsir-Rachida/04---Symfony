<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($j=1; $j<=5; $j++){
        $program = new Program();
        $program->setTitle('Walking dead'.$j);
        $program->setPoster('Poster');
        $program->setYear('2022');
        $program->setSummary('Des zombies envahissent la terre');
        $program->setCategory($this->getReference('category_0'));
       
        for ($i = 0; $i < count(ActorFixtures::ACTORS); $i++) {
            $program->addActor($this->getReference('actor_' . $i));
        }
        $manager->persist($program);
        $this->setReference('program_' . $j, $program);
        $manager->flush();
    }
}

    public function getDependencies()
    {

        return [
            ActorFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
