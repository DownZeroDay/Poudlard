<?php

namespace App\Entity;



class Inscription extends Model
{
    protected int $idUtilisateur = 0;
    protected int $idEvenement = 0;

    const TABLE_NAME = 'inscription';
    const PRIMARY_FIELD_NAME = 'id';

   public function inscrit($id_user, $id_event){
    $sql = 'select * from ' . self::TABLE_NAME . ' where idUtilisateur = ' . $id_user . ' and idEvenement = ' . $id_event;
    return $this->pdoConnect->query_one($sql);
   }

   public function participe ($idUser, $idEvent){
    $sql = 'insert into ' . self::TABLE_NAME . ' values(' . $idUser . ', ' . $idEvent . ')';
    return $this->pdoConnect->query_noresult($sql);
   }

   public function participePas ($idUser, $idEvent){
    $sql = 'delete from ' . self::TABLE_NAME . ' where idUtilisateur = ' . $idUser . ' and idEvenement = ' . $idEvent;
    return $this->pdoConnect->query_noresult($sql);
   }

    /**
     * Get the value of idUtilisateur
     */ 
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set the value of idUtilisateur
     *
     * @return  self
     */ 
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Get the value of idEvenement
     */ 
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * Set the value of idEvenement
     *
     * @return  self
     */ 
    public function setIdEvenement($idEvenement)
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }
}