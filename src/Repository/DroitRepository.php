<?php

namespace App\Repository;

use App\Entity\Droit;
use PDO;

class DroitRepository extends AbstractRepository 
{
    protected const TABLE = "droit";


    public function findAll()
    {
        $sql = "SELECT * FROM droit";
        $resultat = $this->pdo->query($sql);
        $resultat->execute();
        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getDroitById($idDroit)
    {


        $stmp = $this->pdo->prepare("SELECT * FROM droit WHERE id= :id");

        $stmp->execute([':id' => $idDroit]);
        $table = $stmp->fetch();
        $droit = new Droit();
        $droit->setId($table["id"])
        ->setLabel($table["libelle"]);

        return $droit;
    }
}
?>