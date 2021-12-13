<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use App\Service\Slugify;
use App\Entity\Actor;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Form\ProgramType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * @Route("/program", name="program_")
 */
class ProgramController extends AbstractController
{
    /**
     * Show all rows from Program’s entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {

        $programs = $this->getDoctrine()->getRepository(Program::class)->findAll();


        return $this->render('/program/index.html.twig', ['programs' => $programs]);
    }



    /**
    
     * The controller for the Program add form
    
     *
    
     * @Route("/new", name="new")
    
     */


    public function new(Request $request, Slugify $slugify, MailerInterface $mailer): Response

    {
        $program = new Program();

        $form = $this->createForm(ProgramType::class, $program);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $slug = $slugify->generate($program->getTitle());

            $program->setSlug($slug);

            $entityManager->persist($program);

            $entityManager->flush();

            $email = (new Email())

                ->from($this->getParameter('mailer_from'))

                ->to('your_email@example.com')

                ->subject('Une nouvelle série vient d\'être publiée !')

                ->html($this->renderView('program/newProgramEmail.html.twig', ['program' => $program]));


            $mailer->send($email);
            return $this->redirectToRoute('program_index');
        }

        return $this->render('program/new.html.twig', [

            "form" => $form->createView(),

        ]);
    }


    /**
     * @Route("/{slug}", name="show", methods={"GET"})
     * @return Response
     */

    public function show(Program $program): Response

    {


        return $this->render('program/show.html.twig', [

            'program' => $program,

        ]);
    }


    /**
     * Getting a program by seasonid
     *
     * @Route("/{programId}/seasons/{seasonId} ", name="season_show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"programId": "id"}})
     * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"seasonId": "id"}})
     * @return Response
     */
    public function showSeason(Program $program, Season $season): Response
    {

        return $this->render('program/season_show.html.twig', [

            'program' => $program,
            'season' => $season,
        ]);
    }

    /**
     * Getting a program by seasonid
     *
     * @Route("/{programId}/seasons/{seasonId}/episode/{episodeId} ", name="episode_show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"programId": "slug"}})
     * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"seasonId": "id"}})
     * @ParamConverter("episode", class="App\Entity\Episode", options={"mapping": {"episodeId": "slug"}})
     * @return Response
     */
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {

        return $this->render('program/episode_show.html.twig', [

            'program' => $program,
            'season' => $season,
            'episode' => $episode,
        ]);
    }
}
