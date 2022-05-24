<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Routing\Attribute\Route;
use DateTime;

class IndexController extends AbstractController
{
  #[Route(path: "/index")]
  public function index(UserRepository $userRepository)
  {
    if(session_destroy())
    {
      // Redirection vers la page de connexion
        header("Location:/");
    }
  }

  #[Route(path: "/contact", name: "contact")]
    public function contact()
    {    
        $params = [];
        if(!empty($_SESSION) ){
          $params = $_SESSION;
        }
        $page = $this->showView('index/contact.html.twig',0,$params);
        if($page) echo $page;
          //echo $this->twig->render('index/contact.html.twig');        
    }

}
