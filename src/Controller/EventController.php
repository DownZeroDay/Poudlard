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
  #[Route(path: '/event/create',  httpMethod: ['GET', 'POST'], name: 'event_create_form')]
  public function create(CategorieRepository $repoCat )
  {
    $resultats = $repoCat->findAll();

    echo $this->twig->render('event/create.html.twig', [
      'resultats' => $resultats
  ]);


    // traitement 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $evenement = [];
      $target = "image/".basename($_FILES['image']['name']);

      $evenement["categorie"]       = $_POST['categorie'];
      $evenement["titre"]           = $_POST['titre'];
      $evenement["description"]     = $_POST['description'];
      $evenement["accroche"]        = $_POST['accroche'];
      $evenement["participantMax"]  = $_POST['participantMax'];
      $evenement["prix"]            = $_POST['prix'];
      $evenement["dateDebut"]       = $_POST['dateDebut'];
      $evenement["dateFin"]         = $_POST['dateFin'];
      $evenement["adresse"]         = $_POST['adresse'];
      $evenement["createur"]        = $_SESSION['id'];
      $evenement["image"]           = $_FILES['image']['name'];
      

      if (!empty($evenement["categorie"]) && !empty($evenement["titre"]) && !empty($evenement["description"])
          && !empty($evenement["accroche"]) && !empty($evenement["participantMax"])
          && !empty($evenement["prix"]) && !empty($evenement["dateDebut"]) && !empty($evenement["dateFin"]) )
      {
        $evenements = new Evenement();
        
         if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
         
          $evenements->initialiser($evenement);
          $evenements->enregistrer();
        }
        else{
          echo ("fichier non chargé");
        }
      }        
    }
    
  }

  // #[Route(path: '/event/save', httpMethod: ['POST'], name: 'event_save')]
  // public function save()
  // {
  //   // if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //   //   //$target = "image/".basename($_FILES['image']['name']);

  //   //   $titre = $_POST['titre'];
  //   //   $number = $_POST['number'];
  //   //   $numberMax = $_POST['numberMax'];
  //   //   $prix = $_POST['prix'];
  //   //   $dateDebut = $_POST['dateDebut'];
  //   //   $adresse = $_POST['adresse'];
  //   //   $description = $_POST['description'];
  //   //   //$image = $_FILES['image']['name'];
  //   //   $accroche = $_POST['accroche'];

  //   //   if(!empty($titre) && !empty($number) && !empty($numberMax) && !empty($prix) && !empty($dateDebut) && !empty($adresse) && !empty($description) && !empty($image)){
  //   //     $evenement = new Evenement();
  //   //     $evenement->setTitre($titre); 
  //   //     $evenement->setNumber($number);
  //   //     $evenement->setNumberMax($numberMax); 
  //   //     $evenement->setPrix($prix);
  //   //     $evenement->setAdresse($adresse);
  //   //     $evenement->setDescription($description); 
  //   //     $evenement->setImage($image); 
          
  //   //     // var_dump($evenement);
          
  //   //     // if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
  //   //     //   $evenementRepository->save($evenement);
  //   //     // }
  //   //     // else{
  //   //     //   echo ("fichier non chargé");
  //   //     // }
  //   //   }
  //   // }
  //   echo $this->twig->render('evenement/evenement.html.twig');
  // }


  /** Méthode qui permet de créér une catégorie */
  #[Route(path: '/event/categorie',  httpMethod: ['GET', 'POST'], name: 'categorie_create_form')]
  public function categorie(CategorieRepository $repoCat)
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    echo $this->twig->render('event/categorie.html.twig');
    
  }

  /** Methode qui permet de participer à un évenement */
  #[Route(path: '/participe',  httpMethod: ['GET', 'POST'], name: 'participe')]
  public function participe(){

    echo $this->twig->render('event/participe.html.twig');
  }
}
