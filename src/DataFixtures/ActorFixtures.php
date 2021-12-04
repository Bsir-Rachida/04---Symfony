<?php

namespace App\DataFixtures;
use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
      const ACTORS =[
            'Andrew Lincoln',
            'Norman Reedus',
            'Lauren Cohan',
            'Danai Gurira',
        ];
    
        public function load(ObjectManager $manager)
    
        {
    
          
        foreach(self::ACTORS as $key => $actorName) {  
    
            $actor = new Actor();  
    
            $actor->setName($actorName);  
    
            $manager->persist($actor);  
            $this->setReference('actor_' . $key, $actor);
    
        }  
    
        $manager->flush();
    
        }
    
}
