<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Routing\Attribute\Route;

class LoginController extends AbstractController
{
  #[Route(path: "/" )]
  public function index(UserRepository $userRepository)
  {
    $user = new User();

   
    echo $this->twig->render('security/login.html.twig');
  }

}
