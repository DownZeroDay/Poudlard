<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Routing\Attribute\Route;
use App\Session\SessionInterface;
use App\Entity\User;

class UserController extends AbstractController
{
  #[Route(path: "/users", name: "users_list")]
  public function list(SessionInterface $session)
  {
    $users = [];

    echo $this->twig->render(
      'user/list.html.twig',
      [
        'users' => $users,
        'filter' => $session->get('filter', 'none')
      ]
    );
  }

  #[Route(path: "/user/edit", name: "edit", httpMethod: ["POST","GET"])]
  public function edit()
  {
    $user = new User($_POST['id']);

    if(!empty($_POST['nom']) && !empty($_POST['prenom'])){
      $NewData['nom'] = $_POST['nom'];
      $NewData['prenom'] = $_POST['prenom'];
   
      $user->initialiser($NewData);
      $user->enregistrer();
      
    }else{
      echo "<script>alert(Les infos envoyés sont vide!);</script>";
    }

  }


  
}
