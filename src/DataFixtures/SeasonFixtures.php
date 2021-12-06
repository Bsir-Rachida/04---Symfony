<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [
        [
            'program' => 'program_0',
            'description' => 'Une mère célibataire et ses deux enfants s\installent dans une petite ville et découvrent peu à peu leur relation avec les chasseurs de fantômes et l\héritage légué par leur grand-père.',
            'year' => 2020,
            'number' => 1,
        ],

        [
            'program' => 'program_1',
            'description' => 'Une mère célibataire et ses deux enfants s\installent dans une petite ville et découvrent peu à peu leur relation avec les chasseurs de fantômes et l\héritage légué par leur grand-père.',
            'year' => 2010,
            'number' => 1,
        ],
        [
            'program' => 'program_2',
            'description' => 'Une mère célibataire et ses deux enfants s\installent dans une petite ville et découvrent peu à peu leur relation avec les chasseurs de fantômes et l\héritage légué par leur grand-père.',
            'year' => 2009,
            'number' => 1,
        ],
        [
            'program' => 'program_3',
            'description' => 'Une mère célibataire et ses deux enfants s\installent dans une petite ville et découvrent peu à peu leur relation avec les chasseurs de fantômes et l\héritage légué par leur grand-père.',
            'year' => 2020,
            'number' => 1,
        ],
        [
            'program' => 'program_0',
            'description' => 'Une mère célibataire et ses deux enfants s\installent dans une petite ville et découvrent peu à peu leur relation avec les chasseurs de fantômes et l\héritage légué par leur grand-père.',
            'year' => 2020,
            'number' => 1,
        ]
        ];

   

        public function load(ObjectManager $manager): void
        {
            foreach (self::SEASONS as $key => $seasonName) {
                $season = new Season();
    
                $season->setprogram($this->getReference($seasonName['program']));
                $season->setDescription($seasonName['description']);
                $season->setYear($seasonName['year']);
                $season->setNumber($seasonName['number']);
                $manager->persist($season);
                $this->addReference('season_' . $key, $season);
            }
    
            $manager->flush();
        }
    
        public function getDependencies()
    
        {
    
            return [
    
                ProgramFixtures::class
    
            ];
        }
    
}
