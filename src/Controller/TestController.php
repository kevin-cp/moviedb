<?php

namespace App\Controller;

use App\Entity\Movie;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Contrôleur en mode "sandbox"
 */
class TestController extends AbstractController
{
    /** Test de création d'entité */
    #[Route('/test/create', name: 'test_create')]
    public function create(ManagerRegistry $doctrine): Response
    {
       // On créé une entité en PHP
       $movie = new Movie();

       // On renseigne l'entité
       $movie->setTitle("Blade Runner");
       // Date courante pour created at
       $movie->setCreatedAt(new DateTime());

       // 1. On demande au Manager de se préparer à "persister" l'entité
       $entityManager = $doctrine->getManager();
       $entityManager->persist($movie);

       // 2. 2xécute les requêtes SQL nécessaires (ici, INSERT INTO)
       $entityManager->flush();

       dump($movie);

       return new Response('Film ajouté :'.$movie->getId(). '</body>');
       // PS : le </body> pour afficher la toolbar
    }

    /**
     * @Route("/test/browse", name="test_browse")
     */
    public function browse(ManagerRegistry $doctrine)            
    {
        // Pour accéder aux données de la table movie
        // on passe par le Reposirory de l'entité Movie
        // PS : Movie::class => 'App\Entity\Movie'
        $movieRepository = $doctrine->getRepository(Movie::class);

        // On utilise les méthodes d'accès fournies par ce Repository
        $movies = $movieRepository->findAll();

        dump($movies);

        return new Response('liste des films </body>');
    }

     /**
     * @Route("/test/read/{id<\d+>}", name="read")
     */
    public function read(ManagerRegistry $doctrine, $id)            
    {
        // Pour accéder aux données de la table movie
        // on passe par le Reposirory de l'entité Movie
        // PS : Movie::class => 'App\Entity\Movie'
        $movieRepository = $doctrine->getRepository(Movie::class);

        // On utilise les méthodes d'accès fournies par ce Repository
        $movie = $movieRepository->find($id);

        dd($movie);

        return new Response('film n'.$id.'</body>');
    }

    /**
     * Edit movie
     * 
     * @Route("/test/edit/{id<\d+>}")
     */
    public function edit($id, ManagerRegistry $doctrine)       
    {
        // On va chercher le film, on le modifie, on le sauvegarde
        $movieRepository = $doctrine->getRepository(Movie::class);
        $movie = $movieRepository->find($id);

        // Mise à jour
        $movie->setUpdatedAt(new DateTime());

        // Sauvegarde 
        // 1. On récupère le Manager de doctrine
       $entityManager = $doctrine->getManager();

       // 2. 2xécute les requêtes SQL nécessaires (ici, UPDATE)
       $entityManager->flush();

       return $this->redirectToRoute('read', ['id' => $id]);
    }
}
