<?php

namespace App\Controller;

use App\Routing\Attribute\Route;
use App\Repository\CategorieRepository;
use App\Repository\EvenementRepository;
use App\Repository\UserRepository;

class BdeController extends AbstractController
{
    /** Methode qui permet d'afficher les infos du BDE */
    #[Route(path: '/infos_bde',  httpMethod: ['GET'], name: 'infos_bde')]
    public function infos_bde(
        UserRepository $reposUser,
        EvenementRepository $repoEvent,
        CategorieRepository $repoCat,
        UserRepository $repoUsers
    ) {
        if (!empty($_SESSION)) {
            $this->params['session'] = $_SESSION;
        }
        $users = $reposUser->findBy(1);
        $evenements = $repoEvent->findByCat();
        $categories = $repoCat->findAll();
        $users      = $reposUser->findAll();
        $this->params['users'] = $users;
        $this->params['evenements'] = $evenements;
        $this->params['categories'] = $categories;
        $this->params['title'] = 'BDE';
        $this->views = [['index/infos_bde.html.twig', 0]];
        $this->viewPage();
    }

    /** Methode qui permet de supprimer un evenement */

    #[Route(path: '/delete_event/{id}',  httpMethod: ['POST'], name: 'delete_event')]
    public function delete_event($id, EvenementRepository $repoEvent)
    {
        if ($repoEvent->deleteById($id)) {
            echo ("Supprimé avec succes");
        };
    }
}
