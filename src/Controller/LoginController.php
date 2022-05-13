<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Routing\Attribute\Route;

class LoginController extends AbstractController
{


  #[Route(path: "/" , httpMethod: ["GET", "POST"])]
  public function login(UserRepository $userRepository)
  {

    if(isset($_POST['submit'])){
    
      $username = $_POST['username'];
      $password = $_POST['password'];
     
      if(!empty($username) && !empty($password)){
       
        //COntrole email et passeword
        $check = $userRepository->userExist($username);
        $check->execute(array($username));
        $row = $check->rowCount();
        $data = $check->fetch();

        if($row > 0 && password_verify($password, $data['password'])){
          
          $_SESSION['user'] = $username;
          
          header('Location:/index');
        }
        else{
            echo "<script> alert('identifiant incorrect') </script>";
        }
      }        
    } 

    // Deconnexion
    if(isset($_POST['logout_btn'])){
      $_SESSION = [];
    }
    echo $this->twig->render('security/login.html.twig');
    
  }

  // /**La route pour la déconnexion */
  // #[Route(path: "/" , httpMethod: ["GET", "POST"])]
  // public function logout(){
   
  //     //$_SESSION = [];
  //     session_destroy();
  //     echo $this->twig->render('security/login.html.twig');

  // }
  
} 