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

  #[Route(path: "/home")]
  public function home(){

  }

  #[Route(path: "/profile" , name: "profile")]
  public function profile(){
    
  $this->resetViewsAndParams();

    if(!empty($_SESSION)){
      $this->params = $_SESSION;
    }
    if(!empty($this->authorize->getLabelUser())){ 
      $params['Droit'] = $this->authorize->getLabelUser();
    }
    $this->views = [['user/Profile.html.twig',2] ,['user/BDEProfile.html.twig',1] , ['user/AdminProfile.html.twig',3]];
    
    $this->viewPage();
    
    
  }

  #[Route(path: "/contact", name: "contact")]
    public function contact()
    {    
      $this->resetViewsAndParams();
        
        if(!empty($_SESSION) ){
          $this->params = $_SESSION;
        }
        $this->params['page_name'] = 'contact';
        $this->views = [['index/contact.html.twig',1]];
        $this->viewPage();
        //echo $this->twig->render('index/contact.html.twig');        
    }

}
