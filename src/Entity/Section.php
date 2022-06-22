<?php
namespace App\Entity;

class Section extends Model {

    protected $id = 0;
    protected string $filliaire = "";
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
     * Get the value of filliaire
     */ 
    public function getFilliaire()
    {
        return $this->filliaire;
    }

    /**
     * Set the value of filliaire
     *
     * @return  self
     */ 
    public function setFilliaire($filliaire)
    {
        $this->filliaire = $filliaire;

        return $this;
    }

}



?>