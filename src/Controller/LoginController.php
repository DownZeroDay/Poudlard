<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Routing\Attribute\Route;

class LoginController extends AbstractController
{


  #[Route(path: "/" , httpMethod: ["GET", "POST"])]
  public function index(UserRepository $userRepository)
  {
    echo $this->twig->render('security/login.html.twig');
    

    

    if (key_exists('logout_btn', $_POST) && key_exists('user', $_SESSION)) {
      $_SESSION = [];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
  
      if (key_exists('username', $_POST) && key_exists('password', $_POST)) {
        $username = $_POST['username'];
        $password = $_POST['password'];
      }
   
      if( !empty($username) && !empty($password)){
       
        //COntrole email et passeword
        $check = $userRepository->userExist();
        $check->execute(array($username));
        $row = $check->rowCount();
        $data = $check->fetch();

        if($row > 0 && password_verify($password, $data['password'])){       
          $_SESSION['user'] = $username;
          $_SESSION['id'] =  $data['id'] ?? null;
          header('Location:/contact');
        }
        else{
            echo "<script> alert('identifiant incorrect') </script>";
        }
      }       
      
    } 
    
  }
  
} 