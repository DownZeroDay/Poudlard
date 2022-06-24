<?php
/* A modifier avec access control */

namespace App\Controller;


use App\Routing\Attribute\Route;
use App\Entity\Evenement;
use App\Entity\Inscription;

use App\Repository\EvenementRepository;

class EventController extends AbstractController
{

  /** Méthode qui permet de créér de un evenement */
  #[Route(path: '/event/create',  httpMethod: ['POST'], name: 'create')]
  public function create()
  {
    $target = "image/" . basename($_FILES['image']['name']);

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

    if (
      !empty($data["categorie"]) && !empty($data["titre"]) && !empty($data["description"])
      && !empty($data["accroche"]) && !empty($data["participantMax"])
      && !empty($data["prix"]) && !empty($data["dateDebut"]) && !empty($data["dateFin"])
    ) {

      if ($this->resizeImage($_FILES['image']['tmp_name'], $target)) {
        $evenement->initialiser($data);
        $evenement->enregistrer();
      } else {
        return "fichier non chargé";
      }
    }
  }


  #[Route(path: '/event/edit/{id}', httpMethod: ['POST'], name: 'edit')]
  public function edit(int $id)
  {
    $target = "image/" . basename($_FILES['imageEventTab']['name']);
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


    $evenement = new Evenement($id);

    if (!(move_uploaded_file($_FILES['imageEventTab']['tmp_name'], $target))) {
      echo "Fichier Non Chargé";
    } else {
      $data["image"] = $_FILES['imageEventTab']['name'];
    }

    $evenement->initialiser($data);
    $evenement->enregistrer();
  }

  /** Methode qui permet de supprimer un evenement */
  #[Route(path: '/event/delete/{id}',  httpMethod: ['POST'], name: 'delete_event')]
  public function delete_event(int $id)
  {
    $evenement = new Evenement($id);
    if ($evenement->deleteById($id)) {
      echo ("Supprimer avec succes");
    };
  }

  /** Methode qui affiche un detail de l'evenement */
  #[Route(path: '/show_event/{id}',  httpMethod: ['GET'], name: 'show_event')]
  public function show_event(int $id)
  {
    $this->resetViewsAndParams();
    if (!empty($_SESSION)) {
      $this->params['session'] = $_SESSION;
    }
    $evenement = new Evenement($id);
    $inscription = new Inscription();
    $evenement = $evenement->get();

    if (!$evenement['id']) {
      echo "<script> alert('l\'événement n\'existe pas  ') </script>";
    }

    if (!empty($evenement)) {
      $this->params['evenement'] = $evenement;
    }
    $this->params['inscrit'] = $inscription->inscrit($_SESSION['id'], $evenement['id']);
    $this->views = [['event/show_event.html.twig', 0]];
    $this->viewPage();
  }

  /**
   * Pour participer à un evenemnt
   *
   * @param EvenementRepository $repoEvent
   * @return void
   */
  #[Route(path: '/participe/{event}/{user}',  httpMethod: ['GET'], name: 'participe')]
  public function participe(int $event, int $user, EvenementRepository $repoEvent)
  {
    if (!empty($user) && !empty($event)) {
      $inscription = new Inscription();
      if ($inscription->inscrit($user, $event)) {
        $inscription->participePas($user, $event);
      } else {
        $inscription->participe($user, $event);
      }
    }
    header('Location:/show_event/' . $event);
  }
}
