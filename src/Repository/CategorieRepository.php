<?php

namespace App\Repository;

use App\Entity\Categorie;


final class CategorieRepository extends AbstractRepository
{
  protected const TABLE = 'categorie';

  public function save(Categorie $cat): bool
  {
    $stmt = $this->pdo->prepare("INSERT INTO categorie (`libelle`) VALUES (:libelle)");
    
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
