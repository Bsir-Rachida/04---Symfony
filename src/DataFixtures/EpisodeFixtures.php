<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    const EPISODES = [
        [
            'title' => 'Episode 1',
            'synopsis' => 'Emily Elizabeth, une jeune collégienne, reçoit en cadeau de la part d’un magicien un adorable petit chien rouge. Quelle n’est pas sa surprise quand elle se réveille le lendemain dans son petit appartement de New York face au même chien devenu … géant ! ',
            'season' => 'season_0',
            'number' => 1
        ],
        [
            'title' => 'Episode 2',
            'synopsis' => 'Emily Elizabeth, une jeune collégienne, reçoit en cadeau de la part d’un magicien un adorable petit chien rouge. Quelle n’est pas sa surprise quand elle se réveille le lendemain dans son petit appartement de New York face au même chien devenu … géant ! ',
            'season' => 'season_0',
            'number' => 2
        ],
        [
            'title' => 'Episode 3',
            'synopsis' => 'Emily Elizabeth, une jeune collégienne, reçoit en cadeau de la part d’un magicien un adorable petit chien rouge. Quelle n’est pas sa surprise quand elle se réveille le lendemain dans son petit appartement de New York face au même chien devenu … géant ! ',

            'season' => 'season_1',
            'number' => 1
        ],
        [
            'title' => 'Episode 4',
            'synopsis' => 'Emily Elizabeth, une jeune collégienne, reçoit en cadeau de la part d’un magicien un adorable petit chien rouge. Quelle n’est pas sa surprise quand elle se réveille le lendemain dans son petit appartement de New York face au même chien devenu … géant ! ',
            'season' => 'season_1',
            'number' => 2
        ],

        [
            'title' => 'Episode 5',
            'synopsis' => 'Emily Elizabeth, une jeune collégienne, reçoit en cadeau de la part d’un magicien un adorable petit chien rouge. Quelle n’est pas sa surprise quand elle se réveille le lendemain dans son petit appartement de New York face au même chien devenu … géant !',
            'season' => 'season_3',
            'number' => 1
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $key => $show) {
            $episode = new Episode();

            $episode->setTitle($show['title']);
            $episode->setSynopsis($show['synopsis']);
            $episode->setNumber($show['number']);
            $episode->setSeason($this->getReference($show['season']));
            $manager->persist($episode);
        }

        $manager->flush();
    }

    public function getDependencies()

    {


        return [

            SeasonFixtures::class
        ];
    }
}
