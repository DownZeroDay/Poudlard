<?php

namespace App\Controller;

use Twig\Environment;
use App\Authorization\Authorization;


abstract class AbstractController
{
  protected Environment $twig;
  protected  Authorization $authorize;

  public function __construct(Environment $twig,Authorization $authorization)
  {
    $this->twig = $twig;
    $this->authorize = $authorization;
   
  }

  //put function into variable if this variable is not false echo his.
  protected function showView($link,$idDroit,$params = []){
    if(!empty($idDroit) && $this->authorize->isAuthorize($idDroit)){
      if(!empty($link)){
          if(!empty($params)){
            $this->twig->addGlobal('params', $params);
          }
        return $this->twig->render($link);       
      }
    }
    return false;
  }

}
