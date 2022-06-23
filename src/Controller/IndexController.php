<?php

namespace App\Controller;

require_once __DIR__.'/../../vendor/autoload.php';

use App\Entity\User;
use App\Repository\UserRepository;
use App\Routing\Attribute\Route;
use App\Repository\CategorieRepository;
use App\Repository\DroitRepository;
use App\Repository\EvenementRepository;
use DateTime;
use OTPHP\TOTP;



class IndexController extends AbstractController
{

  #[Route(path: "/")]
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
  public function profile(UserRepository $userRepo,EvenementRepository $eventRepo, CategorieRepository $categorieEvent, DroitRepository $repoDroit){
  $this->resetViewsAndParams();

    $user = new User($_SESSION['id']);
    $user = $user->get();


    if(!empty($_SESSION)){
      $this->params['session'] = $_SESSION;
    }
    $this->params['title'] = $this->authorize->getLabelUserWithId();
    $this->params['user'] = $user;   
    $this->params['categoryEvent'] = $categorieEvent->findAll();
    
    $this->params['events'] = $eventRepo->findbyCat();
    $this->params['users'] = $userRepo->findAll();
    $this->params['droit'] = $repoDroit->findAll();

    $age = "0";
    $birth = $user['dateNaissance'];
    $today = date('Y-m-d');
    $diff = date_diff(date_create($birth),date_create($today));
    $age = $diff->format('%y');
    $this->params['age'] = strval($age);



    $this->views = [['user/Profile.html.twig',4]];
    $this->viewPage();
  }

}
