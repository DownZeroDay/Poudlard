<?php
namespace App\Repository;

use App\Entity\Evenement;
use PDO;

final class EvenementRepository extends AbstractRepository
{
  protected const TABLE = 'evenement';

  /** Requete qui recupère tous les evenements sans les afficher les catégories*/
  public function findAll()
  {
    $sql = "SELECT * FROM evenement";
    $resultat = $this->pdo->query($sql);
    $resultat->execute();
    return $resultat->fetchAll(PDO::FETCH_ASSOC);
  }

  /** Requete qui recupère tous les evenements avec les catégories*/
  public function findByCat()
  {
    $sql = "SELECT evenement.*, catevenement.id as idCat, utilisateurs.id as idUser , libelle, nom, prenom  FROM evenement INNER JOIN catevenement ON catevenement.id = categorie INNER JOIN utilisateurs ON utilisateurs.id = createur";
    $resultat = $this->pdo->query($sql);
    $resultat->execute();
    return $resultat->fetchAll(PDO::FETCH_ASSOC);
  }

    /**
   * Methode qui d'inserer un participant a un evenement
   */
  public function delete ($idEvent){
    $sql = "DELETE FROM Users WHERE nom='Giraud'";
    $sth =$this->pdo->prepare($sql);

    return $sth->execute([
      'idEvent' => $idEvent]);
  }

  public function deleteById($id)
  {
    $sql = 'DELETE * FROM '.self::TABLE.' WHERE id='.$id;
    $event = new Evenement();
    return $event->pdoConnect->query_noresult($sql); 
  }

}