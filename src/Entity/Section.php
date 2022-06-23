<?php
namespace App\Entity;

class Section extends Model {

    protected $id = 0;
    protected string $filiere = "";
    protected $annee = 0;

    const TABLE_NAME = 'section';
    const PRIMARY_FIELD_NAME = 'id';

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    public function deleteById($id)
    {
      $sql = 'DELETE FROM '.self::TABLE_NAME.' WHERE id='.$id;
      return $this->pdoConnect->query_noresult($sql); 
    }

    /**
     * Get the value of annee
     */ 
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set the value of annee
     *
     * @return  self
     */ 
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get the value of filiere
     */ 
    public function getFiliere()
    {
        return $this->filliaire;
    }

    /**
     * Set the value of filiere
     *
     * @return  self
     */ 
    public function setFiliere($filiere)
    {
        $this->filiere = $filiere;

        return $this;
    }

}



?>