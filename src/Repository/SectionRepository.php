<?php
namespace App\Repository;

use App\Entity\Section;
use PDO;

class SectionRepository extends AbstractRepository {

    const TABLE = 'section';

     /** Requete qui recupère tous les evenements */
  public function findAll()
  {
    // $sql = "SELECT * FROM ".self::TABLE;
    // $sections = new Section();
    // return  $sections->pdoConnect->query_multi($sql);

    $sql = "SELECT * FROM ".self::TABLE;
    $resultat = $this->pdo->query($sql);
    $resultat->execute();
    return $resultat->fetchAll(PDO::FETCH_ASSOC);
  }

  

  public function deleteById($id)
  {
    $sql = 'DELETE * FROM '.self::TABLE.' WHERE id='.$id;
    $section = new Section();
    return $section->pdoConnect->query_noresult($sql); 
  }

  public function sectionExist($sectionId)
  {
    $section = new Section($sectionId);
    $section = $section->get();
    return !empty($section['id']) ? true : false;
  }

}
?>