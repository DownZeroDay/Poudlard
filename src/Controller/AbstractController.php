<?php

namespace App\Controller;


use Twig\Environment;
use App\AccessControl\AccessControl;
use App\AccessControl\AccessDeniedException;
use App\Routing\Attribute\Route;


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
  private function renderView($link, $params = [], $idDroit = 0)
  {
    if (!empty($idDroit) || $idDroit == 0) {    
        if (!empty($link)) {
          if (!empty($params)) {
            $this->twig->addGlobal('params', $params);
          }
          echo $this->twig->render($link);
        }
    }
  }

  protected function resetViewsAndParams()
  {
    $this->views = [];
    $this->params = [];
  }

  private function chooseView()
  {
    if (!empty($this->views)) {
      foreach ($this->views as $view) {
        if ($this->authorize->isAuthorize($view[1])) {
          $this->renderView($view[0], $this->params, $view[1]);
          exit();
        }
      }
    }
    throw new AccessDeniedException();
  }

  protected function viewPage(){
    try{
      $this->chooseView();
    }catch(AccessDeniedException $e){
      http_response_code(403);
      echo $this->twig->render('403.html.twig');
    }
  }
}
