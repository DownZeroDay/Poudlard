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
    
  }

  #[Route(path: "/contact", name: "contact")]
  public function contact()
  {
    //var_export($_SESSION);
    
    if (!empty($_SESSION['user'])) {
      
      $this->twig->addGlobal('session', $_SESSION);
      echo $this->twig->render('index/contact.html.twig');
    }
   
  }

  // public function logout(){
  //   if (array_key_exists("logout_btn", $_POST)) {
  //     echo"je suis la deconnexion";
  //     //unset($_SESSION);
  //     // $_SESSION = [];
  //     // header('Location:/login');
  //   }
  // }

  // public function redirectLoginPageUnsuccesfullAction(){
  //   echo "<h1 style='color:darkred; text-align:center;'> Pour accéder à cette page, veuillez vous connecter avant </h1>";

  //   header('Location:/login');
  //   //echo $this->twig->render('security/login.html.twig');
  // }
}
