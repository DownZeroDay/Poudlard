<?php

namespace App\Controller;
require_once __DIR__.'/../../vendor/autoload.php';

use App\Entity\User;
use App\Repository\UserRepository;
use App\Routing\Attribute\Route;
use OTPHP\TOTP;

class LoginController extends AbstractController
{

  private $user; 

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
          if(password_verify($password, $user['password'])){
             header('Location:/auth_google');
             $_SESSION['user'] = $user['nom'] . ' ' . $user['prenom'];
             $_SESSION['id'] =  $user['id'];
          }
        } else {
          echo "<script> alert('identifiant incorrect') </script>";
        }
      }
    }
  }


  //methode de vérifier le code google authenicator

    /**
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\LoaderError
     */
    #[Route(path: "/auth_google",  httpMethod: ["GET", "POST"], name: "auth_google")]
    public function auth_google()
    { 
      if(!empty($_SESSION) ){

        $otp = TOTP::create('KFJMP3RSMRIKZHCZEH2HSNVN5SO2TXDDV5ZBT6EF3Q4BNRSJ4BL3FQYZVUVBVL4UALTQ63MONTPN564S7YLCEGEQNM4NPQV56YQRSPQ');
        $otp->setLabel('Projet Annuel');
        $chl = $otp->getProvisioningUri();
        $link = "https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=".$chl;
        $m = $otp->now();

        echo($m);

        if(!empty($_POST['code'])){
          if($otp->verify(htmlspecialchars($_POST['code']))){
            header('Location:/contact');
          }
          else{
            echo "<script> alert('Code invalide') </script>";
          }
        }
      }
      else{
        header('Location:/');        
      }
        echo $this->twig->render('Security/auth_google.html.twig',[
            'link' => $link
        ]);
    }
}