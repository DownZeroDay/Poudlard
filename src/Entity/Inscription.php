<?php

namespace App\Entity;



class Inscription extends Model
{
    protected int $idUtilisateur = 0;
    protected int $idEvenement = 0;

    const TABLE_NAME = 'inscription';
    const PRIMARY_FIELD_NAME = 'id';

   

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