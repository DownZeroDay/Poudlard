<?php

namespace App\Repository;

use App\Entity\Catevenement;


final class CategorieRepository extends AbstractRepository
{
  protected const TABLE = 'Catevenement';

  public function save(Catevenement $cat): bool
  {
    $stmt = $this->pdo->prepare("INSERT INTO Catevenement (`libelle`) VALUES (:libelle)");
    
    return $stmt->execute([
      'libelle' => $cat->getLibelle()
    ]);
  }
  // On verifie si la catégorie existe déja
  public function CategorieExist()
  {
    return $this->pdo->prepare('SELECT libelle FROM ' . self::TABLE .' WHERE libelle = ? ');
  }
}
