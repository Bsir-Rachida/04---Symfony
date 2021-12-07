<?php


namespace App\DataFixtures;


use App\Entity\Category;

use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Persistence\ObjectManager;


class CategoryFixtures extends Fixture

{
    const CATEGORIES =[
        
       
        'Action',
        'Aventure',
        'Animation',
        'Fantastique',
         'Horreur',
    ];

    public function load(ObjectManager $manager)

    {

      
    foreach(self::CATEGORIES as $key => $catagoryName) {  

        $category = new Category();  

        $category->setName($catagoryName); 


        $manager->persist($category); 
       
        
         
        $this->setReference('category_' . $key, $category);

    }  

    $manager->flush();

    }

}