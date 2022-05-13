<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Evenement;
use App\Routing\Attribute\Route;
use App\Repository\CategorieRepository;
use App\Repository\EvenementRepository;

class EvenementController extends AbstractController
{
    /**Création d'une catégorie */
    #[Route(path: "/categorie",  httpMethod: ["GET", "POST"], name: "categorie")]
    public function categorie(CategorieRepository $categorieRepository)
    {    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $libelle = $_POST['libelle'];

            if(!empty($libelle)){
                $categorie = new Categorie();

                // on verifie si cette catégorie existe ou pas 
                $check = $categorieRepository->CategorieExist();
                $check->execute(array($libelle));
                $row = $check->rowCount();

                if( $row == 0){
                    $categorie->setLibelle($libelle); 
                    $categorieRepository->save($categorie);
                }
                else{
                    echo "<script> alert('Cette catégorie existe déjà') </script>";
                  }

                // $categorie->setLibelle($libelle); 
                // $categorieRepository->save($categorie);
            }
        }
        echo $this->twig->render('evenement/categorie.html.twig');
    }

    /************************Création d'un évenement ***********************************/
    #[Route(path: "/evenement",  httpMethod: ["GET", "POST"])]
    public function evenement(EvenementRepository $evenementRepository)
    {    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $target = "image/".basename($_FILES['image']['name']);

            $titre = $_POST['titre'];
            $number = $_POST['number'];
            $numberMax = $_POST['numberMax'];
            $prix = $_POST['prix'];
            $dateDebut = $_POST['dateDebut'];
            $adresse = $_POST['adresse'];
            $description = $_POST['description'];
            $image = $_FILES['image']['name'];

            if(!empty($titre) && !empty($number) && !empty($numberMax) && !empty($prix) && !empty($dateDebut) && !empty($adresse) && !empty($description) && !empty($image)){
                $evenement = new Evenement();
                $evenement->setTitre($titre); 
                $evenement->setNumber($number);
                $evenement->setNumberMax($numberMax); 
                $evenement->setPrix($prix);
                $evenement->setAdresse($adresse);
                $evenement->setDescription($description); 
                $evenement->setImage($image); 
                

                
                if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
                    $evenementRepository->save($evenement);
                }
                else{
                    echo ("fichier non chargé");
                }
            }
        }
        echo $this->twig->render('evenement/evenement.html.twig');
    }


}
