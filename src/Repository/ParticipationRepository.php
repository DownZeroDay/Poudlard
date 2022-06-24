<?php

namespace App\Repository;

use App\Entity\Participation;
use PDO;

final class ParticipationRepository extends AbstractRepository
{
 /** Requete qui recupère tous les evenements auxquels un utilisateur participent*/
    public function finById ($idUser){
        //$sql = 'SELECT * FROM'.self::TABLE.' WHERE id='.$idUser;
        $sql = "SELECT * FROM inscription inner join evenement on inscription.idEvenement = evenement.id WHERE inscription.idUtilisateur = " . $idUser ;
        $resultat = $this->pdo->query($sql);
        $resultat->execute();
        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }

}
