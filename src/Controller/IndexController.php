<?php

namespace App\Controller;

require_once __DIR__.'/../../vendor/autoload.php';

use App\Entity\User;
use App\Repository\UserRepository;
use App\Routing\Attribute\Route;
use DateTime;
use OTPHP\TOTP;



class IndexController extends AbstractController
{
  #[Route(path: "/index")]
  public function index(UserRepository $userRepository)
  {
    if(session_destroy())
    {
      // Redirection vers la page de connexion
        header("Location:/");
    }
  }

  #[Route(path: "/home")]
  public function home(){

  }

  #[Route(path: "/profile" , name: "profile")]
  public function profile(){
    
  $this->resetViewsAndParams();

    if(!empty($_SESSION)){
      $this->params = $_SESSION;
    }
    if(!empty($this->authorize->getLabelUser())){ 
      $params['Droit'] = $this->authorize->getLabelUser();
    }
    $this->views = [['user/Profile.html.twig',2] ,['user/BDEProfile.html.twig',1] , ['user/AdminProfile.html.twig',3]];
    
    $this->viewPage();
  }

  //methode de vérifier le code google authenicator
  // #[Route(path: "/auth_google",  httpMethod: ["GET", "POST"], name: "auth_google")]
  //   public function auth_google()
  //   { 
      
  //     $otp = TOTP::create('KFJMP3RSMRIKZHCZEH2HSNVN5SO2TXDDV5ZBT6EF3Q4BNRSJ4BL3FQYZVUVBVL4UALTQ63MONTPN564S7YLCEGEQNM4NPQV56YQRSPQ');
  //     $otp->setLabel('Projet Annuel');
  //     $chl = $otp->getProvisioningUri();
  //     $link = "https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=".$chl;
      
  //     $m =$otp->now();

  //     if(!empty($_POST['code'])){
  //       if($otp->verify(htmlspecialchars($_POST['code']))){
  //         header('Location:/contact');
  //           //echo(" okay");
  //       }
  //       else{
  //         echo "<script> alert('Code invalide') </script>";
  //       }
  //   }
  //       echo $this->twig->render('index/auth_google.html.twig',[
  //         'link' => $link, 
  //          'm'  => $m 
  //       ]);        
  //   }

  #[Route(path: "/contact", name: "contact")]
    public function contact()
    {    
      $this->resetViewsAndParams();
        
        if(!empty($_SESSION) ){
          $this->params = $_SESSION;
        }
        $this->params['page_name'] = 'contact';
        $this->views = [['index/contact.html.twig',1]];  
        $this->viewPage();
        //echo $this->twig->render('index/contact.html.twig');        
    }



}
