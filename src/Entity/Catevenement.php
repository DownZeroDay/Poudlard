<?php

namespace App\Entity;

use DateTime;

class Catevenement extends Model
{
    protected int $id = 0;
    protected string $libelle ="";

    const TABLE_NAME = 'catevenement';
    const PRIMARY_FIELD_NAME = 'id';

    public function CategorieExist($libelle){
        $sql = 'SELECT libelle FROM ' . self::TABLE_NAME .' WHERE libelle='.$this->pdoConnect->quote($libelle);
        return $this->pdoConnect->query_one($sql);
    }

    public function deleteById($id)
    {
      $sql = 'DELETE FROM '.self::TABLE_NAME.' WHERE id='.$id;
      return $this->pdoConnect->query_noresult($sql); 
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of libelle
     */ 
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

}