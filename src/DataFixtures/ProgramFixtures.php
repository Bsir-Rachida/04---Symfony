<?php

namespace App\DataFixtures;
use App\Service\Slugify;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\ActorFixtures;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        [
            'title' => 'Héritage',
            'summary' => 'Une mère célibataire et ses deux enfants s\installent dans une petite ville et découvrent peu à peu leur relation avec les chasseurs de fantômes et l\héritage légué par leur grand-père.',
            'category' => 'category_1',
            'poster' => 'image.jpg',
            'actors' => ['actor_1', 'actor_2', 'actor_3', 'actor_4']
        ],

        [
            'title' => 'Clifford',
            'summary' => 'Emily Elizabeth, une jeune collégienne, reçoit en cadeau de la part d’un magicien un adorable petit chien rouge. Quelle n’est pas sa surprise quand elle se réveille le lendemain dans son petit appartement de New York face au même chien devenu … géant ! ',
            'category' => 'category_2',
            'poster' => 'image.jpg',
            'actors' => ['actor_1', 'actor_2']
        ],

        [
            'title' => 'Madres paralelas',
            'summary' => 'Deux femmes, Janis et Ana, se rencontrent dans une chambre d\hôpital sur le point d’accoucher. Elles sont toutes les deux célibataires et sont tombées enceintes par accident.',
            'category' => 'category_3',
            'poster' => 'image.jpg',
            'actors' => ['actor_3', 'actor_4']
        ],

        [
            'title' => 'Les Choses humaines',
            'summary' => 'Un jeune homme est accusé d’avoir violé une jeune femme. Qui est ce jeune homme et qui est cette jeune femme ? Est-il coupable ou est-il innocent ? Est-elle victime ou uniquement dans un désir de vengeance, comme l’affirme l’accusé ?',
            'category' => 'category_4',
            'poster' => 'image.jpg',
            'actors' => ['actor_1', 'actor_2', 'actor_3', 'actor_4']
        ],

        [
            'title' => 'Le Calendrier',
            'summary' => 'Eva est paraplégique depuis trois ans. Pour son anniversaire, elle reçoit en cadeau un étrange calendrier de l’Avent. Elle découvre chaque jour des surprises inquiétantes, parfois agréables, souvent terrifiantes, et de plus en plus sanglantes.',
            'category' => 'category_1',
            'poster' => 'image.jpg',
            'actors' => ['actor_1', 'actor_2', 'actor_3']
        ],
        
    ];
    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }


    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $key => $programName) {
            $program = new Program();
            $program->setTitle($programName['title']);
            $program->setSummary($programName['summary']);
            $program->setPoster($programName['poster']);
            $program->setCategory($this->getReference($programName['category']));

            for ($i = 0; $i < count($programName['actors']); $i++) {

                $program->addActor($this->getReference($programName['actors'][$i]));
            }
            $slug = $this->slugify->generate($program->getTitle());
            $program->setSlug($slug);
            $manager->persist($program);
            $this->addReference('program_' . $key, $program); 
        }

        $manager->flush();
    }

    public function getDependencies()

    {
        return [

            ActorFixtures::class,

            CategoryFixtures::class,

        ];
    }
}
