<?php

namespace App\Repository;

use App\Entity\Evenement;
use PDO;

final class EvenementRepository extends AbstractRepository
{
  protected const TABLE = 'evenement';

  /** Requete qui recupère tous les evenements */
  public function findAll()
  {
    $sql = "SELECT * FROM evenement";
    $resultat = $this->pdo->query($sql);
    $resultat->execute();
    return $resultat->fetchAll(PDO::FETCH_ASSOC);
  }

  /** Methode qui recupere un seul evenement */
  // public function findBy($id)
  // {
  //   $sql = "SELECT * FROM evenement WHERE id = $id" ;
  //   $resultat = $this->pdo->query($sql);
  //   $resultat->execute();
  //   return $resultat->fetchAll(PDO::FETCH_ASSOC);
  // }


  /**
   * Methode qui d'inserer un participant a un evenement
   */
    public function participe ($idUser, $idEvent){
      $stmt = $this->pdo->prepare("INSERT INTO inscription (`idUtilisateur	`, idEvenement) 
      VALUES (:idUtilisateur, :idEvenement)");

      return $stmt->execute([
        'idUtilisateur' => $idUser,
        'idEvenement' => $idEvent
      ]);

    }
  
}