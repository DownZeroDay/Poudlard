<?php

namespace App\Controller;

require_once __DIR__.'/../../vendor/autoload.php';

use App\Entity\Evenement;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Routing\Attribute\Route;
use DateTime;
use OTPHP\TOTP;
use App\Repository\CategorieRepository;
class IndexController extends AbstractController
{
  #[Route(path: "/")]
  public function redirectHome(){
    $this->resetViewsAndParams();
    if(!empty($_SESSION))
    {
      $this->params['session'] = $_SESSION;
    }
    $evenement = new Evenement();
    if(!empty($_GET['recherche'])){
      $maxPage = intval(floor($evenement->getTotal()/10));
      $this->params['evenements'] = $evenement->recherche($_GET['recherche']);
      $this->params['title'] = 'Recherche';
      $this->views = [['index/home.html.twig',0]];
      $this->viewPage();
    }
    else{
      header("Location:/default/0");
    }
  }
  
  #[Route(path: "/{tri}/{page}")]
  public function home(string $tri, int $page){
    $this->resetViewsAndParams();

    if(!empty($_SESSION))
    {
      $this->params['session'] = $_SESSION;
    }
    $evenement = new Evenement();
    $maxPage = intval(floor($evenement->getTotal()/10));
    $page = $page < $maxPage ? $page : $maxPage;
    $offset = $page != 0 ? $page * 10 : 0;
    $limit = 10;
    if($tri == 'categorie'){
      $this->params['evenements'] = $evenement->getAllAccueilByCategorie($offset, $limit);
    }
    else if($tri == 'nom'){
      $this->params['evenements'] = $evenement->getAllAccueilByName($offset, $limit);
    }
    else{
      $this->params['evenements'] = $evenement->getAllAccueil($offset, $limit);
    }
    $this->params['maxPage'] = $maxPage;
    $this->params['tri'] = $tri;
    $this->params['page'] = $page;
    $this->params['title'] = 'Accueil';
    $this->views = [['index/home.html.twig',0]];
    $this->viewPage();
  }

  #[Route(path: "/profile" , name: "profile")]
  public function profile(CategorieRepository $categorieEvent){
  $this->resetViewsAndParams();

    if(!empty($_SESSION)){
      $this->params['session'] = $_SESSION;
    }
    $user = new User($_SESSION['id']);
    $user = $user->get();
    $this->params['title'] = $this->authorize->getLabelUserWithId();
    $this->params['user'] = $user;   
    $this->params['categoryEvent'] = $categorieEvent->findAll();
    
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
