<?php
/* A modifier avec access control */
namespace App\Controller;

use App\Entity\Catevenement;
use App\Routing\Attribute\Route;
use App\Entity\Evenement;
use App\Repository\CategorieRepository;
use App\Repository\EvenementRepository;
class EventController extends AbstractController
{

  /** Méthode qui permet de créér de un evenement */
  #[Route(path: '/event/create',  httpMethod: ['POST'], name: 'create')]
  public function create()
  {     
      $target = "image/".basename($_FILES['image']['name']);
   
      $data["categorie"]       = $_POST['categorie'];
      $data["titre"]           = $_POST['titre'];
      $data["description"]     = $_POST['description'];
      $data["accroche"]        = $_POST['accroche'];
      $data["participantMax"]  = $_POST['participantMax'];
      $data["prix"]            = $_POST['prix'];
      $data["dateDebut"]       = $_POST['dateDebut'];
      $data["dateFin"]         = $_POST['dateFin'];
      $data["adresse"]         = $_POST['adresse'];
      $data["createur"]        = $_SESSION['id'];
      $data["image"]           = $_FILES['image']['name'];
      
      $evenement = new Evenement();

      if (!empty($data["categorie"]) && !empty($data["titre"]) && !empty($data["description"])
          && !empty($data["accroche"]) && !empty($data["participantMax"])
          && !empty($data["prix"]) && !empty($data["dateDebut"]) && !empty($data["dateFin"]) )
      {

      if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
        {
          $evenement->initialiser($data);
          $evenement->enregistrer();
        }else{
          return "fichier non chargé";
        }
        else{
          echo ("fichier non chargé");
        }
      }        
    }
  }

  /** Méthode qui permet de créér une catégorie */
  #[Route(path: '/event/categorie',  httpMethod: ['POST'], name: 'categorie_create_form')]
  public function categorie(CategorieRepository $repoCat)
  {
      $cat = [];
      $cat["libelle"] = $_POST['libelle'];

      if (!empty($cat["libelle"])){

        $categorie = new Catevenement();

        $check = $repoCat->CategorieExist();
        $check->execute(array($cat["libelle"]));
        $row = $check->rowCount();

        if($row == 0){
          $categorie->initialiser($cat);
          $categorie->enregistrer();
        }
        else{
          echo "<script> alert('Cette catégorie existe déjà') </script>";
        }
      }
      else{
        echo ("erreur");
      }   
  }

  /** Methode qui affiche un detail de l'evenement */
  #[Route(path: '/show_event/{id}',  httpMethod: ['GET'], name: 'show_event')]
  public function show_event(int $id){
    
    $this->resetViewsAndParams();
    $evenement = new Evenement($id);
    $evenement = $evenement->get();

    if(!$evenement['id']){
      echo "<script> alert('l\'évenement n\'existe pas  ') </script>";
    }

    if(!empty($evenement))
    {
      $this->params['evenement'] = $evenement;
    }

    $this->views = [['event/show_event.html.twig',0]];
    $this->viewPage();

  }

    if(!empty($evenement))
    {
      $this->params['evenement'] = $evenement;
    }

    $this->views = [['event/show_event.html.twig',0]];
    $this->viewPage();

  }

  /**
   * Pour participer à un evenemnt
   *
   * @param EvenementRepository $repoEvent
   * @return void
   */
  #[Route(path: '/participe',  httpMethod: ['GET'], name: 'participe')]
  public function participe (EvenementRepository $repoEvent){
    
    $object = json_decode(file_get_contents("php://input"), true);
    $idEvent = $object['id'];
    $idUser = $_SESSION['id'];
    
    if(!empty($idUser) && !empty($idEvent)){
      $repoEvent->participe($idUser, $idEvent);
    }
  }  




}
