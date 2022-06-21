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
    $object = json_decode(file_get_contents("php://input"), true);
    $id = $object['id'];
    $user = new User($id);

    if(!empty($object['nom']) && !empty($object['prenom'])){
      $NewData['nom'] = $object['nom'];
      $NewData['prenom'] = $object['prenom'];
   
      $user->initialiser($NewData);
      $user->enregistrer();
      
    }else{
      echo "<script>alert(Les infos envoyés sont vide!);</script>";
    }

  }


  
}
