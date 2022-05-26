<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Routing\Attribute\Route;

class LoginController extends AbstractController
{


  #[Route(path: "/", httpMethod: ["GET", "POST"])]
  public function index(UserRepository $userRepository)
  {
    echo $this->twig->render('security/login.html.twig');
    if (key_exists('logout_btn', $_POST) && key_exists('user', $_SESSION)) {
      $_SESSION = [];
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (key_exists('email', $_POST) && key_exists('password', $_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];
      }
      if (!empty($email) && !empty($password)) {
        $user = new User();
        $userId = $user->getIdByMail($email);
        $check = $userRepository->userExist($userId);
        if($check) {
          $user = new user($userId);
          $user = $user->get();
          if(password_verify($password, $user['password']))
          $_SESSION['user'] = $user['nom'] . ' ' . $user['prenom'];
          $_SESSION['id'] =  $user;
          header('Location:/contact');
        } else {
          echo "<script> alert('identifiant incorrect') </script>";
        }
      }
    }
  }
}
