<?php

// src/Controller/ProgramController.php

namespace App\Controller;

USE App\Entity\Category;
USE App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category", name="category_")
 */
class CategoryController extends AbstractController

{

      /**
     * Show all rows from Category’s entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();


        return $this->render('/category/index.html.twig',['categories' => $categories]);
    }

    /**

 * Getting a category by name

 *

 * @Route("/{categoryName}", name="show")

 * @return Response

 */

public function show(string $categoryName):Response

{

    $category = $this->getDoctrine()->getRepository(Category::class)->findBy(['name' => $categoryName]);


    if (!$category) {

        throw $this->createNotFoundException(

            'No category with name : '.$categoryName

        );

    }
    $programs = $this->getDoctrine()->getRepository(Program::class)->findBy(['category' => $category],['id' => 'DESC'],$limit=3);

    if (!$programs) {

        throw $this->createNotFoundException(
            
            'No program with name : ' . $categoryName 
        );
    }

    return $this->render('/category/show.html.twig', [

        'categoryName' => $categoryName,
        'programs' => $programs

    ]);
}
}
