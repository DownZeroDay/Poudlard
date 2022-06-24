<?php
namespace App\Repository;

use App\Entity\Section;
use PDO;
class SectionRepository extends AbstractRepository {

    const TABLE = 'section';

     /** Requete qui recupère tous les evenements */
  public function findAll()
  {
    $sql = "SELECT * FROM ".self::TABLE;
    $resultat = $this->pdo->query($sql);
    $resultat->execute();
    return $resultat->fetchAll(PDO::FETCH_ASSOC);
  }

  public function sectionExist($sectionId)
  {
    $section = new Section($sectionId);
    $section = $section->get();
    return !empty($section['id']) ? true : false;
  }

}
?>