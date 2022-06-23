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

  #[Route(path: "/profile/edit", name: "edit", httpMethod: ["POST","GET"])]
  public function edit_profile()
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
  
  #[Route(path: "/user/edit/{id}", httpMethod: ["POST"] )]
  public function edit_admin(int $id)
  {
    $res = [];
    $res["nom"] = $_POST['nom'];
    $res["prenom"] = $_POST['prenom'];
    $res["email"] = $_POST['email'];
    $res["dateNaissance"] = $_POST['dateNaissance'];
    $res["droit"] = $_POST['droit'];
      
    $user = new User($id);
    $user->initialiser($res);
    $user->enregistrer();    
  } 

  #[Route(path: "/user/delete/{id}", httpMethod: ["GET", "POST"])]
  public function delete_admin(int $id)
  {
    $user = new User($id);
    if($user->deleteById($id)){
      echo"Supprimmer avec succès!";
    }
  } 

  }


?>