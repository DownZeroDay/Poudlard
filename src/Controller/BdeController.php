<?php
/* A modifier avec access control */
namespace App\Controller;

use App\Entity\Catevenement;
use App\Routing\Attribute\Route;
use App\Entity\Evenement;
use App\Repository\CategorieRepository;
use App\Repository\EvenementRepository;
use App\Repository\UserRepository;

class BdeController extends AbstractController
{
    /** Methode qui permet d'afficher les infos du BDE */
    #[Route(path: '/infos_bde',  httpMethod: ['GET'], name: 'infos_bde')]
    public function infos_bde(UserRepository $reposUser, EvenementRepository $repoEvent, 
        CategorieRepository $repoCat, UserRepository $repoUsers){

        $users = $reposUser->findBy(1);
        $evenements = $repoEvent->findByCat();
        $categories = $repoCat->findAll();
        $users      = $reposUser->findAll();

        echo $this->twig->render('index/infos_bde.html.twig', [
            'users' => $users, 
            'evenements' => $evenements, 
            'categories' => $categories
        ]);
    }

    /** Methode qui permet de supprimer un evenement */
    
    #[Route(path: '/delete_event/{id}',  httpMethod: ['POST'], name: 'delete_event')]
    public function delete_event($id, EvenementRepository $repoEvent){

        // $evenement = new Evenement($id);
        // $evenement = $evenement->get();
        var_dump($repoEvent->deleteById($id));
        // if(isset($_POST['linkdelete']) == "POST"){
        //     var_dump($repoEvent->deleteById($id));
        // }
        if($repoEvent->deleteById($id)){
            echo("Supprimer avec succes");
        };
    }
}
