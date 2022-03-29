<? 

namespace App\Repository;

use App\Entity\Droit;


class DroitRepository extends AbstractRepository 
{

protected const TABLE = "droit";

public function getDroitById($idDroit)
{
    $stmp = $this->db->prepare("SELECT * FROM droit WHERE id= :idDroit");

    $stmp->execute([
        'idDroit' => $idDroit
    ]);

    $table = $stmp->fetch();
    $droit = new Droit();
    $droit->setId($table["id"])
    ->setLabel($table["label"]);

    return $droit;

}


}




?>