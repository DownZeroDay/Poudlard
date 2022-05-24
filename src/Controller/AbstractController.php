<?php

namespace App\Controller;


use Twig\Environment;
use App\AccessControl\AccessControl;


abstract class AbstractController
{
  protected Environment $twig;
  protected  AccessControl $authorize;
  protected array $views;
  protected array $params;

  public function __construct(Environment $twig, AccessControl $authorization)
  {
    $this->twig = $twig;
    $this->authorize = $authorization;
    $this->views = [];
    $this->params = [];
   
  }

  //put function into variable if this variable is not false echo his.
  private function renderView($link,$params = [],$idDroit = 0){
    if(!empty($idDroit) || $idDroit == 0){
      if($this->authorize->isAuthorize($idDroit))
      {
        if(!empty($link)){
          if(!empty($params)){
            $this->twig->addGlobal('params', $params);
          }
        echo $this->twig->render($link);
        exit();       
      }
      }    
    }

  }


  protected function viewPage($redirectLink = "/"){ 
      if(!empty($this->views)){
        foreach($this->views as $view){
          if($this->authorize->isAuthorize($view[1])){  
              $this->renderView($view[0],$this->params,$view[1]);
              exit();
          }
        }
      }

     header("Location:".$redirectLink);
  }

  protected function resetViewsAndParams(){
    $this->views = [];
    $this->params = [];
  }

}
