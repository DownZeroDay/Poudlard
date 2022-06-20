<?php
/* A modifier avec access control */
namespace App\Controller;

use App\Routing\Attribute\Route;
use App\Entity\Evenement;
use App\Repository\EvenementRepository;
class EventController extends AbstractController
{
  #[Route(path: '/event/create',  httpMethod: ['GET', 'POST'], name: 'event_create_form')]
  public function create()
  {
    echo $this->twig->render('event/create.html.twig');  
  }

  #[Route(path: '/event/save', httpMethod: ['POST'], name: 'event_save')]
  public function save()
  {
  //   if (!isset($_FILES['image'])) {
  //     echo "Erreur : pas d'image";
  //     return;
  //   }

  //   $image = $_FILES['image'];

  //   if (
  //     is_uploaded_file($image['tmp_name']) &&
  //     move_uploaded_file(
  //       $image['tmp_name'],
  //       __DIR__ . DIRECTORY_SEPARATOR . '../../public/events/' . basename($image['name'])
  //     )
  //   ) {
  //     echo "ok";
  //   } else {
  //     echo "Erreur lors de l'upload";
  //   }

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //   $target = "image/".basename($_FILES['image']['name']);

    //   $titre = $_POST['titre'];
    //   $number = $_POST['number'];
    //   $numberMax = $_POST['numberMax'];
    //   $prix = $_POST['prix'];
    //   $dateDebut = $_POST['dateDebut'];
    //   $adresse = $_POST['adresse'];
    //   $description = $_POST['description'];
    //   $image = $_FILES['image']['name'];

    //   if(!empty($titre) && !empty($number) && !empty($numberMax) && !empty($prix) && !empty($dateDebut) && !empty($adresse) && !empty($description) && !empty($image)){
    //     $evenement = new Evenement();
    //     $evenement->setTitre($titre); 
    //     $evenement->setNumber($number);
    //     $evenement->setNumberMax($numberMax); 
    //     $evenement->setPrix($prix);
    //     $evenement->setAdresse($adresse);
    //     $evenement->setDescription($description); 
    //     $evenement->setImage($image); 
          
    //     // var_dump($evenement);
          
    //     // if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
    //     //   $evenementRepository->save($evenement);
    //     // }
    //     // else{
    //     //   echo ("fichier non chargé");
    //     // }
    //   }
    // }
    echo $this->twig->render('evenement/evenement.html.twig');
  }
}
