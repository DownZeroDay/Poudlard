<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use App\Routing\Attribute\Route;
Use App\Session\Session;
use PDO;

class IndexController extends AbstractController
{
    #[Route(path: "/index", name: "index")]
    public function home(EvenementRepository $evenement)
    {    
        $resultats =  $evenement->view();
        // echo ( $_SESSION['user']);

        
        echo $this->twig->render('index/index.html.twig', [
            'resultats' => $resultats,
        ]);
    }
}
