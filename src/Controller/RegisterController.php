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
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      
        $username = $_POST['username'];
        $name = $_POST['name'];
        $firtsname = $_POST['firstname'];
        $email = $_POST['email'];
        $birthDate = new dateTime($_POST['birthDate']);
        $password = $_POST['password'];

        if(!empty($username) && !empty($name) && !empty($firtsname) && !empty($email) && !empty($birthDate) && !empty($password)){
          $user = new User();
          // verification de l'adresse email
          $check = $userRepository->userExist();
          $check->execute(array($username));
          $row = $check->rowCount();

          if( $row == 0){

            $user->setName($name)
           ->setFirstName($firtsname)
           ->setUsername($username)
           ->setPassword($password)
           ->setEmail($email)
           ->setBirthDate($birthDate);
            
           $userRepository->save($user);
          
          header('Location:/');
          }
          else{
           
            echo "<script> alert('Ce compte existe déjà') </script>";
          }
        }
    }
    
    echo $this->twig->render('security/register.html.twig');
  }

}
