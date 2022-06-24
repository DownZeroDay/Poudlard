<?php
namespace App\Controller; 

use App\Entity\Catevenement;
use App\Routing\Attribute\Route;

class CategorieController extends AbstractController {

     /** Méthode qui permet de créér une catégorie */
  #[Route(path: '/categorie/create',  httpMethod: ['POST'], name: 'categorie_create_form')]
  public function categorieCreate()
  {
    $cat = [];
    $cat["libelle"] = $_POST['libelle'];
    if (!empty($cat["libelle"])) {
      $categorie = new Catevenement();
      if (!$categorie->CategorieExist($cat["libelle"])) {
        $categorie->initialiser($cat);
        $categorie->enregistrer();
      } else {
        echo "<script> alert('Cette catégorie existe déjà') </script>";
      }
    } else {
      echo ("erreur");
    }
  }

  /** Méthode qui permet de créér une catégorie */
  #[Route(path: '/categorie/edit/{id}',  httpMethod: ['POST'], name: 'categorie_create_form')]
  public function categorieEdit(int $id)
  {
    $cat = [];
    $cat["libelle"] = $_POST['libelle'];

    if (!empty($cat["libelle"])) {

      $categorie = new Catevenement($id);
      if (!$categorie->CategorieExist($cat["libelle"])) {
        $categorie->initialiser($cat);
        $categorie->enregistrer();
      } else {
        echo "<script> alert('Cette catégorie existe pas') </script>";
      }
    } else {
      echo ("erreur");
    }
  }

  /** Methode qui permet de supprimer un evenement */
  #[Route(path: '/categorie/delete/{id}',  httpMethod: ['POST'], name: 'delete_categorie')]
  public function delete_categorie(int $id)
  {
    $categorie = new Catevenement($id);
    if ($categorie->deleteById($id)) {
      echo ("Supprimer avec succes");
    };
  }

}
?>