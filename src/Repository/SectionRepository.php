<?php
namespace App\Repository;

use App\Entity\Section;

class SectionRepository extends AbstractRepository {

    const TABLE = 'section';


     /** Requete qui recupère tous les evenements */
  public function findAll()
  {
    $sql = "SELECT * FROM ".self::TABLE;

    $sections = new Section();

    return  $sections->pdoConnect->query_multi($sql);
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