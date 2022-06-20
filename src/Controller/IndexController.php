<?php

namespace App\Controller;

require_once __DIR__.'/../../vendor/autoload.php';

use App\Entity\User;
use App\Repository\UserRepository;
use App\Routing\Attribute\Route;
use DateTime;
use OTPHP\TOTP;



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
    $this->resetViewsAndParams();

    if(!empty($_SESSION))
    {
      $this->params['session'] = $_SESSION;
    }
    $this->views = [['index/home.html.twig',0]];
    $this->viewPage();
  }

  #[Route(path: "/profile" , name: "profile")]
  public function profile(){
  $this->resetViewsAndParams();

    $user = new User($_SESSION['id']);
    $user = $user->get();


    if(!empty($_SESSION)){
      $this->params = $_SESSION;
    }
    $this->params['title'] = $this->authorize->getLabelUserWithId();
    $this->params['user'] = $user;
    
    $age = "0";
    
    $birth = $user['dateNaissance'];
    $today = date('Y-m-d');

    $diff = date_diff(date_create($birth),date_create($today));
    $age = $diff->format('%y');
    $this->params['age'] = strval($age);
    $this->views = [['user/Profile.html.twig',4]];
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


  //Static Route 
    #[Route(path:"/css")]
    public function css()
    {
      require "public/css/style.css";
      header('Content-Type: text/css');
    }

    
    #[Route(path:"/js")]
    public function js()
    {
      require "public/js/main.js";
      header('Content-Type: application/javascript');
    }

 


}
