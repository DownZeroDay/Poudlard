<?php

namespace App\Repository;

use App\Entity\Catevenement;
use PDO;

final class CategorieRepository extends AbstractRepository
{
  protected const TABLE = 'Catevenement';

  // public function save(Catevenement $cat): bool
  // {
  //   $stmt = $this->pdo->prepare("INSERT INTO Catevenement (`libelle`) VALUES (:libelle)");
    
  //   return $stmt->execute([
  //     'libelle' => $cat->getLibelle()
  //   ]);
  // }
  /** Methode qui verifie si la catégorie existe déja */ 
  public function CategorieExist()
  {
    return $this->pdo->prepare('SELECT libelle FROM ' . self::TABLE .' WHERE libelle = ? ');
  }

  /**Methode qui affiche toutes les catégories */
  public function findAll()
  {
    $sql = "SELECT * FROM Catevenement";
    $resultat = $this->pdo->query($sql);
    $resultat->execute();
    return $resultat->fetchAll(PDO::FETCH_ASSOC);
  }
}
