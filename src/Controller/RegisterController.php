<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Routing\Attribute\Route;
use DateTime;

class RegisterController extends AbstractController
{
  #[Route(path: "/register", httpMethod: "GET")]
  public function index(UserRepository $userRepository)
  {
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      
        $username = $_POST['username'];
        $name = $_POST['name'];
        $firtsname = $_POST['firstname'];
        $email = $_POST['email'];
        $birthDate = new dateTime($_POST['birthDate']);
        $password = $_POST['password'];

        if(!empty($username) && !empty($name) && !empty($firtsname) && !empty($email) && !empty($birthDate) && !empty($password)){
           
          // cripter le mot de passe
          $hashpass = password_hash($password, PASSWORD_BCRYPT); 
     
          $user = new User();

          $user->setName($name)
           ->setFirstName($firtsname)
           ->setUsername($username)
           ->setPassword($hashpass)
           ->setEmail($email)
           ->setBirthDate($birthDate);
            
           $userRepository->save($user);

            //var_dump($_SESSION);
            echo("Je sui la");

          //header('Location:/home');
        }
    }
   
    echo $this->twig->render('security/register.html.twig');
  }

}
