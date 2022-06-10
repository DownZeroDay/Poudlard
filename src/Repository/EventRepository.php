<?php

namespace App\Repository;

use App\Entity\Evenement;
use PDO;

final class EvenementRepository extends AbstractRepository
{
  protected const TABLE = 'evenement';

  public function save(Evenement $event): bool
  {
    $stmt = $this->pdo->prepare("INSERT INTO evenement (`titre`, number, numberMax,
    prix, adresse, image, description) VALUES (:titre, :number, :numberMax,:prix, :adresse,:image, :description)");
    return $stmt->execute([
      'titre' => $event->getTitre(), 
      'number' => $event->getNumber(),
      'numberMax' => $event->getNumberMax(),
      'prix' => $event->getPrix(),
      'adresse' => $event->getAdresse(),
      'image' => $event->getImage(),
      'description' => $event->getDescription(),
    ]);
  }


  public function view()
  {
    $sql = "SELECT * FROM evenement";
    $resultat = $this->pdo->query($sql);
    $resultat->execute();
    return $resultat->fetchAll(PDO::FETCH_ASSOC);
  }
}