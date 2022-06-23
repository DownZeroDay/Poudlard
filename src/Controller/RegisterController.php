<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Routing\Attribute\Route;
use DateTime;

class RegisterController extends AbstractController
{
  #[Route(path: "/register", httpMethod: ["GET", "POST"])]
  public function index(UserRepository $userRepository)
  {
    $this->resetViewsAndParams();
    if(!empty($_POST['login']) && !empty($_POST['mdp'])){
      $data = UserRepository::getProfile($_POST['login'], $_POST['mdp']);
      if($data){
        $res["nom"] = $data['result']['name'];
        $res["prenom"] = $data['result']['firstname'];
        $res["email"] = $data['result']['email'];
        $res["dateNaissance"] = date('Y-m-d', substr($data['result']['birthday'], 0, strlen($data['result']['birthday'])-3));
        $res["password"] = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
        $res["droit"] = 2;
      }
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $res = [];
      $res["nom"] = $_POST['name'];
      $res["prenom"] = $_POST['firstname'];
      $res["email"] = $_POST['email'];
      $res["dateNaissance"] = $_POST['birthDate'];
      $res["password"] = password_hash($_POST['password'], PASSWORD_BCRYPT);
      $res["droit"] = intval($_POST['role']);
    }
    
    if (!empty($res["nom"]) && !empty($res["prenom"]) && !empty($res["email"]) && !empty($res["dateNaissance"]) && !empty($res["password"]) && !empty($res["droit"])) {
      $user = new User();
      
      $check = $userRepository->userExist($user->getIdByMail($res["email"]));
      if (!$check) {
        $user->initialiser($res);
        $user->enregistrer();
        header('Location:/login');
      } else {
        echo "<script> alert('Ce compte existe déjà') </script>";
      }
    }
    $this->views = [["security/register.html.twig",0]];
    $this->viewPage();
  }
}
